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
                        <li>Privacy Policy</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcromb Area End -->

<!-- Upcoming Matches Area Start -->
<section class="onebox-upcoming-mathces-area section_50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <div class="onebox-section-heading" style="display: none;">
                    <h1 ><span>Privacy</span> Policy</h1>
                </div> 
            </div>
            <div class="col-md-12">
               


                
                   
                  <!--       @if($results['description'])
                            <h4>{{$results['title']}}</h4>
                        @endif -->
                        <?php
                        echo html_entity_decode($results['description'], ENT_COMPAT, 'UTF-8');
                        ?>
                       <!--  @if($results['description'])
                            {{htmlspecialchars_decode($results['description'])}};
                        @endif -->
                   
                </div>
            </div>
        </div>
    </section>
    <!-- Upcoming Matches Area End -->
    @endsection