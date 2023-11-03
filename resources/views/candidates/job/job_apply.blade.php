@extends('candidates.layouts.main')
@section('main-section')

    <section class="single-job-thumb">
        <img src="{{asset('app-assets/candidates/images/used/Hero.png')}}" alt="images" width="100%">
    </section>
    <div class="container">
        <section>
            <div class="tf-container " style="margin-top: -2rem;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="wd-job-author2">
                            <div class="content-left">
                                <div class="thumb">
                                    <img src="{{asset($data['logo'])}}" alt="logo">
                                </div>

                                <div class="content">
                                    <h6>
                                        <a href="{{route('candidate.job.detail',$data['job']? $data['job']->slug:"")}}">{{@$data['job']->name}}
                                            <span class="icon-bolt"></span></a></h6>
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
                    <form action="{{route('candidate.job.apply.save')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-12">
                                <h6><strong>UPLOAD RESUME</strong></h6>
                                <div class="custom-file-upload" id="drop-area" style="padding: 5%;">
                                    <label for="file-upload" class="file-label">Drag & Drop files here or </label>
                                    <div class="button-container" style="text-align: center;">
                                        <button id="add-files" class="upload-button" type="button">
                                            <input type="file" class="form-control" name="resume_path">
                                        </button>
                                        <a href="https://www.linkedin.com/">
                                            <button id="linkedin-button" class="linkedin-button" type="button"><img
                                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAByElEQVR4nO2ZP0/CQBjG22scXI2Tiauy+glc3MC4+iX8DA6G9IiDJsYBBhdNHJwcNRGIHY3xjoBCgkTEAUP8A63yt7ymBVQEIq2mvSb3JM/UN5fnd+97N1wFgYuLi4tpSTJdQTKJI5lqCFNwxDLVRExjkkyW/xRexAQ7FhoPt4hJ0P7OuxwedS2FSMAygDk2DIRHRhdkGrUOgInqdnDUs0wqNgAYCI6//G8AvkgazgsaaA0dlIIG8+G0twCUggbfFb/XvAWgNfQ+ALWuewtA8XoHfJG0CWF0IpZXYS584y0A5JIFDoA7OzFM43yf3b2G7YsSpEpVqDbb8FprmaO4dvoAk5sJtgEW9jLw+NaEUbosvsPMTopdgOxLHX5TLK+CxCrAuPIf5dgE0Ntgzv/S4S2sHucheqcOrdtPPrMJsK4U+2omQgk4yVUG6jJPNTYBpreTA+ssHmQH6sq1FnsA7R/fe57aSo5d63oH7K6FOADmHTDFRwjzQ0z5LYT4NWpRo24Otyx4+mkR07JlAON9noHgYFjE9MwygPFzwe3gqGsJX/ktA3S6QIJuhxcx2bAV/rMTIRIw3uedPRNENcbG9s5zcXFxCU7pA5Jwntel+S2tAAAAAElFTkSuQmCC"
                                                    style="width: 20px;">Easy Apply
                                            </button>
                                        </a>

                                        <p id="selectedFileName" style="margin-top: 2rem;">No file choosen </p>
                                    </div>

                                </div>
                                <span id="file-name-display"></span> <!-- Display uploaded file name here -->
                                <input type="hidden" name="job_id" value="{{@$data['job']->id}}">

                                <h6><strong>UPLOAD COVER LETTER</strong></h6>
                                <div class="custom-file-upload" id="drop-area" style="padding: 5%;">
                                    <label for="file-upload" class="file-label">Drag & Drop files here or </label>
                                    <div class="button-container" style="text-align: center;">
                                        <button id="add-letter" class="upload-button" type="button">
                                            <input type="file" class="form-control" name="cover_letter_path">
                                        </button>
                                    </div>
                                    <p id="selectedFileName2" style="margin-top: 2rem;">No file chosen</p>
                                </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="first_name" readonly
                                       value="{{$data['user']->first_name}}" aria-describedby="name"
                                       placeholder="First Name *">

                            </div>
                            <div class="form-group">

                                <input type="text" class="form-control" readonly value="{{$data['user']->last_name}}"
                                       id="last_name" aria-describedby="name"
                                       placeholder="Last Name *">
                            </div>
                            <div class="form-group">

                                <input type="email" class="form-control" id="email" readonly
                                       value="{{$data['user']->email}}" aria-describedby="email"
                                       placeholder="Email *">
                            </div>

                            <div class="form-group">

                                <input type="phone" class="form-control" id="phone" readonly
                                       value="{{$data['user']->phone}}" aria-describedby="phone"
                                       placeholder="Phone *">
                            </div>

                            <div class="form-group">

                                <input type="text" class="form-control" readonly value="{{$data['user']->address}}"
                                       id="address" aria-describedby="address"
                                       placeholder="Address *">
                            </div>


                            <div class="form-group">

                                <input type="text" class="form-control" readonly value="{{$data['user']->city}}"
                                       id="city" aria-describedby="city"
                                       placeholder="City *">
                            </div>

                            <div class="form-group">

                                <input type="text" class="form-control" readonly value="{{$data['user']->gender}}"
                                       id="gender" aria-describedby="gender"
                                       placeholder="Gender *">
                            </div>

                            <div class="form-group">

                                <input type="text" class="form-control" id="skills" name="skills"
                                       aria-describedby="skills"
                                       placeholder="Skills *">
                            </div>

                            <div class="form-group">

                                <input type="text" class="form-control" name="source_detail" id="source" aria-describedby="source"
                                       placeholder="Source Detail ">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <input type="text" name="data[0][organization_name]" class="form-control" id="title"
                                           aria-describedby="tiltle"
                                           placeholder="Organization Name  ">
                                </div>
                                <div class="form-group col-md-3">

                                    <input type="text" class="form-control" id="title" name="data[0][position_title]" aria-describedby="title"
                                           placeholder="Position Title * ">
                                </div>

                                <div class="form-group col-md-2">

                                    <input type="date" class="form-control" name="data[0][start_date]" id="start"
                                           aria-describedby="start"
                                           placeholder="Start Date ">
                                </div>

                                <div class="form-group col-md-2">

                                    <input type="date" class="form-control" id="end" name="data[0][end_date]"
                                           aria-describedby="end"
                                           placeholder="End ">
                                </div>

                                <div class="form-check  col-md-1" style="margin-top: 1rem;">
                                    <input class="form-check-input" type="checkbox" name="data[0][is_present]" value="{{true}}" id="gridCheck1">
                                    <label class="form-check-label" for="gridCheck1">
                                        Present
                                    </label>
                                </div>
                                <div class="form-check  col-md-1" style="margin-top: 1rem;">
                                    <button type="button" name="add" id="dynamic-ar" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div id="dynamicAddRemove">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="cancel-button mr-2">Cancel</button>
                                <button class="save-button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Save
                                </button>
                            </div>
                    </div>
                    </form>
                        <div class="container">
                            <div class="modal fade" id="exampleModalCenter">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="thank-you-pop">
                                                <img src="{{asset('app-assets/candidates/images/used/verified.gif')}}"
                                                     alt="">
                                                <h4>Your job application has been successfully submitted</h4>
                                                <p class="lead">Our team will review your application, and if your
                                                    qualifications match our requirements, we will be in touch for the
                                                    next
                                                    steps in the hiring process.</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn" data-bs-dismiss="modal"
                                                    style="background-color: #0c3438;color:white ;">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

@endsection

@push('js')

    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function () {
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

                    <div class="form-group col-md-2">

                        <input type="date" class="form-control" id="end" name="data[${i}][end_date]"
                               aria-describedby="end"
                               placeholder="End ">
                    </div>

                    <div class="form-check  col-md-1" style="margin-top: 1rem;">
                        <input class="form-check-input" type="checkbox" name="data[${i}][is_present]" value="1" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1">
                            Present
                        </label>
                    </div>
                    <div class="form-check  col-md-1" style="margin-top: 1rem;">
                        <button type="button" class="btn btn-outline-danger remove-input-field"><i class="fas fa-trash"></i></button>
                    </div>
                </div>`
            );
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('.del-class').remove();
        });
        var input = document.querySelector('input[name=skills]');

        new Tagify(input)
    </script>

@endpush
