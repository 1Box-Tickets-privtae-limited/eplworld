var base_url = $("body").data('url');

function country(){
     $.ajax({
            type: "GET",
            url: base_url + "countries" ,
            beforeSend: function() {
                // $("#state-list").addClass("loader");
            },
            success: function(data){
                var option = "<option value=''>Please Select</option>";
                jQuery.each(data, function(index, item) {
                    option += "<option value='"+item.id+"'>"+ item.name+"</option>"
                });
                $("#reg_country").html(option);
                $("#req-country").html(option);
            }
        });
}


/*function requestNow(eventId, date, time)
{ 
    $('.req-ticket-success').hide();
    $(".req-ticket-success-msg").html('');
    $('.req-ticket-error').hide();
    $(".req-ticket-error-msg").html('');
   
    //alert();
     $.ajax({
        type: "GET",
        url: base_url + "events",
        beforeSend: function() {
            // $("#state-list").addClass("loader");
            $(".full-loading").show();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          $(".full-loading").hide();
        },
        success: function(data){
            var option = "<option value=''>Please select</option>";
            jQuery.each(data, function(index, item) {
                option += "<option value='"+item.m_id+"'>"+ item.match_name+"</option>"
            });
            $("#selectevent").html(option);
            $(".full-loading").hide();
            $('body').find('#selectevent option[value="'+eventId+'"]').prop('selected', true);
                eventCategory(eventId)
                $('#onebox-request-ticket-modal').modal('show');
                if(date != undefined && time != undefined){
                    $("#req-form").find('#date').val(date+" "+time);
            }

          
        }
        
    });

}
*/
  
function requestNow(eventId, date, time)
{ 
    $('.req-ticket-success').hide();
    $(".req-ticket-success-msg").html('');
    $('.req-ticket-error').hide();
    $(".req-ticket-error-msg").html('');
   
    //alert();
     $.ajax({
        type: "GET",
        url: base_url + "single-events?event_id=" + eventId,
        beforeSend: function() {
            // $("#state-list").addClass("loader");
            $(".full-loading").show();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          $(".full-loading").hide();
        },
        success: function(data){
            var match_id = data.m_id;

            $("#selectevent").val(match_id);
            $(".rt-event-name").html(data.match_name);
            $(".rt-event-date").html(data.match_date);
            $(".rt-event-time").html(data.match_time);
            $(".rt-event-tournament").html(data.tournament_name);
            $(".rt-event-stadium").html(data.stadium_name);
            // var option = "<option value=''>Please select</option>";
            // jQuery.each(data, function(index, item) {
            //     option += "<option value='"+item.m_id+"' data-slug='"+item.slug+"' >"+ item.match_name+"</option>"
            // });
            // $("#selectevent").html(option);
          $(".full-loading").hide();
            // $('body').find('#selectevent option[value="'+eventId+'"]').prop('selected', true);

            // $('#tournment').val($("#selectevent option:selected").attr('data-slug'));
                eventCategory(eventId)
                $('#onebox-request-ticket-modal').modal('show');
                if(date != undefined && time != undefined){
                    $("#req-form").find('#date').val(date+" "+time);
            }

          
        }
        
    });

}



$(".language li").on('click', function() {
    var lang = $(this).text();
    if(lang == "English"){
        lang = "en";
    }else if(lang == "Arabic"){
        lang = "ar"
    }
    window.location.href = base_url + lang;
});


    $(".allow-numeric").bind("keypress", function (e) {
    var keyCode = e.which ? e.which : e.keyCode
    if (!(keyCode >= 48 && keyCode <= 57)) {
        $(".error").css("display", "inline");
        return false;
    }else{
        //$(".error").css("display", "none");
    }
  });


$("body").on("click",".create_account",function(){
    country();
    $("#onebox-login-modal").modal('hide');
        setTimeout(function(){
         $("#onebox-register-modal").modal(); 
    }, 500);
});

$('#user-register').submit(function() {
    $('#register_dialing_code').val($('.reg-phone_field').find('.iti__selected-dial-code').text());
});
$('#req-form').submit(function() {
    $('#req-dialing-code').val($('.req-phone_field').find('.iti__selected-dial-code').text());
    //alert($('#req-dialing-code').val());
});


$('#billing').submit(function() {
    $('#check-dialing-code').val($('.check_phone_field').find('.iti__selected-dial-code').text());
});
 $("#user-register").validate({
    rules : {
        password_confirm : {
            equalTo : '#reg-password'
        }
    },
    submitHandler: function(form) {
        $(".register-error").hide();
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
            success: function(response) {
                $(".full-loading").hide();   
                if(response.status == 1){
                    $('#onebox-register-modal').modal('hide');
                    $('form#user-register').trigger("reset");
                    $("#success-modal").modal('show');
                    $(".success_message").html(response.message);
                    // $('.register-success').show();
                    // $(".register-success-msg").html(response.message);
                    // setTimeout(function() {
                    //   location.reload();
                    // }, 5000);
                    
                }
                else{
                    $('.register-error').show();
                    $(".register-error-msg").html(response.message);
                    $("#onebox-register-modal").animate({scrollTop: 0},400);
                }
            }            
        });
        return false;
    }
 });

$("#form-login").validate({
     submitHandler: function(form) {
            $(".login-error").hide();
            $.ajax({
                url: form.action,
                type: form.method,
                dataType: "json",
                data: $(form).serialize(),
                success: function(response) {
                    
                    if(response.status == 1){
                        
                        $('.login-success').show();
                        $(".login-success-msg").html(response.message);
                        window.location.replace(base_url);
                    }
                    else{
                        $('.login-error').show();
                        $(".login-error-msg").html(response.message);
                    }
                }            
            });
            return false;
        }
});
$("#forgot-password").validate({
    submitHandler: function(form) {
        $(".forgot-error").hide();
        $.ajax({
            url: form.action,
            type: form.method,
            dataType: "json",
            data: $(form).serialize(),
            success: function(response) {
                
                if(response.status == 1){
                    $('.forgot-success').show();
                    $(".forgot-success-msg").html(response.message);
                    //window.location.href = '{{url("profile")}}';
                }
                else{
                    $('.forgot-error').show();
                    $(".forgot-error-msg").html(response.message);
                }
            }            
        });
        return false;
    }
});

if($("#register_phone").length > 0 ){

    var register_phone = document.querySelector("#register_phone");
    window.intlTelInput(register_phone,{
        'separateDialCode':true,
        'preferredCountries': [default_country],
        'autoPlaceholder': 'off',
        'initialCountry' : default_country

    });
}

if($("#req-phone").length > 0 ){
    var request_phone = document.querySelector("#req-phone");
    window.intlTelInput(request_phone,{
        'separateDialCode':true,
        'preferredCountries': [default_country],
        'autoPlaceholder': 'off',
        'initialCountry' : default_country
    });
}


// var input = document.querySelector("#register-phone");
// window.intlTelInput(input,{
//     'separateDialCode':true,
//     'preferredCountries': [default_country],
//     'autoPlaceholder': 'off'
// });


// var input = document.querySelector("#dialing-code");
// window.intlTelInput(input,{
//     'separateDialCode':true,
//     'preferredCountries': [default_country],
//     'autoPlaceholder': 'off'
// });
// input.addEventListener("countrychange", function() {
//   // do something with iti.getSelectedCountryData()
//   $('#phone').focus();
// });
// var req_dail_code = document.querySelector("#req-dialing-code");
// window.intlTelInput(req_dail_code,{
//     'separateDialCode':true,
//     'preferredCountries': [default_country],
//     'autoPlaceholder': 'off',
// });
// req_dail_code.addEventListener("countrychange", function() {
//   // do something with iti.getSelectedCountryData()
//   $('#req-phone').focus();
// });


 
        $(".txtOnly").on("input", function(){
          // var regexp = /[^a-zA-Z]/g;
          // if($(this).val().match(regexp)){
          //   $(this).val( $(this).val().replace(regexp,'') );
          // }
        });


// function eventCategory(matchId)
// {
//     $.ajax({
//         type: "POST",
//         url: "{{url('category-list')}}",
//         data: {'match_id' : matchId ,"_token": "{{ csrf_token() }}"},
//         beforeSend: function() {
//             // $("#state-list").addClass("loader");
//         },
//         success: function(data){
//             console.log(data);
//             var option = "<option value=''>Select Category</option>";
//             jQuery.each(data, function(index, item) { console.log(item);
//                 option += "<option value='"+item.stadium_seat_id+"'>"+ item.seat_category+"</option>"
//             });
//             $("#ticket-category").html(option);

//         }
//     });   
// }