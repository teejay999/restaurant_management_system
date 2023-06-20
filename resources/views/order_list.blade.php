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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <title>Orders</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {overflow-x: hidden;}
        
        .dropdown:hover>.dropdown-menu {
            display: block;
        }

        .dropdown>.dropdown-toggle:active {
            pointer-events: none;
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
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('admin.menu_list') }}">
                        <span>Menu</span></a>
                    </li>
                    <div class="bg-light">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('admin.order', ['order_status'=> 'pending']) }}">
                            <span class="text-dark">Orders</span></a>
                        </li>
                    </div>
                    
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('admin.log_out') }}">
                        <span>Log Out</span></a>
                    </li>
                </ul>
            </div>
            <div class="col">
                <div class="mt-5">
                    <h2 class="mt-5 text-dark">Order List</h2>
                    <div class="dropdown" style="position: relative; top:0px; left:500px; ">
                        <button class="btn dropdown-toggle text-light" type="button" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false" style="background-color: {{ $color }};">
                        {{ $selected_order_status }} orders
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach ($order_status_array as $order_status )
                            <li><a class="dropdown-item" href="{{ route('admin.order', ['order_status'=> $order_status]) }}">{{ $order_status }} orders</a></li>
                        @endforeach
                        
                        </ul>
                    </div>
                    @if($order_list != NULL)
                        <div style="position:relative; top: 120px; right:20px;">
                            <table class="table table-striped text-center" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Restaurant Name</th>
                                        <th>Branch</th>
                                        <th>Total Price (Rs)</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order_list as $order)
                                    <tr>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ date("d M, Y",strtotime($order->date)) }}</td>
                                        <td>{{ $order->restaurant_name}}</td>
                                        <td>{{ $order->restaurant_outlet_name}}</td>
                                        <td>{{ number_format($order->total_price)}}</td>
                                        <td>
                                            @if($selected_order_status != 'pending' && $selected_order_status != 'accepted')
                                                {{ $selected_order_status }}
                                            @else
                                                <div class="dropdown">
                                                    <button class="btn btn-sm dropdown-toggle text-light" type="button" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false" style="background-color: {{ $color }};">
                                                    {{ $selected_order_status }}
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    @foreach ($order_status_array as $order_status )
                                                        @if ($selected_order_status == 'pending' && $order_status != 'delivered')
                                                            <li><a class="dropdown-item" href="{{ route('admin.update_status', ['selected_order_status' => $selected_order_status,'order_status'=> $order_status, 'order_id'=>$order->id, 'color'=> $color]) }}">{{ $order_status }}</a></li>
                                                        @elseif ($selected_order_status == 'accepted' && $order_status == 'delivered')
                                                            <li><a class="dropdown-item" href="{{ route('admin.update_status', ['selected_order_status' => $selected_order_status,'order_status'=> $order_status,'order_id'=>$order->id, 'color'=> $color]) }}">{{ $order_status }}</a></li>
                                                        @endif
                                                    @endforeach
                                                    
                                                    </ul>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div>
                                                @csrf
                                                <form method="get" action="{{ route('admin.order_detail',$order->id) }}">
                                                    <button type="submit" class="btn btn-success btn-sm">View Order Detail</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                <tbody>
                            </table>
                            <div>
                                {{ $order_list->links() }} 
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