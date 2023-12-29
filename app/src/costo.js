const app = new (function () {
  this.gasto_descripcion = document.getElementById("gasto_descripcion");
  this.costos = document.getElementById("costos");
  this.listadoCostos = () => {
    fetch("../controllers/costo/mostrarCosto.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html += "<th>Datos gasto</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        data.forEach((element) => {
          html += "<tr>";
          html +=
            "<td> <strong>" + element.gasto_descripcion + "</strong></td>";
        });
        html +=
          "</tr></tbody><tfoot><tr><th>Datos gasto</th></tr></tfoot></table>";
        this.costos.innerHTML = html;
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
    const form = new FormData(document.getElementById("costoform"));
    if (this.validacionInputCosto(form) === true) {
      fetch("../controllers/costo/guardarCosto.php", {
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
            this.listadoCostos();
          } else if (data === 1) {
            toastr["error"]("El campo costo ya existe, debe escribir otro..!");
            this.gasto_descripcion.focus();
          }
        })
        .catch((error) => console.error(error));
    }
  };
  this.validacionInputCosto = (formInput) => {
    if (formInput.get("gasto_descripcion") === "") {
      toastr["warning"]("El campo costo es requirido, debe escribir uno..!");
      this.gasto_descripcion.focus();
      return false;
    } else {
      return true;
    }
  };
  this.limpiarInputs = () => {
    this.gasto_descripcion.value = "";
    this.gasto_descripcion.focus();
  };
})();
app.listadoCostos();
