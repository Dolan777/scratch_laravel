@extends('frontend.layouts.main')
@section('content')
<div class="contact-body">

    <section class="contact_btm_area" style=" color:#fff;">
        <div class="container">
            <div class="">
                <div class="row">

                   {!! $model->page_content !!}
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
