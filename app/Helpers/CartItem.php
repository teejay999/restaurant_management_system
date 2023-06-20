<?php
namespace App\Helpers;

class CartItem{
    //Attributes
    private $id;
    private $name;
    private $quantity;
    private $image;

    //Constructors
    public function __construct($id,$name,$quantity,$image){
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->image = $image;
    }

    //Getters
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getQuantity(){
        return $this->quantity;
    }
    public function getImage(){
        return $this->image;
    }

    //Others
    public function incrementQuantity(){
        $this->quantity++;
    }
    public function decrementQuantity(){
        $this->quantity--;
    }
    public function calculateTotalPrice($price){
        return $price * $this->quantity;
    }
}


?>