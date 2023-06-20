<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/images/gourmet_logo.jpg') }}">
    <title>My Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
</head>
<style>
    body {overflow-x: hidden; margin:0;}
    .active{
        background-color: rgb(247, 163, 8);
        border-color: rgb(247, 163, 8);
    }
    .dropdown:hover>.dropdown-menu {
        display: block;
    }

    .dropdown>.dropdown-toggle:active {
        pointer-events: none;
    }
    .notification {
    background-color: #514b4b;
    color: rgb(247, 163, 8);
    text-decoration: none;
    padding: 15px 26px;
    position: relative;
    display: inline-block;
    width:150px;
    height: 48px;
    border-right: solid rgb(247, 163, 8);
    }
    body::-webkit-scrollbar {
        width:10px;
        
    }
    body::-webkit-scrollbar-thumb {
        width:10px;
        background: #938b8b;
    }
    body::-webkit-scrollbar-track{
        background: #514b4b;
    }

    ::-webkit-scrollbar {
        height:5px;
    }

    ::-webkit-scrollbar-track {
        background: #fffafa; 
    }
    
    ::-webkit-scrollbar-thumb {
        background: #938b8b;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .notification .badge {
        position: absolute;
        top: -10px;
        right: 10px;
        padding: 5px 10px;
        border-radius: 50%;
        background-color: red;
        color: white;
    }
    .option{
        color: white;
    }
    .option:hover{
        background-color: rgb(241, 231, 155);
        color: black; 
    }
    .button-link:hover{
        color: white;
    }
</style>
<body style="overflow-x: hidden;">
    <nav class="navbar navbar-expand-sm navbar-light" id="neubar" style="overflow:hidden; position:fixed; top:0; width:100%; z-index:1; background-color:#514b4b; height:80px; width:100%">
        <div>
            <img src="{{ asset('storage/images/gourmet_logo.jpg') }}" height="80px"/>
        </div>
        <div style="position:relative; top:55px;right:100px;">
            <div class="mt-3"style="position: relative; left: 850px; top:37px;">
                <a href="{{ route('customer.home') }}" class="notification text-center button-link" style="text-decoration:white;background-color: #514b4b;">
                    <span >Home</span>
                </a>
            </div>
            <div class="mt-3"style="position: relative; left: 1000px; bottom:27px;">
                <a href="{{ route('customer.display_order', ['user_id'=> !empty(session('customer_id'))? session('customer_id') : -1, 'order_status'=>"pending"])}}" class="notification text-center button-link" style="text-decoration:white;background-color: #514b4b; color:white;">
                    <span >My Orders</span>
                </a>
            </div>
            <div class="mt-3"style="position: relative; bottom: 64px; left: 1150px;bottom:91px;">
                <a  id = "cart" href="{{ route('customer.to_cart') }}" class="notification button-link" style="text-decoration:white;">
                    <span style="position:relative; left:30px">🛒 Cart</span>
                    <span class="badge"></span>
                </a>
            </div>
            @if(empty(session('logged_in_customer')))
            <div class="mt-3"style="position: relative; bottom: 128px; left: 1300px;bottom:155px;">
                <a href="{{ route('customer.to_login') }}" class="notification text-center button-link" style="text-decoration:white;background-color:#514b4b; border-right: none;">
                    <span >Login</span>
                </a>
            </div>
            @else
                <div class="mt-3"style="position: relative; bottom: 143px; left: 1300px;bottom:155px;">
                    <a href="{{ route('customer.log_out') }}" class="notification text-center button-link" style="text-decoration:white;background-color: #514b4b; border-right: none;">
                        <span >Sign Out</span>
                    </a>
                </div>
            @endif
        </div>
    </nav>
    <div class="text-center mt-5" style="position:absolute; top:80px; left:700px; color:rgb(247, 163, 8)">
        <h3>
            My Orders
        </h3>
    </div>
    <br>
    @if (empty(session('logged_in_customer')))
        <div class="text-center" style="position:relative; top:200px;">
            <img src="{{ asset('storage/images/image_background.png') }}" alt="" width="80%" />
        </div>
        <div class="text-center">
            <h3 class="text-light" style="position:relative; top:30px;"><b>Pleas log in to the system to view your orders.</b></h3>
        </div>
        <div class="text-center" style="position:relative; top:30px;">
            <form method="post" action="{{ route('customer.to_login') }}">
                @csrf
                <button class="btn btn-info"style=" color: white;">Click Here to Log in</button>
            </form>
        </div>
    @else
        <div class="dropdown" style="position: relative; top:170px; left:690px; ">
            <button class="btn dropdown-toggle text-light" type="button" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false" style="background-color: {{ $color }};">
            {{ $selected_order_status }} orders
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @foreach ($order_status_array as $order_status )
                <li><a class="dropdown-item" href="{{ route('customer.display_order', ['user_id'=> session('customer_id') , 'order_status'=> $order_status]) }}">{{ $order_status }} orders</a></li>
            @endforeach
            
            </ul>
        </div>
        <br><br>
        <div class="text-center" style="position:relative; top:180px;">
            <table class="table">
                <thead style="background-color: #514b4b">
                <tr class="text-light">
                    <th scope="col">Order-ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Total Price (Rs)</th>
                    <th scope="col">Address</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($order_list as $order)
                        <tr>
                            <th scope="row">{{ number_format($order->id) }}</th>
                            <td>{{ date("d M, Y",strtotime($order->date)) }}</td>
                            <td>{{ number_format($order->total_price) }}</td>
                            <td style="text-align: left;">{{ $order->address }}</td>
                            <td style="color: {{ $color  }};"><b>{{ $order->status }}</b></td>
                            <td>
                                <div>
                                    @csrf
                                    <form method="get" action="{{ route('customer.display_order_detail',$order->id) }}">
                                        <button type="submit" class="btn btn-success btn-sm">View Order Detail</button>
                                    </form>
                                </div>
                            </td>
                        </tr>   
                    @endforeach
                </tbody>
            </table>
            <div class="row text-center" style="position:absolute; left 300px;">
                {{ $order_list->links() }} 
            </div> 
        </div>
    @endif
</body>
<script>
    function displayCartQuantity(){
        $('#badge').remove();
        if(localStorage.getItem('cart_quantity') != null)
            $('#cart').append('<span id = "badge" class="badge">'+ localStorage.getItem('cart_quantity') + '</span>');
    }
    displayCartQuantity();
</script>
</html>