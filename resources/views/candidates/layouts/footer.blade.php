<footer class="footer mt-5">
    <div class="container">
        <div class="top-footer">
            <div class="tf-container">
                <div class="row">
                    <div class="col-lg-2 col-md-4">
                        <div class="footer-logo">
                            <img src="{{asset('app-assets/candidates/images/used/devjeco.png')}}" alt="images">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="inner-footer">
            <div class="tf-container">
                <div class="row" style="margin-top: -7rem;">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-cl-1 mt-5">
                            <p>A product crafted by HR professionals,
                                exclusively for HR professionals.
                                It eliminates time-consuming tasks,
                                adapting to your unique requirements.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6">
                        <div class="footer-cl-2">
                            <h3 class="ft-title text-white fs-4">
                                Quick Links
                            </h3>
                            <ul class="navigation-menu-footer">
                                <li> <a href="{{route('candidate.user-about')}}">About</a> </li>
                                <li> <a href="{{route('candidate.job.list')}}">Jobs</a> </li>

                                <li> <a href="{{route('candidate.contact-us')}}">Contact Us</a> </li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="footer-cl-3">
                            <h3 class="ft-title text-white fs-4">
                                For Candidates
                            </h3>
                            <ul class="navigation-menu-footer">
                                @auth
                                    <li> <a href="{{"https://rapidhire-candidate.netlify.app/#/sign-in/".encrypt(auth()->user()->id)}}">User Dashboard</a> </li>

                                @else
                                    <li><a href="{{route('candidate.login')}}">User Dashboard</a></li>
                                @endauth
                            </ul>
                            <ul class="list-social d-flex aln-center">
                                @foreach($social_links as $value)
                                    <li class="p-1"><a href="{{$value->url}}" target="_blank"><i class="{{$value->icon}}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom">
            <div class="tf-container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="bt-left">
                            <div class="copyright text-white">©2023 RapidHire. All Rights Reserved.</div>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <ul class="menu-bottom d-flex aln-center" >
                            <li><a href="#" style="color: #fff;">Terms Of Services</a> </li>
                            <li><a href="#" style="color: #fff;">Privacy Policy</a> </li>
                            <li><a href="#" style="color: #fff;">Cookie Policy</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
