<!-- popup nav menu-mobile-->
<div class="menu-mobile-popup">
    <div class="modal-menu__backdrop"></div>
    <div class="widget-filter">
        <div class="mobile-header">
            <div id="logo" class="logo">
                <a href="{{route('candidate.home')}}">
                    <img class="site-logo"
                         src="{{settings()->group('logo')->get("logo") ? asset(settings()->group('logo')->get("logo")):asset('rapidhire.png')}}"
                         alt="Image">
                </a>
            </div>
            <a class="title-button-group"><i class="icon-close"></i></a>
        </div>
        <div class="header-ct-right">
            @guest
                <div class="header-customize-item d-flex justify-content-center mt-2">
                    <a class="btn btn-light" href="{{route('login')}}">Sign In / Sign Up</a>
                </div>
            @endguest
        </div>
        <div class="content-tab">
            <div class="header-ct-center menu-moblie">
                <div class="nav-wrap">
                    <nav class="main-nav mobile">
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
