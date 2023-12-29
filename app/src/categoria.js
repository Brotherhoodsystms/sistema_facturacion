const app = new (function () {
  this.categoria_descripcion = document.getElementById("categoria_descripcion");
  this.categorias = document.getElementById("categorias");
  this.categoria_identificador = document.getElementById("categoria_identificador");

  this.listadoCategorias = () => {
    fetch("../controllers/categoria/mostrarCategoria.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html += "<th>Imagen</th><th>Datos categoria</th><th>Opciones</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        permisos = data.permisosMod;
        data=data.data;
        data.forEach((element) => {
          html += "<tr>";
          html +=
          "<td><center><img src='../utils/img/product.png' style='width:20%'></center></td>";
          html +=
            "<td> <strong>" + element.categoria_descripcion + "</strong></td>";
          html += "<td>";
          if (permisos["u"] === "1") {
          html +=
            "<button type='button' class='btn btn-info btn-sm' style='border-radius:50%; margin: 0% 2%; width:40px; height:40px' title='Editar' onClick='app.editar(" +
            element.categoria_id +
            ")'><i class='fas fa-pencil-alt'></i></button>";
          }
          if (permisos["d"] === "1") {
          html +=
              "<button type='button' class='btn btn-danger btn-sm' style='border-radius:50%; width:40px; height:40px' title='Eliminar' onClick='app.eliminar(" +
              element.categoria_id +
              ")'><i class='fa fa-trash'></i></button>";
          }
          html += "</td>";

        });
        html +=
          "</tr></tbody><tfoot><tr><th>Imagen</th><th>Datos categoria</th><th>Opciones</th></tr></tfoot></table>";
        this.categorias.innerHTML = html;
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
    const form = new FormData(document.getElementById("categoriaform"));
    if (this.validacionInputCategoria(form) === true) {
      if(this.categoria_identificador.value === ""){
      fetch("../controllers/categoria/guardarCategoria.php", {
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
            this.listadoCategorias();
            this.limpiarInputs();
            this.listadoCategorias();
          } else if (data === 1) {
            toastr["error"](
              "El campo categoria ya existe, debe escribir otro..!"
            );
            this.categoria_descripcion.focus();
          }
        })
        .catch((error) => console.error(error));
      }else{
        fetch("../controllers/categoria/actualizarCategoria.php", {
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
              this.listadoCategorias();
              this.limpiarInputs();
              this.listadoCategorias();
            } else if (data === 0) {
              toastr["error"](
                "El campo categoria ya existe, debe escribir otro..!"
              );
              this.categoria_descripcion.focus();
            }
          })
          .catch((error) => console.error(error));
      }
    }
  };

  this.editar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/categoria/obtenerCategoria.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"](
          "Esta en modo de actualizar datos, solo puede modificar un dato..!"
        );
        this.categoria_identificador.value = data.categoria_id;
        this.categoria_descripcion.value = data.categoria_descripcion;
        document.getElementById("categoria_descripcion").focus();
      })
      .catch((error) => console.error(error));
  };

  this.eliminar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/categoria/eliminarCategoria.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data === true) {
          Swal.fire(
            "Eliminado!",
            "Categoria eliminada correctamente!",
            "success"
          );
          this.listadoCategorias();
        } else {
          Swal.fire(
            "icon: 'error'",
            "title: 'Error'",
            "text: 'No se pudo eliminar la categoria'"
          );
          this.listadoCategorias();
        }
      })
      .catch((error) => console.error(error));
  };

  this.validacionInputCategoria = (formInput) => {
    if (formInput.get("categoria_descripcion") === "") {
      toastr["warning"](
        "El campo categoria es requirido, debe escribir uno..!"
      );
      this.categoria_descripcion.focus();
      return false;
    } else {
      return true;
    }
  };
  this.limpiarInputs = () => {
    this.categoria_descripcion.value = "";
    this.categoria_descripcion.focus();
  };
})();
app.listadoCategorias();
