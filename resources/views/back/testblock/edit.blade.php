@extends('back.testblock.template')

@section('entete')
    @include('back.partials.entete', ['title' => trans('back/testblock.dashboard'), 'icon' => 'pencil', 'fil' => link_to('testblock', trans('back/testblock.testblocks')) . ' / ' . trans('back/testblock.edition')])
@endsection

@section('form')
    {!! Form::model($post, ['route' => ['testblock.update', $post->id], 'method' => 'put', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal panel']) !!}
@endsection
