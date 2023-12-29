const app = new (function () {
  this.pto_emision_id = document.getElementById("pto_emision_id");
  this.nombre_ptoemision = document.getElementById("nombre_ptoemision");
  this.codigo_ptemision = document.getElementById("codigo_ptemision");
  this.secuenciaF_ptoemision = document.getElementById("secuenciaF_ptoemision");
  this.secuecianotav_ptoemision = document.getElementById(
    "secuecianotav_ptoemision"
  );
  this.secuencia_reserva = document.getElementById("secuencia_reserva");
  this.secuencial_proforma=document.getElementById("secuencial_proforma");
  this.ambiente_ptoemision = document.getElementById("ambiente_ptoemision");
  this.estado_ptroemision = document.getElementById("estado_ptroemisions");
  //todo:talba nombre llenado de datos
  this.ptoemision = document.getElementById("ptoemision");
  //todo:establecimiento
  this.ptoemision_establecimiento = document.getElementById(
    "ptoemision_establecimiento"
  );
  //todo::bodegas
  this.bodega_puntoemision = document.getElementById("bodega_puntoemision");

  this.listadoPtoemision = () => {
    fetch("../controllers/ptoemision/listadoPtoemision.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html += "<th>Id</th><th>Detalle PtoEmision</th><th>Opciones</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        data.forEach((element) => {
          html += "<tr>";
          html += "<td><strong>" + element.id + "</strong></td>";
          html +=
            "<td><strong>Nombre: " +
            element.nombre.toUpperCase() +
            "</strong><br/><i>Dirección: " +
            element.codigo +
            "</i><br/><i>Telefono: " +
            element.activo +
            "</i></td>";
          html +=
            "<td><button type='button' class='btn btn-info btn-sm' title='Editar' onClick='app.editar(" +
            element.id +
            ")'><i class='fas fa-pencil-alt'></i><button type='button' class='btn btn-danger btn-sm' title='Eliminar' onClick='app.eliminar(" +
            element.id +
            ")'><i class='fas fa-trash'></i></td>";
        });
        html +=
          "</tr></tbody><tfoot><tr><th>Id</th><th>Detalle PtoEmision</th><th>Opciones</th></tr></tfoot></table>";
        this.ptoemision.innerHTML = html;
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
    const form = new FormData(document.getElementById("puntoemisionform"));
    if (this.validacionInputPtoEmision(form) === true) {
      if (this.pto_emision_id.value === "") {
        fetch("../controllers/ptoemision/guardarPuntoEmision.php", {
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
              this.listadoPtoemision();
            } else if (data === 1) {
              toastr["error"](
                "El nombre del punto de emision  ya existe, debe escribir otro..!"
              );
              this.nombre_ptoemision.focus();
            }
          })
          .catch((error) => console.error(error));
      } else {
        fetch("../controllers/ptoemision/actualizarptoEmision.php", {
          method: "POST",
          body: form,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === 1) {
              Swal.fire(
                "Registrado!",
                "Su información se actualizo correctamente!",
                "success"
              );
              this.limpiarInputs();
              this.listadoPtoemision();
            } else if (data === 2) {
              toastr["error"](
                "El nombre sucursal ya existe, debe escribir otro..!"
              );
              this.nombre_ptoemision.focus();
            }
          })
          .catch((error) => console.error(error));
      }
    }
  };
  this.editar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/ptoemision/obtenerPtoemision.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"](
          "Esta en modo de actualizar datos, solo puede modificar un dato..!"
        );
        this.pto_emision_id.value = data.id;
        this.nombre_ptoemision.value = data.nombre;
        this.codigo_ptemision.value = data.codigo;
        this.secuenciaF_ptoemision.value = data.secuencialFactura;
        this.secuecianotav_ptoemision.value = data.secuencialLiquidacionCompra;
        this.secuencial_proforma.value=data.secuencial_proforma;
        $("#ambiente_ptoemision")
          .val(data["establecimiento_id"])
          .trigger("change");
        this.secuencia_reserva.value = data.secuencia_reserva;
        this.nombre_ptoemision.focus();
      })
      .catch((error) => console.error(error));
  };
  this.eliminar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    Swal.fire({
      title: "¿Esta seguro de eliminar este punto de emision?",
      text: "Se eliminará por completo de los registro..!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si",
    }).then((result) => {
      if (result.isConfirmed) {
        fetch("../controllers/ptoemision/eliminarPtoEmision.php", {
          method: "POST",
          body: formId,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              Swal.fire("Eliminado!", "Punto Emision eliminada.", "success");
              this.listadoUbicacion();
            }
          })
          .catch((error) => console.error(error));
      }
    });
  };
  this.validacionInputPtoEmision = (formInput) => {
    if (formInput.get("nombre_ptoemision") === "") {
      toastr["warning"]("La Nombre es requerida, debe escribir uno..!");
      document.getElementById("nombre_ptoemision").focus();
      return false;
    } else if (formInput.get("codigo_ptemision") === "") {
      toastr["warning"]("El nombre es requerido, debe escribir uno..!");
      document.getElementById("codigo_ptemision").focus();
      return false;
    } else if (formInput.get("secuenciaF_ptoemision") === "") {
      toastr["warning"]("El telefono es requerido, debe escribir uno..!");
      document.getElementById("secuenciaF_ptoemision").focus();
      return false;
    } else {
      return true;
    }
  };
  this.limpiarInputs = () => {
    this.nombre_ptoemision.value = "";
    this.codigo_ptemision.value = "";
    this.secuenciaF_ptoemision.value = "";
    this.secuecianotav_ptoemision.value = "";
    this.secuencial_proforma.value="";
    this.secuencia_reserva.value="";
    this.pto_emision_id.value="";
    $("#ambiente_ptoemision").val("Seleccione").trigger("change");
    this.nombre_ptoemision.focus();
  };
  this.listarEstablecimiento = () => {
    fetch("../controllers/ptoemision/mostrarEstablecimiento.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='ambiente_ptoemision' id='ambiente_ptoemision' autofocus required onChange='app.obternerBodegas()'>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.estable_id +
            "'>" +
            element.estable_nombre +
            "</option>";
        });
        html += "</select>";
        this.ptoemision_establecimiento.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  this.obternerBodegas = () => {
    var select = document.getElementById("ambiente_ptoemision");
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
        this.bodega_puntoemision.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
})();
app.listadoPtoemision();
app.listarEstablecimiento();
