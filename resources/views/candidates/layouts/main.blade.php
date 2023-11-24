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
    <link rel="stylesheet" href="{{ asset('app-assets/candidates/fonts/fonts.css') }}"/>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('app-assets/candidates/stylesheets/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('app-assets/candidates/stylesheets/boostrap-select.min.css') }}"/>

    <!-- swiper slider -->
    <link rel="stylesheet" href="{{ asset('app-assets/candidates/stylesheets/swiper-bundle.min.css') }}"/>

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/candidates/stylesheets/shortcodes.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/candidates/stylesheets/style.css') }}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('app-assets/candidates/stylesheets/jquery.fancybox.min.css') }}"/>

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ asset('app-assets/candidates/images/used/d.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('app-assets/candidates/images/used/d.png') }}">
    <!-- Color -->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/candidates/stylesheets/colors/color1.css') }}"
          id="colors">

    <!-- Responsive -->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/candidates/stylesheets/responsive.css') }}"/>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
    @stack('css')
</head>

<body>
<a id="scroll-top"></a>

@include('candidates.layouts.mobile_navbar')
@include('candidates.layouts.navbar')
<div class="container mt-3">
    @if ($errors->any())
        <div class="alert alert-danger flash">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show flash" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('message'))
        <div class="alert alert-danger alert-dismissible fade show flash" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
@yield('main-section')
@include('candidates.layouts.footer')
<script src="{{ asset('app-assets/candidates/javascript/jquery.min.js') }}"></script>
<script src="{{ asset('app-assets/candidates/javascript/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('app-assets/candidates/javascript/bootstrap.min.js') }}"></script>
<script src="{{ asset('app-assets/candidates/javascript/boostrap-select.min.js') }}"></script>
<script src="{{ asset('app-assets/candidates/javascript/jquery.fancybox.js') }}"></script>
{{-- <script src="{{asset('app-assets/candidates/javascript/jquery.nice-select.min.js')}}"></script> --}}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFC3m2n0jBRFTMvUNZc0-6Y0Rzlcadzcw"></script>
<script src="{{ asset('app-assets/candidates/javascript/maps.js') }}"></script>
<script src="{{ asset('app-assets/candidates/javascript/countto.js') }}"></script>
<script src="{{ asset('app-assets/candidates/javascript/infobox.min.js') }}"></script>
<script src="{{ asset('app-assets/candidates/javascript/wow.min.js') }}"></script>
<script src="{{ asset('app-assets/candidates/javascript/password-addon.js') }}"></script>
<script src="{{ asset('app-assets/candidates/javascript/marker.js') }}"></script>
<script src="{{ asset('app-assets/candidates/javascript/swiper.js') }}"></script>
<script src="{{ asset('app-assets/candidates/javascript/plugin.min.js') }}"></script>
<script src="{{ asset('app-assets/candidates/javascript/jquery.cookie.js') }}"></script>
<script src="{{ asset('app-assets/candidates/javascript/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
    function favoriteButton() {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Please login First",
        });
    }
</script>

<script>
    // window.setTimeout(function () {
    //     $(".flash").fadeTo(500, 0).slideUp(500, function () {
    //         $(this).remove();
    //     });
    // }, 3000);
</script>
<script>
    $(document).ready(function () {
        $('#country-id').on('change', function () {
            var idCountry = this.value;
            $("#state-id").html('');
            $.ajax({

                url: `{{ route('get-all-state-from-country') }}`,
                method: "GET",
                data: {
                    country_id: idCountry,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#state-id').html(result.data);
                    // $.each(result.data, function (key, value) {
                    //     $("#state-id.nice-select").append('<option value="' + value.id + '">' + value.name + '</option>');
                    // });
                    $('#city-id').html('<option value="">Select City</option>');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Error fetching states:", textStatus, errorThrown);
                }
            });
        });
        $('#state-id').on('change', function () {
            var idState = this.value;
            $("#city-id").html('');
            $.ajax({
                url: `{{ route('get-all-city-from-state') }}`,
                method: "GET",
                data: {
                    state_id: idState,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#city-id').html(result.data);
                    // $('#city-id').html('<option value="">Select City</option>');
                    // $.each(res.data, function (key, value) {
                    //     $("#city-id").append('<option value="' + value
                    //         .id + '">' + value.name + '</option>');
                    // });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Error fetching states:", textStatus, errorThrown);
                }
            });
        });

        $('.repeater').repeater({
            initEmpty: false,
            // (Optional)
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            isFirstItemUndeletable: false
        });
    });
</script>
@stack('js')
</body>

</html>
