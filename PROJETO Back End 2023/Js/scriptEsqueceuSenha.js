function enviar(){

  var enteredUsername = document.getElementById("loginNow").value;
  var enteredEmail = document.getElementById("email")

  var storedUsername = localStorage.getItem("loginStored");

  if (enteredUsername === storedUsername && enteredEmail !== "") {
    confirm("Verifique seu Email!");
    window.location.href = "Login.html";

  }  else {
    confirm("Falha ao enviar, por favor verifique se o Login digitado está correto!");
}
}

//-------------DARKMODE-------------//

const $html = document.querySelector( "html" )
const dark = document.getElementById( 'darkmodebtn' );

dark.addEventListener( 'change', () => {
  $html.classList.toggle( 'dark' )
  $( ".bi" ).toggleClass( "bi-moon" )
  $( ".bi" ).toggleClass( "bi-sun" )

} );