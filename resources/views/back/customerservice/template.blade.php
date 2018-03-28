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

        <div class="form-group checkbox pull-right" style="margin-right: 60px; font-weight: bold;">
            <label>
                Sort
                <input style="width:70px;" type="number" id="sort" name="sort" value="{{ ( isset($post) && isset($post->sort) ) ? $post->sort  : '' }}" required/>
            </label>
        </div>

        <div class="clearfix"></div>


        <div class="form-group {!! $errors->has('slug') ? 'has-error' : '' !!}">
            {!! Form::label('slug', trans('back/all.permalink'), ['class' => 'control-label']) !!}
            {!! url('/') . '/customer_service/' . Form::text('slug', null, ['id' => 'permalink']) !!}
            <small class="text-danger">{!! $errors->first('slug') !!}</small>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-4">
                {!! Form::controlBootstrap('text', 0, 'en_title', $errors, trans('back/all.en_title')) !!}
            </div>
            <div class="col-md-4">
                {!! Form::controlBootstrap('text', 0, 'fr_title', $errors, trans('back/all.fr_title')) !!}
            </div>
            <div class="col-md-4">
                {!! Form::controlBootstrap('text', 0, 'de_title', $errors, trans('back/all.de_title')) !!}
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-4">
                {!! Form::controlBootstrap('text', 0, 'en_description', $errors, trans('back/all.en_description')) !!}
            </div>
            <div class="col-md-4">
                {!! Form::controlBootstrap('text', 0, 'fr_description', $errors, trans('back/all.fr_description')) !!}
            </div>
            <div class="col-md-4">
                {!! Form::controlBootstrap('text', 0, 'de_description', $errors, trans('back/all.de_description')) !!}
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-4">
                {!! Form::controlBootstrap('text', 0, 'en_keywords', $errors, trans('back/all.en_keywords')) !!}
            </div>
            <div class="col-md-4">
                {!! Form::controlBootstrap('text', 0, 'fr_keywords', $errors, trans('back/all.fr_keywords')) !!}
            </div>
            <div class="col-md-4">
                {!! Form::controlBootstrap('text', 0, 'de_keywords', $errors, trans('back/all.de_keywords')) !!}
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-4">
                {!! Form::controlBootstrap('textarea', 0, 'en_content', $errors, trans('back/all.en_content')) !!}
            </div>
            <div class="col-md-4">
                {!! Form::controlBootstrap('textarea', 0, 'fr_content', $errors, trans('back/all.fr_content')) !!}
            </div>
            <div class="col-md-4">
                {!! Form::controlBootstrap('textarea', 0, 'de_content', $errors, trans('back/all.de_content')) !!}
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-4">
                {!! Form::controlBootstrap('textarea', 0, 'en_content_bottom', $errors, trans('back/all.en_content_bottom')) !!}
            </div>
            <div class="col-md-4">
                {!! Form::controlBootstrap('textarea', 0, 'fr_content_bottom', $errors, trans('back/all.fr_content_bottom')) !!}
            </div>
            <div class="col-md-4">
                {!! Form::controlBootstrap('textarea', 0, 'de_content_bottom', $errors, trans('back/all.de_content_bottoom')) !!}
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row imagePreviewBlock">
            <div class="col-md-12"><h3>Preview Image</h3></div>
            <div class="clearfix"></div>
            <div class="col-md-4 imagePreviewCol">
                <span class="close_img">&times;</span>
                <div>
                    <img class="en_image_input" src="{{ ( isset($post) && isset($post->en_image_input) && $post->en_image_input != '' ) ? $post->en_image_input  : '/files/no_photo.png' }}" />
                    <input type="hidden" id="en_image_input" name="en_image_input" value="{{ ( isset($post) && isset($post->en_image_input) ) ? $post->en_image_input  : '' }}"/>
                    <a href="" class="popup_selector" data-inputid="en_image_input">Select Preview Image</a>
                </div>
                {!! Form::controlBootstrap('text', 0, 'en_image_description', $errors, 'Description image') !!}
            </div>
            <div class="col-md-4 imagePreviewCol">
                <span class="close_img">&times;</span>
                <div>
                    <img class="fr_image_input" src="{{ ( isset($post) && isset($post->fr_image_input) && $post->fr_image_input != '' ) ? $post->fr_image_input  : '/files/no_photo.png' }}" />
                    <input type="hidden" id="fr_image_input" name="fr_image_input" value="{{ ( isset($post) && isset($post->fr_image_input) ) ? $post->fr_image_input  : '' }}"/>
                    <a href="" class="popup_selector" data-inputid="fr_image_input">Select Preview Image</a>
                </div>
                {!! Form::controlBootstrap('text', 0, 'fr_image_description', $errors, 'Description image') !!}
            </div>
            <div class="col-md-4 imagePreviewCol">
                <span class="close_img">&times;</span>
                <div>
                    <img class="de_image_input" src="{{ ( isset($post) && isset($post->de_image_input) && $post->de_image_input != '' ) ? $post->de_image_input  : '/files/no_photo.png' }}"/>
                    <input type="hidden" id="de_image_input" name="de_image_input" value="{{ ( isset($post) && isset($post->de_image_input) ) ? $post->de_image_input  : '' }}"/>
                    <a href="" class="popup_selector" data-inputid="de_image_input">Select Preview Image</a>
                </div>
                {!! Form::controlBootstrap('text', 0, 'de_image_description', $errors, 'Description image') !!}
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row" style="margin-bottom: 20px;">

            <div class="col-md-4 sliderBlock">
                <div id="en_slidexBox" class="row en_slidexBox sliderxBox">
                    @if(isset($post) && isset($post->en_slide_input) && $post->en_slide_input != '')
                        @foreach(json_decode(urldecode($post->en_slide_input)) as $slide )
                            <div class="col-md-6 imgBlock">
                                <div class="deleteImageSlider">&times;</div>
                                <div style="text-align: center;">{{ $slide->alt  }}</div>
                                <img src="{{ $slide->src  }}" alt="{{ $slide->alt  }}" style="width: 150px; height: 150px;"/>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div>
                    <label>
                        Description
                        <input type="text" class="descriptionSlide" value="">
                    </label>
                    <a href="" class="popup_selector" data-inputid="en_slidexBox">Add Image</a>
                    <input type="hidden" class="slide_input" name="en_slide_input" value="{{ ( isset($post) && isset($post->en_slide_input) ) ? $post->en_slide_input  : '' }}"/>
                </div>
            </div>

            <div class="col-md-4 sliderBlock">
                <div id="fr_slidexBox" class="row fr_slidexBox sliderxBox">
                    @if(isset($post) && isset($post->fr_slide_input) && $post->fr_slide_input != '')
                        @foreach(json_decode(urldecode($post->fr_slide_input)) as $slide )
                            <div class="col-md-6 imgBlock">
                                <div class="deleteImageSlider">&times;</div>
                                <div style="text-align: center;">{{ $slide->alt  }}</div>
                                <img src="{{ $slide->src  }}" alt="{{ $slide->alt  }}" style="width: 150px; height: 150px;"/>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div>
                    <label>
                        Description
                        <input type="text" class="descriptionSlide" value="">
                    </label>
                    <a href="" class="popup_selector" data-inputid="fr_slidexBox">Add Image</a>
                    <input type="hidden" class="slide_input" name="fr_slide_input" value="{{ ( isset($post) && isset($post->fr_slide_input) ) ? $post->fr_slide_input  : '' }}"/>
                </div>
            </div>

            <div class="col-md-4 sliderBlock">
                <div id="de_slidexBox" class="row de_slidexBox sliderxBox">
                    @if(isset($post) && isset($post->de_slide_input) && $post->de_slide_input != '')
                        @foreach(json_decode(urldecode($post->de_slide_input)) as $slide )
                            <div class="col-md-6 imgBlock">
                                <div class="deleteImageSlider">&times;</div>
                                <div style="text-align: center;">{{ $slide->alt  }}</div>
                                <img src="{{ $slide->src  }}" alt="{{ $slide->alt  }}" style="width: 150px; height: 150px;"/>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div>
                    <label>
                        Description
                        <input type="text" class="descriptionSlide" value="">
                    </label>
                    <a href="" class="popup_selector" data-inputid="de_slidexBox">Add Image</a>
                    <input type="hidden" class="slide_input" name="de_slide_input" value="{{ ( isset($post) && isset($post->de_slide_input) ) ? $post->de_slide_input  : '' }}"/>
                </div>
            </div>


        </div>
        <div class="clearfix"></div>

        {!! Form::submitBootstrap(trans('front/form.send')) !!}

    {!! Form::close() !!}

@if( isset($post) )

    <div class="row">

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

            <form class="gallery_upload" action="/customerserviceaddimage" method="post" enctype="multipart/form-data">
                <input type="hidden" name="field_images" value="en_slider" />
                <input type="hidden" name="table" value="customerservices" />
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

            <form class="gallery_upload" action="/customerserviceaddimage" method="post" enctype="multipart/form-data">
                <input type="hidden" name="field_images" value="fr_slider" />
                <input type="hidden" name="table" value="customerservices" />
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

            <form class="gallery_upload" action="/customerserviceaddimage" method="post" enctype="multipart/form-data">
                <input type="hidden" name="field_images" value="de_slider" />
                <input type="hidden" name="table" value="customerservices" />
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

    $(document).ready(function(){

        $(".close_img").on("click",function(){
            var boxImg = $(this).parent("div.col-md-4");
            //$(this).hide();
            $(boxImg).find("img").attr("src","/files/no_photo.png");
            $(boxImg).find("input").val("");
        });
    });

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
    CKEDITOR.replace('en_content_bottom', config);
    CKEDITOR.replace('fr_content', config);
    CKEDITOR.replace('fr_content_bottom', config);
    CKEDITOR.replace('de_content', config);
    CKEDITOR.replace('de_content_bottom', config);

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