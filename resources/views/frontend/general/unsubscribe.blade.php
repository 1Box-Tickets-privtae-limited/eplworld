@extends('layouts.app')
@section('content')

<!-- Breadcromb Area Start -->
<section class="onebox-breadcromb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <ul>
                        <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i> {{__('messages.home')}}</a></li>
                        <li>/</li>
                        <li>UnSubscribe</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcromb Area End -->
<style type="text/css">
    .unsubscribe{
        box-shadow: 0px 0px 8px #ccc;
        min-height: 200px;
        padding: 20px;
    }
    .bg-color{
        background: #b00505;
        border: 1px solid #b00505;
    }
</style>
<section class="section_50">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="unsubscribe">
                    <h2>Are you sure  you want to unsubscribe?</h2>
                    <hr>

                       @if(Session::has('error'))

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <strong>
                                        {{ Session::get('error') }}
                                    </strong>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(Session::has('success'))

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="alert alert-success" role="alert">
                                        <strong>
                                            {{Session::get('success')}}
                                        </strong>
                                    
                                    </div>
                                </div>
                            </div>
                        @endif

                         @if (isset($errors) && count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <form method="post" action="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" name="email" id="email" value="" required>
                        </div>
                      <div class="form-group">
                        <label for="reason">Why  are you unsubscribe? (optional)</label>

                        <textarea class="form-control" name="reason" id="reason" rows="3" style="resize: none;"></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary bg-color">Unsubscribe</button>
                    </form>
                </div>
            </div>       
        </div>
    </div>
</section>
@endsection