<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\companies;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Schedules;
use PDF;
use App\Events\AdmissionProcessed;
use App\Models\Child;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($admission_id,$etapa)
    {
        $diasSemana = ['Segunda','Terçã','Quarta','Quinta','Sexta','Sábado','Domingo'];
        
        $files = $this->get_Files($admission_id);

        $filesChild = $this->get_Child($admission_id);

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
            'schedules' => $schedules,
            'etapa' => $etapa,
            'child' => $filesChild
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

    public function get_Child($admission_id){
        $files = \DB::table('files')
        ->select(
            'files.*',
            'children.*'
        )
        ->join('children','files.parent','=','children.id')
        ->where(['files.admission_id'=>$admission_id,'files.doctype' => 'cert_de_nascimento'])->get();
        $NomaliseFile = [];
        foreach ($files as $key => $value) {
            $NomaliseFile[$value->doctype][] = [
                'id'  => $value->id,
                'url' => $value->url_file,
                'child' => $value->parent,
                'name' => $value->name,
                'dt_nascimento' => $value->dt_nascimento,
                'cpf' => $value->cpf,
                'admission_id' => $value->admission_id
            ];
        }

        return $NomaliseFile;
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
    public function store(Request $request,$id,$etapa)
    {
        $data = $request->all();

        $admission = Admission::find($id);

        if($etapa == 1){

            if(is_null($data['dt_admissao'])){
                return response()->json([
                    'success' => false,
                    'title' => 'Atenção',
                    'text' => 'Informe a data de admissão!',
                ],500);
            }elseif(is_null($data['cargo'])){
                return response()->json([
                    'success' => false,
                    'title' => 'Atenção',
                    'text' => 'Informe o cargo!',
                ],500);
            }elseif(is_null($data['salario'])){
                return response()->json([
                    'success' => false,
                    'title' => 'Atenção',
                    'text' => 'Informe o salário!',
                ],500);
            }if($data['experiencia_dias'] == 0){
                return response()->json([
                    'success' => false,
                    'title' => 'Atenção',
                    'text' => 'Informe a experiência em dias!',
                ],500);
            }if(is_null($data['modalidade'])){
                return response()->json([
                    'success' => false,
                    'title' => 'Atenção',
                    'text' => 'Informe a modalidade!',
                ],500);
            }

        }else{
            $request->validate([
                'nome' => 'required|max:255',
                'sexo' => 'required|max:255',
                'endereco' => 'required|max:255',
                'numero' => 'required|max:255',
                'complemento' => 'required|max:255',
                'bairro' => 'required|max:255',
                'estado' => 'required|max:255',
                'cep' => 'required|max:255',
                'nacionalidade' => 'required|max:255',
                'loca_nascimento' => 'required|max:255',
                'nascimento' => 'required|date',
                'tipo_deficiencia' => 'required|max:255',
                'cor' => 'required|max:255',
                'email' => 'required|max:255|email',
                'nome_pai' => 'required|max:255',
                'nome_mae' => 'required|max:255',
                'estado_civil' => 'required|max:255',
                'nome_esposa' => 'required|max:255',
                'esposa_nascimento' => 'required|max:255',
                'escolaridade' => 'required|max:255',
                'vale_transporte' => 'required|max:255',
                'vt_modalidade' => 'required|max:255',
                'vt_desconto' => 'required|max:255',
                'termo' => 'required|max:255',
            ]);

            $redirect = redirect()->back();
            if(is_null($request->doc['cedula_identidade']['text'])){
                    return $redirect->with([
                        'error'    => "DOCUMENTOS PESSOAIS - Identidade  é obrigatório!"
                    ]);
                }elseif(is_null($request->doc['cedula_identidade']['text'])){
                    return $redirect->with([
                        'error'    => "DOCUMENTOS PESSOAIS - CPF  é obrigatório!"
                    ]);
                }elseif(is_null($request->doc['cedula_identidade']['text'])){
                    return $redirect->with([
                        'error'    => "DOCUMENTOS PESSOAIS - Titulo de eleitor  é obrigatório!"
                    ]);
                }elseif(is_null($request->doc['cedula_identidade']['text'])){
                    return $redirect->with([
                        'error'    => "DOCUMENTOS PESSOAIS - Certidão reservista  é obrigatório!"
                    ]);
                }elseif(is_null($request->doc['cedula_identidade']['text'])){
                    return $redirect->with([
                        'error'    => "DOCUMENTOS PESSOAIS - PIS/PASEP  é obrigatório!"
                    ]);
                }
    
        }

        foreach ($data as $key => $value) {
            if(!in_array($key,['_token','horario','arquivo','doc','filhos'])){
                if($key == 'salario'){
                    $admission->$key = preg_replace('/[^0-9]/', '', $value);
                }else{
                    $admission->$key = $value;
                }
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
            }elseif($key == 'doc'){
                foreach ($data['doc'] as $key => $value) {
                    $admission->$key = (isset($value['text']) ? $value['text'] : '');
                    if(isset($value['primeiro_emprego'])){
                        $admission->primeiro_emprego = $value['primeiro_emprego'];
                    }else{
                        $admission->primeiro_emprego = 'nao';
                    }
                    $admission->save();
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
                        $Schedules->h_saida_noite   = (!isset($h['saidaNoite'][0])) ? '' : $h['saidaNoite'][0];
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
                        $Schedules->h_saida_noite   = (!isset($h['saidaNoite'][0])) ? '' : $h['saidaNoite'][0];

                        $Schedules->folga           = 'off';
                        if(isset($h['folga'][0]))
                           $Schedules->folga           = $h['folga'][0];

                        $Schedules->save();
                    }
                }
            }elseif($key == 'filhos'){
                for ($i=0; $i < count($data['filhos']['name']); $i++) { 
                      
                     $row = [
                        'name' => $data['filhos']['name'][$i],
                        'dt_nascimento' => $data['filhos']['dt_nascimento'][$i],
                        'cpf' => $data['filhos']['cpf'][$i],
                        'admission_id' => $admission->id
                     ];
                     
                     $exist = \DB::table('children')->where($row);

                     if($exist->count() == 0 ){
                        if(isset($data['filhos']['file'][$i])){
                            $filhos = Child::create($row);

                                $file = $data['filhos']['file'][$i];

                                $name = uniqid(date('HisYmd'));
                                $extension = $file->extension();
                                $nameFile = "{$name}.{$extension}";

                                $storeFile = new File();
                                $storeFile->admission_id = $admission->id;
                                $storeFile->parent = $filhos->id;
                                $storeFile->doctype = 'cert_de_nascimento';
                                $storeFile->url_file  = str_replace('public','storage',$file->storeAs('/public/documentos/' . $admission->nome, $nameFile));
                                $storeFile->save();
                        }else{
                            $redirect = redirect()->back();

                            return $redirect->with([
                                'error'    => "Certidão de nascimento dos filhos são obrigatorio!"
                            ]);
                
                        }
                    }else{

                        $filhos = $exist->first();
                        $filhos = Child::find($filhos->id);
                        $filhos->name = $data['filhos']['name'][$i];
                        $filhos->dt_nascimento = $data['filhos']['dt_nascimento'][$i];
                        $filhos->cpf = $data['filhos']['cpf'][$i];
                        $filhos->save();
                        
                    }
                }
            }
        }

        event(new AdmissionProcessed($admission));
        if($etapa == 1){
            return response()->json([
                'success' => true,
                'title' => 'Sucesso!',
                'text' => 'Admissão processada!',
                'icon' => 'success',
            ],200);
        }else{
            $redirect = redirect()->back();

            return $redirect->with([
                'message'    => "Admissão completada com sucesso!"
            ]);
        }
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
