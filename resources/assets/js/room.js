$(document).ready(function(){    
$("#roomstatus").change(function(){
  var value = $(this).val();
  if($('#roomstatus').val() == 'occupied'){
    $('#roomnumber').css('background','linear-gradient(to right,rgb(153, 1, 0),rgb(212, 0, 2))');
  }
  else if($('#roomstatus').val() == 'cleaning'){
    $('#roomnumber').css('background','linear-gradient(to right,rgb(12, 160, 204),rgb(6, 121, 186))');
  }
  else if($('#roomstatus').val() == 'available'){
    $('#roomnumber').css('background','linear-gradient(to right,rgb(0, 96, 21),rgb(0, 185, 48))');
  }
  else if($('#roomstatus').val() == 'maintenance'){
    $('#roomnumber').css('background','linear-gradient(to right,rgb(64, 64, 64),rgb(143, 143, 143))');
  }
});
});