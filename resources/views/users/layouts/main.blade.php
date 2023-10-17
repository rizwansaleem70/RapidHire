<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->

<head>
    <!-- Basic Page Needs -->
    <!--[if IE
      ]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"
    /><![endif]-->

    <title>Career Website | Rapid Hire</title>

    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <!-- Font -->
    <link rel="stylesheet" href="{{asset('app-assets/users/fonts/fonts.css')}}"/>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('app-assets/users/stylesheets/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('app-assets/users/stylesheets/boostrap-select.min.css')}}"/>

    <!-- swiper slider -->
    <link rel="stylesheet" href="{{asset('app-assets/users/stylesheets/swiper-bundle.min.css')}}"/>

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/users/stylesheets/shortcodes.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/users/stylesheets/style.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/users/stylesheets/jquery.fancybox.min.css')}}"/>

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{asset('app-assets/users/images/used/d.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('app-assets/users/images/used/d.png')}}">
    <!-- Color -->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/users/stylesheets/colors/color1.css')}}"
          id="colors">

    <!-- Responsive -->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/users/stylesheets/responsive.css')}}"/>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
          integrity="sha384-....">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>


</head>
<body>
    <a id="scroll-top"></a>

    <!-- popup nav menu-mobile-->

    <!-- /end -->
    <!-- Boxed -->
        @include('users.layouts.navbar')
        @yield('main-section')
        @include('users.layouts.footer')
    <script src="{{asset('app-assets/users/javascript/jquery.min.js')}}"></script>
    <script src="{{asset('app-assets/users/javascript/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('app-assets/users/javascript/bootstrap.min.js')}}"></script>
    <script src="{{asset('app-assets/users/javascript/boostrap-select.min.js')}}"></script>
    <script src="{{asset('app-assets/users/javascript/jquery.fancybox.js')}}"></script>
    <script src="{{asset('app-assets/users/javascript/jquery.nice-select.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFC3m2n0jBRFTMvUNZc0-6Y0Rzlcadzcw"></script>
    <script src="{{asset('app-assets/users/javascript/maps.js')}}"></script>
    <script src="{{asset('app-assets/users/javascript/countto.js')}}"></script>
    <script src="{{asset('app-assets/users/javascript/infobox.min.js')}}"></script>
    <script src="{{asset('app-assets/users/javascript/wow.min.js')}}"></script>
    <script src="{{asset('app-assets/users/javascript/password-addon.js')}}"></script>
    <script src="{{asset('app-assets/users/javascript/marker.js')}}"></script>
    <script src="{{asset('app-assets/users/javascript/swiper.js')}}"></script>
    <script src="{{asset('app-assets/users/javascript/plugin.min.js')}}"></script>
    <script src="{{asset('app-assets/users/javascript/jquery.cookie.js')}}"></script>
    <script src="{{asset('app-assets/users/javascript/main.js')}}"></script>
</body>

</html>
