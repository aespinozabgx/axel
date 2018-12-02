var form = document.getElementsByName("isform")[0];
var checkBox = document.getElementById("checkEmp");

checkBox.onchange = function(){
  if(this.checked){
    form.action = "funciones/iniciarSesion.php";
  }
  else{
    form.action = "funciones/iniciarSesionCliente.php";
  }
  console.log(form.action);
};
