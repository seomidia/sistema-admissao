@extends('layouts.master')
@section('content')

@if(isset($admission->id))

@if (session('message'))
    <div class="container">
        <div class="row justify-content-center">
            <div  class="col-md-9 my-3 alert alert-success">
                {{ session('message') }}
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="container">
        <div class="row justify-content-center">
            <div  class="col-md-9 my-3 alert alert-danger">
                {{ session('error') }}
            </div>
        </div>
    </div>
@endif

<form method="POST" action="{{url('/admissao/'.$admission->id.'/'.$etapa.'/solicitacao')}}" name="admissao" enctype="multipart/form-data">
    @csrf

  <div class="container">

      <div class="row justify-content-center">

        <div class="col-md-9 my-4 py-2 px-3 boder-cinza bg-cinza">
            <fieldset class="py-2 px-2">
                <legend class="py-1 px-1 boder-cinza">EMPRESA/RAZÃO SOCIAL</legend>
                <input type="text" disabled class="form-control my-2" value="{{$admission->razao_social}}">
            </fieldset>
        </div>

        @if($etapa == 1)
            <div class="col-md-9 mb-4 py-2 px-3 boder-cinza bg-cinza">
                <fieldset class="py-2 px-2">
                    <legend class="py-1 px-1 boder-cinza">PARA USO EXCLUSIVO DA EMPRESA</legend>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <label for="dataadmissao" class="form-label">DATA DE ADMISSÃO</label>
                            <input type="date" name="dt_admissao" class="form-control" id="dataadmissao" value="{{$admission->dt_admissao}}">
                        </div>

                        <div class="col-md-8">
                            <label for="cargo" class="form-label">CARGO/FUNÇÃO</label>
                            <input type="text" name="cargo" class="form-control" id="cargo" value="{{$admission->cargo}}">
                        </div>

                        <div class="col-md-4">
                            <label for="salario" class="form-label">SALÁRIO INICIAL </label>
                            <input type="text" name="salario" class="form-control" id="salario" value="{{$admission->salario}}">
                        </div>
                        <div class="col-md-4">
                            <label for="contratoexperienciadias" class="form-label">EXPERIÊNCIA EM DIAS</label>
                            <select name="experiencia_dias" id="contratoexperienciadias" class="form-control">
                                <option value="">Selecione</option>
                                <option value="30" @if($admission->experiencia_dias == '30') selected @endif>30 dias</option>
                                <option value="30&30" @if($admission->experiencia_dias == '30&30') selected @endif>30/30 dias</option>
                                <option value="60" @if($admission->experiencia_dias == '60') selected @endif>60 dias</option>
                                <option value="45" @if($admission->experiencia_dias == '45') selected @endif>45 dias</option>
                                <option value="45&45" @if($admission->experiencia_dias == '45&45') selected @endif>45/45 dias</option>
                                <option value="0" @if($admission->experiencia_dias == '0') selected @endif>NENHUMA DAS ALTERNATIVAS</option>
                            </select>
                        </div>

                        <div class="col-md-3">

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="modalidade" value="mensalista" id="mensalista"  @if($admission->modalidade == 'mensalista') checked @endif>
                            <label class="form-check-label" for="mensalista">
                                MENSALISTA
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="modalidade" value="horista" id="horista" @if($admission->modalidade == 'horista') checked @endif>
                            <label class="form-check-label" for="horista">
                                HORISTA
                            </label>
                        </div>
                        </div>
                        </div>
                </fieldset>
            </div>
            <div class="col-md-9 mb-4 py-2 px-3 boder-cinza bg-cinza horario">
                <fieldset class="py-2 px-2">
                    <legend class="py-1 px-1 boder-cinza">HORÁRIO DE TRABALHO</legend>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <th>Dias da semana</th>
                                <th>Entrada manhã</th>
                                <th>Saida manhã</th>
                                <th>Entrada Tarde</th>
                                <th>Saida Tarde</th>
                                <th>Entrada noite</th>
                                <th>Saida noite</th>
                                <th>Folgar</th>
                                <th>Total dia</th>
                            </thead>

                            <tbody>

                                @php 
                                    function tirarAcentos($string){
                                        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
                                    }

                                    $horasemana = [];
                                    $horadia    = 0;

                                @endphp

                            @foreach ($dias as $key => $item)
                            @php 
                                if(count($schedules) > 0){
                                $folga = $schedules[tirarAcentos(strtolower($item))]['folga'];
                                }else{
                                    $folga = 'off';
                                }
                            @endphp
                                <tr id="line-{{$key}}">
                                    <td>{{$item}}</td>
                                    <td class=""><input type="time" class="coluna-1 line-{{$key}} entradaManha" name="horario[{{tirarAcentos(strtolower($item))}}][entradaManha][]" value="{{(count($schedules) > 0) ? $schedules[tirarAcentos(strtolower($item))]['h_entrada_manha'] : ''}}" @if($folga != 'off') disabled @endif></td>
                                    <td class=""><input type="time" class="coluna-2 line-{{$key}} saidaManha" name="horario[{{tirarAcentos(strtolower($item))}}][saidaManha][]" value="{{(count($schedules) > 0) ? $schedules[tirarAcentos(strtolower($item))]['h_saida_manha'] : ''}}" @if($folga != 'off') disabled @endif></td>
                                    <td class=""><input type="time" class="coluna-3 line-{{$key}} entradaTarde" name="horario[{{tirarAcentos(strtolower($item))}}][entradaTarde][]" value="{{(count($schedules) > 0) ? $schedules[tirarAcentos(strtolower($item))]['h_entrada_tarde'] : ''}}" @if($folga != 'off') disabled @endif></td>
                                    <td class=""><input type="time" class="coluna-4 line-{{$key}} saidaTarde" name="horario[{{tirarAcentos(strtolower($item))}}][saidaTarde][]" value="{{(count($schedules) > 0) ? $schedules[tirarAcentos(strtolower($item))]['h_saida_tarde'] : ''}}" @if($folga != 'off') disabled @endif></td>
                                    <td class=""><input type="time" class="coluna-5 line-{{$key}} entradaNoite" name="horario[{{tirarAcentos(strtolower($item))}}][entradaNoite][]" value="{{(count($schedules) > 0) ? $schedules[tirarAcentos(strtolower($item))]['h_entrada_noite'] : ''}}" @if($folga != 'off') disabled @endif></td>
                                    <td class=""><input type="time" class="coluna-6 line-{{$key}} saidaNoite" name="horario[{{tirarAcentos(strtolower($item))}}][saidaNoite][]" value="{{(count($schedules) > 0) ? $schedules[tirarAcentos(strtolower($item))]['h_saida_noite'] : ''}}" @if($folga != 'off') disabled @endif></td>
                                    <td><input type="checkbox" class="line-{{$key}}" data-line="line-{{$key}}" name="horario[{{tirarAcentos(strtolower($item))}}][folga][]" value="{{$folga}}" @if($folga != 'off') checked @endif></td>    
                                    <td class="totaldia">
                                        @php 

                                        $entradaManha = strtotime($schedules[tirarAcentos(strtolower($item))]['h_entrada_manha']);
                                        $saidaManha   = strtotime($schedules[tirarAcentos(strtolower($item))]['h_saida_manha']);
                                        $entradatarde = strtotime($schedules[tirarAcentos(strtolower($item))]['h_entrada_tarde']);
                                        $saidatarde   = strtotime($schedules[tirarAcentos(strtolower($item))]['h_saida_tarde']);
                                        $entradanoite = strtotime($schedules[tirarAcentos(strtolower($item))]['h_entrada_noite']);
                                        $saidanoite   = strtotime($schedules[tirarAcentos(strtolower($item))]['h_saida_noite']);
                                        $totaldia = ($saidaManha - $entradaManha) + ($saidatarde - $entradatarde) + ($saidanoite - $entradanoite);
                                        $horas    = date('H:i', $totaldia);

                                        echo $horas;

                                        @endphp
                                    </td>    
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td colspan="7" style="text-align: right">
                                    Total da semana
                                </td>    
                                <td class="semanatotal"></td>    
                            </tr>


                            </tbody>

                            <tfoot>
                                <th>Dias da semana</th>
                                <th>Entrada manhã</th>
                                <th>Saida manhã</th>
                                <th>Entrada Tarde</th>
                                <th>Saida Tarde</th>
                                <th>Entrada noite</th>
                                <th>Saida noite</th>
                                <th>Folgar</th>
                                <th>Total dia</th>
                            </tfoot>
                        </table>
                    </div>
                </fieldset>
                <p> <input type="checkbox" name="termo" @if($admission->termo == 'sim') checked @endif id="termo" value="sim"> <a target="_blanck" href="{{url('/TERMODECONSENTIMENTOPARATRATAMENTODEDADOSPESSOAIS.pdf')}}">Termo de Consentimento </a> para tratamento de dados. </p>
                <button class="btn btn-primary" type="submit">Iniciar admissão</button>
            </div>
        @endif
        @if($etapa == 2)
            <div class="col-md-9 mb-4 py-2 px-3 boder-cinza bg-cinza">
                <fieldset class="py-2 px-2">
                    <legend class="py-1 px-1 boder-cinza">DADOS PESSOAIS DO FUNCIONÁRIO</legend>
                    
                    <div class="row">

                        <div class="col-md-8">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="{{$admission->nome}}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Sexo</label>
                            <select class="form-control" name="sexo">
                                <option value="">Selecione</option>
                                <option value="masculino" @if($admission->sexo == 'masculino') selected @endif>Masculino</option>
                                <option value="feminino" @if($admission->sexo == 'feminino') selected @endif >Feminino</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="endereco" class="form-label">ENDEREÇO</label>
                            <input type="text" class="form-control" id="endereco" name="endereco" value="{{$admission->endereco}}">
                        </div>
                        <div class="col-md-2">
                            <label for="numero" class="form-label">N.º</label>
                            <input type="text" class="form-control" id="numero" name="numero" value="{{$admission->numero}}">
                        </div>
                        <div class="col-md-4">
                            <label for="complemento" class="form-label">COMPLEMENTO</label>
                            <input type="text" class="form-control" id="complemento" name="complemento" value="{{$admission->complemento}}">
                        </div>

                        <div class="col-md-4">
                            <label for="bairro" class="form-label">BAIRRO</label>
                            <input type="text" class="form-control" id="bairro" name="bairro" value="{{$admission->bairro}}">
                        </div>
                        <div class="col-md-4">
                            <label for="cidade" class="form-label">CIDADE</label>
                            <input type="text" class="form-control" id="cidade" name="cidade" value="{{$admission->cidade}}">
                        </div>
                        <div class="col-md-4">
                            <label for="estado" class="form-label">ESTADO</label>
                            <input type="text" class="form-control" id="estado" name="estado" value="{{$admission->estado}}">
                        </div>
                        <div class="col-md-4">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="cep" name="cep" value="{{$admission->cep}}">
                        </div>

                        <div class="col-md-4">
                            <label for="nascionalidade" class="form-label">NACIONALIDADE</label>
                            <input type="text" class="form-control" id="nascionalidade" name="nacionalidade" value="{{$admission->nacionalidade}}">
                        </div>
                        <div class="col-md-4">
                            <label for="localnascimento" class="form-label">LOCAL DO NASCIMENTO</label>
                            <input type="text" class="form-control" id="localnascimento" name="loca_nascimento" value="{{$admission->loca_nascimento}}">
                        </div>
                        <div class="col-md-4">
                            <label for="datanascimento" class="form-label">DATA DO NASCIMENTO</label>
                            <input type="date" class="form-control" id="datanascimento" name="nascimento" value="{{$admission->nascimento}}">
                        </div>
                        <div class="col-md-4">
                            <label for="tipodeficiencia" class="form-label">TIPO DEFICIÊNCIA</label>
                            <input type="text" class="form-control" id="tipodeficiencia" name="tipo_deficiencia" value="{{$admission->tipo_deficiencia}}">
                        </div>

                        <div class="col-md-4">
                            <label for="cor" class="form-label">COR</label>
                            <input type="text" class="form-control" id="cor" name="cor" value="{{$admission->cor}}">
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="form-label">email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$admission->email}}">
                        </div>
                        <div class="col-md-4">
                            <label for="telefone" class="form-label">TELEFONE</label>
                            <input type="tel" class="form-control" id="telefone" name="fone" value="{{$admission->fone}}">
                        </div>
                        <div class="col-md-4">
                            <label for="celular" class="form-label">CELULAR</label>
                            <input type="text" class="form-control" id="celular" name="celular" value="{{$admission->celular}}">
                        </div>

                    </div>
                </fieldset>
            </div>
            <div class="col-md-9 mb-4 py-2 px-3 boder-cinza bg-cinza">
                <fieldset class="py-2 px-2">
                    <legend class="py-1 px-1 boder-cinza">DOCUMENTOS PESSOAIS</legend>
                    
                        <div class="row">

                            {{-- <div class="duc-upload col-md-12 boder-botton-cinza">
                                <label for="ct" class="form-label">CARTEIRA DE TRABALHO
                                    @if(!isset($files['carteira_trabalho']))
                                    <a href="#" data-type="ct" class="btn btn-warning edit"><i class="icon-cloud-upload"></i></a>
                                    @else 
                                        <a href="#" data-type="ct" class="btn btn-warning edit"><i class="icon-edit"></i></a>
                                        <a target="_blanck" href="{{url($files['carteira_trabalho']['url'])}}" class="btn btn-primary open"><i class="icon-eye-open"></i></a>
                                    @endif
                                </label>
                                    <span class="ct" style="position: absolute;right: 89px;color: #320b9d"></span>
                                    <input style="display:none" type="file" name="arquivo[carteira_trabalho]" class="form-control" id="ct">
                            </div> --}}
                            <div class="duc-upload col-md-12 boder-botton-cinza">
                                <label for="ci" class="form-label">CÉDULA DE IDENTIDADE
                                    @if(!isset($files['cedula_identidade']))
                                        <a href="#" data-type="ci" class="btn btn-warning edit"><i class="icon-cloud-upload"></i></a>
                                        @else 
                                        <a href="#" data-type="ci" class="btn btn-warning edit"><i class="icon-edit"></i></a>
                                        <a target="_blanck" href="{{url($files['cedula_identidade']['url'])}}" class="btn btn-primary open"><i class="icon-eye-open"></i></a>
                                    @endif
                                </label><br>
                                    <span class="ci" style="position: absolute;right: 89px;color: #320b9d"></span>
                                    <input style="display:none" type="file" name="arquivo[cedula_identidade]" class="form-control" id="ci">
                                    <input type="text" placeholder="numero cédula Identidade"  class="ci" name="doc[cedula_identidade][text]" value="{{$admission->cedula_identidade}}">                          
                            </div>
                            <div class="duc-upload col-md-12 boder-botton-cinza">
                                <label for="cpf" class="form-label">CPF
                                    @if(!isset($files['cpf']))
                                    <a href="#" data-type="cpf" class="btn btn-warning edit"><i class="icon-cloud-upload"></i></a>
                                    @else 
                                    <a href="#" data-type="cpf" class="btn btn-warning edit"><i class="icon-edit"></i></a>
                                    <a target="_blanck" href="{{url($files['cpf']['url'])}}" class="btn btn-primary open"><i class="icon-eye-open"></i></a>
                                    @endif
                                </label><br>
                                    <span class="cpf" style="position: absolute;right: 89px;color: #320b9d"></span>
                                    <input style="display:none" type="file" name="arquivo[cpf]" class="form-control" id="cpf">
                                    <input type="text" placeholder="numero CPF" class="cpf" name="doc[cpf][text]" value="{{$admission->cpf}}">
                            </div>
                            <div class="duc-upload col-md-12 boder-botton-cinza">
                                <label for="te" class="form-label">TITULO DE ELEITOR
                                    @if(!isset($files['titulo_eleitor']))
                                    <a href="#" data-type="te" class="btn btn-warning edit"><i class="icon-cloud-upload"></i></a>
                                    @else 
                                    <a href="#" data-type="te" class="btn btn-warning edit"><i class="icon-edit"></i></a>
                                    <a target="_blanck" href="{{url($files['titulo_eleitor']['url'])}}" class="btn btn-primary open"><i class="icon-eye-open"></i></a>
                                    @endif
                                </label><br>
                                    <span class="te" style="position: absolute;right: 89px;color: #320b9d"></span>
                                    <input style="display:none" type="file" name="arquivo[titulo_eleitor]" class="form-control" id="te">
                                    <input type="text" placeholder="numero titulo eleitor" class="te" name="doc[titulo_eleitor][text]" value="{{$admission->titulo_eleitor}}">
                            </div>
                            <div class="duc-upload col-md-12 boder-botton-cinza">
                                <label for="cr" class="form-label">CERT. DE RESERVISTA
                                    @if(!isset($files['cert_reservista']))
                                    <a href="#" data-type="cr" class="btn btn-warning edit"><i class="icon-cloud-upload"></i></a>
                                    @else 
                                    <a href="#" data-type="cr" class="btn btn-warning edit"><i class="icon-edit"></i></a>
                                    <a target="_blanck" href="{{url($files['cert_reservista']['url'])}}" class="btn btn-primary open"><i class="icon-eye-open"></i></a>
                                    @endif
                                </label><br>
                                    <span class="cr" style="position: absolute;right: 89px;color: #320b9d"></span>
                                    <input style="display:none" type="file" name="arquivo[cert_reservista]" class="form-control" id="cr">
                                    <input type="text" placeholder="numero cert. de  reservista" class="cr" name="doc[cert_reservista][text]" value="{{$admission->cert_reservista}}">
                            </div>
                            <div class="duc-upload col-md-12 boder-botton-cinza">
                                <label for="pis" class="form-label">PIS/PASEP
                                    @if(!isset($files['pis']))
                                    <a href="#" data-type="pis" class="btn btn-warning edit"><i class="icon-cloud-upload"></i></a>
                                    @else 
                                    <a href="#" data-type="pis" class="btn btn-warning edit"><i class="icon-edit"></i></a>
                                    <a target="_blanck" href="{{url($files['pis']['url'])}}" class="btn btn-primary open"><i class="icon-eye-open"></i></a>
                                    @endif
                                </label><br>
                                    <span class="pis" style="position: absolute;right: 89px;color: #320b9d"></span>
                                    <input style="display:none" type="file" name="arquivo[pis]" class="form-control" id="pis">
                                    <input type="text" placeholder="numero PIS" name="doc[pis][text]" value="{{$admission->pis}}"><br>
                                    <input type="checkbox" class="pis"  name="doc[pis][primeiro_emprego]" @if($admission->primeiro_emprego =='sim') checked @endif value="sim"> Primeiro emprego

                            </div>
                        </div>
                </fieldset>
            </div>
            <div class="col-md-9 mb-4 py-2 px-3 boder-cinza bg-cinza">
                <fieldset class="py-2 px-2">
                    <legend class="py-1 px-1 boder-cinza">DADOS FAMILIARES</legend>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <label for="pai" class="form-label">NOME DO PAI</label>
                            <input type="text" name="nome_pai" class="form-control" id="pai" value="{{$admission->nome_pai}}">
                        </div>
                        <div class="col-md-6">
                            <label for="mae" class="form-label">NOME DA MÃE</label>
                            <input type="text" name="nome_mae" class="form-control" id="mae" value="{{$admission->nome_mae}}">
                        </div>
                        <div class="col-md-6">
                            <label for="estadocivil" class="form-label">ESTADO CIVIL</label>
                            <select name="estado_civil" id="estadocivil" class="form-control">
                                <option value="">Selecione</option>
                                <option value="solteiro" @if($admission->estado_civil == 'solteiro') selected @endif>SOLTEIRO</option>
                                <option value="casado" @if($admission->estado_civil == 'casado') selected @endif>CASADO</option>
                                <option value="viuvo" @if($admission->estado_civil == 'viuvo') selected @endif>VIÚVO</option>
                                <option value="desquitado" @if($admission->estado_civil == 'desquitado') selected @endif>DESQUITADO</option>
                                <option value="amasiado" @if($admission->estado_civil == 'amasiado') selected @endif>AMASIADO</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="nomeesposa" class="form-label">Nome da Esposa (o)</label>
                            <input type="text" name="nome_esposa" class="form-control" id="nomeesposa" value="{{$admission->nome_esposa}}">
                        </div>
                        <div class="col-md-6">
                            <label for="esposanasc" class="form-label">Data de Nascimento Esposa (o)”</label>
                            <input type="date" name="esposa_nascimento" class="form-control" id="esposanasc" value="{{$admission->esposa_nascimento}}">
                        </div>

                    </div>

                </fieldset>
            </div>
            <div id="filhos" class="col-md-9 mb-4 py-2 px-3 boder-cinza bg-cinza">
                <fieldset class="py-2 px-2">
                    <legend class="py-1 px-1 boder-cinza">FILHOS</legend>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <th>Nome</th>
                                <th>Data de Nascimento</th>
                                <th>CPF</th>
                                <th>Cert. de nascimento</th>
                                <th><a href="#" class="btn btn-warning clone">Novo</a></th>
                            </thead>

                            <tbody id="content">
                                @if(count($child) > 0)
                                        @foreach ($child['cert_de_nascimento'] as $item)
                                        <tr>
                                            <td><input type="text" class="form-control" name="filhos[name][]" disabled  value="{{$item['name']}}" /></td>
                                            <td><input type="text" class="form-control" name="filhos[dt_nascimento][]" disabled value="{{$item['dt_nascimento']}}" /></td>
                                            <td><input type="text" class="form-control" name="filhos[cpf][]" value="{{$item['cpf']}}" disabled /></td>
                                            <td><a target="_blanck" href="{{url($item['url'])}}"><i class="icon-file" style="margin-right: 10px;"></i>Certidao</a></td>
                                            <td><a href="{{$item['id']}}" class="btn btn-danger remove">x</a></td>
                                        </tr>
                                        @endforeach

                                @endif
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                </fieldset>
            </div>
            <div class="col-md-9 mb-4 py-2 px-3 boder-cinza bg-cinza">
                <fieldset class="py-2 px-2">
                    <legend class="py-1 px-1 boder-cinza">GRAU DE INSTRUÇÃO</legend>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="escolaridade" class="form-label">Escolaridade</label>
                            <select name="escolaridade" id="escolaridade" class="form-control">
                                <option value="">Selecione</option>
                                <option value="analfabeto" @if($admission->escolaridade == 'amasiado') selected @endif>ANALFABETO</option>
                                <option value="primario incompleto" @if($admission->escolaridade == 'primario incompleto') selected @endif>PRIMÁRIO INCOMPLETO</option>
                                <option value="primario completo" @if($admission->escolaridade == 'primario completo') selected @endif>PRIMÁRIO COMPLETO </option>
                                <option value="ginasio incompleto" @if($admission->escolaridade == 'ginasio incompleto') selected @endif>GINÁSIO INCOMPLETO </option>
                                <option value="ginasio completo" @if($admission->escolaridade == 'ginasio completo') selected @endif>GINÁSIO COMPLETO </option>
                                <option value="colegial incompleto" @if($admission->escolaridade == 'colegial incompleto') selected @endif>COLEGIAL INCOMPLETO</option>
                                <option value="colegial completo" @if($admission->escolaridade == 'colegial completo') selected @endif>COLEGIAL COMPLETO  </option>
                                <option value="superior incompleto" @if($admission->escolaridade == 'superior incompleto') selected @endif>SUPERIOR INCOMPLETO </option>
                                <option value="superior completo" @if($admission->escolaridade == 'superior completo') selected @endif>SUPERIOR COMPLETO  </option>
                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-md-9 mb-4 py-2 px-3 boder-cinza bg-cinza">
                <fieldset class="py-2 px-2">
                    <legend class="py-1 px-1 boder-cinza">VALE TRANSPORTE</legend>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <label for="vt" class="form-label">O FUNCIONÁRIO DESEJA VALE TRANSPORTE?</label>
                            <select name="vale_transporte" id="vt" class="form-control">
                                <option value="">Selecione</option>
                                <option value="1" @if($admission->vale_transporte == 1) selected @endif>Sim</option>
                                <option value="0" @if($admission->vale_transporte == 0) selected @endif >Não</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="vt" class="form-label">DESCREVER QUANTAS CONDUÇÕES (ÔNIBUS) SERÃO UTILIZADAS PARA:</label>
                            <div class="form-check">
                                <input class="form-check-input" name="vt_modalidade" type="radio" value="casa&trabalo&ida&ou&volta" id="iraotrabalho" @if($admission->vt_modalidade == 'casa&trabalo&ida&ou&volta') checked @endif>
                                <label class="form-check-label" for="iraotrabalho">
                                    Casa para trabalho Ida ou volta
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="vt_modalidade" value="casa&trabalo&ida&e&volta" id="irpracasa" @if($admission->vt_modalidade == 'casa&trabalo&ida&e&volta') checked @endif>
                                <label class="form-check-label" for="irpracasa">
                                    Casa para trabalho Ida e volta
                                </label>
                            </div>
                            <div class="form-check" style="padding-left: 0;">
                                <input type="number" id="desconto" min="0" step="0.1" style="width: 70px;" name="vt_desconto" value="{{$admission->vt_desconto}}">
                                <label class="form-check-label" for="desconto">
                                    DESCONTAR % DO FUNCIONÁRIO.
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <button class="btn btn-primary" type="submit">Enviar admissão</button>
            </div>
        @endif
    </div>
  </div>
</form>

@else 
   <div class="container">
       <div class="row">
           <div class="col-md-12 text-center my-5">
              <p class="alert alert-danger"> Admissão não existe! </p>
           </div>
       </div>
   </div>
@endif

@endsection

@section('header_css')

<style>
    .bg-cinza{
        background: #f2f2f2
    }
    .boder-cinza{
        border: 1px solid #dddddd
    }
    .boder-botton-cinza{
        border-bottom: 1px solid #dddddd
    }
    fieldset{
        position: relative;
    }
    fieldset legend{
        font-size: 12px;
        width: auto;
        position: absolute;
        top: -22px;
        background: #fff;
        border-radius: 3px;
        font-weight: bold
    }
    .duc-upload{
        position: relative;
        padding-bottom: 5px
    }
    .duc-upload .btn{
        padding: 1px 9px !important;
    }
    .duc-upload .edit {
        position: absolute;
        right: 0;
        top: 17px;
    }
    .duc-upload .open {
        position: absolute;
        right: 41px;
        top: 17px;
    }
</style>

@stop

@section('header_js')

@stop

@section('footer_css')

@stop

@section('footer_js')
<script>
    jQuery(document).ready(function(){
        jQuery("#cep").mask("9999-9999");
        jQuery("#telefone").mask("(99) 9999-9999");
        jQuery("#celular").mask("(99) 9 9999-9999");
        jQuery("input.cpf").mask("999.999.999-99");
        jQuery('input[type="file"]').change(function(){
            var filename = this.files[0].name;
            var id       = jQuery(this).attr('id');
            jQuery('span.' + id).html(filename);
        })
        jQuery('a.edit').click(function(event){
            event.preventDefault();
            var id = this.dataset.type;
            jQuery('input#' + id).trigger('click');
        })
        jQuery('.horario fieldset input[type="checkbox"]').change(function(){
            var classe = jQuery(this)[0].dataset.line;

            var n = jQuery('.horario '+'input.' + classe+':checked').length;

            if(n == 0){
                jQuery(this).val('off');
                jQuery('tr#'+classe+' input[type="time"]').removeAttr('disabled');

            }else{

                var name = jQuery(this).attr('name');
                
                name = name.replace('horario[','');
                name = name.replace('][folga][]','');


                jQuery('tr#'+classe+' input[type="time"]').attr('disabled','');
                jQuery('tr#'+classe+' input[type="time"]').val('');

                jQuery(this).val( 'folgar ' +name );
            }
    
        })
        @if($etapa == 1)
        jQuery('form[name="admissao"]').submit(function(event) {
            event.preventDefault();
            var dados  = jQuery(this).serialize();
            var action =  jQuery(this).attr('action');
            var path     = window.location.pathname.replace('1/solicitacao','2/solicitacao');
            var url    = window.location.origin + path;

            swal.fire({
                title: 'Processando admissão.'
            });
            swal.showLoading();

            jQuery.ajax({
                url: action,
                type:"post",
                dataType: "json",
                data: dados,
                success: function(response){
                    swal.close();
                    swal.fire({
                            title: response.title,
                            text: response.text,
                            icon: response.icon,
                            showCancelButton: true,
                            confirmButtonText: 'Copiar link!',
                            cancelButtonText: 'Fechar!',

                    }).then((result) => {
                        if(result.isConfirmed){
                            setTimeout(function(){
                                jQuery('input.swal2-input').attr('id','link-copy')
                                jQuery('button.swal2-confirm').attr('onclick','myFunction()')
                            },1000)
                            Swal.fire({
                                title: 'Link do funcionário',
                                input: 'text',
                                inputValue: url,
                                confirmButtonText: 'Copiar!',
                            }).then((result) => {
                                console.log(result);
                            })
                        }else{
                            window.location.href = window.location.origin + window.location.pathname;
                        }
                    });

                }
            })
        });
        @endif

        var total = jQuery('input[name="doc[pis][primeiro_emprego]"]:checked').length;
            
            if(total == 1){
                jQuery('input[name="doc[pis][text]"]').prop('disabled',true);
                jQuery('input[name="doc[pis][text]"]').val('');
            }else{
                jQuery('input[name="doc[pis][text]"]').attr('disabled',false);
            }


        jQuery('input[name="doc[pis][primeiro_emprego]"]').change(function(){
            var total = jQuery('input[name="doc[pis][primeiro_emprego]"]:checked').length;
            
            if(total == 1){
                jQuery('input[name="doc[pis][text]"]').prop('disabled',true);
                jQuery('input[name="doc[pis][text]"]').val('Não informado');
            }else{
                jQuery('input[name="doc[pis][text]"]').attr('disabled',false);
            }
        })

            // var trload = jQuery('table tbody#content tr a.remove')[0];
            // jQuery( trload ).hide();
            showbtn_remove();
            setTimeout(function(){
                btnremove();
            },1000)


        jQuery("a.clone").click(function(event){
            event.preventDefault();
            var html = ''+
           ' <tr>'+
                '<td><input type="text" class="form-control" name="filhos[name][]" value=""></td>'+
                '<td><input type="date" class="form-control" name="filhos[dt_nascimento][]" value=""></td>'+
                '<td><input type="text" class="form-control cpf" name="filhos[cpf][]" value=""></td>'+
                '<td><input type="file" class="form-control" name="filhos[file][]" value=""></td>'+
                '<td><a href="#" class="btn btn-danger remove">x</a></td>'+
            '</tr>';
            jQuery('table tbody#content').prepend(html);
            jQuery("#content tr td input.cpf").mask("999.999.999-99");

            showbtn_remove();
            setTimeout(function(){
                btnremove();
            },1000)
        });


        var line  = jQuery('table tr td.totaldia');
var total = line.length;
var hora  = '00:00:00';
for(var i = 0;i<total;i++){
  var h =  jQuery(line[i]).text().trim();
      h = h.split(':');
      h.push('00');
      h = h.join(':')
      hora = somartempos(hora,h) 
      
}

hora = hora.split(':');

jQuery('table tr td.semanatotal').html(hora[0] +':'+ hora[1]);
    })

    function showbtn_remove()
    {
        var btn = jQuery('a.remove');
        var total = btn.length;
            for(var i=0;i<total;i++){
                j = i + 1;
                jQuery(btn[i]).attr('id','line-' + j);
            }
    }

    function btnremove(){
        jQuery('a.remove').click(function(event){
            event.preventDefault();

            var chaid_id = jQuery(this).attr('href');

            var line = jQuery(this).attr('id').split('-')[1];
            jQuery(this.offsetParent.offsetParent.rows[line]).remove();
            removeDB(chaid_id);
            showbtn_remove()
        })
    }

    function removeDB(chaid_id){
        jQuery.ajax({
                url: window.location.origin + '/child/'+chaid_id+'/delete',
                type:"get",
                dataType: "json",
                data: {},
                success: function(response){
                    console.log(response);
                }
        })
    }

function copyToClipboard(text) {
    var sampleTextarea = document.createElement("textarea");
    document.body.appendChild(sampleTextarea);
    sampleTextarea.value = text; //save main text in it
    sampleTextarea.select(); //select textarea contenrs
    document.execCommand("copy");
    document.body.removeChild(sampleTextarea);
}

function myFunction(){
    var copyText = document.getElementById("link-copy");
    copyToClipboard(copyText.value);
    swal.close();
    Swal.fire({
        title:'Sucesso!',
        text: 'Link copiado!',
        icon:'success'
    }).then((result)=>{
        window.location.href = window.location.origin + window.location.pathname;
    })
}





 function somartempos(tempo1, tempo2) {

var array1 = tempo1.split(':');


var tempo_seg1 = (parseInt(array1[0]) * 3600) + (parseInt(array1[1]) * 60) + parseInt(array1[2]);

var array2 = tempo2.split(':');

var tempo_seg2 = (parseInt(array2[0]) * 3600) + (parseInt(array2[1]) * 60) + parseInt(array2[2]);

var tempofinal = parseInt(tempo_seg1) + parseInt(tempo_seg2);

var hours = Math.floor(tempofinal / (60 * 60));

var divisorMinutos = tempofinal % (60 * 60);

var minutes = Math.floor(divisorMinutos / 60);

var divisorSeconds = divisorMinutos % 60;

var seconds = Math.ceil(divisorSeconds);

var contador = "";

if (hours < 10) { contador = "0" + hours + ":"; } else { contador = hours + ":"; }

if (minutes < 10) { contador += "0" + minutes + ":"; } else { contador += minutes + ":"; }

if (seconds < 10) { contador += "0" + seconds; } else { contador += seconds; }

return contador;

}


</script>
@stop