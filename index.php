<?php
    session_start();
    require_once 'vendor/autoload.php';
    $loader = new \Twig\Loader\FilesystemLoader('./templates');
	$twig = new \Twig\Environment($loader, []);

    $domainModel = new DomainModel();
    $controller = new Controller($domainModel, $twig);


    if(!isset($_SESSION['shoppingCart'])){
        $_SESSION['shoppingCart'] = [];
    }

    if(isset($_POST['submitSearch'])){
        $domainName = $_POST['name'];
        $output = $controller->createDomainArray($domainName);
        $controller->searchPage($output);
        exit;
    }
    elseif(isset($_POST['add-to-cart'])){

    }

    $page = $_GET['page'] ?? 'search';
	$routes = [
		'search' => [$controller, 'searchPage'],
		'cart' => [$controller, 'cartPage'],
		'checkout' => [$controller, 'checkOutPage'],
	];

	if(isset($routes[$page])){
		[$controllerObj, $method] = $routes[$page];
        $controllerObj->$method();
		exit;
	}

    
?>
