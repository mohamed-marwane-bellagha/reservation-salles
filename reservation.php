<?php
$title="Reservation";
include_once('./inc/header.php');

if(isset($_SESSION['login'])){
    if(isset($_GET['idevent'])){
        $req="SELECT utilisateurs.login,`titre`,`description`,`debut`,`fin`,reservations.id, `id_utilisateur` FROM `reservations` JOIN `utilisateurs` ON utilisateurs.id=reservations.`id_utilisateur` WHERE reservations.id='{$_GET['idevent']}'";
        $query=mysqli_query($db,$req);
        $assoc=mysqli_fetch_assoc($query);
       echo "<h1 class='title'>$title</h1>";
        if($_SESSION['id']==$assoc['id_utilisateur'])
        {
            $debut=date("H:i",strtotime($assoc['debut']));
            $fin=date("H:i",strtotime($assoc['fin']));

            echo "<form action='' method='post' class='formstyle'>
                  <input type='hidden' name='idevent' id='idevent' value=".$_GET['idevent']."><label for='titre'>Titre:</label>
                  <input type='text' name='titre' value=".$assoc['titre'].">
                  <label for='description'>Description:</label>
                    <input type='text' name='description' value=".$assoc['description'].">
                    <label for='datedebut'>Date debut:</label><div>
                    <select id='datedebut' name='datedebut'>";
                        for($k=0;$k<5;$k++){
                            $day=date("l",strtotime(" Today +".$k."days"));
                            if($day==$debut){
                            echo "<option selected>".$assoc['debut']."</option>";
                                }else{
                                    echo "<option>$day</option>";}
                                     };
            echo "<input type='time' min='08:00' max='20:00' step='3600' value=".$debut." id='tempsdebut' name='tempsdebut'></div>
                   <label for='datefin'>Date Fin:</label><div>
                    <select id='datefin' name='datefin'>";
                        for($k=0;$k<5;$k++){
                            $day=date("l",strtotime(" Today +".$k."days"));
                                if($day==$assoc['fin']){
                                    echo "<option selected>".$assoc['fin']."</option>";
                                }else{
                                    echo "<option>$day</option>";}
                        }
            echo "</select>
            <input type='time' min='08:00' max='20:00' step='3600' id='tempsfin' name='tempsfin' value=".$fin."></div>
            <input type='submit' name='update' id='update' value='Modifier Evenement' class='btn btn-primary'>
            </form>";
                       
            if(isset($_POST['update'])){
                foreach($_POST as $key=>$value){
                    echo $key.'</br>';
                    if($key=="idevent"){
                        $idevent=mysqli_real_escape_string($db, htmlspecialchars(trim($value)));

                    }
                    if($key=="titre"){
                        $titre=mysqli_real_escape_string($db, htmlspecialchars(trim($value)));
                    }
                    if($key=="description"){
                        $description=mysqli_real_escape_string($db, htmlspecialchars(trim($value)));
                    }
                    if($key=="datefin"){
                        $datefin=mysqli_real_escape_string($db, htmlspecialchars(trim($value)));
                    }
                    if($key=="tempsfin"){
                        $tempsfin=mysqli_real_escape_string($db, htmlspecialchars(trim($value)));
                    }
                    if($key=="datedebut"){
                        $datedebut=mysqli_real_escape_string($db, htmlspecialchars(trim($value)));
                    }
                    if($key=="tempsdebut"){
                        $tempsdebut=mysqli_real_escape_string($db, htmlspecialchars(trim($value)));
                    }

                }
                
                echo'<br/>';
             

                $eventdebut=date("Y/m/d H:i:s",strtotime("$datedebut $tempsdebut"));
                $eventfin=date("Y/m/d H:i:s",strtotime("$datefin $tempsfin"));
                if($eventfin>$eventdebut){
                    $db = mysqli_connect("localhost", "root", "", "reservationsalles");
                    $req="SELECT `debut`,`fin` FROM `reservations` WHERE `debut`='{$eventdebut}' AND `fin`='{$eventfin}'";
                    $query=mysqli_query($db,$req);
                    $checkevent=mysqli_fetch_assoc($query);

                    if($checkevent==null){

                        $req="UPDATE `reservations` SET `titre`='{$titre}',`description`='{$description}',`debut`='{$eventdebut}',`fin`='{$eventfin}' WHERE `id`='{$idevent}'";
                        $query=mysqli_query($db,$req);
                        header("Location:planning.php");
                        }
                    else{
                        echo "Vous n'avez pas le don d'ubiquité";
                    }
                }

            }

        }else{

echo " 
<div class='cardreservation'>
<div class='card bg-light mb-3 '>
<div class='card-header'>Par: ".$assoc['login']." </div>
<h4 class='card-body'><h4 class='card-title'>Titre: ".$assoc['titre']."</h4>
<p class='card-text'>Description: ".$assoc['description']."</br> Commencé le: ".$assoc['debut']."<br>Fin le: ".$assoc['fin'];
echo "</p></div>
</div></div>";
}
    }else{
           //header("Location: planning.php");
    }
}else{
    header("Location: index.php");}
include_once('./inc/footer.php');
?>