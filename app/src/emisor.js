const app = new (function () {
  this.emisor_id = document.getElementById("emisor_id");
  this.emisor_ruc = document.getElementById("emisor_ruc");
  this.emisor_razon_social = document.getElementById("emisor_razon_social");
  this.emisor_ncomercial = document.getElementById("emisor_ncomercial");
  this.emisor_ambiente = document.getElementById("emisor_ambiente");
  this.emisor_direcion = document.getElementById("emisor_direcion");
  this.emisor_tipoEmision = document.getElementById("emisor_tipoEmision");
  this.emisor_obligadoContabilidad = document.getElementById(
    " emisor_obligadoContabilidad"
  );
  this.emisor_contribuyenteEspecial = document.getElementById(
    "emisor_contribuyenteEspecial"
  );
  this.emisor_resolucionAgenteRetencion = document.getElementById(
    "emisor_resolucionAgenteRetencion"
  );
  this.emisor_passFirma_first = document.getElementById(
    "emisor_passFirma_first"
  );
  this.emisor_passFirma_second = document.getElementById(
    "emisor_passFirma_second"
  );
  this.emisor_regimenRimpe = document.getElementById("emisor_regimenRimpe");
  this.emisor_logo = document.getElementById("emisor_logo");
  this.emisor_firma = document.getElementById("emisor_firma");

  //todo: add tablas
  this.emisor = document.getElementById("emisor");
  //todo::sucursal
  this.sucursal_emisor = document.getElementById("sucursal_emisor");

  this.listadoEmisor = () => {
    fetch("../controllers/emisor/listadoEmisor.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html +=
          "<th>Nombre Comercial</th><th>Detalle emisor</th><th>Opciones</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        data.forEach((element) => {
          html += "<tr>";
          html += "<td><strong>" + element.nombreComercial + "</strong></td>";
          html +=
            "<td><strong>Razon Social: " +
            element.razonSocial.toUpperCase() +
            "</strong><br/><i>Dirección: " +
            element.direccionMatriz +
            "</i><br/><i>Ruc: " +
            element.ruc +
            "</i></td>";
          html +=
            "<td><button type='button' class='btn btn-info btn-sm' title='Editar' onClick='app.editar(" +
            element.id +
            ")'><i class='fas fa-pencil-alt'></i><button type='button' class='btn btn-danger btn-sm' title='Eliminar' onClick='app.eliminar(" +
            element.id +
            ")'><i class='fas fa-trash'></i></td>";
        });
        html +=
          "</tr></tbody><tfoot><tr><th>Provincia</th><th>Detalle sucursal</th><th>Opciones</th></tr></tfoot></table>";
        this.emisor.innerHTML = html;
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
  this.guardar = () => {
    const form = new FormData(document.getElementById("emisorform"));
    if (this.validacionInputEmisor(form) === true) {
      if (this.emisor_id.value === "") {
        fetch("../controllers/emisor/guardarEmisor.php", {
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
              this.listadoEmisor();
            } else if (data === 1) {
              toastr["error"](
                "El ruc del  emisor  ya existe, debe escribir otro..!"
              );
              this.emisor_razon_social.focus();
            } else if (data === 2) {
              toastr["error"]("La contraseñas no coinciden !");
              this.emisor_passFirma_first.focus();
            } else if (data === 3) {
              toastr["error"](
                "La Sucursal esta asiganad a otro emisor elija otro por favor !"
              );
            }
          })
          .catch((error) => console.error(error));
      } else {
        fetch("../controllers/sucursal/actualizarController.php", {
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
              this.listadoEmisor();
            } else if (data === 1) {
              toastr["error"](
                "El nombre sucursal ya existe, debe escribir otro..!"
              );
              this.emisor_razon_social.focus();
            }
          })
          .catch((error) => console.error(error));
      }
    }
  };
  this.editar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/emisor/obternetEmisor.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"](
          "Esta en modo de actualizar datos, solo puede modificar un dato..!"
        );
        this.emisor_id.value = data.id;
        this.emisor_ruc.value = data.ruc;
        this.emisor_razon_social.value = data.razonSocial;
        this.emisor_direcion.value = data.direccionMatriz;
        this.emisor_ncomercial.value = data.nombreComercial;
        this.emisor_ruc.focus();
      })
      .catch((error) => console.error(error));
  };
  this.eliminar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    Swal.fire({
      title: "¿Esta seguro de eliminar este producto de esta Emisor?",
      text: "Se eliminará por completo de los registro..!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si",
    }).then((result) => {
      if (result.isConfirmed) {
        fetch("../controllers/emisor/eliminarEmisor.php", {
          method: "POST",
          body: formId,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              Swal.fire("Eliminado!", "Emisor  eliminada.", "success");
              this.listadoEmisor();
            }
          })
          .catch((error) => console.error(error));
      }
    });
  };
  this.validacionInputEmisor = (formInput) => {
    if (formInput.get("emisor_ruc") === "") {
      toastr["warning"](
        "La ruc del emisor  es requerida, debe escribir uno..!"
      );
      document.getElementById("emisor_ruc").focus();
      return false;
    } else if (formInput.get("emisor_razon_social") === "") {
      toastr["warning"]("La razon social es requerido, debe escribir uno..!");
      document.getElementById("emisor_razon_social").focus();
      return false;
    } else if (formInput.get("emisor_direcion") === "") {
      toastr["warning"](
        "La direccion del emisor  es requerido, debe escribir uno..!"
      );
      document.getElementById("emisor_direcion").focus();
      return false;
    } else {
      return true;
    }
  };
  this.limpiarInputs = () => {
    this.emisor_id.value = "";
    this.emisor_ruc.value = "";
    this.emisor_ncomercial.value = "";
    this.emisor_direcion.value = "";
    this.ambiente.value = "";
    this.emisor_contribuyenteEspecial.value = "";
    this.emisor_resolucionAgenteRetencion.value = "";
    this.emisor_passFirma_first.value = "";
    this.emisor_passFirma_second.value = "";
    this.emisor_regimenRimpe.getAttribute = "";
    this.emisor_logo.value = "";
    this.emisor_firma.value = "";
    this.emisor_ruc.focus();
  };
  this.listarTipoSucursal = () => {
    fetch("../controllers/sucursal/listadoSucursal.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='sucursal_id_d' id='sucursal_id_d' autofocus required >";
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
        this.sucursal_emisor.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
})();
app.listadoEmisor();
app.listarTipoSucursal();
