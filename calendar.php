<?php


include_once('pdo-oracle.php');
include_once('functions.php');


function getMaxDay($month) {
   return date("t", strtotime('2022-'.$month.'-01'));
}


function isToday($year, $month, $day) {
   $today = date('Y-m-d');
   if($day < 9) {
       $day = '0'.$day;
   }
   if(date("Y") == $year && date('m')==$month && strval(date('d'))==strval($day)) {
       return "Today";
   }
   return '';
}


function breakWeek($year, $month, $day) {
   echo (date('l', mktime(0, 0, 0, $month, $day, $year)) == 'Monday')?'<br>':'';
}


$month = $_GET['mois'];
$year = $_GET['annee'];

$data = getRdvs($month, $year, "jules.mignotte@orange.fr");


?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<script>
   $(document).ready(function(){   
       $('.jourCalendrier').on('click', function(e) {
           console.log($(this).attr('data-indexJour'));
           document.getElementById("creneaux").style.display="block";


       });
   });
</script>


<style>


   .jourCalendrierToday {
       background-color: blue;
       color: white;
   }


</style>


<form action="" method="get">


<select name="mois" id="">
       <option value="01" <?php echo $_GET['mois']=='01'?'selected':''?>>Janvier</option>
       <option value="02" <?php echo $_GET['mois']=='02'?'selected':''?>>Février</option>
       <option value="03" <?php echo $_GET['mois']=='03'?'selected':''?>>Mars</option>
       <option value="04" <?php echo $_GET['mois']=='04'?'selected':''?>>Avril</option>
       <option value="05" <?php echo $_GET['mois']=='05'?'selected':''?>>Mai</option>
       <option value="06" <?php echo $_GET['mois']=='06'?'selected':''?>>Juin</option>
       <option value="07" <?php echo $_GET['mois']=='07'?'selected':''?>>Juillet</option>
       <option value="08" <?php echo $_GET['mois']=='08'?'selected':''?>>Août</option>
       <option value="09" <?php echo $_GET['mois']=='09'?'selected':''?>>Septembre</option>
       <option value="10" <?php echo $_GET['mois']=='10'?'selected':''?>>Octobre</option>
       <option value="11" <?php echo $_GET['mois']=='11'?'selected':''?>>Novembre</option>
       <option value="12" <?php echo $_GET['mois']=='12'?'selected':''?>>Décembre</option>
   </select>


   <input type="number" name="annee" id="" placeholder="annee" min="0" max="2100" value="<?php echo (!empty($_GET['annee']))?$_GET['annee']:'2022' ?>">


   <input type="submit" value="Send">
</form>


<?php if(!empty($_GET['mois'])): ?>
   <?php if(!empty($_GET['annee'])) : ?>


       <div class="container">   
          
           <?php for ($i=1; $i < getMaxDay($month)+1; $i++) : ?>
               <div class='jourCalendrier<?php echo isToday($year, $month, $i) ?>' data-indexJour="<?php echo $i?>">
                   <?php echo $i ?> <?php echo date('l', mktime(0, 0, 0, $month, $i, $year))?>
               </div>
           <?php endfor ?>


       </div>


   <?php endif ?>
<?php endif ?>


<div id="creneaux" style="display: none;">
   <p id="tableauDate"></p>
   <table>
       <tr>
           <td>Créneau Horaire</td>
           <td>Disponibilités</td>
       </tr>
       <tr>
           <td>09H00 - 10H00</td>
           <td>Disponibilités</td>
       </tr>
       <tr>
           <td>10H00 - 11H00</td>
           <td>Disponibilités</td>
       </tr>
       <tr>
           <td>11H00 - 12H00</td>
           <td>Disponibilités</td>
       </tr>
       <tr>
           <td>13H00 - 14H00</td>
           <td>Disponibilités</td>
       </tr>
       <tr>
           <td>14H00 - 15H00</td>
           <td>Disponibilités</td>
       </tr>
       <tr>
           <td>15H00 - 16H00</td>
           <td>Disponibilités</td>
       </tr>
       <tr>
           <td>16H00 - 17H00</td>
           <td>Disponibilités</td>
       </tr>
   </table>
</div>
