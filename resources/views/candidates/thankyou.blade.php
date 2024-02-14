@extends('candidates.layouts.main')
@section('main-section')

    <div class="d-flex align-items-center justify-content-center text-center my-5 container">
        <div class="text-center">
            <img src="{{ asset('images/thank-you.png') }}" class="img-fluid" alt="Thank You Image" style="max-width: 20%;">

            <div class="main-content mt-4">
                <i class=" bi-check2-all" style="color:#ee8d75 ;font-size: 70px;"></i>
                <span class="fw-bold">Dear {{ auth()->user()->first_name.' '.auth()->user()->last_name }}</span>
                <p class="main-content__body" data-lead-id="main-content-body">
                    Thank you for applying for the position. Our recruiters will get back to you shortly with all the necessary next steps. Feel free to contact us in the meantime if you have any questions.
                </p>
                <a href="{{ route('candidate.home') }}">
                    <button>Go to Website</button>
                </a>
            </div>
        </div>
    </div>
@endsection
