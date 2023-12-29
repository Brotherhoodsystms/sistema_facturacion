const app = new (function () {
  this.mercaderia_id = document.getElementById("mercaderia_id");
  this.mercaderia_fechaelaboracion = document.getElementById(
    "mercaderia_fechaelaboracion"
  );
  this.mercaderia_fechaexpiracion = document.getElementById(
    "mercaderia_fechaexpiracion"
  );
  this.mercaderia = document.getElementById("mercaderia");
  this.listadoMercaderia = () => {
    fetch("../controllers/mercaderia/listadoMercaderia.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html +=
          "<th>Logo</th><th>Detalle producto</th><th>Detalle mercaderia</th><th>Opciones</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        data.forEach((element) => {
          html += "<tr>";
          html +=
            "<td><center><img src='../../public/images/box.png' alt='logo box' width='50px'></center></td>";
          html +=
            "<td><strong>Código serial producto: " +
            element.producto_codigoserial.toUpperCase() +
            "</strong><br/><i>Descripción producto: " +
            element.producto_descripcion.toUpperCase() +
            "</i><br/><strong>Proveedor producto: " +
            element.proveedor_razonsocial.toUpperCase() +
            " - " +
            element.proveedor_ruc +
            "</strong><br/><strong>Precio: $" +
            element.producto_precio +
            "</strong><br/><i>Stock: " +
            element.producto_stock +
            "</i><br/><strong>Categoria: " +
            element.categoria_descripcion +
            "</strong><br/><strong>Lote: " +
            element.lote_descripcion +
            "</strong></td>";
          html +=
            "<td><strong>Fecha elaboración: " +
            element.mercaderia_fechaelaboracion +
            "</strong><br/><strong>Fecha expiración: " +
            element.mercaderia_fechaexpiracion +
            "</strong></td>";
          html +=
            "<td><button type='button' class='btn btn-info btn-sm' title='Editar' data-toggle='modal' data-target='#exampleModalMercaderia' onClick='app.editar(" +
            element.mercaderia_id +
            ")'><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-danger btn-sm' title='Eliminar' onClick='app.eliminar(" +
            element.mercaderia_id +
            ")'><i class='fas fa-trash-alt'></i></button></td>";
        });
        html +=
          "</tr></tbody><tfoot><tr><th>Logo</th><th>Detalle producto</th><th>Detalle mercaderia</th><th>Opciones</th></tr></tfoot></table>";
        this.mercaderia.innerHTML = html;
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
  this.actualizarMercaderia = () => {
    const form = new FormData(document.getElementById("mercaderiaform"));
    if (this.validacionInputModalMercaderia(form) === true) {
      fetch("../controllers/mercaderia/actualizarMercaderia.php", {
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
            $("#exampleModalMercaderia").modal("hide");
          }
          this.listadoMercaderia();
          document.getElementById("mercaderiaform").reset();
          // setTimeout(() => {
          //   window.location.href = "../views/mercaderia.php";
          // }, 1000);
        })
        .catch((error) => console.error(error));
    }
  };
  this.editar = (id) => {
    this.mercaderia_id.value = id;
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/mercaderia/obtenerMercaderia.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        this.mercaderia_id.value = data.mercaderia_id;
        this.mercaderia_fechaelaboracion.value =
          data.mercaderia_fechaelaboracion;
        this.mercaderia_fechaexpiracion.value = data.mercaderia_fechaexpiracion;
        this.mercaderia_fechaelaboracion.focus();
      })
      .catch((error) => console.error(error));
  };
  this.eliminar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    Swal.fire({
      title: "¿Esta seguro de eliminar esta mercaderia?",
      text: "Se eliminará por completo de los registro..!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si",
    }).then((result) => {
      if (result.isConfirmed) {
        fetch("../controllers/mercaderia/eliminarMercaderia.php", {
          method: "POST",
          body: formId,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              this.listadoMercaderia();
            }
          })
          .catch((error) => console.error(error));
      }
    });
  };
  this.validacionInputModalMercaderia = (formInput) => {
    if (formInput.get("mercaderia_fechaelaboracion") === "") {
      toastr["warning"](
        "La fecha de elaboración es requerida, debe elegir uno..!"
      );
      document.getElementById("mercaderia_fechaelaboracion").focus();
      return false;
    } else if (formInput.get("mercaderia_fechaexpiracion") === "") {
      toastr["warning"](
        "El fecha de expiración es requerida, debe elegir uno..!"
      );
      document.getElementById("mercaderia_fechaexpiracion").focus();
      return false;
    } else {
      return true;
    }
  };
})();
app.listadoMercaderia();
