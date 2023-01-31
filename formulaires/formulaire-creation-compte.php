<?php

include_once('head.php');

?>


    <form action="traitement-creation-compte.php" id="inscriptionFormulaire" method="post">
        
        <select name="role" id="selectRole" onchange="addSelect()">
            <option value="">Séléctionner un rôle</option>
            <option value="Patient">Patient</option>
            <option value="Médecin">Médecin</option>
        </select>
        
        <div>

            <label for="nom">Nom</label>
            <input type="text" name="nom">
        </div>
        
        <div>
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom">
        </div>

        <div>
            <label for="identifiant">Adresse email</label>
            <input type="text" name="identifiant">
        </div>
        
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="passwordInscription">
        </div>

        <div>
            <label for="password">Confirmer mot de passe</label>
            <input type="password" name="passwordConfirmation" id="passwordInscriptionConfirmation">
            <div id="passwordIdentitiqueInscription" style="display: none;"></div>
        </div>
        
        <input class="btn" type="submit" id='inscriptionFormulaireSubmit' value="Envoyer" disabled="true">
        
    </form> 

    <span id="patientFormulaire" style="display: none">
        <div>
            <label for="dateNaissance">Date de naissance</label>
            <input type="date" name="dateNaissance">
        </div>
    </span>

    <span id="medecinFormulaire" style="display: none">
        <div>
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse">
        </div>
    
        <div>
            <label for="tel">Numéro de téléphone</label>
            <input type="tel" name="tel">
        </div>
        
    </span>



