<?php
include_once('pdo-oracle.php');
include_once('functions.php');

//$creneaux = getAllCreneauxParCategorie(1);
//$medecins = getMedecinsParCategorie(1);

?>

<div class="ficheMedecin mb-5">
    <div class="infos">
        <p><?php echo $medecin['nom_medecin'] . " " . $medecin['prenom_medecin']?></p>
        <p><?php echo $medecin['adresse_medecin'] . " " . $medecin['tel_medecin']?></p>
    </div>
    <div class="creneaux">
        <p><?php
        foreach($creneaux as $jour){
            $count = 0;
            foreach($jour as $creneau){
				echo "<div class='jour container'>";
                echo "<p>". date('l d', strtotime('+'.$count.' day')) ."</p>";
                for($i = 9;$i < 17; $i++){
                    echo ($creneau[$i]==true ? "<form class=\"horaire mb-2 booked\" method=\"POST\" action=\"formulaires/traitement-prise-rdv.php\"> " : "<form method=\"POST\" action=\"formulaires/traitement-prise-rdv.php\" class=\"mb-2 horaire\">");
					echo "<input type=\"hidden\" name=\"id_medecin\" value=\"".$medecin['id_medecin']."\"></input>";
					echo "<input type=\"hidden\" name=\"date\" value=\"".date('d', strtotime('+'.$count.' day'))."/".$i."\"></input>";
					echo "<input type=\"submit\" value=\"".$i."h00\"></input></form>";
                }
                echo "</div>";
                $count++;
            }
        }
        ?></p>
    </div>
</div>