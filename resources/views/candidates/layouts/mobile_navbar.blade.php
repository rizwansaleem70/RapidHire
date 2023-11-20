<!-- popup nav menu-mobile-->
<div class="menu-mobile-popup">
    <div class="modal-menu__backdrop"></div>
    <div class="widget-filter">
        <div class="mobile-header">
            <div id="logo" class="logo">
                <a href="{{route('tenant-user-home')}}">
                    <img class="site-logo"
                         src="{{asset('app-assets/candidates/images/used/devjeco-logo1 1.png')}}"
                         alt="Image">
                </a>
            </div>
            <a class="title-button-group"><i class="icon-close"></i></a>
        </div>
        <div class="content-tab">
            <div class="header-ct-center menu-moblie">
                <div class="nav-wrap">
                    <nav class="main-nav mobile">
                        <ul id="menu-primary-menu" class="menu">
                            <li class="menu-item">
                                <a href="{{route('tenant-user-home')}}">Home </a>
                            </li>
                            <li class="menu-item ">
                                <a href="{{route('tenant-user-about')}}">About </a>
                            </li>
                            <li class="menu-item ">
                                <a href="{{route('candidate.job.list')}}">Jobs</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('tenant-user-contact-us')}}">Contact Us</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="header-ct-right">
            @auth
                <div class="header-ct-right" style="margin-right: 11rem;">
                    <div class="header-customize-item account">
                        <img
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpFreAtrOzdfbsrEHLCtHyBDY4x80z6RBeVA&usqp=CAU"
                            alt="" style="width: 50px;">
                        <div class="sub-account">
                            <div class="sub-account-item"
                                 data-endpoint="{{config('app.candidate_authentication_dashboard')}}">
                                <a href="{{"https://rapidhire-candidate.netlify.app/#/sign-in/".encrypt(auth()->user()->id)}}"><span
                                        class="icon-dashboard"></span>Dashboard</a>
                            </div>
                            <div class="sub-account-item">
                                <form method="POST" action="{{ route('tenant-user-logout') }}">
                                    @csrf
                                    <a href="{{ route('tenant-user-logout') }}"><span
                                            class="fas fa-sign-out-alt"></span> Logout</a>
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

        <div class="mobile-footer">
            <div class="wd-social d-flex aln-center">
                <ul class="list-social d-flex aln-center">
                    <li><a href="#"><i class="icon-linkedin2"></i></a></li>
                    <li><a href="#"><i class="icon-twitter"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /end -->
