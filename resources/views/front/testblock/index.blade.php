@extends('front.template')

@section('main')

    <div class="row">

        @foreach($testblocks as $post)
            <div class="box">
                <div class="col-lg-12 text-center">
                    <h2>{{ $post->title }}
                    <br>
                    <small>{!! $post->user->username . ' ' . trans('front/testblock.on') . ' ' . strstr($post->created_at, ' ', true) . ($post->created_at != $post->updated_at ? trans('front/testblock.updated') . strstr($post->updated_at, ' ', true) : '') !!}</small>
                    </h2>
                </div>
                {{--
                <div class="col-lg-12">
                    <p>{!! $post->summary !!}</p>
                </div>
                --}}
                <div class="col-lg-12 text-center">
                    {!! link_to('testblock/' . $post->slug, trans('front/testblock.button'), ['class' => 'btn btn-default btn-lg']) !!}
                    <hr>
                </div>
            </div>
        @endforeach
     
        <div class="col-lg-12 text-center">
            {!! $testblocks->links() !!}
        </div>

    </div>

@endsection

