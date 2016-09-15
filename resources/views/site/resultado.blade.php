@extends('site.layout')
@section('content')
    <div class="mt150">
        <div class="container">
            <div class="tamanho-quadro center-block">
                <div class="panel panel-default borderpainel">
                    <div class="panel-body">

                        <div class="stepper">
                            <ul class="nav nav-tabs" role="tablist">
                                <li  id="tab1" role="presentation" class="active">
                                    <a class="persistant-disabled" href="#stepper-step-1" data-toggle="tab" aria-controls="stepper-step-1" role="tab" title="Entrada de dados">
                                        <span class="round-tab">1</span>
                                    </a>
                                </li>
                                <li id="tab2" role="presentation" class="disabled">
                                    <a class="persistant-disabled" href="#stepper-step-2" data-toggle="tab" aria-controls="stepper-step-2" role="tab" title="Cotação e Agendamen">
                                        <span class="round-tab">2</span>
                                    </a>
                                </li>
                            </ul>
                            <form id="cotacao" action="">
                                <input type="hidden" name="marca" value="<?=(Session::get('marca'))?>">
                                <input type="hidden" name="modelo" value="<?=(Session::get('modelo'))?>">
                                <input type="hidden" name="valor" value="<?=(Session::get('valor'))?>">
                                <input type="hidden" name="ano" value="<?=(Session::get('ano'))?>">
                                <input type="hidden" name="valor_min"  value="0"/>
                                <input type="hidden" name="valor_max" value="0"/>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" role="tabpanel" id="stepper-step-1">
                                        <div class="linha "></div>
                                        <h3 class="etapa-titulo mb40 mt40">Informe o KM do veículo</h3>
                                        <div class="area-select seta-arruma mb40">
                                            <span class="seta-select"></span>
                                            <select required="required" class="form-control font-select select-etapa" name="km" aria-invalid="true">
                                                <option value="">Km</option>
                                                <option value="20000">0 - 20 mil km</option>
                                                <option value="40000">20 mil km - 40 mil km</option>
                                                <option value="60000">40 mil km - 60 mil km</option>
                                                <option value="80000">60 mil km - 80 mil km</option>
                                                <option value="100000">80 mil km - 100 mil km</option>
                                                <option value="120000">100 mil km - 120 mil km</option>
                                                <option value="121001">121 mil km ou mais</option>

                                            </select>
                                        </div>
                                        <div class="linha linhauser "></div>
                                        <h3 class="etapa-titulo mb40 mt40">Digite os seus dados para te lembrarmos do seu agendamento:</h3>
                                        <div class="area-select seta-arruma">
                                            <input class="form-control font-select select-etapa" placeholder="Nome" id="nome" name="nome" required>
                                        </div>
                                        <div class="area-select seta-arruma">
                                            <input type="email" class="form-control font-select select-etapa" id="email" placeholder="Email" name="email" required>
                                        </div>
                                        <div class="area-select seta-arruma">
                                            <input type="text" class="form-control font-select select-etapa" id="telefone" placeholder="Telefone ou celular" name="tel" required>
                                        </div>

                                        <ul class="list-inline pull-right">
                                            <li>

                                                <button type="submit" id="btnSalvar" class="btn btn-primary">Próximo</button>
                                            </li>
                                        </ul>
                                    </div>
                            </form>
                            <div class="tab-pane fade" role="tabpanel" id="stepper-step-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="caixa-preco center-block">
                                            <h5>A média de venda do seu veículo é de</h5>
                                            <h3 class="cor-destaque">
                                                <span id="valorMinimo"></span>
                                                <span class="font-menor">&</span>
                                                <span id="valorMaximo"></span>

                                            </h3>
                                            <h5>Junto as lojas conveniadas</h5>
                                        </div>
                                        <div class="informacao-cota text-left">
                                            <h6 class="">Observações muito importantes:</h6>
                                            <h6 class="">O valor apresentado é uma média do valor pago <span class="font-simples">por nossos parceiros contratantes e pode variar para mais ou para menos
                                                </span> após avaliação presencial do seu veículo.</h6>
                                            <h6 class="font-simples">* Atendemos apenas nas cidades das unidades de nossas lojas.</h6>

                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="center-block">
                                            <form id="agendamento" action="">
                                                <input type="hidden" name="id" id="idCotacao" value="" />
                                                <div id="form-agendamento" class="caixa-agendamento vertical-top inline-block">
                                                    <div class="texto-agendamento">
                                                        <h5 class="texto-interno-agendamento text-center font-bold ">Agende a sua avaliação.</h5>
                                                        <h6 class="texto-interno-agendamento  font-light text-center">...oferecemos o seu veículo para centenas de compradores para você obter o melhor
                                                            preço de venda.</h6>
                                                        <h6 class="texto-interno-agendamento  font-bold text-center">Daí você escolhe para quem for vender!!</h6>
                                                    </div>
                                                    <div class="area-form-agendamento">
                                                        <div class="area-select seta-arruma mb20">
                                                            <span class="seta-select"></span>
                                                            <select required="required" class="form-control font-select select-etapa" name="local" aria-invalid="true">
                                                                <option value="">Local</option>
                                                                <option value="Uberaba">Uberaba</option>
                                                                <option value="São José do Rio Preto">São José do Rio Preto</option>
                                                            </select>
                                                        </div>
                                                        <div class="area-select seta-arruma mb20">

                                                            <input placeholder="Informe a data" required="required" class="form-control font-select select-etapa data" type="text" name="data" aria-invalid="true" />
                                                        </div>
                                                        <div class="area-select seta-arruma mb20">

                                                            <input required="required" placeholder="Informe a hora" class="form-control font-select select-etapa hora" name="periodo" type="text" aria-invalid="true">
                                                        </div>
                                                        <div class="area-select text-center">
                                                            <button id="btnAgendamento" type="submit" class="transicaoPadrao transparenciaFracaHover float-shadow2">Agendar vistoria!</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection