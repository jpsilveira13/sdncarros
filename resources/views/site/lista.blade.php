@extends('site.layout')
@section('content')
    <div class="row mt150">
        <div class="col-md-12">
            <div class="text-center">
                <h2>Listagem Veículos</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-responsive table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Ano</th>
                    <th>KM</th>
                    <th>Valor</th>
                    <th>Valor mínimo</th>
                    <th>Valor Máximo</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Local</th>
                    <th>Data Criação</th>
                    <th>Data</th>
                    <th>Período</th>
                    <th>Visto</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($veiculos as $veiculo)
                    <tr>
                        <th scope="row">{{$veiculo->id}}</th>
                        <td>{{$veiculo->marca}}</td>
                        <td>{{$veiculo->modelo}}</td>
                        <td>{{$veiculo->ano}}</td>
                        <td>{{$veiculo->km}}</td>
                        <td>{{$veiculo->valor}}</td>
                        <td>{{$veiculo->valor_min}}</td>
                        <td>{{$veiculo->valor_max}}</td>
                        <td>{{$veiculo->nome}}</td>
                        <td>{{$veiculo->email}}</td>
                        <td>{{$veiculo->tel}}</td>
                        <td>{{$veiculo->local}}</td>
                        <td>{{ date("d/m/Y H:i:s", strtotime($veiculo->created_at)) }}</td>
                        <td>{{$veiculo->data}}</td>
                        <td>{{$veiculo->periodo}}</td>
                        <td>
                            <select>
                                <option value="">Status</option>
                                <option value=""></option>
                            </select>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="container">
        <div class="center-block">
            {!! $veiculos->render() !!}
        </div>
    </div>
@endsection