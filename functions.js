

$(document).ready(function(){

    $('#passwordInscriptionConfirmation').on('input',function(e){
        
        if($('#passwordInscriptionConfirmation').val() != $('#passwordInscription').val()) {
            document.getElementById('passwordIdentitiqueInscription').innerHTML = 'Les mots de passe ne sont pas identique';
            document.getElementById('passwordIdentitiqueInscription').style.display = 'block';
        } else {
            document.getElementById('passwordIdentitiqueInscription').style.display = 'none';
            document.getElementById('passwordIdentitiqueInscription').innerHTML = '';
        }
    });

    $('#passwordInscription').on('input',function(e){
        
        if($('#passwordInscriptionConfirmation').val() != $('#passwordInscription').val()) {
            document.getElementById('passwordIdentitiqueInscription').style.display = 'block';
            document.getElementById('passwordIdentitiqueInscription').innerHTML = 'Les mots de passe ne sont pas identique';
        } else {
            document.getElementById('passwordIdentitiqueInscription').style.display = 'none';
            document.getElementById('passwordIdentitiqueInscription').innerHTML = '';
        }
    });
    
});
    
function addSelect() {
    if(document.getElementById('selectRole').value == 'Patient') {
        try {
            document.getElementById('form-container').appendChild(document.getElementById('medecinFormulaire'));
            document.getElementById('medecinFormulaire').style.display = 'none'
        } catch (error) {
            console.log(error)
        }
        document.getElementById('inscriptionFormulaireSubmit').disabled = false;
        document.getElementById('patientFormulaire').style.display = 'inline'
        document.getElementById('inscriptionFormulaire').insertBefore(document.getElementById('patientFormulaire'), document.getElementById('inscriptionFormulaireSubmit'));
    }
    if(document.getElementById('selectRole').value == 'Médecin') {
        try {
            document.getElementById('form-container').appendChild(document.getElementById('patientFormulaire'));
            document.getElementById('patientFormulaire').style.display = 'none'
        } catch (error) {
            console.log(error)
        }
        document.getElementById('inscriptionFormulaireSubmit').disabled = false;
        document.getElementById('medecinFormulaire').style.display = 'inline'
        document.getElementById('inscriptionFormulaire').insertBefore(document.getElementById('medecinFormulaire'), document.getElementById('inscriptionFormulaireSubmit'));
    }
    if(document.getElementById('selectRole').value == '') {
        try {
            document.getElementById('form-container').appendChild(document.getElementById('patientFormulaire'));
            document.getElementById('patientFormulaire').style.display = 'none'
            document.getElementById('form-container').appendChild(document.getElementById('medecinFormulaire'));
            document.getElementById('medecinFormulaire').style.display = 'none'
            document.getElementById('inscriptionFormulaireSubmit').disabled = true;
        } catch (error) {
            console.log(error)
        }
    }
}


