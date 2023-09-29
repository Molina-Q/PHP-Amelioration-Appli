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

    else if (isset($_POST['deleteOne'])) {

    }

    else if (isset($_POST['deleteAll'])) {

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
                if($_SESSION['products'][$_GET["id"]]["qtt"] == 1) {
                    
                } else {
                    $_SESSION['products'][$_GET["id"]]["qtt"] -= 1;
                    $_SESSION['products'][$_GET["id"]]["total"] = $_SESSION['products'][$_GET["id"]]["qtt"] * $_SESSION['products'][$_GET["id"]]["price"] ;
                }

                break;

            case 'qttAddOne':
                $_SESSION['products'][$_GET["id"]]["qtt"] += 1;
                $_SESSION['products'][$_GET["id"]]["total"] = $_SESSION['products'][$_GET["id"]]["qtt"] * $_SESSION['products'][$_GET["id"]]["price"] ;
                break;
            
            default:
                
                break;
        }
        header("Location:recap.php");

    }
    

?>