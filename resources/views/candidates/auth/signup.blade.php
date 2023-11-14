@include('candidates.auth.layouts.header')

<style>
    @media screen and (min-width: 1200px) {
        .social-buttons-container {
            align-items: center;
        }

        .card {
            width: 500px;
        }
    }

    .card {
        background-color: #fbfcfc !important;
        border-radius: 20px;
        border-color: black;
    }

    .social-buttons-container {
        display: flex;
        flex-direction: column;
    }

    .social-buttons-list {
        list-style-type: none;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
    }

    .social-buttons-list li {
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .wd-form-login button:hover {
        background: black;
    }
</style>

<body>
<a id="scroll-top"></a>

<!-- preloade -->

<!-- /preload -->


<!-- Boxed -->
<div class="boxed">
    <!-- HEADER -->

    <!-- END HEADER -->


    <section class="account-section" style="background-image: url(./app-assets/users/images/used/Signin.png);
  background-size: cover; /* Adjust the background size property */
  background-repeat: no-repeat; /* Prevent the background image from repeating */
  width: 100%;
  height: 100vh;">
        <div class="tf-container">


            <div class="col-lg-6 wd-form-login " style="float:right">
                <div class="container card" style="padding: 5%;background-color: fbfcfc;">
                    <strong><h6 style=" margin-top: 2%;">Create an Account</h6></strong>

{{--                    <div class="social-buttons-container" style="margin-top: 5%;">--}}
{{--                        <ul class="social-buttons-list">--}}
{{--                            <li><a href="#" class="btn-social"><img--}}
{{--                                            src="{{asset('app-assets/candidates/images/review/google.png')}}" alt="images">--}}
{{--                                    Sign in with Google</a></li>--}}
{{--                            <li><a href="#" class="btn-social"><img--}}
{{--                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACXklEQVR4nO3ZT4hNURzA8c8YjI1QkgzZkIX8S0ZS/pQ/+VNSipLIwkJZWhEWwkIhCzYWlGQhLCTKylr5v7CQxEwTwjCaGeXq1pl6vd575r1333vnar71W713zznfe86555zfYZS6WYLLeIZDcshs3EdSEIfljG3oK5JIY68csR1DJSTSmCcnzMGPMhKv0CYnPCojkcYBOaGrgsRTjJMTLpWR+I5FcsSLEhLpfFkpZwwVSTwOkz8a2sLithQLManM/9K3341b2IwxRb9PxeJQzly0axIrcBWfSwyZdBidDI0apngypyJrcAHvSpTRhyuhnobQibsVvkDF8RbnsBvrsAvn8aGKMu6FejMjfYNfqmhAlvEVW7OQ2IDBFkkkIdL6t9QjMR8/WyyRFCyeE2qRGIvnEQgk4dzSUWtv7I9AIMFZddAevjqtlnhYYt2piuURSAxlsQM4FoHITRlQfKZuRezIQuRlBCKdWYh8a7HE73on+TCDEYj4H3okwZQsRHoiEFmVhciTCEROZyFyPQKR3lo3iYUciUAkySInvD4CiQT99aaMOiqkOJsd7+vNDd+OQCIJ8SkkwWtiTwQCSYltfZp6qnp49UbQ+KQg/mBBLb1yKoLGJwVxR43MwkBEvdGlDs5EIJHgmjqZGHK3rZTowwwZsK/FIgdlSDV53yzjQdZ3jNNasL3vwXQNYFkTty79IS3VMDY24Sg8GC6FGs7qfwyz9BLoIjaFJFt6bJ0Z7g2P4k2FZ7uzOh2OlPSq7XhIHQ2Exqf5sJ0YP4Ln1+IGPuIXXuMEJjeh7aOMYoT8BfcegYzf+KxLAAAAAElFTkSuQmCC"--}}
{{--                                            style="width: 30px;"> Sign in with Apple</a></li>--}}
{{--                        </ul>--}}
{{--                        <ul class="social-buttons-list">--}}
{{--                            <li><a href="#" class="btn-social"><img--}}
{{--                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAByElEQVR4nO2ZP0/CQBjG22scXI2Tiauy+glc3MC4+iX8DA6G9IiDJsYBBhdNHJwcNRGIHY3xjoBCgkTEAUP8A63yt7ymBVQEIq2mvSb3JM/UN5fnd+97N1wFgYuLi4tpSTJdQTKJI5lqCFNwxDLVRExjkkyW/xRexAQ7FhoPt4hJ0P7OuxwedS2FSMAygDk2DIRHRhdkGrUOgInqdnDUs0wqNgAYCI6//G8AvkgazgsaaA0dlIIG8+G0twCUggbfFb/XvAWgNfQ+ALWuewtA8XoHfJG0CWF0IpZXYS584y0A5JIFDoA7OzFM43yf3b2G7YsSpEpVqDbb8FprmaO4dvoAk5sJtgEW9jLw+NaEUbosvsPMTopdgOxLHX5TLK+CxCrAuPIf5dgE0Ntgzv/S4S2sHucheqcOrdtPPrMJsK4U+2omQgk4yVUG6jJPNTYBpreTA+ssHmQH6sq1FnsA7R/fe57aSo5d63oH7K6FOADmHTDFRwjzQ0z5LYT4NWpRo24Otyx4+mkR07JlAON9noHgYFjE9MwygPFzwe3gqGsJX/ktA3S6QIJuhxcx2bAV/rMTIRIw3uedPRNENcbG9s5zcXFxCU7pA5Jwntel+S2tAAAAAElFTkSuQmCC"--}}
{{--                                            style="width: 30px;"> Sign in with Linkedin</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}

{{--                    <p class="line-ip"><span>or with email</span></p>--}}

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif

                    <form action="{{route('register-user')}}" style="margin-top: 2%;" method="POST">
                        @csrf
                        <div class="ip">

                            <input type="text" placeholder="First Name" name="first_name" style="border-radius: 20px;">
                        </div>
                        <div class="ip">

                            <input type="text" placeholder="Last Name" name="last_name" style="border-radius: 20px;">
                        </div>
                        <div class="ip">

                            <input type="text" placeholder="Email" name="email" style="border-radius: 20px;">
                        </div>
                        <div class="ip">

                            <div class="inputs-group auth-pass-inputgroup">
                                <input type="password" class="input-form password-input" name="password"
                                       placeholder="Password" id="password-input"
                                       required="" style="border-radius: 20px;">
                                <a class="icon-eye-off password-addon" id="password-addon"></a>
                            </div>
                        </div>

                        <div class="ip">

                            <div class="inputs-group auth-pass-inputgroup">
                                <input type="password" class="input-form password-input" name="password_confirmation"
                                       placeholder="Repeat Password" id="repeat-password-input"
                                       required="" style="border-radius: 20px;">
                                <a class="icon-eye-off password-addon" id="password-addon"></a>
                            </div>
                        </div>
{{--                        <div class="group-ant-choice st">--}}
{{--                            <div class="sub-ip"><input type="checkbox">I agree to the <a href="#"--}}
{{--                                                                                         style="color: #0A66C2;">Privacy--}}
{{--                                    Policy</a> and <a href="#" style="color: #0A66C2;">Terms & Conditions</a></div>--}}
{{--                        </div>--}}
                        <button type="submit">Sign up</button>


                        <div class="sign-up">Already have an account?<a href="{{route('candidate.login')}}">Login
                                Here</a></div>
                    </form>
                </div>
            </div>

        </div>
    </section>
    <script>
        window.setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 5000);
    </script>


</div><!-- /.boxed -->

@include('candidates.auth.layouts.footer')
