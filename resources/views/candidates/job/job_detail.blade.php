@extends('candidates.layouts.main')
@section('main-section')

    <section class="single-job-thumb">
        <img src="{{asset('app-assets/candidates/images/used/Hero.png')}}" alt="images" style="width:100%">
    </section>

    <section class="form-sticky fixed-space">
        <div class="tf-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wd-job-author2">
                        <div class="content-left">
                            <div class="thumb">
                                <img src="{{asset('app-assets/candidates/images/logo-company/cty4.png')}}" alt="logo">
                            </div>
                            <div class="content">
                                <h6><a href="#">{{$data['job']->name}} <span class="icon-bolt"></span></a></h6>
                                <ul class="job-info">
                                    <li><span class="icon-map-pin"></span>
                                        <span>{{$data['job']->location->name}}</span></li>
                                    <li><span class="icon-calendar"></span>
                                        <span>{{ \Carbon\Carbon::parse($data['job']->post_date)->diffForHumans() }}</span></li>
                                </ul>
                                <ul class="tags">
                                    <li><a href="#">{{$data['job']->type}}</a></li>
                                    <li><a href="#">{{$data['job']->job_type}}</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="content-right">
                            <div class="top">
                                <a href="#" class="share"><i class="icon-share2"></i></a>
                                <a href="#" class="wishlist"><i class="icon-heart"></i></a>
                                <a href="{{route('tenant-user-submit')}}" class="btn btn-popup"><i
                                        class="icon-send"></i>Apply Now</a>
                            </div>
                            <div class="bottom">

                                <div class="gr-rating">
                                    <p class="days">{{$data['remaining_days']}} days left to apply</p>
                                </div>
                                <div class="price">
                                    <span class="icon-dollar"></span>
                                    <p class="mt-3">{{$data['job']->min_salary}} - {{$data['job']->max_salary}} <span class="year">/ {{$data['job']->salary_deliver}}</span></p>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-jobs-section">
        <div class="tf-container">
            <div class="row">
                <div class="col-lg-8">
                    <article class="job-article tf-tab single-job">
{{--                        <ul class="menu-tab">--}}
{{--                            <li class="ct-tab active">About</li>--}}
{{--                        </ul>--}}
                        <div class="content-tab">
                            <div class="inner-content">
                                <h5>Full Job Description</h5>
                                {{$data['job']->job_description}}
                                <div class="post-navigation d-flex aln-center mt-3">
                                    <div class="wd-social d-flex aln-center">
                                        <span>Social Profiles:</span>
                                        <ul class="list-social d-flex aln-center mt-3">
                                            @foreach($data['socialMedia'] as $value)
                                                <li><a href="{{$value->url}}"><img class="rounded-circle" src="{{$value->icon}}"></a></li>
                                            @endforeach
{{--                                            <li><a href="#"><i class="icon-facebook"></i></a></li>--}}
{{--                                            <li><a href="#"><i class="icon-linkedin2"></i></a></li>--}}
{{--                                            <li><a href="#"><i class="icon-twitter"></i></a></li>--}}
{{--                                            <li><a href="#"><i class="icon-pinterest"></i></a></li>--}}
{{--                                            <li><a href="#"><i class="icon-instagram1"></i></a></li>--}}
{{--                                            <li><a href="#"><i class="icon-youtube"></i></a></li>--}}
                                        </ul>
                                    </div>
                                    <a href="#" class="frag-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15"
                                             viewBox="0 0 14 15" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M0 3C0 2.20435 0.316071 1.44129 0.87868 0.87868C1.44129 0.316071 2.20435 0 3 0H13C13.1857 0 13.3678 0.0517147 13.5257 0.149349C13.6837 0.246984 13.8114 0.386681 13.8944 0.552786C13.9775 0.718892 14.0126 0.904844 13.996 1.08981C13.9793 1.27477 13.9114 1.45143 13.8 1.6L11.25 5L13.8 8.4C13.9114 8.54857 13.9793 8.72523 13.996 8.91019C14.0126 9.09516 13.9775 9.28111 13.8944 9.44721C13.8114 9.61332 13.6837 9.75302 13.5257 9.85065C13.3678 9.94829 13.1857 10 13 10H3C2.73478 10 2.48043 10.1054 2.29289 10.2929C2.10536 10.4804 2 10.7348 2 11V14C2 14.2652 1.89464 14.5196 1.70711 14.7071C1.51957 14.8946 1.26522 15 1 15C0.734784 15 0.48043 14.8946 0.292893 14.7071C0.105357 14.5196 0 14.2652 0 14V3Z"
                                                  fill="#64666C"/>
                                        </svg>
                                        Report job </a>
                                </div>

                                <div class="related-job">
                                    <h6>Related Jobs</h6>
                                    <div class="features-job mg-bt-0">
                                        <div class="job-archive-header">
                                            <div class="inner-box">
                                                <div class="logo-company">
                                                    <img src="{{asset('app-assets/candidates/images/logo-company/cty2.png')}}"
                                                         alt="images/logo-company/cty2.png"/>
                                                </div>
                                                <div class="box-content">
                                                    <h4>
                                                        <a href="jobs-single.html">Tamari Law Group LLC</a>
                                                    </h4>
                                                    <h3>
                                                        <a href="jobs-single.html">HR Administration</a>
                                                        <span class="icon-bolt"></span>
                                                    </h3>
                                                    <ul>
                                                        <li>
                                                            <span class="icon-map-pin"></span>
                                                            Las Vegas, NV 89107, USA
                                                        </li>
                                                        <li>
                                                            <span class="icon-calendar"></span>
                                                            2 days ago
                                                        </li>
                                                    </ul>
                                                    <span class="icon-heart"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="job-archive-footer">
                                            <div class="job-footer-left">
                                                <ul class="job-tag">
                                                    <li><a href="#"> Part-time</a></li>
                                                    <li><a href="$"> Remote</a></li>
                                                </ul>
                                                <div class="star">
                                                    <span class="icon-star-full"></span>
                                                    <span class="icon-star-full"></span>
                                                    <span class="icon-star-full"></span>
                                                    <span class="icon-star-full"></span>
                                                    <span class="icon-star-full"></span>
                                                </div>
                                            </div>
                                            <div class="job-footer-right">
                                                <div class="price">
                                                    <span class="icon-dolar1"></span>
                                                    <p>$83,000 - $110,000 <span class="year">/year</span></p>
                                                </div>
                                                <p class="days">24 days left to apply</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="features-job mg-bt-0">
                                        <div class="job-archive-header">
                                            <div class="inner-box">
                                                <div class="logo-company">
                                                    <img src="{{asset('app-assets/candidates/images/logo-company/cty7.png')}}"
                                                         alt="images/logo-company/cty7.png"/>
                                                </div>
                                                <div class="box-content">
                                                    <h4>
                                                        <a href="jobs-single.html">Tamari Law Group LLC</a>
                                                    </h4>
                                                    <h3>
                                                        <a href="jobs-single.html">HR Administration</a>
                                                        <span class="icon-bolt"></span>
                                                    </h3>
                                                    <ul>
                                                        <li>
                                                            <span class="icon-map-pin"></span>
                                                            Las Vegas, NV 89107, USA
                                                        </li>
                                                        <li>
                                                            <span class="icon-calendar"></span>
                                                            2 days ago
                                                        </li>
                                                    </ul>
                                                    <span class="icon-heart"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="job-archive-footer">
                                            <div class="job-footer-left">
                                                <ul class="job-tag">
                                                    <li><a href="#"> Part-time</a></li>
                                                    <li><a href="#"> Remote</a></li>
                                                </ul>
                                                <div class="star">
                                                    <span class="icon-star-full"></span>
                                                    <span class="icon-star-full"></span>
                                                    <span class="icon-star-full"></span>
                                                    <span class="icon-star-full"></span>
                                                    <span class="icon-star-full"></span>
                                                </div>
                                            </div>
                                            <div class="job-footer-right">
                                                <div class="price">
                                                    <span class="icon-dolar1"></span>
                                                    <p>$83,000 - $110,000 <span class="year">/year</span></p>
                                                </div>
                                                <p class="days">24 days left to apply</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="features-job mg-bt-0">
                                        <div class="job-archive-header">
                                            <div class="inner-box">
                                                <div class="logo-company">
                                                    <img src="{{asset('app-assets/candidates/images/logo-company/cty8.png')}}"
                                                         alt="images/logo-company/cty8.png"/>
                                                </div>
                                                <div class="box-content">
                                                    <h4>
                                                        <a href="jobs-single.html">Tamari Law Group LLC</a>
                                                    </h4>
                                                    <h3>
                                                        <a href="jobs-single.html">HR Administration</a>
                                                        <span class="icon-bolt"></span>
                                                    </h3>
                                                    <ul>
                                                        <li>
                                                            <span class="icon-map-pin"></span>
                                                            Las Vegas, NV 89107, USA
                                                        </li>
                                                        <li>
                                                            <span class="icon-calendar"></span>
                                                            2 days ago
                                                        </li>
                                                    </ul>
                                                    <span class="icon-heart"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="job-archive-footer">
                                            <div class="job-footer-left">
                                                <ul class="job-tag">
                                                    <li><a href="#"> Part-time</a></li>
                                                    <li><a href="#"> Remote</a></li>
                                                </ul>
                                                <div class="star">
                                                    <span class="icon-star-full"></span>
                                                    <span class="icon-star-full"></span>
                                                    <span class="icon-star-full"></span>
                                                    <span class="icon-star-full"></span>
                                                    <span class="icon-star-full"></span>
                                                </div>
                                            </div>
                                            <div class="job-footer-right">
                                                <div class="price">
                                                    <span class="icon-dolar1"></span>
                                                    <p>$83,000 - $110,000 <span class="year">/year</span></p>
                                                </div>
                                                <p class="days">24 days left to apply</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-content">
                                <h5>Full Job Description</h5>
                                <p>Are you a User Experience Designer with a track record of delivering intuitive
                                    digital experiences that
                                    drive results? Are you a strategic storyteller and systems thinker who can concept
                                    and craft smart,
                                    world-class campaigns across a variety of mediums?
                                </p>
                            </div>
                            <div class="inner-content">
                                <h5>Full Reviews</h5>
                                <p>Are you a User Experience Designer with a track record of delivering intuitive
                                    digital experiences that
                                    drive results? Are you a strategic storyteller and systems thinker who can concept
                                    and craft smart.
                                </p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-lg-4">
                    <div class="cv-form-details po-sticky job-sg">
                        <div class="map-content">

                            <iframe class="map-box"
                                    src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7302.453092836291!2d90.47477022812872!3d23.77494577893369!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1627293157601!5m2!1svi!2s"
                                    allowfullscreen="" loading="lazy"></iframe>

                        </div>
                        <ul class="list-infor">
                            <li>
                                <div class="category">Website</div>
                                <div class="detail">{{$data['website']}}</div>
                            </li>
                            <li>
                                <div class="category">Email</div>
                                <div class="detail">{{$data['companyEmail']}}</div>
                            </li>
                            <li>
                                <div class="category">Industry</div>
                                <div class="detail">{{$data['company_title_about']}}</div>
                            </li>
                        </ul>

                        <div class="wd-social d-flex aln-center">
                            <span>Socials:</span>
                            <ul class="list-social d-flex aln-center mt-3">
                                @foreach($data['socialMedia'] as $value)
                                    <li><a href="{{$value->url}}"><img class="rounded-circle" src="{{$value->icon}}"></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="form-job-single">
                            <h6>Contact Us</h6>
                            <form action="post">
                                <input type="text" placeholder="Subject">
                                <input type="text" placeholder="Name">
                                <input type="email" placeholder="Email">
                                <textarea placeholder="Message..."></textarea>
                                <button>Send Message</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
