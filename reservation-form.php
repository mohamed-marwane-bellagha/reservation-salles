<?php
$title="Ajout d'événements";
include_once('./inc/header.php');
if(isset($_SESSION['login'])){
if(isset($_SESSION['date'])){
$date=date("l",strtotime($_SESSION['date']));
$time=date("H:i",strtotime($_SESSION['date']));
}
echo "<h1 class='title'>$title</h1><form action='reservation-form.php' method='get' class='formstyle'>
<label for='titre'>Titre:</label>
<input type='text' id='titre' name='titre'>
<label for='description'>Description:</label>
<textarea id='description' name='description'></textarea>
<label for='datedebut'>Date debut:</label>";
if(isset($_SESSION['date'])){
    echo "<div>
<select id='datedebut' name='datedebut' >";
    for($k=0;$k<5;$k++){
        $day=date("l",strtotime(" Today +".$k."days"));
        if($day==$date){
            echo "<option selected>$date</option>";
        }else{
        echo "<option>$day</option>";}
    }
    
echo"
</select>
<input type='time' min='08:00' max='20:00' step='3600' value='$time'  id='tempsdebut' name='tempsdebut'></div>";
}else {
    echo "<div>
<select id='datedebut' name='datedebut'>";
    for($k=0;$k<5;$k++){
        $day=date("l ",strtotime(" Today +".$k."days"));
        echo "<option>$day</option>";}
    echo"
</select>
<input type='time' min='08:00' max='20:00' step='3600' id='tempsdebut' name='tempsdebut'></div>";
}
echo "
<label for='datefin'>Date Fin:</label><div>
<select id='datefin' name='datefin'>";
    for($k=0;$k<5;$k++){
    $day=date("l ",strtotime(" Today +".$k."days"));
    echo "<option>$day</option>";}
    echo "</select>
<input type='time' min='08:00' max='20:00' step='3600' id='tempsfin' name='tempsfin'></div>
<input type='submit' id='submit' name='submit' value='Ajouter Evenement' class='btn btn-primary'>
</form>";
if(isset($_GET['submit'])) {
    $db = mysqli_connect("localhost", "root", "", "reservationsalles");
    foreach($_GET as $key=>$values){
        if($key=="titre"){
            $titre=mysqli_real_escape_string($db, htmlspecialchars(trim($values)));
        }
        if($key=="description"){
            $description=mysqli_real_escape_string($db, htmlspecialchars(trim($values)));
        }
        if($key=="datefin"){
            $datefin=mysqli_real_escape_string($db, htmlspecialchars(trim($values)));
        }
        if($key=="tempsfin"){
            $tempsfin=mysqli_real_escape_string($db, htmlspecialchars(trim($values)));
        }
        if($key=="datedebut"){
            $datedebut=mysqli_real_escape_string($db, htmlspecialchars(trim($values)));
        }
        if($key=="tempsdebut"){
            $tempsdebut=mysqli_real_escape_string($db, htmlspecialchars(trim($values)));
        }
    }

        $eventfin=date("Y/m/d H:i:s",strtotime("$datefin $tempsfin"));
    if(isset($_SESSION['date'])){
    $eventdebut=date("Y/m/d H:i:s",strtotime($_SESSION['date']));
    }else{
        $eventdebut=date("Y/m/d H:i:s",strtotime("$datedebut $tempsfin"));
    }
    if($eventfin>$eventdebut){
    $db = mysqli_connect("localhost", "root", "", "reservationsalles");
    $req="SELECT `debut`,`fin` FROM `reservations` WHERE `debut`='{$eventdebut}' AND `fin`='{$eventfin}'";
    $query=mysqli_query($db,$req);
    $checkevent=mysqli_fetch_assoc($query);
        var_dump($checkevent);
        if($checkevent==null){
            $req="INSERT INTO `reservations`( `titre`, `description`, `debut`, `fin`, `id_utilisateur`) VALUES ('{$titre}','{$description}','{$_SESSION['date']}','{$eventfin}','{$_SESSION['id']}')";
            $query=mysqli_query($db,$req);
            header("Location:planning.php");}
        else{
        echo "Vous n'avez pas le don d'ubiquité";
    }
    }else{
        echo "C'est pas retour vers le Futur";
    }
}
}else{
    header("Location:index.php");
}
include_once('./inc/footer.php');
?>