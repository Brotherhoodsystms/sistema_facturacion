const app = new (function () {
  this.sucursal_id = document.getElementById("sucursal_id");
  this.sucursal_provincia = document.getElementById("sucursal_provincia");
  this.sucursal_nombre = document.getElementById("sucursal_nombre");
  this.sucursal_direccion = document.getElementById("sucursal_direccion");
  this.sucursal_telefono = document.getElementById("sucursal_telefono");
  this.sucursal = document.getElementById("sucursal");

  this.listadoSucursal = () => {
    fetch("../controllers/sucursal/listadoSucursal.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html += "<th>Provincia</th><th>Detalle sucursal</th><th>Opciones</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        data.forEach((element) => {
          html += "<tr>";
          html +=
            "<td><strong>" + element.sucursal_provincia + "</strong></td>";
          html +=
            "<td><strong>Nombre: " +
            element.sucursal_nombre.toUpperCase() +
            "</strong><br/><i>Dirección: " +
            element.sucursal_direccion +
            "</i><br/><i>Telefono: " +
            element.sucursal_telefono +
            "</i></td>";
          html +=
            "<td><button type='button' class='btn btn-info btn-sm' title='Editar' onClick='app.editar(" +
            element.sucursal_id +
            ")'><i class='fas fa-pencil-alt'></i><button type='button' class='btn btn-danger btn-sm' title='Eliminar' onClick='app.eliminar(" +
            element.sucursal_id +
            ")'><i class='fas fa-trash'></i></td>";
        });
        html +=
          "</tr></tbody><tfoot><tr><th>Provincia</th><th>Detalle sucursal</th><th>Opciones</th></tr></tfoot></table>";
        this.sucursal.innerHTML = html;
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
    const form = new FormData(document.getElementById("sucursalform"));
    if (this.validacionInputSucursal(form) === true) {
      if (this.sucursal_id.value === "") {
        fetch("../controllers/sucursal/guardarSucursal.php", {
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
              this.listadoSucursal();
            } else if (data === 1) {
              toastr["error"](
                "El nombre sucursal ya existe, debe escribir otro..!"
              );
              this.sucursal_nombre.focus();
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
              this.listadoSucursal();
            } else if (data === 1) {
              toastr["error"](
                "El nombre sucursal ya existe, debe escribir otro..!"
              );
              this.sucursal_nombre.focus();
            }
          })
          .catch((error) => console.error(error));
      }
    }
  };
  this.editar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/sucursal/obtenerSucursal.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"](
          "Esta en modo de actualizar datos, solo puede modificar un dato..!"
        );
        this.sucursal_id.value = data.sucursal_id;
        this.sucursal_provincia.value = data.sucursal_provincia;
        this.sucursal_nombre.value = data.sucursal_nombre;
        this.sucursal_telefono.value = data.sucursal_telefono;
        this.sucursal_direccion.value = data.sucursal_direccion;
        this.sucursal_provincia.focus();
      })
      .catch((error) => console.error(error));
  };
  this.eliminar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    Swal.fire({
      title: "¿Esta seguro de eliminar este producto de esta Sucursal?",
      text: "Se eliminará por completo de los registro..!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si",
    }).then((result) => {
      if (result.isConfirmed) {
        fetch("../controllers/sucursal/eliminarSucursal.php", {
          method: "POST",
          body: formId,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              Swal.fire("Eliminado!", "Sucursal eliminada.", "success");
              this.listadoSucursal();
            }
          })
          .catch((error) => console.error(error));
      }
    });
  };
  this.validacionInputSucursal = (formInput) => {
    if (formInput.get("sucursal_provincia") === "") {
      toastr["warning"]("La provincia es requerida, debe escribir uno..!");
      document.getElementById("sucursal_provincia").focus();
      return false;
    } else if (formInput.get("sucursal_nombre") === "") {
      toastr["warning"]("El nombre es requerido, debe escribir uno..!");
      document.getElementById("sucursal_nombre").focus();
      return false;
    } else if (formInput.get("sucursal_telefono") === "") {
      toastr["warning"]("El telefono es requerido, debe escribir uno..!");
      document.getElementById("sucursal_telefono").focus();
      return false;
    } else {
      return true;
    }
  };
  this.limpiarInputs = () => {
    this.sucursal_id.value = "";
    this.sucursal_provincia.value = "";
    this.sucursal_nombre.value = "";
    this.sucursal_direccion.value = "";
    this.sucursal_telefono.value = "";
    this.sucursal_provincia.focus();
  };
})();
app.listadoSucursal();
