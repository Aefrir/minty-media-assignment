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

        public function removeFromCart(string $domainName){
            $cartItems = $_SESSION['shoppingCart'];
            foreach($cartItems as $index => $cartItem){
                if($cartItem['name'] == $domainName){
                    unset($cartItems[$index]);
                    $_SESSION['shoppingCart'] = $cartItems;
                    break;
                }
            }
        }
        public function getCartItems(): array{
            return $_SESSION['shoppingCart'];
        }

        public function emptyCart(){
            session_destroy();
        }
    }
?>