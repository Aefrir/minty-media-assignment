<?php
    class Controller{
        private DomainModel $domainModel;
        private $twig;

        public function __construct(DomainModel $domainModel, $twig){
            $this->domainModel = $domainModel;
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

        public function searchPage(array $results = []){
            echo $this->twig->render('search.html.twig', [
                'results' => $results
            ]);
        }
        public function cartPage(){
            echo $this->twig->render('cart.html.twig', []);
        }
        public function checkOutPage(){
            echo $this->twig->render('checkout.html.twig', []);
        }
    }
?>