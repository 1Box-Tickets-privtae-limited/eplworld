@php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0 "); // Proxies.
$v= "6.394";
$canonical = url()->current();
if($canonical)
  $canonical = str_replace("/all","",url()->current());
@endphp
<!DOCTYPE html>
<html lang="en" @if(App::getLocale() == "ar") dir="rtl" @endif>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     
    <meta name="description" content="{{@$description}}" />
    <link rel="canonical" href="{{ $canonical }}">
    <!-- Title -->
    <title>{{@$title}}</title>

    <meta property="og:title" content="{{@$title}}" />
    <meta property="og:description" content="{{@$description}}" />
    <meta property="og:image" content="{{@$data['dark_logo']}}" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{@$data['fav']}}">
    <!-- <link rel="manifest" href="assets/favicons/manifest.json"> -->
    <!-- Bootstrap CSS -->
   
    <link rel="stylesheet" href="{{asset('/')}}public/css/bootstrap.min.css">
     @if(App::getLocale() == "ar")
     <link rel="stylesheet" href="{{asset('/')}}public/css/bootstrap-rtl.min.css">
     @endif
    <!-- Font awesome CSS -->
    <!-- <link rel="stylesheet" href="assets/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('/')}}public/css/animate.min.css">
    
    <!-- OwlCarousel CSS -->
    <link rel="stylesheet" href="{{asset('/')}}public/css/owl.carousel.css">
    
    <!-- SlickNav CSS -->
    <link rel="stylesheet" href="{{asset('/')}}public/css/slicknav.min.css">

    <link rel="stylesheet" href="{{asset('/')}}public/css/color.css">

    <link rel="stylesheet" href="{{asset('/')}}public/css/menu-css.css?v={{$v}}">
    
    <!-- Magnific popup CSS -->
    <!-- <link rel="stylesheet" href="assets/css/magnific-popup.css"> -->
    
    <!-- Scroll CSS -->
    <link rel="stylesheet" href="{{asset('/')}}public/css/perfect-scrollbar.min.css">
      <!-- Main CSS -->
  
    <link rel="stylesheet" href="{{asset('/')}}public/css/custom.css?v={{$v}}">
    
    <link rel="stylesheet" href="{{asset('/')}}public/css/intlTelInput.css">
    <link rel="stylesheet" href="{{asset('/')}}public/css/intlTelInput.min.css">
    <link rel="stylesheet" href="{{asset('/')}}public/css/mCustomScrollBox.css">

    @if(@$home != 1 && @$mobile == true)
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('/')}}public/css/style.css?v={{$v}}">
 
    @endif
    @if($mobile == true)
      @if($mobile == true && @$home  == 1)
       <link rel="stylesheet" href="{{asset('/')}}public/css/style.mobile.css?v={{$v}}">
       @endif
     <link rel="stylesheet" href="{{asset('/')}}public/css/style.mobile.fh.css?v={{$v}}">
    @else
    <link rel="stylesheet" href="{{asset('/')}}public/css/style.css?v={{$v}}">
    @endif
     @if(App::getLocale() == "ar")
    <link rel="stylesheet" href="{{asset('/')}}public/css/style.rtl.css?v={{$v}}">
    @endif

       <link rel="stylesheet" href="{{asset('/')}}public/css/responsive.css?v={{$v}}">

       
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/')}}public/css/bootstrap-datetimepicker.css" rel="stylesheet">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-T3L99D1EXS"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-T3L99D1EXS');
    </script>


    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-R4HDS9QG2P"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-R4HDS9QG2P');
    </script>

</head>
<body data-lang="{{App::getLocale()}}" data-url="{{url(App::getLocale())}}/" class="theme-default" >