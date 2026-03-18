<?php
    class CartModel{
        public function __construct(){
            if(!isset($_SESSION['shoppingCart'])){
                $_SESSION['shoppingCart'] = [];
            }
        }

        public function addToCart(array $domain){
            $_SESSION['shoppingCart'][] = $domain;
        }

        public function removeFromCart(){

        }
        public function getCartItems(): array{
            return $_SESSION['shoppingCart'];
        }

        public function emptyCart(){
            session_destroy();
        }
    }
?>