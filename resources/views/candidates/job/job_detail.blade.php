@extends('candidates.layouts.main')
@section('main-section')
    <section class="single-job-thumb">
        <img src="{{ asset('app-assets/candidates/images/used/Hero.png') }}" alt="images" style="width:100%">
    </section>

    <section class="form">
        <div class="tf-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wd-job-author2">
                        <div class="content-left">
                            {{--                            <div class="thumb"> --}}
                            {{--                                <img src="{{settings()->group('logo')->get("logo") ? asset(settings()->group('logo')->get("logo")):asset('rapidhire.png')}}" alt="logo"> --}}
                            {{--                            </div> --}}
                            <div class="content">
                                <h6><a href="#">{{ $data['job']->name }} <span class="icon-bolt"></span></a></h6>
                                <ul class="job-info">
                                    <li><span class="icon-map-pin"></span>
                                        <span>{{ $data['job']->city->name }} , {{ $data['job']->state->name }} ,
                                            {{ $data['job']->country->name }}</span>
                                    </li>
                                    <li><span class="icon-calendar"></span>
                                        <span>{{ \Carbon\Carbon::parse($data['job']->created_at)->diffForHumans() }}</span>
                                    </li>
                                </ul>
                                <ul class="tags">
                                    <li><a href="#">{{ $data['job']->type }}</a></li>
                                    <li><a href="#">{{ $data['job']->job_type }}</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="content-right">
                            <div class="top">
                                <a href="#" class="wishlist">
                                    <i class="icon-heart" id="heart_{{ $data['job']->id }}"
                                        @if (Auth::check()) onclick="favorite({{ $data['job']->id }})"
                                                                @if ($data['job']->is_favorite)
                                                                    style="color: red" @endif
                                    @else onclick="favoriteButton()" @endif
                                        ></i></a>
                                <a href="{{ route('candidate.job.apply', $data['job']->slug) }}" class="btn btn-popup"><i
                                        class="icon-send"></i>Apply Now</a>
                            </div>
                            <div class="bottom">

                                <div class="gr-rating">
                                    <p class="days">{{ $data['remaining_days'] }} days left to apply</p>
                                </div>
                                <div class="price d-flex gap-1">
                                    {{--                                    <span class="icon-dollar"></span> --}}
                                    <span class="rounded-pill border px-1"><strong>{{ settings()->group('configuration')->get('currency') ?? 'USD' }}
                                        </strong></span>
                                    <p class="mt-3">{{ $data['job']->min_salary }} - {{ $data['job']->max_salary }}
                                        <span class="year">/ {{ $data['job']->salary_deliver }}</span>
                                    </p>

                                </div>
                            </div>

                        </div>
                    </div>

                    <article class="job-article tf-tab single-job">
                        {{--                        <ul class="menu-tab"> --}}
                        {{--                            <li class="ct-tab active">About</li> --}}
                        {{--                        </ul> --}}
                        <div class="content-tab">
                            <div class="inner-content">
                                <h5>Full Job Description</h5>
                                {!! $data['job']->job_description !!}
                                <div class="post-navigation d-flex aln-center mt-3">
                                    <div class="wd-social d-flex aln-center">
                                        <span>Social Profiles:</span>
                                        <ul class="list-social d-flex aln-center mt-3">
                                            @foreach ($data['socialMedia'] as $value)
                                                <li><a href="{{ $value->url }}" target="_blank"><i
                                                            class="{{ $value->icon }}"></i></a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="related-job">
                                    <h6>Related Jobs</h6>
                                    @foreach ($data['related_jobs'] as $value)
                                        <div class="features-job mg-bt-2">
                                            <div class="job-archive-header">
                                                <div class="inner-box">
                                                    {{--                                                    <div class="logo-company"> --}}
                                                    {{--                                                        <img src="{{settings()->group('logo')->get("logo") ? asset(settings()->group('logo')->get("logo")):asset('rapidhire.png')}}" --}}
                                                    {{--                                                             alt=" Logo"/> --}}
                                                    {{--                                                    </div> --}}
                                                    <div class="box-content">
                                                        <h3>
                                                            <a
                                                                href="{{ route('candidate.job.detail', $value->slug) }}">{{ $value->name }}</a>
                                                            <span class="icon-bolt"></span>
                                                        </h3>
                                                        <ul>
                                                            <li>
                                                                <span class="icon-map-pin"></span>
                                                                {{ $data['job']->city->name }} ,
                                                                {{ $data['job']->state->name }} ,
                                                                {{ $data['job']->country->name }}
                                                            </li>
                                                            <li>
                                                                <span class="icon-calendar"></span>
                                                                {{ \Carbon\Carbon::parse($value->created_at)->diffForHumans() }}
                                                            </li>
                                                        </ul>
                                                        <span class="icon-heart"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="job-archive-footer">
                                                <div class="job-footer-left">
                                                    <ul class="job-tag">
                                                        <li><a href="#">{{ $value->type }}</a></li>
                                                        <li><a href="#">{{ $value->job_type }}</a></li>
                                                    </ul>
                                                </div>
                                                <div class="job-footer-right">
                                                    <div class="price">
                                                        {{--                                                        <span class="icon-dolar1"></span> --}}
                                                        <span
                                                            class="rounded-pill border px-1">{{ settings()->group('configuration')->get('currency_symbol') ?? '$' }}
                                                        </span>
                                                        <p class="mt-3">{{ $value->min_salary }} -
                                                            {{ $value->max_salary }} <span class="year">/
                                                                {{ $value->salary_deliver }}</span></p>
                                                    </div>
                                                    <p class="days">{{ $value->remaining_days }} days left to apply</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-jobs-section">
        <div class="tf-container">
            <div class="row">
                <div class="col-lg-8">
                </div>
            </div>
        </div>
    </section>
@endsection
<script>
    function favorite(id) {
        var icon = document.getElementById('heart_' + id);
        if (icon.style.color === "red") {
            dislike(id);
        } else {
            like(id);
        }
    }

    function like(id) {
        var icon = document.getElementById('heart_' + id);
        $.ajax({
            type: 'POST',
            url: '{{ route('user-like-job') }}',
            data: {
                _token: "{{ csrf_token() }}",
                job_id: id,
                is_active: 1,
            },
            success: function(response) {
                if (icon) {
                    icon.style.color = "red";
                }
            },
        });
    }

    function dislike(id) {
        var icon = document.getElementById('heart_' + id);
        $.ajax({
            type: 'POST',
            url: '{{ route('user-dislike-job') }}',
            data: {
                _token: "{{ csrf_token() }}",
                job_id: id,
            },
            success: function(response) {
                if (icon) {
                    icon.removeAttribute('style');
                }
            },
        });
    }

    function favoriteButton() {
        alert("Please Login first to Favorite Job");
    }
</script>
