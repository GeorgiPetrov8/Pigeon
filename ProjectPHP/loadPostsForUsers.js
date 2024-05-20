var postContainer = document.getElementById('postContainer');
var isLoading = false;
var skip = 0;
var limit = 15; // Number of posts to load at once
var alreadyLiked = false;
var profileLoad = false;

function loadMorePosts() {
	
    if (isLoading) return;

    isLoading = true;
	var params = new URLSearchParams(location.search);
	var idOfPostToSend = params.get('idOfPost');
	if (idOfPostToSend == null) { var emailOfUser = new URLSearchParams(location.search).get('emailUser');}

    //fetch more posts
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'fetchForEachUser.php'); 
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function() {
		
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			
            var newPosts = JSON.parse(xhr.responseText);
			
            if (newPosts.length > 0) {
				
				//append child
                newPosts.forEach(appendPosts);
                
                skip += limit; // Update skip value for the next load
                isLoading = false;
				console.log(skip, " ", limit);
				
            } else {
                // No more posts to load
                isLoading = true;
                console.log('No more posts.');
            }
        } else {
            isLoading = false;
        }
    };
    
    if (idOfPostToSend != null) {
		xhr.send('post_id_user=' + idOfPostToSend + '&skip=' + skip + '&limit=' + limit);
	} else { xhr.send('email_user=' + emailOfUser + '&skip=' + skip + '&limit=' + limit); } 
	
}

// Listen to the scroll event and trigger loadMorePosts when reaching the bottom
var middleSection = document.getElementById('middle-section');
middleSection.addEventListener('scroll', function() {
	var scrollTop = middleSection.scrollTop;
    var clientHeight = middleSection.clientHeight;
    var scrollHeight = middleSection.scrollHeight;

    if (scrollTop + clientHeight >= scrollHeight - 100) {
		loadMorePosts();
	}   
});

function appendPosts(post) {
	
	//Post container
	var postDiv = document.createElement("div");
	postDiv.classList.add("post");
	postDiv.setAttribute('data-idOfPost', post.idOfPost);

	//Profile and Link
	var link = document.createElement("a");
	var emailOfUserPHP = "?idOfPost=" + post.idOfPost;
	link.href = "profile.php" + emailOfUserPHP;
	link.classList.add("post-name");
	var userName = document.createElement("h3");
	userName.textContent = post.User;
	link.appendChild(userName);
	
	//Delete Button
	var deleteButton = document.createElement("button");
	deleteButton.classList.add("delete-button");
	var deleteText = document.createTextNode("Delete");
	deleteButton.appendChild(deleteText);
	
	//Profile + Delete
	var profileDelete = document.createElement("div");
	profileDelete.classList.add("profileDelete");
	profileDelete.appendChild(link);
	
	//Check if User Created it
	var xhr1 = new XMLHttpRequest();
	xhr1.open('POST', 'check_user_creator.php'); 
	xhr1.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr1.onreadystatechange = function() {
			if (xhr1.readyState === XMLHttpRequest.DONE) {
				if (xhr1.status === 200) {
        
					userCreated = xhr1.responseText == '1';
					if(userCreated){
						profileDelete.appendChild(deleteButton);
					}
				} 
			}
	};
	var userElement = document.querySelector('.user-name span');
	var userName = userElement.textContent;
	xhr1.send('post_id=' + post.idOfPost + '&email=' + userName);
	
	
	//Title
	var titleHeading = document.createElement("h3");
	titleHeading.textContent = post.Title;
	titleHeading.classList.add("post-title");
	
	//Date
	var dateParagraph = document.createElement("p");
	dateParagraph.textContent = post.date;
	dateParagraph.classList.add("post-date");
	
	//Title + Date
	var titleDate = document.createElement("div");
	titleDate.classList.add("titleDate");
	titleDate.appendChild(titleHeading);
	titleDate.appendChild(dateParagraph);

	//Text
	var contentParagraph = document.createElement("p");
	contentParagraph.textContent = post.Post;
	contentParagraph.classList.add("post-content");
	
	//Likse Number
	var likeOfPosts = document.createElement("p");
	likeOfPosts.textContent = post.likes;
	likeOfPosts.classList.add("post-likes");
	
	//Like Button 
	var likeButton = document.createElement("button");
	likeButton.classList.add("like-button");
	var btnText = document.createElement("i");
	btnText.classList.add("fa", "fa-heart");
	
	//Change color of icon if liked
	var xhr2 = new XMLHttpRequest();
	xhr2.open('POST', 'check_like_status.php'); 
	xhr2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr2.onreadystatechange = function() {
			if (xhr2.readyState === XMLHttpRequest.DONE) {
				if (xhr2.status === 200) {
        
					alreadyLiked = xhr2.responseText == '1';
					if(alreadyLiked){
						btnText.style.color = "red";
					}
				} else {
					console.error('Error checking like status: ' + xhr2.status);
				}
			}
	};
	var userElement = document.querySelector('.user-name span');
	var userName = userElement.textContent;
	xhr2.send('post_id=' + post.idOfPost + '&email=' + userName);
	likeButton.appendChild(btnText);
	
	//Likes and Button
	var likesButton = document.createElement("div");
	likesButton.classList.add("likesButton");
	likesButton.appendChild(likeButton);
	likesButton.appendChild(likeOfPosts);

	//Append everything to post
	postDiv.appendChild(profileDelete);
	postDiv.appendChild(titleDate);
	postDiv.appendChild(contentParagraph);
	postDiv.appendChild(likesButton);
	postDiv.appendChild(document.createElement("hr"));
	
	//Appen div to div
	postsContainer.appendChild(postDiv);
}

function profileLoadFunc(){
	if (!profileLoad) {
		var params1 = new URLSearchParams(location.search);
		var idOfPostToSend1 = params1.get('idOfPost');
		if (idOfPostToSend1 == null) { var emailOfUser1 = new URLSearchParams(location.search).get('emailUser');}
		var profileContainer = document.getElementById('profileContainer');
		profileLoad = true;
		
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'fetchUser.php'); 
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onreadystatechange = function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			
            var profile = JSON.parse(xhr.responseText);
				if (profile.length > 0) {
					profile.forEach(function(profileA) {
					
						//Go Back Button
						var goBackButton = document.createElement("button");
						goBackButton.classList.add("back");
						var arrow = document.createElement("i");
						arrow.classList.add("arrow", "left"); 
						goBackButton.addEventListener("click", () => {
							history.back();
						});

						goBackButton.appendChild(arrow);
					
						//Name
						var UserNameOfPosts = document.createElement("h3");
						UserNameOfPosts.classList.add("post-name");
						UserNameOfPosts.textContent = profileA.username;
					
						//Number Of Posts
						var numberOfPosts = document.createElement("p");
						numberOfPosts.textContent = "Posts: " + profileA.postsNumber;
						numberOfPosts.classList.add("post-date");
						
						//Name + Post
						var namePost = document.createElement("div");
						namePost.classList.add("namePost");
						namePost.appendChild(UserNameOfPosts);
						namePost.appendChild(numberOfPosts);
						
						//Image
						var profilePic = document.createElement("img");
						profilePic.src = "pfp.jpg";
						profilePic.classList.add("pfp");
					
						var profileDiv = document.createElement("div");
						profileDiv.classList.add("profile");
						profileDiv.appendChild(profilePic);
						profileDiv.appendChild(namePost);
					
						//hr
						var hrLine = document.createElement("hr");
						hrLine.classList.add("phr");
						
						profileContainer.appendChild(goBackButton);
						profileContainer.appendChild(profileDiv);
						profileContainer.appendChild(hrLine);
					});
				} 
			} 
		};
		
		if (idOfPostToSend1 != null) {
			xhr.send('id_post_email=' + idOfPostToSend1);
		} else { xhr.send('email_user=' + emailOfUser1); } 
	}
}

// Initial load of posts when the page loads
window.onload = function() {
	profileLoadFunc();
    loadMorePosts();
};