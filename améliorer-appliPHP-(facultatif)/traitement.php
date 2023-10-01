<?php 
    session_start();

    if(isset($_POST['submit'])) {

        $range = array (
            "options" => array (
                "min_range" => 0,
                "max_range" => 1000
            )
        );
        //FILTER_SANITIZE_FULL_SPECIAL_CHARS
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT, $range);

        if($name && $price && $qtt) {
      
            $product = [
                'name' => $name,
                'price' => $price,
                'qtt' => $qtt,
                'total' => $price*$qtt,
            ];

            $_SESSION['products'][] = $product;
        }

        header("Location:index.php");
    }

    // si on a reçu une action
    // if (isset($_POST["action"])) {
    if (isset($_GET["action"])) {

        // en fonction de l'action
        // switch ($_POST["action"]) {
        switch ($_GET["action"]) {

            case 'deleteOne':
                unset($_SESSION['products'][$_GET["id"]]);
                break;

            case 'deleteAll':
                unset($_SESSION['products']);  
                break;

            case 'qttRemoveOne':
                if($_SESSION['products'][$_GET["id"]]["qtt"] > 1) {
                    $_SESSION['products'][$_GET["id"]]["qtt"] -= 1;
                    $_SESSION['products'][$_GET["id"]]["total"] = $_SESSION['products'][$_GET["id"]]["qtt"] * $_SESSION['products'][$_GET["id"]]["price"] ;
                } 

                break;

            case 'qttAddOne':
                $_SESSION['products'][$_GET["id"]]["qtt"] += 1;
                $_SESSION['products'][$_GET["id"]]["total"] = $_SESSION['products'][$_GET["id"]]["qtt"] * $_SESSION['products'][$_GET["id"]]["price"] ;
                break;

            case 'sortTableById':
                ksort($_SESSION['products']); 
                
                break;

            case 'sortTableByName':
                asort($_SESSION['products']); 

                break;

            case 'sortTableByPrice':
                function comparePrices($a, $b)
                {
                  return strnatcmp ($a['price'], $b['price']);
                }
                uasort($_SESSION['products'], 'comparePrices');

                break;

            case 'sortTableByQtt':
                function compareQtt($a, $b)
                {
                  return strnatcmp ($a['qtt'], $b['qtt']);
                }
                uasort($_SESSION['products'], 'compareQtt');
                
                break;

            case 'sortTableByTotal':
                function compareTotals($a, $b)
                {
                  return strnatcmp ($a['total'], $b['total']);
                }
                uasort($_SESSION['products'], 'compareTotals');

                break;

            case 'salesAll':
                // foreach($_SESSION['products'] as $index => $product) {

                //     $product['price'] *= 0.80;
                //     // echo var_dump($product['price']);
                //     // die();
                // }
                $_SESSION['products'][0]['price'] *= 0.80; //fonctionne uniquement sur un prix précis
                break;

            case 'var_dump':
                echo var_dump($_SESSION['products']);
                die();
                break;
                                

            default:
                
                break;
        }
        header("Location:recap.php");

    }
    

?>