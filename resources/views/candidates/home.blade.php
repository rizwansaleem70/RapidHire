@extends('candidates.layouts.main')
@section('main-section')

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

    @if(session('message'))
        <div class="alert alert-danger">
            {{session('message')}}
        </div>
    @endif

    <!-- SLIDER-->
    <section class="tf-slider sl4 over-flow-hidden" style="background-color: #0c3438; width: 100% !important;">
        <div class="tf-container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="content wow fadeInUp">
                        <div class="heading text-white">
                            <h2 class="text-white">Find the job that fits your life</h2>
                            <p>Resume-Library is a true performance-based job board. Enjoy custom hiring products and
                                access to up to
                                10,000 new resume registrations daily, with no subscriptions or user licences.</p>
                        </div>
                        <div class="form-sl">
                            <div class="form-group-4" style="width: 150px;">
                                <button type="submit" class="btn btn-find"
                                        style="background-color: #fff; color: black;">Find Jobs
                                </button>
                            </div>
                            <!-- End Job  Search Form-->

                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="wd-review-job thumb2 widget-counter tf-sl4">

                        <img src="{{asset('app-assets/candidates/images/used/Right.png')}}" alt="images">


                        <div class="tes-box ani5">
                            <div class="client-box">
                                <div class="avt">
                                    <img src="{{asset('app-assets/candidates/images/review/client.jpg')}}" alt="images">
                                    <div class="badge"></div>
                                </div>
                                <div class="content">
                                    <h6 class="number wrap-counter">
                                        <span class="number counter-number" data-speed="2000"
                                              data-to="480">480</span><span>+</span>
                                    </h6>
                                    <div class="des">Happpy Candidates</div>
                                </div>
                            </div>
                        </div>
                        <div class="icon1 ani3">
                            <img src="{{asset('app-assets/candidates/images/review/icon1.png')}}" alt="images">
                        </div>
                        <div class="icon2 ani1">
                            <img src="{{asset('app-assets/candidates/images/review/icon2.png')}}" alt="images">
                        </div>
                        <div class="icon3 ani6">
                            <img src="{{asset('app-assets/candidates/images/review/icon3.png')}}" alt="images">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SILDER -->
    <div class="container">
        <!-- Job-category -->
        <section class="job-category-section-three">
            <div class="tf-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tf-title wow fadeInUp">
                            <div class="group-title">
                                <h1>Browse by category</h1>
                                <p>Recruitment Made Easy in 100 seconds</p>
                            </div>
                            <a href="job-single.html" class="tf-button">
                                All Categories
                                <span class="icon-arrow-right2"></span>
                            </a>
                        </div>
                    </div>
                    <!-- wd-job-category -->
                    <div class="col-md-12">
                        <div class="group-category-job  wow fadeInUp row">
                            @foreach($home['departments'] as $department)
                                <div class="job-category-box col-md-3">
                                    <div class="job-category-header">
                                        <span class="d-block fs-5 fw-bold">{{$department->name}}</span>
                                    </div>
                                    <p>{{$department->job_count}} Jobs available</p>
                                    <a href="#" class="btn-category-job">Explore Jobs <span
                                            class="icon-keyboard_arrow_right"></span></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End Job-category -->

        <!-- WD-JOB -->
        <section class="job-category-section-three" style="background-color: #fff9f9;">
            <div class="tf-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tf-title wow fadeInUp">
                            <div class="group-title">
                                <h1>TRENDING JOBS</h1>

                            </div>
                            <a href="job-single.html" class="tf-button">
                                Features
                                <span class="icon-arrow-right2"></span>
                            </a>
                        </div>
                    </div>
                    <!-- wd-job-category -->
                    <div class="col-md-12">
                        <div class="group-category-job  wow row ">
                                @foreach($home['jobs'] as $job)
                                    <div class="job-category-box2 col-md-4">
                                        <div class="job-category-header">
                                            <h1>{{$job->name}}</h1>
                                        </div>
                                        <p>{{$job->total_position}} Jobs available</p>
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAX0lEQVR4nO3SwQmAMBBE0dQSS8zBQxqwyLDDdiBkIUctQM8a5T/4BQxMSgAAAAAAAK/a3ZculTBbZ65LZbjny4AwayEdn8is/W/AcM8h1S5tMxdSvb0QAAAAAABAetIJeOBba7Ua6isAAAAASUVORK5CYII=">
                                        <div class="job-category-header" style="opacity: 60%;">
                                            <p>Software Engineer
                                            <p>
                                            <p>Ubisoft</p>
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!--END WD-JOB -->
    </div>
    <!-- WD-Location -->
    <section class="wd-iconbox flat-row background3 style-2 mt-3">
        <div class="tf-container">
            <div class="title-iconbox style-2">
                <h1>How It Works</h1>
                <p>
                    Streamline your hiring process with strategic channels to reach
                    qualified candidates
                </p>
            </div>
            <div class="row rg-st1">
                <div class="colum3 wow fadeInUp  animated" style="visibility: visible;">
                    <!-- tf-iconbox -->
                    <div class="tf-iconbox style-2">
                        <div class="box-header">
                            <div class="icon bg-white">
                                <svg width="42" height="43" viewBox="0 0 42 43" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.1242 26.6601C12.2169 26.6601 13.9133 24.9714 13.9133 22.8883C13.9133 20.8052 12.2169 19.1165 10.1242 19.1165C8.03144 19.1165 6.33496 20.8052 6.33496 22.8883C6.33496 24.9714 8.03144 26.6601 10.1242 26.6601Z"
                                          stroke="#0c3438" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M8.59724 31.9404L10.1242 35.9951C10.5767 37.1832 11.7078 37.9753 12.9897 37.9753H18.3624C19.2484 37.9753 19.9648 37.2586 19.9648 36.3723C19.9648 35.5613 19.3616 34.8824 18.5509 34.7881L14.4036 34.2789C14.1019 34.2412 13.838 34.0337 13.7626 33.732C13.5175 32.8079 12.952 30.8277 12.3676 29.6962C11.6135 28.1874 10.8594 26.6787 8.20135 26.6787C4.78919 26.6787 4.03512 28.9418 3.28106 31.9592C2.52699 34.9767 1 41.0116 1 41.0116"
                                          stroke="#0c3438" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M10.8778 37.221L10.1426 40.9928" stroke="#0c3438" stroke-width="2"
                                          stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M15.4209 37.9753H39.5511" stroke="#0c3438" stroke-width="2"
                                          stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M24.452 8.55534C25.7117 8.55534 26.733 7.54212 26.733 6.29226C26.733 5.04239 25.7117 4.02917 24.452 4.02917C23.1922 4.02917 22.1709 5.04239 22.1709 6.29226C22.1709 7.54212 23.1922 8.55534 24.452 8.55534Z"
                                          stroke="#0c3438" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M20.7002 13.8358V12.9871C20.7002 9.66792 22.4346 8.55524 24.0935 8.55524H24.8476C26.5065 8.55524 28.2409 9.66792 28.2409 12.9871V13.8358"
                                          stroke="#0c3438" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M11.6504 10.0641V3.2748C11.6504 2.03011 12.6684 1.01172 13.9126 1.01172H23.7155"
                                          stroke="#0c3438" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M11.6504 10.0641V14.5902C11.6504 15.8349 12.6684 16.8533 13.9126 16.8533H28.2399L32.7643 21.3795V16.8533H35.7806C37.0248 16.8533 38.0428 15.8349 38.0428 14.5902V3.2748C38.0428 2.03011 37.0248 1.01172 35.7806 1.01172H23.7155"
                                          stroke="#0c3438" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M22.208 34.2035L25.9783 24.3969H40.3056L36.5353 34.2035H22.208Z"
                                          stroke="#0c3438" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M28.9951 37.9753V34.2035" stroke="#0c3438" stroke-width="2"
                                          stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>

                        </div>
                        <img class="connect-line" src="{{asset('app-assets/candidates/images/used/connect line.png')}}">
                        <div class="box-content">
                            <h1 class="box-title">
                                <a href="#">1.  Post A job</a>

                            </h1>
                            <p>
                                Structured digital interviews increase the predictive
                                validity of your hires by 65%.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="colum3 wow fadeInUp  animated" data-wow-delay="0.3s"
                     style="visibility: visible; animation-delay: 0.3s;">
                    <!-- tf-iconbxox -->
                    <div class="tf-iconbox style-2">
                        <div class="box-header">
                            <div class="icon bg-white">
                                <svg width="100" height="100" viewBox="0 0 100 100" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <rect width="100" height="100" rx="50" fill="white"></rect>
                                    <path d="M48.7688 46.2566C51.0321 46.2566 52.8668 44.4211 52.8668 42.157C52.8668 39.8929 51.0321 38.0575 48.7688 38.0575C46.5056 38.0575 44.6709 39.8929 44.6709 42.157C44.6709 44.4211 46.5056 46.2566 48.7688 46.2566Z"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M42.2319 55.7059V52.8157C42.2319 47.8963 45.2234 46.2565 48.133 46.2565H49.4443C52.3334 46.2565 55.3453 47.8963 55.3453 52.8157V55.7059"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M31.9462 38.0985C31.8028 38.078 31.6594 38.0575 31.5159 38.0575C29.2621 38.0575 27.4385 39.9023 27.4385 42.157C27.4385 43.8378 28.463 45.2932 29.8972 45.9286"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M32.7661 46.0517C34.4258 45.5187 35.6347 44.0019 35.6347 42.1571C35.6347 41.0707 35.2044 40.1073 34.5282 39.3694"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M38.1139 55.7061V52.8159C38.1139 48.2244 35.4708 46.4821 32.7661 46.2771"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M29.8975 46.3181C27.3568 46.6666 25.0005 48.4499 25.0005 52.8159V55.7061"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M64.7709 46.0517C63.1112 45.5187 61.9023 44.0019 61.9023 42.1571C61.9023 41.0707 62.3326 40.1073 63.0088 39.3694"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M59.4233 55.7061V52.8159C59.4233 48.2244 62.0665 46.4821 64.7711 46.2771"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M67.7422 46.2566C67.7422 46.2361 67.7422 46.195 67.7422 46.1744"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M31.9469 38.0985C30.738 40.4557 30.0004 43.0999 29.8774 45.9286"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M65.6313 38.2419C66.8402 40.6401 67.5369 43.3253 67.6189 46.1745"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M31.9873 38.0985C35.1017 32.0107 41.4535 27.8291 48.7684 27.8291C56.1447 27.8291 62.5374 32.0722 65.6314 38.242"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M29.9175 46.3179C29.9175 46.4409 29.9175 46.5639 29.9175 46.6869C29.9175 57.0997 38.3592 65.5448 48.768 65.5448C59.1768 65.5448 67.6185 57.0997 67.6185 46.6869C67.6185 46.5434 67.6185 46.3999 67.598 46.2565"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M29.8774 46.318C29.8774 46.1745 29.8774 46.0515 29.8979 45.9081"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M32.7461 46.2772C32.7461 46.1952 32.7461 46.1132 32.7666 46.0518"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M60.4673 61.7529L70.077 71.3253C71.2039 72.4527 73.0275 72.4527 74.1544 71.3253C75.2814 70.198 75.2814 68.3942 74.1544 67.2668L64.5447 57.6944"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M65.5913 38.0985C65.7347 38.078 65.8782 38.0575 66.0216 38.0575C68.2755 38.0575 70.099 39.9023 70.099 42.157C70.099 43.8378 69.0746 45.2932 67.6403 45.9286"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M67.6396 46.3181C70.1804 46.6666 72.5367 48.4499 72.5367 52.8159V55.7061"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>
                        <img class="connect-line" src="{{asset('app-assets/candidates/images/used/connect line.png')}}">
                        <div class="box-content">

                            <h1 class="box-title">
                                <a href="#">2.  Find Employers</a>
                            </h1>
                            <p>
                                Structured digital interviews increase the predictive
                                validity of your hires by 65%.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="colum3 wow fadeInUp  animated" data-wow-delay="0.4s"
                     style="visibility: visible; animation-delay: 0.4s;">
                    <!-- tf-iconbox -->
                    <div class="tf-iconbox style-2">
                        <div class="box-header">
                            <div class="icon bg-white">
                                <svg width="52" height="53" viewBox="0 0 52 53" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M30.5027 22.0163C33.3592 24.851 33.3592 29.4689 30.5027 32.3037C27.6462 35.1384 23.0301 35.1384 20.1736 32.3037C17.3171 29.4689 17.3171 24.851 20.1736 22.0163C22.0703 20.1189 24.7669 19.5016 27.1892 20.1417"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M36.5347 16.0277C42.7047 22.1772 42.7047 32.1445 36.5347 38.2941C30.3647 44.4436 20.3327 44.4436 14.1627 38.2941C7.99265 32.1445 7.99265 22.1772 14.1627 16.0277C19.4415 10.7697 27.531 10.0153 33.6325 13.7644"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M35.6892 5.21402C26.6627 1.00763 15.5795 2.60789 8.1298 10.0148C-1.3766 19.4792 -1.3766 34.8188 8.1298 44.2831C17.6362 53.7475 33.0612 53.7475 42.5676 44.2831C50.9543 35.9161 51.9369 22.9769 45.5156 13.5582"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M38.019 14.5413L38.796 13.7869" stroke="#148160" stroke-width="2"
                                          stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M36.5348 16.0269L30.502 22.0164" stroke="#148160" stroke-width="2"
                                          stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M30.5006 22.0168L25.0161 27.4806" stroke="#148160" stroke-width="2"
                                          stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M38.7979 13.7876L41.2659 11.3186" stroke="#148160" stroke-width="2"
                                          stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M36.5347 16.0274L38.02 14.5415" stroke="#148160" stroke-width="2"
                                          stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M37.9067 13.6721L38.0211 14.5408" stroke="#148160" stroke-width="2"
                                          stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M44.5107 8.09529V6.79224" stroke="#148160" stroke-width="2"
                                          stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M40.6021 5.48845L44.5097 1.625V6.79154" stroke="#148160" stroke-width="2"
                                          stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M39.0029 7.11152L40.6026 5.48838" stroke="#148160" stroke-width="2"
                                          stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M39.0027 7.11084L37.3574 8.73395L37.9058 13.6719" stroke="#148160"
                                          stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                          stroke-linejoin="round"></path>
                                    <path d="M38.019 14.5416L43.8463 15.2046L45.4916 13.5586" stroke="#148160"
                                          stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                          stroke-linejoin="round"></path>
                                    <path d="M45.8133 8.09473H44.5107" stroke="#148160" stroke-width="2"
                                          stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M45.4922 13.5585L50.9995 8.09473H45.8121" stroke="#148160" stroke-width="2"
                                          stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M37.9067 13.6721L38.7979 13.7864" stroke="#148160" stroke-width="2"
                                          stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>
                        <img class="connect-line" src="{{asset('app-assets/candidates/images/used/connect line.png')}}">
                        <div class="box-content">
                            <h1 class="box-title">
                                <a href="#">3.  Pay Safely</a>
                            </h1>
                            <p>
                                Structured digital interviews increase the predictive
                                validity of your hires by 65%.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="colum3 wow fadeInUp  animated" data-wow-delay="0.5s"
                     style="visibility: visible; animation-delay: 0.5s;">
                    <div class="tf-iconbox style-2">
                        <div class="box-header">
                            <div class="icon bg-white">
                                <svg width="53" height="53" viewBox="0 0 53 53" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.61922 24.7886C9.85644 24.7886 11.67 22.9833 11.67 20.7564C11.67 18.5294 9.85644 16.7241 7.61922 16.7241C5.382 16.7241 3.56836 18.5294 3.56836 20.7564C3.56836 22.9833 5.382 24.7886 7.61922 24.7886Z"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M12.5576 34.406C13.5048 34.0431 14.1094 33.156 14.1094 32.1479V31.2406C14.1094 26.4019 11.1469 24.789 8.28508 24.789H6.99523C4.13344 24.789 1.1709 26.4019 1.1709 31.2406V32.1479C1.1709 33.156 1.79565 34.0431 2.7227 34.406C3.83114 34.8293 5.52401 35.2729 7.64013 35.2729C9.75624 35.2729 11.429 34.8293 12.5576 34.406Z"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M26.2422 40.9178C28.4794 40.9178 30.2931 39.1125 30.2931 36.8855C30.2931 34.6586 28.4794 32.8533 26.2422 32.8533C24.005 32.8533 22.1914 34.6586 22.1914 36.8855C22.1914 39.1125 24.005 40.9178 26.2422 40.9178Z"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M31.1587 50.5342C32.1059 50.1713 32.7105 49.2842 32.7105 48.2761V47.3688C32.7105 42.5301 29.7479 40.9172 26.8861 40.9172H25.5963C22.7345 40.9172 19.772 42.5301 19.772 47.3688V48.2761C19.772 49.2842 20.3967 50.1713 21.3238 50.5342C22.4322 50.9576 24.1251 51.4011 26.2412 51.4011C28.3573 51.4011 30.0301 50.9576 31.1587 50.5342Z"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M26.2422 9.46637C28.4794 9.46637 30.2931 7.66107 30.2931 5.43411C30.2931 3.20716 28.4794 1.40186 26.2422 1.40186C24.005 1.40186 22.1914 3.20716 22.1914 5.43411C22.1914 7.66107 24.005 9.46637 26.2422 9.46637Z"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M31.1587 19.0828C32.1059 18.7199 32.7105 17.8328 32.7105 16.8247V15.9174C32.7105 11.0787 29.7479 9.46582 26.8861 9.46582H25.5963C22.7345 9.46582 19.772 11.0787 19.772 15.9174V16.8247C19.772 17.8328 20.3967 18.7199 21.3238 19.0828C22.4322 19.5061 24.1251 19.9497 26.2412 19.9497C28.3573 19.9497 30.0301 19.5061 31.1587 19.0828Z"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M44.7017 24.7886C46.939 24.7886 48.7526 22.9833 48.7526 20.7564C48.7526 18.5294 46.939 16.7241 44.7017 16.7241C42.4645 16.7241 40.6509 18.5294 40.6509 20.7564C40.6509 22.9833 42.4645 24.7886 44.7017 24.7886Z"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M49.6401 34.406C50.5873 34.0431 51.1919 33.156 51.1919 32.1479V31.2406C51.1919 26.4019 48.2294 24.789 45.3676 24.789H44.0777C41.216 24.789 38.2534 26.4019 38.2534 31.2406V32.1479C38.2534 33.156 38.8782 34.0431 39.8052 34.406C40.9137 34.8293 42.6065 35.2729 44.7226 35.2729C46.8388 35.2729 48.5115 34.8293 49.6401 34.406Z"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M42.7668 38.9824C40.9328 41.4623 38.5749 43.5187 35.834 44.9703"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M10.2798 13.8004C12.4765 11.1189 15.3181 9.02215 18.583 7.71167"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M16.568 44.9703C13.8272 43.5187 11.4692 41.4623 9.63525 38.9824"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M33.8198 7.71167C37.0847 9.02215 39.9263 11.1189 42.123 13.8004"
                                          stroke="#148160" stroke-width="2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="box-content heading-4">
                            <h1 class="box-title">
                                <a href="#">4.  We’re Here To Help</a>
                            </h1>
                            <p>
                                Structured digital interviews increase the predictive
                                validity of your hires by 65%.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END WD-Location -->
    <div class="container">
        <!-- WD-Review-job -->
        <section class="employer-section-four">
            <div class="tf-container">
                <!-- wd-employer -->
                <div class="wd-employer">
                    <div class="tf-title">
                        <div class="group-title text-center mt-5">
                            <h1><span style="font-size: larger;">Our Core </span> Values</h1>
                            <img src="{{asset('app-assets/candidates/images/used/path2987.png')}}" style="    margin-right: 5rem;
            margin-top: -3rem;">

                        </div>

                    </div>
                    <div class="row wow fadeInUp  animated" style="visibility: visible; justify-content: center;">
                        <div class=" col-lg-4 col-md-6 col-sm-6 mb-4">
                            <div class="author-group">
                                <div class="sl-icon-box box mb-2">
                                    <img class="circle-img "
                                         src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFcklEQVR4nO2aaWwVVRTHf0Us1mhdW+saFjEiVWtqNBrQuEUjxi9uicaCjYD6QY2J8RMat0QNaoxEwSUqn6waFUEJqSiuJbh8UAQtaozgQlGE8mxFpM8c8x9yMs68N28ebd+j808m7b3v3Jl7/vee5Z4ZyJAhQ4YMGTJkGMH4APgCOJsRiryuAWAh0MAIJaBff3uANqCGEUbAROBt116uvj0NtrBXAl8BK3AKB7gC2Ki+v4EHgDHsGTgf+NTpnI8iwHAI8Kz8gv22BjiL6sUZwLtO1/XFCAgwRVulWp3kJOAlt5C/A3cAdUkJMOytQf3uJrMq3EkeAywA/tGcczLlA51MYgICTACWOfn3xHAl4VAp2u98mBFxeIRsyQSgVW9TqAxC5xygtsSJGpl3A6s1yWAO22Vy84Fp2qpJcABwL7BN99kJvACMLTAmFQEBDgIe04PyBS6POkWYTmeTxa4+yd8CHBUxj1qZ469ujMm3JNChLAICLEhAwMlajZzrz6nPwtJ+IYVatatWhYiy/z8B7gJOBWaGvPkKefukKJuA8Vohm9g5MTK2jXc4BcxvXAfsn/AZZrvXA68Df8aQ/BlwUYr5l03AWxpnoTEOqyXzlAgrB2ZCFwNPAj8Ca4GryohGZRFwucZsBhpjZGqcjyjVSQ4FUhNg23eDxswuIFcTc+8mYDHQK5s+hSoj4FHJrwRGpSBgSciG1yvZqgoCWuTUdiQINXEEBEnKkS7NnkoVEDAK6JKs7QJSEhBEBMMTat9OBRDQBowuMGC25DYkDGNRBByt9h9qX632IoYeu+b2oWt0xxDRKI9vMpeV8JCfNWaKlF+q9ov6/QgdWPqVxw8F9pKOuwgwZacD61znOvUFRCxUv8X+UvBgROLym+w/wKvqf56hUbzbzeV9LxBHxH2y2b4UycwYkfATsBXoiMjpj9W97XmPl3AAKkfxuJ0eS0ReOXgYJ2pXWAntc9l0GkzTSTDwMfeoTG9ms2/Ke44uVfE4Ir7X4C9DWd95buX8NYN0aFVilOSUmB9MxcNokPKeBK/8M6q03Ky25f9pUaMT3cPAO8C3bmckIaA+VPQsS3GPRkdCt1N+vjuMNLgYb4eVX1SPO47yMNGZ4w/A5AKy9zu53aJ4mIQgcwsrb3+fjlmprUUmnQQWIj9yOcS5MVWhWiVp4xgkLHfb3isfZHR5lZ8niLCXUyQ6y7SNTwr176MdlZdZmH8K0K6c4zQGGds0AWM7SvnOUBg7TP1bSnjGxxrTr1JYTSgdf8iZ2p0Kc6vUZ0QMKta6Y/DBoW0fVh5txbBf6CjiF+pCpC7VEdrjRlfynqWymtn8oKM9xs6jlK+TJ0/rFy511eeNyhU8puu3rxlizFCoG3A2H6V8ZxG/8IaT71IiNS6iJhi8i7DnzXPPqlf/XwwTNmkCplgh5eP8gu2CACvV1xNRGzAfcJsUzSsSXeLOGeYwhwVbNIGmEpT3fiEIaabQra5StD3GmbVEpOc7VSgdFizSJF7TAef40BvYUv3CDcBc154rD+8xVb+ZA3xTGemwYZIKm1HKJPEL4RT6G8m1u/R3iWw9QJM7UlcEmjXJnHzCQEK/EJVCW47hV3qT8/LX6LA0T33/fdlRiehN4BfiUujvQtXh8fowIx9h9/ZKrSKxuIhfKJRC5/WNkn+HP1bfI+SVSL0CnE4Fo7mAX4hLofuU0gYvT9eEKk+PqN9S4KpAs/MLFtef0/E0KoW27XyBxrW6ImqPXnjWy2SCclnVYmaBXdHhIsYJMTJG1JlUOa5VCt2rY/VNLpnq0nc9F6qdk1PMqXJbzV+oFcRkV3P0l33uMmLQID+xWb5izu4uZWXIkCFDhgwZMmTg//gXsC+QyFk+TX0AAAAASUVORK5CYII=">
                                </div>
                                <p class="lead" style="color: #1db5bf; text-align: center;">TRUST OVER PROCESS</p>
                            </div>
                            <div class="wd-testimonials mt-2">
                                <p class="description">Trust i our most fundamental core value. We trust our
                                    People to do their best for the organization without strict
                                    Monitoring processes. Similaly, we expect that you wil trust
                                    The organization to help you become successful.</p>

                            </div>
                        </div>
                        <div class=" col-lg-4 col-md-6 col-sm-6 mb-4">
                            <div class="author-group">
                                <div class="sl-icon-box box mb-2">
                                    <img class="circle-img "
                                         src="data:image/png;base64,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">
                                </div>
                                <p class="lead" style="color: #1db5bf; text-align: center;">EFFORT OUR OUTCOME</p>
                            </div>
                            <div class="wd-testimonials mt-2">
                                <p class="description">At times, great effort ends in failure, or conversely, ordinary
                                    Effort leads to success. We recognize and reward effort and.
                                    Resist the temptation to judge you based on outcomes.<br><br></p>

                            </div>
                        </div>
                        <div class=" col-lg-4 col-md-6 col-sm-6 mb-4">
                            <div class="author-group">
                                <div class="sl-icon-box box mb-2">
                                    <img class="circle-img "
                                         src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAE4UlEQVR4nO2aeaxdUxTGf0+fqa+ooa0Ef6CeIBU1pFRTmtIQUaVRQosY2hJTQvAHT4uoIcYgSKQ8JFUSYmwRMSRaQ9Cqaggx9ZlblD6vw7vNkm/LsnvOcc+55753X9Iv2ck5a6+99njWt9a+FzZhExoKOwIfA5WSy2JgYE9NYlvg3TpMIpSFwDb1nkR/4C3X6fMpelsA86TzpUpFMqtLgtkKdl8Dtq7XJGwAL0ard3WC3mbAHNX/CLQCewIdkj0NNCe0uyayPR/YsuxJNGsAYXDf6Xlcgu79qvsVGObk+wMrVPcA0BS1O1p137pJPwn0K2sStsKPy/BvwAhgNdANbB/p3ii9v4BRCbas7SrpzIrqtgPWA53AcOAX6bVrDDWhya1wGNxBel8a6V4keRdwTIbNscDf0r0iqlsq+YHAAW4HH0rYwVy4RYZsB8ZIdoFks53eFO3QOuDkKuxOANaqzVQnny3b0/V+mNvBO4pO4joZWAMc5+SPRJ2Nd4M6N4f9M9XGjtMpkk13OxBwlI6bydvyTuISNVznOglYprrh2qXQyeV5O3H92GIdK5sVka3HCVqspOOYirO1UlbOieoGagXtqI0E/pBx272iuMl9g0cAf6oPI16PyZJ3u9OQiilO+fyE+nHqdDnws57voTbYR/ygc9kdej4yQXeaO442scwP0IxcmaLTFpHWY2W4xohEK/8zBn/sJ5FARsElzszo8AXX0bPA5pQHs+Ujh6cydGc6V/+vIxqtM1/po2W15vAP23Y1wICKli7N4T8kF8KDNFwqvZeoH+apD/uw0zBMXs7z2Uas+rniniRYnvC7PMc+lI9WeaSVQEvGGD7VWC0G3AgW/3/gPuS02OZu6dxL+bhPti00SkKTnIDpLFJ+lIihWo0s9zdUq2ZbuwPlwch2ldzq7ik6V2lsK5XjZOJ4RzrmlrOyucsoDxbiZLndMS6mO7Fao7NcErVrQn1Igr5Kyfbyop9Lh0cn1O/sGP+GvEw7Xw0XpOTZi1V/ErVjomx9mEKU4Z7g1SIZ42ClnWbgroT6aap7g9rxpmydleFcvgEGFe3Ak+UZUV1/l44eXLQDF7r/BGwV1Z3qwnyLtmvChTJm4fV+KSG4zxbz4mHZuD6S7+3ShCxyLNTZZxFZ7qLVsoBzSAG7gxRNrImcygCXv1uEXRo8WT4TkeVcye1eKi/aEhi6ydnMJL2i2EvXQTF/HC5ZR8YtIineKNyPjUjgkxXVkF5RjBchrVVaGhDugk/PYWuy2rznZCN1zLqV6NUVN2sAP+gbCSmyyd7PYecdtTlN7/aNLS/hDqBqGCG9rA7f1nGy8r1k1bjJ+Dg2i48qRUmvKAa7832bZNfq/Ykq2s+NLsFv1/vXwE70MA51ZDlJk+vU97NbRrvYZU/QN2Hvh9BLuFgTsfB7X3cLGV9Qp5FoqxI1ez+PXkYY/DJ5suA6W1L4KIQ1pvuJnh+lAdACLNGA5rhINWmFp7pAs13PH9WD9MogyzCRJQnp8qJIx3ZuDxoME11mGa5q7LeQgLFOvl7F3/I3FG6N7pzsEiPguahuBg2MZuB1N9hueaZwYRHkr/Qk6RXFEEeWVu5UhlnpTdIrilEivYp4InBFZ43ZZK8gXK/6Ev9w1GfQ7iZhz30WA3T39UU9/5JBD8HI0kpdsQG38TcxqJJJ+QAAAABJRU5ErkJggg==">
                                </div>
                                <p class="lead" style="color: #1db5bf; text-align: center;">VALUE OVER PROFIT</p>
                            </div>
                            <div class="wd-testimonials mt-2">
                                <p class="description">
                                    Always ask yourself the question "Is my work actually us:
                                    for someone?” as opposed to "Have I met the requiremes
                                    Given to me so we can bill the client?”<br><br><br></p>

                            </div>
                        </div>
                        <div class=" col-lg-4 col-md-6 col-sm-6 mb-4">
                            <div class="author-group">
                                <div class="sl-icon-box box mb-2">
                                    <img class="circle-img "
                                         src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAADB0lEQVR4nO2YSWgUQRSGP02IxoUEAiLoIaIBjaAnExRc8ODBRG8eTJy4xoMQl4CICqImh4ggRHNKvIgHT4oHBQniRUERwQ13UNGjxuACAbeRBy/QDD3d1TVV047OB3WY7ldvqXnV1f1Dmf+HCmANcBQ4DcykBKkHHgHZwLgKbAAmUEL/xIOcIoLjPCXCyogixscqSoBOg0IOUgJsNijkMCXAaoNC2vnLNnUGeA5cD1zfkbC1uoCt6q/oLAGeBBK7Ebi3EPgVU0ir2k4Ffuq1+8DSYhUgZ8Ah4LsGfwV0hKzmQEQR13LOkhbgtd77AXT7Pmsk2UENKCt+EpiUx3YOMBpShCTaHGI/GegDfqvdWWCir0LOaZBvwFoD+30hhfTHzFkHfFXbQR//zH51/gVYZjhnT0ghPQbzlgeKkcVwRrNuSGmn9Qb2VcCuPK01onsqrm1atc1kLza52hf3NAnp4Ti2AO8NHr8v9AUyihNqe9dFi2XU2VtgSoztcYMCcofMyUc18E7t2got5I46kgMrigaDsyNsyJzFEX63qd3tQopYFOhrWZ0o2i2KyBps6Grgk9rJQWtFtzoYMrCdAey0HPNjfA9pHpKPFZfVwSbSJaN5XLR18EwdLCBdGjUPeTm14qM6qCNd6jQPyceK8RfDStKlUvOQfKwYUQc1pEtN4OlpxSXgpb5ypEmV5mG92f9ZtbC/SGphheuY8nH0OOcUvuJZLax3HVNW5WGR1UIvCmUaaqGXmGmohV5ipqEWeomZhlroJeb2FForqUJpRBK10BXeYp5JoBa6YsBHTFO1UD58DgCzEvqfrfM6LGImZq+BWvhBr4v2dRM4okrkXKBWbWr1d4vevxVoI/kmL1ShjGV3iNPeHBsR0C4AYwabNTjGdF6TgULZiyVRauFnYGOIWjhdlchTwDDwJjB/VH8P633ReKc5iOlELXyqCbnAecxjCdvDVJh2rVD2RDmcZ6kWiti8wrKIBh8x2ywcZhMI3K4Vyr4otbDTUi0U7cmGQhTKRsuYZcqQgD8OBkR7NyLfMQAAAABJRU5ErkJggg==">
                                </div>
                                <p class="lead" style="color: #1db5bf; text-align: center;"> COLLABORATION OVER
                                    COMPETITION </p>
                            </div>
                            <div class="wd-testimonials mt-2">
                                <p class="description">

                                    There is no individual glory (or failure) at Ubisoft. To
                                    Constantly enrich each other's work life is way more
                                    (important) than to be better than your colleagues and peers!
                                </p>

                            </div>
                        </div>
                        <div class=" col-lg-4 col-md-6 col-sm-6 mb-4">
                            <div class="author-group">
                                <div class="sl-icon-box box mb-2">
                                    <img class="circle-img "
                                         src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAADK0lEQVR4nO2ZO2gVQRSGPxONoAkiFgpKKl8YbSxFiNoKaoIkhSAWghriI4IWIiKiEkTERmzEQo2ChUkRQREEbUSxMfGVl1goCir4NjGayIEzsKw7s3vv3d07gXxw4F7mzOz8szNzzs7AJJNMkhdHgD/AeMhGgf1MEGYCXyJEGPsATGcCsM0hwlgjE4D7CYTcxHMWA2MJhPwFavGY9gQijB3GU6YCbwsQ8gqowEM2FCDC2Do8pMvS2WfAT0vZVTxjLvDb0tm9wHVL2S9gNh5x0NJRieTzgI2O6dWKRzy3dLJby6dpRI/yeYInrHaMdnPA77zDbyUecNHSOcm3ZiQUfI4yUw18tXTuQsh3CjBk8f0cEp072x2jXB/hf9zhv4Uy8sDSqdeWqL3UIeQuZWKJo1My8jYeW+pIsrmQMnDaIURG3kabo94JypAgvrN05mGCLGDUUvcNUEmONJYYqW876q8nR7odKYmMeBxbHUJukBPzLSckaZnJzzLnUIYijB3IWoRE54EchPTpszKjPgcRYu+znl6XMhYgQfGM5nBVQJN+Rb4EvqvJ7w4tE5+CmQX8yFDEiHbObO9DCeoMAg2FCtnpaPAYxdOv51zNmp+dCn107QGW6VGsWJ1+PvcE/NoLOZF55BCyqAQhR3U6ERAxDOyI6ZyU7VJfIyaWFQ4RkgGXwgIdaZMtDFs+ATr1pCbMmoCYTXEPO+sQ0kLpVAXWhLyJKMzzomjRsgE9H4hErgA+OhbonBSENAXWREURQiqBXi3fHPeQKJPXnQbXtL3dDp9xhxBhn5ZfsTncyuGeo0/bk92pWCF1Wi5x5j9qdWuMEvEpxZsnc4BRo//lTSeNP2YDqNH/0lbkXaCtATmnwgMhnUmEDDoaWJWikDSm1nLX1LpnEXEn5ey0Q9uViF2skDYtv0wZMTtjTwnb79O47TcPqgLTWNKOKFxCWrWs3xUQ86IhkKJI2hGmyxK31mpgHtNbM68uU0VMS8zRUKW+iRGtcxKPqAjdDPdqxK7Tj61q3Z3aAmtiTEV4ebEqWWySswFZE95MJxuyaGUHktzpBfBNTW7HZIuVssiF/Q/As4lL64+MgwAAAABJRU5ErkJggg==">
                                </div>
                                <p class="lead" style="color: #1db5bf; text-align: center;"> EXCELLENCE OVER
                                    SUCCESS </h6>
                            </div>
                            <div class="wd-testimonials mt-2">
                                <p class="description">


                                    Excellence is all about being the best at what you do and
                                    Maximizing your talents and abilities to perform at your
                                    The highest potential. Success will automatically follow.
                                </p>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
        <!-- End-WD-review-job -->
        <!-- wd-counter -->

        <script>
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 5000);
        </script>

    </div><!-- /.boxed -->
@endsection
