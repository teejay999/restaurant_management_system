<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/images/gourmet_logo.jpg') }}">
        <title>Customer Login Portal</title>
        <style>
            .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fccb90;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #454545, #454545, #454545, #454545);

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, #454545, #454545, #454545, #454545);
            }

            @media (min-width: 768px) {
                .gradient-form {
                height: 100vh !important;
                }
            }
            @media (min-width: 769px) {
                .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
                }
            }
        </style>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body style="background-color: #eee;">
        <section class="h-100 gradient-form">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                  <div class="card rounded-3 text-black">
                    <div class="row g-0">
                      <div class="col-lg-6">
                        <div class="card-body p-md-5 mx-md-4">
          
                        <div class="text-center">
                        <img src="{{ asset('storage/images/gourmet_logo.jpg') }}"
                            style="width: 185px;" alt="logo">
                        </div>
        
                        <form class="needs-validation" method="post" action="{{ route('customer.sign_up') }}" novalidate>
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label" for="validationCustom01">Name</label>
                                <input type="text"  name="name" id="validationCustom01" class="form-control" placeholder="Enter Your Name" value="{{ isset($customer['name']) ? $customer['name'] : '' }}"required/>
                                <div class="invalid-feedback">
                                    Please Provide Name.
                                </div>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="validationEmail">Email</label>
                                <input type="email"  name="email" id="validationEmail" class="form-control" placeholder="Enter Your Email" value="{{ isset($customer['email']) ? $customer['email'] : '' }}"required/>
                                <div class="invalid-feedback">
                                    Please Provide Correct Email.
                                </div>
                            </div>
            
                            <div class="form-outline mb-4">
                                <label class="form-label" for="validationPassword">Password</label>
                                <input type="password" name="password" id="validationPassword" class="form-control" placeholder="Enter Your Password" required/>
                                <div class="invalid-feedback">
                                    Please Provide Correct Password.
                                </div>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="validationPassword">Confirm Password</label>
                                <input type="password" name="confirm_password" id="validationPassword" class="form-control" placeholder="Re-enter Your Password" required/>
                            </div>
                            <div>
                                @if(!(empty($message)))
                                    <p class="text-danger">{{ $message }}</p>
                                @endif
                            </div>
                            <div class="text-center pt-1 mb-5 pb-1">
                                <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Sign Up</button>
                            </div>
                        </form>
          
                        </div>
                      </div>
                      <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                        <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                            <img src="{{ asset('storage/images/gourmet_logo.jpg') }}" class="w-100"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </section>
    </body>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })
        })()
    </script>
</html>
