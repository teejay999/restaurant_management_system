<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/images/gourmet_logo.jpg') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cart Check Out</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
</head>
<style>
    body{
        color: black;
    }
</style>
<body style="overflow-x: hidden;">
    <nav class="navbar navbar-expand-sm navbar-light" id="neubar" style="overflow:hidden; position:fixed; top:0; width:100%; z-index:1; background-color:#514b4b; height:80px; width:100%">
        <div>
            <img src="{{ asset('storage/images/gourmet_logo.jpg') }}" height="80px"/>
        </div>
    </nav>
    <div class="text-center mt-5" >
        <h3>
            Check Out
        </h3>
    </div>
    <div class="text-center mt-5">
        <div id="cart-total">

        </div>
        <div style="position:relative;left:400px;">
            <form action="{{ route('customer.to_cart') }}" method="get">
                @csrf
                <button type="submit" class="btn btn-light btn-lg me-2 mr-5 btn-sm" style="position:relative; right:430px;top: 248px;">Return Back</button>
            </form>
            <form id="place-order" class="needs-validation" method="post" action="{{ route('customer.place_order') }}" novalidate>
                @csrf
                <div  class="mt-5 w-50">
                    <label for="validationCustom01">Address</label>
                    <input type="text" class="form-control" name="address" id="validationCustom01" placeholder=" Enter Adress" value="{{ isset($address) ? $address : '' }}" required>
                    <div id="error" class="invalid-feedback">
                        Please Provide Address  
                    </div>
                    <input type="hidden" name="cart_data" id="cart_data">
                    <input type="hidden" name="total_price" id="total_price">
                </div>
                <button type="submit" class="btn btn-primary btn-lg mr-5 btn-sm mt-5" onclick="clearStorage()" style="position:absolute; right:1000px; top:200px;">Place Order</button>
            </div>
            <div style="height:50px;"></div>
        </form>

    </div> 
      
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
          'use strict';
          window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
              form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                  event.preventDefault();
                  event.stopPropagation();
                }
                form.classList.add('was-validated');
              }, false);
            });
          }, false);
        })();
    </script> 
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function clearStorage(){
            localStorage.clear();
        }
        function displayTotal(){
            let array = [];
            for(var i = 0; localStorage.key(i) != null; i++){
                if(!isNaN(localStorage.key(i))){
                    array.push(JSON.parse(localStorage.getItem(localStorage.key(i))));
                }
            }
            console.log(array);
            let total = localStorage.getItem('total');
            let cart_data = JSON.stringify(array);
            $('#cart-total').append('<h3>Total Price: Rs '+parseInt(total).toLocaleString()+'</h3>')
            document.getElementById('cart_data').value = cart_data;
            document.getElementById('total_price').value = total;
        }
        displayTotal();
    </script>
</body>



</html>