<?php

namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerBaseController as BaseVoyagerBaseController;
use Illuminate\Http\Request;
use App\Models\Admission;
use App\Models\companies;

class VoyagerBaseController extends BaseVoyagerBaseController
{
    public function getSlug(Request $request)
    {
        if (isset($this->slug)) {
            $slug = $this->slug;
        } else {
            $slug = explode('.', $request->route()->getName())[1];
        }

        return $slug;
    }

    public function store(Request $request)
    {
         $slug = $this->getSlug($request);

        if($slug == 'admissions'){

            $company = companies::find($request->companies_id);

            $admission = new Admission();
            $admission->companies_id = $request->companies_id;
            $admission->cnpj = $company->cnpj;
            $admission->razao_social = $company->razao_social;
            $admission->nome_fantasia = $company->nome_fantasia;
            $admission->user_id = \Auth()->user()->id;
            
            if ($admission->save()) {
                $redirect = redirect()->route("voyager.admissions.index");
            } else {
                $redirect = redirect()->back();
            }

            return $redirect->with([
                'message'    => "Admissão cadastrada com sucesso!",
                'alert-type' => 'success',
            ]);
        }

        if($slug == 'empresas'){
            $data = $request->all();
            unset($data['_token']);
            $data['user_id'] = \Auth()->user()->id;
            // \DB::table('companies')->insert($data);
            
            if (\DB::table('companies')->insert($data)) {
                $redirect = redirect()->route("voyager.empresas.index");
            } else {
                $redirect = redirect()->back();
            }

            return $redirect->with([
                'message'    => "Empresa cadastrada com sucesso!",
                'alert-type' => 'success',
            ]);
        }
    }
}
