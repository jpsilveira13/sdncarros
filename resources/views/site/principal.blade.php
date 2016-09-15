@extends('site.layout')
@section('content')
    <!-- Header -->
    <header>
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h1 class="texto-central">O jeito mais fácil e certo de vender seu veículo</h1>
                        <h4 class="paragrafo-central">Consulte agora!</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 offset-2" >
                    <div class="area-form mt75">
                        <form id="fipe" method="get" action="{{route('venda')}}">

                            <p class="titulo-form">Qual carro você quer vender?</p>
                            <div class="area-select">
                                <span class="seta-select"></span>
                                <select required="" class="form-control" name="marcas" id="marcas" aria-invalid="true">
                                    <option value="">Selecione uma Marca</option>

                                </select>
                            </div>
                            <div class="area-select">
                                <span class="seta-select"></span>
                                <select required="" class="form-control" name="modelos" id="modelos" aria-invalid="true">
                                    <option value="">Modelo</option>

                                </select>
                            </div>
                            <div class="area-select">
                                <span class="seta-select"></span>
                                <select required="" class="form-control" name="anos" id="anos" aria-invalid="true">
                                    <option value="">Ano</option>

                                </select>
                            </div>
                            <input id="valor" name="valor" type="hidden">
                            <input id="marca" name="marca" type="hidden">
                            <input id="modelo" name="modelo" type="hidden">
                            <input id="ano" name="ano" type="hidden">

                            <div class="area-select text-center">
                                <button id="btnCotar" type="submit" class="transicaoPadrao transparenciaFracaHover float-shadow2">Cotar meu carro grátis!</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-7 offset-2">
                    <div class="image-wrap-1">
                        <img class="prefix-2 img-wide" src="img/bg-fundo.png" alt="">
                    </div>
                </div>
            </div>

        </div>

    </header>
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Como Funciona</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 portfolio-item">
                    <a href="" class="portfolio-link" data-toggle="modal">
                        <img src="{{url('img/portfolio/bg1.jpg')}}" class="img-responsive" alt="">
                        <p class="mt20 text-center">Em menos de 30 segundos falamos o preço médio que o mercado paga pelo seu carro.</p>

                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="" class="portfolio-link" data-toggle="modal">

                        <img src="{{url('img/portfolio/bg2.jpg')}}" class="img-responsive" alt="">
                        <p class="mt20 text-center">Em 30 minutos cadastraremos o seu carro e ofereceremos a centenas de compradores para você conseguir o melhor valor de venda.</p>

                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="" class="portfolio-link" data-toggle="modal">
                        <img src="{{url('img/portfolio/bg3.jpg')}}" class="img-responsive" alt="">
                        <p class="mt20 text-center">Você aceitando a melhor oferta, o SDN Car compra seu carro na hora.</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Dúvidas</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <h4>1º Como é calculada a avaliação on-line para o meu carro?</h4>
                    <p>As nossas avaliações retornam a média que nossos parceiros pagaram nos últimos veículos iguais ao seu. </p>
                    <h4>2º Existe uma taxa se eu decidir não vender meu carro para você?</h4>
                    <p>Não há taxa de transação, se você optar por não vender o seu carro para nós.</p>
                    <h4>3º Vocês compram carros com dívida?</h4>
                    <p>Sim, fazemos a quitação do carro junto a instituição financeira e pagamos a diferença do valor.</p>
                    <h4>4º Tenho que fazer a avaliação presencial?</h4>
                    <p>Sim, Isso é importante para que possamos ter mais detalhes do seu veículo, com fotos e especificações, podendo melhorar assim a avaliação.</p>
                    <h4>5º Porque é mais fácil vender meu carro por aqui?</h4>
                    <p>Porque anunciaremos o seu carro a centenas de compradores simultaneamente via a nossa plataforma, para você obter assim o melhor valor no menor tempo possível.</p>
                    <h4>6º O que vocês cobram do vendedor?</h4>
                    <p> A SDN Car só cobra o que estiver irregular no carro, como: IPVA, Licenciamento, DPVT, transferência, multas.</p>
                </div>
                <div class="col-md-5">
                    <img class="img-responsive center-block " src="{{url('img/bgduvidas.png')}}">
                </div>
            </div>
        </div>
    </section>
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Contato</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">

                    <form  id="formContato" novalidate>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Nome</label>
                                <input type="text" name="nome" class="form-control" placeholder="Informe o nome" id="nome" required data-validation-required-message="Por favor insere seu nome.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Informe o seu email" id="email" required data-validation-required-message="Por favor insere o seu email.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Telefone ou Celular</label>
                                <input type="tel" class="form-control" name="telefone" placeholder="Informe o telefone ou celular" id="telefone" required data-validation-required-message="Por favor insere o número telefone">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Mensagem</label>
                                <textarea rows="5" name="mensagem" class="form-control" placeholder="Informe a mensagem" id="message" required data-validation-required-message="Informe a mensagem."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-success btn-lg">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection