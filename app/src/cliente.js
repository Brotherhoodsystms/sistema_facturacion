const app = new (function () {
  this.cliente_id = document.getElementById("cliente_id");
  this.cliente_razonsocial = document.getElementById("cliente_razonsocial");
  this.cliente_ruc = document.getElementById("cliente_ruc");
  this.cliente_telefono = document.getElementById("cliente_telefono");
  this.cliente_email = document.getElementById("cliente_email");
  this.cliente_direccion = document.getElementById("cliente_direccion");
  this.cliente_contacto = document.getElementById("cliente_contacto");
  this.clientes = document.getElementById("clientes");
  this.tipo_documentoC = document.getElementById("tipo_documentoC");

  this.listadoClientes = () => {
    fetch("../controllers/cliente/listadoCliente.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html +=
          "<th>Imagen</th><th>Datos cliente</th><th>Contactos</th><th>Opciones</th>";
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
            element.cliente_razonsocial.toUpperCase() +
            "</strong><br/><strong>RUC: " +
            element.cliente_ruc +
            "</strong><br/><u>Dirección: " +
            element.cliente_direccion +
            "</u></td>";
          html +=
            "<td><i>Email: " +
            element.cliente_email +
            "</i><br/><strong>Telefono: " +
            element.cliente_telefono +
            "</strong><br/><u>Contacto: " +
            element.cliente_contacto +
            "</u></td>";
            html += "<td>";
            if (permisos["u"] === "1"){
          html +=
            "<button type='button' class='btn btn-info btn-sm' style='border-radius:50%; width:40px; height:40px' title='Editar' onClick='app.editar(" +
            element.cliente_id +
            ")'><i class='fas fa-pencil-alt'></i></button>";
          }
          html += "</td>";
        });
        html +=
          "</tr></tbody><tfoot><tr><th>Imagen</th><th>Datos cliente</th><th>Contactos</th><th>Opciones</th></tr></tfoot></table>";
        this.clientes.innerHTML = html;
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
    const form = new FormData(document.getElementById("clienteform"));
    if (this.validacionInputCliente(form) === true) {
      if (this.cliente_id.value === "") {
        fetch("../controllers/cliente/guardarCliente.php", {
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
              this.listadoClientes();
            } else if (data === 1) {
              toastr["error"]("El campo ruc ya existe, debe escribir otro..!");
              this.cliente_ruc.focus();
            } //else if (data === 2) {
              //toastr["error"](
              //  "El campo email ya existe, debe escribir otro..!"
              //);
              //this.cliente_email.focus();
            //}
          })
          .catch((error) => console.error(error));
      } else {
        fetch("../controllers/cliente/actualizarCliente.php", {
          method: "POST",
          body: form,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              Swal.fire(
                "Actualizado!",
                "Su información se actualizo correctamente!",
                "success"
              );
              this.limpiarInputs();
              this.listadoClientes();
            } else if (data === 1) {
              toastr["error"]("El campo ruc ya existe, debe escribir otro..!");
              this.cliente_ruc.focus();
            } else if (data === 2) {
              toastr["error"](
                "El campo email ya existe, debe escribir otro..!"
              );
              this.cliente_email.focus();
            }
          })
          .catch((error) => console.error(error));
      }
    }
  };
  this.editar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/cliente/obtenerCliente.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"](
          "Esta en modo de actualizar datos, solo puede modificar un dato..!"
        );
        this.cliente_id.value = data.cliente_id;
        this.cliente_razonsocial.value = data.cliente_razonsocial;
        this.cliente_ruc.value = data.cliente_ruc;
        this.cliente_telefono.value = data.cliente_telefono;
        this.cliente_direccion.value = data.cliente_direccion;
        this.cliente_email.value = data.cliente_email;
        this.cliente_contacto.value = data.cliente_contacto;
        $("#id_tipodocumentov").val(data["id_tipodoc"]).trigger("change");
        this.cliente_razonsocial.focus();
      })
      .catch((error) => console.error(error));
  };
  this.validacionInputCliente = (formInput) => {
    if (formInput.get("cliente_razonsocial") === "") {
      toastr["warning"](
        "El campo razon social es requirido, debe escribir uno..!"
      );
      this.cliente_razonsocial.focus();
      return false;
    } else if (formInput.get("cliente_ruc") === "") {
      toastr["warning"]("El campo ruc es requirido, debe escribir uno..!");
      this.cliente_ruc.focus();
      return false;
    } else if (formInput.get("cliente_telefono") === "") {
      toastr["warning"]("El campo telefono es requirido, debe escribir uno..!");
      this.cliente_telefono.focus();
      return false;
    } else if (formInput.get("cliente_email") === "") {
      toastr["warning"]("El campo email es requirido, debe escribir uno..!");
      this.cliente_email.focus();
      return false;
    } else if (this.validarEmail(formInput.get("cliente_email")) === false) {
      this.validarEmail(formInput.get("cliente_email"));
      toastr["warning"](
        "El campo no es tipo email, debe escribir uno valido..!"
      );
      this.cliente_email.focus();
      return false;
    } else if (formInput.get("cliente_contacto") === "") {
      toastr["warning"]("El campo contacto es requirido, debe escribir uno..!");
      this.cliente_contacto.focus();
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
    this.cliente_id.value = "";
    this.cliente_razonsocial.value = "";
    this.cliente_ruc.value = "";
    this.cliente_telefono.value = "";
    this.cliente_direccion.value = "";
    this.cliente_email.value = "";
    this.cliente_contacto.value = "";
    this.cliente_razonsocial.focus();
  };
  /*listar tipo de documento para ingreso de nuevoc liente
  Desarrollado por CREDP-S soluciones civiles y tecnologicas telf:0987139033*/
  this.listarTipodocumento = () => {
    fetch("../controllers/venta/listadoTipoDocumento.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='id_tipodocumentov' id='id_tipodocumentov' autofocus required>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.id_tipdoc +
            "'>" +
            element.nombre_doc +
            "</option>";
        });
        html += "</select>";
        this.tipo_documentoC.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
})();
app.listadoClientes();
app.listarTipodocumento();
