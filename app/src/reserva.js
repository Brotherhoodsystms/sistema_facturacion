const app = new (function () {
  // todo: producto
  this.producto_id = document.getElementById("producto_id");
  this.producto_codigoserial = document.getElementById("producto_codigoserial");
  this.producto_descripcion = document.getElementById("producto_descripcion");
  this.producto_ubicacion = document.getElementById("producto_ubicacion");
  this.producto_stock = document.getElementById("producto_stock");
  this.producto_stock_r = document.getElementById("producto_stock_r");
  this.producto_precio = document.getElementById("producto_precio");
  this.codigoMensaje = document.getElementById("codigoMensaje");

  // todo: reserva

  this.reserva_id = document.getElementById("reserva_id");
  this.reserva_numero = document.getElementById("reserva_numero");
  this.reserva_fechainicio = document.getElementById("reserva_fechainicio");
  this.reserva_fechafinal = document.getElementById("reserva_fechafinal");
  this.reserva_cantidad = document.getElementById("reserva_cantidad");
  this.reserva_valormenor = document.getElementById("reserva_valormenor");
  this.reserva_valormayor = document.getElementById("reserva_valormayor");
  this.reserva_comision = document.getElementById("reserva_comision");
  this.reserva_total = document.getElementById("reserva_total");
  this.reserva_abono = document.getElementById("reserva_abono");

  this.valor_abonar = document.getElementById("valor_abonar");
  this.saldo_pendiente = document.getElementById("saldo_pendiente");
  this.reserva_saldopendiente = document.getElementById(
    "reserva_saldopendiente"
  );

  // todo: selectores
  this.selectorCliente = document.getElementById("selectorCliente");
  this.selectorVendedor = document.getElementById("selectorVendedor");
  this.selectorFormapago = document.getElementById("selectorFormapago");
  // todo: tabla
  this.reservas = document.getElementById("reservas");

  // todo: tabla reserva
  this.listadoReserva = () => {
    fetch("../controllers/reserva/listadoReserva.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html +=
          "<th>Reserva</th><th>Cliente</th><th>Vendedor</th><th>Forma Pago</th><th>Reserva</th><th>Opciones</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        permisos = data.permisosMod;
        data=data.data;
        data.forEach((element) => {
          html += "<tr>";
          html +=
            "<td> <strong>Numero: " +
            element.reserva_numero +
            "</strong><br/><r>Descripción: " +
            element.cliente_razonsocial +
            "</r></td>";
          html +=
            "<td> <strong> Razon social: " +
            element.cliente_razonsocial +
            "</strong><br/><r>Ruc: " +
            element.cliente_ruc +
            "</r></td>";
          html +=
            "<td> <strong> CI: " +
            element.vendedor_dni +
            "</strong><br/><u>Nombres: " +
            element.vendedor_nombres +
            "</u></td>";
          html +=
            "<td> <strong>" + element.formpago_descripcion + "</strong></td>";
            //datos del abono
          html +=
            "<td> <strong>Numero: " +
            element.reserva_numero +
            "</strong><br/><strong>Cantidad reserva: " +
            element.reserva_total +
            "</strong><br/><r style='color:blue;'>Fecha inicio: " +
            element.reserva_fechainicio +
            "</r><br/><r style='color:red;'>Fecha final: " +
            element.reserva_fechafinal +
            "</r><br/><r style='color:green;'>Saldo pendiente: $" +
            element.reserva_saldopendiente +
            "</r></td>";
          /*html +=
            "<td><button type='button' class='btn btn-danger btn-sm' title='Eliminar' onClick='app.eliminar(" +
            element.reserva_id +
            ")'><i class='fas fa-trash-alt'></i></button></td>";*/
            html +="<td>";
            //llama a la ventana modal de abonos
            if(element.reserva_saldopendiente>0 && permisos["w"] === "1"){
              html +=
              "<button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#exampleModalAbonar' title='Abonar' style='border-radius: 50%; width: 40px; height: 40px; margin: 2% 2%;' data-toggle='modal' onClick='app.abonar(" +
              element.reserva_id +
              ")'><i class='fas fa-cubes'></i></button>";
            }
            if(element.reserva_saldopendiente==='0.00' && permisos["u"] === "1"){
              html +=
              "<button type='button' class='btn btn-info btn-sm' title='Facturar' title='Facturar' style='border-radius: 50%; width: 40px; height: 40px; margin: 2% 2%;' onClick='app.facturar(" +
              element.reserva_id +
              ")'><i class='fas fa-file'></i></button>";
            }
            if(permisos["d"] === "1"){
              html +=
              "<button type='button' class='btn btn-danger btn-sm' title='Eliminar' style='border-radius: 50%; width: 40px; height: 40px; margin: 2% 2%;' onClick='app.eliminar(" +
              element.reserva_id +
              ")'><i class='fas fa-trash-alt'></i></button><button type='button' class='btn btn-success btn-sm' title='Imprimir' title='Imprimir' onClick='app.imprimir(" +
              element.reserva_id +
              ")'><i class='fas fa-print'></i></button>";
            }
            html+= "</td>";
        });
        html +=
          "</tr></tbody></table>";
        this.reservas.innerHTML = html;
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
  //todo::mover todo a factura desde la reserva
  this.facturar=(id_reserva)=>{
    var form = new FormData();
    form.append("id_reserva", id_reserva);
    fetch("../controllers/reserva/facturarReserva.php", {
      method: "POST",
      body: form,
    })
      .then((response) => response.json())
      .then((data) => {
        this.firmarEnviar(data.id_factura);
       /*Swal.fire(
          "Factura Creada!",
          "",
          "success"
        );*/
       // location.href = "../views/facturaA.php";
      })
      .catch((err) => console.error(err));

  };
  this.firmarEnviar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/factura/firmarEnviar.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.estado === true) {
          Swal.fire({
            title: "Factura Creada correctamente!",
            text: "Enviada al correo electronico correctamente!",
            icon: "success",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "../views/facturaA.php";
            }
          });
          //todo::regresaremos a un estado anterior si es el caso que no le paresca el diseño de
          //todo::notificacion cuando se realiza un procesode factura
          //toastr["info"]("Documento Guardada correctamente");
          //location.href = "../views/venta.php";
          //location.href = "../views/facturaA.php";
          //todo::debemos definir el campo para que al momento de firmar e imprimir
          //todo::modificar el valor para que se recargue el listado de facturas
        } else {
          Swal.fire("ERROR!", data.mensaje, "warning");
        }
      })
      .catch((error) => console.error(error));
  }
  // todo: select dinamicos
  this.listarClientes = () => {
    fetch("../controllers/cliente/listadoCliente.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='cliente_id' id='cliente_id' autofocus required>";
        html += "<option disabled selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.cliente_id +
            "'>" +
            element.cliente_razonsocial +
            " - " +
            element.cliente_ruc;
          ("</option>");
        });
        html += "</select>";
        this.selectorCliente.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  this.listarFormaPago = () => {
    fetch("../controllers/forma/listadoFormaPago.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='formpago_id' id='formpago_id' autofocus required>";
        html += "<option disabled selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.formpago_id +
            "'>" +
            element.formpago_descripcion +
            "</option>";
        });
        html += "</select>";
        this.selectorFormapago.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  this.listarVendedor = () => {
    fetch("../controllers/vendedor/listadoVendedor.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='vendedor_id' id='vendedor_id' autofocus required>";
        html += "<option disabled selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.vendedor_id +
            "'>" +
            element.vendedor_dni +
            " - " +
            element.vendedor_nombres;
          ("</option>");
        });
        html += "</select>";
        this.selectorVendedor.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };

  // todo: producto vender
  this.obtenerProducto = () => {
    var form = new FormData();
    form.append("producto_codigoserial", this.producto_codigoserial.value);
    fetch("../controllers/producto/obtenerProductoSerial.php", {
      method: "POST",
      body: form,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data) {
          this.producto_id.value = data.producto_id;
          this.producto_descripcion.value = data.producto_descripcion;
          this.producto_ubicacion.value =
            data.ubicacion_descripcion + " : " + data.bodega_descripcion;
          this.producto_stock.value = data.producto_stock;
          this.producto_stock_r.value = data.producto_stock;
          this.producto_precio.value = data.producto_precio_menor;
          this.codigoMensaje.innerHTML =
            "<small class='text-success'>Código encontrado</small>";
        } else {
          this.producto_id.value = "";
          this.producto_descripcion.value = "";
          this.producto_ubicacion.value = "";
          this.producto_stock.value = "";
          this.producto_precio.value = "";
          this.producto_codigoserial.focus();
          this.codigoMensaje.innerHTML =
            "<small class='text-danger'>Código no encontrado</small>";
        }
      })
      .catch((err) => console.error(err));
  };
  this.guardar = () => {
    const form = new FormData(document.getElementById("reservaform"));
    if (this.validacionInputReserva(form) === true) {
      if (
        parseInt(this.producto_stock.value) >=
        parseInt(this.reserva_cantidad.value)
      ) {
        if (
          parseFloat(this.reserva_total.value) >=
          parseFloat(this.reserva_abono.value)
        ) {
        } else {
          toastr["warning"](
            "La campo abono es superior al precio total, debe escribir otro..!"
          );
          this.reserva_abono.focus();
        }
        fetch("../controllers/reserva/guardarReserva.php", {
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
              this.listadoReserva();
            }
          })
          .catch((err) => console.error(err));
      } else {
        toastr["warning"](
          "La campo cantidad es superior al stock del producto, debe escribir otro..!"
        );
        this.reserva_cantidad.focus();
      }
    }
  };
  this.validacionInputReserva = (formInput) => {
    if (formInput.get("producto_id") === "") {
      toastr["warning"](
        "El código del producto es requerido, debe escribir uno..!"
      );
      document.getElementById("producto_codigoserial").focus();
      return false;
    } else if (formInput.get("cliente_id") === null) {
      toastr["warning"]("El cliente es requerido, debe elegir uno..!");
      document.getElementById("cliente_id").focus();
      return false;
    } else if (formInput.get("vendedor_id") === null) {
      toastr["warning"]("El vendedor es requerido, debe elegir uno..!");
      document.getElementById("vendedor_id").focus();
      return false;
    } else if (formInput.get("formpago_id") === null) {
      toastr["warning"]("La forma de pago es requerido, debe elegir uno..!");
      document.getElementById("formpago_id").focus();
      return false;
    } else if (formInput.get("reserva_fechainicio") === "") {
      toastr["warning"](
        "La campo fecha inicio es requerida, debe escribir uno..!"
      );
      document.getElementById("reserva_fechainicio").focus();
      return false;
    } else if (formInput.get("reserva_fechafinal") === "") {
      toastr["warning"](
        "La campo fecha final es requerida, debe escribir uno..!"
      );
      document.getElementById("reserva_fechafinal").focus();
      return false;
    } else if (formInput.get("reserva_cantidad") === "") {
      toastr["warning"]("La campo cantidad es requerida, debe escribir uno..!");
      document.getElementById("reserva_cantidad").focus();
      return false;
    } else if (formInput.get("reserva_valormenor") === "") {
      toastr["warning"](
        "La campo valor menor es requerido, debe escribir uno..!"
      );
      document.getElementById("reserva_valormenor").focus();
      return false;
    } else if (formInput.get("reserva_valormayor") === "") {
      toastr["warning"](
        "La campo valor mayor es requerido, debe escribir uno..!"
      );
      document.getElementById("reserva_valormayor").focus();
      return false;
    } else if (formInput.get("reserva_abono") === "") {
      toastr["warning"]("La campo abono es requerido, debe escribir uno..!");
      document.getElementById("reserva_abono").focus();
      return false;
    } else {
      return true;
    }
  };
  //boton eliminar
  this.eliminar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    Swal.fire({
      title: "¿Esta seguro de eliminar esta reserva?",
      text: "Se eliminará por completo de los registro..!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si",
    }).then((result) => {
      if (result.isConfirmed) {
        fetch("../controllers/reserva/eliminarReserva.php", {
          method: "POST",
          body: formId,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              this.listadoReserva();
            }
          })
          .catch((error) => console.error(error));
      }
    });
  };
  //todo::imprimir pdf de reserva
  //boton imprimir
  this.imprimir = (id) => {
    const formId = new FormData();
    this.generearPDF(id);
    formId.append("id", id);
    fetch("../controllers/reserva/generarPdf.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data === true) {
          this.listadoReserva();
        }
      })
      .catch((error) => console.error(error));
  };

  this.generearPDF = (data) => {
    var ancho = 1000;
    var alto = 800;
    var x = parseInt(window.screen.width / 2 - ancho / 2);
    var y = parseInt(window.screen.width / 2 - alto / 2);
    $url = "../../app/utils/factura/generaFactura.php?cl=1" + "&f=" + data;
    window.open(
      $url,
      "Factura",
      "left=" +
        x +
        ",top=" +
        y +
        ",height=" +
        alto +
        ",width=" +
        ancho +
        ",scroll=si,location=no,resizeble=si,menubar=no"
    );
    location.href = "../views/reserva.php";
  };
  //enviar correo
  this.enviarCorreo = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    formId.append("name", "email_bienvenida");
    formId.append("asunto", "email_bienvenida");
    formId.append("email", "javierlobitort@gmail.com");
    fetch("../controllers/reserva/enviarCorreo.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"]("Correo enviado correctamente");

        this.reserva_id.value = data.reserva_id;
        this.saldo_pendiente.value = data.reserva_saldopendiente;
        // $("#sucursal_id").val(data["sucursal_id"]).trigger("change");
        // $("#bodega_id").val(data["bodega_id"]).trigger("change");
        document.getElementById("valor_abonar").focus();
      })
      .catch((error) => console.error(error));
  };
  //abonar en la reserva
  this.abonar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/reserva/obtenerReserva.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"]("Esta en modo de abono reserva");
        this.reserva_id.value = data.reserva_id;
        this.saldo_pendiente.value = data.reserva_saldopendiente;
        // $("#sucursal_id").val(data["sucursal_id"]).trigger("change");
        // $("#bodega_id").val(data["bodega_id"]).trigger("change");
        document.getElementById("valor_abonar").focus();
      })
      .catch((error) => console.error(error));
  };
  //
  this.actualizarReservaAbono = () => {
    const form = new FormData(document.getElementById("abonoform"));
    var saldo=document.getElementById("saldo_pendiente").value;
    var abono=document.getElementById("valor_abonar").value;
    var cero="0";
    var var1=parseFloat(abono)<=saldo;
    var var2=abono>cero;


    if ( var1 &&  var2) {
    fetch("../controllers/reserva/actualizarReservaAbono.php", {
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
          $("#exampleModalAbonar").modal("hide");
          document.getElementById("abonoform").reset();
          this.listadoReserva();
        } else if (data === 0) {
          toastr["error"]("No se a podido actulizar la reserva..!");
          this.ubicacion_descripcion.focus();
        }
      })
      .catch((error) => console.error(error));
    }else{
      Swal.fire(
        "Error!",
        "La informacion proporcionada no es correcta no debe superar al saldo y no sebe ser menor a cero!",
        "danger"
      );
      //$("#exampleModalAbonar").modal("hide");
      //document.getElementById("abonoform").reset();

    }
  };
  this.limpiarInputs = () => {
    this.producto_id.value = "";
    this.producto_codigoserial.value = "";
    this.producto_descripcion.value = "";
    this.producto_stock.value = "";
    this.producto_precio.value = "";
    this.producto_ubicacion.value = "";
    this.reserva_id.value = "";
    this.reserva_fechainicio.value = "";
    this.reserva_fechafinal.value = "";
    this.reserva_cantidad.value = "";
    this.reserva_comision.value = "1.00";
    this.reserva_total.value = "0.00";
    this.reserva_abono.value = "";
    this.reserva_saldopendiente.value = "0.00";
    $("#cliente_id").val("Seleccione").trigger("change");
    $("#vendedor_id").val("Seleccione").trigger("change");
    $("#formpago_id").val("Seleccione").trigger("change");
    this.producto_codigoserial.focus();
    this.codigoMensaje.innerHTML =
      "<small class='text-primary'>Leer o escribir el código</small>";
    //this.mostrarSerieReservaNumero();
  };
  this.mostrarSerieReservaNumero = () => {
    var current = new Date();
    this.reserva_numero.value =
      "RESE-0" +
      current.getMonth() +
      current.getHours() +
      current.getMinutes() +
      "-" +
      current.getSeconds();
  };
  this.totalReservaVender = () => {
    this.reserva_total.value =
      this.producto_precio.value * this.reserva_cantidad.value;
  };
  this.asignarAbono = () => {
    this.reserva_saldopendiente.value =
      this.reserva_total.value - this.reserva_abono.value;
  };
})();
app.listadoReserva();
///app.listarClientes();
//app.listarFormaPago();
//app.listarVendedor();
//app.mostrarSerieReservaNumero();
