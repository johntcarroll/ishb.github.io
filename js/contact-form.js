$(document).ready(function(){

  $('#validate').click(function(e){

    e.preventDefault();

    var inputs = $('.form-input');

    var counter = 0;
    var missing = [];
    for (var i = 0; i < inputs.length; i++) {
      var input = $(inputs[i]);
      input.removeClass('failure');

      if(input.hasClass('required')){
        if(input.val() == ""){
          input.addClass('failure');
          missing.push(input.attr('name'));
        }else{
          counter++;
        }
      }else{
        counter++;
      }
    }

    if(counter == 5){
      console.log('confirm');
      $('#captcha-modal').modal('show');
    }else{
      console.log('did not confirm');
      $('#modal-title').html('Please fill out all required fields.');
      $('#confirm-body').html(function(){
        var str = "Missing field(s): ";
        for (var i = 0; i < missing.length; i++) {
          str += missing[i];
          if(i != missing.length - 1){
            str += ", ";
          }
        }
        return str;
      });
      $('#confirm-modal').modal('show');
    }

  });

  $('.form-input').change(function(e){

    var input = $(this);

    if(input.hasClass('failure') && input.val() != ""){
      input.removeClass('failure');
    }else if (input.hasClass('success') && input.val() == "") {
      input.removeClass('success');
    }

  });

  $('#submit').click(function(){

    var contactForm = $('#contact-form').serialize();
    var captchaForm = $('#captcha-form').serialize();
    var formData = contactForm + "&" + captchaForm;

    console.log(formData);

    $('#loader').fadeIn();

    $.ajax({
      url: '/ajax/pipeline.php',
      type: 'get',
      data: formData,
      dataType: 'json',
      success: function(json){
        // console.log(json);
        if(json.error){
          $('#modal-title').html('Message failed to send.');
          $('#confirm-body').html(json.message);
        }else{
          $('#modal-title').html('Message successfully sent!');
          $('#confirm-body').html('Someone from our team will be in contact with you soon. We look forward to exploring a business opportunity with you.');
          var inputs = $('.form-input');
          for (var i = 0; i < inputs.length; i++) {
            inputs[i].value = "";
          }
        }
        $('#loader').fadeOut();
        $('#captcha-modal').modal('hide');
        $('#confirm-modal').modal('show');
      },
      error: function(){
        $('#modal-title').html('Message failed to send.');
        $('#confirm-body').html('Well this is embarrassing. Something seems to have gone wrong. It might be our fault, but if you could please check your internet connection and try again, we\'d really appreciate it.');
        $('#loader').fadeOut();
        $('#captcha-modal').modal('hide');
        $('#confirm-modal').modal('show');
      }
    });

  });

});
