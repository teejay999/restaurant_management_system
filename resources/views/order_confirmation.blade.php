<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/images/gourmet_logo.jpg') }}">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
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

<body>
    <nav class="navbar navbar-expand-sm navbar-light" id="neubar" style="overflow:hidden; position:fixed; top:0; width:100%; z-index:1; background-color:#514b4b; height:80px; width:100%">
        <div style="width:100%;"class="text-center" >
            <img src="{{ asset('storage/images/gourmet_logo.jpg') }}" height="80px"/>
        </div>
    </nav>
    <div class="text-center" style="position:relative; top:250px;">
        <img src="{{ asset('storage/images/image_background.png') }}" alt="" width="80%" />
    </div>
    <div class="text-center">
        <h3 class="text-light" style="position:relative; top:70px;"><b>Your order has been placed. The rider will call you once he leaves from our restaurant.</b></h3>
    </div>
    <div class="text-center" style="position:relative; top:80px;">
        <form method="post" action="{{ route('customer.order') }}">
            @csrf
            <button class="btn"style="background-color: #d68828; color: black;">Click Here to Place Another Order</button>
        </form>
    </div>
</body>

</html>