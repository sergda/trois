@extends('front.template')

@if( config('app.locale') == "en" )

    @if( isset( $en_image ) )

        @php
            $previevUrl = '/files/'.$en_image->revent_name;
        @endphp

    @endif

    @if( isset( $en_slider ) )

        @php
            $slider = $en_slider;
        @endphp

    @endif

    @php
        $content = $post->en_content;
        $title = $post->en_title;
        $description = $post->en_description;
        $keywords = $post->en_keywords;
    @endphp

@elseif( config('app.locale') == "fr" )

    @if( isset( $fr_image ) )

        @php
            $previevUrl = '/files/'.$fr_image->revent_name;
        @endphp

    @endif

    @if( isset( $fr_slider ) )

        @php
            $slider = $fr_slider;
        @endphp

    @endif

    @php
        $content = $post->fr_content;
        $title = $post->fr_title;
        $description = $post->fr_description;
        $keywords = $post->fr_keywords;
    @endphp

@elseif( config('app.locale') == "de" )

    @if( isset( $de_image ) )

        @php
            $previevUrl = '/files/'.$de_image->revent_name;
        @endphp

    @endif

    @if( isset( $de_slider ) )

        @php
            $slider = $de_slider;
        @endphp

    @endif

    @php
        $content = $post->de_content;
        $title = $post->de_title;
        $description = $post->de_description;
        $keywords = $post->de_keywords;
    @endphp

@endif

@section('head')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords  }}">




@stop

@section('main')

                @if( isset($previevUrl) )

                    <section class="text-center">
                        <img src="{{  isset($previevUrl) ? $previevUrl : '' }}" class="img-fluid">
                    </section>

                @endif


                <section class="jumbotron text-center marTB10">
                    <div>
                        {!! $content !!}
                    </div>
                </section>



                <hr>
                @if($slider->count())
                    <div class="row sliderBlock text-center">
                        @foreach($slider as $item)
                            <div class="col-lg-4">
                                <a href="/files/{{ $item->revent_name }}" data-lightbox="roadtrip">
                                    <img class="img-fluid" src="/files/{{ $item->revent_name }}" />
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif


</div>

@stop