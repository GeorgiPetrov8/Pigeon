var textarea = document.getElementById('NewPost');
var charCount = document.getElementById('charCount');

var maxLength = 500;

textarea.addEventListener('input', function() {
  var count = textarea.value.length;
  var remaining = maxLength - count;
  
  charCount.textContent = 'Characters left: ' + remaining;
});
