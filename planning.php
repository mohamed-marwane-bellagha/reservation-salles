
<?php
$title=" Mon Planning";
include_once('./inc/header.php');
echo "<h1 class='title'>Mon Planning</h1>";
if(isset($_SESSION['login'])){
$req="SELECT utilisateurs.login,`titre`,`description`,`debut`,`fin`,reservations.id FROM `reservations` JOIN `utilisateurs` ON utilisateurs.id=reservations.`id_utilisateur`";
$query=mysqli_query($db,$req);
$all_results=mysqli_fetch_all($query);
$count=count($all_results);
echo "<table class='planning'><th></th>";
for($k=0;$k<5;$k++){
    $day=date("l",strtotime(" Today +".$k."days"));
    echo "<th>$day</th>";}
for($j=7;$j<19;$j++){
    $time=date("H:i",strtotime($j.":00 +1hour"));
    echo "<tr><th>$time</th>";
    for($i=0;$i<5;$i++){
        $date=date("Y/m/d",strtotime(" Today +".$i."days"));
        $eventdebut=date("Y/m/d H:i",strtotime("$date $time"));
        $sign = 0;
        for ($l=0;isset($all_results[$l]);$l++){
            $dbstartdate=date("Y/m/d H:i:s",strtotime($all_results[$l][3]));
            $dbenddate=date("Y/m/d H:i:s",strtotime($all_results[$l][4]));
            if($dbstartdate==$eventdebut || $eventdebut==$dbenddate  || $dbstartdate < $eventdebut && $eventdebut < $dbenddate ){
                echo "<td><div class='card bg-light mb-3'>
                       <div class='card-header'>Par: ".$all_results[$l][0]."</div>
                       <div class='card-body'>
                       <h4 class='card-title'>Titre: ".$all_results[$l][1]."</h4>
                       <p class='card-text'>Description: ".$all_results[$l][2]."</br>Commencé le: ".$all_results[$l][3]."<br>Fin le: ".$all_results[$l][4]."</p>
                       <form method='get' action='reservation.php'>
                       <input type='hidden' name='idevent' value=".$all_results[$l][5]. ">
                       <button type='submit' id='redirectevent' class='btn btn-info'>Plus d'info</button>
                       </form></div></div></td>";
                $sign=1;
       }
        }
    if ($sign == 0){
            echo "<td>
<form action='planning.php' method='post'>
<button type='submit' id='event' name='event'  class='btn btn-secondary' value='$date $time'>+</button>
</form></td>";

        }
        if(isset($_POST['event']) && !isset($_POST['redirect'])){
            $_SESSION['date']=$_POST['event'];
            header("Location: reservation-form.php");
    }
    }
    echo "</tr>";

}
echo "</table>";
}else{
    header("Location:index.php");
}


include_once('./inc/footer.php');

?>