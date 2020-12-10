<?php
$title="Inscription";
include_once('./inc/header.php');
echo "<h1 class='title'>$title</h1>";
if(!isset($_SESSION['login'])){
?>

<form method="post" action="inscription.php" class="formstyle" >
    <label for="login">Login</label>
    <input type="text" id="login" name="login">
    <label for="password">Password</label>
    <input type="password" id="password" name="password">
    <label for="cpassword">Confirmer Password</label>
    <input type="password" id="cpassword" name="cpassword">
    <input type="submit" id="submit" name="submit" value="Inscrivez-moi" class="btn btn-primary">
</form>
<?php

if(isset($_POST['submit'])) {
    $db = mysqli_connect("localhost", "root", "", "reservationsalles");
    foreach ($_POST as $key => $values) {
        if ($key == "login") {
            $login = mysqli_real_escape_string($db, htmlspecialchars(trim($values)));
        }
        if ($key == "password") {
            $password = mysqli_real_escape_string($db, htmlspecialchars(trim($values)));
        }
        if ($key == "cpassword") {
            $password2 = mysqli_real_escape_string($db, htmlspecialchars(trim($values)));
        }
    }

    $cryptedpass = password_hash($password, PASSWORD_BCRYPT);
    $test = password_verify($password2, $cryptedpass);
    $req = "SELECT `login` FROM `utilisateurs` WHERE `login`='{$login}'";
    $query = mysqli_query($db, $req);
    $checklogin=mysqli_fetch_assoc($query);

    if($checklogin==null && $test==true && strlen($login)>0){
        $req="INSERT INTO `utilisateurs`(`login`,`password`) VALUES ('{$login}','{$cryptedpass}')";
        $query=mysqli_query($db,$req);

        header("Location:connexion.php");
    }
    else{
        echo "Dommage pas les bonnes conditions, try again";
    }



}
}else{
    header("Location:index.php");
}
include_once('./inc/footer.php');
?>