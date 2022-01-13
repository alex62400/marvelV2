<!DOCTYPE html>
<html lang="fr">



<head>
    <?php require_once 'head.php' ?>
    <!-- <link rel="stylesheet" href="/index.css"> -->
    <title>Marvel World</title>
</head>

<body>

    <!-- header -->

    <header>
        <?php require_once 'header.php' ?>

    </header>

    <div >
        <p class="title1">Tous nos films à votre entière disposition</p>
        <div class="entete1"></div>
    </div>

    <p class="title1">Rejoignez-nous et profitez de -10% sur votre première commande</p>

     <?php require_once 'connexionDatabaseCategories.php' ?> 

    <div id="Movie_body">

    </div>
  




    <!-- FOOTER    -->

    <footer>

        <?php require_once 'footer.php' ?>

    </footer>




</body>

</html>