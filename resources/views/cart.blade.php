<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/images/gourmet_logo.jpg') }}">
    <title>My Cart</title>
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
    body {overflow-x: hidden; margin:0;}
    .active{
        background-color: rgb(247, 163, 8);
        border-color: rgb(247, 163, 8);
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
                <a href="{{ route('customer.display_order', ['user_id'=> !empty(session('customer_id'))? session('customer_id') : -1, 'order_status'=>"pending"])}}" class="notification text-center button-link" style="text-decoration:white;background-color: #514b4b;">
                    <span >My Orders</span>
                </a>
            </div>
            <div class="mt-3"style="position: relative; bottom: 64px; left: 1150px;bottom:91px;">
                <a id="cart" href="{{ route('customer.to_cart') }}" class="notification button-link" style="text-decoration:white; color:white;">
                    <span style="position:relative; left:30px">🛒 Cart</span>
                    <span id = "badge" class="badge"></span>
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
    <div id="cart-heading" class="text-center mt-5" style="position:absolute; top:80px; left:575px; color:rgb(247, 163, 8)">
        
    </div>

    <div id="cart-list" style="position:relative;left:150px;top:200px; color: black;">
        
    </div>
    <div id="total" class="text-center text-dark" style="position:relative; top:200px;">

    </div>
    <div id="cart-buttons" class="text-center" style="width:100%; position:relative; top:230px;">
        @if(empty(session('logged_in_customer')))
            <form action="{{ route('customer.to_login') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-info btn-sm" style="position:relative; right: 20px;">Login to Place Order</button>
            </form>
        @else
            <form action="{{ route('customer.to_check_out') }}" method="post" class="text-center">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm" style="position:relative; right: 20px;">Check Out of Cart</button>
            </form>
        @endif
        <form action="{{ route('customer.home') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-light btn-sm mt-3" style="position:relative; right:20px;">Continue Shopping</button>
        </form>
        <div style="height:50px;"></div>
    </div> 
      
    
</body>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function decrementQuantity(menu_item_id){
        cart_item = JSON.parse(localStorage.getItem(menu_item_id));
        cart_item.quantity--;
        if(cart_item.quantity == 0){
            localStorage.removeItem(menu_item_id);
        }
        else{
            localStorage.setItem(menu_item_id, JSON.stringify(cart_item));
        }
        cart_quantity = localStorage.getItem("cart_quantity");
        cart_quantity--;
        if(cart_quantity == 0)
            localStorage.removeItem("cart_quantity");
        else
            localStorage.setItem("cart_quantity", cart_quantity);
        displayCartItems();
    }
    function incrementQuantity(menu_item_id){
        cart_item = JSON.parse(localStorage.getItem(menu_item_id));
        cart_item.quantity++;
        localStorage.setItem(menu_item_id, JSON.stringify(cart_item));
        cart_quantity = localStorage.getItem("cart_quantity");
        cart_quantity++;
        localStorage.setItem("cart_quantity", cart_quantity);
        displayCartItems();
    }
    function removeCartItem(menu_item_id){
        let cart_item = JSON.parse(localStorage.getItem(menu_item_id));
        localStorage.setItem('cart_quantity', localStorage.getItem('cart_quantity') - cart_item.quantity);
        if(localStorage.getItem('cart_quantity') == 0)
            localStorage.removeItem('cart_quantity');
        localStorage.removeItem(menu_item_id);
        displayCartItems();
    }
    function displayCartItems(){
        $.ajax({
            type:"GET",
            url: "/customer/display_cart",
            data:{
            },
            success: function(response){
                document.getElementById('cart-list').innerHTML = " ";
                document.getElementById('total').innerHTML = " ";
                document.getElementById('cart-heading').innerHTML = " ";
                if(localStorage.getItem('cart_quantity') != null){
                    let total = 0;
                    let temp = localStorage.getItem('cart_quantity') == 1 ? ' item' : ' items';
                    $('#badge').remove();
                    $('#cart-heading').append('<h3>My Cart ('+localStorage.getItem('cart_quantity')+ temp + ' available)</h3>');
                    $('#cart').append('<span id = "badge" class="badge">'+ localStorage.getItem('cart_quantity') + '</span>');
                    $.each(response.menu_item_list, function(index,menu_item){
                        if(localStorage.getItem(menu_item.id) != null){
                            let cart_item = JSON.parse(localStorage.getItem(menu_item.id));
                            let subtotal = cart_item.quantity * cart_item.price;
                            total += subtotal;
                            $('#cart-list').append(
                                '<div style="width: 80%;">\
                                    <div class="row justify-content-center mb-3">\
                                        <div class="col-md-12 col-xl-10">\
                                            <div class="card shadow-0 border rounded-3">\
                                                <div class="card-body">\
                                                    <div class="row">\
                                                        <div class="col-md-12 col-lg-3 col-xl-3" style="width:80%;">\
                                                            <div class="bg-image hover-zoom ripple rounded ripple-surface">\
                                                            <img src = "../../storage/images/'+cart_item.image+'"style="width: 50%; height: 50%;" />\
                                                            <a href="#!">\
                                                                <div class="hover-overlay">\
                                                                    <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>\
                                                                </div>\
                                                            </a>\
                                                            </div>\
                                                        </div>\
                                                        <div class="col-md-6 col-lg-6 col-xl-6">\
                                                            <h5>'+cart_item.name+'</h5>\
                                                            <p class="mb-4 mb-md-0">'
                                                                +cart_item.description+    
                                                            '</p>\
                                                        </div>\
                                                        <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">\
                                                            <div class="d-flex flex-row align-items-center mb-1">\
                                                                <p class="mb-1 me-1 text-center">Unit Price:Rs '+parseInt(cart_item.price).toLocaleString()+' </p>\
                                                            </div>\
                                                            <div class="d-flex flex-row align-items-center mb-1">\
                                                                <h4 class="mb-1 me-1 text-center">Subtotal: Rs '+parseInt(subtotal).toLocaleString()+'</h4>\
                                                            </div>\
                                                            <div class="d-flex flex-column mt-4">\
                                                                <button class="btn btn-primary btn-sm" id="'+menu_item.id+'"  onclick = "decrementQuantity(this.id)"style="width: 25px; height: 25px;border-radius: 30px;font-size: 10px;text-align: center;"><b>-</b></button>\
                                                                <span style="position:relative; bottom: 24px; left: 66px;">'+cart_item.quantity+'</span>\
                                                                <button class="btn btn-primary btn-sm" id="'+menu_item.id+'" onclick = "incrementQuantity(this.id)" style="position:relative; bottom: 50px; left:120px; width: 25px; height: 25px;border-radius: 30px;font-size: 10px;text-align: center;"><b>+</b></button>\
                                                                <button class="btn btn-primary btn-danger btn-sm" id="'+menu_item.id+'" onclick="removeCartItem(this.id)"style="position:relative; width:70%; bottom: 25px; left:-4px;">x Remove</button>\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>'
                            )   
                        }
                    })
                    $('#total').append(
                    '<h3 style="position:relative; right:20px;"> Total Price: Rs '+total.toLocaleString()+'</h3>'
                    )
                    localStorage.setItem('total', total);
                }
                else{
                    $('#cart-buttons').remove();
                    $('#cart-list').append('<div style="position: relative; right: 150px; bottom:70px;">\
                        <div class="text-center" style="position:relative; top:150px;">\
                            <img src="../../storage/images/image_background.png" alt="" width="80%" />\
                        </div>\
                        <div class="text-center">\
                            <h3 class="text-light" style="position:relative; top:-20px;"><b>Your Cart is Empty.</b></h3>\
                        </div>\
                            <a href="{{ route('customer.home') }}" class="text-center" style="position:relative; left: 635px; top:-20px; text-decoration: black;">\
                                <button class="btn"style="background-color: #d68828; color: black;">Click Here to Continue Shopping</button>\
                            </a>\
                        </div>'
                    )
                }
            }
        })
    }
    displayCartItems();
</script>

</html>