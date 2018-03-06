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

            {!! Form::controlBootstrap('text', 0, 'title', $errors, trans('back/testblock.title')) !!}
        {!! Form::controlBootstrap('text', 0, 'description', $errors, trans('back/testblock.description')) !!}
        {!! Form::controlBootstrap('text', 0, 'keywords', $errors, trans('back/testblock.keywords')) !!}

            <div class="form-group {!! $errors->has('slug') ? 'has-error' : '' !!}">
                {!! Form::label('slug', trans('back/testblock.permalink'), ['class' => 'control-label']) !!}
                {!! url('/') . '/testblock/' . Form::text('slug', null, ['id' => 'permalink']) !!}
                <small class="text-danger">{!! $errors->first('slug') !!}</small>
            </div>

            {!! Form::controlBootstrap('textarea', 0, 'summary', $errors, trans('back/testblock.summary')) !!}
            {!! Form::controlBootstrap('textarea', 0, 'content', $errors, trans('back/testblock.content')) !!}
            {!! Form::controlBootstrap('text', 0, 'tags', $errors, trans('back/testblock.tags'), isset($tags)? implode(',', $tags) : '') !!}


             <img width="100" height="100" src="/files/{!! $post->image !!}"  alt="'" />

             {!! Form::controlBootstrap('file', 0, 'images', $errors, trans('back/testblock.image') ) !!}





        <!-- a style="display: inline-block; margin-top: 14px; margin-left: auto; margin-right: auto; user-select: none;" href="javascript:void(0)" title="Browse Server"
           hidefocus="true" class="cke_dialog_ui_button" role="button" aria-labelledby="cke_1043_label" id="cke_1044_uiElement" onclick='window.open("http://exemp/elfinder/ckeditor?CKEditor=summary&CKEditorFuncNum=1&langCode=en#elf_l1_XA");'>
            <span id="cke_1043_label" class="cke_dialog_ui_button">Browse Server</span></a -->




            {!! Form::submitBootstrap(trans('front/form.send')) !!}

        {!! Form::close() !!}
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

        CKEDITOR.replace('summary', config);

        config['height'] = 400;

        CKEDITOR.replace('content', config);

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

        $("#title").keyup(function () {
            var str = removeAccents($(this).val())
                .replace(/[^a-zA-Z0-9\s]/g, "")
                .toLowerCase()
                .replace(/\s/g, '-');
            $("#permalink").val(str);
        });

    </script>

@endsection