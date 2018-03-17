@extends('front.template')

@section('head')

<title>Trois Couronnes</title>
<meta name="description" content="Trois Couronnes">
<meta name="keywords" content="Trois Couronnes">

@stop

@section('main')

    <div class="row">

        @foreach($items as $item)
            <div class="box">
                <div class="col-lg-12 text-center">
                    <h2>{{  (config('app.locale') == "en") ? $item->en_title : (config('app.locale') == "fr") ? $item->fr_title : (config('app.locale') == "fr") ? $item->de_title : '-'  }}</h2>
                </div>
                <div class="col-lg-12 text-center">
                    {!! link_to('block-test/' . $item->slug, trans('front/all.button'), ['class' => 'btn btn-default btn-lg']) !!}
                    <hr>
                </div>
            </div>
        @endforeach
     
        <div class="col-lg-12 text-center">
            {!! $items->links() !!}
        </div>

    </div>

@endsection

