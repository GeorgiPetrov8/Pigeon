document.addEventListener('DOMContentLoaded', function() {
  
	document.getElementById('postsContainer').addEventListener('click', function(event) {
		var target = event.target;
		var postsContainer = document.getElementById('postsContainer');
	
		// Check if the clicked element is a delete button
		if (target.classList.contains('delete-button')) {

			var postID = event.target.closest('.post').dataset.idofpost;
		
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'delete_post.php'); 
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
			var userElement = document.querySelector('.user-name span');
			var userName = userElement.textContent;
			
			
			xhr.send('post_id=' + postID + '&user_email=' + userName);
			
			postsContainer.removeChild(target.parentElement.parentElement);
		}
	});
});
