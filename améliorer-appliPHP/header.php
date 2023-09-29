<header>
    <nav>
        <p><a href="index.php">Ajouter un produit</a></p>
        <div>
            <p><a href="recap.php">Vos produits</a></p>

            <?php 
                if(!isset($_SESSION['products']) || empty($_SESSION['products'])) {    

                } else {
                    echo "<div class='countBloc'><p class='countProducts'>".count($_SESSION['products'])."</p></div>"; 
                }
            ?>

        </div>
    </nav>
</header>