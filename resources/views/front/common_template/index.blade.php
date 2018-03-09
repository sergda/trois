@extends('front.template')

@section('main')

    <div class="row">

        @foreach($items as $item)
            <div class="box">
                <div class="col-lg-12 text-center">
                    <h2>{{ $item->en_title }}
                    <br>
                    <small>{!! $item->user->username . ' ' . trans('front/testblock.on') . ' ' . strstr($item->created_at, ' ', true) . ($item->created_at != $item->updated_at ? trans('front/testblock.updated') . strstr($item->updated_at, ' ', true) : '') !!}</small>
                    </h2>
                </div>

                <div class="col-lg-12 text-center">
                    {!! link_to('block-test/' . $item->slug, trans('front/testblock.button'), ['class' => 'btn btn-default btn-lg']) !!}
                    <hr>
                </div>
            </div>
        @endforeach
     
        <div class="col-lg-12 text-center">
            {!! $items->links() !!}
        </div>

    </div>

@endsection

