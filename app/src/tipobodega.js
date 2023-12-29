const app = new (function () {
  this.tipobodega_id = document.getElementById("tipobodega_id");
  this.tipobodega_especificacion = document.getElementById(
    "tipobodega_especificacion"
  );
  this.tipobodega_capacidad = document.getElementById("tipobodega_capacidad");
  this.tipobodega = document.getElementById("tipobodega");

  this.listadoTipoBodega = () => {
    fetch("../controllers/tipobodega/listadoTipobodega.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html += "<th>Logo</th><th>Detalle tipo bodega</th><th>Opciones</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        data.forEach((element) => {
          html += "<tr>";
          html +=
            "<td><center><img src='../../public/images/description.png' alt='logo tipo bodegas' width='50px'></center></td>";
          html +=
            "<td><strong>Descripción bodega: " +
            element.tipobodega_especificacion +
            "</strong><br/><i>Capacidad bodega: " +
            element.tipobodega_capacidad +
            "</i></td>";
          html +=
            "<td><button type='button' class='btn btn-info btn-sm' title='Editar' onClick='app.editar(" +
            element.tipobodega_id +
            ")'><i class='fas fa-pencil-alt'></i></button></td>";
        });
        html +=
          "</tr></tbody><tfoot><tr><th>Logo</th><th>Detalle tipo bodega</th><th>Opciones</th></tr></tfoot></table>";
        this.tipobodega.innerHTML = html;
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
              this.listadoTipoBodega();
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
  this.editar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/tipobodega/obtenerTipobodega.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"](
          "Esta en modo de actualizar datos, solo puede modificar un dato..!"
        );
        this.tipobodega_id.value = data.tipobodega_id;
        this.tipobodega_especificacion.value = data.tipobodega_especificacion;
        this.tipobodega_capacidad.value = data.tipobodega_capacidad;
      })
      .catch((error) => console.error(error));
  };
  this.limpiarInputs = () => {
    this.tipobodega_id.value = "";
    this.tipobodega_especificacion.value = "";
    this.tipobodega_capacidad.value = "";
    this.tipobodega_especificacion.focus();
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
app.listadoTipoBodega();
