const app = new (function () {
  this.ubicacion = document.getElementById("ubicacion");

  // ubicacion formulario modal
  this.ubicacion_id = document.getElementById("ubicacion_id");
  this.ubicacion_sucursal = document.getElementById("ubicacion_sucursal");
  this.ubicacion_sucursal_r = document.getElementById("ubicacion_sucursal_r");
  this.ubicacion_bodega = document.getElementById("ubicacion_bodega");
  this.ubicacion_bodega_r = document.getElementById("ubicacion_bodega_r");
  this.ubicacion_descripcion = document.getElementById("ubicacion_descripcion");
  this.ubicacion_descripcion_r = document.getElementById(
    "ubicacion_descripcion_r"
  );

  this.listadoUbicacion = () => {
    fetch("../controllers/ubicacion/listadoUbicacion.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html +=
          "<th>Logo</th><th>Detalle ubicación</th><th>Detalle Bodega</th><th>Detalle producto</th><th>Opciones</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        data.forEach((element) => {
          html += "<tr>";
          html +=
            "<td><center><img src='../../public/images/list.png' alt='logo box' width='30px'></center></td>";
          html +=
            "<td><strong>" + element.ubicacion_descripcion + "</strong></td>";
          html +=
            "<td><strong>Descripción: " +
            element.bodega_descripcion +
            "</strong><br/><strong>Especificación: " +
            element.tipobodega_especificacion +
            " - " +
            element.tipobodega_capacidad +
            "</strong><br/><strong>Sucursal: " +
            element.sucursal_provincia +
            " - " +
            element.sucursal_nombre;
          ("</strong></td>");
          html +=
            "<td><strong>Código: " +
            element.producto_codigoserial +
            "</strong><br/><strong>Descripción: " +
            element.producto_descripcion.toUpperCase() +
            "</strong><br/><strong>Stock: " +
            element.producto_stock +
            "</strong><br/><strong>Precio $: " +
            element.producto_precio +
            "</strong><br/><strong>Fecha elaboración: " +
            element.producto_fechaelaboracion +
            "</strong><br/><strong>Fecha expiración: " +
            element.producto_fechaexpiracion +
            "</strong></td>";
          html +=
            "<td><button type='button' class='btn btn-primary btn-sm' title='Editar' data-toggle='modal' data-target='#exampleModalUbicacion' onClick='app.editar(" +
            element.ubicacion_id +
            ")'><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-danger btn-sm' title='Eliminar' onClick='app.eliminar(" +
            element.ubicacion_id +
            ")'><i class='fas fa-trash-alt'></i></button></td>";
        });
        html +=
          "</tr></tbody><tfoot><tr><th>Logo</th><th>Detalle ubicación</th><th>Detalle Bodega</th><th>Detalle producto</th><th>Opciones</th></tr></tfoot></table>";
        this.ubicacion.innerHTML = html;
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
    Swal.fire({
      title: "¿Esta seguro de eliminar este producto de esta ubicación?",
      text: "Se eliminará por completo de los registro..!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si",
    }).then((result) => {
      if (result.isConfirmed) {
        fetch("../controllers/ubicacion/eliminarUbicacion.php", {
          method: "POST",
          body: formId,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              Swal.fire("Eliminado!", "Ubicación eliminada.", "success");
              this.listadoUbicacion();
            }
          })
          .catch((error) => console.error(error));
      }
    });
  };
  this.editar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/ubicacion/obtenerUbicacion.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"](
          "Esta en modo de actualizar datos, solo puede modificar un dato..!"
        );
        this.ubicacion_id.value = data.ubicacion_id;
        this.ubicacion_sucursal.value =
          data.sucursal_provincia + " - " + data.sucursal_nombre;
        this.ubicacion_bodega.value =
          data.bodega_descripcion +
          " - " +
          data.tipobodega_especificacion +
          " - " +
          data.tipobodega_capacidad;
        this.ubicacion_descripcion.value = data.ubicacion_descripcion;
        // $("#sucursal_id").val(data["sucursal_id"]).trigger("change");
        // $("#bodega_id").val(data["bodega_id"]).trigger("change");
        document.getElementById("sucursal_id").focus();
      })
      .catch((error) => console.error(error));
  };
  this.actualizarUbicacion = () => {
    const form = new FormData(document.getElementById("ubicacionform"));
    if (this.validacionInputModalUbicacion(form) === true) {
      fetch("../controllers/ubicacion/actualizarUbicacion.php", {
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
            $("#exampleModalUbicacion").modal("hide");
            document.getElementById("ubicacionform").reset();
            this.listadoUbicacion();
          } else if (data === 0) {
            toastr["error"](
              "Esa ubicación ya esta ocupada por un producto, debe escribir otro..!"
            );
            this.ubicacion_descripcion.focus();
          }
        })
        .catch((error) => console.error(error));
    }
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
        this.ubicacion_sucursal_r.innerHTML = html;
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

  this.validacionInputModalUbicacion = (formInput) => {
    if (formInput.get("sucursal_id") === null) {
      toastr["warning"]("La sucursal es requerida, debe elegir uno..!");
      document.getElementById("sucursal_id").focus();
      return false;
    } else if (formInput.get("ubicacion_bodega_r") === null) {
      toastr["warning"]("La bodega es requerida, debe elegir uno..!");
      document.getElementById("bodega_id").focus();
      return false;
    } else if (formInput.get("ubicacion_descripcion_r") === "") {
      toastr["warning"](
        "La campo descripción es requerida, debe escribir uno..!"
      );
      document.getElementById("ubicacion_descripcion_r").focus();
      return false;
    } else {
      return true;
    }
  };
})();
app.listadoUbicacion();
app.listarTipoSucursal();
