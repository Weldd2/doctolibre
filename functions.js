

$(document).ready(function(){

    $('#passwordInscriptionConfirmation').on('input',function(e){
        
        if($('#passwordInscriptionConfirmation').val() != $('#passwordInscription').val()) {
            document.getElementById('passwordIdentitiqueInscription').innerHTML = 'Mots de passe différents';
            document.getElementById('passwordIdentitiqueInscription').style.display = 'block';
        } else {
            document.getElementById('passwordIdentitiqueInscription').style.display = 'none';
            document.getElementById('passwordIdentitiqueInscription').innerHTML = '';
        }
    });

    $('#passwordInscription').on('input',function(e){
        
        if($('#passwordInscriptionConfirmation').val() != $('#passwordInscription').val()) {
            document.getElementById('passwordIdentitiqueInscription').style.display = 'block';
            document.getElementById('passwordIdentitiqueInscription').innerHTML = 'Mots de passe différents';
        } else {
            document.getElementById('passwordIdentitiqueInscription').style.display = 'none';
            document.getElementById('passwordIdentitiqueInscription').innerHTML = '';
        }
    });
    
});
    
function addSelect() {
	value = document.getElementById('selectRole').value;
	if(value == 'Patient' || value == 'Médecin') {
		document.getElementById('inscriptionFormulaireSubmit').disabled = false;
		document.getElementById('medecinFormulaireAdresse').style.display = 'none';
		document.getElementById('medecinFormulaireTel').style.display = 'none';
		document.getElementById('patientNaissance').style.display = 'none';
		if(value == 'Patient') {
			document.getElementById('patientNaissance').style.display = 'block';
		}
		if(value == 'Médecin') {
			document.getElementById('medecinFormulaireAdresse').style.display = 'block';
			document.getElementById('medecinFormulaireTel').style.display = 'block';
		}
	} else {
		document.getElementById('medecinFormulaireAdresse').style.display = 'none';
		document.getElementById('patientNaissance').style.display = 'none';
		document.getElementById('medecinFormulaireTel').style.display = 'none';
	}
}


