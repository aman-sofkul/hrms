<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title></title>
      <link href="{{ asset('css/all.min.css') }}" rel="stylesheet"/>
      <!-- Google Fonts -->
      <link href="{{ asset('css/font.css') }}" rel="stylesheet"/>
      <!-- MDB -->
      <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet" />
      <link href="{{ asset('css/custome.css') }}" rel="stylesheet" />
    
   </head>
   <body>
      <section class="vh-100">
         <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
               <div class="col-md-9 col-lg-6 col-xl-5">
                  <img src="{{ asset('images/login-bg.png')}}"
                     class="img-fluid" alt="Sample image">
               </div>
               <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                  <form method="POST" action="{{ route('login') }}" id="form" autocomplete="off">
                     @csrf
                     <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                        <p class="lead fw-normal mb-0 me-3">Sign in with</p>
                        
                        <!--   <button type="button" class="btn btn-primary btn-floating mx-1">
                           <i class="fab fa-facebook-f"></i>
                           </button>
                           
                           <button type="button" class="btn btn-primary btn-floating mx-1">
                           <i class="fab fa-twitter"></i>
                           </button>
                           
                           <button type="button" class="btn btn-primary btn-floating mx-1">
                           <i class="fab fa-linkedin-in"></i>
                           </button> -->
                     </div>
                     <small id="email-heading">Please enter your username or work email address</small>
                    
                     <div class="divider d-flex align-items-center my-4"></div>
                     <!-- Email input -->
                     <div class="md-4" id="email_field">
                     
                     <div class="form-outline " >
                        <input type="email" id="email"  name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Enter a valid email address" style="margin: 15px 0px;"/>
                        <label class="form-label" for="email" autocomplete="off">Email address</label>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                       <span class="invalid-feedback" id="errorEmail" ></span>
                    </div>
                     <!-- Password input -->
                     <div class="md-4" id="password_field"  style="display:none">
                     <div class="form-outline mb-3" >
                        <input type="password" id="password"  name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Enter password" />
                        <label class="form-label" for="password">Password</label>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      
                     </div>
                     <span class="invalid-feedback" id="errorPassword" ></span>
                  </div> 
                     <div class="d-flex justify-content-between align-items-center">
                        <!-- Checkbox -->
                        <div class="form-check mb-0">
                           <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" name="remember"  {{ old('remember') ? 'checked' : '' }}/>
                           <label class="form-check-label" for="form2Example3">
                           Remember me
                           </label>
                        </div>
                        <!--  @if (Route::has('password.request'))
                           <a class="text-body" href="{{ route('password.request') }}">
                               {{ __('Forgot Your Password?') }}
                           </a>
                           @endif -->
                     </div>
                     <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="button" class="btn btn-primary btn-lg"
                           style="padding-left: 2.5rem; padding-right: 2.5rem;" id="next">Login</button>
                             <button type="submit" class="btn btn-primary btn-lg"
                           style="padding-left: 2.5rem; padding-right: 2.5rem;display: none;" id="submit">Login</button>
                        <!--  <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{route('register')}}"
                           class="link-danger">Register</a></p> -->
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div
            class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">
               Copyright © {{date('Y')}}. All rights reserved.
            </div>
            <!-- Copyright -->
            <!-- Right -->
            <div>
               
            </div>
            <!-- Right -->
         </div>
      </section>
     
      <script type="text/javascript"  src="{{ asset('js/mdb.min.js')}}"></script>
      <script src="{{ asset('js/jquery.min.js')}}"></script>
         <script type="text/javascript">
            $('#next').on("click",function(){
                 
                  var email = $('#email').val();
                  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                  if(email == ''){
                     $('#errorEmail').show();
                    $('#errorEmail').html('<strong>This email field is required.</strong>');
                      
                  } else if (regex.test(email) == false) {
                    $('#errorEmail').html('<strong>Please enter a valid E-mail address.</strong>');
                  }else{
                     $.post(
                     '{{ url('/email-verify') }}', {
                     _token: '{{ csrf_token() }}',
                     email: email,
                     },
                     function(data) {
                       
                        
                        if (data == 'true') {
                              $('#errorEmail').hide();
                           $('#email-heading').hide(); 
                           $('#email_field').hide();
                           $('#next').hide();
                           $('#submit').show();
                           $('#password_field').fadeIn("slow");
                           $("#password").val('');
                        } else if (data == '0') {
                           $('#errorEmail').show();
                           $('#errorEmail').html('Your account is not active.');
                        } else {
                           $('#errorEmail').show();
                           $('#errorEmail').html('<strong>Email does not exist.</strong>');
                        }
                     }
                  );
                
                 }
            });

            $("#submit").on("click", function(e) {
               var password = $("#password").val();
             
               var email = $("#email").val();
               $('#errorPassword').show();
               if (password == '') {

                     $('#errorPassword').html('<strong>This password field is required.</strong>');
               } else if (password.length < 6) {
                     $('#errorPassword').html('<strong>Password should be minimum of 6 characters.</strong>');
               } else {
                  $.post(
                      '{{ url('/email-verify ') }}', {
                          _token: '{{ csrf_token() }}',
                          email: email,
                          password: password,
                      },
                      function(data) {
                          if (data == 'false') {
                           $('#errorPassword').show();
                              $('#errorPassword').html('<strong>Incorrect Password.</strong>');
                          } else {
                           
                           $('form').submit();
                              $('#errorPassword').html('');
                              
                          }

                      }
                  );
        }
    });

    
         </script>
   </body>
</html>