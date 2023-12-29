const app = new (function () {
  this.usuario_dni = document.getElementById("usuario_dni");
  this.usuario_nombres = document.getElementById("usuario_nombres");
  this.usuario_telefono = document.getElementById("usuario_telefono");
  this.usuario_direccion = document.getElementById("usuario_direccion");
  this.usuario_email = document.getElementById("usuario_email");
  this.usuario_password = document.getElementById("usuario_password");
  this.password = document.getElementById("password");
  this.usuario_identificador = document.getElementById("usuario_identificador");
  this.selectorAcceso = document.getElementById("selectorAcceso");
  this.selectorSucursal = document.getElementById("selectorSucursal");
  this.ubicacion_bodega_r = document.getElementById("ubicacion_bodega_o");
  this.usuarios = document.getElementById("usuarios");
  this.listadoUsuarios = () => {
    fetch("../controllers/usuario/listadoUsuario.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html +=
          "<th>Acceso</th><th>Datos personales</th><th>Cuenta</th><th>Estado</th><th>Opciones</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        permisos = data.permisosMod;
        data = data.data;
        data.forEach((element) => {
          html += "<tr>";
          html +=
            "<td> <strong>" + element.acceso_descripcion + "</strong> </td>";
          html +=
            "<td><i>CI: " +
            element.usuario_dni +
            "</i><br/><strong>Nombres: " +
            element.usuario_nombres.toUpperCase() +
            "</strong><br/><u>Telefono: " +
            element.usuario_telefono +
            "</u><br/><strong>Direccion: " +
            element.usuario_direccion +
            "</strong></td>";
          html +=
            "<td><i>Sucursal: " +
            element.sucursal_provincia +
            " - " +
            element.sucursal_nombre +
            "</i><br/><i>Bodega: " +
            element.bodega_descripcion +
            "</i><br/><i>Email: " +
            element.usuario_email +
            "</i><br/><strong>Contraseña: " +
            element.usuario_password +
            "</strong></td>";
          if (element.usuario_estado === "A") {
            html += "<td><span class='badge badge-success'>Activo</span></td>";
          } else {
            html += "<td><span class='badge badge-danger'>Inactivo</span></td>";
          }
          html += "<td>";
          if (element.usuario_estado === "A") {
            if (permisos["d"] === "1") {
              html +=
                "<button type='button' class='btn btn-danger btn-sm' style='border-radius: 50%;width: 41px;height: 41px; margin: 0% 2%;' title='Inactivar' onClick='app.inactivar(" +
                element.usuario_id +
                ")'><i class='fas fa-eye-slash'></i></button>";
            }
            if (permisos["u"] === "1") {
              html +=
                "<button type='button' class='btn btn-success btn-sm' style='border-radius: 50%;width: 41px;height: 41px;margin: 0% 2%; background: #38add0;border-color: #38add0;' title='Editar' onclick=app.editar(" +
                element.usuario_id +
                ")><i class='fas fa-edit'></i></button>";
            }
          } else {
            if (permisos["d"] === "1") {
              html +=
                "<button type='button' style='border-radius: 50%;width: 41px;height: 41px; margin: 0% 2%;' class='btn btn-success btn-sm' title='Activar' onclick=app.activar(" +
                element.usuario_id +
                ")><i class='fas fa-eye'></i></button>";
            }
            if (permisos["u"] === "1") {
              html +=
                "<button type='button' class='btn btn-success btn-sm' style='border-radius: 50%;width: 41px;height: 41px;margin: 0% 2%; background: #38add0;border-color: #38add0;' title='Activar' onclick=app.editar(" +
                element.usuario_id +
                ")><i class='fas fa-edit'></i></button>";
            }
          }
          html += "</td>";
          /*
          html +=
            "<td><button type='button' class='btn btn-danger btn-sm' style='border-radius: 50%;width: 41px;height: 41px;margin: 0% 2%;' title='Inactivar' onClick='app.inactivar(" +
            element.usuario_id +
            ")'><i class='fas fa-eye-slash'></i></button><button type='button' style='border-radius: 50%;width: 41px;height: 41px;' class='btn btn-success btn-sm' title='Activar' onclick=app.activar(" +
            element.usuario_id +
            ")><i class='fas fa-eye'></i></button><button type='button' class='btn btn-success btn-sm' style='border-radius: 50%;width: 41px;height: 41px;margin: 0% 2%; background: #38add0;border-color: #38add0;' title='Activar' onclick=app.activar(" +
            element.usuario_id +
            ")><i class='fas fa-edit'></i></button></td>";
*/
        });

        html +=
          "</tr></tbody><tfoot><tr><th>Acceso</th><th>Datos personales</th><th>Cuenta</th><th>Estado</th><th>Opciones</th></tr></tfoot></table>";
        this.usuarios.innerHTML = html;
        $("#example1").DataTable({
          language: {
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados en su búsqueda",
            searchPlaceholder: "Buscar registros",
            search: "Buscar:",
            info: "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            infoEmpty: "No existen registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            paginate: {
              first: "Primero",
              last: "Último",
              next: "Siguiente",
            },
          },
        });
      })
      .catch((error) => console.error(error));
  };

  this.editar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/usuario/obtenerUsuario.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"]("Esta en modo actualizar datos..!");
        this.usuario_identificador.value = data.usuario_id;
        $("#sucursal_id").val(data["sucursal_id"]).trigger("change");
        $("#bodega_id").val(data["bodega_id"]).trigger("change");
        $("#acceso_id").val(data["acceso_id"]).trigger("change");
        this.usuario_dni.value = data.usuario_dni;
        this.usuario_nombres.value = data.usuario_nombres;
        this.usuario_telefono.value = data.usuario_telefono;
        this.usuario_direccion.value = data.usuario_direccion;
        this.usuario_email.value = data.usuario_email;

        this.usuario_dni.focus();
      })
      .catch((error) => console.error(error));
  };

  this.activar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/usuario/estadoUsuario.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data === false) {
          fetch("../controllers/usuario/activarUsuario.php", {
            method: "POST",
            body: formId,
          })
            .then((response) => response.json())
            .then((data) => {
              if (data === true) {
                toastr["success"](
                  "El estado del usuario se ha activado correctamente!"
                );
                this.listadoUsuarios();
              }
            })
            .catch((error) => console.error(error));
        } else {
          toastr["info"](
            "El estado de este usuario ya esta activo, debe elegir otro..!"
          );
        }
      })
      .catch((error) => console.error(error));
  };
  this.inactivar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/usuario/estadoUsuario.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data === true) {
          Swal.fire({
            title: "¿Esta seguro de inactivar el usuario?",
            text: "El usuario no podrá ingresar al sistema..!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si",
          }).then((result) => {
            if (result.isConfirmed) {
              fetch("../controllers/usuario/inactivarUsuario.php", {
                method: "POST",
                body: formId,
              })
                .then((response) => response.json())
                .then((data) => {
                  if (data === true) {
                    Swal.fire(
                      "Actualizado!",
                      "Usuario esta inactivo.",
                      "success"
                    );
                    this.listadoUsuarios();
                  }
                })
                .catch((error) => console.error(error));
            }
          });
        } else {
          toastr["error"](
            "El estado de este usuario ya esta inactivo, debe elegir otro..!"
          );
        }
      })
      .catch((error) => console.error(error));
  };
  this.guardar = () => {
    const form = new FormData(document.getElementById("usuarioform"));
    if (this.validacionInputUsuario(form) === true) {
      if (this.usuario_identificador.value === "") {
        fetch("../controllers/usuario/guardarUsuario.php", {
          method: "POST",
          body: form,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              Swal.fire(
                "Registrado!",
                "Su información se guardo correctamente!",
                "success"
              );
              this.limpiarInputs();
              this.listadoUsuarios();
            } else if (data === 1) {
              toastr["error"](
                "El campo cédula/ruc ya existe, debe escribir otro..!"
              );
              this.usuario_dni.focus();
            } else if (data === 2) {
              toastr["error"](
                "El campo email ya existe, debe escribir otro..!"
              );
              this.usuario_email.focus();
            }
          })
          .catch((error) => console.error(error));
      } else {
        fetch("../controllers/usuario/actualizarUsuario.php", {
          method: "POST",
          body: form,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              Swal.fire(
                "Actualizado!",
                "Su información se actualizo correctamente!",
                "success"
              );
              this.limpiarInputs();
              this.listadoUsuarios();
            } else if (data === 1) {
              toastr["error"](
                "El ruc del usuario ya existe, debe escribir otro..!"
              );
              this.usuario_dni.focus();
            } else if (data === 2) {
              toastr["error"](
                "El email del usuario ya existe, debe escribir otro..!"
              );
              this.usuario_email.focus();
            }
          })
          .catch((error) => console.error(error));
      }
    }
  };
  this.listarTipoAcceso = () => {
    fetch("../controllers/acceso/mostrarAcceso.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='acceso_id' id='acceso_id' required>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.acceso_id +
            "'>" +
            element.acceso_descripcion +
            "</option>";
        });
        html += "</select>";
        this.selectorAcceso.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  this.listarTipoSucursal = () => {
    fetch("../controllers/sucursal/listadoSucursal.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='sucursal_id' id='sucursal_id' autofocus required onChange='app.obtenerValor()'>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.sucursal_id +
            "'>" +
            element.sucursal_provincia +
            " - " +
            element.sucursal_nombre;
          ("</option>");
        });
        html += "</select>";
        this.selectorSucursal.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  this.obtenerValor = () => {
    var select = document.getElementById("sucursal_id");
    const formId = new FormData();
    formId.append("id", select.value);
    fetch("../controllers/bodega/obtenerBodegaReferencia.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='bodega_id' id='bodega_id' required >";
        // html +=
        //   "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.bodega_id +
            "'>" +
            element.bodega_descripcion +
            " - " +
            element.tipobodega_especificacion +
            " - " +
            element.tipobodega_capacidad;
          ("</option>");
        });
        html += "</select>";
        this.ubicacion_bodega_r.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  this.validacionInputUsuario = (formInput) => {
    if (formInput.get("sucursal_id") === null) {
      toastr["warning"]("La sucursal es requerido, debe elegir uno..!");
      document.getElementById("sucursal_id").focus();
      return false;
    } else if (formInput.get("acceso_id") === null) {
      toastr["warning"](
        "El tipo de acceso o rol es requerido, debe elegir uno..!"
      );
      document.getElementById("acceso_id").focus();
      return false;
    } else if (formInput.get("usuario_dni") === "") {
      toastr["warning"]("El campo dni es requirido, debe escribir uno..!");
      this.usuario_dni.focus();
      return false;
    } else if (formInput.get("usuario_nombres") === "") {
      toastr["warning"]("El campo nombres es requirido, debe escribir uno..!");
      this.usuario_nombres.focus();
      return false;
    } else if (formInput.get("usuario_telefono") === "") {
      toastr["warning"]("El campo telefono es requirido, debe escribir uno..!");
      this.usuario_telefono.focus();
      return false;
    } else if (formInput.get("usuario_email") === "") {
      toastr["warning"]("El campo email es requirido, debe escribir uno..!");
      this.usuario_email.focus();
      return false;
    } else if (this.validarEmail(formInput.get("usuario_email")) === false) {
      this.validarEmail(formInput.get("usuario_email"));
      toastr["warning"](
        "El campo no es tipo email, debe escribir uno valido..!"
      );
      this.usuario_email.focus();
      return false;
    } else if (formInput.get("password") === "") {
      toastr["warning"]("El campo password es requirido, debe escribir uno..!");
      this.password.focus();
      return false;
    } else if (formInput.get("usuario_password") === "") {
      toastr["warning"](
        "El campo repetir password es requirido, debe escribir uno..!"
      );
      this.usuario_password.focus();
      return false;
    } else if (
      formInput.get("usuario_password") !== formInput.get("password")
    ) {
      toastr["error"]("Las contraseñas no son iguales, deben ser iguales..!");
      this.usuario_password.focus();
      return false;
    } else {
      return true;
    }
  };
  this.validarEmail = (email) => {
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if (emailRegex.test(email)) {
      return true;
    } else {
      return false;
    }
  };
  this.limpiarInputs = () => {
    this.usuario_dni.value = "";
    this.usuario_nombres.value = "";
    this.usuario_telefono.value = "";
    this.usuario_email.value = "";
    this.usuario_direccion.value = "";
    this.usuario_password.value = "";
    this.password.value = "";
    $("#acceso_id").val("Seleccione").trigger("change");
    $("#sucursal_id").val("Seleccione").trigger("change");
    document.getElementById("sucursal_id").focus();
  };
})();
app.listarTipoAcceso();
app.listarTipoSucursal();
app.listadoUsuarios();
