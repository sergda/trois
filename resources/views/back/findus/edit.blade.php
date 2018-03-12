@extends('back.findus.template')

@section('entete')
    @include('back.partials.entete', ['title' => trans('back/all.dashboard'), 'icon' => 'pencil', 'fil' => link_to('findus', trans('back/all.table')) . ' / ' . trans('back/all.edition')])
@endsection

@section('form')
    {!! Form::model($post, ['route' => ['adm_findus.update', $post->id], 'method' => 'put', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal panel']) !!}
@endsection
