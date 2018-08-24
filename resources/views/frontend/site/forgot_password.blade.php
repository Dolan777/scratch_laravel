@extends('frontend.layouts.main')
@section('content')
 <div class="contact-body">
            <!-- *****************Banner-start****************** -->
            <section class="banner-sec-inner cst_banner-sec-inner">
                <div class="container">
                    <div class="row">
                     <div class="col-md-12 col-sm-12">
                            <h2 class="new-heading">Forgot Password</h2>
                          
                        </div>
                    </div>
                </div>
            </section>
            <!-- ************************Banner-end**************** -->

            <!-- *****************about-section-start****************** -->
               <section class="contact_btm_area">
            <div class="container">
                <div class="row">
                   
                    <div class="col-md-6 col-md-offset-3">
                        <section class="right-part">
                            <div class="top-part">
                                <h2>Forgot Password</h2>
                      
                            </div>

                            <form class="form" role="form" method="post"  action="{{Route('forget-password')}}">
                                {{csrf_field()}}
                                <div class="row">
                                 
                                    <div class="col-sm-12">
                                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">

                                            <input class="form-control" placeholder="Email*" name="email" id="email" type="text">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    {{ $errors->first('email') }}
                                                </span>
                                                @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="btn-rap text-left">
                                  
                                    <button type="submit" class="btn btnall">SUBMIT</button>
                                </div>
                            </form>


                        </section>
                    </div>
                </div>
            </div>
        </section>

         

        </div>
@endsection

