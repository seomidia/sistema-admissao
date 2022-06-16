@extends('layouts.master')
@section('content')

@if(isset($admission->id))

<form method="POST" action="{{Route('admission-form.store',$admission->id)}}" enctype="multipart/form-data">
    @csrf

  <div class="container">

      <div class="row justify-content-center">

        <div class="col-md-9 my-4 py-2 px-3 boder-cinza bg-cinza">
            <fieldset class="py-2 px-2">
                <legend class="py-1 px-1 boder-cinza">EMPRESA/RAZÃO SOCIAL</legend>
                <input type="text" disabled class="form-control my-2" value="{{$admission->razao_social}}">
            </fieldset>
        </div>
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

                        <div class="duc-upload col-md-12 boder-botton-cinza">
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
                        </div>
                        <div class="duc-upload col-md-12 boder-botton-cinza">
                            <label for="ci" class="form-label">CÉDULA DE IDENTIDADE
                                @if(!isset($files['cedula_identidade']))
                                <a href="#" data-type="ci" class="btn btn-warning edit"><i class="icon-cloud-upload"></i></a>
                                @else 
                                <a href="#" data-type="ci" class="btn btn-warning edit"><i class="icon-edit"></i></a>
                                <a target="_blanck" href="{{url($files['cedula_identidade']['url'])}}" class="btn btn-primary open"><i class="icon-eye-open"></i></a>
                            @endif
                            </label>
                                <span class="ci" style="position: absolute;right: 89px;color: #320b9d"></span>
                                <input style="display:none" type="file" name="arquivo[cedula_identidade]" class="form-control" id="ci">
                        </div>
                        <div class="duc-upload col-md-12 boder-botton-cinza">
                            <label for="cpf" class="form-label">CPF
                                @if(!isset($files['cpf']))
                                <a href="#" data-type="cpf" class="btn btn-warning edit"><i class="icon-cloud-upload"></i></a>
                                @else 
                                <a href="#" data-type="cpf" class="btn btn-warning edit"><i class="icon-edit"></i></a>
                                <a target="_blanck" href="{{url($files['cpf']['url'])}}" class="btn btn-primary open"><i class="icon-eye-open"></i></a>
                                @endif
                            </label>
                                <span class="cpf" style="position: absolute;right: 89px;color: #320b9d"></span>
                                <input style="display:none" type="file" name="arquivo[cpf]" class="form-control" id="cpf">
                        </div>
                        <div class="duc-upload col-md-12 boder-botton-cinza">
                            <label for="te" class="form-label">TITULO DE ELEITOR
                                @if(!isset($files['titulo_eleitor']))
                                <a href="#" data-type="te" class="btn btn-warning edit"><i class="icon-cloud-upload"></i></a>
                                @else 
                                <a href="#" data-type="te" class="btn btn-warning edit"><i class="icon-edit"></i></a>
                                <a target="_blanck" href="{{url($files['titulo_eleitor']['url'])}}" class="btn btn-primary open"><i class="icon-eye-open"></i></a>
                                @endif
                            </label>
                                <span class="te" style="position: absolute;right: 89px;color: #320b9d"></span>
                                <input style="display:none" type="file" name="arquivo[titulo_eleitor]" class="form-control" id="te">
                        </div>
                        <div class="duc-upload col-md-12 boder-botton-cinza">
                            <label for="cr" class="form-label">CERT. DE RESERVISTA
                                @if(!isset($files['cert_reservista']))
                                <a href="#" data-type="cr" class="btn btn-warning edit"><i class="icon-cloud-upload"></i></a>
                                @else 
                                <a href="#" data-type="cr" class="btn btn-warning edit"><i class="icon-edit"></i></a>
                                <a target="_blanck" href="{{url($files['cert_reservista']['url'])}}" class="btn btn-primary open"><i class="icon-eye-open"></i></a>
                                @endif
                            </label>
                                <span class="cr" style="position: absolute;right: 89px;color: #320b9d"></span>
                                <input style="display:none" type="file" name="arquivo[cert_reservista]" class="form-control" id="cr">
                        </div>
                        <div class="duc-upload col-md-12 boder-botton-cinza">
                            <label for="pis" class="form-label">PIS/PASEP
                                @if(!isset($files['pis']))
                                <a href="#" data-type="pis" class="btn btn-warning edit"><i class="icon-cloud-upload"></i></a>
                                @else 
                                <a href="#" data-type="pis" class="btn btn-warning edit"><i class="icon-edit"></i></a>
                                <a target="_blanck" href="{{url($files['pis']['url'])}}" class="btn btn-primary open"><i class="icon-eye-open"></i></a>
                                @endif
                            </label>
                                <span class="pis" style="position: absolute;right: 89px;color: #320b9d"></span>
                                <input style="display:none" type="file" name="arquivo[pis]" class="form-control" id="pis">
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
                        <label for="esposanasc" class="form-label">Data de Nascimento</label>
                        <input type="date" name="esposa_nascimento" class="form-control" id="esposanasc" value="{{$admission->esposa_nascimento}}">
                    </div>

                </div>

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
        </div>
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
                        </thead>

                        <tbody>

                            @php 
                                function tirarAcentos($string){
                                    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
                                }
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
                                <td><input type="time" class="line-{{$key}}" name="horario[{{tirarAcentos(strtolower($item))}}][entradaManha][]" value="{{(count($schedules) > 0) ? $schedules[tirarAcentos(strtolower($item))]['h_entrada_manha'] : ''}}" @if($folga != 'off') disabled @endif></td>
                                <td><input type="time" class="line-{{$key}}" name="horario[{{tirarAcentos(strtolower($item))}}][saidaManha][]" value="{{(count($schedules) > 0) ? $schedules[tirarAcentos(strtolower($item))]['h_saida_manha'] : ''}}" @if($folga != 'off') disabled @endif></td>
                                <td><input type="time" class="line-{{$key}}" name="horario[{{tirarAcentos(strtolower($item))}}][entradaTarde][]" value="{{(count($schedules) > 0) ? $schedules[tirarAcentos(strtolower($item))]['h_entrada_tarde'] : ''}}" @if($folga != 'off') disabled @endif></td>
                                <td><input type="time" class="line-{{$key}}" name="horario[{{tirarAcentos(strtolower($item))}}][saidaTarde][]" value="{{(count($schedules) > 0) ? $schedules[tirarAcentos(strtolower($item))]['h_saida_tarde'] : ''}}" @if($folga != 'off') disabled @endif></td>
                                <td><input type="time" class="line-{{$key}}" name="horario[{{tirarAcentos(strtolower($item))}}][entradaNoite][]" value="{{(count($schedules) > 0) ? $schedules[tirarAcentos(strtolower($item))]['h_entrada_noite'] : ''}}" @if($folga != 'off') disabled @endif></td>
                                <td><input type="time" class="line-{{$key}}" name="horario[{{tirarAcentos(strtolower($item))}}][saidaNoite][]" value="{{(count($schedules) > 0) ? $schedules[tirarAcentos(strtolower($item))]['h_saida_noite'] : ''}}" @if($folga != 'off') disabled @endif></td>
                                <td><input type="checkbox" class="line-{{$key}}" data-line="line-{{$key}}" name="horario[{{tirarAcentos(strtolower($item))}}][folga][]" value="{{$folga}}" @if($folga != 'off') checked @endif></td>    
                            </tr>
                        @endforeach

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
                        </tfoot>
                    </table>
                </div>
            </fieldset>
            <p> <input type="checkbox" name="termo" @if($admission->termo == 'sim') checked @endif id="termo" value="sim"> <a target="_blanck" href="{{url('/TERMODECONSENTIMENTOPARATRATAMENTODEDADOSPESSOAIS.pdf')}}">Termo de Consentimento </a> para tratamento de dados. </p>
            <button class="btn btn-primary" type="submit">Enviar admissão</button>
        </div>
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
    }
    .duc-upload .btn{
        padding: 1px 9px !important;
    }
    .duc-upload .edit {
        position: absolute;
        right: 0;
    }
    .duc-upload .open {
        position: absolute;
        right: 41px;
        top: 0px;
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
        jQuery('input[type="file"]').change(function(){
            var filename = this.files[0].name;
            var id       = jQuery(this).attr('id');
            jQuery('.' + id).html(filename);
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
    })
</script>
@stop