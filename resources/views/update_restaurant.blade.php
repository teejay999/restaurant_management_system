<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css ">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Restaurant</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {overflow-x: hidden;}
        .dataTables_wrapper .dataTables_filter {
            position: relative;
            left: 350px;
        }
    </style>

</head>

<body id="page-top">
    <div>
        <div class="row">
            <div id="wrapper" class="col-2">

                <!-- Sidebar -->
                <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
        
                    <!-- Sidebar - Brand -->
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                        <div class="sidebar-brand-text mx-3">Admin Portal</div>
                    </a>
        
                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">
        
                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('admin.user_list') }}">
                        <span>Users</span></a>
                    </li>
                    <div class="bg-light">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('admin.restaurant_list') }}">
                            <span class="text-dark">Restaurants</span></a>
                        </li>
                    </div>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('admin.restaurant_outlet_list') }}">
                        <span>Restaurant Outlets</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('admin.menu_list') }}">
                        <span>Menu</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('admin.order', ['order_status'=> 'pending']) }}">
                        <span>Orders</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('admin.log_out') }}">
                        <span>Log Out</span></a>
                    </li>
                </ul>
            </div>
            <div class="container justify-content-center mx-auto">
                <form class="needs-validation" method="post" action="{{ route('admin.update_restaurant', $restaurant->id) }}" novalidate enctype="multipart/form-data">
                 @csrf
                 <div class="mt-5 w-25">
                     <label for="validationCustom01">Name</label>
                     <input type="text" class="form-control" name="name" id="validationCustom01" placeholder=" Enter Restaurant Name" value="{{ isset($restaurant->name) ? $restaurant->name : '' }}" required>
                     <div class="invalid-feedback">
                         Please Provide Restaurant's Name. 
                     </div>
                 </div>
                 <div class="mt-3 w-50">
                     <label for="validationCustom02">Address</label>
                     <input type="text" class="form-control" name="address" id="validationCustom02" placeholder=" Enter Address" value="{{ isset($restaurant->address) ? $restaurant->address : '' }}" required>
                     <div class="invalid-feedback">
                         Please Provide Restaurant's Address. 
                     </div>
                 </div>
                 <div class="mt-3 w-25">
                     <label for="validationCustom04" class="form-label">Restaurant Owner</label>
                     <select name="restaurant_owner" class="form-select" id="validationCustom04" required>
                        <option selected disabled value="">Select Restaurant Owner</option>
                         @foreach ($restaurant_owner_list as $restaurant_owner)
                         <option name="{{ $restaurant_owner->name }}"  value="{{ $restaurant_owner->id }}" {{ ($restaurant_owner->id == $restaurant->user_id) ? 'selected': '' }}>{{$restaurant_owner->name}}</option>
                         @endforeach
                       </select>
                       <div class="invalid-feedback">
                         Please Select a Valid Restaurant Owner
                       </div>
                 </div>
                 <div class="mt-3 w-25">
                     <label for="validationCustom03">Contact Number</label>
                     <input type="tel" class="form-control" name="contact_number" id="validationCustom03" placeholder=" Enter Phone" value="{{ isset($restaurant->contact_number) ? $restaurant->contact_number : '' }}" required>
                     <div class="invalid-feedback">
                         Please Provide Restaurant's Name. 
                     </div>
                 </div>
                 <div class="mt-3 w-25">
                     <label>Logo</label>
                     <input type="file" class="form-control novalidate" name="logo" placeholder="Select Logo" accept="image/png, image/gif, image/jpeg">
                     <div class="text-success">
                         Your Logo has already been selected. If you want to select another logo, You can upload it.
                     </div>
                 </div>
                 <div class="mt-4 w-50">
                     <button class="btn btn-success" type="submit">Update Restaurant Detail</button>
                 </div>
             </form>									
            </div>
        </div>
    </div>
            

    <!-- Page Wrapper -->
    
    
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> 
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.material.min.js"></script>
    <script type="text/javascript" src=" https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
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

</body>

</html>