@extends('front.template')

@if( config('app.locale') == "en" )

    @php
        $content = $post->en_content;
        $content_bottom = $post->en_content_bottom;
        $title = $post->en_title;
        $description = $post->en_description;
        $keywords = $post->en_keywords;
        $previevUrl = $post->en_image_input;
        $descriptionImage = $post->en_image_description;
        $slider = $post->en_slide_input;
    @endphp

@elseif( config('app.locale') == "fr" )

    @php
        $content = $post->fr_content;
        $content_bottom = $post->fr_content_bottom;
        $title = $post->fr_title;
        $description = $post->fr_description;
        $keywords = $post->fr_keywords;
        $previevUrl = $post->fr_image_input;
        $descriptionImage = $post->fr_image_description;
        $slider = $post->fr_slide_input;
    @endphp

@elseif( config('app.locale') == "de" )
    @php
        $content = $post->de_content;
        $content_bottom = $post->de_content_bottom;
        $title = $post->de_title;
        $description = $post->de_description;
        $keywords = $post->de_keywords;
        $previevUrl = $post->de_image_input;
        $descriptionImage = $post->de_image_description;
        $slider = $post->de_slide_input;
    @endphp

@endif

@section('head')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords  }}">




@stop

@section('main')

    @if( isset($previevUrl) && $previevUrl != '' )

        <section class="text-center">
            <img data-original="{{  isset($previevUrl) ? $previevUrl : '' }}" src="/img/img1x1.png" class="img-fluid lazy">
        </section>

    @endif


    <section class="jumbotron text-center bodyText marTB10">
        <div>
            {!! $content !!}
        </div>
    </section>



    <hr>
    @if(isset($slider) &&  $slider != '')
        <div class="row sliderBlock text-center">
            @foreach(json_decode(urldecode($slider)) as $item)
                <div class="col-lg-4">
                    <div class="sliderDescription">{{ $item->alt }}</div>
                    <a href="{{ $item->src }}" title="{{ $item->alt }}" data-lightbox="roadtrip">
                        <img data-original="{{ $item->src }}" class="img-fluid lazy" src="/img/img1x1.png" alt="{{ $item->alt }}" />
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    @if( isset($content_bottom) )
        <section class="jumbotron mainText marTB10">
            <div>
                {!! $content_bottom !!}
            </div>
        </section>
    @endif
@stop
