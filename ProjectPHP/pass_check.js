function checkPass(event) {
    var pass1 = document.getElementById('pass1');
    var pass2 = document.getElementById('pass2');

    if (pass1.value !== pass2.value) {
		
		var errorPara = document.createElement('p');
		errorPara.textContent = "Passwords do not match";
		errorPara.style.color = 'red';
		errorPara.style.textAlign = 'center';

		var form = document.getElementById('createAcc');
		form.appendChild(errorPara);
		
        event.preventDefault(); // Prevent form submission
		
		pass1.style.borderColor = 'red';
		pass2.style.borderColor = 'red';
		
        return false; // Stop further execution
    }
    return true; // Proceed with form submission if passwords match
}

function redirectToIndex() {
	window.location.href = 'index.php';
}