<?php
$error = "";
include '../config.php';

if ($_POST) {
    $result = $pdo->prepare('SELECT * FROM davy_users WHERE login = :login');
    $result->execute(array(
        'login' => $_POST['login']
    ));
    $ErrorCo = true;
    
    if (!empty($_POST['login'])) {
        while($users = $result->fetch(PDO::FETCH_ASSOC)){
            if (($_POST['login'] == "chendavyweb@gmail.com") && ($_POST['login'] == $users["login"]) && (password_verify($_POST['password'], $users["password"]))) {
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['connect'] = "connect";
                $ErrorCo = false;
                header('Location: ../admin/');
                exit();
            }
        }
        if ($ErrorCo == true) {
            $error = "Le mot de passe ou l'identifiant est faux";
        }
    }
    else {
        $error = "Veuillez remplir tous les champs";
    }
}
?>
<?php
$title_page = "Connexion - Produits Bio";
$title_header = "Connexion";
$chemin_page = "../";
include '../header2.php';
?>

        <!-- Connexion -->
        <div class="container text-center mt-5">
            <form method="POST" action="">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <label for="login">Login</label><br>
                        <input type="text" placeholder="Votre adresse e-mail" id="login" name="login" class="input border_input"><br><br>

                        <label for="password">Password</label><br>
                        <input type="password" placeholder="Votre mot de passe" id="password" name="password" class="input border_input"><br><br>

                        <input type="submit" name="connecter" value="Se connecter" class="btn bouton_green color_white"><br>
                        <p class="color_red size_s py-5"><?php echo($error); ?></p>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </form>
        </div>
        
<?php
include '../footer.php';
?>