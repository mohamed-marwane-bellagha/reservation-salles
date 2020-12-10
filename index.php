<?php
$title="Accueil";
include_once('./inc/header.php');

?>
<main>
    <div class="jumbotron">
        <h1 class="display-3">Bienvenue dans le tout nouveau planning de La Plateforme_</h1>
        <p class="lead">Un planning simple et efficient avec un joli design.</p>
        <hr class="my-4">
        <p>Pensé pour vous.</p>
    </div>
    <div class="cardcontainer">
    <div class="card text-white bg-primary mb-3 indexcard" style="max-width: 20rem;">
        <div class="card-header">Inscription</div>
        <div class="card-body">
            <h4 class="card-title">Inscrivez-vous</h4>
            <p class="card-text">Inscrivez vous pour utiliser nos services.</p>
            <a href="inscription.php" class="card-link">C'est par ici</a>
        </div>
    </div>
    <div class="card text-white bg-dark mb-3 indexcard" style="max-width: 20rem;">
        <div class="card-header">Connexion</div>
        <div class="card-body">
            <h4 class="card-title">Connectez-vous</h4>
            <p class="card-text">Apres vous etre inscrit connectez vous.</p>
            <a href="connexion.php" class="card-link">C'est par ici</a>
        </div>
    </div>
    <div class="card text-white bg-dark mb-3 indexcard" style="max-width: 20rem;">
        <div class="card-header">Planning</div>
        <div class="card-body">
            <h4 class="card-title">Organisez vous</h4>
            <p class="card-text">Notre joli planning.</p>
            <a href="planning.php" class="card-link">C'est par ici</a>
        </div>
    </div>
    </div>
</main>
<?php
include_once('./inc/footer.php')
?>