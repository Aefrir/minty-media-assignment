<?php
    session_start();
    require_once 'vendor/autoload.php';
    $loader = new \Twig\Loader\FilesystemLoader('./templates');
	$twig = new \Twig\Environment($loader, []);

    $domainModel = new DomainModel();
    $controller = new Controller($domainModel, $twig);

    $page = $_GET['page'] ?? 'search';
    switch ($page){
        case 'cart':
            $page = $controller->cartPage();
            break;
        case 'checkout':
            $page = $controller->checkOutPage();
            break;
        default:
            $page = $controller->searchPage();
    }

    if(isset($_POST['submitSearch'])){
        $domainName = $_POST['name'];
        
        $output = $controller->searchAvailableDomains($domainName);
        $controller->searchPage($output);
        echo '<pre>';
        print_r($output);
        echo '</pre>';
    }
?>
