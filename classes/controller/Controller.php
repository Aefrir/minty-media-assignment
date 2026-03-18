<?php
    class Controller{
        private DomainModel $domainModel;
        private CartModel $cartModel;
        private $twig;

        public function __construct(DomainModel $domainModel, CartModel $cartModel, $twig){
            $this->domainModel = $domainModel;
            $this->cartModel = $cartModel;
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
            echo $this->twig->render('cart.html.twig', [
                'items' => $cartItems
            ]);
        }
        public function checkOutPage(){
            echo $this->twig->render('checkout.html.twig', []);
        }
    }
?>