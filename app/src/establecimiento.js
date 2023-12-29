const app = new (function () {
  this.estableciminto_id = document.getElementById("estableciminto_id");
  this.nombre_establecimiento = document.getElementById(
    "nombre_establecimiento"
  );
  this.codigo_establecimiento = document.getElementById(
    "codigo_establecimiento"
  );
  this.nombre_comercial_estable = document.getElementById(
    "nombre_comercial_estable"
  );
  this.direccion_establecimiento = document.getElementById(
    "direccion_establecimiento"
  );
  this.estado_establecimiento = document.getElementById(
    "estado_establecimiento"
  );
  this.emisor_establecimiento = document.getElementById(
    "emisor_establecimiento"
  );
  //todo: add tablas
  this.establecimiento = document.getElementById("establecimiento");
  //todo:lista lista_emisor
  this.lista_emisor = document.getElementById("lista_emisor");

  this.listadoEstablecimiento = () => {
    fetch("../controllers/establecimiento/listadoEstablecimiento.php")
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
          html += "<td><strong>" + element.id + "</strong></td>";
          html +=
            "<td><strong>Nombre: " +
            element.nombre.toUpperCase() +
            "</strong><br/><i>Dirección: " +
            element.direccion +
            "</i><br/><i>Nombre Comercial: " +
            element.nombreComercial +
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
        this.establecimiento.innerHTML = html;
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
    const form = new FormData(document.getElementById("formEstablecimiento"));
    if (this.validacionInputEstablecimiento(form) === true) {
      if (this.estableciminto_id.value === "") {
        fetch("../controllers/establecimiento/guardarEstablecimiento.php", {
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
              this.listadoEstablecimiento();
            } else if (data === 1) {
              toastr["error"](
                "El ruc del  emisor  ya existe, debe escribir otro..!"
              );
              this.emisor_razon_social.focus();
            } else if (data === 2) {
              toastr["error"]("La contraseñas no coinciden !");
              this.emisor_passFirma_first.focus();
            }
          })
          .catch((error) => console.error(error));
      } else {
        fetch("../controllers/establecimiento/actualizarEstablecimiento.php", {
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
              this.listadoEstablecimiento();
            } else if (data === 1) {
              toastr["error"](
                "El nombre Actualizar ya existe, debe escribir otro..!"
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
    fetch("../controllers/establecimiento/obtenerEstablecimiento.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"](
          "Esta en modo de actualizar datos, solo puede modificar un dato..!"
        );
        this.estableciminto_id.value = data.id;
        this.nombre_establecimiento.value = data.nombre;
        this.codigo_establecimiento.value = data.codigo;
        this.nombre_comercial_estable.value = data.nombreComercial;
        this.direccion_establecimiento.value = data.direccion;
        $("#emisor_establecimiento").val(data["emisor_id"]).trigger("change");
        this.nombre_establecimiento.focus();
      })
      .catch((error) => console.error(error));
  };
  this.eliminar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    Swal.fire({
      title: "¿Esta seguro de eliminar este Establecimiento?",
      text: "Se perdera enlaces a factura Electronica comuniquese con el supervisor..!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si",
    }).then((result) => {
      if (result.isConfirmed) {
        fetch("../controllers/establecimiento/eliminarEstablecimiento.php", {
          method: "POST",
          body: formId,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              Swal.fire("Eliminado!", "Establecimiento  eliminada.", "success");
              this.listadoEstablecimiento();
            }
          })
          .catch((error) => console.error(error));
      }
    });
  };
  this.validacionInputEstablecimiento = (formInput) => {
    if (formInput.get("nombre_establecimiento") === "") {
      toastr["warning"](
        "La nombre del establecimiento  es requerida, debe escribir uno..!"
      );
      document.getElementById("nombre_establecimiento").focus();
      return false;
    } else if (formInput.get("codigo_establecimiento") === "") {
      toastr["warning"]("El codigo es requerido, debe escribir uno..!");
      document.getElementById("codigo_establecimiento").focus();
      return false;
    } else if (formInput.get("nombre_comercial_estable") === "") {
      toastr["warning"](
        "La nombre comercial del establecimiento  es requerido, debe escribir uno..!"
      );
      document.getElementById("nombre_comercial_estable").focus();
      return false;
    } else {
      return true;
    }
  };
  this.listarEmisores = () => {
    fetch("../controllers/emisor/listadoEmisor.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='emisor_establecimiento' id='emisor_establecimiento' autofocus required>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.id +
            "'>" +
            element.razonSocial +
            "</option>";
        });
        html += "</select>";
        this.lista_emisor.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  this.limpiarInputs = () => {
    this.estableciminto_id.value = "";
    this.nombre_establecimiento.value = "";
    this.codigo_establecimiento.value = "";
    this.nombre_comercial_estable.value="";
    this.direccion_establecimiento.value = "";
    this.estado_establecimiento.value = "";
    $("#emisor_establecimiento").val("Seleccione").trigger("change");
    //this.emisor_establecimiento.value = "";
    this.nombre_establecimiento.focus();
  };
})();
app.listadoEstablecimiento();
app.listarEmisores();
