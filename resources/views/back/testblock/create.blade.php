@extends('back.testblock.template')

@section('entete')
    @include('back.partials.entete', ['title' => trans('back/testblock.dashboard'), 'icon' => 'pencil', 'fil' => link_to('testblock', trans('back/testblock.testblocks')) . ' / ' . trans('back/testblock.creation')])
@endsection

@section('form')
    {!! Form::open(['url' => 'testblock', 'method' => 'post', 'class' => 'form-horizontal panel']) !!}
@endsection
