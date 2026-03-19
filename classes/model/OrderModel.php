<?php
    class OrderModel{
        private $dbh;

        public function __construct(){
            $server = 'localhost';
            $user = 'root';
            $pass = '';
            $db = 'minty-media-assignment';

            $this->dbh = new mysqli($server, $user, $pass, $db);
            if ($this->dbh->connect_error){
                die('Connection failed: '.$this->dbh->connect_error);
            }
        }

        public function createOrder(array $cartItems, float $subtotal, float $vat, float $total){
            $orderQuery = "INSERT INTO `orders`(`subtotal`, `vat`, `total`) VALUES ('$subtotal','$vat','$total')";
            $this->dbh->query($orderQuery);
            $order_id = $this->dbh->insert_id;

            foreach($cartItems as $item){
                $name = $item['name'];
                $price = $item['price'];
                $orderItemQuery = "INSERT INTO `order_items`(`order_id`, `domain`, `price`) VALUES ('$order_id','$name','$price')";
                $this->dbh->query($orderItemQuery);
            }
            $this->dbh->close();
        }

        public function fetchOrders(){
            $fetchOrders = "SELECT * FROM `orders`";
            $orders = $this->dbh->query($fetchOrders);

            if (!$orders){
                die('Query failed: '.$this->dbh->error);
            }
            
            return $orders;
            $this->dbh->close();
        }

         public function fetchItems(){
            $fetchItems = "SELECT * FROM `order_items`";
            $items = $this->dbh->query($fetchItems);

            if (!$items){
                die('Query failed: '.$this->dbh->error);
            }
            
            return $items;
            $this->dbh->close();
        }
    }
?>