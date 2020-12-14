$('#inpassword, #conpassword').on('keyup', function () {
	alert(ok);
  if ($('#inpassword').val() == $('#conpassword').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Not Matching').css('color', 'red');
});
