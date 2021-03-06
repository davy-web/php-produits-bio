<?php
$error = "";
include '../config.php';

if ($_POST) {
    $result = $pdo->prepare('SELECT * FROM davy_users WHERE login = :login');
    $result->execute(array(
        'login' => $_POST['login']
    ));
    $user_double = 0;

    if (!empty($_POST['login'])) {
        if (filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
            while ($users = $result->fetch(PDO::FETCH_ASSOC)) {
                if ($_POST['login'] == $users["login"]) {
                    $user_double = 1;
                }
            }
            if ($user_double == 0) {
                if (strlen($_POST['password']) >= 8) {
                    if ($_POST['password'] == $_POST['confirm_password']) {
                        // Requêtes SQL pour insérer une nouvelle ligne dans la base de données
                        $result = $pdo->prepare('INSERT INTO davy_users (login, password) VALUES (:login, :password)');
                        // On remplace les éléments préparés par les données envoyées par le formulaire
                        $result->execute(array(
                            'login' => $_POST['login'],
                            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
                        ));
                        $error = "Enregister!";
                    }
                    else {
                        $error = "Les mots de passe saisis ne sont pas identiques";
                    }
                }
                else {
                    $error = "Le mot de passe doit comporter au minimum 8 caractères";
                }
            }
            else {
                $error = "Ce login a déjà été utilisé";
            }
        }
        else {
            $error = "Le login doit être une adresse e-mail";
        }
    }
    else {
        $error = "Veuillez remplir tous les champs";
    }
}
?>
<?php
$title_page = "Inscription - Produits Bio";
$title_header = "Inscription";
$chemin_page = "../";
include '../header2.php';
?>

        <!-- Inscription -->
        <div class="container text-center mt-5">
            <form method="POST" action="">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <label for="login">Login</label><br>
                        <input type="text" placeholder="Votre adresse e-mail" id="login" name="login" class="input border_input"><br><br>

                        <label for="password">Password</label><br>
                        <input type="password" placeholder="Votre mot de passe" id="password" name="password" class="input border_input"><br><br>

                        <label for="confirm_password">Confirm password</label><br>
                        <input type="password" placeholder="Confirmer votre mot de passe" id="confirm_password" name="confirm_password" class="input border_input"><br><br>

                        <input type="submit" name="inscrire" value="S'inscrire" class="btn bouton_green color_white"><br>
                        <p class="color_red size_s py-5"><?php echo($error); ?></p>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </form>
        </div>

<?php
include '../footer.php';
?>