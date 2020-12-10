<?php
$title="Connexion";
include_once('./inc/header.php');
if(!isset($_SESSION['login'])){
    echo "<h1 class='title'>$title</h1><form action='connexion.php' method='post' class='formstyle  '>
<label for='login'>Login</label>
<input type='text' id='login' name='login'>
<label for='password'>Password</label>
<input type='password' id='password' name='password'>
<input type='submit' name='submit' value='Connexion' class='btn btn-primary'>
</form>";
}else{
    echo "<h1 class='title'>$title</h1><form action='connexion.php' method='post' class='formstyle'>
<input type='submit' id='profil' name='profil' value='Modifier son profil' class='btn btn-primary'> 
<input type='submit' id='planning' name='planning' value='Voir le planning' class='btn btn-primary'>
<input type='submit' id='reservation' name='reservation' value='Ajouter une reservation' class='btn btn-primary'>
<input type='submit' id='disconnect' name='disconnect' value='Deconnexion' class='btn btn-primary'>

</form>";
}

if(isset($_POST['profil'])){
    header("Location: profil.php");
}
if(isset($_POST['planning'])){
    header("Location: planning.php");
}
if(isset($_POST['reservation'])){
    header("Location: reservation-form.php");
}
if(isset($_POST['disconnect'])){
    session_destroy();
    header("Location: connexion.php");
}
if(isset($_POST['submit'])){
    foreach($_POST as $key=>$value){
        if($key=="login"){
            $login=$value;
        }if($key=="password"){
            $password=$value;
        }
    }
    $db=mysqli_connect("localhost","root","","reservationsalles");
    $req="SELECT * FROM `utilisateurs`";
    $query=mysqli_query($db,$req);
    $all_results=mysqli_fetch_all($query);
    $signal=0;
    for($i=0;isset($all_results[$i]);$i++){
        if($all_results[$i][1]==$login && password_verify($password, $all_results[$i][2])){
            $signal=1;
            $_SESSION['id']=$all_results[$i][0];
            $_SESSION['login']=$login;
            header("Location:connexion.php");
        }
    }
    if($signal==0){
        echo "Rentrez des informations correctes";
    }

}

include_once('./inc/footer.php');
?>