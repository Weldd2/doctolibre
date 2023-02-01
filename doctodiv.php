<?php
include_once('pdo-oracle.php');
include_once('functions.php');

//$creneaux = getAllCreneauxParCategorie(1);
//$medecins = getMedecinsParCategorie(1);

?>

<div class="ficheMedecin">
    <div class="infos">
        <p><?php echo $medecin['nom_medecin'] . " " . $medecin['prenom_medecin']?></p>
        <p><?php echo $medecin['adresse_medecin'] . " " . $medecin['tel_medecin']?></p>
    </div>
    <div class="creneaux">
        <p><?php
        foreach($creneaux as $jour){
            $count = 0;
            foreach($jour as $creneau){
                echo "<div class='jour'>";
                echo "<p>". date('l d', strtotime('+'.$count.' day')) ."</p>";
                for($i = 9;$i < 17; $i++){
                    echo $i ."h00-" . ($i+1) ."h00 : " . $creneau[$i] . "</br>";
                }
                echo "</div>";
                echo "</br>";
                $count++;
            }
        }
        ?></p>
    </div>
</div>