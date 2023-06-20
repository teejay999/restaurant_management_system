<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">   
    <title>Gourmet Foods</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/images/gourmet_logo.jpg') }}">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

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
            cursor:pointer;
            color: black; 
        }
        .button-link:hover{
            color: white;
        }
    </style>

</head>


<body id="page-top">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="width:100%; height:80%; border-radius:5px; position:absolute; top: 80px;">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" width="300px" height="400px" src="{{ asset('storage/images/poster-1.jpg') }}" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" width="300px" height="400px" src="{{ asset('storage/images/gourmet_poster.jpg') }}" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" width="300px" height="400px" src="{{ asset('storage/images/gourmet_poster_2.jpg') }}" alt="Third slide">
          </div>
        </div>
        <div style="position:relative; bottom:200px;">
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" style="position:absolute; left:-50px;">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" style="position:absolute; right:-50px;">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
        </div>
    </div>
    <nav class="navbar navbar-expand-sm navbar-light" id="neubar" style="overflow:hidden; position:fixed; top:0; width:100%; z-index:1; background-color:#514b4b; height:80px; width:100%">
        <div>
            <img src="{{ asset('storage/images/gourmet_logo.jpg') }}" height="80px"/>
        </div>
        <div style="position:relative; top:55px;right:100px;">
            <div class="mt-3"style="position: relative; left: 850px; top:37px;">
                <a href="{{ route('customer.home') }}" class="notification text-center button-link" style="text-decoration:white;background-color: #514b4b; color:white;">
                    <span >Home</span>
                </a>
            </div>
            <div class="mt-3"style="position: relative; left: 1000px; bottom:27px;">
                <a href="{{ route('customer.display_order', ['user_id'=> !empty(session('customer_id'))? session('customer_id') : -1, 'order_status'=>"pending"])}}" class="notification text-center button-link" style="text-decoration:white;background-color: #514b4b">
                    <span >My Orders</span>
                </a>
            </div>
            <div class="mt-3"style="position: relative; bottom: 64px; left: 1150px;bottom:91px;">
                <a id="cart" href="{{ route('customer.to_cart') }}" class="notification button-link" style="text-decoration:white">
                    <span style="position:relative; left:10px">🛒 Cart</span>
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
    <h3 class="text-center"style="position:relative; top:550px; left:40px; color: rgb(247, 163, 8);">Menu Category</h3>
    <div  class="menu-category"style="display:-webkit-inline-box; overflow:auto; width: 100%; position: relative; top:600px;">
        @foreach ($menu_list as $menu)
            <div class="nav-link" id ="{{ $menu->id }}" onclick="displayMenuItems(this.id)" >
                <div class="col-sm-6" style="border-radius:5px;">
                    <div class="card option" style="width:150px; height:150px;">
                        <div class="card-body">
                            <div class="text-center"><img  class="text-center" src="{{ asset('storage/images/'. $menu->image) }}" width="50px" height="50px"></div><br>
                            <div class="text-center"><h5 class="card-title text-dark">{{ $menu->name }}</h5></div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div  id = "menu-item-list" class="menu-category" style="position: relative; left:110px; top:600px;">
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
</body>
<script>
    class CartItem{
        constructor(name,quantity,price,description,image){
            this.name = name;
            this.quantity = quantity;
            this.price = price;
            this.description = description;
            this.image = image;
        }
        getSubtotal(){
            return this.quantity * this.price;
        }
        incrementQuantity(){
            this.quantity++;
        }
        decrementQuantity(){
            this.quantity--;
        }
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function displayMenuItems(menu_id){
        $.ajax({
            type:"GET",
            url: "/customer/display_menu_items",
            data:{
                'menu_id' : menu_id,
            },
            success: function(response){
                document.getElementById(menu_id).children[0].children[0].className = "card active";
                if(localStorage.getItem('menu_id') != null && menu_id != localStorage.getItem('menu_id'))
                    document.getElementById(localStorage.getItem('menu_id')).children[0].children[0].className = "card option";
                localStorage.setItem('menu_id', menu_id);
                $('#menu-item-list').html('')
                let button = null;
                $.each(response.menu_item_list,function(index, menu_item){
                    if(localStorage.getItem(menu_item.id) == null){
                        button = '<div class="text-center mt-3" style: "position: relative; " >\
                                    <button  id= "' + menu_item.id + '"class="btn btn-success" onclick="addToCart(this.id)">🛒 Add to Cart</button>\
                                </div>'
                    }
                    else{
                        cart_item = JSON.parse(localStorage.getItem(menu_item.id));
                        button = '<div class="mt-3" style= "position: relative; right: -17px;" >\
                                    <button class="btn btn-primary btn-sm" id = "'+ menu_item.id +'" onclick= "decrementQuantity(this.id)" style="width: 25px; position:relative; left: 20px; height: 25px;border-radius: 30px;font-size: 10px;text-align: center;"><b>-</b></button>\
                                    <span style="position:relative; bottom: 0px; left: 62px;">'+ cart_item.quantity + '</span>\
                                    <button id = "'+ menu_item.id +'" class="btn btn-primary btn-sm" onclick= "incrementQuantity(this.id)" style="position:relative; bottom: 1px; left:100px; width: 25px; height: 25px;border-radius: 30px;font-size: 10px;text-align: center;"><b>+</b></button>\
                                </div>'  
                    }
                    $('#badge').remove();
                    if(localStorage.getItem('cart_quantity') != null){
                        
                        $('#cart').append('<span id = "badge" class="badge">'+ localStorage.getItem('cart_quantity') + '</span>');
                    }
                    $('#menu-item-list').append(
                        '<div class="col-4 mt-5" style="display: inline-block; width:100%;">\
                            <div class="col-sm-6" style="border-radius:5px;">\
                                <div class="card" style="width:120%; height:440px;">\
                                    <div class="card-body text-dark"> \
                                        <div class="text-center"><img src = "../../storage/images/' + menu_item.image + '" class="text-center" width="150px" height="150px"></div><br>\
                                        <div class="text-center"><h5 class="card-title text-dark">' + menu_item.name +'</h5></div><br>\
                                        <div class="text-center"><h4 class="mb-1 me-1 text-center">Rs ' + parseInt(menu_item.price).toLocaleString() +'</h4></div>\
                                        <div class="text-center"><h5 class="card-title text-dark"><small><b><p>'+ menu_item.description +'</p></b></small></div>' + 
                                        button +
                                    '</div>\
                                </div>\
                            </div>\
                        </div>'
                    )
                }) 
            }
        })
    }
    function addToCart(menu_item_id){
        $.ajax({
            type:"POST",
            url: "/customer/add_to_cart",
            data:{
                'menu_item_id' : menu_item_id,
            },
            success: function(response){
                localStorage.setItem(menu_item_id, JSON.stringify(new CartItem(response.menu_item.name, 1 , response.menu_item.price,response.menu_item.description,response.menu_item.image)));
                cart_quantity = localStorage.getItem("cart_quantity");
                if(cart_quantity == null)
                    localStorage.setItem("cart_quantity", 1);
                else
                    localStorage.setItem("cart_quantity", ++cart_quantity);
                displayMenuItems(localStorage.getItem('menu_id'));

            }
        })
    }
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
        displayMenuItems(localStorage.getItem('menu_id'));
    }
    function incrementQuantity(menu_item_id){
        cart_item = JSON.parse(localStorage.getItem(menu_item_id));
        cart_item.quantity++;
        localStorage.setItem(menu_item_id, JSON.stringify(cart_item));
        cart_quantity = localStorage.getItem("cart_quantity");
        cart_quantity++;
        localStorage.setItem("cart_quantity", cart_quantity);
        displayMenuItems(localStorage.getItem('menu_id'));
    }
    menu_id = localStorage.getItem('menu_id') == null ? 1 : localStorage.getItem('menu_id');
    displayMenuItems(menu_id);
</script>
</html>