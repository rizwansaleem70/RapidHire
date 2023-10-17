@extends('users.layouts.main')
@section('main-section')

  <section class="single-job-thumb">
          <img src="{{asset('app-assets/users/images/used/Hero.png')}}" alt="images"  width="100%">
  </section>

  <section>
    <div class="tf-container " style="margin-top: -2rem;">
      <div class="row">
        <div class="col-lg-12">
          <div class="wd-job-author2">
            <div class="content-left">
              <div class="thumb">
                <img src="{{asset('app-assets/users/images/logo-company/cty4.png')}}" alt="logo">
              </div>
              <div class="content">
                <a href="#" class="category">Rockstar Games New York</a>
                <h6><a href="#">Senior UI/UX Designer <span class="icon-bolt"></span></a></h6>


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
        <div class="col-lg-12">
          <form method="post" action="#" id="upload-form">
            <h6><strong>UPLOAD RESUME</strong></h6>
            <div class="custom-file-upload" id="drop-area" style="padding: 5%;">
                <label for="file-upload" class="file-label">Drag & Drop files here or </label>
                <div class="button-container" style="text-align: center;">
                    <button id="add-files" class="upload-button" type="button">Upload CV/RESUME</button>


                    <a href="https://www.linkedin.com/"><button id="linkedin-button" class="linkedin-button" type="button"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAByElEQVR4nO2ZP0/CQBjG22scXI2Tiauy+glc3MC4+iX8DA6G9IiDJsYBBhdNHJwcNRGIHY3xjoBCgkTEAUP8A63yt7ymBVQEIq2mvSb3JM/UN5fnd+97N1wFgYuLi4tpSTJdQTKJI5lqCFNwxDLVRExjkkyW/xRexAQ7FhoPt4hJ0P7OuxwedS2FSMAygDk2DIRHRhdkGrUOgInqdnDUs0wqNgAYCI6//G8AvkgazgsaaA0dlIIG8+G0twCUggbfFb/XvAWgNfQ+ALWuewtA8XoHfJG0CWF0IpZXYS584y0A5JIFDoA7OzFM43yf3b2G7YsSpEpVqDbb8FprmaO4dvoAk5sJtgEW9jLw+NaEUbosvsPMTopdgOxLHX5TLK+CxCrAuPIf5dgE0Ntgzv/S4S2sHucheqcOrdtPPrMJsK4U+2omQgk4yVUG6jJPNTYBpreTA+ssHmQH6sq1FnsA7R/fe57aSo5d63oH7K6FOADmHTDFRwjzQ0z5LYT4NWpRo24Otyx4+mkR07JlAON9noHgYFjE9MwygPFzwe3gqGsJX/ktA3S6QIJuhxcx2bAV/rMTIRIw3uedPRNENcbG9s5zcXFxCU7pA5Jwntel+S2tAAAAAElFTkSuQmCC" style="width: 20px;">Easy Apply</button></a>

                  <p id="selectedFileName" style="margin-top: 2rem;">No file choosen </p>
                  </div>

            </div>
            <span id="file-name-display"></span> <!-- Display uploaded file name here -->
        </form>


        <form method="post" action="#" id="upload-letter">
          <h6><strong>UPLOAD COVER LETTER</strong></h6>
          <div class="custom-file-upload" id="drop-area" style="padding: 5%;">
              <label for="file-upload" class="file-label">Drag & Drop files here or </label>
              <div class="button-container" style="text-align: center;">
                  <button id="add-letter" class="upload-button" type="button">Upload COVER LETTER</button>
              </div>
              <p id="selectedFileName2" style="margin-top: 2rem;">No file chosen</p>
          </div>
      </form>
        </div>
         <div class="col-lg-12">


              <form>
                <div class="form-group">
                  <input type="text" class="form-control" id="first_name" aria-describedby="name" placeholder="First Name *">

                </div>
                <div class="form-group">

                  <input type="text" class="form-control" id="last_name" aria-describedby="name" placeholder="Last Name *">
                </div>
                <div class="form-group">

                  <input type="email" class="form-control" id="email" aria-describedby="email" placeholder="Email *">
                </div>

                <div class="form-group">

                  <input type="phone" class="form-control" id="phone" aria-describedby="phone" placeholder="Phone *">
                </div>

                <div class="form-group">

                  <input type="text" class="form-control" id="address" aria-describedby="address" placeholder="Address *">
                </div>


                <div class="form-group">

                  <input type="text" class="form-control" id="city" aria-describedby="city" placeholder="City *">
                </div>

                <div class="form-group">

                  <input type="text" class="form-control" id="gender" aria-describedby="gender" placeholder="Gender *">
                </div>

                <div class="form-group">

                  <input type="text" class="form-control" id="skills" aria-describedby="skills" placeholder="Skills *">
                </div>

                <div class="form-group ">
                  <label for="inputState">Source</label>
                  <select id="inputState" placeholder="Select Source*" class="form-control" >
                    <option>Choose...</option>
                    <option>...</option>
                  </select>
                </div>

                <div class="form-group">

                  <input type="text" class="form-control" id="source" aria-describedby="source" placeholder="Source Detail ">
                </div>
              <div class="row">
                <div class="form-group col-md-3">

                  <select id="inputState" class="form-control">
                    <option selected>Employer *</option>
                    <option>...</option>
                  </select>
                </div>

                <div class="form-group col-md-3">

                  <input type="text" class="form-control" id="title" aria-describedby="tiltle" placeholder="Title * ">
                </div>

                <div class="form-group col-md-2">

                  <input type="number" class="form-control" id="start" aria-describedby="start" placeholder="Start ">
                </div>

                <div class="form-group col-md-2">

                  <input type="number" class="form-control" id="end" aria-describedby="end" placeholder="End ">
                </div>

                <div class="form-check  col-md-1" style="margin-top: 1rem;">
                  <input class="form-check-input" type="checkbox" id="gridCheck1">
                  <label class="form-check-label" for="gridCheck1">
                 Present
                  </label>
                </div>
                <div class="form-check  col-md-1" style="margin-top: 1rem;">
                  <label for="gridCheck1">
                    <i class="fas fa-plus"></i>
                </label>
                <input class="form-check-input" type="checkbox" id="gridCheck1" style="display: none;">


                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-3">

                  <select id="inputState" class="form-control">
                    <option selected>Employer *</option>
                    <option>...</option>
                  </select>
                </div>

                <div class="form-group col-md-3">

                  <input type="text" class="form-control" id="title" aria-describedby="tiltle" placeholder="Title * ">
                </div>

                <div class="form-group col-md-2">

                  <input type="number" class="form-control" id="start" aria-describedby="start" placeholder="Start ">
                </div>

                <div class="form-group col-md-2">

                  <input type="number" class="form-control" id="end" aria-describedby="end" placeholder="End ">
                </div>

                <div class="form-check  col-md-1" style="margin-top: 1rem;">
                  <input class="form-check-input" type="checkbox" id="gridCheck1">
                  <label class="form-check-label" for="gridCheck1">
                 Present
                  </label>
                </div>
                <div class="form-check  col-md-1" style="margin-top: 1rem;">
                  <label for="gridCheck1">
                    <i class="fas fa-plus"></i>
                </label>
                <input class="form-check-input" type="checkbox" id="gridCheck1" style="display: none;">


                </div>
              </div>

              </form>
              <div class="button-container">
                <button class="cancel-button">Cancel</button>
                <button class="save-button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Save</button>


                <div class="modal fade" id="exampleModalCenter">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                          <div class="modal-body">
                              <div class="thank-you-pop">
                                  <img src="{{asset('app-assets/users/images/used/verified.gif')}}" alt="">
                                  <h4>Your job application has been successfully submitted</h4>
                                  <p class="lead">Our team will review your application, and if your qualifications match our requirements, we will be in touch for the next steps in the hiring process.</p>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn"  data-bs-dismiss="modal" style="background-color: #0c3438;color:white ;">Close</button>
                          </div>
                      </div>
                  </div>
              </div>



            </div>


        </div>
      </div>
    </div>
  </section>



  </div><!-- /.boxed -->


<script>
  const dropArea = document.getElementById('drop-area');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, unhighlight, false);
});

function highlight(e) {
    dropArea.classList.add('drag-over');
}

function unhighlight(e) {
    dropArea.classList.remove('drag-over');
}

dropArea.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    let dt = e.dataTransfer;
    let files = dt.files;

    // Handle the dropped files here
    handleFiles(files);
}

function handleFiles(files) {
    // Handle the dropped files here
    // You can perform operations on the files such as uploading or displaying file details
    console.log(files);
}

// Button event listeners
const addFilesButton = document.getElementById('add-files');
addFilesButton.addEventListener('click', function () {
    const fileInput = document.getElementById('file-upload');
    fileInput.click();
});

const linkedinButton = document.getElementById('linkedin-button');
linkedinButton.addEventListener('click', function () {
    // Handle LinkedIn authentication and integration logic here
    console.log('Connecting with LinkedIn...');
});



document.getElementById('add-files').addEventListener('click', function() {
    var input = document.createElement('input');
    input.type = 'file';
    input.accept = '.pdf, .doc, .docx'; // Specify allowed file types

    input.addEventListener('change', function(event) {
        var file = event.target.files[0];
        var selectedFileName = document.getElementById('selectedFileName');

        if (file) {
            // Handle the uploaded file here
            console.log('File uploaded:', file);

            // Change the text content of the <p> element
            selectedFileName.textContent = 'File Name: ' + file.name;

            // You can send the file to the server or perform other actions with it
        } else {
            selectedFileName.textContent = 'No file chosen';
            console.log('No file selected');
        }
    });
    input.click();
});


document.getElementById('add-letter').addEventListener('click', function() {
    var input = document.createElement('input');
    input.type = 'file';
    input.accept = '.pdf, .doc, .docx'; // Specify allowed file types

    input.addEventListener('change', function(event) {
        var file = event.target.files[0];
        var selectedFileName = document.getElementById('selectedFileName2');

        if (file) {
            // Handle the uploaded file here
            console.log('File uploaded:', file);

            // Change the text content of the <p> element
            selectedFileName.textContent = 'File Name: ' + file.name;

            // You can send the file to the server or perform other actions with it
        } else {
            selectedFileName.textContent = 'No file chosen';
            console.log('No file selected');
        }
    });
    input.click();
});
</script>

@endsection
