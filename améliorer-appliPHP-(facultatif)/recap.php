<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <link rel="stylesheet" href="./css/style.css">

    <title>Récapitulatif des produits</title>
</head>
<body>

    <?php require_once "header.php"; ?>

    <main>
        <div id = "recapContent">
            <?php 
                if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
                    echo "<p>Aucun produit en session...</p>";
                } else {
                    echo "<table>",
                            "<thead>",
                                "<tr>",
                                    "<th><a href='traitement.php?action=sortTableById'># &#8595;</th>",
                                    "<th><a href='traitement.php?action=sortTableByName'>Nom &#8595<a></th>",
                                    "<th><a href='traitement.php?action=sortTableByPrice'>Prix &#8595</th>",
                                    "<th><a href='traitement.php?action=sortTableByQtt'>Quantité &#8595</th>",
                                    "<th><a href='traitement.php?action=sortTableByTotal'>Total</th>",
                                    "<th><a href='traitement.php?action=var_dump'>var_dump</th>",
                                "<tr>",
                            "<thead>",
                            "<tbody>";
                    $totalGeneral = 0;
                    foreach($_SESSION['products'] as $index => $product) {
                            echo "<tr>",
                                    "<td>".$index."</td>",
                                    "<td>".$product['name']."</td>",
                                    "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;&euro;</td>",
                                    "<td class='qttColumn'>",
                                        "<a href='traitement.php?action=qttRemoveOne&id=$index'><i class='fa-solid fa-minus'>-</i></a>",
                                            $product['qtt'],
                                        "<a href='traitement.php?action=qttAddOne&id=$index'><i class='fa-solid fa-plus'>+</i></a>",
                                    "</td>",
                                    "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;&euro;</td>",
                                    "<td class='deleteBtn'>",
                                        "<a href='traitement.php?action=deleteOne&id=$index'><i class='fa-solid fa-xmark'>x</i></a>",
                                    "</td>",
                                "</tr>";
                        $totalGeneral += $product['total'];
                    }               
                    echo "<tr class='totalGeneral'>",
                            "<td colspan = 4>Total général : </td>",
                            "<td >".number_format($totalGeneral, 2, ", ", "&nbsp;")."&nbsp;&euro;</td>",
                            "<td class='deleteBtn'><a href='traitement.php?action=deleteAll'><i class='fa-solid fa-xmark'>X</i></a></td>",
                            "<td><a href='traitement.php?action=salesAll'>Réduction !!!</a></td>",
                        "</tr>",
                    "</tbody>",
                    "</table>";
                }
            ?>
        </div>      
    </main>
</body>
</html>



<!-- 

Idées à ajouter : 

> une petite flèche pour trier dans l'odre de l'endroit ou on clique (ex : clique sur nom va trier dans l'odre alphabétique et
cliquer une deuxième fois sur nom tri dans l'ordre inverse, same pour chaque catégorie, plus un btn pour reinitialisé à l'ordre original).

> faire en sorte de pouvoir ajouter un code de réduction (pour cet exercice avoir à cocher une checkbox/radio ou appuyer sur un btn pour activer la réduction sera plus simple), l'appliquer ensuite sur tous les articles du panier.
idéalement afficher le prix initial barré et à droite le prix avec la réduction <-probablement pas possible en php uniquement.


"<input type='submit' name='deleteOne' value='suppr'>",
"<button type='submit' name='action' value='deleteOne'>suppr</button>",
btn ou input à utiliser dans le cas d'un $_POST

> type = type de l'input
> name = le nom de variable à utiliser pour récup le $_POST

-->