$(document).ready(()=>{
    if (localStorage.getItem("loginValidado")){
    $(".username").text(localStorage.getItem("loginValidado"))
} else{
    $(".logout").css("display", "none")
}
})

function sair(){
    localStorage.removeItem("loginValidado")
    window.location.reload()
}