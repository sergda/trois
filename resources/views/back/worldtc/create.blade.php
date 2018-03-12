@extends('back.worldtc.template')

@section('entete')
    @include('back.partials.entete', ['title' => trans('back/all.dashboard'), 'icon' => 'pencil', 'fil' => link_to('worldtc', trans('back/all.table')) . ' / ' . trans('back/all.creation')])
@endsection

@section('form')
    {!! Form::open(['url' => 'worldtc', 'method' => 'post', 'class' => 'form-horizontal panel']) !!}
@endsection
