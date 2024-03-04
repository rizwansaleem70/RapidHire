@extends('candidates.layouts.main')
@section('main-section')
    <section class="inner-employer-section-two" style="margin-top: 3rem;">
        <div class="tf-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="group-4-8">
                        <div class="cl4">
                            <div class="widget-filter st2  style-scroll po-sticky">
                                <form action="{{ route('candidate.job.list') }}" method="GET">
                                    <div class="group-form">
                                        <label class="title">Search Job</label>
                                        <div class="group-input search-ip">
                                            <button><i class="icon-search"></i></button>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ request()->input('name') }}"
                                                placeholder="Job title, key words or company">
                                        </div>
                                    </div>
                                    <div class="group-form">
                                        <label class="title">Country</label>
                                        <div class="group-input has-icon">
                                            {{--                                            <i class="icon-map-pin"></i> --}}
                                            <select id="country-id" class="form-select" name="country_id">
                                                <option value="">Select Country</option>
                                                @foreach ($data['country'] as $key => $value)
                                                    <option {{ request()->input('country_id') == $key ? 'selected' : ' ' }}
                                                        value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="group-form">
                                        <label class="title">State</label>
                                        <div class="group-input has-icon">
                                            <select id="state-id" class="form-select" name="state_id">
                                                <option value="">Select Option</option>
                                                @foreach ($data['states'] as $state)
                                                    <option
                                                        {{ request()->input('state_id') == $state->id ? 'Selected' : '' }}
                                                        value="{{ $state->id }}">{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="group-form">

                                        <label class="title">City</label>
                                        <div class="group-input has-icon">
                                            <select id="city-id" class="form-select" name="city_id">
                                                <option value="">Select Option</option>
                                                @foreach ($data['cities'] as $city)
                                                    <option {{ request()->input('city_id') == $city->id ? 'Selected' : '' }}
                                                        value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="group-form">
                                        <label class="title">On-site/Remote</label>
                                        <div class="group-input">
                                            <select class="form-select" name="job_type">
                                                <option value="">Select Any</option>
                                                <option {{ request()->input('job_type') == 'onSite' ? 'selected' : '' }}
                                                    value="onSite">On-site</option>
                                                <option {{ request()->input('job_type') == 'remote' ? 'selected' : '' }}
                                                    value="remote">Remote</option>
                                                <option {{ request()->input('job_type') == 'hybrid' ? 'selected' : '' }}
                                                    value="hybrid">Hybrid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="group-form">
                                        <label class="title">Job Types</label>
                                        <div class="group-input">
                                            <select class="form-select" name="type">
                                                <option value="">Select Any</option>
                                                <option {{ request()->input('type') == 'contract' ? 'selected' : '' }}
                                                    value="contract">Contract</option>
                                                <option {{ request()->input('type') == 'full-time' ? 'selected' : '' }}
                                                    value="full-time">Full Time</option>
                                                <option {{ request()->input('type') == 'temporary' ? 'selected' : '' }}
                                                    value="temporary">Temporary</option>
                                                <option {{ request()->input('type') == 'part-time' ? 'selected' : '' }}
                                                    value="part-time">Part Time</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="group-form filter-block">
                                        <div class="salary-slider-one">
                                            <div class="group-form">
                                                <label class="Salary">Salary:</label>
                                                <div class="d-flex justify-content-between">
                                                    <div class="group-input search-ip">
                                                        {{--                                                        <button type="button"><i class="icon-dollar"></i></button> --}}
                                                        <input type="number" class="form-control" name="min_salary"
                                                            value="{{ request()->input('min_salary') }}" placeholder="Min">
                                                    </div>
                                                    <div class="group-input search-ip">
                                                        {{--                                                        <button type="button"><i class="icon-dollar"></i></button> --}}
                                                        <input type="number" class="form-control" name="max_salary"
                                                            value="{{ request()->input('max_salary') }}" placeholder="Max">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <button type="submit">Find Jobs</button>
                                        <a href="{{ route('candidate.job.list') }}"><button
                                                type="button">Clear</button></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="cl8 tf-tab">
                            <div class="wd-meta-select-job">

                                <div class="wd-findjob-filer">
                                    <div class="group-select-display">
                                        <div class="inner menu-tab">
                                            <a class="btn-display active">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                                    viewBox="0 0 17 16" fill="none">
                                                    <path
                                                        d="M0.5 12.001L0.5 16.0005C0.880952 16.001 1.09693 16.001 1.83333 16.001L15.1667 16.001C15.9031 16.001 16.5 16.0005 16.5 16.0005L16.5 12.001C16.5 12.001 15.9031 12.001 15.1667 12.001L1.83333 12.001C1.09693 12.001 0.880952 12.001 0.5 12.001Z"
                                                        fill="#A0A0A0"></path>
                                                    <path
                                                        d="M0.5 6.00098L0.5 10.0005C0.880952 10.001 1.09693 10.001 1.83333 10.001L15.1667 10.001C15.9031 10.001 16.5 10.0005 16.5 10.0005L16.5 6.00098C16.5 6.00098 15.9031 6.00098 15.1667 6.00098L1.83333 6.00098C1.09693 6.00098 0.880952 6.00098 0.5 6.00098Z"
                                                        fill="#A0A0A0"></path>
                                                    <path
                                                        d="M0.5 0.000976562L0.5 4.0005C0.880952 4.00098 1.09693 4.00098 1.83333 4.00098L15.1667 4.00098C15.9031 4.00098 16.5 4.0005 16.5 4.0005L16.5 0.000975863C16.5 0.000975863 15.9031 0.000975889 15.1667 0.000975921L1.83333 0.000976504C1.09693 0.000976536 0.880952 0.000976546 0.5 0.000976562Z"
                                                        fill="#A0A0A0"></path>
                                                </svg>
                                            </a>
                                            {{--                                            <a class="btn-display "> --}}
                                            {{--                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" --}}
                                            {{--                                                     viewBox="0 0 17 16" fill="none"> --}}
                                            {{--                                                    <path --}}
                                            {{--                                                        d="M4.5 0H0.500478C0.5 0.380952 0.5 0.596931 0.5 1.33333V14.6667C0.5 15.4031 0.500478 16 0.500478 16H4.5C4.5 16 4.5 15.4031 4.5 14.6667V1.33333C4.5 0.596931 4.5 0.380952 4.5 0Z" --}}
                                            {{--                                                        fill="white"></path> --}}
                                            {{--                                                    <path --}}
                                            {{--                                                        d="M10.5 0H6.50048C6.5 0.380952 6.5 0.596931 6.5 1.33333V14.6667C6.5 15.4031 6.50048 16 6.50048 16H10.5C10.5 16 10.5 15.4031 10.5 14.6667V1.33333C10.5 0.596931 10.5 0.380952 10.5 0Z" --}}
                                            {{--                                                        fill="white"></path> --}}
                                            {{--                                                    <path --}}
                                            {{--                                                        d="M16.5 0H12.5005C12.5 0.380952 12.5 0.596931 12.5 1.33333V14.6667C12.5 15.4031 12.5005 16 12.5005 16H16.5C16.5 16 16.5 15.4031 16.5 14.6667V1.33333C16.5 0.596931 16.5 0.380952 16.5 0Z" --}}
                                            {{--                                                        fill="white"></path> --}}
                                            {{--                                                </svg> --}}
                                            {{--                                            </a> --}}
                                        </div>
                                        <p class="nofi-job"><span>{{ $data['totalJobs'] }} </span> jobs recommended for you
                                        </p>
                                    </div>
                                    {{--  <div class="group-select">
                                        <select>
                                            <option>Sort by (Defaut)</option>
                                            <option>New</option>
                                            <option>Last</option>
                                        </select>
                                    </div>  --}}
                                </div>
                            </div>
                            <div class="content-tab">
                                <div class="inner" style="">
                                    @foreach ($data['jobs'] as $job)
                                        <div class="features-job cl2">
                                            <div class="job-archive-header">
                                                <div class="inner-box">
                                                    {{--                                                    <div class="logo-company"> --}}
                                                    {{--                                                        <img src="{{settings()->group('logo')->get("logo") ? asset(settings()->group('logo')->get("logo")):asset('rapidhire.png')}}" --}}
                                                    {{--                                                             alt="Logo"> --}}
                                                    {{--                                                    </div> --}}
                                                    <div class="box-content">
                                                        <h3>
                                                            <a
                                                                href="{{ route('candidate.job.detail', $job->slug) }}">{{ $job->name }}</a>
                                                            <span class="icon-bolt"></span>
                                                        </h3>
                                                        <ul>
                                                            <li>
                                                                <span class="icon-map-pin"></span>
                                                                {{ $job->city->name }} , {{ $job->state->name }} ,
                                                                {{ $job->country->name }}
                                                            </li>
                                                            <li>
                                                                <span class="icon-calendar"></span>
                                                                {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}
                                                            </li>
                                                        </ul>
                                                        <span class="icon-heart" id="heart_{{ $job->id }}"
                                                            @if (Auth::check()) onclick="favorite({{ $job->id }})"
                                                                @if ($job->is_favorite)
                                                                  style="color: red" @endif
                                                        @else onclick="favoriteButton()" @endif
                                                            >
                                                        </span>
                                                    </div>
                                                    <div class="button-container mt-5">
                                                        <a href="{{ route('candidate.job.detail', $job->slug) }}">
                                                            <button>Apply</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="job-archive-footer">
                                                <div class="job-footer-left">

                                                    <ul class="job-tag">
                                                        <li><a href="#">{{ $job->type }}</a></li>
                                                        <li><a href="#">{{ $job->job_type }}</a></li>
                                                    </ul>
                                                </div>
                                                <div class="job-footer-right">
                                                    <div class="price d-flex gap-1">
                                                        <span
                                                            class="rounded-pill border px-1">{{ $job->currency ?? 'USD' }}
                                                        </span>
                                                        <p class="mt-3"> {{ $job->min_salary }} -
                                                            {{ $job->max_salary }} <span class="year">/
                                                                {{ $job->salary_deliver }}</span></p>
                                                    </div>
                                                    <p class="days">{{ $job->remaining_days }} days left to apply</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <ul class="pagination-job padding">
                                        {{ $data['jobs']->render() }}
                                    </ul>
                                </div>
                                <div class="inner" style="display: none;">
                                    <div class="group-col-3">
                                        @foreach ($data['jobs'] as $job)
                                            <div class="features-job cl3">
                                                <div class="job-archive-header">
                                                    <div class="inner-box">
                                                        <div class="logo-company">
                                                            <img src="{{ $data['logo'] }}" alt="Logo">
                                                        </div>
                                                        <div class="box-content">
                                                            <h3>
                                                                <a
                                                                    href="{{ route('candidate.job.detail', $job->slug) }}">{{ $job->name }}</a>
                                                                <span class="icon-bolt"></span>
                                                            </h3>
                                                            <ul>
                                                                <li>
                                                                    <span class="icon-map-pin"></span>
                                                                    {{ $job->city->name }} , {{ $job->state->name }} ,
                                                                    {{ $job->country->name }}
                                                                </li>
                                                                <li>
                                                                    <span class="icon-calendar"></span>
                                                                    {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}
                                                                </li>
                                                            </ul>
                                                            <span class="icon-heart" id="heart_{{ $job->id }}"
                                                                @if ($job->favorite && Auth::check()) onclick="favorite({{ $job->id }})"
                                                                  style="color: red"
                                                                  @else
                                                                      onclick="favoriteButton()" @endif>

                                                            </span>
                                                            <div class="button-container">
                                                                <a href="{{ route('candidate.job.detail', $job->slug) }}">
                                                                    <button>Apply</button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="job-archive-footer">
                                                    <div class="job-footer-left">
                                                        <ul class="job-tag">
                                                            <li><a href="#">{{ $job->type }}</a></li>
                                                            <li><a href="#">{{ $job->job_type }}</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="job-footer-right">
                                                        <div class="price">
                                                            <span class="icon-dolar1"></span>
                                                            <p class="mt-3">{{ $job->min_salary }} -
                                                                {{ $job->max_salary }} <span class="year">/
                                                                    {{ $job->salary_deliver }}</span></p>
                                                        </div>
                                                        <p class="days">{{ $job->remaining_days }} days left to apply
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                    <ul class="pagination-job padding">
                                        {{ $data['jobs']->render() }}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
