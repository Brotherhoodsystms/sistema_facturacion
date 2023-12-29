const app = new (function () {
  this.bodega_id = document.getElementById("bodega_id");
  this.bodega_descripcion = document.getElementById("bodega_descripcion");
  this.bodega = document.getElementById("bodegas");
  this.sucursal = document.getElementById("sucursal");
  this.tipobodega = document.getElementById("tipobodega");
  this.bodega_id_ubicacion = document.getElementById("bodega_id_ubicacion");
  this.tipobodega_id = document.getElementById("tipobodega_id");
  this.tipobodega_especificacion = document.getElementById(
    "tipobodega_especificacion"
  );
  this.tipobodega_capacidad = document.getElementById("tipobodega_capacidad");

  this.listadoBodega = () => {
    fetch("../controllers/bodega/listadoBodega.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html += "<th>Logo</th><th>Detalle Bodega</th><th>Opciones</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        permisos = data.permisosMod;
        data=data.data;
        data.forEach((element) => {
          html += "<tr>";
          html +=
            "<td><center><img src='../../public/images/bodega.png' alt='logo bodegas' width='50px'></center></td>";
          html +=
            "<td><strong>Bodega: " +
            element.bodega_descripcion.toUpperCase() +
            "</strong><br/><strong>Sucursal: " +
            element.sucursal_nombre +
            "</strong><br/><u>Provincia: " +
            element.sucursal_provincia +
            "</u><br/></td>";
            html += "<td>";
            if (permisos["u"] === "1") {
            html +=
            "<button type='button' class='btn btn-info btn-sm' style='border-radius:50%; margin: 0% 2%; width:40px; height:40px' title='Editar' onClick='app.editar(" +
            element.bodega_id +
            ")'><i class='fas fa-pencil-alt'></i></button>";
            }
            if (permisos["d"] === "1") {
              html +=
              "<button type='button' class='btn btn-danger btn-sm' style='border-radius:50%; width:40px; height:40px' title='Eliminar' onClick='app.eliminar(" +
              element.bodega_id +
              ")'><i class='fa fa-trash'></i></button>";
              }
            html += "</td>";
        });
        html +=
          "</tr></tbody><tfoot><tr><th>Logo</th><th>Detalle bodega</th><th>Opciones</th></tr></tfoot></table>";
        this.bodega.innerHTML = html;
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

  this.eliminar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/bodega/eliminarBodega.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data === true) {
          Swal.fire(
            "Eliminado!",
            "Bodega eliminada correctamente!",
            "success"
          );
          this.listadoBodega();
        } else {
          Swal.fire(
            "icon: 'error'",
            "title: 'Error'",
            "text: 'No se pudo eliminar la bodega'"
          );
          this.listadoProductos();
        }
      })
      .catch((error) => console.error(error));
  };

  this.guardar = () => {
    const form = new FormData(document.getElementById("bodegaform"));
    if (this.validacionInputBodega(form) === true) {
      if (this.bodega_id.value === "") {
        fetch("../controllers/bodega/guardarBodega.php", {
          method: "POST",
          body: form,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              Swal.fire(
                "Registrado!",
                "La bodega se guardo correctamente!",
                "success"
              );
              this.limpiarInputs();
              this.listadoBodega();
            } else if (data === 0) {
              toastr["error"](
                "Ese nombre de esa bodega ya existe, debe escribir otro..!"
              );
              this.bodega_descripcion.focus();
            }
          })
          .catch((error) => console.error(error));
      } else {
        fetch("../controllers/bodega/actualizarBodega.php", {
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
              this.listadoBodega();
            } else if (data === 0) {
              toastr["error"](
                "Esa nombre de esa bodega ya existe, debe escribir otro..!"
              );
              this.bodega_descripcion.focus();
            }
          })
          .catch((error) => console.error(error));
      }
    }
  };

  this.editar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/bodega/obtenerBodega.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"](
          "Esta en modo de actualizar datos, solo puede modificar un dato..!"
        );
        this.bodega_id.value = data.bodega_id;
        this.bodega_descripcion.value = data.bodega_descripcion;
        $("#sucursal_id").val(data["sucursal_id"]).trigger("change");
        document.getElementById("sucursal_id").focus();
      })
      .catch((error) => console.error(error));
  };

  this.validacionInputBodega = (formInput) => {
    if (formInput.get("sucursal_id") === null) {
      toastr["warning"]("La sucursal es requerida, debe elegir uno..!");
      document.getElementById("sucursal_id").focus();
      return false;
    } else if (formInput.get("bodega_descripcion") === null) {
      toastr["warning"]("El nombre de la bodega es requerida, debe escribir uno..!");
      document.getElementById("bodega_descripcion").focus();
      return false;
    } else {
      return true;
    }
  };

  this.listarTipoSucursal = () => {
    fetch("../controllers/sucursal/listadoSucursal.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='sucursal_id' id='sucursal_id' autofocus required>";
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
        this.sucursal.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };

  this.listarTipoBodega = () => {
    fetch("../controllers/tipobodega/listadoTipobodega.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='tipobodega_id' id='tipobodega_id' onChange='app.obtenerBodegai()' required>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.tipobodega_id +
            "'>" +
            element.tipobodega_especificacion +
            " - " +
            element.tipobodega_capacidad;
          ("</option>");
        });
        html += "</select>";
        this.tipobodega.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  this.obtenerBodegai = () => {
    var tipobodega_id = document.getElementById("tipobodega_id").value;
    //var producto_codigoserial = document.getElementById("producto_codigoserial").value;
    const formId = new FormData();
    formId.append("id", tipobodega_id);
    //formId.append("producto_codigoserial", producto_codigoserial);
    fetch("../controllers/tipobodega/obtenerTipobodega.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        this.bodega_descripcion.value = data.tipobodega_especificacion;
      })
      .catch((error) => console.error(error));
  };

  this.limpiarInputs = () => {
    this.bodega_id.value = "";
    this.bodega_descripcion.value = "";
    $("#sucursal_id").val("Seleccione").trigger("change");
    $("#tipobodega_id").val("Seleccione").trigger("change");
    document.getElementById("sucursal_id").focus();
    // document.getElementById("sucursal_id").removeAttribute("disabled");
  };
  //todos::controles de tipo de bodega
  this.ocultarDiv = () => {
    $("#div_descripcion").hide();
  };
  this.guardarT = () => {
    const form = new FormData(document.getElementById("tipobodegaform"));
    if (this.validacionInputTipoBodega(form) === true) {
      if (this.tipobodega_id.value === "") {
        fetch("../controllers/tipobodega/guardarTipobodega.php", {
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
            } else if (data === 0) {
              toastr["error"](
                "Esa capacidad ya existe en esa especificación, debe escribir otro..!"
              );
              this.tipobodega_capacidad.focus();
            }
          })
          .catch((error) => console.error(error));
      } else {
        fetch("../controllers/tipobodega/actualizarTipobodega.php", {
          method: "POST",
          body: form,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              Swal.fire(
                "Registrado!",
                "Su información se actualizo correctamente!",
                "success"
              );
              this.limpiarInputs();
              this.listadoTipoBodega();
            } else if (data === 0) {
              toastr["error"](
                "Esa información ya existe, debe escribir otro..!"
              );
              this.tipobodega_capacidad.focus();
            }
          })
          .catch((error) => console.error(error));
      }
    }
  };

  this.limpiarInputs = () => {
    this.bodega_id.value = "";
    this.bodega_descripcion.value = "";
    $("#sucursal_id").val("Seleccione").trigger("change");
    this.bodega_descripcion.focus();
  };
  this.validacionInputTipoBodega = (formInput) => {
    if (formInput.get("tipobodega_especificacion") === "") {
      toastr["warning"](
        "El campo especificación es requirido, debe escribir uno..!"
      );
      this.tipobodega_especificacion.focus();
      return false;
    } else if (formInput.get("tipobodega_capacidad") === "") {
      toastr["warning"](
        "El campo capcacidad es requirido, debe escribir uno..!"
      );
      this.tipobodega_capacidad.focus();
      return false;
    } else {
      return true;
    }
  };
})();
app.listadoBodega();
app.listarTipoSucursal();
//app.listarTipoBodega();
app.ocultarDiv();
