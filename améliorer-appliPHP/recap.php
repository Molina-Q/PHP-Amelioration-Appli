<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">

    <title>Récapitulatif des produits</title>
</head>
<body>
    <header>
        <nav>
            <p><a href="index.php">Ajouter un produit</a></p>
            <p><a href="recap.php">Vos produits</a></p>
        </nav>
    </header>
    <main>
        <div id = "recapContent">
            <?php 
            if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
                echo "<p>Aucun produit en session...</p>";
            } else {
                echo "<table>",
                        "<thead>",
                            "<tr>",
                                "<th>#</th>",
                                "<th>Nom</th>",
                                "<th>Prix</th>",
                                "<th>Quantité</th>",
                                "<th>Total</th>",
                            "<tr>",
                        "<thead>",
                        "<tbody>";
                $totalGeneral = 0;
                foreach($_SESSION['products'] as $index => $product) {
                    echo "<tr>",
                            "<td>".$index."</td>",
                            "<td>".$product['name']."</td>",
                            "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;&euro;</td>",
                            "<td>".$product['qtt']."</td>",
                            "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;&euro;</td>",
                            "<td class='deleteBtn'><button>".$product['suppr']."</button></td>",
                        "</tr>";
                    $totalGeneral += $product['total'];
                }
                echo "<tr>",
                        "<td colspan = 4>Total général : </td>",
                        "<td class='totalGeneral'>".number_format($totalGeneral, 2, ", ", "&nbsp;")."&nbsp;&euro;</td>",
                    "</tr>",
                "</tbody>",
                "</table>";
            }
            ?>
        </div>

        <div class="productsCount">
            <?php                 
                if(!isset($_SESSION['products']) || empty($_SESSION['products'])) { 
                    echo "<p>Nombres de produits : 0 </p>";
                    } else {
                        echo "<p>Nombres de produits : ".count($_SESSION['products'])."</p>";
                    }
                ?>
        </div>
    </main>
</body>
</html>

<!-- page 17 -->