$(document).ready(function(){
  
    $('form').validate();

    $('#password, #passwordConfirm').on('keyup', function() {
      if ($('#password').val() == $('#passwordConfirm').val()) {
        $('#message').html('Matching').css('color', 'green');
        $('#submit').prop('disabled', false);
        $('#submit').css('background-color','rgb(60, 141, 188)');
        $('#submit').css('color','white');

      } else {
        $('#message').html('Not Matching').css('color', 'red');
        $('#submit').prop('disabled', true);
        $('#submit').css('background-color','rgb(60, 141, 188,0.0)');
        $('#submit').css('color','black');
      }
    });

    $(document).on('click','#submit', function(){
        document.getElementById('#password,#passwordConfirm,currentpassword').value = '';
    })
});