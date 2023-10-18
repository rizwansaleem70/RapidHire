<!-- HEADER -->
<header id="header" class="header header-default header-fixed">
    <div class="tf-container ct2">
        <div class="row">
            <div class="col-md-12">
                <div class="sticky-area-wrap">
                    <div class="header-ct-left">
                        <div id="logo" class="logo">
                            <a href="{{route('tenant-user-home')}}">
                                <img class="site-logo"
                                     src="{{asset('app-assets/users/images/used/devjeco-logo1 1.png')}}"
                                     alt="Image">

                            </a>
                        </div>

                    </div>
                    <div class="header-ct-center">
                        <div class="nav-wrap">
                            <nav id="main-nav" class="main-nav">
                                <ul id="menu-primary-menu" class="menu">
                                    <li class="menu-item">
                                        <a href="{{route('tenant-user-home')}}">Home </a>


                                    </li>
                                    <li class="menu-item ">
                                        <a href="{{route('tenant-user-about')}}">About </a>

                                    </li>

                                    <li class="menu-item ">
                                        <a href="{{route('tenant-user-jobs')}}">Jobs</a>

                                    </li>
                                    <li class="menu-item">
                                        <a href="{{route('tenant-user-contact-us')}}">Contact Us</a>

                                    </li>

                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="header-ct-right">

                        <div class="header-customize-item button">
                            <a href="{{route('tenant-user-login')}}">Sign In / Sign Up</a>
                        </div>
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
