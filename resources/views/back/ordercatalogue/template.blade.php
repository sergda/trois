@extends('back.template')

@section('head')

    {!! HTML::style('ckeditor/plugins/codesnippet/lib/highlight/styles/default.css') !!}

@endsection

@section('main')

    @yield('entete')

    <div class="col-sm-12">
        @yield('form')

            <div class="form-group checkbox pull-right">
                <label>
                    {!! Form::checkbox('active') !!}
                    {{ trans('back/all.published') }}
                </label>
            </div>

        <div class="form-group checkbox pull-right" style="margin-right: 60px;">
            <label>
                {!! Form::checkbox('is_menu') !!}
                в меню
            </label>
        </div>

            {!! Form::controlBootstrap('text', 0, 'en_title', $errors, trans('back/all.en_title')) !!}
            {!! Form::controlBootstrap('text', 0, 'fr_title', $errors, trans('back/all.fr_title')) !!}
        {!! Form::controlBootstrap('text', 0, 'de_title', $errors, trans('back/all.de_title')) !!}
        {!! Form::controlBootstrap('text', 0, 'en_description', $errors, trans('back/all.en_description')) !!}
        {!! Form::controlBootstrap('text', 0, 'fr_description', $errors, trans('back/all.fr_description')) !!}
        {!! Form::controlBootstrap('text', 0, 'de_description', $errors, trans('back/all.de_description')) !!}
        {!! Form::controlBootstrap('text', 0, 'en_keywords', $errors, trans('back/all.en_keywords')) !!}
        {!! Form::controlBootstrap('text', 0, 'fr_keywords', $errors, trans('back/all.fr_keywords')) !!}
        {!! Form::controlBootstrap('text', 0, 'de_keywords', $errors, trans('back/all.de_keywords')) !!}

            <div class="form-group {!! $errors->has('slug') ? 'has-error' : '' !!}">
                {!! Form::label('slug', trans('back/all.permalink'), ['class' => 'control-label']) !!}
                {!! url('/') . '/order_catalogue/' . Form::text('slug', null, ['id' => 'permalink']) !!}
                <small class="text-danger">{!! $errors->first('slug') !!}</small>
            </div>

            {!! Form::controlBootstrap('textarea', 0, 'en_content', $errors, trans('back/all.en_content')) !!}
            {!! Form::controlBootstrap('textarea', 0, 'fr_content', $errors, trans('back/all.fr_content')) !!}
        {!! Form::controlBootstrap('textarea', 0, 'de_content', $errors, trans('back/all.de_content')) !!}

        {!! Form::submitBootstrap(trans('front/form.send')) !!}

    {!! Form::close() !!}

@if( isset($post) )

    <div class="row">
        <div class="col-md-4">
            <div class="imgBlock">
                @if (isset($en_image))
                    <div data-id_image="{{ $en_image->id }}" data-id_el="{{ $post->id }}" class="deleteImage">&times;</div>
                    <div>{{ isset($en_image->description) ? $en_image->description : ''  }}</div>
                    <img width="150" height="150" src="/files/{{ isset($en_image->revent_name) ? $en_image->revent_name : 'no_photo.png' }}" />
                @endif
            </div>
            <form class="gallery_upload" action="/ordercatalogueaddimage" method="post" enctype="multipart/form-data">
                <input type="hidden" name="field_images" value="en_images" />
                <input type="hidden" name="table" value="ordercatalogues" />
                <input type="hidden" name="img_type" value="images" />
                {!! Form::controlBootstrap('text', 0, 'description', $errors, 'Description') !!}
                <input type="hidden" name="id_el" value="{{ $post->id  }}" />
                {!! Form::controlBootstrap('file', 0, 'images', $errors, 'Картинка английского языка') !!}
                <input type="hidden" name="_token" value="{{ csrf_token()  }}" />
                <input type="submit" class="btn btn-default" value="Добавить">
            </form>
        </div>
        <div class="col-md-4">
            <div class="imgBlock">
                @if (isset($fr_image))
                    <div data-id_image="{{ $fr_image->id }}" data-id_el="{{ $post->id }}" class="deleteImage">&times;</div>
                    <div>{{ isset($fr_image->description) ? $fr_image->description : ''  }}</div>
                    <img width="150" height="150" src="/files/{{ isset($fr_image->revent_name) ? $fr_image->revent_name : 'no_photo.png' }}" />
                @endif
            </div>
            <form class="gallery_upload" action="/ordercatalogueaddimage" method="post" enctype="multipart/form-data">
                <input type="hidden" name="field_images" value="fr_images" />
                <input type="hidden" name="table" value="ordercatalogues" />
                <input type="hidden" name="img_type" value="images" />
                {!! Form::controlBootstrap('text', 0, 'description', $errors, 'Description') !!}
                <input type="hidden" name="id_el" value="{{ $post->id  }}" />
                {!! Form::controlBootstrap('file', 0, 'images', $errors, 'Картинка французкого языка') !!}
                <input type="hidden" name="_token" value="{{ csrf_token()  }}" />
                <input type="submit" class="btn btn-default" value="Добавить">
            </form>
        </div>
        <div class="col-md-4">
            <div class="imgBlock">
                @if (isset($de_image))
                    <div data-id_image="{{ $de_image->id }}" data-id_el="{{ $post->id }}" class="deleteImage">&times;</div>
                    <div>{{ isset($de_image->description) ? $de_image->description : ''  }}</div>
                    <img width="150" height="150" src="/files/{{ isset($de_image->revent_name) ? $de_image->revent_name : 'no_photo.png' }}" />
                @endif
            </div>
            <form class="gallery_upload" action="/ordercatalogueaddimage" method="post" enctype="multipart/form-data">
                <input type="hidden" name="field_images" value="de_images" />
                <input type="hidden" name="table" value="ordercatalogues" />
                <input type="hidden" name="img_type" value="images" />
                {!! Form::controlBootstrap('text', 0, 'description', $errors, 'Description') !!}
                <input type="hidden" name="id_el" value="{{ $post->id  }}" />
                {!! Form::controlBootstrap('file', 0, 'images', $errors, 'Картинка немецкого языка') !!}
                <input type="hidden" name="_token" value="{{ csrf_token()  }}" />
                <input type="submit" class="btn btn-default" value="Добавить">
            </form>
        </div>
    </div>
            <br /><br />
            <div class="progress">
                <div class="bar"></div>
                <div class="percent">0%</div>
            </div>
            <div id="status"></div>
    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="row">
                @if (isset($en_slider) && count($en_slider) > 0)
                    @foreach($en_slider as $slide)
                        <div class="col-md-6 imgBlock">
                            <div data-id_image="{{ $slide->id }}" data-id_el="{{ $post->id }}" class="deleteImage">&times;</div>
                            <div>{{ isset($slide->description) ? $slide->description : ''  }}</div>
                            <img width="150" height="150" src="/files/{{ $slide->revent_name }}" />
                        </div>
                    @endforeach
                @endif
            </div>


            <div style="clear: both"></div>

            <form class="gallery_upload" action="/ordercatalogueaddimage" method="post" enctype="multipart/form-data">
                <input type="hidden" name="field_images" value="en_slider" />
                <input type="hidden" name="table" value="ordercatalogues" />
                <input type="hidden" name="img_type" value="slider" />
                {!! Form::controlBootstrap('text', 0, 'description', $errors, 'Description') !!}
                <input type="hidden" name="id_el" value="{{ $post->id  }}" />
                {!! Form::controlBootstrap('file', 0, 'images', $errors, 'Картинки английского языка') !!}
                <input type="hidden" name="_token" value="{{ csrf_token()  }}" />
                <input type="submit" class="btn btn-default" value="Добавить">
            </form>
        </div>

        <div class="col-md-4">
            <div class="row">
                @if (isset($fr_slider) && count($fr_slider) > 0)
                    @foreach($fr_slider as $slide)
                        <div class="col-md-6 imgBlock">
                            <div data-id_image="{{ $slide->id }}" data-id_el="{{ $post->id }}" class="deleteImage">&times;</div>
                            <div>{{ isset($slide->description) ? $slide->description : ''  }}</div>
                            <img width="150" height="150" src="/files/{{ $slide->revent_name }}" />
                        </div>
                    @endforeach
                @endif
            </div>


            <div style="clear: both"></div>

            <form class="gallery_upload" action="/ordercatalogueaddimage" method="post" enctype="multipart/form-data">
                <input type="hidden" name="field_images" value="fr_slider" />
                <input type="hidden" name="table" value="ordercatalogues" />
                <input type="hidden" name="img_type" value="slider" />
                {!! Form::controlBootstrap('text', 0, 'description', $errors, 'Description') !!}
                <input type="hidden" name="id_el" value="{{ $post->id  }}" />
                {!! Form::controlBootstrap('file', 0, 'images', $errors, 'Картинки франсузкого языка') !!}
                <input type="hidden" name="_token" value="{{ csrf_token()  }}" />
                <input type="submit" class="btn btn-default" value="Добавить">
            </form>
        </div>

        <div class="col-md-4">
            <div class="row">
                @if (isset($de_slider) && count($de_slider) > 0)
                    @foreach($de_slider as $slide)
                        <div class="col-md-6 imgBlock">
                            <div data-id_image="{{ $slide->id }}" data-id_el="{{ $post->id }}" class="deleteImage">&times;</div>
                            <div>{{ isset($slide->description) ? $slide->description : ''  }}</div>
                            <img width="150" height="150" src="/files/{{ $slide->revent_name }}" />
                        </div>
                    @endforeach
                @endif
            </div>


            <div style="clear: both"></div>

            <form class="gallery_upload" action="/ordercatalogueaddimage" method="post" enctype="multipart/form-data">
                <input type="hidden" name="field_images" value="de_slider" />
                <input type="hidden" name="table" value="ordercatalogues" />
                <input type="hidden" name="img_type" value="slider" />
                {!! Form::controlBootstrap('text', 0, 'description', $errors, 'Description') !!}
                <input type="hidden" name="id_el" value="{{ $post->id  }}" />
                {!! Form::controlBootstrap('file', 0, 'images', $errors, 'Картинки неметского языка') !!}
                <input type="hidden" name="_token" value="{{ csrf_token()  }}" />
                <input type="submit" class="btn btn-default" value="Добавить">
            </form>
        </div>
    
    </div>

@endif

@endsection

@section('scripts')

{!! HTML::script('ckeditor/ckeditor.js') !!}


<script>

    var config = {
        codeSnippet_theme: 'Monokai',
        language: '{{ config('app.locale') }}',
        height: 100,
        allowedContent: true,
        filebrowserBrowseUrl: '/elfinder/ckeditor',
        toolbarGroups: [
            {name: 'clipboard', groups: ['clipboard', 'undo']},
            {name: 'editing', groups: ['find', 'selection', 'spellchecker']},
            {name: 'links'},
            {name: 'insert'},
            {name: 'forms'},
            {name: 'tools'},
            {name: 'document', groups: ['mode', 'document', 'doctools']},
            {name: 'others'},
            //'/',
            {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
            {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
            {name: 'styles'},
            {name: 'colors'}
        ]
    };

    //CKEDITOR.replace('en_summary', config);
    //CKEDITOR.replace('fr_summary', config);

    config['height'] = 100;

    CKEDITOR.replace('en_content', config);
    CKEDITOR.replace('fr_content', config);
    CKEDITOR.replace('de_content', config);

    function removeAccents(str) {
        var accent = [
            /[\300-\306]/g, /[\340-\346]/g, // A, a
            /[\310-\313]/g, /[\350-\353]/g, // E, e
            /[\314-\317]/g, /[\354-\357]/g, // I, i
            /[\322-\330]/g, /[\362-\370]/g, // O, o
            /[\331-\334]/g, /[\371-\374]/g, // U, u
            /[\321]/g, /[\361]/g, // N, n
            /[\307]/g, /[\347]/g // C, c
        ];
        var noaccent = ['A', 'a', 'E', 'e', 'I', 'i', 'O', 'o', 'U', 'u', 'N', 'n', 'C', 'c'];
        for (var i = 0; i < accent.length; ++i) {
            str = str.replace(accent[i], noaccent[i]);
        }
        return str;
    }

    $("#en_title").keyup(function () {
        var str = removeAccents($(this).val())
            .replace(/[^a-zA-Z0-9\s]/g, "")
            .toLowerCase()
            .replace(/\s/g, '-');
        $("#permalink").val(str);
    });

</script>

@endsection