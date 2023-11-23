<!-- HEADER -->
<header id="header" class="header header-default header-fixed">
    <div class="tf-container ct2">
        <div class="row">
            <div class="col-md-12">
                <div class="sticky-area-wrap">
                    <div class="header-ct-left">
                        <div id="logo" class="logo">
                            <a href="{{route('candidate.home')}}">
                                <img class="site-logo"
                                     src="{{settings()->group('logo')->get("logo") ? asset(settings()->group('logo')->get("logo")):asset('rapidhire.png')}}"
                                     alt="Image">

                            </a>
                        </div>
                    </div>
                    <div class="header-ct-center">
                        <div class="nav-wrap">
                            <nav id="main-nav" class="main-nav">
                                <ul id="menu-primary-menu" class="menu">
                                    <li class="menu-item">
                                        <a href="{{route('candidate.home')}}">Home </a>


                                    </li>
                                    <li class="menu-item ">
                                        <a href="{{route('candidate.user-about')}}">About </a>

                                    </li>

                                    <li class="menu-item ">
                                        <a href="{{route('candidate.job.list')}}">Jobs</a>

                                    </li>
                                    <li class="menu-item">
                                        <a href="{{route('candidate.contact-us')}}">Contact Us</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="header-ct-right">
                        @auth
                        <div class="header-ct-right" style="margin-right: 11rem;">
                            <div class="header-customize-item account">
                              <img src="{{auth()->user() && auth()->user()->avatar ? asset(auth()->user()->avatar): asset('user.png')}}" alt="" style="width: 50px;">
                            <div class="sub-account">
                              <div class="sub-account-item" data-endpoint="{{config('app.candidate_authentication_dashboard')}}">
                                <a href="{{config('app.candidate_authentication_dashboard').encrypt(auth()->user()->id)}}"><span class="icon-dashboard"></span>Dashboard</a>
{{--                                <a href="{{"https://rapidhire-candidate.netlify.app/#/sign-in/".encrypt(auth()->user()->id)}}"><span class="icon-dashboard"></span>Dashboard</a>--}}
                              </div>
                              <div class="sub-account-item">
                                <form method="POST" action="{{ route('candidate.logout') }}">
                                    @csrf
                                    <a href="{{ route('candidate.logout') }}"><span class="fas fa-sign-out-alt"></span> Logout</a>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        @else
                        <div class="header-customize-item button">
                            <a href="{{route('candidate.login')}}">Sign In / Sign Up</a>
                        </div>
                        @endauth
                    </div>
                    <div class="nav-filter">
                        <div class="nav-mobile"><span></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END HEADER -->
