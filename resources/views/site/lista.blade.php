@extends('site.layout')
@section('content')
    <div class="container " style="margin-top: 150px">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">
                    Listagem Veículos
                </h1>

            </div>
            <div id="no-more-tables">
                <table class="col-md-12 table table-bordered table-striped table-condensed table-hover table-inverse">
                    <thead class="cf">
                    <tr>
                        <th class="numeric">ID</th>
                        <th class="numeric">Nome</th>
                        <th class="numeric">Marca</th>
                        <th class="numeric">Modelo</th>
                        <th class="numeric">Email</th>
                        <th class="numeric">Telefone</th>
                        <th class="numeric">Local</th>
                        <th class="numeric">Ano veículo</th>
                        <th class="numeric">KM veículo</th>
                        <th class="numeric">Valor Fipe</th>
                        <th class="numeric">Valor min</th>
                        <th class="numeric">Valor max</th>
                        <th class="numeric">Data</th>
                        <th class="numeric">Período</th>
                        <th>Status</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($veiculos as $veiculo)

                        <tr @if($veiculo->status == "v") class="success" @endif>

                            <td data-title="ID">{{$veiculo->id}}</td>
                            <td data-title="Nome">{{$veiculo->nome}}</td>

                            <td data-title="Marca"> {{$veiculo->marca}}</td>
                            <td data-title="Modelo"> {{$veiculo->modelo}}</td>
                            <td data-title="Email"> {{$veiculo->email}}</td>


                            <td data-title="Telefone"> {{$veiculo->tel}}</td>
                            <td data-title="Local"> {{$veiculo->local}}</td>
                            <td data-title="Ano Veículo">{{$veiculo->ano}}</td>
                            <td data-title="KM veículo"> {{$veiculo->km}}</td>
                            <td data-title="Valor Fipe"> R$ {{number_format((float)$veiculo->valor,2,",",".")}}</td>
                            <td data-title="Valor min">R$ {{number_format((float)$veiculo->valor_min,2,",",".")}}</td>
                            <td data-title="Valor Max">R$ {{number_format((float)$veiculo->valor_max,2,",",".")}}</td>

                            <td data-title="Data">{{$veiculo->data}}</td>
                            <td data-title="Período">{{$veiculo->periodo}}</td>
                            <td data-title="Status">

                                    <select style="width: 88px" id="{{$veiculo->id}}" class="form-control statusCarro">
                                        <option value="">Selecione</option>
                                        <option @if($veiculo->status == "v") selected @endif value="v">Vistoriado</option>
                                        <option @if($veiculo->status == "nv") selected @endif value="nv">Não vistoriado</option>
                                    </select>

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12">
            <div class="text-center">
                {!! $veiculos->render() !!}
            </div>
        </div>
    </div>



@endsection