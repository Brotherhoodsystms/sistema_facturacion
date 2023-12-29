const app = new (function () {
  this.lote_descripcion = document.getElementById("lote_descripcion");
  this.lotes = document.getElementById("lotes");
  this.listadoLotes = () => {
    fetch("../controllers/lote/mostrarLote.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html += "<th>Datos lote</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        data.forEach((element) => {
          html += "<tr>";
          html += "<td> <strong>" + element.lote_descripcion + "</strong></td>";
        });
        html +=
          "</tr></tbody><tfoot><tr><th>Datos lote</th></tr></tfoot></table>";
        this.lotes.innerHTML = html;
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
    const form = new FormData(document.getElementById("loteform"));
    if (this.validacionInputLote(form) === true) {
      fetch("../controllers/lote/guardarLote.php", {
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
            this.listadoLotes();
          } else if (data === 1) {
            toastr["error"]("El campo lote ya existe, debe escribir otro..!");
            this.lote_descripcion.focus();
          }
        })
        .catch((error) => console.error(error));
    }
  };
  this.validacionInputLote = (formInput) => {
    if (formInput.get("lote_descripcion") === "") {
      toastr["warning"]("El campo lote es requirido, debe escribir uno..!");
      this.lote_descripcion.focus();
      return false;
    } else {
      return true;
    }
  };
  this.limpiarInputs = () => {
    this.lote_descripcion.value = "";
    this.lote_descripcion.focus();
  };
})();
app.listadoLotes();
