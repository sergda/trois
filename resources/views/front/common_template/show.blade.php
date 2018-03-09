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
        $title = $post->en_title;
        $description = $post->en_description;
        $keywords = $post->en_keywords;
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
                            <div class="col-lg-3">
                                <img class="img-fluid" src="/files/{{ $item->revent_name }}" />
                            </div>
                        @endforeach
                    </div>
                @endif


</div>

@stop
