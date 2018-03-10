@extends('back.worldtc.template')

@section('entete')
    @include('back.partials.entete', ['title' => trans('back/all.dashboard'), 'icon' => 'pencil', 'fil' => link_to('worldtc', trans('back/all.table')) . ' / ' . trans('back/all.edition')])
@endsection

@section('form')
    {!! Form::model($post, ['route' => ['worldtc.update', $post->id], 'method' => 'put', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal panel']) !!}
@endsection
