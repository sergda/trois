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


        {!! Form::submitBootstrap(trans('front/form.send')) !!}

    {!! Form::close() !!}


<div class="row">
    <div class="col-md-6">
        <div class="imgBlock">
            @if (isset($en_image))
                <div data-id_image="{{ $en_image->id }}" data-id_el="{{ $post->id }}" class="deleteImage">&times;</div>
                <img width="150" height="150" src="/files/{{ isset($en_image->revent_name) ? $en_image->revent_name : 'no_photo.png' }}" />
            @endif
        </div>
        <form class="gallery_upload" action="{{ action("ImagesProjectController@postAddImageItem") }}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="field_images" value="en_images" />
            <input type="hidden" name="table" value="testblocks" />
            <input type="hidden" name="img_type" value="images" />
            <input type="hidden" name="id_el" value="{{ $post->id  }}" />
            {!! Form::controlBootstrap('file', 0, 'images', $errors, 'Картинка английского языка') !!}
            <input type="hidden" name="_token" value="{{ csrf_token()  }}" />
            <input type="submit" class="btn btn-default" value="Добавить">
        </form>
    </div>
    <div class="col-md-6">
        <div class="imgBlock">
            @if (isset($fr_image))
                <div data-id_image="{{ $fr_image->id }}" data-id_el="{{ $post->id }}" class="deleteImage">&times;</div>
                <img width="150" height="150" src="/files/{{ isset($fr_image->revent_name) ? $fr_image->revent_name : 'no_photo.png' }}" />
            @endif
        </div>
        <form class="gallery_upload" action="{{ action("ImagesProjectController@postAddImageItem") }}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="field_images" value="fr_images" />
            <input type="hidden" name="table" value="testblocks" />
            <input type="hidden" name="img_type" value="images" />
            <input type="hidden" name="id_el" value="{{ $post->id  }}" />
            {!! Form::controlBootstrap('file', 0, 'images', $errors, 'Картинка французкого языка') !!}
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

    <div class="col-md-6">
        <div class="row">
            @if (isset($en_slider) && count($en_slider) > 0)
                @foreach($en_slider as $slide)
                    <div class="col-md-6 imgBlock">
                        <div data-id_image="{{ $slide->id }}" data-id_el="{{ $post->id }}" class="deleteImage">&times;</div>
                        <img width="150" height="150" src="/files/{{ $slide->revent_name }}" />
                    </div>
                @endforeach
            @endif
        </div>


        <div style="clear: both"></div>

        <form class="gallery_upload" action="{{ action("ImagesProjectController@postAddImageItem") }}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="field_images" value="en_slider" />
            <input type="hidden" name="table" value="testblocks" />
            <input type="hidden" name="img_type" value="slider" />
            <input type="hidden" name="id_el" value="{{ $post->id  }}" />
            {!! Form::controlBootstrap('file', 0, 'images', $errors, 'Картинки английского языка') !!}
            <input type="hidden" name="_token" value="{{ csrf_token()  }}" />
            <input type="submit" class="btn btn-default" value="Добавить">
        </form>
    </div>

    <div class="col-md-6">
        <div class="row">
            @if (isset($fr_slider) && count($fr_slider) > 0)
                @foreach($fr_slider as $slide)
                    <div class="col-md-6 imgBlock">
                        <div data-id_image="{{ $slide->id }}" data-id_el="{{ $post->id }}" class="deleteImage">&times;</div>
                        <img width="150" height="150" src="/files/{{ $slide->revent_name }}" />
                    </div>
                @endforeach
            @endif
        </div>


        <div style="clear: both"></div>

        <form class="gallery_upload" action="{{ action("ImagesProjectController@postAddImageItem") }}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="field_images" value="fr_slider" />
            <input type="hidden" name="table" value="testblocks" />
            <input type="hidden" name="img_type" value="slider" />
            <input type="hidden" name="id_el" value="{{ $post->id  }}" />
            {!! Form::controlBootstrap('file', 0, 'images', $errors, 'Картинки франсузкого языка') !!}
            <input type="hidden" name="_token" value="{{ csrf_token()  }}" />
            <input type="submit" class="btn btn-default" value="Добавить">
        </form>
    </div>

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