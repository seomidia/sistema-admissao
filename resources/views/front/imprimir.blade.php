<html>
<head>
    <title></title>
    <style>
        body{
            background: #ffffff;
            font-family:'sans-serif';
        }
        #total{
            width: 700px;
            border:1px solid #000000;
            margin-bottom: 55px;
            background: #ffffff;
        }
        td.title{
            background: #f2f2f2;
        }

        label {
            font-size: 13px;
            font-weight: 500;
            padding: 5px;
        }
        td {
            font-size: 13px;
            font-weight: normal;
            padding: 5px;
            border: 1px solid #dddddd
            
        }
        .linha{
            border-top: 1px solid #000;
            height: 30px;
        }
        .linha span{ 
            border-left: 1px solid #000;
            padding: 10px
        }
    </style>
</head>
<body>
<div id="total">
    <div id="topo">
        <div id="row" style="float: left; width:100%">
            <img width="150" src="data:image/png;base64,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">
        </div>
    </div>
    <div style="clear: both"></div>
    <table style="width: 100%">
        <tr>
            <td class="title" colspan="3" style="text-align: center;">EMPRESA/RAZÃO SOCIAL</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;">{{$admission->razao_social}}</td>
        </tr>
        <tr>
            <td  colspan="2"><label for="">Nome</label> <br>{{$admission->nome}}</td>
            <td><label for="">Sexo</label> <br>{{$admission->sexo}}</td>
        </tr>
        <tr>
            <td><label for="">ENDEREÇO</label> <br>{{$admission->endereco}}</td>
            <td><label for="">N.º</label> <br>{{$admission->numero}}</td>
            <td><label for="">COMPLEMENTO</label> <br>{{$admission->complemento}}</td>
        </tr>
        <tr>
            <td><label for="">BAIRRO</label> <br>{{$admission->bairro}}</td>
            <td><label for="">CIDADE</label> <br>{{$admission->cidade}}</td>
            <td><label for="">ESTADO</label> <br>{{$admission->estado}}</td>
        </tr>

        <tr>
            <td><label for="">CEP</label> <br>{{$admission->cep}}</td>
            <td><label for="">NACIONALIDADE</label> <br>{{$admission->nacionalidade}}</td>
            <td><label for="">LOCAL DO NASCIMENTO</label> <br>{{$admission->loca_nascimento}}</td>
        </tr>


        <tr>
            <td><label for="">DATA DO NASCIMENTO</label> <br>{{date('d/m/Y',strtotime($admission->nascimento))}}</td>
            <td><label for="">TIPO DEFICIÊNCIA</label> <br>{{$admission->tipo_deficiencia}}</td>
            <td><label for="">COR</label> <br>{{$admission->cor}}</td>
        </tr>

        <tr>
            <td><label for="">E-mail</label> <br>{{$admission->email}}</td>
            <td><label for="">TELEFONE</label> <br>{{$admission->fone}}</td>
            <td><label for="">CELULAR</label> <br>{{$admission->celular}}</td>
        </tr>

        <tr>
            <td class="title" colspan="3" style="text-align: center;">DOCUMENTOS PESSOAIS (anexos)</td>
        </tr>
        {{-- <tr>
            <td colspan="3"><a target="_blanck" href="{{url($files['carteira_trabalho']['url'])}}" class="btn btn-primary open"><label for="">CARTEIRA DE TRABALHO </label> </a></td>
        </tr> --}}
        @if(isset($files['cedula_identidade']))
        <tr>
            <td colspan="2"><a target="_blanck" href="{{url($files['cedula_identidade']['url'])}}" class="btn btn-primary open"><label for="">CÉDULA DE IDENTIDADE  </label> </a> </td>
            <td>{{$admission->cedula_identidade}}</td>
        </tr>
        @endif

        @if(isset($files['cpf']))
        <tr>
            <td colspan="2"><a target="_blanck" href="{{url($files['cpf']['url'])}}" class="btn btn-primary open"><label for="">CPF  </label> </a></td>
            <td>{{$admission->cpf}}</td>
        </tr>
        @endif

        @if(isset($files['titulo_eleitor']))
        <tr>
            <td colspan="2"><a target="_blanck" href="{{url($files['titulo_eleitor']['url'])}}" class="btn btn-primary open"><label for="">TITULO DE ELEITOR </label> </a> </td>
            <td>{{$admission->titulo_eleitor}}</td>
        </tr>
        @endif

        @if(isset($files['cert_reservista']))
        <tr>
            <td colspan="2"><a target="_blanck" href="{{url($files['cert_reservista']['url'])}}" class="btn btn-primary open"><label for="">CERT. DE RESERVISTA </label> </a> </td>
            <td>{{$admission->cert_reservista}}</td>
        </tr>
        @endif
        
        <tr>
            @if(isset($files['pis']))
            <td colspan="2"><a target="_blanck" href="{{url($files['pis']['url'])}}" class="btn btn-primary open"><label for="">PIS/PASEP </label> </a> </td>
            <td>{{$admission->pis}} @if($admission->primeiro_emprego =='sim') Primeiro emprego @endif</td>
            @else 
            @if(isset($admission->primeiro_emprego) && $admission->primeiro_emprego != '')
            <td colspan="2"><label for="">PIS/PASEP </label></td>
            <td>@if($admission->primeiro_emprego =='sim') Primeiro emprego @endif</td>
            @endif
            @endif
        </tr>
        <tr>
            <td class="title" colspan="3" style="text-align: center;">DADOS FAMILIARES</td>
        </tr>
        <tr>
            <td><label  for="">NOME DO PAI</label> <br>{{$admission->nome_pai}}</td>
            <td colspan="2"><label  for="">NOME DA MÃE</label> <br>{{$admission->nome_mae}}</td>
        </tr>
        <tr>
            <td><label for="">ESTADO CIVIL</label> <br>{{$admission->estado_civil}}</td>
            <td><label for="">Nome da Esposa (o)</label> <br>{{$admission->nome_esposa}}</td>
            <td><label for="">Data de Nascimento</label> <br>{{date('d/m/Y',strtotime($admission->esposa_nascimento))}}</td>
        </tr>
        <tr>
            <td class="title" colspan="3" style="text-align: center;">GRAU DE INSTRUÇÃO</td>
        </tr>
        <tr>
            <td colspan="3"><label for="">Escolaridade</label> {{$admission->escolaridade}}</td>
        </tr>
        <tr>
            <td class="title" colspan="3" style="text-align: center;">VALE TRANSPORTE</td>
        </tr>
        <tr>
            <td colspan="2">O FUNCIONÁRIO DESEJA VALE TRANSPORTE?</td>
            <td> @if($admission->vale_transporte == 1) Sim @else Nao @endif</td>
        </tr>
        <tr>
            <td colspan="2"> Deseja receber vale transporte:</td>
            <td>
                @php 
                    echo $admission->vt_modalidade;
                @endphp
            </td>
        </tr>
        <tr>
            <td colspan="2">DESCONTAR % DO FUNCIONÁRIO. </td>
            <td>{{$admission->vt_desconto}}%</td>
        </tr>
        <tr>
            <td class="title" colspan="3" style="text-align: center;">PARA USO EXCLUSIVO DA EMPRESA</td>
        </tr>
        <tr>
            <td><label for="">DATA DE ADMISSÃO</label> <br>{{date('d/m/Y',strtotime($admission->dt_admissao))}}</td>
            <td colspan="2"><label for="">ESTADO CARGO/FUNÇÃO</label> <br>{{$admission->cargo}}</td>
        </tr>
        <tr>
            <td><label for="">SALÁRIO INICIAL</label> <br>{{$admission->salario}}</td>
            <td><label for="">EXPERIÊNCIA EM DIAS</label> <br>{{$admission->experiencia_dias}}</td>
            <td><label for="">Modalidade</label> <br>{{$admission->modalidade}}</td>
        </tr>
        <tr>
            <td class="title" colspan="3" style="text-align: center;">HORÁRIO DE TRABALHO</td>
        </tr>
        <tr>
            <td colspan="3">

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
                                <td style="@if($folga != 'off') background:#dddddd @endif">{{(count($schedules) > 0) ? $schedules[tirarAcentos(strtolower($item))]['h_entrada_manha'] : ''}}</td>
                                <td style="@if($folga != 'off') background:#dddddd @endif">{{(count($schedules) > 0) ? $schedules[tirarAcentos(strtolower($item))]['h_saida_manha'] : ''}}</td>
                                <td style="@if($folga != 'off') background:#dddddd @endif">{{(count($schedules) > 0) ? $schedules[tirarAcentos(strtolower($item))]['h_entrada_tarde'] : ''}}</td>
                                <td style="@if($folga != 'off') background:#dddddd @endif">{{(count($schedules) > 0) ? $schedules[tirarAcentos(strtolower($item))]['h_saida_tarde'] : ''}}</td>
                                <td style="@if($folga != 'off') background:#dddddd @endif">{{(count($schedules) > 0) ? $schedules[tirarAcentos(strtolower($item))]['h_entrada_noite'] : ''}}</td>
                                <td style="@if($folga != 'off') background:#dddddd @endif">{{(count($schedules) > 0) ? $schedules[tirarAcentos(strtolower($item))]['h_saida_noite'] : ''}}</td>
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


            </td>
        </tr>

    </table>
</div>
</body>
</html>