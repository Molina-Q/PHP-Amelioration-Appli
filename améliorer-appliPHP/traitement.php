<?php 
    session_start();

    if(isset($_POST['submit'])){

        $range = array (
            "options" => array (
                "min_range" => 0,
                "max_range" => 1000
            )
        );

        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING );
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT, $range);

        if($name && $price && $qtt) {
            $deleteBtn = "suppr";

            $product = [
                'name' => $name,
                'price' => $price,
                'qtt' => $qtt,
                'total' => $price*$qtt,
                'suppr' => $deleteBtn
            ];

            $_SESSION['products'][] = $product;
        }
    
    }

    

    header("Location:index.php");
?>