function MyProfile(){
	let userMail = document.querySelector('.user-name span');
	window.location.href = "profile.php?emailUser=" + userMail.textContent;
}
