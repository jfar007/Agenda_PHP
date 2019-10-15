$(function(){
  var l = new Login();
})


class Login {
  constructor() {
    this.submitEvent()
  }

  submitEvent(){
    $('form').submit((event)=>{
      event.preventDefault()
      this.sendForm()
    })
  }

  sendForm(){
    let form_data = new FormData();
    form_data.append('usuario', $('#user').val());
    form_data.append('contrasena', $('#password').val());
    $.ajax({
      url: '../server/check_login.php',
      dataType: "json",
      cache: false,
      processData: false,
      contentType: false,
      data: form_data,
      type: 'POST',
      success: (php_response) =>{
				this.correct(php_response);
		},
      error: function(jqXHR, textStatus, errorThrown){
        alert("error en la comunicación con el servidor");
		console.log(jqXHR);
		console.log(textStatus);
		console.log(errorThrown);
      }
    })
  }

	correct(php_response){
	  if (php_response.msg == "OK") {
           window.location.href = 'main.html';
      }else {
         alert(php_response.msg);
       }
	}
}
