<?php
    session_start();
    require_once 'vendor/autoload.php';
    $loader = new \Twig\Loader\FilesystemLoader('./templates');
	$twig = new \Twig\Environment($loader, []);

    $domainModel = new DomainModel();
    $cartModel = new CartModel();
    $controller = new Controller($domainModel, $cartModel, $twig);

    if(isset($_POST['submitSearch'])){
        $searchTerm = $_POST['name'];
        $output = $controller->createDomainArray($searchTerm);
        $controller->searchPage($searchTerm, $output);
        exit;
    }
    elseif(isset($_POST['add-to-cart'])){
        $searchTerm = $_POST['search-term'];
        $domain = [];
        $name = $_POST['domain-name'];
        $status = $_POST['domain-status'];
        $price = $_POST['domain-price'];
        $currencyType = $_POST['domain-currency-type'];

        $domain['name'] = $name;
        $domain['status'] = $status;
        $domain['price'] = $price;
        $domain['currencyType'] = $currencyType;

        $cartModel->addToCart($domain);
        $controller->searchPage($searchTerm);
        exit;
    }
    elseif(isset($_POST['empty-cart'])){
        $cartModel->emptyCart();
        header('Location: ./cart');
        exit;
    }
    elseif(isset($_POST['delete-item'])){
        $domainName = $_POST['cart-item'];
        $cartModel->removeFromCart($domainName);
        header('Location: ./cart');
        exit;
    }

    $page = $_GET['page'] ?? 'search';
	$routes = [
		'search' => [$controller, 'searchPage'],
		'cart' => [$controller, 'cartPage'],
		'checkout' => [$controller, 'checkOutPage'],
        'orders' => [$controller, 'ordersPage']
	];

	if(isset($routes[$page])){
		[$controllerObj, $method] = $routes[$page];
        $controllerObj->$method();
		exit;
	}

    
?>
