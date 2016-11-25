@extends('site.layout')
@section('content')

    <div class="container">
        <div class="row">

            <section class="content">
                <h1>Listagem de Veículos</h1>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-filter" data-target="nv">Não Visto</button>
                                    <button type="button" class="btn btn-danger btn-filter" data-target="v">Visto</button>
                                    <button type="button" class="btn btn-default btn-filter" data-target="all">Todos</button>
                                </div>
                            </div>
                            <div class="table-container">
                                <table class="table table-filter">
                                    <tbody>
                                    @foreach($veiculos as $veiculo)

                                        <tr class="mudaStatus @if($veiculo->status=="v") selected @endif" id="{{$veiculo->id}}" data-status="{{$veiculo->status}}">
                                            <td>
                                                <div class="ckbox">
                                                    <input type="checkbox" @if($veiculo->status == "v") checked @endif id="checkbox1">
                                                    <label for="checkbox1"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="star">
                                                    <i class="glyphicon glyphicon-star"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <div  class="aumentarDiv media">
                                                    <a href="#" class="pull-left">
                                                        <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                    </a>
                                                    <div class="media-body">
                                                        <span class="media-meta pull-right">{{ date("d/m/Y H:i:s", strtotime($veiculo->created_at)) }}</span>
                                                        <h4 class="title">
                                                            {{$veiculo->marca}}<br />
                                                            <span class="pull-left pagado">{{$veiculo->modelo}}</span>
                                                            @if($veiculo->status == "nv")
                                                                <span class="pull-right pagado"> Não Visto</span>
                                                            @else
                                                                <span class="pull-right cancelado"> Visto</span>
                                                            @endif
                                                        </h4><br />
                                                        <p class="summary">Nome: {{$veiculo->nome}}</p>
                                                        <p class="summary">Email: {{$veiculo->email}}</p>
                                                        <p class="summary">Telefone: {{$veiculo->tel}}</p>
                                                        <p class="summary">Local: {{$veiculo->local}}</p>
                                                        <p class="summary">Ano veículo: {{$veiculo->ano}}</p>
                                                        <p class="summary">KM veículo: {{$veiculo->km}}</p>
                                                        <p class="summary">Valor min: R$ {{number_format((float)$veiculo->valor_min,2,",",".")}}</p>
                                                        <p class="summary">Valor max: R$ {{number_format((float)$veiculo->valor_max,2,",",".")}}</p>
                                                        <p class="summary">Data: {{$veiculo->data}}</p>
                                                        <p class="summary">Período : {{$veiculo->periodo}}</p>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="content-footer">
                        <div class="container">
                            <div class="text-center">
                                {!! $veiculos->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

@endsection