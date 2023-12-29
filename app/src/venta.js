const app = new (function () {
  // todo: producto
  this.producto_id = document.getElementById("producto_id");
  this.producto_codigoserial = document.getElementById("producto_codigoserial");
  this.producto_lote = document.getElementById("producto_lote");
  this.producto_descripcion = document.getElementById("producto_descripcion");
  this.producto_stock = document.getElementById("producto_stock");
  this.producto_precioxMe = document.getElementById("producto_precioxMe");
  this.producto_precioxMa = document.getElementById("producto_precioxMa");
  this.producto_descuento = document.getElementById("producto_descuento");
  this.producto_comprar = document.getElementById("producto_comprar");
  this.codigoMensaje = document.getElementById("codigoMensaje");
  this.precio_xcantidad = document.getElementById("precio_xcantidad");
  this.bodega_id_o = document.getElementById("bodega_id_o");
  this.tipo_producto = document.getElementById("tipo_producto");
  this.temp_precio_add_stock = document.getElementById("temp_precio_add_stock");
  this.sucursal_identificador=document.getElementById("sucursal_identificador");
  this.bodega_identificador=document.getElementById("bodega_identificador");
  this.cantidadnueva_stock=document.getElementById("cantidadnueva_stock");
  this.descuento_producto=document.getElementById("descuento_producto");
  this.productosCombosVenta=document.getElementById("productosCombosVenta");
  this.forma_pago=document.getElementById("forma_pago");
  this.producto_codigobarra_id=document.getElementById("producto_codigobarra_id");
  this.producto_codigobarra_codigoserial=document.getElementById("producto_codigobarra_codigoserial");
  this.producto_codigobarra_preciomayor=document.getElementById("producto_codigobarra_preciomayor");
  this.producto_codigobarra_stock=document.getElementById("producto_codigobarra_stock");
  this.productocodigobarra=document.getElementById("productocodigobarra");
  //todo:: de servicio
  this.tipo_impuesto = document.getElementById("tipo_impuesto");
  this.porcentaje_iva = document.getElementById("porcentaje_iva");
  this.producto_bodegas = document.getElementById("producto_bodegas");
  //todo:cliente
  this.tipo_documentoC = document.getElementById("tipo_documentoC");
  this.idClienteVenta = document.getElementById("idClienteVenta");
  this.razonSocialClienteVenta = document.getElementById("razonSocialClienteVenta");
  this.rucClienteVenta = document.getElementById("rucClienteVenta");
  this.direccionClienteVenta = document.getElementById("direccionClienteVenta");
  //todo:vendedor
  this.selector_vendedor = document.getElementById("selector_vendedor");
  this.comision_vende = document.getElementById("comision_vende");
  this.precio_producto = document.getElementById("precio_producto");
  //todo:cliente buscar
  this.cliente_id = document.getElementById("cliente_id");
  this.cliente_razonsocial = document.getElementById("cliente_razonsocial");
  this.cliente_ruc = document.getElementById("cliente_ruc");
  this.cliente_telefono = document.getElementById("cliente_telefono");
  this.cliente_direccion = document.getElementById("cliente_direccion");
  this.cliente_email = document.getElementById("cliente_email");
  //this.tipo_documentoC = document.getElementById("tipo_documentoC");
  this.cliente_contacto = document.getElementById("cliente_contacto");
  // todo: factura
  this.factura_id = document.getElementById("factura_id");
  this.factura_subtotal = document.getElementById("factura_subtotal");
  this.factura_total = document.getElementById("factura_total");
  this.factura_total_pago = document.getElementById("factura_total_pago");
  this.selectorCliente = document.getElementById("selector_cliente");
  this.selectorFormapago = document.getElementById("selector_formapago");
  this.selectorComprobante = document.getElementById("selector_comprobante");
  this.reserva_abono = document.getElementById("reserva_abono");
  this.reserva_saldopendiente = document.getElementById(
    "reserva_saldopendiente"
  );
  this.factura_serie = document.getElementById("factura_serie");
  this.reserva_numero = document.getElementById("reserva_numero");
  this.fecha_inicio = document.getElementById("factura_fechagenerada");
  this.reserva_fechafinal = document.getElementById("reserva_fechafinal");
  this.pto_emision_id = document.getElementById("pto_emision_id");
  this.id_establecimiento = document.getElementById("id_establecimiento");
  this.ubicacion_descripcion_o = document.getElementById(
    "ubicacion_descripcion_o"
  );
  this.cantidadactual_stock = document.getElementById("cantidadactual_stock");
  this.producto_id_add_stock = document.getElementById("producto_id_add_stock");
  this.bodegaid_add_stock = document.getElementById("bodegaid_add_stock");
  this.ubicacion_descripcion_add_stock = document.getElementById("ubicacion_descripcion_add_stock");
  this.temp_id = document.getElementById("temp_id");

  this.factura_iva = document.getElementById("factura_iva");
  this.cantidadactual_stock = document.getElementById("cantidadactual_stock");
  // todo: detalle temporal
  this.tbody = document.getElementById("tbody");
  this.tbody2 = document.getElementById("tbody2");
  this.tbodyR=document.getElementById("tbodyR");
  this.productoStock = document.getElementById("productoStock");
  this.clientesl=document.getElementById("clientesl");
  this.tbodydetalle = document.getElementById("tbodydetalle");

  this.productosListado = document.getElementById("productosListado");

  this.listadoProductosVenta = () => {
    var sucursalid = this.sucursal_identificador.value;
    var bodegaid = this.bodega_identificador.value;
    fetch("../controllers/venta/listadoProductoVenta.php")
      .then((response) => response.json())
      .then((data) => {
        this.productocodigobarra.focus();
        permisos = data.permisosMod;
        data=data.data;
        html =
          "<table class='table table-striped table-bordered first' id='example11'>";
        html += "<thead>";
        html += "<tr>";
        html +=
          "<th>Imagen</th>";
        html += "<th>Descripción producto</th>";
        html += "<th>Stock</th>";
        if (permisos["u"] === "1"){
        html += "<th>Opciones</th>";
        }
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        data.forEach((element) => {
          html += "<tr>";
          if(element.producto_imagen === "Sin Imagen" || element.producto_imagen ===  "../../img/"){
            html +=
          "<td style='width:25%'><center><img src='../img/product.png' style='width:100%;' onclick='app.agregarDetalleTemporalVentaDirecta("+element.producto_id+","+sucursalid+","+bodegaid+","+element.producto_codigoserial+","+element.producto_precio_mayor+","+element.producto_stock+")'></center></td>";
          }else{
            const cadena = element.producto_imagen;
            let imagen = cadena.slice(3);
            html += "<td style='width:25%'><center><img src="+imagen+" style='width:100%;' onclick='app.agregarDetalleTemporalVentaDirecta("+element.producto_id+","+sucursalid+","+bodegaid+","+element.producto_codigoserial+","+element.producto_precio_mayor+","+element.producto_stock+")' ></center></td>";
          }
          html +=
          "<td style='width:50%'><a onclick='app.agregarDetalleTemporalVentaDirecta("+element.producto_id+","+sucursalid+","+bodegaid+","+element.producto_codigoserial+","+element.producto_precio_mayor+","+element.producto_stock+")'><a onclick='app.agregarDetalleTemporalVentaDirecta("+element.producto_id+","+sucursalid+","+bodegaid+","+element.producto_codigoserial+","+element.producto_precio_mayor+","+element.producto_stock+")'> <strong> Código Producto: " +
          element.producto_codigoserial +
          "</strong><br/><strong>Referencia: " +
          element.producto_codigoreferencia +
          "</strong><br/><strong>Descripción: " +
          element.producto_descripcion +
          "</strong><br/>Precio: $ " +
          element.producto_precio_mayor +
          "</a></td>";
          html += "<td style='width:25%'><a onclick='app.agregarDetalleTemporalVentaDirecta("+element.producto_id+","+sucursalid+","+bodegaid+","+element.producto_codigoserial+","+element.producto_precio_mayor+","+element.producto_stock+")'> "+element.producto_stock+"</a></td>"
        //  html += "<td><button type='button' class='btnVentasMes btn btn-info btn-sm' data-toggle='modal' style='background:#4ab935;border-color:#4ab935; border-radius: 50%;width: 40px;height: 40px;'  title='Añadir'  onclick='app.agregarDetalleTemporalVentaDirecta("+element.producto_id+","+sucursalid+","+bodegaid+","+element.producto_codigoserial+","+element.producto_precio_mayor+","+element.producto_stock+")'><i class='fa fa-plus'></i></button></td>"; 
        if (permisos["u"] === "1"){
          html += "<td><button type='button' class='btnVentasMes btn btn-info btn-sm' data-toggle='modal' style='border-radius: 50%;width: 40px;height: 40px;' data-target='#exampleModalProductoStock' title='Lista' data-toggle='modal' onclick='app.modallistarProductoStock("
          +element.producto_id+")'><i class='fas fa-search'></i></button></td>";
         }
        });
        html +=
          "</tr></tbody></table>";
        this.productosListado.innerHTML = html;
        $("#example11").DataTable({
          paging:false,
          scrollY:400,
          iDisplayLength: 4,
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
          "resonsieve":"true"
        });
      })
      .catch((error) => console.error(error));
  };
  this.agregarDetalleTemporalVentaDirecta = (producto_id,sucursal_id,bodega_id,producto_codigoserial,producto_precio_mayor,producto_stock) => {
    var producto_id = producto_id;
    var sucursal_id = sucursal_id;
    var bodega_id = bodega_id;
    var producto_codigoserial = producto_codigoserial;
    var producto_descripcion = producto_descripcion;
    var producto_precio_mayor = producto_precio_mayor;
    var cantidadvender = 1;
    const formId = new FormData();
    formId.append("producto_id",producto_id);
    formId.append("sucursal_id",sucursal_id);
    formId.append("bodega_id",bodega_id);
    formId.append("producto_codigoserial",producto_codigoserial);
    formId.append("producto_precio_mayor",producto_precio_mayor);
    formId.append("producto_stock",producto_stock);
    formId.append("precio_xcantidad",cantidadvender);

    fetch("../controllers/venta/guardarDetalleTemporalDirecta.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data === 1) {
          toastr["success"]("Producto agregado!");
          $("#tbody").show();
          this.listadoDetalleTemporal();
          this.listadoProductosVenta();
          this.productocodigobarra.value = "";
          //this.limpiarInputs();
          this.listadoProductosVenta();
          this.listadoDetalleTemporal();
          $("#exampleModalProductoStock").modal("hide");
          this.productocodigobarra.focus();
        } else if (data === 2) {
          toastr["warning"](
            "Cantidad a vender es superior al inventario!"
          );
          this.producto_comprar.focus();
        } else if (data === 3) {
          toastr["warning"](
            "No se a seleccionado ningun producto!"
          );
          this.producto_comprar.focus();
        }
      })
      .catch((err) => console.error(err));
};

  //todo::todo los datos de la tabla detalle temporal
  this.listadoDetalleTemporal = () => {
    fetch("../controllers/venta/listadoDetalleTemporal.php")
      .then((response) => response.json())
      .then((data) => {
        if (data.length > 0) {
          html = [];
          html+='<table class="table table-bordered text-center" id="example10">';
          html+=' <thead>';
          html+='  <tr>';
          html+='   <th hidden>Id</th>';
          html+='   <th>Código</th>';
          html+='  <th>Descripción</th>';
          html+='  <th>Cantidad</th>';
          html+='  <th>Precio x U</th>';
          html+='   <th>Descuento</th>';
          html+='   <th>Total</th>';
          html+='  <th style="width: 40px">Opciones</th>';
          html+='  </tr>';
          html+=' </thead>';
          html+=' <tbody id="tbody">';
          data.forEach((element) => {
            html += "<tr>";
            html += "<td hidden>"+element.temp_id+"</td>"
            if (element.temp_tipo_producto === 'C'){
              html +=
                  "<td><strong><a onClick='app.listadoCombosProductoVenta(" +
                  element.temp_idproducto +
                  ")'>" + element.temp_serialproducto + "<br/><i class='fas fa-eye'></i></a></strong></td>";
            }else{
              html +=
              "<td><strong>" + element.temp_serialproducto + "</strong></td>";
            }
            html +=
              "<td><strong>" + element.temp_descripcion + "</strong></td>";
            html += "<td><strong>" + element.temp_cantvender + "</strong></td>";
            html += "<td><strong>" + element.temp_precio + "</strong></td>";
            html +=
              "<td><strong>" + element.temp_descuento + " </strong></td>";
            html += "<td><strong>" + element.temp_total + "</strong></td>";
            html += "<td>";
            html +=
              '<button type="button" style="border-radius: 50%;width: 35px;height: 35px; margin:0% 2% 0% 0%" data-toggle="modal" data-target="#exampleModalNuevoStock" class="btn btn-space btn-primary" title="Editar" onClick="app.modificar(' +
              element.temp_idproducto +
              "," +
              element.temp_cantvender +
              "," +
              element.temp_bodegaid_o +
              ",'" +
              element.temp_descripcionu +
              "'," +
              element.temp_id +
              "," +
              element.temp_precio +
              ')"><i class="fa fa-edit"></i></button>';
            html +=
              '<button type="button" style="border-radius: 50%;width: 35px;height: 35px;" class="btn btn-danger btn-sm" title="ELiminar" onClick="app.eliminar(' +
              element.temp_idproducto +
              "," +
              element.temp_cantvender +
              "," +
              element.temp_bodegaid_o +
              ",'" +
              element.temp_descripcionu +
              "'," +
              element.temp_id +
              ')"><i class= "fa fa-trash"></i></button>';
              html += "</td>";
              html += "</tr>";
          });
          html+='</tbody></table>';
          this.tbody.innerHTML = html;
          $("#example10").DataTable({
            searching: false,
            length: false,
            paging:false,
            scrollY:400,
            info:false,
            iDisplayLength: 5,
            order:[[0,"desc"]],
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
            }
              });
              this.sumarSubTotal();
              
        } else {
          this.tbody.innerHTML =
            "<tr><td colspan='6'>No hay detalles de productos</td></tr>";
          this.factura_subtotal.value = "0.00";
          this.factura_total.value = "0.00";
          this.factura_iva.value = "0.00";
        }
      })
      .catch((error) => console.error(error));
  };
  //todo::todo los datos de la tabla detalle factura
  this.listadoDetalleFactura = (id_factura) => {
    //todo::editarFactura llamado de los datos
    const formId = new FormData();
    //console.log(id_factura);
    formId.append("id_factura", id_factura);
    //fetch("../controllers/producto/obtenerProductoSerial.php", {
    fetch("../controllers/venta/listadoDetalleFactura.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.length >= 0) {
          html = [];
          html+='<table class="table table-bordered text-center" id="example12">';
          html+=' <thead>';
          html+='  <tr>';
          html+='   <th>Código</th>';
          html+='  <th>Descripción</th>';
          html+='  <th>Cantidad</th>';
          html+='  <th>Precio x U</th>';
          html+='   <th>Descuento </th>';
          html+='   <th>Total</th>';
          html+='  <th style="width: 40px">Opciones</th>';
          html+='  </tr>';
          html+=' </thead>';
          html+=' <tbody id="tbody">';
          data.forEach((element) => {
            html += "<tr>";
            html +=
              "<td><strong>" + element.producto_codigoserial + "</strong></td>";
            html +=
              "<td><strong>" + element.producto_descripcion + "</strong></td>";
            html += "<td><strong>" + element.detafact_cantidad + "</strong></td>";
            html += "<td><strong>" + element.detafact_preciounitario + "</strong></td>";
            html +=
              "<td><strong>" + element.detafact_descuento + " </strong></td>";
            html += "<td><strong>" + element.detafact_total + "</strong></td>";
            html +=
              '<td><button type="button" style="border-radius: 50%;width: 50px;height: 50px;" class="btn btn-danger btn-sm" title="ELiminar" onClick="app.eliminar(' +
              element.producto_id +
              "," +
              element.detafact_cantidad +
              "," +
              element.temp_bodegaid_o +
              ",'" +
              element.temp_descripcionu +
              "'," +
              element.temp_id +
              ')"><i class= "fa fa-trash"></i></button></td>';
            html += "</tr>";
          });
          html+='</tbody></table>';
          this.tbodyR.innerHTML = html;
          $("#example12").DataTable({
            searching: false,
            length: false,
            language: {
              lengthMenu: "",
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
            "resonsieve":"true",
            "bDestroy": true,
            "iDisplayLength": 3,
            "order":[[0,"desc"]]
              });
          this.sumarSubTotalDeFactura(id_factura);
        } else {
          this.tbodyR.innerHTML =
            "<tr><td colspan='6'>No hay detalles de productos</td></tr>";
          this.factura_subtotal.value = "0";
          this.factura_total.value = "0";
          this.factura_iva.value = "0";
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
  this.listarFormaPago = () => {
    fetch("../controllers/forma/listadoFormaPago.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='forma_id' id='forma_id' autofocus required>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
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
  this.listarComprobante = () => {
    fetch("../controllers/comprobante/listadoComprobante.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='comprobante_id' id='comprobante_id' autofocus required onChange='app.mostrarInputs()'>";
        html +=
          "<option disabled='selected' value = '2' selected='selected'>COMPROBANTE DE SALIDA</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.comprobante_id +
            "'>" +
            element.comprobante_descripcion +
            "</option>";
        });
        html += "</select>";
        this.selectorComprobante.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };

  //todo::todo los imputs para la reserva
  this.mostrarInputs = () => {
    var comprobante_tipo = document.getElementById("comprobante_id");
    if(comprobante_tipo === null){
      var comprobante_id = document.getElementById("comprobanteidentificador");
      //$("#comprobante_id").val(comprobante_id.value);
    }else{
      var comprobante_id = document.getElementById("comprobante_id");
    }
    //var comprobante_id = document.getElementById("comprobanteidentificador");
    //$("#comprobante_id").val(comprobante_id.value).trigger("change");
    //$("#comprobante_id").val(comprobante_id.value).trigger("change");
    fetch("../controllers/ptoemision/obtenerPtoemisionSucur.php")
      .then((response) => response.json())
      .then((data) => {
        if (comprobante_id.value === "1") {
          this.factura_serie.value = data[0].secuencialFactura;
          this.id_establecimiento.value = data[0].establecimiento_id;
          this.pto_emision_id.value = data[0].idptemision;
          $("#div_saldo_pen").hide();
          $("#div_fecha_fin").hide();
          $("#div_abono").hide();
          $("#div_reserva").hide();
          $("#div_serie").show();
        } else if (comprobante_id.value === "2") {
          this.factura_serie.value = data[0].secuencialLiquidacionCompra;
          this.id_establecimiento.value = data[0].establecimiento_id;
          this.pto_emision_id.value = data[0].idptemision;
          $("#div_saldo_pen").hide();
          $("#div_fecha_fin").hide();
          $("#div_abono").hide();
          $("#div_reserva").hide();
          $("#div_serie").show();
        } else {
          this.reserva_numero.value = data[0].secuencia_reserva;
          this.id_establecimiento.value = data[0].establecimiento_id;
          this.pto_emision_id.value = data[0].idptemision;
          $("#div_saldo_pen").show();
          $("#div_fecha_fin").show();
          $("#div_abono").show();
          $("#div_reserva").show();
          $("#div_serie").hide();
        }
      })
      .catch((error) => console.error(error));
  };

  //todo::tipo de producto
  this.tipospagoventa = (identificador) => {
    if(identificador === 1){
      this.forma_pago.value = 1;
      $("#cambios").show();
    }else if(identificador === 5){
      this.forma_pago.value = 5;
      $("#cambios").hide();
    } else if(identificador === 2){
      this.forma_pago.value = 2;
      $("#cambios").hide();
    } else if(identificador === 4){
      this.forma_pago.value = 4;
      $("#cambios").hide();
    }else if(identificador === 7){
      this.forma_pago.value = 7;
      $("#cambios").hide();
    }else{
      this.forma_pago.value = null;
    }
  };

  //todo::tipo de producto
  this.ocultarInputsProducto = () => {
    this.tipo_producto = document.getElementById("tipo_producto");
    if (tipo_producto.value === "S") {
      $("#div_ubica_o").hide();
      $("#div_lote").hide();
      $("#div_precioMod").hide();
      $("#div_precioCompra").hide();
      $("#div_precioMay").show();
      $("#btn_servicios").show();
      $("#btn_producto").hide();
      $("#div_vendedor").show();
      $("#div_comision").show();
      $("#div_tipo_impuesto").show();
      $("#div_porcentaje_impuesto").show();
      $("#producto_stock").attr("readonly", false); 
      this.producto_id.value = "";
      this.producto_lote.value = "";
      this.producto_descripcion.value = "";
      this.producto_stock.value = "";
      this.producto_precioxMa.value = "";
      this.producto_precioxMe.value = "";
      this.producto_codigoserial.value = "";
    } else {
      $("#div_ubica_o").show();
      $("#div_lote").show();
      $("#div_precioMod").show();
      $("#div_precioMay").show();
      $("#btn_servicios").hide();
      $("#btn_producto").show();
      $("#div_vendedor").show();
      $("#div_comision").show();
      $("#div_tipo_impuesto").hide();
      $("#div_porcentaje_impuesto").hide();
      $("#producto_stock").attr("readonly", true); 
      this.producto_id.value = "";
      this.producto_lote.value = "";
      this.producto_descripcion.value = "";
      this.producto_stock.value = "";
      this.producto_precioxMa.value = "";
      this.producto_precioxMe.value = "";
      this.producto_codigoserial.value = "";
    }
  };
  this.guardarServicio = () => {
    var id_factura = document.getElementById("factura_id").value;
    const form = new FormData(document.getElementById("productoform"));
    if (this.validacionInputProducto(form) === true) {
      if (id_factura === "0") {
        fetch("../controllers/venta/guardarServicio.php", {
          method: "POST",
          body: form,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === 1) {
              toastr["success"]("Producto agregado!");
              this.listadoDetalleTemporal();

              $("#tbody").show();
              this.limpiarInputs();
            } else if (data === 2) {
              toastr["warning"](
                "Cantidad a comprar es superior al inventario!"
              );
              this.producto_comprar.focus();
            }
          })
          .catch((err) => console.error(err));
      }
    }
  };
  //imputs ocultos por defecto para reserva
  this.ocultarInputs = () => {
    $("#div_saldo_pen").hide();
    $("#div_fecha_fin").hide();
    $("#div_abono").hide();
    $("#div_reserva").hide();
    $("#div_ptoemisin_id").hide();
    $("#div_ptestablecimiento").hide();
    $("#btn-editarFact").hide();
    $("#btn-enviarSRI").hide();
    $("#tbodydetalle").hide();
    $("#btn_servicios").hide();
    $("#div_porcentaje_impuesto").hide();
    $("#div_tipo_impuesto").hide();
  };

  // todo: lista de producto a  vender
  this.listadoCombosProductoVenta = (id) => {
    $("#exampleModalCombosVenta").modal("show");
    const formId = new FormData();
    formId.append("idProducto", id);
    fetch("../controllers/combos/listadoProductoCombos.php",{
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example11'>";
        html += "<thead>";
        html += "<tr>";
        html += "<th>Código producto</th>";
        html += "<th>Descripción producto</th>";
        html += "<th>Cantidad</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        data.forEach((element) => {
          html += "<tr>";
          html += "<td>" + element.producto_codigoserial + "</td>";
          html += "<td>" + element.producto_descripcion + "</td>";
          html += "<td>" + element.cantidad + "</td>";
        });
        html +=
          "</tr></tbody></table>";
        this.productosCombosVenta.innerHTML = html;
        $("#example11").DataTable({
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
          "resonsieve":"true",
            "bDestroy": true,
            "iDisplayLength": 5,
            "order":[[0,"desc"]]
        });
      })
      .catch((error) => console.error(error));
  };

    // todo: lista de producto a  vender stock
    this.modallistarProductoStock = (codigoproducto) => {
        var idCodigoProducto = codigoproducto;
        const formId = new FormData();
        formId.append("id_codigo",idCodigoProducto);
        fetch("../controllers/ubicacion/obtenerstockUbicacionReferenciasVenta.php", {
          method: "POST",
          body: formId,
        })
        .then((response) => response.json())
        .then((data) => {
          html =
            "<table class='table table-striped table-bordered first' id='example2'>";
          html += "<thead>";
          html += "<tr>";
          html +=
            "<th>Sucursal</th><th>Bodegas</th><th>Ubicación</th><th>Cantidad</th><th>Opciones</th>";
          html += "</tr>";
          html += "</thead>";
          html += "<tbody>";
          data.forEach((element) => {
            html += "<tr>";
            html +=
              "<td><center></center>" +
              element.sucursal_nombre +
              "</td>";
            html +=
              "<td><center></center>" +
              element.bodega_descripcion +
              "</td>";
            html +=
              "<td><center></center>" +
              element.ubicacion_descripcion +
              "</td>";
              html +=
              "<td><center></center>" +
              element.ubicacion_cantidad +
              "</td>";
            html += '<td><button type="button" class="btnVentasMes btn btn-info btn-sm" data-toggle="modal" style="background:#4ab935;border-color:#4ab935; border-radius: 50%;width: 40px;height: 40px;"  title="Añadir"  onclick="app.agregarDetalleTemporalVenta('+element.producto_id+','+element.ubicacion_id+','+element.bodega_id+','+element.producto_codigoserial+','+element.producto_precio_mayor+','+element.producto_stock+','+element.ubicacion_cantidad+')"><i class="fa fa-plus"></i></button></td>';
            });
          //")'><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-success btn-sm' title='Ubicacion' onClick='app.ubicacion(" +
          //  element.producto_id +
          html +=
            "</tr></tbody><tfoot><tr><th>Sucursal</th><th>Bodegas</th><th>Ubicación</th><th>Cantidad</th><th>Opciones</th></tr></tfoot></table>";
          this.productoStock.innerHTML = html;
          $("#example2").DataTable({
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
        // todo: agregar productos a  vender stock
        this.agregarDetalleTemporalVenta = (producto_id,ubicacion_id,bodega_id,producto_codigoserial,producto_precio_mayor,producto_stock,ubicacion_cantidad) => {
          var producto_id = producto_id;
          var ubicacion_id = ubicacion_id;
          var bodega_id = bodega_id;
          var producto_codigoserial = producto_codigoserial;
          var producto_precio_mayor = producto_precio_mayor;
          var ubicacion_descripcion = ubicacion_descripcion;
          var ubicacion_cantidad = ubicacion_cantidad;
          var cantidadvender = 1;
          const formId = new FormData();
          formId.append("producto_id",producto_id);
          formId.append("bodega_id",bodega_id);
          formId.append("ubicacion_id",ubicacion_id);
          formId.append("producto_codigoserial",producto_codigoserial);
          formId.append("producto_descripcion",producto_descripcion);
          formId.append("producto_precio_mayor",producto_precio_mayor);
          formId.append("producto_stock",producto_stock);
          formId.append("ubicacion_cantidad",ubicacion_cantidad);
          formId.append("precio_xcantidad",cantidadvender);
        
          fetch("../controllers/venta/guardarDetalleTemporalProducto.php", {
            method: "POST",
            body: formId,
          })
            .then((response) => response.json())
            .then((data) => {
              if (data === 1) {
                toastr["success"]("Producto agregado!");
                $("#tbody").show();
                this.listadoDetalleTemporal();
                this.limpiarInputs();
                this.listadoDetalleTemporal();
                $("#exampleModalProductoStock").modal("hide");
              } else if (data === 2) {
                toastr["warning"](
                  "Cantidad a comprar es superior al inventario!"
                );
                this.producto_comprar.focus();
              } else if (data === 3) {
                toastr["warning"](
                  "No se a seleccionado ningun producto!"
                );
                this.producto_comprar.focus();
              }
            })
            .catch((err) => console.error(err));
      }
  // todo: lista de clientes
  this.modallistaClienteVenta = () => {
    fetch("../controllers/venta/listadoClienteVenta.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example6'>";
        html += "<thead>";
        html += "<tr>";
        html +=
          "<th>Datos</th><th>Contacto</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        data.forEach((element) => {
          html += "<tr>";
          html +=
            "<td><center><img src='../../public/images/clients.png' alt='logo box' width='50px'></center></td>";
          html +=
            '<td> <strong> <a type="button" onclick="app.ponerValorCodigo('+element.cliente_id+');"> Razon social: ' +
            element.cliente_razonsocial.toUpperCase() +
            '</strong><br/><strong>RUC: ' +
            element.cliente_ruc +
            '</strong><br/><u>Dirección: ' +
            element.cliente_direccion +
            '</u> </a> </td>';
          html +=
            '<td><i> <a type="button" onclick="app.ponerValorCodigo('+element.cliente_id+');"> Email: ' +
            element.cliente_email +
            '</i><br/><strong>Telefono: ' +
            element.cliente_telefono +
            '</strong><br/><u>Contacto: ' +
            element.cliente_contacto +
            '</u> </a> </td>';
        });
        //")'><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-success btn-sm' title='Ubicacion' onClick='app.ubicacion(" +
        //  element.producto_id +
        html +=
          "</tr></tbody><tfoot><tr><th>Imagen</th><th>Datos cliente</th><th>Contactos</th></tr></tfoot></table>";
        this.clienteVentaBuscar.innerHTML = html;
        $("#example6").DataTable({
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
//Nuevo cliente
  this.modalnuevoCliente = () => {
    const form = new FormData(document.getElementById("stockformclientes"));
    //   if (this.validacionInputModalStockAumentar(form) === true) {
         fetch("../controllers/cliente/guardarClienteVenta.php", {
           method: "POST",
           body: form,
         })
           .then((response) => response.json())
           .then((data) => {
             if (data) {
               Swal.fire(
                 "Registrado!",
                 "Nuevo cliente correctamente!",
                 "success"
               );
               $("#exampleModalNuevoCliente").modal("hide");
               this.cliente_id.value = data.cliente_id;
               this.razonSocialClienteVenta.value = data.cliente_razonsocial;
               this.rucClienteVenta.value = data.cliente_ruc;
               this.direccionClienteVenta.value = data.cliente_direccion;
               this.cliente_email.value = data.cliente_email;
               //document.getElementById("stockformclientes").reset();
             }else{
              Swal.fire(
                "icon: 'error'",
                "title: 'Error'",
                "text: 'No se pudo guardar el registro'"
              );
             }
           })
           .catch((error) => console.error(error));
      // }

  }
 
  
  //todo::traer datos de id producto
  //todo::poner lista clientes 
  this.modallistaCliente = () => {
    fetch("../controllers/cliente/listadoCliente.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example5'>";
        html += "<thead>";
        html += "<tr>";
        html +=
          "<th>Ruc</th><th>Identificación</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        data = data.data;
        data.forEach((element) => {
          html += "<tr>";
        
          html +=
            "<td><center><strong><a type='button' onclick='app.ponerValorRuc("+element.cliente_id +");'>" +
            element.cliente_ruc +
            "</a></strong></center></td>";

          html += "<td><a type='button' onclick='app.ponerValorRuc("+element.cliente_id +");'>" + element.cliente_razonsocial.toUpperCase() + "</a></td>";

        });
        //")'><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-success btn-sm' title='Ubicacion' onClick='app.ubicacion(" +
        //  element.producto_id +
        html +=
          "</tr></tbody><tfoot><tr><th>Ruc</th><th>Razon Social</th></tr></tfoot></table>";
        this.clientesl.innerHTML = html;
        $("#example5").DataTable({
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
  this.ponerValorCodigo=(codigo)=>{
    //console.log(codigo);
    var form = new FormData();
    form.append("producto_id", codigo);
    fetch("../controllers/venta/obtenerProductoID.php", {
      method: "POST",
      body: form,
    })
      .then((response) => response.json())
      .then((data) => {
        this.tipo_producto.value='P';
        this.producto_codigoserial.value=data.producto_codigoserial;
        app.obtenerProducto();
        $("#exampleModalProductos").modal("hide");

      })
    .catch((error) => console.error(error));
    //document.getElementById("ubicacionform").reset();
  }

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
          html +=
            "<td><button type='button' class='btn btn-info btn-sm' title='Editar' onClick='app.editar(" +
            element.cliente_id +
            ")'><i class='fas fa-pencil-alt'></i></button></td>";
        });
        
      })
      .catch((error) => console.error(error));
  };


  this.ponerValorRuc=(id)=>{
    var form = new FormData();
    form.append("id", id);
    fetch("../controllers/cliente/obtenerCliente.php", {
      method: "POST",
      body: form,
    })
      .then((response) => response.json())
      .then((data) => {
        this.cliente_id.value=data.cliente_id;
        this.razonSocialClienteVenta.value = data.cliente_razonsocial;
        this.rucClienteVenta.value = data.cliente_ruc;
        this.direccionClienteVenta.value = data.cliente_direccion;
        this.cliente_email.value = data.cliente_email;
        this.tipo_documentoC.value = data.codigo;
        $("#exampleModalClientes").modal("hide");
//        app.obtenerClienteR();
      })
    .catch((error) => console.error(error));
  };
  //todo::fin de la lista de productos hasta aqui poner todo
  this.obtenerProducto = () => {
    var form = new FormData();
    form.append("producto_codigoserial", this.producto_codigoserial.value);
    form.append("tipo_producto", this.tipo_producto.value);
    //fetch("../controllers/producto/obtenerProductoSerial.php", {
    fetch("../controllers/venta/obtenerProductoSerial.php", {
      method: "POST",
      body: form,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data) {
          if (this.tipo_producto.value === "P") {
            app.obtenerStok(data.bodega_id);
            this.bodega_id_o.value = data.bodega_id;
            this.producto_id.value = data.producto_id;
            this.producto_lote.value = data.lote_descripcion;
            this.producto_descripcion.value = data.producto_descripcion;
            // this.producto_stock.value = data.ubicacion_cantidad;
            this.producto_precioxMe.value = data.producto_precio_menor;
            this.producto_precioxMa.value = data.producto_precio_mayor;
            this.codigoMensaje.innerHTML =
              "<small class='text-success'>Código encontrado</small>";
          } else {
            this.bodega_id_o.value = data.bodega_id;
            this.producto_id.value = data.producto_id;
            this.producto_lote.value = data.lote_descripcion;
            this.producto_descripcion.value = data.producto_descripcion;
            this.producto_stock.value = data.producto_stock;
            this.producto_precioxMe.value = data.producto_precio_menor;
            this.producto_precioxMa.value = data.producto_precio_mayor;
            $("#div_porcentaje_impuesto").hide();
            $("#div_tipo_impuesto").hide();
            this.codigoMensaje.innerHTML =
              "<small class='text-success'>Código encontrado</small>";
          }
        } else {
          if (this.tipo_producto.value === "P") {
            this.producto_id.value = "";
            this.producto_lote.value = "";
            this.producto_descripcion.value = "";
            this.producto_stock.value = "";
            this.producto_precioxMa.value = "";
            this.producto_precioxMe.value = "";
            $("#div_porcentaje_impuesto").hide();
            $("#div_tipo_impuesto").hide();
            this.producto_codigoserial.focus();
            this.codigoMensaje.innerHTML =
              "<small class='text-danger'>Código no encontrado/Eliga otro</small>";
          } else {
            this.producto_id.value = "";
            this.producto_lote.value = "";
            this.producto_descripcion.value = "";
            this.producto_stock.value = "";
            this.producto_precioxMa.value = "";
            this.producto_precioxMe.value = "";
            $("#div_porcentaje_impuesto").show();
            $("#div_tipo_impuesto").show();
            this.producto_codigoserial.focus();
            this.codigoMensaje.innerHTML =
              "<small class='text-danger'>Código no encontrado/Nuevo</small>";
          }
        }
      })
      .catch((err) => console.error(err));
  };

  this.obtenerCliente = () => {
    var form = new FormData();
    form.append("ruc_cliente", this.rucClienteVenta.value);
    //fetch("../controllers/producto/obtenerProductoSerial.php", {
    fetch("../controllers/venta/obtenerClienteVenta.php", {
      method: "POST",
      body: form,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data) {
            //app.obtenerStok(data.bodega_id);
            this.cliente_id.value = data.cliente_id;
            this.razonSocialClienteVenta.value = data.cliente_razonsocial;
            this.rucClienteVenta.value = data.cliente_ruc;
            this.direccionClienteVenta.value = data.cliente_direccion;
            this.cliente_email.value = data.cliente_email;
        } 
      })
      .catch((err) => console.error(err));
  };

  this.obtenerProductoCodigo = () => {
    var sucursal_id = this.sucursal_identificador.value;
    var bodega_id = this.bodega_identificador.value;
    var productoid = document.getElementById("productocodigobarra").value;
    const formId = new FormData();
    formId.append("producto_codigo", productoid);
        fetch("../controllers/venta/agregarcodigobarra.php", {
          method: "POST",
          body: formId,
        })
          .then((response) => response.json())
          .then((data) => {
            this.producto_codigobarra_id.value=data.producto_id;
            this.producto_codigobarra_codigoserial.value=data.producto_codigoserial;
            this.producto_codigobarra_preciomayor.value=data.producto_precio_mayor;
            this.producto_codigobarra_stock.value=data.producto_stock;
            app.agregarDetalleTemporalVentaDirecta(data.producto_id,sucursal_id,bodega_id,data.producto_codigoserial,data.producto_precio_mayor,data.producto_stock);
          })
          .catch((err) => console.error(err));
  };

  //todo::enviaral sri y firmar
  this.firmarEnviar = () => {
    var formid = new FormData();
    var id_factura = this.factura_id.value;
    formid.append("id", this.factura_id.value);
    app.imprimirticket(id_factura);
    fetch("../controllers/factura/firmarEnviar.php", {
      method: "POST",
      body: formid,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.estado === true) {
          Swal.fire({
            title: "Factura Autorizada!",
            text: "Enviada al correo electronico correctamente!",
            icon: "success",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si",
          }).then((result) => {
            if (result.isConfirmed) {
              app.imprimir(id_factura);
              //this.generearPDF(id); /*
            }else{
              location.href = "../views/venta.php";
            }
          });
          /*Swal.fire(
            "Factura Autorizada!",
            "Enviada al correo electronico correctamente!",
            "success"location.href = "../views/venta.php";
          );
          */
        } else if (data.estado === 'proceso') {
          Swal.fire({
            title: "Error",
            text: data.mensaje+'Se imprimira la factura se debe esperar un maximo de 24 horas que el SRI notifique la autorizacion del documento',
            icon: "success",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si",
          }).then((result) => {
            if (result.isConfirmed) {
              app.imprimir(id_factura);
              //this.generearPDF(id); /*

            }
          });
          //location.href = "../views/venta.php";
        }else{
          Swal.fire({
            title: "Error",
            text: data.mensaje,
            icon: "error",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "../views/venta.php";
              //this.generearPDF(id); /*

            }
          });
        }
      })
      .catch((error) => console.error(error));
  };
  this.imprimir = (id) => {
    const formId = new FormData();
    //this.generearPDF(id); /*
    formId.append("id", id);
    fetch("../controllers/factura/obtenerCodigoFactura.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data) {
          var ancho = 1000;
          var alto = 800;
          var x = parseInt(window.screen.width / 2 - ancho / 2);
          var y = parseInt(window.screen.width / 2 - alto / 2);
          $url = data;

          window.open($url, "Factura", "width=1000,height=800,scrollbars=NO");
          location.href = "../views/venta.php";
        } else {
          Swal.fire("ERROR!", "El archivo pdf no existe", "warning");
        }
      })
      .catch((error) => console.error(error));
  };
  /*impresion del ticket*/
    this.imprimirticket=(id_factura)=>{
                var ancho = 1000;
                var alto = 800;
                var x = parseInt(window.screen.width / 2 - ancho / 2);
                var y = parseInt(window.screen.width / 2 - alto / 2);
                $url = "../../app/utils/factura/generarTicket.php?cl=1" + "&f=" + id_factura;
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
  };
  this.imprimirticketC=(id_factura)=>{
    var ancho = 1000;
    var alto = 800;
    var x = parseInt(window.screen.width / 2 - ancho / 2);
    var y = parseInt(window.screen.width / 2 - alto / 2);
    $url = "../../app/utils/factura/generarTicketC.php?cl=1" + "&f=" + id_factura;
    window.open(
      $url,
      "Comprobante de Salida",
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
  this.obtenerStok = (bodega_id) => {
    var selectBodega = bodega_id;
    var producto_codigoserial = document.getElementById(
      "producto_codigoserial"
    ).value;
    const formId = new FormData();
    formId.append("id_bodega", selectBodega);
    formId.append("producto_codigoserial", producto_codigoserial);
    fetch("../controllers/ubicacion/obtenerstockUbicacionReferencias.php", {
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
            "<option value='" +element.bodega_id+"/"+
            element.ubicacion_descripcion +
            "'>" +
            element.bodega_descripcion+"-"+
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
  this.obtenerCantidadUbicacion = () => {
    var selectBodega = document.getElementById("bodega_id_o").value;
    var producto_codigoserial = document.getElementById(
      "producto_codigoserial"
    ).value;
    var descripcion_ubicacion = document.getElementById(
      "ubicacion_descripcion_o"
    ).value;
    let arr = descripcion_ubicacion.split('/');
    var descripcion_ubicacion=arr[1];
    var selectBodega=arr[0];

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
        //this.producto_idE.value = data["producto_id"];
        //this.bodega_idE.value = data["bodega_id"];
      })
      .catch((error) => console.error(error));
  };
  //todo::guardado de los datos del cliente
  this.guardarCliente = () => {
    const form = new FormData(document.getElementById("clienteVform"));
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
              app.obtenerCliente();
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
  //todo::validar campos de cliente vacios
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
    } else if (formInput.get("cliente_direccion") === "") {
      toastr["warning"]("El campo email es requirido, debe escribir uno..!");
      this.cliente_direccion.focus();
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
  //todo::eliminar producto de tabla temporal
  this.modificar = (
    producto_id,
    temp_cantvender,
    temp_bodegaid_o,
    temp_descripcionu,
    temp_id,
    temp_precio
  ) => {
    const formModificar = new FormData();
    formModificar.append("producto_id", producto_id);

    fetch("../controllers/venta/obtenerPorcentaje.php", {
      method: "POST",
      body: formModificar,
    })
      .then((response) => response.json())
      .then((data) => {
        if(data.producto_porcentaje === '1'){
          this.cantidadactual_stock.value = temp_cantvender;
          this.producto_id_add_stock.value = producto_id;
          this.bodegaid_add_stock.value = temp_bodegaid_o;
          this.ubicacion_descripcion_add_stock.value = temp_descripcionu;
          this.temp_id.value = temp_id;
          this.temp_precio_add_stock.value=temp_precio;
          this.precio_producto.value=temp_precio;
        } else if(data.producto_porcentaje === '2'){
          this.cantidadactual_stock.value = temp_cantvender;
          this.producto_id_add_stock.value = producto_id;
          this.bodegaid_add_stock.value = temp_bodegaid_o;
          this.ubicacion_descripcion_add_stock.value = temp_descripcionu;
          this.temp_id.value = temp_id;
          this.temp_precio_add_stock.value=(temp_precio*1.12).toFixed(2);
          this.precio_producto.value=(temp_precio*1.12).toFixed(2);
        }
      })
      .catch((err) => console.error(err));
  };

  this.modalnuevaCantidadStock = () => {
    
    const form = new FormData(document.getElementById("stockformnuevacantidad"));
   
        fetch("../controllers/venta/actualizarFilaDetalleTemporal.php", {
          method: "POST",
          body: form,
        })
      .then((response) => response.json())
      .then((data) => {
        if (data === 1) {
          toastr["info"]("Cantidad actualizada detalle factura!");
          $("#exampleModalNuevoStock").modal("hide");
          this.listadoDetalleTemporal();
          this.limpiarInputStock();
          this.listadoProductosVenta();
        }
        if(data === 2){
          toastr["error"]("La cantidad ingresada supera al stock disponible!");
          this.listadoDetalleTemporal();
          this.limpiarInputStock();
          this.listadoProductosVenta();
        }
        if(data === 3){
          toastr["error"]("No se puede agregar la cantidad!");
          this.listadoDetalleTemporal();
          this.listadoProductosVenta();
        }
      })
      .catch((err) => console.error(err));
  };

  //todo::eliminar producto de tabla temporal
  this.eliminar = (
    producto_id,
    temp_cantvender,
    temp_bodegaid_o,
    temp_descripcionu,
    temp_id
  ) => {
    const formEliminar = new FormData();
    formEliminar.append("producto_id", producto_id);
    formEliminar.append("temp_cantvender", temp_cantvender);
    formEliminar.append("bodega_id_o", temp_bodegaid_o);
    formEliminar.append("ubicacion_descripcion", temp_descripcionu);
    formEliminar.append("temp_id", temp_id);

    fetch("../controllers/venta/eliminarFilaDetalleTemporal.php", {
      method: "POST",
      body: formEliminar,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data === 1) {
          toastr["error"]("Producto eliminado del detalle factura!");

          this.listadoDetalleTemporal();
          this.listadoProductosVenta();
        }
      })
      .catch((err) => console.error(err));
  };
  //todo::validar campos vacios producto
  this.validacionInputProducto = (formInput) => {
    if (formInput.get("tipo_producto") === null) {
      toastr["warning"]("El campo Tipo es requirido, debe elegir uno..!");
      this.tipo_producto.focus();
      return false;
    } else if (formInput.get("producto_codigoserial") === "") {
      toastr["warning"]("El codigo es obligatorio, debe escribir uno..!");
      this.producto_codigoserial.focus();
      return false;
    } else if (formInput.get("producto_comprar") === "") {
      toastr["warning"](
        "El campo cantidad es obligatorio, debe escribir uno..!"
      );
      this.producto_comprar.focus();
      return false;
    } else if (formInput.get("producto_stock") === "") {
      toastr["warning"]("La  ubicacion es necesario, debe escribir uno..!");
      this.ubicacion_descripcion_o.focus();
      return false;
    } else {
      return true;
    }
  };
  //todo::validar campos vacios factura
  this.validacionInputFactura = (formInput) => {
    if (formInput.get("comprobante_id") === 'Seleccione') {
      toastr["warning"]("El comprobante es requerido , debe elegir uno..!");
      document.getElementById("comprobante_id").focus();
      return false;
    } else if (formInput.get("forma_id") === "Seleccione") {
      toastr["warning"]("La forma de pago es necesaria, debe escribir uno..!");
      document.getElementById("forma_id").focus();
      return false;
    } else if (formInput.get("id_cliente") === "") {
      toastr["warning"]("El cliente es obligatorio, debe escribir uno..!");
      this.cliente_ruc.focus();
      return false;
    }
    return true;
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
    $("#producto_bodegas").val('P').trigger("change");
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
  this.sumarSubTotal = () => {
   // var iva = document.getElementById("factura_ivas").value;
    fetch("../controllers/venta/sumDetalleTemporal.php")
      .then((response) => response.json())
      .then((data) => {
        this.factura_subtotal.value = data.sin_impuesto;
        this.factura_total_pago.value ="$ "+ data.com_impuesto;
        this.factura_total.value = data.com_impuesto;
        this.factura_iva.value =  (this.factura_total.value - this.factura_subtotal.value).toFixed(2);
      })
      .catch((err) => console.error(err));
  };
  //todo::detalle de factura a vender
  this.sumarSubTotalDeFactura = (factura_id) => {
    const formId = new FormData();
    //console.log(id_factura);
    formId.append("id_factura", factura_id);
    //fetch("../controllers/producto/obtenerProductoSerial.php", {
    fetch("../controllers/venta/sumarSubTotalDeFactura.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        this.factura_subtotal.value = data.subtotal;
        this.factura_total.value = data.total;
        this.factura_iva.value =  (this.factura_total.value - this.factura_subtotal.value).toFixed(2);
        //abono = this.reserva_abono.value;modificar el valor de impuesto
        //this.reserva_saldopendiente = data.total - abono;
      })
      .catch((err) => console.error(err));
  };
  this.asignarAbono = () => {
    this.reserva_saldopendiente.value =
      this.factura_total.value - this.reserva_abono.value;
  };

  this.limpiarInputs = () => {
    //this.producto_lote.value = "";
    this.producto_descripcion.value = "";
    this.producto_stock.value = "";
    this.producto_precioxMe.value = "";
    this.producto_precioxMa.value = "";
    this.producto_comprar.value = "";
    this.producto_descuento.value = 0;
    this.ubicacion_descripcion_o.value =0;
    this.producto_codigoserial.focus();
    this.codigoMensaje.innerHTML =
      "<small class='text-primary'>Leer o escribir el código</small>";
  };

  this.limpiarInputStock = () => {
    this.cantidadnueva_stock.value = "";
    this.descuento_producto.value = "";
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

  this.listarVendedor = () => {
    fetch("../controllers/venta/listadoVendedor.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='id_vendedor' id='id_vendedor' autofocus required>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.vendedor_id +
            "'>" +
            element.vendedor_nombres +
            "</option>";
        });
        html += "</select>";
        this.selector_vendedor.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
/*
  //lista de cliente
  this.obtenerCliente = () => {
    var form = new FormData();
    if(this.cliente_ruc.value == null){
      this.cliente_ruc.value =9999999999;
    }
    form.append("cliente_ruc", this.cliente_ruc.value);
    //console.log(this.cliente_ruc.value);
    //fetch("../controllers/producto/obtenerProductoSerial.php", {
    fetch("../controllers/venta/obtenerClienteVenta.php", {
      method: "POST",
      body: form,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data) {
          console.log("id:"+data.cliente_id);
          this.cliente_id.value = data.cliente_id;
          this.cliente_razonsocial.value = data.cliente_razonsocial;
          this.cliente_ruc.value = data.cliente_ruc;
          this.cliente_telefono.value = data.cliente_telefono;
          this.cliente_direccion.value = data.cliente_direccion;
          this.cliente_email.value = data.cliente_email;
          this.cliente_contacto.value = data.cliente_contacto;
        }
      })
      .catch((err) => console.error(err));
  };*/
    //todo::traer los datos de clientes a indentificador para que busque 
    this.obtenerClienteR = () => {
      var form = new FormData();
      form.append("cliente_ruc", this.cliente_ruc.value);
      //fetch("../controllers/producto/obtenerProductoSerial.php", {
      fetch("../controllers/venta/obtenerCliente.php", {
        method: "POST",
        body: form,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data) {
            this.cliente_id.value = data.cliente_id;
            this.cliente_razonsocial.value = data.cliente_razonsocial;
            this.cliente_ruc.value = data.cliente_ruc;
            this.cliente_telefono.value = data.cliente_telefono;
            this.cliente_direccion.value = data.cliente_direccion;
            this.cliente_email.value = data.cliente_email;
            this.cliente_contacto.value = data.cliente_contacto;
            $("#id_tipodocumentov").val(data["id_tipodoc"]).trigger("change");
            this.codigoMensaje.innerHTML =
              "<small class='text-success'>Cliente encontrado</small>";
            $("#guardar_cliente").hide();
          } else {
            this.cliente_id.value = "";
            this.cliente_razonsocial.value = "";
            this.cliente_telefono.value = "";
            this.cliente_direccion.value = "";
            this.cliente_email.value = "";
            this.cliente_contacto.value = "";
            $("#id_tipodocumentov").val("Seleccione").trigger("change");
            this.cliente_ruc.focus();
            this.codigoMensaje.innerHTML =
              "<small class='text-danger'>Código no encontrado/Nuevo</small>";
            $("#guardar_cliente").show();
          }
        })
        .catch((err) => console.error(err));
    };

    this.metodoPago = () => {
      $("#exampleModalMetodoPago").modal("show");
      app.listarComprobante();
    }

  this.procesarFactura = () => {
    $("#exampleModalMetodoPago").modal("hide");
    var cliente_id = document.getElementById("cliente_id").value;
    var id_vendedor = document.getElementById("id_vendedor").value;
    var comision_vende = document.getElementById("comision_vende").value;
    //var forma_id = document.getElementById("forma_id").value;
    var forma_pago = document.getElementById("forma_pago").value;
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

      var razonsocial_cliente = document.getElementById("razonSocialClienteVenta").value;
      var ruc_cliente = document.getElementById("rucClienteVenta").value;
      var direccion_cliente = document.getElementById("direccionClienteVenta").value;
      var correo_cliente = document.getElementById("cliente_email").value;  


    const formId = new FormData();
    formId.append("id_cliente", cliente_id);
    formId.append("id_vendedor", id_vendedor);
    formId.append("comision_vende", comision_vende);
    formId.append("forma_id", forma_pago);
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
    formId.append("razonsocial_cliente", razonsocial_cliente);
    formId.append("ruc_cliente", ruc_cliente);
    formId.append("direccio_cliente", direccion_cliente);
    formId.append("correo_cliente", correo_cliente);
    
    if (this.validacionInputFactura(formId) === true) {
      fetch("../controllers/venta/procesarFactura.php", {
        method: "POST",
        body: formId,
      })
        .then((response) => response.json())
        .then((data) => {
          // console.log(data);
          //$("btn-guardarFact");
          if (data.id_tipo === 'F') {
            this.factura_id.value = data.id_factura;
            app.listadoDetalleFactura(data.id_factura);
            app.guardarFacturasinSri();
            $("#btn-guardarFact").hide();
            $("#btn-editarFact").hide();
            $("#btn-enviarSRI").show();
            $("#tbody").hide();
            $("#tbodydetalle").show();
            toastr["info"]("Factura Guardada correctamente");
          } else if (data.id_tipo === 'N') {/*todo los campos para impresion de nota de venta */
            app.imprimirticketC(data.id_factura);
            location.href = "../views/venta.php";
        /*
            Swal.fire({
              title: "Documento Guardado correctamente!",
              text: "Enviada al correo electronico correctamente!",
              icon: "success",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Si",
            }).then((result) => {
              if (result.isConfirmed) {
                var ancho = 1000;
                var alto = 800;
                var x = parseInt(window.screen.width / 2 - ancho / 2);
                var y = parseInt(window.screen.width / 2 - alto / 2);
                $url = "../../app/utils/factura/generarNotaventa.php?cl=1" + "&f=" + data.id_factura;
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
                location.href = "../views/venta.php";
              }else{
                location.href = "../views/venta.php";
              }
            });
        */
        
            //todo::regresaremos a un estado anterior si es el caso que no le paresca el diseño de
            //todo::notificacion cuando se realiza un procesode factura
            //toastr["info"]("Documento Guardada correctamente");
            //location.href = "../views/venta.php";

          } else {
            Swal.fire({
              title: "Documento Guardado correctamente!",
              text: "Enviada al correo electronico correctamente!",
              icon: "success",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Si",
            }).then((result) => {
              if (result.isConfirmed) {
                var ancho = 1000;
                var alto = 800;
                var x = parseInt(window.screen.width / 2 - ancho / 2);
                var y = parseInt(window.screen.width / 2 - alto / 2);
                $url = "../../app/utils/factura/generaFactura.php?cl=1" + "&f=" + data.id_factura;
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
                location.href = "../views/venta.php";
              }else{
                location.href = "../views/venta.php";
              }
            });
            //todo::regresaremos a un estado anterior si es el caso que no le paresca el diseño de
            //todo::notificacion cuando se realiza un procesode factura
            //toastr["info"]("Documento Guardada correctamente");
            //location.href = "../views/venta.php";
          }

        })
        .catch((error) => console.error(error));
    }
    
  };
  //todo::guardar factura sin enviar al SRI se aumenta un archivo php
  this.guardarFacturasinSri=()=>{
    var factura_id = document.getElementById("factura_id").value;
    const formId = new FormData();
    //console.log(id_factura);
    formId.append("id_factura", factura_id);
    //fetch("../controllers/producto/obtenerProductoSerial.php", {
    fetch("../controllers/venta/guardarFacturaPDF.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
       
      })
      .catch((err) => console.error(err));
  };
/*
  //todo::lista de tipo de impuesto
  this.listarTipoImpuesto = () => {
    fetch("../controllers/producto/listadoTipoImpuesto.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='tipo_impuesto_id' id='tipo_impuesto_id' autofocus required onChange='app.obtenerPorcentaje()'>"; //
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.codimp_id +
            "'>" +
            element.codimp_descripcion +
            "</option>";
        });
        html += "</select>";
        this.tipo_impuesto.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
*/
  this.obtenerPorcentaje = () => {
    var select = document.getElementById("tipo_impuesto_id");
    const formId = new FormData();
    formId.append("id", select.value);
    fetch("../controllers/producto/obtenerPorcentajesImpuesto.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='producto_bodegas' id='producto_bodegas' autofocus required >";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.tarifaiva_id +
            "'>" +
            //element.bodega_descripcion +
            //" - " +
            element.tarifaiva_porcentaje +
            " % " +
            "</option>";
        });
        html += "</select>";
        this.porcentaje_iva.innerHTML = html;

        //this.producto_bodegas2.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  this.ocultarCliente=()=> {
    $("#visualizarCliente").show();
    $("#div_cliente").hide();
    $("#ocultarCliente").hide();
  };
  this.visualizarCliente=()=> {
    $("#visualizarCliente").hide();
    $("#div_cliente").show();
    $("#ocultarCliente").show();
  };
  this.ocultarProductoVenta=()=> {
    $("#ocultarProductoVenta").hide();
    $("#div_producto_venta").hide();
    $("#visualizarProductoVenta").show();
  }
  this.visualizarProductoVenta=()=> {
    $("#ocultarProductoVenta").show();
    $("#div_producto_venta").show();
    $("#visualizarProductoVenta").hide();
  }
  this.ocultardivs=()=> {
    $("#visualizarCliente").hide();
    $("#div_precioCompra").hide();
    $("#visualizarProductoVenta").hide();
  }
this.calcularCambio=()=> {
  var efectivo = document.getElementById("factura_total");
  var total = document.getElementById("efectivo_entrega");
  var cambio=total.value-efectivo.value;
  this.efectivo_cambio=document.getElementById("efectivo_cambio");
  this.efectivo_cambio.value=(cambio.toFixed(2));
}
})();

//app.listarClientes();
app.listarFormaPago();
app.listarComprobante();
app.listadoDetalleTemporal();
app.listarTipodocumento();
app.listarVendedor();
app.ocultarInputs();
app.sumarSubTotal();
app.ocultardivs();
//app.listarTipoImpuesto();
app.listadoProductosVenta();
app.mostrarInputs();

