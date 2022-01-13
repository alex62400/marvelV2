<?php

$pdo = require_once './PHP/database.php';

const ERROR_REQUIRED = "Champ obligatoire";
const ERROR_LENGTH = "Le pseudo doit contenir entre 7 et 12 caractère";
const ERROR_EMAIL = "L'email n'est pas valide";


$errors = [
    'pseudo' => '',
    'email' => '',
    'lastName' => '',
    'firstName' => '',
    'password' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_input = filter_input_array(INPUT_POST, [
        'lastName' => FILTER_SANITIZE_SPECIAL_CHARS,
        'firstName' => FILTER_SANITIZE_SPECIAL_CHARS,
        'pseudo' => FILTER_SANITIZE_SPECIAL_CHARS,
        'email' => FILTER_SANITIZE_EMAIL,

    ]);


    $pseudo = $_input['pseudo'] ?? '';
    $email = $_input['email'] ?? '';
    $lastName = $_input['lastName'] ?? '';
    $firstName = $_input['firstName'] ?? '';
    $password = $_POST['password'] ?? '';
    $date = $_POST['date'] ?? '';



    if (!$pseudo) {
        $errors['pseudo'] = ERROR_REQUIRED;
    }

    if (!$email) {
        $errors['email'] = ERROR_REQUIRED;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = ERROR_EMAIL;
    }

    if (!$lastName) {
        $errors['lastName'] = ERROR_REQUIRED;
    }

    if (!$firstName) {
        $errors['firstName'] = ERROR_REQUIRED;
    }

    if (!$password) {
        $errors['password'] = ERROR_REQUIRED;
    }

    // echo "<pre>";
    // var_dump($errors);
    // echo "</pre>";
    // die();

    if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
        // echo 'ok';
        $statement = $pdo->prepare('
        INSERT INTO client VALUES (
            DEFAULT,
            :nom,
            :prenom,
            :datenaissance,
            :pseudo,
            :email,
            :password
        )');

        $statement->bindValue(':nom', $firstName);
        $statement->bindValue(':prenom', $lastName);
        $statement->bindValue(':datenaissance', $date);
        $statement->bindValue(':pseudo', $pseudo);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);

        $statement->execute();

        header('Location: /index.php');
    } else {
        // echo 'ko';
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require_once 'head.php' ?>
    <title>Marvel World</title>
</head>

<body>


    <!-- header -->

    <header>
        <?php require_once 'header.php' ?>

    </header>

    <div>
        <p class="title1">Rejoignez-Nous</p>
        <div class="entete3"></div>
    </div>



    <form action="seconnecter-sinscrire.php" method="POST">



        <div>

            <label for="lastName">Nom</label><br>
            <input type="text" name="lastName" id="lastName">
            <?= $errors['lastName'] ? "<p>" . $errors['lastName'] . "</p>" : '' ?>


        </div>

        <br>

        <div>
            <label for="firstName">Prénom</label><br>
            <input type="text" name="firstName" id="firstName">


        </div>
        <br>

        <div>

            <label for="pseudo">Pseudo</label><br>
            <input type="text" name="pseudo" id="pseudo">
            <?= $errors['pseudo'] ? "<p>" . $errors['pseudo'] . "</p>" : '' ?>

        </div>
        <br>

        <div>

            <label for="email">Email</label><br>
            <input type="text" name="email" id="email">
            <?= $errors['email'] ? "<p>" . $errors['email'] . "</p>" : '' ?>

        </div>

        <br>

        <div>

            <label for="date">Date Naissance</label><br>
            <input type="date" name="date" id="date">

        </div>

        <div>

            <label for="password">Mot de passe</label><br>
            <input type="password" name="password" id="password">

        </div>
        <br>


        <button>Submit</button>

    </form>

    <!-- FOOTER    -->

    <footer class="footer">

        <?php require_once 'footer.php' ?>

    </footer>
</body>

</html>