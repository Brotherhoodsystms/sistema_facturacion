const app = new (function () {
  this.producto_id = document.getElementById("producto_id");
  this.historial_id = document.getElementById("historial_id");
  this.producto_codigoserial = document.getElementById("producto_codigoserial");
  this.producto_descripcion = document.getElementById("producto_descripcion");
  this.producto_precioxMe = document.getElementById("producto_precioxMe");
  this.producto_precioxMa = document.getElementById("producto_precioxMa");
  this.producto_stock = document.getElementById("producto_stock");
  this.total_factura = document.getElementById("total_factura");

  this.producto_fechaelaboracion = document.getElementById(
    "producto_fechaelaboracion"
  );
  this.producto_fechaexpiracion = document.getElementById(
    "producto_fechaexpiracion"
  );

  this.categoria = document.getElementById("categoria");
  this.lote = document.getElementById("lote");

  this.proveedor = document.getElementById("proveedor");
  this.productos = document.getElementById("productos");

  this.sucursal = document.getElementById("sucursal");
  this.tipo_impuesto = document.getElementById("tipo_impuesto");
  this.porcentaje_iva = document.getElementById("porcentaje_iva");
  this.producto_sucursal2 = document.getElementById("producto_sucursal2");
  this.producto_bodegas = document.getElementById("producto_bodegas");
  this.producto_bodegas2 = document.getElementById("producto_bodegas2");
  this.ubicacion_descripcion = document.getElementById("ubicacion_descripcion");

  // ubicacion formulario modal
  this.producto_id_ubicacion = document.getElementById("producto_id_ubicacion");
  // stock formulario modal
  this.producto_id_stocka = document.getElementById("producto_id_stocka");
  this.producto_capacidadstocka = document.getElementById(
    "producto_capacidadstocka"
  );
  this.producto_aumentarstocka = document.getElementById(
    "producto_aumentarstocka"
  );
  this.producto_id_stockd = document.getElementById("producto_id_stockd");
  this.producto_capacidadstockd = document.getElementById(
    "producto_capacidadstockd"
  );
  this.producto_disminuirstock = document.getElementById(
    "producto_disminuirstock"
  );
  this.tbody = document.getElementById("tbody");
  this.tbodydetalle = document.getElementById("tbodydetalle");
  this.productos4 = document.getElementById("productos4");
  //todo::todo los datos de la tabla detalle temporal
  this.listadoServicios = () => {
    fetch("../controllers/servicios/listadoServicios.php")
      .then((response) => response.json())
      .then((data) => {
        if (data.length > 0) {
          html = [];
          html =
            "<table class='table table-striped table-bordered first' id='example1'>";
          html += "<thead>";
          html += "<tr>";
          html += "<th>Id</th>";
          html += "<th>Codigo</th>";
          html += "<th>Descripcion</th>";
          html += "<th>Valor</th>";
          html += "<th>Impuesto</th>";
          html += "<th>Porcentaje</th>";
          //html += "<th>Opciones</th>";
          html += "</tr>";
          html += "</thead>";
          html += "<tbody>";
          data.forEach((element) => {
            html += "<tr>";
            html += "<td><strong>" + element.producto_id + "</strong></td>";
            html +=
              "<td><strong>" + element.producto_codigoserial + "</strong></td>";
            html +=
              "<td><strong>" + element.producto_descripcion + "</strong></td>";
            html +=
              "<td><strong>" + element.producto_precio_mayor + "</strong></td>";
            html +=
              "<td><strong>" + element.codimp_descripcion + "</strong></td>";
            html +=
              "<td><strong>" + element.tarifaiva_porcentaje + "%</strong></td>";
            /*html +=
              '<td><button type="button" class="btn btn-danger btn-sm" title="ELiminar" onClick="app.eliminar(' +
              element.producto_id +
              ')"><i class= "fa fa-trash"></i></button></td>';*/
            html += "</tr>";
          });

          this.tbody.innerHTML = html;

          $("#example1").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print"],
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
        } else {
          this.tbody.innerHTML =
            "<tr><td colspan='6'>No hay detalles de productos</td></tr>";
        }
      })
      .catch((error) => console.error(error));
  };
  this.guardar = () => {
    const form = new FormData(document.getElementById("productoform"));
    if (this.validacionInputProducto(form) === true) {
      if (this.producto_id.value === "") {
        //fetch("../controllers/producto/guardarProducto.php", {
        fetch("../controllers/servicios/guardarServicios.php", {
          method: "POST",
          body: form,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              toastr["info"]("Ingreso  de Servicio exitoso!");
              this.limpiarInputs();
              //this.listadoDetalleTemporal();
            } else if (data === 1) {
              toastr["error"](
                "El campo código serial ya existe, debe escribir otro..!"
              );
              this.producto_codigoserial.focus();
            }
          })
          .catch((error) => console.error(error));
      } else {
        fetch("../controllers/servicios/actualizarServicio.php", {
          method: "POST",
          body: form,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              toastr["info"]("Actualizacion del Servicio!");
              this.limpiarInputs();
              //this.listadoDetalleTemporal();
            } else if (data === 1) {
              toastr["error"](
                "El campo código serial ya existe, debe escribir otro..!"
              );
              this.producto_codigoserial.focus();
            }
          })
          .catch((error) => console.error(error));
      }
    }
  };

  //todo::validar campos vacios id factura

  this.editar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/producto/obtenerProducto.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"](
          "Esta en modo de actualizar datos, solo puede modificar un dato..!"
        );
        this.producto_id.value = data.producto_id;
        this.producto_codigoserial.value = data.producto_codigoserial;
        this.producto_descripcion.value = data.producto_descripcion;
        this.producto_precioxMe.value = data.producto_precio_menor;
        this.producto_precioxMa.value = data.producto_precio_mayor;
        this.producto_stock.value = data.producto_stock;
        document.getElementById("producto_stock").readOnly = true;
        this.producto_fechaelaboracion.value = data.producto_fechaelaboracion;
        this.producto_fechaexpiracion.value = data.producto_fechaexpiracion;
        $("#categoria_id").val(data["categoria_id"]).trigger("change");
        $("#lote_id").val(data["lote_id"]).trigger("change");
        $("#proveedor_id").val(data["proveedor_id"]).trigger("change");
        if (data.sucursal_id) {
          $("#sucursal_id").val(data.sucursal_id).trigger("change");
          this.ubicacion_descripcion.value = data.ubicacion_descripcion;
          $("#producto_bodegas").val(data.bodega_id).trigger("change");
          $("#sucursal_id").attr("disabled", "disabled");
          $("#producto_bodegas").attr("disabled", "disabled");
          document.getElementById("ubicacion_descripcion").readOnly = true;
        }

        document.getElementById("categoria_id").focus();
      })

      .catch((error) => console.error(error));
  };
  //todo::eliminar campo cambiando solo el estado
  this.eliminar = () => {};

  this.codigomostrar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/producto/obtenerProductoId.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        document.getElementById("codigo_serial").value =
          data.producto_codigoserial;
        JsBarcode("#mostrarCodigo", data.producto_codigoserial, {
          format: "code128",
          displayValue: true,
        });
      })
      .catch((error) => console.error(error));
  };

  this.validacionInputProducto = (formInput) => {
    if (formInput.get("producto_codigoserial") === "") {
      toastr["warning"](
        "El campo código serial es requirido, debe escribir uno..!"
      );
      this.producto_codigoserial.focus();
      return false;
    } else if (formInput.get("producto_descripcion") === "") {
      toastr["warning"](
        "El campo descripción es requirido, debe escribir uno..!"
      );
      this.producto_descripcion.focus();
      return false;
    } else if (formInput.get("producto_precioxMa") === "") {
      toastr["warning"]("El campo precio es requirido, debe escribir uno..!");
      this.producto_precioxMa.focus();
      return false;
    } else if (formInput.get("producto_stock") === "") {
      toastr["warning"]("El campo stock es requirido, debe escribir uno..!");
      this.producto_stock.focus();
      return false;
    } else {
      return true;
    }
  };
  //todo::producto
  this.obtenerProducto = () => {
    var form = new FormData();
    form.append("producto_codigoserial", this.producto_codigoserial.value);
    form.append("tipo_producto", "S");
    
    app.obtenerPorcentaje();
    //fetch("../controllers/producto/obtenerProductoSerial.php", {
    fetch("../controllers/venta/obtenerProductoSerial.php", {
      method: "POST",
      body: form,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data) {
          this.producto_descripcion.value = data.producto_descripcion;
          this.producto_precioxMa.value = data.producto_precio_mayor;
          this.producto_stock.value = data.producto_stock;
          this.producto_id.value = data.producto_id;
          this.tipo_impuesto_id=document.getElementById("tipo_impuesto_id");
          this.tipo_impuesto_id.value=data.producto_tipo_imp;
          
          this.porcentaje_iva=document.getElementById("porcentaje_iva");
          this.porcentaje_iva.value=data.producto_porcentaje;
          //$("#producto_descripcion").disabled;
          var producto_descripcion = document.getElementById(
            "producto_descripcion"
          );

          //app.obtenerStok(data.bodega_id);
          // this.bodega_id_o.value = data.bodega_id;
        } else {
          var producto_descripcion = document.getElementById(
            "producto_descripcion"
          );
          producto_descripcion.disabled = false;
          this.producto_descripcion.value = "";
          this.producto_precioxMa.value = "";
          this.producto_stock.value = "";
          this.producto_id.value = "";
        }
      })
      .catch((err) => console.error(err));
  };

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
  //todo::limpiar
  this.limpiarInputs = () => {
    this.producto_id.value = "";
    this.producto_codigoserial.value = "";
    this.producto_descripcion.value = "";
    this.producto_precioxMa.value = "";
    this.producto_stock.value = "";
    $("#porcentaje_iva").val("Seleccione").trigger("change");
    document.getElementById("producto_stock").readOnly = false;
  };
  //imputs ocultos por defecto para reserva
  this.ocultarInputs = () => {
    $("#btn-imprimir").hide();
  };
})();
app.ocultarInputs();
app.listarTipoImpuesto();
app.listadoServicios();
