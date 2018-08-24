@extends('frontend.layouts.main')
@section('title', $model->page_name)
@section('content') 

<section class="block-box-sign">
    <div class="row">
        <div class="sign-top-bg">
            <div class="container"> <h1>{{$model->page_name}}</h1></div>
        </div>
        <div class="container">
            <div class="col-md-12"> 

                <div class="" style="    margin-top: 25px;">
                   
                    <div class="col-sm-12">
                        <?php 
                        echo $model->content;
                        ?>
                       
                    </div>
                    
                    
                </div> 
            </div>
        </div> 
    </div>      
</section>
@endsection