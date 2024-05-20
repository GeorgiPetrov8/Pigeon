document.addEventListener('DOMContentLoaded', function() {
  
  // Event delegation for 'click' event on the posts container
	document.getElementById('postsContainer').addEventListener('click', function(event) {
		var target = event.target;
	
    // Check if the clicked element is a like button
    if (target.classList.contains('fa') && target.classList.contains('fa-heart') || target.closest('.like-button')) {

		var likeIcon = target.parentNode.querySelector('.fa.fa-heart');
		var likesCount = target.parentNode.parentNode.querySelector('.post-likes');
		var currentLikes = parseInt(likesCount.textContent);
		var isLiked = target.classList.toggle('liked');
		var postID = event.target.closest('.post').dataset.idofpost;
		
		var action = isLiked ? 'like' : 'unlike';
		
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'check_like_status.php'); 
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
		xhr.onreadystatechange = function() {
			if (xhr.readyState === XMLHttpRequest.DONE) {
				if (xhr.status === 200) {
        
					var alreadyLiked = xhr.responseText == '1';
					
					if (!alreadyLiked && action === 'like') {
          
						action = 'like';
						console.log(action);
						currentLikes ++;
						likesCount.textContent = currentLikes;
						likeIcon.style.color = 'red';
						updateLikesOnServer(postID, action);
		  
					} else if (alreadyLiked && action === 'like') {
          
						action = 'unlike';
						console.log(action);
						currentLikes = Math.max(0, currentLikes - 1);
						likesCount.textContent = currentLikes;
						likeIcon.style.color = 'black'
						updateLikesOnServer(postID, action);
		  
					} else if (alreadyLiked && action === 'unlike'){
						
						action = 'unlike';
						console.log(action);
						currentLikes = Math.max(0, currentLikes - 1);
						likesCount.textContent = currentLikes;
						likeIcon.style.color = 'black'
						updateLikesOnServer(postID, action);
					}
				} else {
					console.error('Error checking like status: ' + xhr.status);
				}
			}
		};
	
		var userElement = document.querySelector('.user-name span');
		var userName = userElement.textContent;
		
		xhr.send('post_id=' + postID + '&email=' + userName);
	
    }
  });
});

function updateLikesOnServer(postID, action){
	
	var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_likes.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	  
	var userElement = document.querySelector('.user-name span');
	var userName = userElement.textContent;

    xhr.send('post_id=' + postID + '&action=' + action + '&user_email=' + encodeURIComponent(userName));
}
