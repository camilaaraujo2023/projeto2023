
// document.getElementById("efetuaLogin").addEventListener("submit", function(event) {
//   event.preventDefault();

//   // Get the entered username and password - On login page
//   var enteredUsername = document.getElementById("loginNow").value;
//   var enteredPassword = document.getElementById("senhaNow").value;
//   //console.log(enteredUsername, enteredPassword);
//   // Get the stored username and password from localStorage
//   var storedUsername = localStorage.getItem("loginStored");
//   var storedPassword = localStorage.getItem("passwordStored");
//   //console.log(localStorage.getItem("loginStored"), localStorage.getItem("passwordStored"));
//   // Check if the entered username and password match the stored values
//   if (enteredUsername === storedUsername && enteredPassword === storedPassword) {
//     confirm("Bem vindo a Telecall!");
//     localStorage.setItem("loginValidado", enteredUsername)
//     // Redirect to the login page
//     window.location.href = "Principal.html";
//     // You can redirect to a different page here if needed
//   } else {
//     confirm("Falha no login, verifique sua senha!");
//     //console.log(enteredPassword, enteredUsername, storedPassword, storedUsername);
//   }
// });


function ajustaLoginSenha(v) {
    //Remove numeros
    v.value = v.value.replace(/\d+/g, '');
}

function showpass() {
  //Mostra senha
  var senha = document.getElementById("senhaNow");
  var botao = document.getElementById("eyebtn");

  if (senha.type == "password") {
    senha.type = "text";
    botao.classList.add("show")
  }
  else {
    senha.type = "password";
    botao.classList.remove("show")
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

