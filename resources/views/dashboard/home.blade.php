<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Evental - Seu Gerenciador de Eventos</title>
    <link rel="canonical" href="{{ env('APP_URL') }}" itemprop="url">
    <meta name="description" content="Evental é um gerenciador que ajuda a sua empresa a administrar seus eventos">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-evental.svg') }}" type="image/x-icon">
    <meta name="theme-color" content="#0984e3" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-4-0-0/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div class="container-fluid px-0" id="bg-div">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-12">
                <div class="card card0">
                    <div class="d-flex" id="wrapper">
                        <!-- Sidebar -->
                        <div class="bg-light border-right" id="sidebar-wrapper">
                            <div class="sidebar-heading pt-5 pb-4"><img src="{{ asset('assets/img/logo-evental.svg') }}" class="evental-logo" /><strong>Evental</strong></div>
                            <div class="list-group list-group-flush"> <a data-toggle="tab" href="#menu1" id="tab1"
                                    class="tabs list-group-item bg-light active1">
                                    <div class="list-div my-2">
                                        <div class="fa fa-calendar"></div> &nbsp;&nbsp; Calendário
                                    </div>
                                </a> <a data-toggle="tab" href="#menu2" id="tab2" class="tabs list-group-item">
                                    <div class="list-div my-2">
                                        <div class="fa fa-bookmark"></div> &nbsp;&nbsp; Eventos
                                    </div>
                                </a> <a data-toggle="tab" href="#menu3" id="tab3" class="tabs list-group-item bg-light">
                                    <div class="list-div my-2">
                                        <div class="fa fa-sun c-color"></div> &nbsp;&nbsp;&nbsp; <span class="c-color fw-800">Versão PRO</span> <span
                                            id="new-label">NOVO</span>
                                    </div>
                                </a> </div>
                        </div> <!-- Page Content -->
                        <div id="page-content-wrapper">
                            <div class="row pt-3" id="border-btm">
                                <div class="col-4"> <button class="btn btn-success mt-4 ml-3 mb-3" id="menu-toggle">
                                        <div class="bar4"></div>
                                        <div class="bar4"></div>
                                        <div class="bar4"></div>
                                    </button> </div>
                                <div class="col-8">
                                    <div class="row justify-content-right">
                                        <div class="col-12">
                                            <p class="mb-0 mr-4 mt-4 text-right">Próximo Evento</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-right">
                                        <div class="col-12">
                                            <p class="mb-0 mr-4 text-right"><span class="top-highlight">@if($nextEvent != null) {{ $nextEvent }} @else Crie um Evento! @endif</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-content mb-35">
                                <div id="menu1" class="tab-pane in active">
                                    <div class="row justify-content-center">
                                        <div class="text-center" id="test">Calendário</div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-11">
                                            <div class="row row-calendars">
                                            @if(count($events) === 0)
                                            <p>Não há nenhum evento disponível...</p>
                                            @else
                                            @foreach($events as $event)
                                                <!-- CARD 1 -->
                                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                                  <a href="#openCard" class="seeEvent" data-toggle="modal" data-target="#seeEvent" data-id="{{ $event['id_event'] }}">
                                                  <div class="card card-calendar">
                                                    <div class="card-body">
                                                      <h5 class="card-title mb-35">{{ App\Services\Event\EventService::getBrazilianDateFormat($event['start_date_event']) }} - {{ App\Services\Event\EventService::getBrazilianDateFormat($event['end_date_event']) }}</h5>
                                                      <h6 class="card-subtitle mb-2 text-muted c-blue02">{{ strlen($event['title_event']) > 25 ? substr($event['title_event'],0,25)."..." : $event['title_event'] }}</h6>
                                                      <p class="card-text">{{ strlen($event['description_event']) > 60 ? substr($event['description_event'],0,60)."..." : $event['description_event'] }}</p>
                                                      <span class="timer"><i class="fa fa-clock" aria-hidden="true"></i>&nbsp;&nbsp; {{ substr($event['start_hour_event'], 0, -3) }} - {{ substr($event['end_hour_event'], 0, -3) }}</span>
                                                    </div>
                                                  </div>
                                                  </a>
                                                </div>
                                                <!-- / CARD 1 -->
                                            @endforeach
                                            @if(count($events) === 6)
                                            <!-- CARD LOAD MORE -->
                                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                                    <div class="card card-calendar-loadMore">
                                                        <div class="card-body">
                                                          <h5 class="card-title mb-35"><i class="fa fa-plus" aria-hidden="true"></i> Carregar Mais</h5>
                                                          <p class="card-text">Desbloqueie a <span class="c-color">versão PRO</span> para ter visualizar mais de 6 eventos</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- / CARD LOAD MORE -->
                                            @endif
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="menu2" class="tab-pane">
                                    <div class="row justify-content-center">
                                        <div class="text-center" id="test">Eventos</div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="form-card" style="width: 100%;">
                                                    <h3 class="mt-0 mb-4 text-center" id="event_operation_title">Criar um novo evento</h3>
                                                    <form id="formSend" class="newEvent" method="POST" action="#weEvent">
                                                    @csrf
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="input-group"> <input value="" name="titulo_evento" type="text" pattern=".{5,100}" title="Seu [Título] deve conter entre 5 a 100 caracteres" maxlength="100" required="" placeholder="Insira seu título"> <label>Título do Evento</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="input-group"> <input value="" name="descricao_evento" type="text" pattern=".{3,255}" title="Sua [Descrição] deve conter entre 3 a 255 caracteres" maxlength="255" required="" placeholder="Insira sua descrição">
                                                                    <label>Descrição do Evento</label> </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="input-group"> <input value="" type="date" name="inicio_evento" required="" class="placeicon"> <label>Início</label> </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="input-group"> <input value="" type="date" name="termino_evento" required="" class="placeicon"> <label>Término</label> </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="input-group"> <input value="" type="time" name="hora_inicio_evento" required="" class="placeicon" min="09:00" max="18:00"> <label>Horario de Início</label> </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="input-group"> <input value="" type="time" name="hora_final_evento" required="" class="placeicon" min="09:00" max="18:00"> <label>Horario de Término</label> </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <input type="hidden" name="id_evento" value="">
                                                            <div class="col-md-12"> <input id="button-add-event" type="submit" value="CRIAR EVENTO"
                                                                    class="btn btn-success placeicon"> </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="row" style="border-top:1px solid #bdc3c7; padding-top: 20px;">
                                                <h2 style="width:100%;" class="title-h2">Carregando {{ count($events) }} de 6 resultados...</h2>
                                                @if(count($events) !== 0)
                                                <table class="table table-bordered">
                                                    <thead>
                                                      <tr>
                                                        <th scope="col">Data</th>
                                                        <th scope="col">Hora</th>
                                                        <th scope="col">Título</th>
                                                        <th scope="col">Ações</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($events as $event)
                                                      <tr>
                                                        <th scope="row">{{ App\Services\Event\EventService::getBrazilianDateFormat($event['start_date_event']) }} - {{ App\Services\Event\EventService::getBrazilianDateFormat($event['end_date_event']) }}</th>
                                                        <td>{{ substr($event['start_hour_event'], 0, -3) }} - {{ substr($event['end_hour_event'], 0, -3) }}</td>
                                                        <td>{{ strlen($event['title_event']) > 25 ? substr($event['title_event'],0,25)."..." : $event['title_event'] }}</td>
                                                        <td>
                                                          <button type="button" class="btn btn-primary seeEvent" data-toggle="modal" data-target="#seeEvent" data-id="{{ $event['id_event'] }}"><i class="fa fa-eye"></i></button>
                                                          <button type="button" class="btn btn-success editEvent" data-id="{{ $event['id_event'] }}"><i class="fa fa-edit"></i></button>
                                                          <button type="button" class="btn btn-danger removeEvent" data-id="{{ $event['id_event'] }}"><i class="fa fa-trash-alt"></i></button>
                                                        </td>
                                                      </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                @else
                                                <br>
                                                <p style="width:100%;">Não há nenhum evento disponível...</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="menu3" class="tab-pane">
                                    <div class="row justify-content-center">
                                        <div class="text-center" id="test">Versão PRO</div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-lg-12 mb-35">
                                                    <h3>Com a <span class="c-color">Versão PRO</span> você pode mais!</h2>
                                                </div>
                                                <div class="col-lg-12 mb-35">
                                                    <p>💎 Carregue mais do que 6 eventos.</p>
                                                    <p>💎 Defina dias e horários que os eventos podem acontecer.</p>
                                                    <p>💎 Sistema de Login e Cadastro de novos usuários.</p>
                                                    <p>💎 Sistema de controle de acesso e permissão de usuários.</p>
                                                    <p>💎 Possibilidade de adicionar ou remover campos durante a criação dos eventos.</p>
                                                    <p>💎 Aplicativo Mobile para Android e iOS.</p>
                                                    <p>💎 Integração com Google Calendar, Whatsapp e envio de e-mails automáticos.</p>
                                                    <p>💎 Possibilidade de adicionar o e-mails das pessoas para que estes recebam notificações do evento.</p>
                                                    <p>💎 Configuração de mensagens customizadas para envio.</p>
                                                    <p>💎 Sistema com o nome da sua empresa.</p>
                                                    <p>💎 Integração com Sales Forces e CRMs.</p>
                                                </div>
                                                <div class="col-lg-12">
                                                    <p>Gostou? Para saber mais entre em contato com o administrador do sistema <a target="__blank" href="https://wa.me/5521993181612">neste link</a>.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
  <div class="modal" id="seeEvent">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Detalhes do Evento</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <p><strong>Título</strong>: <span id="modal-title-event"></span></p>
          <p><strong>Descrição</strong>: <span id="modal-description-event"></span></p>
          <p><strong>Data de Início</strong>: <span id="modal-start-date"></span></p>
          <p><strong>Data de Término</strong>: <span id="modal-end-date"></span></p>
          <p><strong>Hora de Início</strong>: <span id="modal-start-hour"></span></p>
          <p><strong>Hora de Término</strong>: <span id="modal-end-hour"></span></p>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
        </div>
        
      </div>
    </div>
  </div>

</body>

<!-- Scripts -->
<script src="{{ asset('assets/vendor/jquery-3-2-1/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-4-0-0/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/sweetalert/sweetalert2.all.min.js') }}"></script>
<script>
    let ajaxURL_See = '{{ $ajaxURL_See }}';
    let ajaxURL_Add = '{{ $ajaxURL_Add }}';
    let ajaxURL_Edit = '{{ $ajaxURL_Edit }}';
    let ajaxURL_Remove = '{{ $ajaxURL_Remove }}';
</script>
<script src="{{ asset('assets/js/init.js') }}"></script>
</html>