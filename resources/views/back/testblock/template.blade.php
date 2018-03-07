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
                    {{ trans('back/testblock.published') }}
                </label>
            </div>

            {!! Form::controlBootstrap('text', 0, 'en_title', $errors, trans('back/testblock.en_title')) !!}
            {!! Form::controlBootstrap('text', 0, 'fr_title', $errors, trans('back/testblock.fr_title')) !!}
        {!! Form::controlBootstrap('text', 0, 'en_description', $errors, trans('back/testblock.en_description')) !!}
        {!! Form::controlBootstrap('text', 0, 'fr_description', $errors, trans('back/testblock.fr_description')) !!}
        {!! Form::controlBootstrap('text', 0, 'en_keywords', $errors, trans('back/testblock.en_keywords')) !!}
        {!! Form::controlBootstrap('text', 0, 'fr_keywords', $errors, trans('back/testblock.fr_keywords')) !!}

            <div class="form-group {!! $errors->has('slug') ? 'has-error' : '' !!}">
                {!! Form::label('slug', trans('back/testblock.permalink'), ['class' => 'control-label']) !!}
                {!! url('/') . '/testblock/' . Form::text('slug', null, ['id' => 'permalink']) !!}
                <small class="text-danger">{!! $errors->first('slug') !!}</small>
            </div>

            {!! Form::controlBootstrap('textarea', 0, 'en_content', $errors, trans('back/testblock.en_content')) !!}
            {!! Form::controlBootstrap('textarea', 0, 'fr_content', $errors, trans('back/testblock.fr_content')) !!}

            {!! Form::controlBootstrap('text', 0, 'tags', $errors, trans('back/testblock.tags'), isset($tags)? implode(',', $tags) : '') !!}


         <img width="100" height="100" src="/files/{!! $post->en_image !!}"  alt="'" />
         {!! Form::controlBootstrap('file', 0, 'en_images', $errors, trans('back/testblock.en_image') ) !!}

        <img width="100" height="100" src="/files/{!! $post->fr_image !!}"  alt="'" />
        {!! Form::controlBootstrap('file', 0, 'fr_images', $errors, trans('back/testblock.fr_image') ) !!}





    <!-- a style="display: inline-block; margin-top: 14px; margin-left: auto; margin-right: auto; user-select: none;" href="javascript:void(0)" title="Browse Server"
       hidefocus="true" class="cke_dialog_ui_button" role="button" aria-labelledby="cke_1043_label" id="cke_1044_uiElement" onclick='window.open("http://exemp/elfinder/ckeditor?CKEditor=summary&CKEditorFuncNum=1&langCode=en#elf_l1_XA");'>
        <span id="cke_1043_label" class="cke_dialog_ui_button">Browse Server</span></a -->




        {!! Form::submitBootstrap(trans('front/form.send')) !!}

    {!! Form::close() !!}


        <form class="gallery_upload" action="{{ action("TestBlockController@postAddImageItem") }}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                {{ Form::label("title", "Заголовок: ") }}
                {{ Form::text('title', false, array('class'=>'form-control', 'placeholder'=>'Заголовок')) }}
            </div>

            <div class="form-group">
                {{ Form::label("file", "Картинка: ") }}
                {{ Form::file('file', false, array('class'=>'form-control')) }}
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token()  }}" />
            <input type="submit" class="btn btn-default" value="Добавить">
        </form>

        <br /><br />
        <div class="progress">
            <div class="bar"></div>
            <div class="percent">0%</div>
        </div>
        <div id="status"></div>

</div>

@endsection

@section('scripts')

{!! HTML::script('ckeditor/ckeditor.js') !!}


<script>





    var config = {
        codeSnippet_theme: 'Monokai',
        language: '{{ config('app.locale') }}',
        height: 100,
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