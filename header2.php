<?php
// Compte visite
function nb_visit($page, $pdo) {
    $result2 = $pdo->query('SELECT * FROM davy_dashboard');
    $visit = $result2->fetch(PDO::FETCH_ASSOC);
    $nb_visit = $visit[$page];
    $prepare = 'UPDATE davy_dashboard SET ' . $page . ' = :' . $page . ' WHERE id = :id';
    $result3 = $pdo->prepare($prepare);
    $result3->execute(array(
        'id' => 1,
        $page => $nb_visit + 1
    ));
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title_page; ?></title>
        <meta name="description" content="Produits frais bio, commander maintenant !">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:url" content="https://produits-bio.000webhostapp.com" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="<?php echo $title_page; ?>" />
        <meta property="og:description" content="Produits frais bio, commander maintenant !" />
        <meta property="og:image" content="<?php echo $chemin_page; ?>images/icon.svg" />
        <link href="https://fonts.googleapis.com/css2?family=Grand+Hotel&display=swap" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $chemin_page; ?>images/icon.svg">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="<?php echo $chemin_page; ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $chemin_page; ?>css/style.css">
    </head>

    <body>
        <header>
            <!-- Menu -->
            <nav class="navbar navbar-expand-lg fixed-top bg_dark">
                <div class="container">
                    <a title="Accueil" class="navbar-brand" href="<?php echo $chemin_page; ?>">
                        <img src="<?php echo $chemin_page; ?>images/logo.svg" height="60" alt="logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="material-icons color_white">menu</i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav mr-auto">
                        </ul>
                        <div class="navbar-brand">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                    <a title="Accueil" class="navbar-brand color_white" href="<?php echo $chemin_page; ?>">Accueil</a>
                                </li>
                                <li class="nav-item">
                                    <a title="Produits" class="navbar-brand color_white" href="<?php echo $chemin_page; ?>produits/">Produits</a>
                                </li>
                                <li class="nav-item">
                                    <a title="Valeurs" class="navbar-brand color_white" href="<?php echo $chemin_page; ?>valeurs/">Nos valeurs</a>
                                </li>
                                <li class="nav-item">
                                    <a title="Contact" class="navbar-brand color_white" href="<?php echo $chemin_page; ?>contact/">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            
            <!-- Header -->
            <div class="container-fluid fond_noir_0" style="height: 45vh;">
                <div class="container pt-5">
                    <div class="row pt-5">
                        <div class="col-lg color_white align-self-center text-center pt-5">
                            <h1 class="font_hotel color_green"><?php echo $title_header; ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <button onclick="top_scroll()" id="top_button" title="Top"><i class="material-icons">arrow_upward</i></button>
        </header>
        