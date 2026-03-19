<?php
    class Controller{
        private DomainModel $domainModel;
        private CartModel $cartModel;
        private OrderModel $orderModel;
        private $twig;

        public function __construct(DomainModel $domainModel, CartModel $cartModel, OrderModel $orderModel, $twig){
            $this->domainModel = $domainModel;
            $this->cartModel = $cartModel;
            $this->orderModel = $orderModel;
            $this->twig = $twig;
        }

        public function createDomainArray(string $name): array{
            $tlds = ['com', 'nl', 'org', 'net', 'int', 'edu', 'gov', 'mil', 'arpa', 'cn'];
            $domains = [];
            foreach($tlds as $tld){
                $domains[] = [
                    'name' => $name, 
                    'extension' => $tld
                ];
            }
            $output = $this->domainModel->searchDomains($domains);
            return $output;
        }

        public function searchPage(string $domainName = '', array $results = []){
            echo $this->twig->render('search.html.twig', [
                'results' => $results,
                'name' => $domainName
            ]);
        }
        public function cartPage(){
            $cartItems = $this->cartModel->getCartItems();
            $subtotal = array_sum(array_column($cartItems, 'price'));
            echo $this->twig->render('cart.html.twig', [
                'items' => $cartItems,
                'subtotal' => $subtotal
            ]);
        }
        public function checkOutPage(){
            $cartItems = $this->cartModel->getCartItems();
            $subtotal = array_sum(array_column($cartItems, 'price'));
            $total = $subtotal * 1.21;
            $VAT = $total - $subtotal;
            echo $this->twig->render('checkout.html.twig', [
                'items' => $cartItems,
                'subtotal' => $subtotal,
                'vat' => $VAT,
                'total' => $total
            ]);
        }
        public function ordersPage(){
            $orders = $this->orderModel->fetchOrders();
            $items = $this->orderModel->fetchItems();
            echo $this->twig->render('orders.html.twig', [
                'orders' => $orders,
                'items' => $items
            ]);
        }
    }
?>