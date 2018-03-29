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

        {!! HTML::style('css/back.css') !!}
        {!! HTML::style('css/colorbox.css') !!}
        {!! HTML::style('css/jquery-ui.min.css') !!}

        {!! HTML::script('js/jquery-3.0.0.js') !!}
        {!! HTML::script('js/bootstrap3.3.7.min.js') !!}
        {!! HTML::script('js/sweetalert.min.js') !!}
        {!! HTML::script('js/jquery.form.min.js') !!}
        {!! HTML::script('js/jquery.colorbox-min.js') !!}
        {!! HTML::script('packages/barryvdh/elfinder/js/standalonepopup.js') !!}
        {!! HTML::script('js/jquery-ui.min.js') !!}

        @yield('head')

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    @if(session('statut') == 'admin')
                        {!! link_to_route('admin', trans('back/admin.administration'), [], ['class' => 'navbar-brand']) !!}
                    @else
                        {!! link_to_route('blog.index', trans('back/admin.redaction'), [], ['class' => 'navbar-brand']) !!}
                    @endif
                </div>
                <!-- Top menu -->
                <ul class="nav navbar-right top-nav">
                    <li>{!! link_to_route('home', trans('back/admin.home')) !!}</li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-user"></span> {{ auth()->user()->username }}<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ url('/logout') }}" id="logout">
                                    <span class="fa fa-fw fa-power-off"></span>
                                    {{ trans('back/admin.logout') }}
                                </a>   
                                {!! Form::open(['url' => '/logout', 'id' => 'logout-form']) !!}{!! Form::close() !!}
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Side menu -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        @if(session('statut') == 'admin')
                            <li {!! classActivePath('admin') !!}>
                                <a href="{!! route('admin') !!}"><span class="fa fa-fw fa-dashboard"></span> {{ trans('back/admin.dashboard') }}</a>
                            </li>
                            <li {!! classActiveSegment(1, 'user') !!}>
                                <a href="#" data-toggle="collapse" data-target="#usermenu"><span class="fa fa-fw fa-user"></span> {{ trans('back/admin.users') }} <span class="fa fa-fw fa-caret-down"></span></a>
                                <ul id="usermenu" class="collapse">
                                    <li><a href="{!! url('user/sort') !!}">{{ trans('back/admin.see-all') }}</a></li>
                                    <li><a href="{!! url('user/create') !!}">{{ trans('back/admin.add') }}</a></li>
                                    <li><a href="{!! url('roles') !!}">{{ trans('back/roles.roles') }}</a></li>
                                    <li><a href="{!! url('user/blog-report') !!}">{{ trans('back/admin.blog-report') }}</a></li>
                                </ul>
                            </li>
{{--
                            <li {!! classActivePath('contact') !!}>
                                <a href="{!! url('contact') !!}"><span class="fa fa-fw fa-envelope"></span> {{ trans('back/admin.messages') }}</a>
                            </li>
                            <li {!! classActivePath('comment') !!}>
                                <a href="{!! url('comment') !!}"><span class="fa fa-fw fa-comments"></span> {{ trans('back/admin.comments') }}</a>
                            </li>
 --}}
                        @endif
                        <li {!! classActivePath('medias') !!}>
                            <a href="{!! route('medias') !!}"><span class="fa fa-fw fa-file-image-o"></span> {{ trans('back/admin.medias') }}</a>
                        </li>

 {{--
                        <li {!! classActiveSegment(1, 'blog') !!}>
                            <a href="#" data-toggle="collapse" data-target="#articlemenu"><span class="fa fa-fw fa-pencil"></span> {{ trans('back/admin.posts') }} <span class="fa fa-fw fa-caret-down"></span></a>
                            <ul id="articlemenu" class="collapse">
                                <li><a href="{!! url('blog') !!}">{{ trans('back/admin.see-all') }}</a></li>
                                <li><a href="{!! url('blog/create') !!}">{{ trans('back/admin.add') }}</a></li>
                            </ul>
                        </li>


                        <li {!! classActiveSegment(1, 'testblock') !!}>
                            <a href="#" data-toggle="collapse" data-target="#testblockmenu"><span class="fa fa-fw fa-pencil"></span> {{ trans('back/admin.testblock') }} <span class="fa fa-fw fa-caret-down"></span></a>
                            <ul id="testblockmenu" class="collapse">
                                <li><a href="{!! url('testblock') !!}">{{ trans('back/admin.see-all') }}</a></li>
                                <li><a href="{!! url('testblock/create') !!}">{{ trans('back/admin.add') }}</a></li>
                            </ul>
                        </li>
--}}
                        <li {!! classActiveSegment(1, 'worldtc') !!}>
                            <a href="#" data-toggle="collapse" data-target="#worldtcmenu"><span class="fa fa-fw fa-pencil"></span> {{ trans('back/admin.worldtc') }} <span class="fa fa-fw fa-caret-down"></span></a>
                            <ul id="worldtcmenu" class="collapse">
                                <li><a href="{!! url('worldtc') !!}">{{ trans('back/admin.see-all') }}</a></li>
                                <li><a href="{!! url('worldtc/create') !!}">{{ trans('back/admin.add') }}</a></li>
                            </ul>
                        </li>

                            <li {!! classActiveSegment(1, 'adm_collection') !!}>
                                <a href="#" data-toggle="collapse" data-target="#collectionmenu"><span class="fa fa-fw fa-pencil"></span> {{ trans('back/admin.collection') }} <span class="fa fa-fw fa-caret-down"></span></a>
                                <ul id="collectionmenu" class="collapse">
                                    <li><a href="{!! url('adm_collection') !!}">{{ trans('back/admin.see-all') }}</a></li>
                                    <li><a href="{!! url('adm_collection/create') !!}">{{ trans('back/admin.add') }}</a></li>
                                </ul>
                            </li>

                            <li {!! classActiveSegment(1, 'adm_customerservice') !!}>
                                <a href="#" data-toggle="collapse" data-target="#customerservicemenu"><span class="fa fa-fw fa-pencil"></span> {{ trans('back/admin.customerservice') }} <span class="fa fa-fw fa-caret-down"></span></a>
                                <ul id="customerservicemenu" class="collapse">
                                    <li><a href="{!! url('adm_customerservice') !!}">{{ trans('back/admin.see-all') }}</a></li>
                                    <li><a href="{!! url('adm_customerservice/create') !!}">{{ trans('back/admin.add') }}</a></li>
                                </ul>
                            </li>

                            <li {!! classActiveSegment(1, 'adm_findus') !!}>
                                <a href="#" data-toggle="collapse" data-target="#findusmenu"><span class="fa fa-fw fa-pencil"></span> {{ trans('back/admin.findus') }} <span class="fa fa-fw fa-caret-down"></span></a>
                                <ul id="findusmenu" class="collapse">
                                    <li><a href="{!! url('adm_findus') !!}">{{ trans('back/admin.see-all') }}</a></li>
                                    <li><a href="{!! url('adm_findus/create') !!}">{{ trans('back/admin.add') }}</a></li>
                                </ul>
                            </li>

                        @if(!empty($notifications))
                            <li><a href="{!! url('notifications/' . auth()->id()) !!}"><span class="fa fa-fw fa-bell-o"></span> Notifications</a></li>
                        @endif
                    </ul>
                </div>
            </nav>

            <div id="page-wrapper">

                <div class="container-fluid">

                    @yield('main')

                </div>

            </div>

        </div>



        <script>

            $(function() {

                $('.deleteImage').on('click', function() {

                    var id_image = $(this).data('id_image');
                    var id_el = $(this).data('id_el');
                    var el = $(this).parent('.imgBlock');
                    $.ajax({
                        url: '{{ url('delete-image') }}' + '/' + id_image,
                        type: 'PUT',
                        data: { id_image: id_image, id_el:id_el }
                    })
                            .done(function() {
                                $(el).remove();
                            })
                            .fail(function() {
                                alert('{{ trans('back/testblock.fail') }}');
                            });
                });


                $('#logout').click(function(e) {
                    e.preventDefault();
                    $('#logout-form').submit();
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('.btn-destroy').on('click',function(e){
                    e.preventDefault();
                    var form = $(this).parents('form');
                    swal({
                        title: $(this).attr('data-title'),
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{!! trans('front/site.yes') !!}",
                        cancelButtonText: "{!! trans('front/site.no') !!}"
                    }, function(isConfirm){
                        if (isConfirm) form.submit();
                    });
                });


                var bar = $('.bar');
                var percent = $('.percent');
                var status = $('#status');
                var form = $('.gallery_upload');
                form.ajaxForm({
                    beforeSend: function() {
                        //status.empty();
                        var percentVal = '0%';
                        bar.width(percentVal)
                        form.find(".has-error").removeClass("has-error");
                        percent.html(percentVal);
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentVal = percentComplete + '%';
                        bar.width(percentVal);
                        percent.html(percentVal);
                        //console.log(percentVal, position, total);
                    },
                    success: function() {
                        var percentVal = '100%';
                        bar.width(percentVal);
                        percent.html(percentVal);
                    },
                    complete: function(data) {
                        status.html(data.responseText);
                        data = $.parseJSON(data.responseText);
                        if (!data.success) {
                            for (var k in data.errors)
                            {
                                form.find("[name="+ k +"]").parent().addClass("has-error");
                            }
                        }
                        else {
                            location.reload();
                        }
                    }
                });



            });

        </script>

        @yield('scripts')

    </body>
</html>