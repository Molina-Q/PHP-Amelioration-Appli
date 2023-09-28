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

    <title>Ajout produit</title>
</head>

<body>
    <header>
        <nav>
            <p><a href="index.php">Ajouter un produit</a></p>
            <p><a href="recap.php">Vos produits</a></p>
        </nav>
    </header>
    <main>
        <div id="produitMainContent">
            <h1>Ajouter un produit</h1>

            <form action="traitement.php" method="post"> <!-- action indique la cible du formulaire, le fichier à atteindre lorsque l'utilisateur soumettra le formulaire -->
                <p class = "formProduitNom">
                    <label>
                        Nom du produit 
                        <input type="text" name="name" placeholder="Produit">
                    </label>
                </p>
                <p class = "formProduitPrix">
                    <label>
                        Prix du produit 
                        <input type="number" step="any" name="price" placeholder="5.20">
                    </label>
                </p>
                <p class = "formProduitQtt">
                    <label>
                        Quantité désirée 
                        <input type="number" name="qtt" value="" placeholder="1">
                    </label>
                </p>
                <p class = "formProduitBtn">
                    <input type="submit" name="submit" value="Ajouter le produit">
                </p>
            </form>
        </div>    

        <div class="productsCount">
            <?php 

                if(!isset($_SESSION['products']) || empty($_SESSION['products'])) {    
                    echo "<p>Nombres de produits : 0 </p>";
                } else {
                    echo "<p>Nombres de produits : ".count($_SESSION['products'])."</p>";

                    foreach($_SESSION['products'] as $number => $product) {
                        if($product['price'] > 0.99) {
                            $alerte =  "<p>Le prix est positif !</p>";
                        } else {
                            $alerte = "<p>Le prix est négatif !</p>";
                        }
                    }
                    echo $alerte;
                }
            ?>
        </div>

    </main>    
</body>
</html>
<!--

isset() : permet de vérfier si une variable est déclaré et si elle est null, return un bool, true si tout est déclaré et non null, false si qqch n'est pas déclaré ou null

session_start() : démarre ou récupère une session pour l'utilisateur et par la même occasion le serveur enregistrera un cookie "PHPSESSID" dans le navigateur client

PHPSESSID : cookie qui contient les identifiant de la session de l'utilisateur

Les cookies sont transmis au serveur avec chaque requête HTTP effectuée par le client

> > Superglobale : ce sont des variables arrays, 
elles sont automatiquement crées par le serveur, on les utilise pour accéder aux informations pouvant être transmise par le client au serveur

    $_GET  :Contient les paramètres transmis avec l'url de la requête (Query String Parameters)**

    $_POST : Contient les données transmises au serveur via un formulaire

    $_COOKIE : Contient les données qui sont stockées dans les cookies du navigateur client 

    $_REQUEST : Regroupes les données transmises par $_GET, $_POST et $_COOKIE

    $_SESSION : Contient les données stockées dans la session utilisateur côté serveur(si elle a été démarrée)

    $_FILES : Contient les info associées à des fichiers uploadés par le client 

    Exceptions qui ne sont pas concernées par la transmission d'info du client vers le serveur : 
    $_ENV et $_SERVER : contiennent des infos relative au serveur (os, version d'apache, de php, chemin du dossier, etc...)


URL classique : http://monsite.com/liste.php?page=2

    http:// = protocole employé pour la communication

    monsite.com/ = nom de domaine du serveur sur internet 

    liste.php = la ressource/le fichier demandé

    ?page=2 = paramètre de requête "page" avec pour valeur =  2 (appelé "Query String Parameters")**

    HTTP = HyperText Transfer Protocal

Fichiers présents  : 

    >index.php : présente le formulaire de l'application

    >traitement.php : traitera la requête venant du formulaire de index, dans ce cas, récupérer le prix, le nom du produit, la quantité, 
    multiplier le prix et la quantité et va stocker tout cela dans un array $products.
    Va également filter les informations non voulu ou dangereuse pouvant être transmise avec l'input en utilisant INPUT_ et FILTER_

    >recap.php : affichera l'array $products de traitement pour la session actuelle, et ajoute un total général en additionnant chaque total qu'il reçoit 
    (affiche les resultats des requêtes traités par traitement )

-->