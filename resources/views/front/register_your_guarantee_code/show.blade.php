@extends('front.template')

@section('head')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trans('front/site.orderCatalogueTitle') }}</title>
    <meta name="description" content="{{ trans('front/site.orderCatalogueDescription') }}">
    <meta name="keywords" content="{{ trans('front/site.orderCatalogueKeywords') }}">

@stop
@section('main')
    <section class="jumbotron text-center bodyText marTB10" style="margin-bottom: 125px; z-index: 3;  position: relative;">
        <div>
            <div>{{ trans('front/site.orderCatalogueTitle') }}</div>
            <hr>
            <div class="registeredForm catalogueFeedback">
                <form name="sentMessage" class="form form-register1" id="catalogueFeedbackForm"  novalidate>
                    {{ csrf_field() }}
                    <div class="modal-body form-group">
                        <div class="control-group">
                            <div class="controls">
                                <input type="text" name="code" class="form-control" onblur='if(this.value=="") this.placeholder="№ CODE"' onfocus='if(this.value=="№ CODE") this.value=""' placeholder="№ CODE" id="name" required data-validation-required-message="Please, indicate № CODE" />
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <input type="email" name="email" class="form-control" onblur='if(this.value=="") this.placeholder="Your e-mail"' onfocus='if(this.value=="Your e-mail") this.value=""' placeholder="Your e-mail" id="email" required data-validation-required-message="Please, indicate Your e-mail" />
                            </div>
                        </div>
                        <div id="success"> </div>
                    </div>
                    <input type="hidden" name="name" value="">
                    <input type="hidden" name="catalogueFeedback" value="catalogueFeedback">
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-secondary form-button" value="Send">
                    </div>
                    <div id="success"> </div>
                </form>
            </div>
        </div>
    </section>
@stop
