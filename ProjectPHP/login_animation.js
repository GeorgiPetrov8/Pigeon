// Toggle Function
$('.toggle').click(function(){

  // Switches the forms  
  $('.form').animate({
    height: "toggle",
    'padding-top': 'toggle',
    'padding-bottom': 'toggle',
    opacity: "toggle"
  }, "slow");
  
});

//on input passowrd check
$('#pass2').on('input', function() {
        var pass1 = $('#pass1').val();
        var pass2 = $(this).val();

        // Check if passwords match
        if (pass1 !== pass2) {
          // Turn the input boxes red
          $('#pass1, #pass2').css('border-color', 'red');
        } else {
          // Reset the border color
          $('#pass1, #pass2').css('border-color', '');
        }
});
