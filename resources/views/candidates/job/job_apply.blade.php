@extends('candidates.layouts.main')
@section('main-section')

    <section class="single-job-thumb">
        <img src="{{ asset('app-assets/candidates/images/used/Hero.png') }}" alt="images" width="100%">
    </section>
    <div class="container">
        <section>
            <div class="tf-container " style="margin-top: -2rem;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="wd-job-author2">
                            <div class="content-left">
                                <div class="thumb">
                                    <img src="{{ asset($data['logo']) }}" alt="logo">
                                    {{-- <img src="{{ asset('tenancy/assets/images/devjeco-logo.png') }}" alt="logo"> --}}
                                </div>

                                <div class="content">
                                    <h6>
                                        <a
                                            href="{{ route('candidate.job.detail', $data['job'] ? $data['job']->slug : '') }}">{{ @$data['job']->name }}
                                            <span class="icon-bolt"></span></a>
                                    </h6>
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
                    <form action="{{ route('candidate.job.apply.save') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-12">
                            {{--                                        <a href="https://www.linkedin.com/"> --}}
                            {{--                                            <button id="linkedin-button" class="linkedin-button" type="button"><img --}}
                            {{--                                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAByElEQVR4nO2ZP0/CQBjG22scXI2Tiauy+glc3MC4+iX8DA6G9IiDJsYBBhdNHJwcNRGIHY3xjoBCgkTEAUP8A63yt7ymBVQEIq2mvSb3JM/UN5fnd+97N1wFgYuLi4tpSTJdQTKJI5lqCFNwxDLVRExjkkyW/xRexAQ7FhoPt4hJ0P7OuxwedS2FSMAygDk2DIRHRhdkGrUOgInqdnDUs0wqNgAYCI6//G8AvkgazgsaaA0dlIIG8+G0twCUggbfFb/XvAWgNfQ+ALWuewtA8XoHfJG0CWF0IpZXYS584y0A5JIFDoA7OzFM43yf3b2G7YsSpEpVqDbb8FprmaO4dvoAk5sJtgEW9jLw+NaEUbosvsPMTopdgOxLHX5TLK+CxCrAuPIf5dgE0Ntgzv/S4S2sHucheqcOrdtPPrMJsK4U+2omQgk4yVUG6jJPNTYBpreTA+ssHmQH6sq1FnsA7R/fe57aSo5d63oH7K6FOADmHTDFRwjzQ0z5LYT4NWpRo24Otyx4+mkR07JlAON9noHgYFjE9MwygPFzwe3gqGsJX/ktA3S6QIJuhxcx2bAV/rMTIRIw3uedPRNENcbG9s5zcXFxCU7pA5Jwntel+S2tAAAAAElFTkSuQmCC" --}}
                            {{--                                                    style="width: 20px;">Easy Apply --}}
                            {{--                                            </button> --}}
                            {{--                                        </a> --}}
                            <h6><strong>UPLOAD RESUME</strong></h6>
                            <div class="custom-file-upload" id="drop-area" style="padding: 5%;">
                                <label for="file-upload" class="file-label">Select only pdf file </label>
                                <div class="button-container" style="text-align: center;">
                                    <button id="add-files" class="upload-button" type="button">
                                        <input type="file" required class="form-control" name="resume_path">
                                    </button>
                                    {{--                                        <a href="https://www.linkedin.com/"> --}}
                                    {{--                                            <button id="linkedin-button" class="linkedin-button" type="button"><img --}}
                                    {{--                                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAByElEQVR4nO2ZP0/CQBjG22scXI2Tiauy+glc3MC4+iX8DA6G9IiDJsYBBhdNHJwcNRGIHY3xjoBCgkTEAUP8A63yt7ymBVQEIq2mvSb3JM/UN5fnd+97N1wFgYuLi4tpSTJdQTKJI5lqCFNwxDLVRExjkkyW/xRexAQ7FhoPt4hJ0P7OuxwedS2FSMAygDk2DIRHRhdkGrUOgInqdnDUs0wqNgAYCI6//G8AvkgazgsaaA0dlIIG8+G0twCUggbfFb/XvAWgNfQ+ALWuewtA8XoHfJG0CWF0IpZXYS584y0A5JIFDoA7OzFM43yf3b2G7YsSpEpVqDbb8FprmaO4dvoAk5sJtgEW9jLw+NaEUbosvsPMTopdgOxLHX5TLK+CxCrAuPIf5dgE0Ntgzv/S4S2sHucheqcOrdtPPrMJsK4U+2omQgk4yVUG6jJPNTYBpreTA+ssHmQH6sq1FnsA7R/fe57aSo5d63oH7K6FOADmHTDFRwjzQ0z5LYT4NWpRo24Otyx4+mkR07JlAON9noHgYFjE9MwygPFzwe3gqGsJX/ktA3S6QIJuhxcx2bAV/rMTIRIw3uedPRNENcbG9s5zcXFxCU7pA5Jwntel+S2tAAAAAElFTkSuQmCC" --}}
                                    {{--                                                    style="width: 20px;">Easy Apply --}}
                                    {{--                                            </button> --}}
                                    {{--                                        </a> --}}

                                    <p id="selectedFileName" style="margin-top: 2rem;">No file chosen </p>
                                </div>
                            </div>
                            <span id="file-name-display"></span> <!-- Display uploaded file name here -->
                            <input type="hidden" name="job_id" value="{{ @$data['job']->id }}">
                            <h6><strong>UPLOAD COVER LETTER</strong></h6>
                            <div class="custom-file-upload" id="drop-area" style="padding: 5%;">
                                <label for="file-upload" class="file-label">Select only pdf
                                    file</label>
                                <div class="button-container" style="text-align: center;">
                                    <button id="add-letter" class="upload-button" type="button">
                                        <input type="file" required class="form-control" name="cover_letter_path">
                                    </button>
                                </div>
                                <p id="selectedFileName2" style="margin-top: 2rem;">No file chosen
                                </p>
                            </div>
                            <div class="col-lg-12">
                                <label for="first_name" class="file-label">First Name *</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="first_name"
                                        value="{{ old('first_name',$data['user']->first_name) }}" required placeholder="First Name">
                                </div>
                                <div class="form-group">
                                    <label for="last_name" class="file-label">Last Name *</label>
                                    <input type="text" class="form-control" value="{{ old('last_name',$data['user']->last_name) }}"
                                        id="last_name" aria-describedby="name" name="last_name" required placeholder="Last Name">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="file-label">Email *</label>
                                    <input type="email" class="form-control" id="email"
                                        value="{{ old('email',$data['user']->email) }}" name="email" required aria-describedby="email" placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="file-label">Phone *</label>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                        value="{{ old('phone',$data['user']->phone )}}" required aria-describedby="phone" placeholder="Phone">
                                </div>

                                <div class="form-group">
                                    <label for="address" class="file-label">Address *</label>
                                    <input type="text" class="form-control" value="{{ old('address',$data['user']->address) }}"
                                        id="address" aria-describedby="address" name="address" required placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <label for="country-id" class="file-label">Country *</label>
                                    <select id="country-id" class="form-control" required name="country_id">
                                        <option > Select Country</option>
                                        @foreach ($data['countries'] as $key => $country)
                                            <option {{ $key == $data['user']->country_id ? 'selected' : '' }}
                                                class="form-control" value="{{ $key }}">
                                                {{ $country }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="state-id" class="file-label">State *</label>
                                    <select id="state-id" class="form-control" required name="state_id">
                                        @if ($data['user']->state_id)
                                            @foreach ($data['states'] as $state)
                                                <option {{ $key == $data['user']->state_id ? 'selected' : '' }}
                                                    class="form-control" value="{{ $state->id }}">
                                                    {{ $state->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="city-id" class="file-label">City *</label>
                                    <select id="city-id" class="form-control" required name="city_id">
                                        @if ($data['user']->city_id)
                                            @foreach ($data['cities'] as $key => $city)
                                                <option {{ $key == $data['user']->city_id ? 'selected' : '' }}
                                                    class="form-control" value="{{ $city->id }}">
                                                    {{ $city->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="gender" class="file-label">Gender *</label>
                                    <select id="gender" class="form-control" required name="gender">
                                        <option {{ 'male' == $data['user']->gender ? 'selected' : '' }} class="form-control" value="male"> Male </option>
                                        <option {{ 'female' == $data['user']->gender ? 'selected' : '' }} class="form-control" value="female"> Female </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="skills" class="file-label">Skills </label>
                                    <input type="text" class="form-control" id="skills" name="skills"
                                        aria-describedby="skills" value="{{ old('skills', $data['user']->skills) }}"
                                        placeholder="Skills *">
                                </div>

                                @if ($data['job']->jobQuestion)
                                    <h6><strong>Job Requirements *</strong></h6>
                                    @foreach ($data['job']->jobQuestion as $key => $question)
                                        @if ($question->questionBank)
                                            <div class="row">
                                                <div class="form-group col-md-4 mt-2 d-flex justify-content-center">
                                                    <label for="file-upload"
                                                        class="file-label">{{ $question->questionBank->question }}</label>
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <input type="hidden" class="form-control"
                                                        name="question[{{ $key }}][id]"
                                                        value="{{ $question->questionBank->id }}">
                                                    <input type="text" required class="form-control"
                                                        name="question[{{ $key }}][answer]" value="">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                @if ($data['job']->jobQualification)
                                    <h6><strong>Job Qualifications * </strong></h6>
                                    @foreach ($data['job']->jobQualification as $key => $qualification)
                                        @if ($qualification->requirement)
                                            <div class="row">
                                                <div class="form-group col-md-4 mt-2 d-flex justify-content-center">
                                                    <label for="file-upload"
                                                        class="file-label">{{ $qualification->requirement->name }}</label>
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <input type="hidden" class="form-control"
                                                        name="requirement[{{ $key }}][id]"
                                                        value="{{ $qualification->requirement->id }}">
                                                    <input type="text" required class="form-control"
                                                        name="requirement[{{ $key }}][answer]" value="">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                <div class="row repeater">
                                    <h6><strong>Experience </strong></h6>
                                    <div data-repeater-list="experience">
                                        @if (count($data['user']->experience) > 0)
                                            @foreach ($data['user']->experience as $key => $experience)
                                                <div data-repeater-item>
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            <label for="title_{{ $key }}"
                                                                class="file-label">Organization Name
                                                            </label>
                                                            {!! Form::text('experience[' . $key . '][organization_name]', $experience->organization_name, [
                                                                'class' => 'form-control',
                                                                'id' => 'title_' . $key,
                                                                'placeholder' => 'Organization Name  ',
                                                            ]) !!}
                                                        </div>

                                                        <div class="form-group col-md-3">
                                                            <label for="position_title_{{ $key }}"
                                                                class="file-label">Position Title </label>
                                                            {!! Form::text('experience[' . $key . '][position_title]', $experience->position_title, [
                                                                'class' => 'form-control',
                                                                'placeholder' => 'Position Title ',
                                                                'id' => 'position_title_' . $key,
                                                            ]) !!}
                                                        </div>

                                                        <div class="form-group col-md-2">
                                                            <label for="start_{{ $key }}"
                                                                class="file-label">Start
                                                                Date</label>
                                                            {!! Form::date('experience[' . $key . '][start_date]', $experience->start_date, [
                                                                'class' => 'form-control',
                                                                'id' => 'start_' . $key,
                                                                'placeholder' => 'Start Date ',
                                                            ]) !!}
                                                        </div>

                                                        <div class="form-group col-md-2">
                                                            <label for="end_{{ $key }}" class="file-label">End
                                                                Date</label>
                                                            {!! Form::date(
                                                                'experience[' . $key . '][end_date]',
                                                                $experience->is_present == 0 ? $experience->end_date : null,
                                                                [
                                                                    'class' => "form-control end_date " . ($experience->is_present ? 'd-none' : ''),
                                                                    'id' => 'end_' . $key,
                                                                    'placeholder' => 'End Date ',
                                                                ],
                                                            ) !!}
                                                        </div>
                                                        <div class="form-check  col-md-1" style="margin-top: 2rem;">
                                                            {!! Form::hidden('experience[' . $key . '][is_present]', 0) !!}
                                                            {!! Form::checkbox('experience[' . $key . '][is_present]', 1, $experience->is_present, [
                                                                'class' => 'form-check-input is_present_job',
                                                                'id' => 'is_present_' . $key,
                                                                "onclick" => "isPresent(".$key.")"
                                                            ]) !!}
                                                            <label class="form-check-label"
                                                                for="is_present_{{ $key }}">
                                                                Present Job
                                                            </label>
                                                        </div>

                                                        <div class="form-check  col-md-1" style="margin-top: 2rem;">
                                                            <button data-repeater-delete type="button"
                                                                class="btn btn-danger"><i
                                                                    class="fas fa-minus"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div data-repeater-item>
                                                <div class="row">
                                                    <div class="form-group col-md-3">
                                                        <label for="title" class="file-label">Organization
                                                            Name
                                                        </label>
                                                        {!! Form::text('organization_name', null, [
                                                            'class' => 'form-control',
                                                            'id' => 'title',
                                                            'placeholder' => 'Organization Name  ',
                                                        ]) !!}
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label for="position_title" class="file-label">Position Title
                                                        </label>
                                                        {!! Form::text('position_title', null, [
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Position Title ',
                                                            'id' => 'position_title',
                                                        ]) !!}
                                                    </div>

                                                    <div class="form-group col-md-2">
                                                        <label for="start" class="file-label">Start
                                                            Date</label>
                                                        {!! Form::date('start_date', null, [
                                                            'class' => 'form-control',
                                                            'id' => 'start',
                                                            'placeholder' => 'Start Date ',
                                                        ]) !!}
                                                    </div>

                                                    <div class="form-group col-md-2">
                                                        <label for="end" class="file-label">End
                                                            Date</label>
                                                        {!! Form::date('end_date', null, [
                                                            'class' => 'form-control end_date',
                                                            'placeholder' => 'End Date ',
                                                        ]) !!}
                                                    </div>

                                                    <div class="form-check  col-md-1" style="margin-top: 2rem;">
                                                        {!! Form::hidden('is_present', 0) !!}
                                                        {!! Form::checkbox('is_present', 1, isset($experience) ? $experience->is_present : false, [
                                                            'class' => 'form-check-input is_present_job'
                                                        ]) !!}
                                                        <label class="form-check-label">
                                                            Present Job
                                                        </label>
                                                    </div>

                                                    <div class="form-check  col-md-1" style="margin-top: 2rem;">
                                                        <button data-repeater-delete type="button"
                                                            class="btn btn-danger"><i class="fas fa-minus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-11"></div>
                                    <div class="col-sm-1">
                                        <button data-repeater-create type="button" class="btn btn-primary"
                                            style="margin-left: 8px;"><i class="fas fa-plus"></i></button>
                                    </div>
                                    {{-- <div class="form-group col-md-3">
                                    <label for="title" class="file-label">Organization Name </label>
                                    <input type="text" name="data[0][organization_name]" class="form-control"
                                        id="title" placeholder="Organization Name  ">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="position_title" class="file-label">Position Title </label>
                                    <input type="text" class="form-control" id="position_title"
                                        name="data[0][position_title]" aria-describedby="title"
                                        placeholder="Position Title * ">
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="start" class="file-label">Start Date</label>
                                    <input type="date" class="form-control" name="data[0][start_date]" id="start"
                                        aria-describedby="start" placeholder="Start Date ">
                                </div>

                                <div class="form-group col-md-2" id="end_0">
                                    <label for="end" class="file-label">End Date</label>
                                    <input type="date" class="form-control" id="end" name="data[0][end_date]"
                                        aria-describedby="end" placeholder="End ">
                                </div>

                                <div class="form-check  col-md-1" style="margin-top: 2rem;">
                                    <input class="form-check-input" type="checkbox" name="data[0][is_present]"
                                        value="{{ true }}" id="is_present_0">
                                    <label class="form-check-label" for="gridCheck1">
                                        Present Job
                                    </label>
                                </div>
                                <div class="form-check  col-md-1" style="margin-top: 2rem;">
                                    <button type="button" name="add" id="dynamic-ar" class="btn btn-primary"><i
                                            class="fas fa-plus"></i></button>
                                </div> --}}
                                </div>
                                <div id="dynamicAddRemove">
                                </div>
                                <div class="form-group">
                                    <label for="source_detail" class="file-label">Source Detail </label>
                                    <input type="text" class="form-control" name="source_detail"
                                        value="{{ old('source_detail') }}" id="source_detail" aria-describedby="source"
                                        placeholder="Source Detail ">
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="cancel-button mr-2">Cancel</button>
                                    <button class="save-button" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalCenter">Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
{{--                    <div class="container">--}}
{{--                        <div class="modal fade" id="exampleModalCenter">--}}
{{--                            <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--                                <div class="modal-content">--}}
{{--                                    <div class="modal-body">--}}
{{--                                        <div class="thank-you-pop">--}}
{{--                                            <img src="{{ asset('app-assets/candidates/images/used/verified.gif') }}"--}}
{{--                                                alt="">--}}
{{--                                            <h4>Your job application has been successfully submitted</h4>--}}
{{--                                            <p class="lead">Our team will review your application, and if your--}}
{{--                                                qualifications match our requirements, we will be in touch for the--}}
{{--                                                next--}}
{{--                                                steps in the hiring process.</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="modal-footer">--}}
{{--                                        <button type="button" class="btn" data-bs-dismiss="modal"--}}
{{--                                            style="background-color: #0c3438;color:white ;">Close--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </section>
    </div>

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script src="{{ asset('app-assets/candidates/javascript/jquery-repeater.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        var input = document.getElementById('skills');
        new Tagify(input)
        var i = 0;

        function isPresent(key) {
            if($(`#is_present_${key}`).is(':checked')){
                $(`#end_${key}`).addClass("d-none");
                $(`#end_${key}`).val("");
            } else {
    $(`#end_${key}`).removeClass("d-none");
}
         }

        function toggleEndDateVisibility(checkbox) {
            var index = checkbox.attr('id').split('_')[2];
            var endDateField = $('#end_' + index);
            if (checkbox.is(':checked')) {
                endDateField.hide();
            } else {
                endDateField.show();
            }
        }

        $(document).on('click', '.is_present_job', function () {
            if($(this).is(':checked')){
                $(this).parent().prev().find(".end_date").addClass("d-none")
                $(this).parent().prev().find(".end_date").val("")
            } else {
                $(this).parent().prev().find(".end_date").removeClass("d-none")
}
         })
        toggleEndDateVisibility($('#is_present_0'));
        $('#is_present_0').change(function() {
            toggleEndDateVisibility($(this));
        });
        $("#dynamic-ar").click(function() {
            ++i;
            $("#dynamicAddRemove").append(
                `<div class="row del-class">
                    <div class="form-group col-md-3">
                        <input type="text" name="data[${i}][organization_name]" class="form-control" id="title"
                               aria-describedby="title"
                               placeholder="Organization Name  ">
                    </div>
                    <div class="form-group col-md-3">

                        <input type="text" class="form-control" id="title" name="data[${i}][position_title]" aria-describedby="title"
                               placeholder="Position Title * ">
                    </div>

                    <div class="form-group col-md-2">

                        <input type="date" class="form-control" name="data[${i}][start_date]" id="start"
                               aria-describedby="start"
                               placeholder="Start Date ">
                    </div>

                    <div class="form-group col-md-2" id="end_${i}">

                        <input type="date" class="form-control" id="end" name="data[${i}][end_date]"
                               aria-describedby="end"
                               placeholder="End ">
                    </div>

                    <div class="form-check  col-md-1">
                        <input class="form-check-input" type="checkbox" name="data[${i}][is_present]" value="1" id="is_present_${i}">
                        <label class="form-check-label" for="gridCheck1">
                            Present Job
                        </label>
                    </div>
                    <div class="form-check  col-md-1">
                        <button type="button" class="btn btn-outline-danger remove-input-field"><i class="fas fa-trash"></i></button>
                    </div>
                </div>`
            );
        });
        $(document).on('change', '[id^=is_present_]', function() {
            toggleEndDateVisibility($(this));
        });
        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('.del-class').remove();
        });
    </script>
@endpush
