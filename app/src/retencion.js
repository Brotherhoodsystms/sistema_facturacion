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
    this.tipo_renta = document.getElementById("tipo_renta");
    //todo:: de servicio
    this.tipo_impuesto = document.getElementById("tipo_impuesto");
    this.porcentaje_iva = document.getElementById("porcentaje_iva");
    this.producto_bodegas = document.getElementById("producto_bodegas");
    //todo:cliente
    this.tipo_documentoC = document.getElementById("tipo_documentoC");
    //todo:vendedor
    this.selector_vendedor = document.getElementById("selector_vendedor");
    this.comision_vende = document.getElementById("comision_vende");
    //todo:cliente buscar
    this.cliente_id = document.getElementById("cliente_id");
    this.cliente_razonsocial = document.getElementById("cliente_razonsocial");
    this.cliente_ruc = document.getElementById("cliente_ruc");
    this.cliente_telefono = document.getElementById("cliente_telefono");
    this.cliente_direccion = document.getElementById("cliente_direccion");
    this.cliente_email = document.getElementById("cliente_email");
    this.tipo_documentoC = document.getElementById("tipo_documentoC");
    this.cliente_contacto = document.getElementById("cliente_contacto");
    // todo: factura
    this.factura_id = document.getElementById("factura_id");
    this.factura_subtotal = document.getElementById("factura_subtotal");
    this.factura_total = document.getElementById("factura_total");
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
    this.factura_iva = document.getElementById("factura_iva");
    // todo: detalle temporal
    this.tbody = document.getElementById("tbody");
    this.productos4 = document.getElementById("productos4");
    this.tbodydetalle = document.getElementById("tbodydetalle");
    //todo::todo los datos de la tabla detalle temporal
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
      this.ocultarInputsProducto = () => {
        this.tipo_producto = document.getElementById("tipo_producto");
        if (tipo_producto.value === "S") {
          $("#div_ubica_o").hide();
          $("#div_lote").hide();
          $("#div_precioMod").hide();
          $("#div_precioMay").hide();
          $("#btn_servicios").show();
          $("#btn_producto").hide();
          $("#div_vendedor").hide();
          $("#div_comision").hide();
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
      this.obtenerCliente = () => {
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
              this.cliente_email.value = " ";
              this.cliente_contacto = "";
              $("#id_tipodocumentov").val("Seleccione").trigger("change");
              this.cliente_ruc.focus();
              this.codigoMensaje.innerHTML =
                "<small class='text-danger'>Código no encontrado/Nuevo</small>";
              $("#guardar_cliente").show();
            }
          })
          .catch((err) => console.error(err));
      };
      this.listarporcentajesRenta=()=>{
    var selectTipoRenta = document.getElementById(
      "tipo_renta"
    ).value;
    const formId = new FormData();
    formId.append("tipo_renta", selectTipoRenta);
    fetch("../controllers/retencion/obtenerPorcentajes_renta.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        if (selectTipoRenta==='1'){
            html =
            "<select class='form-control' name='percha_bodega_o' id='percha_bodega_o'  autofocus required onChange='app.obtenerCantidadUbicacion()'>";
          html +=
            "<option disabled='selected' selected='selected'>Seleccione</option>";
          //html +=
          //  "<option disabled='selected' selected='selected'>Seleccione</option>";
          data.forEach((element) => {
            html +=
              "<option value='" +element.impretencion_iva_id+
              "'>" +
              element.impretencion_iva_descripcion
              +"%";
            ("</option>");
          });
          html += "</select>";
          this.ubicacion_descripcion_o.innerHTML = html;
        }else if (selectTipoRenta==='2'){
            html =
            "<select class='form-control' name='percha_bodega_o' id='percha_bodega_o'  autofocus required onChange='app.obtenerCantidadUbicacion()'>";
          html +=
            "<option disabled='selected' selected='selected'>Seleccione</option>";
          //html +=
          //  "<option disabled='selected' selected='selected'>Seleccione</option>";

          data.forEach((element) => {
            html +=
              "<option value='" +element.retencion_renta_porcentaje+
              "'>" +
              element.retencion_renta_descripcion
              +"%";
            ("</option>");
          });
          html += "</select>";
          this.ubicacion_descripcion_o.innerHTML = html;

        }else{
            html =
            "<select class='form-control' name='percha_bodega_o' id='percha_bodega_o'  autofocus required onChange='app.obtenerCantidadUbicacion()'>";
          html +=
            "<option disabled='selected' selected='selected'>Seleccione</option>";
          //html +=
          //  "<option disabled='selected' selected='selected'>Seleccione</option>";
          data.forEach((element) => {
            html +=
              "<option value='" +element.retencion_isd_id+
              "'>" +
              element.retencion_isd_porcentaje
              +"%";
            ("</option>");
          });
          html += "</select>";
          this.ubicacion_descripcion_o.innerHTML = html;

        }

      })
      .catch((error) => console.error(error));

      };
      this.guardar = () => {
        var id_factura = document.getElementById("factura_id").value;
        const form = new FormData(document.getElementById("productoform"));
          if (id_factura === "0") {
            fetch("../controllers/retencion/guardarDetalleTemporal.php", {
              method: "POST",
              body: form,
            })
              .then((response) => response.json())
              .then((data) => {
                if (data === true) {
                  toastr["success"]("Producto agregado!");
                  this.listadoDetalleTemporal();
                  $("#tbody").show();
                  this.limpiarInputs();//limpiar imput de
                } else if (data === false) {
                  toastr["warning"](
                    "Cantidad a comprar es superior al inventario!"
                  );
                  this.producto_comprar.focus();
                }
              })
              .catch((err) => console.error(err));
        }
      };
      this.listadoDetalleTemporal = () => {
        fetch("../controllers/retencion/listadoDetalleTemporal.php")
          .then((response) => response.json())
          .then((data) => {
            if (data.length > 0) {
              html = [];
              data.forEach((element) => {
                html += "<tr>";
                html +=
                  "<td><strong>" + element.detalle_tempr_base + "</strong></td>";
                html +=
                  "<td><strong>" + element.cod_renta_descripcion + "</strong></td>";
                html += "<td><strong>" + element.detalle_tempr_porcentaje + "</strong></td>";
                html += "<td><strong>" + element.detalle_tempr_total + "</strong></td>";
                html +=
                  '<td><button type="button" class="btn btn-danger btn-sm" title="ELiminar" onClick="app.eliminar(' +
                  element.detalle_tempr_id +
                  ')"><i class= "fa fa-trash"></i></button></td>';
                html += "</tr>";
              });
              this.tbody.innerHTML = html;
              //this.sumarSubTotal();
            } else {
              this.tbody.innerHTML =
                "<tr><td colspan='6'>No hay detalles de productos</td></tr>";
              this.factura_subtotal.value = "0";
              this.factura_total.value = "0";
            }
          })
          .catch((error) => console.error(error));
      };
      this.obtenerTotal=()=>{
        var selectTipoRenta = document.getElementById(
          "tipo_renta"
        ).value;
        var porcentaje=document.getElementById("ubicacion_descripcion_o").value;
        var base=document.getElementById("producto_descuento").value;
        const formId = new FormData();
        formId.append("tipo_renta", selectTipoRenta);
        formId.append("porcentaje",porcentaje);
        formId.append("base",base);
        fetch("../controllers/retencion/otenerTotal.php", {
          method: "POST",
          body: formId,
        })
          .then((response) => response.json())
          .then((data) => {
            this.producto_comprar.value=data;
          });
      };
      this.obtenerSerie=()=>{
        fetch("../controllers/retencion/obtenerSerie.php")
        .then((response) => response.json())
          .then((data) => {
            this.factura_serie.value=data.secuencialRetencion;
          }).catch((error) =>console.error(error));
      };
      this.eliminar = (
        detalle_tempr_id
      ) => {
        const formEliminar = new FormData();
        formEliminar.append("temp_id", detalle_tempr_id);

        fetch("../controllers/retencion/eliminarFilaDetalleTemporal.php", {
          method: "POST",
          body: formEliminar,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              toastr["error"]("Producto eliminado del detalle Retencion!");

              this.listadoDetalleTemporal();
            }
          })
          .catch((err) => console.error(err));
      };


});
app.listadoDetalleTemporal();
app.listarTipodocumento();
app.listarFormaPago();
app.ocultarInputs();
app.obtenerSerie();