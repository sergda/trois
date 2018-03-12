@extends('back.customerservice.template')

@section('entete')
    @include('back.partials.entete', ['title' => trans('back/all.dashboard'), 'icon' => 'pencil', 'fil' => link_to('customerservice', trans('back/all.table')) . ' / ' . trans('back/all.edition')])
@endsection

@section('form')
    {!! Form::model($post, ['route' => ['adm_customerservice.update', $post->id], 'method' => 'put', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal panel']) !!}
@endsection
