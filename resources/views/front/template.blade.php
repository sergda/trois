<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        @yield('head')
        {!! HTML::style('css/lightbox.css') !!}
        {!! HTML::style('css/front.css') !!}
    </head>

  <body>

    <header>

        <div class="brand">
            <a href="/" title="Main">
                <img width="270" src="/img/tc_log1.png" class="img-fluid" alt="trois">
            </a>
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
                    <a class="navbar-brand" href="/">{{ trans('front/site.title') }}</a>
                </div>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown" {!! classActivePath('/world_tc') !!}>
                            {!! link_to('/world_tc', trans('front/site.world'), "title=".trans('front/site.world')." data-toggle='dropdown' class='dropdown-toggle'" ) !!}
                            <ul class="dropdown-menu">
                                @php
                                 $worldtcs = DB::table('worldtcs')->select('slug', 'en_title', 'fr_title', 'de_title')->whereIs_menu(true)->whereActive(true)->orderBy('sort', 'asc')->get();
                                @endphp
                                @foreach( $worldtcs as $item )
                                    @if( config('app.locale') == "en" )
                                        @php
                                            $title = $item->en_title;
                                        @endphp
                                    @elseif( config('app.locale') == "fr" )
                                        @php
                                            $title = $item->fr_title;
                                        @endphp
                                    @elseif( config('app.locale') == "de" )
                                        @php
                                            $title = $item->de_title;
                                        @endphp
                                    @endif
                                    <li>
                                        {!! link_to('/world_tc/'.$item->slug, $title, "title=".$title ) !!}
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="dropdown" {!! classActivePath('/collection') !!}>
                            {!! link_to('/collection', trans('front/site.Collection'), "title=".trans('front/site.Collection')." data-toggle='dropdown' class='dropdown-toggle'" ) !!}
                            <ul class="dropdown-menu">
                                @php
                                    $worldtcs = DB::table('collections')->select('slug', 'en_title', 'fr_title', 'de_title')->whereIs_menu(true)->whereActive(true)->orderBy('sort', 'asc')->get();
                                @endphp
                                @foreach( $worldtcs as $item )
                                    @if( config('app.locale') == "en" )
                                        @php
                                            $title = $item->en_title;
                                        @endphp
                                    @elseif( config('app.locale') == "fr" )
                                        @php
                                            $title = $item->fr_title;
                                        @endphp
                                    @elseif( config('app.locale') == "de" )
                                        @php
                                            $title = $item->de_title;
                                        @endphp
                                    @endif
                                    <li>
                                        {!! link_to('/collection/'.$item->slug, $title, "title=".$title ) !!}
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="dropdown" {!! classActivePath('/customer_service') !!}>
                            {!! link_to('/customer_service', trans('front/site.CustomerService'), "title=".trans('front/site.CustomerService')." data-toggle='dropdown' class='dropdown-toggle'" ) !!}

                            <ul class="dropdown-menu">
                                @php
                                    $worldtcs = DB::table('customerservices')->select('slug', 'en_title', 'fr_title', 'de_title')->whereIs_menu(true)->whereActive(true)->orderBy('sort', 'asc')->get();
                                @endphp
                                @foreach( $worldtcs as $item )
                                    @if( config('app.locale') == "en" )
                                        @php
                                            $title = $item->en_title;
                                        @endphp
                                    @elseif( config('app.locale') == "fr" )
                                        @php
                                            $title = $item->fr_title;
                                        @endphp
                                    @elseif( config('app.locale') == "de" )
                                        @php
                                            $title = $item->de_title;
                                        @endphp
                                    @endif
                                    <li>
                                        {!! link_to('/customer_service/'.$item->slug, $title, "title=".$title ) !!}
                                    </li>
                                @endforeach
                            </ul>
                        </li>


                        <li class="dropdown" {!! classActivePath('/find_us') !!}>
                            {!! link_to('/find_us', trans('front/site.findus'), "title=".trans('front/site.findus')." data-toggle='dropdown' class='dropdown-toggle'" ) !!}
                            <ul class="dropdown-menu">
                                @php
                                    $worldtcs = DB::table('finduss')->select('slug', 'en_title', 'fr_title', 'de_title')->whereIs_menu(true)->whereActive(true)->orderBy('sort', 'asc')->get();
                                @endphp
                                @foreach( $worldtcs as $item )
                                    @if( config('app.locale') == "en" )
                                        @php
                                            $title = $item->en_title;
                                        @endphp
                                    @elseif( config('app.locale') == "fr" )
                                        @php
                                            $title = $item->fr_title;
                                        @endphp
                                    @elseif( config('app.locale') == "de" )
                                        @php
                                            $title = $item->de_title;
                                        @endphp
                                    @endif
                                    <li>
                                        {!! link_to('/find_us/'.$item->slug, $title, "title=".$title ) !!}
                                    </li>
                                @endforeach
                            </ul>
                        </li>


                        <li {!! classActivePath('/order-catalogue') !!}>
                            {!! link_to('/order-catalogue', trans('front/site.OrderCatalogue'), "title=".trans('front/site.OrderCatalogue') ) !!}
                        </li>


                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><img width="18" height="18" alt="{{ session('locale') }}"  src="{!! asset('img/' . session('locale') . '-flag.png') !!}" />&nbsp;{{ trans('front/site.'.session('locale').'_lang') }}</a>
                            <ul class="dropdown-menu">
                            @foreach ( config('app.languages') as $user)
                                @if($user !== config('app.locale'))
                                    <li>
                                        <a href="{!! url('language') !!}/{{ $user }}">
                                            <img width="18" height="18" alt="{{ $user }}" src="{!! asset('img/' . $user . '-flag.png') !!}">&nbsp;{{ trans('front/site.'.$user.'_lang') }}
                                        </a>
                                    </li>
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
    @yield('body')
    <main class="container">
        @yield('main')
    </main>

    <footer class="text-muted">
        <div class="container text-center">

            <div class="footerLogo">
                <span class="footerHr"></span>
                <img src="/img/footerlogo1.png" class="img-fluid">
            </div>
            <div class="fedback-button">
                <span>
                    <a href="#" class="" data-toggle="modal" data-target="#myModal">{{  trans('front/site.feedback') }} </a>
                    <a href="#" class="" data-toggle="modal" data-target="#myModal">{{  trans('front/site.feedback1') }} </a>
                </span>
            </div>

        </div>


        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">To Subcribe</h4>
                    </div>
                    <form name="sentMessage" class="form form-register1" id="fedbackForm"  novalidate>
                        {{ csrf_field() }}
                        <div class="modal-body form-group">


                            <div class="control-group">
                                <div class="controls">
                                    <input type="text" name="name" class="form-control" onblur='if(this.value=="") this.placeholder="Your Name"' onfocus='if(this.value=="Your Name") this.value=""' placeholder="Your Name" id="name" required data-validation-required-message="Please, indicate Your Name" />
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <input type="email" name="email" class="form-control" onblur='if(this.value=="") this.placeholder="Your e-mail"' onfocus='if(this.value=="Your e-mail") this.value=""' placeholder="Your e-mail" id="email" required data-validation-required-message="Please, indicate Your e-mail" />
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
                            <input type="submit" class="btn btn-secondary form-button" value="Send">
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
    {!! HTML::script('js/jquery.form.min.js') !!}
    {!! HTML::script('js/jquery.colorbox-min.js') !!}
    {!! HTML::script('/packages/barryvdh/elfinder/js/standalonepopup.js') !!}
    {!! HTML::script('js/lightbox.js') !!}
    {!! HTML::script('js/query_lazyload/jquery.lazyload.min.js') !!}
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