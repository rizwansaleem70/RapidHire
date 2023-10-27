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
                                     src="{{asset('app-assets/candidates/images/used/devjeco-logo1 1.png')}}"
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
                                        <a href="{{route('candidate.job.list')}}">Jobs</a>

                                    </li>
                                    <li class="menu-item">
                                        <a href="{{route('tenant-user-contact-us')}}">Contact Us</a>

                                    </li>

                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="header-ct-right">

                        {{-- User Signed In --}}
                        @auth
                        <div class="header-ct-right" style="margin-right: 11rem;">

                            <div class="header-customize-item account">

                              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpFreAtrOzdfbsrEHLCtHyBDY4x80z6RBeVA&usqp=CAU" alt="" style="width: 50px;">
                            <div class="sub-account">
                              <div class="sub-account-item">
                                <a href="https://rapid-hire-employee-dashboard.netlify.app/"><span class="icon-dashboard"></span>Dashboard</a>
                              </div>
                              <div class="sub-account-item">
                                <a href="https://rapid-hire-employee-dashboard.netlify.app/createprofile"><span class="icon-profile"></span> Profile</a>
                              </div>

                              <div class="sub-account-item">
                                <a href="https://rapid-hire-employee-dashboard.netlify.app/candidates-my-appliedl"><span class="icon-my-apply"></span> My Applied</a>
                              </div>
                              <div class="sub-account-item">
                                <a href="https://rapid-hire-employee-dashboard.netlify.app/save-jobs"><span class="icon-work"></span> Saved Jobs</a>
                              </div>

                              <div class="sub-account-item">
                                <a href="https://rapid-hire-employee-dashboard.netlify.app/candidates-messages"><span class="icon-chat"></span> Messages</a>
                              </div>


                              <div class="sub-account-item">
                                <a href="https://rapid-hire-employee-dashboard.netlify.app/candidates-change-passwords"><span class="icon-change-passwords"></span> Change
                                  Passwords</a>
                              </div>
                              <div class="sub-account-item">
                                <a href="https://rapid-hire-employee-dashboard.netlify.app/candidates-delete-profile"><span class="icon-trash"></span> Delete Profile</a>
                              </div>
                              <div class="sub-account-item">
                                <form method="POST" action="{{ route('tenant-user-logout') }}">
                                    @csrf
                                    <a href="{{ route('tenant-user-logout') }}"><span class="fas fa-sign-out-alt"></span> Logout</a>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        {{-- User Not Signed In --}}
                        @else
                        <div class="header-customize-item button">
                            <a href="{{route('tenant-user-login')}}">Sign In / Sign Up</a>
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
