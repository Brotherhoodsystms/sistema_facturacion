const app = new (function () {
  // todo: producto
  this.producto_codigoserial = document.getElementById("producto_codigoserial");
  this.producto_stock = document.getElementById("producto_stock");
  this.producto_comprar = document.getElementById("producto_comprar");
  this.bodega_idE = document.getElementById("bodega_idE");
  this.producto_idE = document.getElementById("producto_idE");
  this.descripcion_producto=document.getElementById("descripcion_producto");
  //todo::ubicacion
  this.ubicacion_id = document.getElementById("ubicacion_id");
  this.ubicacion_sucursal = document.getElementById("ubicacion_sucursal");
  this.ubicacion_sucursal_r = document.getElementById("ubicacion_sucursal_r");
  this.ubicacion_sucursal_o = document.getElementById("ubicacion_sucursal_o");
  this.ubicacion_bodega = document.getElementById("ubicacion_bodega");
  this.ubicacion_bodega_r = document.getElementById("ubicacion_bodega_r");
  this.ubicacion_bodega_o = document.getElementById("ubicacion_bodega_o");
  this.ubicacion_descripcion = document.getElementById("ubicacion_descripcion");

  this.ubicacion_descripcion_r = document.getElementById(
    "ubicacion_descripcion_r"
  );
  this.ubicacion_descripcion_o = document.getElementById(
    "ubicacion_descripcion_o"
  );
  this.bodega_id_o = document.getElementById("bodega_id_o");
  this.percha_bodega_o = document.getElementById("percha_bodega_o");
  // todo: detalle temporal
  this.tbody = document.getElementById("tbody");
  this.tbodydetalle = document.getElementById("tbodydetalle");
  this.productosl=document.getElementById("productosl");
  //todo::todo los datos de la tabla detalle temporal
  this.listadoDetalleTemporal = () => {
    fetch("../controllers/egresobodega/listadoDetalleTemporal.php")
      .then((response) => response.json())
      .then((data) => {
        if (data.length > 0) {
          html = [];
          data.forEach((element) => {
            html += "<tr>";
            html += "<td><strong>" + element.producto_codigoserial + "</strong></td>";
            html += "<td><strong>" + element.producto_descripcion + "</strong></td>";
            html +=
              "<td><strong>" + element.tem_ubica_cantidad + "</strong></td>";
            html +=
              "<td><strong>" + element.bodega_descripcion + "</strong></td>";
            html +=
              "<td><strong>" + element.tem_ubica_descripcion + "</strong></td>";
            var descripcion = "'" + element.tem_ubica_descripcion + "'";
            var descripciono = "'" + element.temp_ubica_descripciono + "'";
            html +=
              '<td><button type="button" class="btn btn-danger btn-sm" title="ELiminar" onClick="app.eliminar(' +
              element.tem_ubica_id +
              "," +
              element.tem_ubica_cantidad +
              "," +
              element.temp_ubica_productoid +
              "," +
              element.temp_bodegaid_origen +
              "," +
              element.tem_ubica_bodegaid +
              "," +
              descripcion +
              "," +
              descripciono +
              ')"><i class= "fa fa-trash"></i></button></td>';
            html += "</tr>";
          });
          this.tbody.innerHTML = html;
        } else {
          this.tbody.innerHTML =
            "<tr><td colspan='6'>No hay detalles de productos</td></tr>";
        }
      })
      .catch((error) => console.error(error));
  };

  //todo::todo los datos de la tabla detalle factura
  this.listadoDetalleFactura = (id_factura) => {
    //todo::editarFactura llamado de los datos
    const formId = new FormData();
    console.log(id_factura);
    formId.append("id_factura", id_factura);
    //fetch("../controllers/producto/obtenerProductoSerial.php", {
    fetch("../controllers/venta/listadoDetalleFactura.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data2) => {
        if (data2.length >= 0) {
          html = [];
          data2.forEach((element) => {
            html += "<tr>";
            html +=
              "<td><strong>" + element.producto_codigoserial + "</strong></td>";
            html +=
              "<td><strong>" + element.producto_descripcion + "</strong></td>";
            html +=
              "<td><strong>" + element.detafact_cantidad + "</strong></td>";
            html +=
              "<td><strong>" +
              element.detafact_preciounitario +
              "</strong></td>";
            html +=
              "<td><strong>" + element.detafact_descuento + " %</strong></td>";
            html += "<td><strong>" + element.detafact_total + "</strong></td>";
            html +=
              "<td><button type='button' class='btn btn-danger btn-sm' title='ELiminar' onClick='app.eliminarDetFactura(" +
              element.producto_id +
              "," +
              element.detafact_cantidad +
              "," +
              element.factura_id +
              ")'><i class= 'fa fa-trash'></i></button></td>";
            html += "</tr>";
          });
          this.tbodydetalle.innerHTML = html;
          this.sumarSubTotalDeFactura(id_factura);
        } else {
          this.tbodydetalle.innerHTML =
            "<tr><td colspan='6'>No hay detalles de productos</td></tr>";
          this.factura_subtotal.value = "0";
          this.factura_total.value = "0";
          this.listadoDetalleTemporal();
          $("#tbody").show();
        }
      })
      .catch((error) => console.error(error));
  };

  /* todo> select dinamicos
  this.listarClientes = () => {
    fetch("../controllers/cliente/listadoCliente.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='cliente_id' id='cliente_id' autofocus required>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
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
  };*/

  // todo: producto a  REUBCAR
   // todo: lista de producto a  vender
   this.modallistaProducto = () => {
    fetch("../controllers/producto/listadoProducto.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html +=
          "<th>Código producto</th><th>Detalle</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        data.forEach((element) => {
          html += "<tr>";
            var texto='"'+element.producto_descripcion.toUpperCase()+'"';
            let codigo=element.producto_codigoserial;
            let datos2=(JSON.stringify(codigo));
          html +=
            "<td><center><img src='../../public/images/serial.png' alt='logo box' width='30px'><br/><strong><a type='button' onclick='app.ponerValorCodigo("+datos2 +","+ texto +");'>" +
            element.producto_codigoserial +
            "</a></strong></center></td>";
          html += "<td><a type='button' onclick='app.ponerValorCodigo("+datos2 +","+ texto +");'>" + element.producto_descripcion.toUpperCase() + "</a></td>";
        });
        //")'><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-success btn-sm' title='Ubicacion' onClick='app.ubicacion(" +
        //  element.producto_id +
        html +=
          "</tr></tbody><tfoot><tr><th>Código producto</th><th>Detalle</th></tr></tfoot></table>";
        this.productosl.innerHTML = html;
        $("#example1").DataTable({
          language: {
            lengthMenu: "Mostrar _MENU_ ",
            zeroRecords: "No se encontraron resultados en su búsqueda",
            searchPlaceholder: "Buscar registros",
            Rigthsearch: "Buscar:",
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

  }
  this.ponerValorCodigo=(codigo,texto)=>{
    this.producto_codigoserial.value=codigo;
    this.descripcion_producto=document.getElementById("descripcion_producto");
    this.descripcion_producto.value=texto;
    $("#descripcion_producto").disabled;

    app.obtenerProducto();
    $("#exampleModalProductos").modal("hide");
    //document.getElementById("ubicacionform").reset();
  }

  //todo::fin de la lista de productos hasta aqui poner todo
//todo::producto
  this.obtenerProducto = () => {
    var form = new FormData();
    form.append("producto_codigoserial", this.producto_codigoserial.value);
    //fetch("../controllers/producto/obtenerProductoSerial.php", {
    fetch("../controllers/ubicacion/obtenerUbicacionProducto.php", {
      method: "POST",
      body: form,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data!="") {
          app.listarTipoSucursalO(data[0].producto_id);
          this.descripcion_producto.value=data[0].producto_descripcion;
          //this.producto_id.value = data.producto_id;
          //this.producto_lote.value = data.lote_descripcion;
          //this.producto_descripcion.value = data.producto_descripcion;
          //this.producto_stock.value = data.producto_stock;
          this.ubicacion_id.value = data.ubicacion_id;
        } else {
          app.listarTipoSucursalO(0);
          app.obtenerValorO();
          app.obtenerStok();
          this.ubicacion_id.value = "";
          this.producto_stock.value = "";
          this.descripcion_producto.value="";
          this.producto_codigoserial.focus();
        }
      })
      .catch((err) => console.error(err));
  };
  //todo::guardar datos en la tabla temporal
  this.guardar = () => {
    const form = new FormData(document.getElementById("ubicacionform"));
    if (this.validacionInputProducto(form) === true) {
      fetch("../../app/controllers/ubicacion/guardarDetalleTemporalU.php", {
        method: "POST",
        body: form,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data === true) {
            toastr["success"]("Producto agregado!");
            this.limpiarInputs();
            this.listadoDetalleTemporal();

            $("#tbody").show();
          } else if (data === false) {
            toastr["warning"]("Cantidad a comprar es superior al stock!");
            this.producto_comprar.focus();
          }
        })
        .catch((err) => console.error(err));
    }
  };
  //todo::guardar los datos en la tabla ubicacion y en la tabla historial para su respectivo contro l
  this.guardar_historial_ubicacion = () => {
    const form = new FormData(document.getElementById("ubicacionform"));
    fetch("../../app/controllers/egresobodega/guardar_Hi_Ubic.php", {
      method: "POST",
      body: form,
    })
      .then((response) => response.json())
      .then((data) => {
        //$("btn-guardarFact");
        validacion = data[0];
        if (validacion.estado === true) {
          toastr["info"]("Egreso de bodega realizado correctamente");
          $("#btn_guardarE").hide();
          //$("#btn-imprimir").show();
          this.ubicacion_id.value = validacion.id_historial;
          this.limpiarInputs();
          this.listadoDetalleTemporal();
        } else {
          toastr["warning"]("Documentos no guardados");
          this.listadoDetalleTemporal();
        }
      })
      .catch((error) => console.error(error));
  };
  //todo::generar impresion de ingreso
  this.imprimirEgresos = () => {
    var ubicacion_id = document.getElementById("ubicacion_id");
    const formId = new FormData();
    formId.append("ubicacion_id", ubicacion_id.value);
    //TODO::NOS FALTA LOS MODELOS PAR APODER IMPRIMRI YA TENMOS LAS BASES
    app.generearPDF(ubicacion_id.value);
    fetch("../controllers/producto/imprimirHistorialIngreso.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        //estado = data[0];
        if (data) {
          toastr["info"]("Ingreso de Productos guardados correctamente ");
          this.historial_id.value = data.id_historial;
          $("#btn_guardarE").hide();
          $("#btn-imprimir").show();
        } else if (data.estado === 2) {
          toastr["warning"]("No existen Productos para el ingreso");
        }
      })
      .catch((error) => console.error(error));
  };
  this.generearPDF = (data) => {
    var ancho = 1000;
    var alto = 800;
    var x = parseInt(window.screen.width / 2 - ancho / 2);
    var y = parseInt(window.screen.width / 2 - alto / 2);
    $url = "../../app/utils/factura/generarEgresos.php?cl=1" + "&f=" + data;
    window.open(
      $url,
      "Ingreso",
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
  };
  //todo::eliminar producto de tabla temporal
  this.eliminar = (
    tem_ubica_id,
    tem_ubica_cantidad,
    temp_ubica_productoid,
    temp_bodegaid_origen,
    tem_ubica_bodegaid,
    tem_ubica_descripcion,
    tem_ubica_descripciono
  ) => {
    const formEliminar = new FormData();
    formEliminar.append("tem_ubica_id", tem_ubica_id);
    formEliminar.append("tem_ubica_cantidad", tem_ubica_cantidad);
    formEliminar.append("temp_ubica_productoid", temp_ubica_productoid);
    formEliminar.append("temp_bodegaid_origen", temp_bodegaid_origen);
    formEliminar.append("tem_ubica_descripcion", tem_ubica_descripcion);
    formEliminar.append("tem_ubica_bodegaid", tem_ubica_bodegaid);
    formEliminar.append("tem_ubica_descripciono", tem_ubica_descripciono);
    fetch("../controllers/ubicacion/eliminarFilaDetalleTemporal.php", {
      method: "POST",
      body: formEliminar,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data === 1) {
          toastr["warning"]("Egreso eliminado de bodega!");
          this.listadoDetalleTemporal();
        }
      })
      .catch((err) => console.error(err));
  };
  //todo::eliminar producto de la tabla detalle factura  eliminarDetFactura
  this.eliminarDetFactura = (producto_id, detafact_cantidad, detafact_id) => {
    const formEliminar = new FormData();
    formEliminar.append("producto_id", producto_id);
    formEliminar.append("temp_cantvender", detafact_cantidad);
    formEliminar.append("temp_id", detafact_id);
    fetch("../controllers/venta/eliminarFilaDetalleFactura.php", {
      method: "POST",
      body: formEliminar,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data === 1) {
          this.listadoDetalleFactura(detafact_id);
        }
      })
      .catch((err) => console.error(err));
  };

  this.lectorCodigoProducto = () => {
    Quagga.init(
      {
        inputStream: {
          name: "Live",
          type: "LiveStream",
          target: document.querySelector("#scanner-container"),
          constraints: {
            width: 480,
            height: 320,
            facingMode: "environment",
          },
        },
        frequency: 2,
        decoder: {
          readers: [
            "code_128_reader",
            "ean_reader",
            "code_39_reader",
            "code_39_vin_reader",
            "codabar_reader",
            "upc_reader",
            "upc_e_reader",
            "i2of5_reader",
          ],
          debug: {
            showCanvas: true,
            showPatches: true,
            showFoundPatches: true,
            showSkeleton: true,
            showLabels: true,
            showPatchLabels: true,
            showRemainingPatchLabels: true,
            boxFromPatches: {
              showTransformed: true,
              showTransformedBox: true,
              showBB: true,
            },
          },
        },
      },
      function (err) {
        if (err) {
          console.log(err);
          return;
        }

        console.log("Initialization finished. Ready to start");
        Quagga.start();
      }
    );

    Quagga.onProcessed(function (result) {
      var drawingCtx = Quagga.canvas.ctx.overlay,
        drawingCanvas = Quagga.canvas.dom.overlay;

      if (result) {
        if (result.boxes) {
          drawingCtx.clearRect(
            0,
            0,
            parseInt(drawingCanvas.getAttribute("width")),
            parseInt(drawingCanvas.getAttribute("height"))
          );
          result.boxes
            .filter(function (box) {
              return box !== result.box;
            })
            .forEach(function (box) {
              Quagga.ImageDebug.drawPath(box, { x: 0, y: 1 }, drawingCtx, {
                color: "green",
                lineWidth: 2,
              });
            });
        }

        if (result.box) {
          Quagga.ImageDebug.drawPath(result.box, { x: 0, y: 1 }, drawingCtx, {
            color: "#00F",
            lineWidth: 2,
          });
        }

        if (result.codeResult && result.codeResult.code) {
          Quagga.ImageDebug.drawPath(
            result.line,
            { x: "x", y: "y" },
            drawingCtx,
            { color: "red", lineWidth: 3 }
          );
        }
      }
    });

    Quagga.onDetected(function (result) {
      // console.log(
      //   "Barcode detected and processed : [" + result.codeResult.code + "]"
      // );
      document.querySelector('input[name="producto_codigoserial"]').value =
        result.codeResult.code;
    });
  };

  // todo: detalle del producto a vender

  //todo::detalle de factura a vender

  this.limpiarInputs = () => {
    this.producto_idE.value = "";
    this.producto_codigoserial.value = "";
    this.producto_stock.value = "";
    this.producto_comprar.value = "";
    this.ubicacion_descripcion.value = "";
    this.producto_codigoserial.focus();
  };
  this.listarTipoSucursalO = (id_producto) => {
    var select = id_producto;
    const formId = new FormData();
    formId.append("id", select);
    fetch("../controllers/sucursal/obtenerSucursalReferencia.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='sucursal_id' id='sucursal_id' autofocus required onChange='app.obtenerValorO()'>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.sucursal_id +
            "'>" +
            element.sucursal_provincia +
            " - " +
            element.sucursal_nombre;
          ("</option>");
        });
        html += "</select>";
        this.ubicacion_sucursal_o.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  this.obtenerValorO = () => {
    var select = document.getElementById("sucursal_id");
    var codigo_serie = document.getElementById("producto_codigoserial");
    const formId = new FormData();
    formId.append("id", select.value);
    formId.append("codigo_serie", codigo_serie.value);
    fetch("../controllers/bodega/obtenerBodegaReferenciaS.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='bodega_id_o' id='bodega_id_o' autofocus required onChange='app.obtenerStok()'>";
        // html +=
        //   "<option disabled='selected' selected='selected'>Seleccione</option>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";

        data.forEach((element) => {
          html +=
            "<option value='" +
            element.bodega_id +
            "'>" +
            element.bodega_descripcion +
            " - " +
            element.tipobodega_especificacion +
            " - " +
            element.tipobodega_capacidad;
          ("</option>");
        });
        html += "</select>";
        this.ubicacion_bodega_o.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  //listado de la ubicaicon dentro de bodega
  this.obtenerStok = () => {
    var selectBodega = document.getElementById("bodega_id_o").value;
    var producto_codigoserial = document.getElementById(
      "producto_codigoserial"
    ).value;
    const formId = new FormData();
    formId.append("id_bodega", selectBodega);
    formId.append("producto_codigoserial", producto_codigoserial);
    fetch("../controllers/ubicacion/obtenerstockUbicacionReferenciasxBodega.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='percha_bodega_o' id='percha_bodega_o'  autofocus required onChange='app.obtenerCantidadUbicacion()'>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        //html +=
        //  "<option disabled='selected' selected='selected'>Seleccione</option>";

        data.forEach((element) => {
          html +=
            "<option value='" +
            element.ubicacion_descripcion +
            "'>" +
            element.ubicacion_descripcion +
            " - " +
            element.ubicacion_cantidad;
          ("</option>");
        });
        html += "</select>";
        this.ubicacion_descripcion_o.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  //cantidad de datos
  this.obtenerCantidadUbicacion = () => {
    var selectBodega = document.getElementById("bodega_id_o").value;
    var producto_codigoserial = document.getElementById(
      "producto_codigoserial"
    ).value;
    var descripcion_ubicacion = document.getElementById(
      "ubicacion_descripcion_o"
    ).value;
    const formId = new FormData();
    formId.append("id_bodega", selectBodega);
    formId.append("producto_codigoserial", producto_codigoserial);
    formId.append("descripcion", descripcion_ubicacion);
    fetch("../controllers/ubicacion/obtenerstockUbicacionReferencias3.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        this.producto_stock.value = data["ubicacion_cantidad"];
        this.producto_idE.value = data["producto_id"];
        this.bodega_idE.value = data["bodega_id"];
      })
      .catch((error) => console.error(error));
  };
  //lista para nueva ubicacions
  this.listarTipoSucursal = () => {
    fetch("../controllers/sucursal/listadoSucursal.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='sucursal_id_d' id='sucursal_id_d' autofocus required onChange='app.obtenerValor()'>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.sucursal_id +
            "'>" +
            element.sucursal_provincia +
            " - " +
            element.sucursal_nombre;
          ("</option>");
        });
        html += "</select>";
        this.ubicacion_sucursal_r.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  this.obtenerValor = () => {
    var select = document.getElementById("sucursal_id_d");
    const formId = new FormData();
    formId.append("id", select.value);
    fetch("../controllers/bodega/obtenerBodegaReferencia.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='bodega_id' id='bodega_id' required >";
        // html +=
        //   "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.bodega_id +
            "'>" +
            element.bodega_descripcion +
            " - " +
            element.tipobodega_especificacion +
            " - " +
            element.tipobodega_capacidad;
          ("</option>");
        });
        html += "</select>";
        this.ubicacion_bodega_r.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };

  /*listar tipo de documento para ingreso de nuevo cliente
  Desarrollado por CREDP-S soluciones civiles y tecnologicas telf:0987139033*/

  //lista de cliente

  this.procesarFactura = () => {
    var cliente_id = document.getElementById("cliente_id").value;
    var id_vendedor = document.getElementById("id_vendedor").value;
    var comision_vende = document.getElementById("comision_vende").value;
    var forma_id = document.getElementById("forma_id").value;
    var comprobante_id = document.getElementById("comprobante_id").value;
    var factura_serie = document.getElementById("factura_serie").value;
    var factura_fechagenerada = document.getElementById(
      "factura_fechagenerada"
    ).value;
    var factura_iva = document.getElementById("factura_iva").value;
    var factura_subtotal = document.getElementById("factura_subtotal").value;
    var factura_total = document.getElementById("factura_total").value;
    var reserva_numero = document.getElementById("reserva_numero").value;
    var reserva_abono = document.getElementById("reserva_abono").value;
    var reserva_saldopendiente = document.getElementById(
      "reserva_saldopendiente"
    ).value;
    var reserva_fechafinal =
      document.getElementById("reserva_fechafinal").value;
    var pto_emision_id = document.getElementById("pto_emision_id").value;
    var id_establecimiento =
      document.getElementById("id_establecimiento").value;

    const formId = new FormData();
    formId.append("id_cliente", cliente_id);
    formId.append("id_vendedor", id_vendedor);
    formId.append("comision_vende", comision_vende);
    formId.append("forma_id", forma_id);
    formId.append("comprobante_id", comprobante_id);
    formId.append("factura_serie", factura_serie);
    formId.append("factura_fechagenerada", factura_fechagenerada);
    formId.append("factura_iva", factura_iva);
    formId.append("factura_subtotal", factura_subtotal);
    formId.append("factura_total", factura_total);
    formId.append("reserva_numero", reserva_numero);
    formId.append("reserva_abono", reserva_abono);
    formId.append("reserva_saldopendiente", reserva_saldopendiente);
    formId.append("reserva_fechafinal", reserva_fechafinal);
    formId.append("pto_emision_id", pto_emision_id);
    formId.append("id_establecimiento", id_establecimiento);
    fetch("../controllers/venta/procesarFactura.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        //$("btn-guardarFact");
        this.factura_id.value = data;
        $("#btn-guardarFact").hide();
        $("#btn-editarFact").show();
        $("#btn-enviarSRI").show();
        $("#tbody").hide();
        $("#tbodydetalle").show();
        toastr["info"]("Documento Guardado correctamente");
        this.listadoDetalleFactura(data);
      })
      .catch((error) => console.error(error));
  };
  this.validacionInputProducto = (formInput) => {
    if (formInput.get("producto_codigoserial") === "") {
      toastr["warning"]("EL codigo no a sido escrito , debe escribir uno..!");
      document.getElementById("producto_codigoserial").focus();
      return false;
    } else if (formInput.get("sucursal_id") === null) {
      toastr["warning"](
        "La sucursal origen es requederida, debe elegir uno..!"
      );
      this.ubicacion_sucursal_o.focus();
      return false;
    } else if (formInput.get("bodega_id_o") === null) {
      toastr["warning"](
        "La bodega  de origen es requerida, debe elegir uno..!"
      );
      this.bodega_id_o.focus();
      return false;
    } else if (formInput.get("sucursal_id_d") === null) {
      toastr["warning"](
        "El sucursal de destino es requirido, debe escribir uno..!"
      );
      this.sucursal_id_d.focus();
      return false;
    } else if (formInput.get("ubicacion_descripcion_o") === null) {
      toastr["warning"](
        "El la ubicacion de origen es requerida, debe escribir uno..!"
      );
      this.ubicacion_descripcion_o.focus();
      return false;
    } else if (formInput.get("producto_stock") === "") {
      toastr["warning"]("El campo stock es requirido, debe escribir uno..!");
      this.producto_stock.focus();
      return false;
    } else if (formInput.get("ubicacion_descripcion") === "") {
      toastr["warning"](
        "El ubicacion de destino es requirido, debe escribir uno..!"
      );
      this.ubicacion_descripcion.focus();
      return false;
    } else if (formInput.get("producto_comprar") === "") {
      toastr["warning"]("El campo cantidad es requirido, debe escribir uno..!");
      this.producto_comprar.focus();
      return false;
    } else {
      return true;
    }
  };
  this.ocultarInputs = () => {
    $("#btn-imprimir").hide();
  };
})();
app.ocultarInputs();
app.listarTipoSucursal();
app.listadoDetalleTemporal();
