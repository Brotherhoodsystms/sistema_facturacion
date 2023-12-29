const app = new (function () {
  this.login_usuario = document.getElementById("username");
  this.login_password = document.getElementById("password");
  this.loginUser = () => {
    const form = new FormData(document.getElementById("loginform"));

    fetch("../controllers/login/login.php", {
      method: "POST",
      body: form,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.usuario_estado === "A") {
          //console.log(data);
          location.href = "../views/index.php";
          this.limpiarInputs();
        } else {
          toastr["error"]("El usuario o contraseña no son correctos!");

          //console.log("El campo categoria ya existe");

          this.login_usuario.focus();
        }
      })
      .catch((error) => console.error(error));
  };
  this.validacionInputUsuario = (formInput) => {
    if (formInput.get("username") === "" || formInput.get("password") === "") {
      toastr["warning"](
        "El campo categoria es requirido, debe escribir uno..!"
      );
      this.login_usuario.focus();
      return false;
    } else {
      return true;
    }
  };
  this.limpiarInputs = () => {
    this.login_usuario.value = "";
    this.login_password.focus();
  };
})();

//app.loginUser();ejecucion de
