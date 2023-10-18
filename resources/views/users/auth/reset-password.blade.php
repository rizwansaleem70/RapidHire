@include('users.auth.layouts.header')

<style>
  @media screen and (min-width: 1200px) {
    .social-buttons-container {
        align-items: center;
    }
}
  .card{
    background-color: #fbfcfc !important;
    border-radius: 20px;
    border-color: black;
  }
  .social-buttons-container {
    display: flex;
    flex-direction: column;
}

.social-buttons-list {
    list-style-type: none;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
}

.social-buttons-list li {
    margin-right: 10px;
    margin-bottom: 10px;
}
.wd-form-login button {
    background: #6be8a3;
    border-radius: 10px !important;
    text-align: center;
    color: #fff;
    padding: 16px 10px !important;
    width: 100% !important;
    border-color: #6be8a3;
    text-transform: capitalize;
    font-weight: 700;
    font-size: 16px;
}
.wd-form-login button {
  background: black;
}
.wd-form-login button:hover {
  background: black;
}
</style>
<body>
  <a id="scroll-top"></a>

  <!-- preloade -->

  <!-- /preload -->


  <!-- Boxed -->
  <div class="boxed">
  <!-- HEADER -->

  <!-- END HEADER -->




  <section class="account-section" style="background-image: url(./app-assets/users/images/used/Signin.png);
  background-size: cover; /* Adjust the background size property */
  background-repeat: no-repeat; /* Prevent the background image from repeating */
  width: 100%;
  height: 100vh;">
    <div class="tf-container">


        <div class="col-lg-6 wd-form-login ">
          <div class="container card" style="padding: 5%;background-color: fbfcfc;">
          <strong><h6 style=" margin-top: 2%;">Reset Password</h6></strong>
          <p style=" margin-top: 2%;">Enter email for verification code</p>



          <form action="#" style="margin-top: 10%;">
            <div class="ip">
              <strong><label>Email</label></strong>
              <input type="text"  placeholder="Your email " style="border-radius: 20px;">
            </div>


            <a href="{{route('tenant-user-reset-password-message')}}"><button style="margin-top: 5%;">Send</button></a>



            <div class="sign-up">Don't have an account?<a href="{{route('tenant-user-signup')}}">Sign Up</a></div>
          </form>
          </div>
        </div>

    </div>
  </section>


  </div><!-- /.boxed -->

@include('users.auth.layouts.footer')
