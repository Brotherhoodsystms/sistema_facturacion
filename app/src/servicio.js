const app = new (function () {
  this.servicio_id = document.getElementById("servicio_id");
  this.servicio_fecha = document.getElementById("servicio_fecha");
  this.servicio_valor = document.getElementById("servicio_valor");
  this.servicio_detalle = document.getElementById("servicio_detalle");
  this.servicio = document.getElementById("servicio");
  this.selectorGasto = document.getElementById("selectorGasto");
  this.listadoServicios = () => {
    fetch("../controllers/servicio/mostrarServicio.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html +=
          "<th>Gasto</th><th>Fecha</th><th>Valor</th><th>Detalle</th><th>Opcion</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        data.forEach((element) => {
          html += "<tr>";
          html +=
            "<td> <strong>" + element.gasto_descripcion + "</strong></td>";
          html += "<td> <strong>" + element.servicio_fecha + "</strong></td>";
          html += "<td> <strong>" + element.servicio_valor + "</strong></td>";
          html += "<td> <strong>" + element.servicio_detalle + "</strong></td>";
          html +=
            "<td><button type='button' class='btn btn-info btn-sm' title='Editar' onClick='app.editar(" +
            element.servicio_id +
            ")'><i class='fas fa-pencil-alt'></i></button></td>";
        });
        html +=
          "</tr></tbody><tfoot><tr><th>Gasto</th><th>Fecha</th><th>Valor</th><th>Detalle</th><th>Opcion</th></tr></tfoot></table>";
        this.servicio.innerHTML = html;
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
  this.listarGastos = () => {
    fetch("../controllers/gasto/mostrarGasto.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='gasto_id' id='gasto_id' autofocus required>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.gasto_id +
            "'>" +
            element.gasto_descripcion;
          ("</option>");
        });
        html += "</select>";
        this.selectorGasto.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  this.guardar = () => {
    const form = new FormData(document.getElementById("servicioform"));
    if (this.validacionInputServicios(form) === true) {
      if (this.servicio_id.value === "") {
        fetch("../controllers/servicio/guardarServicio.php", {
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
              this.listadoServicios();
            }
          })
          .catch((error) => console.error(error));
      } else {
        fetch("../controllers/servicio/actualizarServicio.php", {
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
              this.listadoServicios();
            }
          })
          .catch((error) => console.error(error));
      }
    }
  };

  this.validacionInputServicios = (formInput) => {
    if (formInput.get("gasto_id") === null) {
      toastr["warning"]("El gasto es requerido, debe elegir uno..!");
      document.getElementById("gasto_id").focus();
      return false;
    } else if (formInput.get("servicio_fecha") === "") {
      toastr["warning"]("El campo fecha es requirida, debe escribir uno..!");
      this.servicio_fecha.focus();
      return false;
    } else if (formInput.get("servicio_valor") === "") {
      toastr["warning"]("El campo valor es requirido, debe escribir uno..!");
      this.servicio_valor.focus();
      return false;
    } else if (formInput.get("servicio_detalle") === "") {
      toastr["warning"](
        "El campo detalle servicio es requirido, debe escribir uno..!"
      );
      servicio_detalle.focus();
      return false;
    } else {
      return true;
    }
  };
  this.editar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/servicio/obtenerServicio.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"](
          "Esta en modo de actualizar datos, solo puede modificar un dato..!"
        );
        this.servicio_id.value = data.servicio_id;
        this.servicio_fecha.value = data.servicio_fecha;
        this.servicio_valor.value = data.servicio_valor;
        this.servicio_detalle.value = data.servicio_detalle;
        $("#gasto_id").val(data["gasto_id"]).trigger("change");
        document.getElementById("gasto_id").focus();
      })
      .catch((error) => console.error(error));
  };
  this.limpiarInputs = () => {
    this.servicio_id.value = "";
    this.servicio_fecha.value = "";
    this.servicio_valor.value = "";
    this.servicio_detalle.value = "";
    $("#gasto_id").val("Seleccione").trigger("change");
    document.getElementById("gasto_id").focus();
  };
})();
app.listarGastos();
app.listadoServicios();
