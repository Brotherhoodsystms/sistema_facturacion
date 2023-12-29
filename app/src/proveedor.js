const app = new (function () {
  this.proveedor_id = document.getElementById("proveedor_id");
  this.proveedor_razonsocial = document.getElementById("proveedor_razonsocial");
  this.proveedor_ruc = document.getElementById("proveedor_ruc");
  this.proveedor_telefono = document.getElementById("proveedor_telefono");
  this.proveedor_email = document.getElementById("proveedor_email");
  this.proveedor_direccion = document.getElementById("proveedor_direccion");
  this.proveedor_contacto = document.getElementById("proveedor_contacto");
  this.proveedores = document.getElementById("proveedores");

  this.listadoProveedores = () => {
    fetch("../controllers/proveedor/listadoProveedor.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html += "<th>Imagen</th><th>Datos proveedor</th><th>Contactos</th><th>Opciones</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        permisos = data.permisosMod;
        data=data.data;
        data.forEach((element) => {
          html += "<tr>";
          html +=
            "<td><center><img src='../../public/images/clients.png' alt='logo box' width='50px'></center></td>";
          html +=
            "<td> <strong> Razon social: " +
            element.proveedor_razonsocial.toUpperCase() +
            "</strong><br/><strong>RUC: " +
            element.proveedor_ruc +
            "</strong><br/><u>Dirección: " +
            element.proveedor_direccion +
            "</u></td>";
          html +=
            "<td><i>Email: " +
            element.proveedor_email +
            "</i><br/><strong>Telefono: " +
            element.proveedor_telefono +
            "</strong><br/><u>Contacto: " +
            element.proveedor_contacto +
            "</u></td>";
          html += "<td>";
          if (permisos["u"] === "1"){
          html +=
            "<button type='button' class='btn btn-info btn-sm' style='border-radius: 50%; width:40px; height:40px; margin:0% 1%;' title='Editar' onClick='app.editar(" +
            element.proveedor_id +
            ")'><i class='fas fa-pencil-alt'></i></button>";
          }
          if (permisos["d"] === "1"){
            html +=
              "<button type='button' class='btn btn-danger btn-sm' style='border-radius: 50%; width:40px; height:40px; margin:0% 1%;' title='Eliminar' onClick='app.eliminar(" +
              element.proveedor_id +
              ")'><i class='fa fa-trash'></i></button>";
            }
          html += "</td>";
        });
        html +=
          "</tr></tbody><tfoot><tr><th>Imagen</th><th>Datos proveedor</th><th>Contactos</th><th>Opciones</th></tr></tfoot></table>";
        this.proveedores.innerHTML = html;
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
          },'dom': 'lBfrtip',
          'buttons': [
             {
                  "extend": "excelHtml5",
                  "text": "<i class='fas fa-file-excel'></i> Excel",
                  "titleAttr":"Esportar a Excel",
                  "title": "Listado de Proveedores",
                  "className": "btn btn-success",
              },{
                  "extend": "pdfHtml5",
                  "text": "<i class='fas fa-file-pdf'></i> PDF",
                  orientation: 'landscape',//todo::cambiar horzontal
                  "title": "Listado de Proveedores",
                  "titleAttr":"Esportar a PDF",
                  "className": "btn btn-danger"
              }
          ],
          "resonsieve":"true",
          "bDestroy": true,
          "iDisplayLength": 10,
          "order":[[0,"desc"]]
            });
      })
      .catch((error) => console.error(error));
  };

  this.guardar = () => {
    const form = new FormData(document.getElementById("proveedorform"));
    if (this.validacionInputProveedor(form) === true) {
      if (this.proveedor_id.value === "") {
        fetch("../controllers/proveedor/guardarProveedor.php", {
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
              this.listadoProveedores();
              this.limpiarInputs();
              this.listadoProveedores();
            } else if (data === 1) {
              toastr["error"]("El campo ruc ya existe, debe escribir otro..!");
              this.proveedor_ruc.focus();
            } else if (data === 2) {
              toastr["error"](
                "El campo email ya existe, debe escribir otro..!"
              );
              this.proveedor_email.focus();
            }
          })
          .catch((error) => console.error(error));
      } else {
        fetch("../controllers/proveedor/actualizarProveedor.php", {
          method: "POST",
          body: form,
        })
          .then((response) => response.json())
          .then((data) => {
            console.log(data);
            if (data === true) {
              Swal.fire(
                "Actualizado!",
                "Su información se actualizo correctamente!",
                "success"
              );
              this.limpiarInputs();
              this.listadoProveedores();
            } else if (data === 1) {
              toastr["error"]("El campo ruc ya existe, debe escribir otro..!");
              this.proveedor_ruc.focus();
            } else if (data === 2) {
              toastr["error"](
                "El campo email ya existe, debe escribir otro..!"
              );
              this.proveedor_email.focus();
            }
          })
          .catch((error) => console.error(error));
      }
    }
  };
  this.editar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/proveedor/obtenerProveedor.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"](
          "Esta en modo de actualizar datos, solo puede modificar un dato..!"
        );
        this.proveedor_id.value = data.proveedor_id;
        this.proveedor_razonsocial.value = data.proveedor_razonsocial;
        this.proveedor_ruc.value = data.proveedor_ruc;
        this.proveedor_telefono.value = data.proveedor_telefono;
        this.proveedor_direccion.value = data.proveedor_direccion;
        this.proveedor_email.value = data.proveedor_email;
        this.proveedor_contacto.value = data.proveedor_contacto;
        this.proveedor_razonsocial.focus();
      })
      .catch((error) => console.error(error));
  };
  
  this.eliminar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/proveedor/eliminarProveedor.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data === true) {
          Swal.fire(
            "Eliminado!",
            "Producto eliminado correctamente!",
            "success"
          );
          this.listadoProveedores();
        } else {
          Swal.fire(
            "icon: 'error'",
            "title: 'Error'",
            "text: 'No se pudo eliminar el producto'"
          );
          this.listadoProveedores();
        }
      })
      .catch((error) => console.error(error));
  };

  this.validacionInputProveedor = (formInput) => {
    if (formInput.get("proveedor_razonsocial") === "") {
      toastr["warning"](
        "El campo razon social es requirido, debe escribir uno..!"
      );
      this.proveedor_razonsocial.focus();
      return false;
    } else if (formInput.get("proveedor_ruc") === "") {
      toastr["warning"]("El campo ruc es requirido, debe escribir uno..!");
      this.proveedor_ruc.focus();
      return false;
    } else if (formInput.get("proveedor_telefono") === "") {
      toastr["warning"]("El campo telefono es requirido, debe escribir uno..!");
      this.proveedor_telefono.focus();
      return false;
    } else if (formInput.get("proveedor_email") === "") {
      toastr["warning"]("El campo email es requirido, debe escribir uno..!");
      this.proveedor_email.focus();
      return false;
    } else if (this.validarEmail(formInput.get("proveedor_email")) === false) {
      this.validarEmail(formInput.get("proveedor_email"));
      toastr["warning"](
        "El campo no es tipo email, debe escribir uno valido..!"
      );
      this.proveedor_email.focus();
      return false;
    } else if (formInput.get("proveedor_contacto") === "") {
      toastr["warning"]("El campo contacto es requirido, debe escribir uno..!");
      this.proveedor_contacto.focus();
      return false;
    } else {
      return true;
    }
  };
  this.validarEmail = (email) => {
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if (emailRegex.test(email)) {
      return true;
    } else {
      return false;
    }
  };
  this.limpiarInputs = () => {
    this.proveedor_id.value = "";
    this.proveedor_razonsocial.value = "";
    this.proveedor_ruc.value = "";
    this.proveedor_telefono.value = "";
    this.proveedor_direccion.value = "";
    this.proveedor_email.value = "";
    this.proveedor_contacto.value = "";
    this.proveedor_razonsocial.focus();
  };
})();
app.listadoProveedores();
