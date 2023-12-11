file:///D:/Desktop/telecall-clone-main/index.html
$("finish").click(function(){

});
function finalizar() {
document.getElementById("cadastraPessoa").addEventListener("submit", function(event) {
  event.preventDefault();

  // Get the username and password
  var login = document.getElementById("loginCadastro").value;
  var password = document.getElementById("senhaCadastro").value;

  // Store the login and password in localStorage
  localStorage.setItem("loginStored", login);
  localStorage.setItem("passwordStored", password);
  //console.log(login, password);
  //console.log(localStorage.getItem("loginStored"), localStorage.getItem("passwordStored"));
})};


function ajustaCpf(v) {
    v.value = v.value.replace(/\D/g, "");
    //Adiciona ponto após os três primeiros números
    v.value = v.value.replace(/^(\d{3})(\d)/, "$1.$2");
    //Adiciona ponto após os seis primeiros números
    v.value = v.value.replace(/(\d{3})(\d)/, "$1.$2");
    //Adiciona o hífen antes dos últimos 2 caracteres
    v.value = v.value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

}
  
function ajustaTelefone(v) {
    // Remove caracteres não numéricos
    telefone = v.value.replace(/[^\d]+/g, '');

 
}

function ajustaLoginSenha(v) {
    //Remove numeros
    v.value = v.value.replace(/\d+/g, '');
}

function comparaSenha() {
  var password = document.getElementById("senhaCadastro").value;
  var confirmPassword = document.getElementById("senhaOK").value;

  if (password !== confirmPassword) {
    var modal = document.getElementById("myModal");
    var modalMessage = document.getElementById("modal-message");
    modalMessage.textContent = "As senhas digitadas não conferem.";

    modal.style.display = "block";
    return false;
  }
  var modal = document.getElementById("myModal");
  var modalMessage = document.getElementById("modal-message");
  modalMessage.textContent = "Cadastro efetuado com sucesso! Efetue o seu login.";

  modal.style.display = "block";
  // Redirect to the login page
  setTimeout(()=>{
    window.location.href = "Login.html";
  }, 2000)
}

// Close the modal when the close button is clicked
document.getElementsByClassName("close")[0].addEventListener("click", function() {
  var modal = document.getElementById("myModal");
  modal.style.display = "none";
});

function checaCamposPreenchidos() {
  var form = document.getElementById("cadastraPessoa");
  var inputs = form.getElementsByTagName("input");
  var selects = form.getElementsByTagName("select");

  for (var i = 0; i < inputs.length; i++) {
    if (inputs[i].value.trim() === "") {
      alert("Por favor, preencha todos os campos.");
      return false;
    }
  }

  for (var j = 0; j < selects.length; j++) {
    if (selects[j].value === "nenhum") {
      alert("Por favor, selecione uma opção válida para o campo Sexo.");
      return false;
    }
  }

  return true;
}

function showpass() {
  //Mostra senha
  var senha = document.getElementById("senhaCadastro");
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
function showpass1() {
  //Mostra senha
  var senha = document.getElementById("senhaOK");
  var botao = document.getElementById("eyebtn2");

  if (senha.type == "password") {
    senha.type = "text";
    botao.classList.add("show")
  }
  else {
    senha.type = "password";
    botao.classList.remove("show")
  }
}

function limparCampos() {
  document.getElementById("cadastraPessoa").reset();
}
//-------------DARKMODE-------------//

const $html = document.querySelector( "html" )
const dark = document.getElementById( 'darkmodebtn' );

dark.addEventListener( 'change', () => {
  $html.classList.toggle( 'dark' )
  $( ".bi" ).toggleClass( "bi-moon" )
  $( ".bi" ).toggleClass( "bi-sun" )

} );
