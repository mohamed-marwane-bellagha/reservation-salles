<?php
$title="Profil";
include_once('./inc/header.php');

if(isset($_SESSION['login'])){
echo "<h1 class='title'>$title</h1><form action='profil.php' method='post' class='formstyle' >
<label for='login'>Modifier login</label>
<input type='text' name='login' id='login' value=".$_SESSION['login'].">
<label for='password'>Modifier password</label>
<input type='password' name='password' id='password'>
<input type='submit' name='submit' id='submit' value='Changer info profil' class='btn btn-primary'>
</form>";
if(isset($_POST['submit'])){
    foreach ($_POST as $key=>$value){
        if($key=="login"){
            $login=mysqli_real_escape_string($db, htmlspecialchars(trim($value)));
        }
        if($key=="password"){
            $password=mysqli_real_escape_string($db, htmlspecialchars(trim($value)));
        }
    }
    $req="SELECT `login` FROM `utilisateurs` WHERE `login`='{$_SESSION['login']}'";
    $query=mysqli_query($db,$req);
    $checklogin=mysqli_fetch_assoc($query);
    $cryptedpass=password_hash($password,PASSWORD_BCRYPT);
    if($checklogin==null){
        $req="UPDATE `utilisateurs` SET `login`='{$login}',`password`='{$cryptedpass}' WHERE `login`='{$_SESSION['login']}'";
        $query=mysqli_query($db,$req);
        $_SESSION['login']=$login;

        header("Location:profil.php");
    }else{
        echo "Login deja pris";
    }

}
}/*else{
    header("Location: index.php");
}*/
include_once('./inc/footer.php');

?>