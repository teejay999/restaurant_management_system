<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css ">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Menu Items</title>

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
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('admin.restaurant_list') }}">
                        <span>Restaurants</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('admin.restaurant_outlet_list') }}">
                        <span>Restaurant Outlets</span></a>
                    </li>
                    <div class="bg-light">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('admin.menu_list') }}">
                            <span class="text-dark">Menu</span></a>
                        </li>
                    </div>
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
            <div class="col">
                <div class="mt-3 w-25 mb-4 input-group" style="position:absolute; left:480px;">
                    <form class="needs-validation" method="post" action="{{ route('admin.display_menu_items') }}" novalidate>
                        @csrf
                        <label for="validationCustom01" class="form-label">Restaurant Outlet</label>
                        <select name="restaurant_outlet" class="form-select" id="validationCustom01" disabled>
                            <option name="{{ $restaurant_outlet->name }}"  value="{{ $restaurant_outlet->id }}" {{ (session('restaurant_outlet_id')) == $restaurant_outlet->id ? 'selected' : '' }}>{{$restaurant_outlet->name}}</option>
                        </select>
                        <div class="mt-2">
                            <label for="validationCustom01" class="form-label">Menu Category</label>
                            <select name="menu_id" class="form-select" id="validationCustom01" required >
                                <option selected disabled value="">Select Menu Category</option>
                                @foreach ($menu_list as $menu)
                                        <option name="{{ $menu->name }}"  value="{{ $menu->id }}" {{ (session('menu_id')) == $menu->id ? 'selected' : '' }}>{{$menu->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button style="position:relative; left:300px; bottom: 38px;"class="btn btn-primary">Search Menu Item</button>
                        <div class="invalid-feedback">
                            Please Select a Menu Category to Proceed.
                        </div>
                    </form>
                </div>
                <div class="mt-5">
                    @if($menu_item_list != NULL)
                    <div style="position:relative; top: 120px;">
                        <form method="post" action="{{ route('admin.add_menu_item_form') }}">
                            @csrf
                            <button class="btn  btn-success mt-5"> + Add Menu Item </button>
                        </form>
                        <h3 class="mt-3 text-dark">Menu Items Available at {{ $restaurant_outlet->name }}</h3>
                        <table class="table table-striped" style="width:95%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price (Rs)</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menu_item_list as $menu_item)
                                <tr>
                                    <td>{{ $menu_item->name }}</td>
                                    <td>{{ $menu_item->price }}</td>
                                    <td>{{ $menu_item->description }}</td>
                                    <td><div><img src="{{ asset('storage/images/'. $menu_item->image) }}" width="60px" height="60px"></div></td>
                                    <td class="text-center col-4 align-item-center">
                                        <div class="d-flex align-items-center d-inline-block  ">
                                            <div style="width:25%;"></div>
                                            @if($menu_item->deleted_at == NULL)
                                                <form method="post" action="{{ route('admin.disable_menu_item_record',$menu_item->id) }}">
                                                    @csrf
                                                    <button class="btn  btn-danger btn-sm"> x Disable </button>
                                                    <input type="hidden" name="page" value="{{ $menu_item_list->currentPage() }}">
                                                </form>
                                            @else
                                                <form method="post" action="{{ route('admin.enable_menu_item_record',$menu_item->id) }}">
                                                    @csrf
                                                    <button class="btn  btn-primary btn-sm"> 🗸 Enable </button>
                                                    <input type="hidden" name="page" value="{{ $menu_item_list->currentPage() }}">
                                                </form>
                                            @endif
                                            <div style="width:10%;"></div>
                                            <form method="post" action="{{ route('admin.to_update_menu_item', $menu_item->id) }}"> 
                                                @csrf
                                                <input type="hidden" name="page" value="{{ $menu_item_list->currentPage() }}">
                                                <button class="btn btn-info btn-sm" {{ ($menu_item->deleted_at != null)?'disabled':'' }}> ✎ Update </button>
                                            </form>
                                            <div style="width:10%;"></div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            <tbody>
                        </table>
                        <div>
                            {{ $menu_item_list->links() }} 
                        </div>
                        @if (!(empty($message)))
                            <div id="error_message">
                                <p class="text-danger">{{ $message }}</p>
                            </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>   
        </div>
    </div>
            

    
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> 
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.material.min.js"></script>
    <script type="text/javascript" src=" https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
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