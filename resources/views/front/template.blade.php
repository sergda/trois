<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ trans('front/site.title') }}</title>
        <meta name="description" content="">    
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        @yield('head')

        {!! HTML::style('css/front.css') !!}



    </head>

  <body>

    <header>

        <div class="brand">
            <img src="../img/300x200.png" class="img-fluid">
        </div>
        <div id="flags" class="text-center"></div>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">{{ trans('front/site.title') }}</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li {!! classActivePath('/') !!}>
                            {!! link_to('/', trans('front/site.home'), "title=".trans('front/site.home') ) !!}
                        </li>
                        <li {!! classActivePath('contact/create') !!}>
                                {!! link_to('contact/create', trans('front/site.contact')) !!}
                        </li>
                        <li {!! classActiveSegment(1, ['articles', 'blog']) !!}>
                            {!! link_to('articles', trans('front/site.blog')) !!}
                        </li>

                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="testblock">
                                Пункты меню <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/testblock/test_menu1" title="Пункт меню 1">Пункт меню 1</a></li>
                                <li><a href="/testblock/test_menu2" title="Пункт меню 2">Пункт меню 2</a></li>
                                <li><a href="/testblock/test_menu3" title="Пункт меню 3">Пункт меню 3</a></li>
                                <li><a href="/testblock/test_menu4" title="Пункт меню 4">Пункт меню 4</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><img width="18" height="18" alt="{{ session('locale') }}"  src="{!! asset('img/' . session('locale') . '-flag.png') !!}" />&nbsp; <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            @foreach ( config('app.languages') as $user)
                                @if($user !== config('app.locale'))
                                    <li><a href="{!! url('language') !!}/{{ $user }}"><img width="18" height="18" alt="{{ $user }}" src="{!! asset('img/' . $user . '-flag.png') !!}"></a></li>
                                @endif
                            @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @yield('header')    
    </header>

    <main class="container">
        @if(session()->has('ok'))
            @include('partials/error', ['type' => 'success', 'message' => session('ok')])
        @endif  
        @if(isset($info))
            @include('partials/error', ['type' => 'info', 'message' => $info])
        @endif
        @yield('main')
    </main>

    <footer class="text-muted">
        <div class="container text-center">

            <div class="fedback-button">
                <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">Prev action</a>
                <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#myModal1">Secondary action</a>
            </div>

            <img src="../img/300x200.png" class="img-fluid">
        </div>


        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Подписаться</h4>
                    </div>
                    <form name="sentMessage" class="form form-register1" id="fedbackForm"  novalidate>
                        {{ csrf_field() }}
                        <div class="modal-body form-group">


                            <div class="control-group">
                                <div class="controls">
                                    <input type="text" name="name" class="form-control" onblur='if(this.value=="") this.placeholder="Ваше имя"' onfocus='if(this.value=="Ваше имя") this.value=""' placeholder="Ваше имя" id="name" required data-validation-required-message="Пожалуйста, укажите ваше имя" />
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <input type="email" name="email" class="form-control" onblur='if(this.value=="") this.placeholder="Ваш email"' onfocus='if(this.value=="Ваш email") this.value=""' placeholder="Ваш email" id="email" required data-validation-required-message="Пожалуйста, укажите ваш email" />
                                </div>
                            </div>
                            <!-- div class="control-group">
                                <div class="controls">
                                    <input type="text" class="form-control" onblur='if(this.value=="") this.placeholder="Телефон"' onfocus='if(this.value=="Телефон") this.value=""' placeholder="Телефон" id="phone" required data-validation-required-message="Пожалуйста, укажите номер телефона" />
                                </div>
                            </div -->



                            <div id="success"> </div>
                        </div>
                        <div class="modal-footer">
                            <!-- button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button -->
                            <input type="submit" class="btn btn-secondary form-button" value="Отправить">
                        </div>
                        <div id="success"> </div>
                    </form>
                </div>
            </div>
        </div>

    </footer>

    {!! HTML::script('js/jquery-3.0.0.js') !!}
    {!! HTML::script('js/jquery-migrate-3.0.1.min.js') !!}
    {!! HTML::script('js/tether.min.js') !!}
    {!! HTML::script('js/bootstrap.min.js') !!}
    {!! HTML::script('js/jqBootstrapValidation.js') !!}
    {!! HTML::script('js/script.js') !!}


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function() {
            $('#logout').click(function(e) {
                e.preventDefault();
                $('#logout-form').submit();
            })
        });
    </script>

    @yield('scripts')

  </body>
</html>