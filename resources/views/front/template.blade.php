<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        @yield('head')

        {!! HTML::style('css/front.css') !!}

    </head>

  <body>

    <header>

        <div class="brand">
            <a href="/" title="Main"><img width="470" src="/img/tc_log1.png" class="img-fluid" alt="trois"></a>
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
                                <li>
                                    {!! link_to('/world_tc/our-history', trans('front/site.OurHistory'), "title=".trans('front/site.OurHistory') ) !!}
                                </li>
                                <li>
                                    {!! link_to('/world_tc/our-masterpieces', trans('front/site.OurMasterpieces'), "title=".trans('front/site.OurMasterpieces') ) !!}
                                </li>
                                <li>
                                    {!! link_to('/world_tc/our-natural-materials', trans('front/site.OurNaturalMaterials'), "title=".trans('front/site.OurNaturalMaterials') ) !!}
                                </li>
                                <li>
                                    {!! link_to('/world_tc/your-yndividual-personalization', trans('front/site.YourIndividualPersonalization'), "title=".trans('front/site.YourIndividualPersonalization') ) !!}
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown" {!! classActivePath('/collection') !!}>
                            {!! link_to('/collection', trans('front/site.Collection'), "title=".trans('front/site.Collection')." data-toggle='dropdown' class='dropdown-toggle'" ) !!}
                            <ul class="dropdown-menu">
                                <li>
                                    {!! link_to('/collection/mattresses', trans('front/site.Mattresses'), "title=".trans('front/site.Mattresses') ) !!}
                                </li>
                                <li>
                                    {!! link_to('/collection/original-collection', trans('front/site.OriginalCollection'), "title=".trans('front/site.OriginalCollection') ) !!}
                                </li>
                                <li>
                                    {!! link_to('/collection/limited-edition-products', trans('front/site.LimitedEditionProducts'), "title=".trans('front/site.LimitedEditionProducts') ) !!}
                                </li>
                                <li>
                                    {!! link_to('/collection/prive-collection', trans('front/site.PriveCollection'), "title=".trans('front/site.PriveCollection') ) !!}
                                </li>
                                <li>
                                    {!! link_to('/collection/mattress-toppers', trans('front/site.MattressToppers'), "title=".trans('front/site.MattressToppers') ) !!}
                                </li>
                                <li>
                                    {!! link_to('/collection/bases', trans('front/site.Bases'), "title=".trans('front/site.Bases') ) !!}
                                </li>
                                <li>
                                    {!! link_to('/collection/beds', trans('front/site.Beds'), "title=".trans('front/site.Beds') ) !!}
                                </li>
                                <li>
                                    {!! link_to('/collection/headboards', trans('front/site.Headboards'), "title=".trans('front/site.Headboards') ) !!}
                                </li>
                                <li>
                                    {!! link_to('/collection/accessories', trans('front/site.Accessories'), "title=".trans('front/site.Accessories') ) !!}
                                </li>
                                <li>
                                    {!! link_to('/collection/cover-materials', trans('front/site.CoverMaterials'), "title=".trans('front/site.CoverMaterials') ) !!}
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown" {!! classActivePath('/customer_service') !!}>
                            {!! link_to('/customer_service', trans('front/site.CustomerService'), "title=".trans('front/site.CustomerService')." data-toggle='dropdown' class='dropdown-toggle'" ) !!}

                            <ul class="dropdown-menu">
                                <li>
                                    {!! link_to('/customer_service/our-promices', trans('front/site.OurPromices'), "title=".trans('front/site.OurPromices') ) !!}
                                </li>
                                <li>
                                    {!! link_to('/customer_service/customozation_service', trans('front/site.CustomozationService'), "title=".trans('front/site.CustomozationService') ) !!}
                                </li>
                                <li>
                                    {!! link_to('/customer_service/quality-sustainability', trans('front/site.QualitySustainability'), "title=".trans('front/site.QualitySustainability') ) !!}
                                </li>
                                <li>
                                    {!! link_to('/customer_service/register-your-guarantee-code', trans('front/site.RegisterYourGuaranteeCode'), "title=".trans('front/site.RegisterYourGuaranteeCode') ) !!}
                                </li>
                            </ul>
                        </li>


                        <li class="dropdown" {!! classActivePath('/find_us') !!}>
                            {!! link_to('/find_us', trans('front/site.FindUs'), "title=".trans('front/site.FindUs')." data-toggle='dropdown' class='dropdown-toggle'" ) !!}

                            <ul class="dropdown-menu">
                                <li>
                                    {!! link_to('/find_us/home', trans('front/site.Home'), "title=".trans('front/site.Home') ) !!}
                                </li>
                                <li>
                                    {!! link_to('/find_us/hotel', trans('front/site.Hotel'), "title=".trans('front/site.Hotel') ) !!}
                                </li>
                            </ul>
                        </li>

                        <li {!! classActivePath('/order_oatalogue') !!}>
                            {!! link_to('/order_oatalogue', trans('front/site.OrderCatalogue'), "title=".trans('front/site.OrderCatalogue') ) !!}
                        </li>


                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><img width="18" height="18" alt="{{ session('locale') }}"  src="{!! asset('img/' . session('locale') . '-flag.png') !!}" /></a>
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

            <img src="/img/logo_bottom.png" class="img-fluid">
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
    {!! HTML::script('js/jquery.form.min.js') !!}
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