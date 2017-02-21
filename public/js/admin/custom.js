

$(document).ready(function(){
 $('#smsForm').on('submit', function(e){
      alert('hello');
        e.preventDefault();
        var phoneNumber = $('#phoneNumber').val();
        var text = $('#text').val();
        
        console.log(phoneNumber);
        console.log(text);
        
        
    });
});