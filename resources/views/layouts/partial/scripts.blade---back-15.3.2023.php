     <div class="full-loading">Loading&#8230;</div>
    <!-- jQuery -->
    <script src="{{asset('/')}}public/js/jquery.min.js"></script>
    <script>

        //  $.get("https://ipapi.co/json/", function(data, status){
        //             console.log('data',data);
                
        //         });
         
        // var default_country ="{{Session::get('country_code')}}";
        // if(default_country == undefined || default_country ==""){
        //     if (localStorage.getItem("country") === null) {
        //         $.get("https://ipapi.co/json/", function(data, status){
        //         if(status == "success"){
        //             localStorage.setItem('country', data.country);
        //         }
        //         });
                
        //     }else{
        //         default_country = localStorage.getItem("country");
        //     } 
        // }

          var default_country = "{{(@$_COOKIE['client_country'] != '') ? @$_COOKIE['client_country'] : 'GB';}}";
    </script>
    <!-- Bootstrap JS -->
    <script src="{{asset('/')}}public/js/bootstrap.min.js"></script>
    
    <!-- Magnific Popup JS -->
    <script src="{{asset('/')}}public/js/jquery.magnific-popup.min.js"></script>
    
    <!-- OwlCarousel JS -->
    <script src="{{asset('/')}}public/js/owl.carousel.min.js"></script>
    
    <!-- SlickNav JS -->
    <script src="{{asset('/')}}public/assets/js/jquery.slicknav.min.js"></script>
    
    <!-- Scrollbar JS -->
    <script src="{{asset('/')}}public/js/jquery-perfect-scrollbar.min.js"></script>

    <script src="{{asset('/')}}public/js/menu-js.js"></script>
    
    <!-- Countdown JS -->
    <script src="{{asset('/')}}public/js/jquery.countdown.min.js"></script>
        
    <!-- Custom JS -->
    <script src="{{asset('/')}}public/js/custom.js?v=1"></script>
    <script src="{{asset('/')}}public/js/jquery.validate.min.js"></script>
    <!--<script src="{{asset('/')}}public/js/intlTelInput.js"></script> -->
    <script src="{{asset('/')}}public/js/intlTelInput.min.js?v=122334444"></script>
    
    <script src="{{asset('/')}}public/js/app.js?v=2.7.656563921"></script>
    @if(App::getLocale() == "ar")
    <script src="{{asset('/')}}public/js/messages_ar.js"></script>
    @endif
    <script src="{{asset('/')}}public/js/moment-with-locales.min.js"></script>
    <script src="{{asset('/')}}public/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">

        
        $(".row_clickable td").not(".disablelink").on('click', function() {
            var redirect_url = $(this).parent("tr").attr("data-href");
            window.location.href = redirect_url;
        });

        $(".currency li").on('click', function() {
            var code = $(this).data("code");
            window.location.href = "{{ url('currency') }}" + '/' + code;
        });

          function eventCategory(matchId){
            country();
            $.ajax({
                type: "POST",
                url: "{{url(app()->getLocale().'/category-list')}}",
                data: {'match_id' : matchId ,"_token": "{{ csrf_token() }}"},
                beforeSend: function() {
                    // $("#state-list").addClass("loader");
                },
                success: function(data){
                    var option = "<option value=''>{{__('messages.please select')}}</option>";
                    jQuery.each(data, function(index, item) {
                        option += "<option value='"+item.stadium_seat_id+"'>"+ item.seat_category+"</option>"
                    });
                    $("#ticket-category").html(option);

                }
            });
        }


        $(document).mouseup(function(e) 
        {
            var contai2ner = $(".home-search-div");
            if (!contai2ner.is(e.target) && contai2ner.has(e.target).length === 0) 
            {
                contai2ner.hide();
            }
        });
        $(document).mouseup(function(e) 
        {
            var contai2ner = $(".all-search-page");
            if (!contai2ner.is(e.target) && contai2ner.has(e.target).length === 0) 
            {
                contai2ner.hide();
            }
        });
        @if(Session::has('activation-message') || Session::has('rest_success'))
            $("#activation_message").modal('show');
        @endif
       

    
        
       
        $("#req-form").validate({
            messages: {
                full_name: {
                    required: "{{__('messages.enter your name')}}"
                },
                country: {
                    required: "{{__('messages.select country')}}"
                },
                phone : {
                    required: "{{__('messages.enter phone number')}}"
                },
                email: {
                    required: "{{__('messages.enter your email address')}}"
                }
            },
            submitHandler: function(form) {
                $(".req-ticket-error").hide();
                $.ajax({
                    url: form.action,
                    type: form.method,
                    dataType: "json",
                    data: $(form).serialize(),
                     beforeSend: function() {
                        $(".full-loading").show();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $(".full-loading").hide();
                    },
                    success: function(response) {/*
                        $(".full-loading").hide();
                        if(response.status == 1){
                            $('#onebox-request-ticket-modal').modal('hide');
                            $('form#req-form').trigger("reset");
                            $("#success-modal").modal('show');
                            $(".success_message").html(response.message);
                            ga('send', {
                            'hitType' : 'pageview',
                            'page' : '/Request-Ticket-Success' // Virtual page (aka, does not actually exist) that you can now track in GA Goals as a destination page.
                            });


                            console.log("analytics success");
                            // $('.req-ticket-success').show();
                            // $(".req-ticket-success-msg").html(response.message);
                            // var intervalId = window.setInterval(function(){
                                
                            //     $('#onebox-request-ticket-modal').modal('hide');
                            //     clearInterval(intervalId) 
                            // }, 3000);
                        }
                        else{

                            $('.req-ticket-error').show();
                            $(".req-ticket-error-msg").html(response.message);
                            $("#req-model-content").animate({scrollTop: 0},400);
                        }
                    */
                    
                        $(".full-loading").hide();
                        if(response.status == 1){
                     /*       $('#onebox-request-ticket-modal').modal('hide');
                            $('form#req-form').trigger("reset");
                            $("#success-modal").modal('show');
                            $(".success_message").html(response.message);alert();*/
                           // window.location.href == "{{url(app()->getLocale().'/request-ticket-success ')}}";
                            var success_flag = 1;
                            window.location.href = "{{url(app()->getLocale().'/request-ticket-success')}}"+'/'+response.match+'?status='+success_flag+'&email='+response.email+'&phone_number='+response.phone_number;
                           // console.log("{{url(app()->getLocale().'/request-ticket-success ')}}");
                        /*    ga('send', {
                            'hitType' : 'pageview',
                            'page' : '/Request-Ticket-Success' 
                            });


                            console.log("analytics success");*/
                            // $('.req-ticket-success').show();
                            // $(".req-ticket-success-msg").html(response.message);
                            // var intervalId = window.setInterval(function(){
                                
                            //     $('#onebox-request-ticket-modal').modal('hide');
                            //     clearInterval(intervalId) 
                            // }, 3000);
                        }
                        else{ 

                           var success_flag = 2;
                          window.location.href = "{{url(app()->getLocale().'/request-ticket-success')}}"+'/'+response.match+'?status='+success_flag;
                            return false;
                            /*
                            $('.req-ticket-error').show();
                            $(".req-ticket-error-msg").html(response.message);
                            $("#req-model-content").animate({scrollTop: 0},400);*/
                        }
                    
                }            
                });
                return false;
            }
        });

    $("body").on("change","#reg_country",function(){
            var val = $(this).val();
            $.ajax({
                type: "POST",
                url: "{{url(app()->getLocale().'/get_state')}}",
                data: {'country_id' : val ,"_token": "{{ csrf_token() }}"},
                beforeSend: function() {
                    // $("#state-list").addClass("loader");
                },
                success: function(data){
                    
                    var option = "";
                    jQuery.each(data, function(index, item) {
                        option += "<option value='"+item.id+"'>"+ item.name+"</option>"
                    });
                    $("#reg_state").html(option);

                }
            });
    }); 

    
  $(document).ready(function(){

        $.ajax({
        type: "GET",
        url: "{{url(app()->getLocale().'/hot_tickets')}}",
        data: "",
        beforeSend: function() {
        },
        success: function(data){
            $.each(data.top_matchs, function(key,val) {             
                var path = "{{url(app()->getLocale().'/')}}/"+val['slug'];
                $("#hot_tickets").append("<li><a href="+path+">"+val['match_name']+"</a></li>");       
            });   

            $.each(data.tournament_list, function(key,val) {             
                var path = "{{url(app()->getLocale().'/')}}/"+val['url_key'];
 
                var link  ='<li class="nav-item "><div class="nav-item-wrapper"><a href="'+path+'" class="nav-item-link" tabindex="0" role="menuitem">'+val['name']+'</a></div></li>';

                $(".tournaments_menu").before(link);       
            }); 

            $.each(data.team_list, function(key,val) {             
                var path = "{{url(app()->getLocale().'/')}}/"+val['url_key'];

                 var link  ='<li class="nav-item "><div class="nav-item-wrapper"><a href="'+path+'" class="nav-item-link" tabindex="0" role="menuitem">'+val['name']+'</a></div></li>';

                $(".team_menu").before(link);     
                    
            });   
           
        }
    });


    });


   $('#all_page_events').keyup(function (e) {

       // if ($(this).val().length > 2) {
           // $(".all-search-page").empty();
            all_page_search();
       // }
    });

    function all_page_search() {
        console.log("d");
        var baseUrl = '{{url(app()->getLocale())}}/';
       // console.log(baseUrl);
        var title = $("#all_page_events").val();
            $.ajax({
                type: "post",
                url: baseUrl +  "search_data",
                data: {teamname : title ,  _token: "{{ csrf_token() }}",},
                dataType: "json",
                success: function (response) {
                    //console.log(response);
                    if ($("#all_page_events").val() != '' && response != '') {
                        $(".all-search-page").show();
                      
                        display = response;
                        var html_data = "";
                        $.each(display, function(i, member) {
                            // console.log(display[i]);
                            // console.log(i);
                            html_data += "<h3>"+i+"</h3>";
                            html_data += "<ul>";
                             $.each(display[i], function(i, data) {
                                //    console.log(data.name);
                            var url = "";
                            var name = data.name;
                            if(data.type =="Teams"){
                                // url  = baseUrl +"team-ticket/" + data.url +"/all";
                                 url  = baseUrl + data.url_key;
                            }
                            if(data.type =="Matches"){
                               //  url  = baseUrl +"tournaments/ticket/" + data.url;
                                   url  = baseUrl + data.url;
                                 name += " - "+data.date;
                            }
                            if(data.type =="Tournaments"){
                                 url  = baseUrl + data.url_key;
                            }
                            if(data.type =="Country"){
                                 url  = baseUrl +"advance-search?country=" + data.url;
                            }
                            if(data.type =="City"){
                                 url  = baseUrl +"advance-search?city=" + data.url;
                            }
                            if(data.type =="Stadium"){
                                 url  = baseUrl +"advance-search?stadium=" + data.url;
                            }
                            html_data += "<li><a href='"+url+"'>"+name+"</a></li>";
                            
                            });
                             html_data +="</ul>";

                        });
                        $(".all-search-page").html(html_data);
                        //$("#eventname").val("");
                    
                    }  else if ($("#eventname").val() != '') {
                        
                        $(".all-search-page").show();
                        $(".all-search-page ul").html("<li><a href=''>No Data Found</a></li>");
                        //$("#eventname").val("");
                    } else {
                        $(".all-search-page").hide();
                    
                    
                    }
                    
                    
                }
            });
       


    }


// $(document).ready(function(){
//     // Set div display to none
//     $(".hide-btn").click(function(){
//         $(".menu_drop_slide, .menu_drop_slide_new").toggle();
//     });
    
//     // Set div display to block
//     $(".show-btn").click(function(){
//         $(".menu_drop_up").toggle();
//     });
//     $(".hide-btn-1").click(function(){
//         $(".menu_drop_up, .menu_drop_slide").toggle();
//     });
    
//     // Set div display to block
//     $(".show-btn-1").click(function(){
//         $(".menu_drop_slide_new").toggle();
//     });

// });




   
    </script>

     <script>
        (function($) {
          'use strict';

          // call our plugin
          var Nav = new hcOffcanvasNav('#main-nav', {
            disableAt: false,
            customToggle: '.toggle',
            levelSpacing: 40,
            //navTitle: 'All Categories',
            levelTitles: true,
            levelTitleAsBack: true,
            pushContent: '#container',
            labelClose: false,
            width: '340px'
          });
         $(".nav-close").prepend("<div class='side_menu_logo'><a href='{{url(app()->getLocale())}}'><img src='{{$data['logo']}}'></a></div>");
          // add new items to original nav
          $('#main-nav').find('li.add').children('a').on('click', function() {
            var $this = $(this);
            var $li = $this.parent();
            var items = eval('(' + $this.attr('data-add') + ')');

            $li.before('<li class="new"><a href="#">'+items[0]+'</a></li>');

            items.shift();

            if (!items.length) {
              $li.remove();
            }
            else {
              $this.attr('data-add', JSON.stringify(items));
            }

            Nav.update(true); // update DOM
          });

          // demo settings update

          const update = function(settings) {
            if (Nav.isOpen()) {
              Nav.on('close.once', function() {
                Nav.update(settings);
                Nav.open();
              });

              Nav.close();
            }
            else {
              Nav.update(settings);
            }
          };

          $('.actions').find('a').on('click', function(e) {
            e.preventDefault();

            var $this = $(this).addClass('active');
            var $siblings = $this.parent().siblings().children('a').removeClass('active');
            var settings = eval('(' + $this.data('demo') + ')');

            if ('theme' in settings) {
              $('body').removeClass().addClass('theme-' + settings['theme']);
            }
            else {
              update(settings);
            }
          });

          $('.actions').find('input').on('change', function() {
            var $this = $(this);
            var settings = eval('(' + $this.data('demo') + ')');

            if ($this.is(':checked')) {
              update(settings);
            }
            else {
              var removeData = {};
              $.each(settings, function(index, value) {
                removeData[index] = false;
              });

              update(removeData);
            }
          });
        })(jQuery);
      </script>

      <script>
        $('.login_modal').on('click', function(e) {
            $("#onebox-login-modal").modal();
        });
        $('.register_modal').on('click', function(e) {
            $("#onebox-register-modal").modal();
        });

        $('.dropdown_menu').on('click', function(event) {
  
        $(".dropdown-content").toggle();

});
        <?php if(@$_GET['aaa']) {?>

        $("#cart_expire").modal();
    <?php  }?>


    // $("#update_applynominee").validate({
    //            rules: {
    //     first_name[]: {
    //         required: true
    //     }, 
    //     last_name[]: {
    //         required: true
    //     }
    //     email[]: {
    //         required: true,
    //         email: true
    //     }
    // },
    //         messages: {
    //             first_name[]: {
    //                 required: "Enter the First name"
    //             },
    //             last_name[]: {
    //                 required: "Enter the Last name"
    //             },
    //             email[]: {
    //                 required: "Enter the Email Address"
    //             }
    //         },
    //         submitHandler: function(form) {
    //         $("#update_applynominee").submit();
    //         }
    //     });

    </script>

<script>
    // $(document).ready(function(){
    //     $(".slide-toggle").click(function(){
    //         $(".lists_below").animate({
    //             width: "toggle"
    //         });
    //     });
    // });
</script>
<script>

</script>
