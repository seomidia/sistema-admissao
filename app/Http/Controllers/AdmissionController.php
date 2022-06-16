<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\companies;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Schedules;
use PDF;
use App\Events\AdmissionProcessed;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($admission_id)
    {
        $diasSemana = ['Segunda','Terçã','Quarta','Quinta','Sexta','Sábado','Domingo'];
        
        $files = $this->get_Files($admission_id);

        $schedules = $this->get_schedules($admission_id);

        $admission = \DB::table('admissions')
        ->select(
            'admissions.*',
            'companies.razao_social'
        )
        ->join('companies','admissions.companies_id','=','companies.id')
        ->where('admissions.id',$admission_id)
        ->first();

        return view('front.formulario',[
            'dias'=> $diasSemana,
            'admission'=>$admission,
            'files' => $files,
            'schedules' => $schedules
        ]);
    }

    public function get_schedules($admission_id)
    {
        $schedules = \DB::table('schedules')->where('admission_id',$admission_id)->get();
        $NomaliseSchedules = [];
        foreach ($schedules as $key => $value) {
            $NomaliseSchedules[$value->dia_semana] = [
                'h_entrada_manha'=> date('H:i',strtotime($value->h_entrada_manha)),
                'h_saida_manha'  => date('H:i',strtotime($value->h_saida_manha)),
                'h_entrada_tarde'=> date('H:i',strtotime($value->h_entrada_tarde)),
                'h_saida_tarde'  => date('H:i',strtotime($value->h_saida_tarde)),
                'h_entrada_noite'=> date('H:i',strtotime($value->h_entrada_noite)),
                'h_saida_noite'  => date('H:i',strtotime($value->h_saida_noite)),
                'folga'          => $value->folga,
                'admission_id'   => $value->admission_id,
            ];
        }

        return $NomaliseSchedules;
    }

    public function get_Files($admission_id)
    {

        $files = \DB::table('files')->where('admission_id',$admission_id)->get();
        $NomaliseFile = [];
        foreach ($files as $key => $value) {
            $NomaliseFile[$value->doctype] = [
                'id'  => $value->id,
                'url' => $value->url_file,
                'admission_id' => $value->admission_id
            ];
        }

        return $NomaliseFile;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $data = $request->all();
        $admission = Admission::find($id);

        foreach ($data as $key => $value) {
            if(!in_array($key,['_token','horario','arquivo'])){
               $admission->$key = $value;
               $admission->save();
            }elseif($key == 'arquivo'){
                foreach ($request->arquivo as $key => $value) {
                    $name = uniqid(date('HisYmd'));
                    $extension = $value->extension();
                    $nameFile = "{$name}.{$extension}";
                    $exist = \DB::table('files')->where(['admission_id'=> $admission->id,'doctype'=> $key])->count();
                    if($exist > 0){
                        $file_id = \DB::table('files')
                        ->select('id')
                        ->where(['admission_id'=> $admission->id,'doctype'=> $key])->first();

                        $updateFile = File::find($file_id->id);
                        $updateFile->url_file  = str_replace('public','storage',$value->storeAs('/public/documentos/' . $admission->nome, $nameFile));
                        $updateFile->save();
    
                    }else{
                        $storeFile = new File();
                        $storeFile->admission_id = $admission->id;
                        $storeFile->doctype = $key;
                        $storeFile->url_file  = str_replace('public','storage',$value->storeAs('/public/documentos/' . $admission->nome, $nameFile));
                        $storeFile->save();
                    }
                }
            }elseif($key == 'horario'){
                $exist = \DB::table('schedules')->where('admission_id', $admission->id)->count();
                if($exist > 0){
                    foreach ($value as $key => $h) {
                        $schedules_id = \DB::table('schedules')
                        ->select('id')
                        ->where(['admission_id'=> $admission->id,'dia_semana'=> $key])->first();
                        $Schedules = Schedules::find($schedules_id->id);
                        $Schedules->h_entrada_manha = (!isset($h['entradaManha'][0])) ? '' : $h['entradaManha'][0];
                        $Schedules->h_saida_manha   = (!isset($h['saidaManha'][0])) ? '' : $h['saidaManha'][0];
                        $Schedules->h_entrada_tarde = (!isset($h['entradaTarde'][0])) ? '' : $h['entradaTarde'][0] ;
                        $Schedules->h_saida_tarde   = (!isset($h['saidaTarde'][0])) ? '' : $h['saidaTarde'][0];
                        $Schedules->h_entrada_noite = (!isset($h['entradaNoite'][0])) ? '' : $h['entradaNoite'][0];
                        $Schedules->h_saida_noite   = (!isset($h['saidaNoite'][0])) ? '' : $h['entradaNoite'][0];
                        $Schedules->folga           = 'off';
                        if(isset($h['folga'][0]))
                           $Schedules->folga           = $h['folga'][0];

                        $Schedules->save();
                    }
                }else{
                    foreach ($value as $key => $h) {
                        $Schedules = new Schedules();
                        $Schedules->admission_id    = $admission->id;
                        $Schedules->dia_semana      = $key;
                        $Schedules->h_entrada_manha = (!isset($h['entradaManha'][0])) ? '' : $h['entradaManha'][0];
                        $Schedules->h_saida_manha   = (!isset($h['saidaManha'][0])) ? '' : $h['saidaManha'][0];
                        $Schedules->h_entrada_tarde = (!isset($h['entradaTarde'][0])) ? '' : $h['entradaTarde'][0] ;
                        $Schedules->h_saida_tarde   = (!isset($h['saidaTarde'][0])) ? '' : $h['saidaTarde'][0];
                        $Schedules->h_entrada_noite = (!isset($h['entradaNoite'][0])) ? '' : $h['entradaNoite'][0];
                        $Schedules->h_saida_noite   = (!isset($h['saidaNoite'][0])) ? '' : $h['entradaNoite'][0];
                        $Schedules->folga           = 'off';
                        if(isset($h['folga'][0]))
                           $Schedules->folga           = $h['folga'][0];

                        $Schedules->save();
                    }
                }
            }
        }

        event(new AdmissionProcessed($admission));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function show(Admission $admission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function edit(Admission $admission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admission $admission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admission $admission)
    {
        //
    }

    public function print($admission_id)
    {
        $diasSemana = ['Segunda','Terçã','Quarta','Quinta','Sexta','Sábado','Domingo'];

        $files = $this->get_Files($admission_id);

        $schedules = $this->get_schedules($admission_id);

        $admission = \DB::table('admissions')
        ->select(
            'admissions.*',
            'companies.razao_social'
        )
        ->join('companies','admissions.companies_id','=','companies.id')
        ->where('admissions.id',$admission_id)
        ->first();


        return  \PDF::loadView('front.imprimir',[
                'dias'=> $diasSemana,
                'admission'=>$admission,
                'schedules' => $schedules,
                'files' => $files
            ])
        ->setPaper('a4', 'portrait')
        // ->save('admissao.pdf')
        ->download('admissao.pdf');
    }
}
