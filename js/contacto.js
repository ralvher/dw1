$(document).ready(function() {
  $('input').css('border-color','green');
  $('textarea').css('border-color','green');

  $( "#femail" ).focus(
    function() {
      $( this ).css('border-color', "green");
    }
  );
  $( "#fnombre" ).focus(
    function() {
      $( this ).css('border-color', "green");
    }
  );
  $( "#ftelefono" ).focus(
    function() {
      $( this ).css('border-color', "green");
    }
  );
  $( "#ftexto" ).focus(
    function() {
      $( this ).css('border-color', "green");
    }
  );
});

function comprobar(){
  nombre = $('#fnombre').val();
  email = $('#femail').val();
  telefono = $('#ftelefono').val();
  texto = $('#ftexto').val();
  error = false;
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) || email == ""){
      $('#femail').css('border-color', "red");
      error = true;
    }
    if(telefono == "" || isNaN(telefono) || telefono.length != 9){
      $('#ftelefono').css('border-color', "red");
      error = true;
    }
    if(texto == ""){
      $('#ftexto').css('border-color', "red");
      error = true;
    }
    expr2 = /[A-Za-z\s]/;
    if(nombre == "" ||  !expr2.test(nombre) ){
      $('#fnombre').css('border-color', "red");
      error = true;
    }

    if(error == false){
      document.contacto.submit();
    }
}
