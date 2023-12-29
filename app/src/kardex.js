const app = new (function () {
  this.producto_id = document.getElementById("producto_id");
  this.producto_codigoserial = document.getElementById("producto_codigoserial");
  this.producto_descripcion = document.getElementById("producto_descripcion");
  this.producto_precioxMe = document.getElementById("producto_precioxMe");
  this.producto_precioxMa = document.getElementById("producto_precioxMa");
  this.producto_stock = document.getElementById("producto_stock");
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
 /*  this.listadoDetalleTemporal = () => {
    fetch("../controllers/producto/listadoDetalleTemporal.php")
      .then((response) => response.json())
      .then((data) => {
        if (data.length > 0) {
          html = [];
          data.forEach((element) => {
            html += "<tr>";
            html +=
              "<td><strong>" +
              element.temp_producto_codigoserial +
              "</strong></td>";
            html +=
              "<td><strong>" + element.temp_producto_stock + "</strong></td>";
            html +=
              "<td><strong>" + element.bodega_descripcion + "</strong></td>";
            html +=
              "<td><strong>" + element.temp_pro_ubicaccion + "</strong></td>";
            var descripcion = "'" + element.temp_pro_ubicaccion + "'";
            var descripciono = "'" + element.temp_pro_ubicaccion + "'";
            html +=
              '<td><button type="button" class="btn btn-danger btn-sm" title="ELiminar" onClick="app.eliminar(' +
              element.temp_producto_id +
              "," +
              element.temp_producto_stock +
              "," +
              element.temp_producto_stock +
              "," +
              element.temp_pro_bodegaid +
              "," +
              element.temp_pro_bodegaid +
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
  }; */
  this.listadoProductos = () => {
    fetch("../controllers/kardex/listadoProducto.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html +=
          "<th>ID</th><th>Código producto</th><th>Detalle</th><th>Sucursal</th><th>Bodega</th><th>Ubicacion</th><th>Precio Compra</th><th>Precio Venta</th><th>Stock</th><th>Opciones</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        permisos = data.permisosMod;
        data=data.data;
        data.forEach((element) => {
          html += "<tr>";
          html +=
            "<td><center></center>" +
            element.ubicacion_id.toUpperCase() +
            "</td>";

          html +=
            "<td><center><img src='../../public/images/serial.png' alt='logo box' width='30px'><br/><strong>" +
            element.producto_codigoserial +
            "</strong></center></td>";

          html += "<td>" + element.producto_descripcion.toUpperCase() + "</td>";
          html += "<td>" + element.sucursal_nombre + "</td>";
          html +=
            "<td>" +
            element.bodega_descripcion +"</td>";
            html +=
            "<td>" +
            element.ubicacion_descripcion +
            "</td>";
          html +=
            "<td>" +
            element.producto_precio_menor +"</td>";
            html +=
            "<td>" + +
            element.producto_precio_mayor +
            "</td>";
          html += "<td>" + element.ubicacion_cantidad + "</td>";

          html +="<td>";
          if (permisos["u"] === "1") {
            html +="<button type='button' class='btn btn-primary btn-sm' title='Aumentar stock' onClick='app.aumentarStock(" +
            element.ubicacion_id +
            ")'><i class='fas fa-cubes'></i></button>";
          }
          if (permisos["u"] === "1") {
            html +="<button type='button' class='btn btn-danger btn-sm' title='Disminuir stock' onClick='app.disminuirStock(" +
            element.ubicacion_id +
            ")'><i class='fas fa-cubes'></i></button>";
          }
          html +=
            "<button type='button' class='btn btn-warning btn-sm text-white' title='Código barra' onClick='app.codigomostrar(" +
            element.producto_id +
            ")' data-toggle='modal' data-target='#exampleModalCodigoserial'><i class='fas fa-barcode'></i></button></td>";
        });
        //")'><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-success btn-sm' title='Ubicacion' onClick='app.ubicacion(" +
        //  element.producto_id +
        this.productos4.innerHTML = html;
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
          },'dom': 'lBfrtip',
          'buttons': [
             {
                  "extend": "excelHtml5",
                  "text": "<i class='fas fa-file-excel'></i> Excel",
                  "titleAttr":"Esportar a Excel",
                  "title": "Lista de Kardex",
                  "className": "btn btn-success",
              },{
                  "extend": "pdfHtml5",
                  "text": "<i class='fas fa-file-pdf'></i> PDF",
                  orientation: 'landscape',//todo::cambiar horzontal
                  "title": "Lista de Kardex",
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
    const form = new FormData(document.getElementById("productoform"));
    if (this.validacionInputProducto(form) === true) {
      if (this.producto_id.value === "") {
        //fetch("../controllers/producto/guardarProducto.php", {
        fetch("../controllers/producto/guardarProductoTemporal.php", {
          method: "POST",
          body: form,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              toastr["info"]("Ingreso  de Producto temporal!");
              this.limpiarInputs();
              this.listadoDetalleTemporal();
            } else if (data === 1) {
              toastr["error"](
                "El campo código serial ya existe, debe escribir otro..!"
              );
              this.producto_codigoserial.focus();
            }
          })
          .catch((error) => console.error(error));
      } else {
        fetch("../controllers/producto/actualizarProducto.php", {
          method: "POST",
          body: form,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              toastr["info"]("Ingreso  de Producto temporal!");
              this.limpiarInputs();
              this.listadoDetalleTemporal();
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
    fetch("../controllers/producto/eliminarFilaDetalleTemporal.php", {
      method: "POST",
      body: formEliminar,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data === true) {
          toastr["warning"]("Ingreso eliminado de Producto temporal!");
          this.listadoDetalleTemporal();
        }
      })
      .catch((err) => console.error(err));
  };
  this.guardar_historial_ubicacion = () => {
    fetch("../controllers/producto/guardarIngresoProductos.php")
      .then((response) => response.json())
      .then((data) => {})
      .catch((error) => console.error(error));
  };
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
  this.listarTipoCategoria = () => {
    fetch("../controllers/categoria/mostrarCategoria.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='categoria_id' id='categoria_id' autofocus required>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.categoria_id +
            "'>" +
            element.categoria_descripcion +
            "</option>";
        });
        html += "</select>";
        this.categoria.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  this.listarTipoLote = () => {
    fetch("../controllers/lote/mostrarLote.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='lote_id' id='lote_id' required>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.lote_id +
            "'>" +
            element.lote_descripcion +
            "</option>";
        });
        html += "</select>";
        this.lote.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  this.listarTipoProveedor = () => {
    fetch("../controllers/proveedor/listadoProveedor.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='proveedor_id' id='proveedor_id' required>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.proveedor_id +
            "'>" +
            element.proveedor_razonsocial +
            " - " +
            element.proveedor_ruc +
            "</option>";
        });
        html += "</select>";
        this.proveedor.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };

  this.ubicacion = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/producto/obtenerProductoCodigo.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data === 1) {
          toastr["error"](
            "Este producto ya está en la sección de bodega, debe elegir otro..!"
          );
        } else {
          $("#exampleModalUbicacion").modal("show");
          this.producto_id_ubicacion.value = id;
        }
      })
      .catch((error) => console.error(error));
  };
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
  this.aumentarStock = (id) => {
    $("#exampleModalStocka").modal("show");
    this.producto_id_stocka.value = id;
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/producto/obtenerProductoStock.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        this.producto_capacidadstocka.value = data;
      })
      .catch((error) => console.error(error));
  };
  this.disminuirStock = (id) => {
    $("#exampleModalStockd").modal("show");
    this.producto_id_stockd.value = id;
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/producto/obtenerProductoStock.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        this.producto_capacidadstockd.value = data;
      })
      .catch((error) => console.error(error));
  };

  this.validacionInputProducto = (formInput) => {
    if (formInput.get("categoria_id") === null) {
      toastr["warning"]("La categoria es requerido, debe elegir uno..!");
      document.getElementById("categoria_id").focus();
      return false;
    } else if (formInput.get("lote_id") === null) {
      toastr["warning"]("El lote es requerido, debe elegir uno..!");
      document.getElementById("lote_id").focus();
      return false;
    } else if (formInput.get("proveedor_id") === null) {
      toastr["warning"]("El proveedor es requerido, debe elegir uno..!");
      document.getElementById("proveedor_id").focus();
      return false;
    } else if (formInput.get("sucursal_id") === null) {
      toastr["warning"]("La sucursa es requerido, debe elegir uno..!");
      document.getElementById("sucursal_id").focus();
      return false;
    } else if (formInput.get("producto_bodegas") === null) {
      toastr["warning"]("La bodega  es requerido, debe elegir uno..!");
      document.getElementById("producto_bodegas").focus();
      return false;
    } else if (formInput.get("ubicacion_descripcion") === "") {
      toastr["warning"](
        "El campo Descripcion de ubicacion es requirido, debe escribir uno..!"
      );
      this.ubicacion_descripcion.focus();
      return false;
    } else if (formInput.get("producto_codigoserial") === "") {
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
    } else if (formInput.get("producto_precioxMe") === "") {
      toastr["warning"]("El campo precio es requirido, debe escribir uno..!");
      this.producto_precioxMe.focus();
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
  this.validacionInputModalUbicacion = (formInput) => {
    if (formInput.get("sucursal_id") === null) {
      toastr["warning"]("La sucursal es requerida, debe elegir uno..!");
      document.getElementById("sucursal_id").focus();
      return false;
    } else if (formInput.get("producto_bodegas") === null) {
      toastr["warning"]("La bodega es requerida, debe elegir uno..!");
      document.getElementById("producto_bodegas").focus();
      return false;
    } else if (formInput.get("ubicacion_descripcion") === "") {
      toastr["warning"](
        "La campo descripción es requerida, debe escribir uno..!"
      );
      document.getElementById("ubicacion_descripcion").focus();
      return false;
    } else {
      return true;
    }
  };
  this.validacionInputModalStockAumentar = (formInput) => {
    if (formInput.get("producto_aumentarstock") === "") {
      toastr["warning"](
        "La campo aumenatar stock es requerida, debe escribir uno..!"
      );
      document.getElementById("producto_aumentarstock").focus();
      return false;
    } else {
      return true;
    }
  };
  this.validacionInputModalStockDisminuir = (formInput) => {
    if (formInput.get("producto_disminuirstock") === "") {
      toastr["warning"](
        "La campo disminuir stock es requerida, debe escribir uno..!"
      );
      document.getElementById("producto_disminuirstock").focus();
      return false;
    } else {
      return true;
    }
  };

  this.listarTipoSucursal = () => {
    fetch("../controllers/sucursal/listadoSucursal.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='sucursal_id' id='sucursal_id' autofocus required onChange='app.obtenerValor()'>"; //
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
        this.sucursal.innerHTML = html;

        this.producto_sucursal2.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };

  this.obtenerValor = () => {
    var select = document.getElementById("sucursal_id");
    const formId = new FormData();
    formId.append("id", select.value);
    fetch("../controllers/bodega/obtenerBodegaReferencia.php", {
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
        this.producto_bodegas.innerHTML = html;

        //this.producto_bodegas2.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };

  this.guardarUbicacion = () => {
    const form = new FormData(document.getElementById("ubicacionform"));
    if (this.validacionInputModalUbicacion(form) === true) {
      fetch("../controllers/ubicacion/guardarUbicacion.php", {
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
            $("#exampleModalUbicacion").modal("hide");
            document.getElementById("ubicacionform").reset();
            setTimeout(() => {
              window.location.href = "../views/ubicacion.php";
            }, 1000);
          } else if (data === 0) {
            toastr["error"](
              "Esa ubicación ya esta ocupada por un producto, debe escribir otro..!"
            );
            this.ubicacion_descripcion.focus();
          }
        })
        .catch((error) => console.error(error));
    }
  };

  this.modificarStocka = () => {
    const form = new FormData(document.getElementById("stockforma"));
    if (this.validacionInputModalStockAumentar(form) === true) {
      fetch("../controllers/producto/aumentarProductoStock.php", {
        method: "POST",
        body: form,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data === true) {
            Swal.fire(
              "Registrado!",
              "Se aumento el stock correctamente!",
              "success"
            );
            this.listadoProductos();
            $("#exampleModalStocka").modal("hide");
            document.getElementById("stockforma").reset();
          }
        })
        .catch((error) => console.error(error));
    }
  };
  this.modificarStockd = () => {
    const form = new FormData(document.getElementById("stockformd"));
    if (this.validacionInputModalStockDisminuir(form) === true) {
      fetch("../controllers/producto/disminuirProductoStock.php", {
        method: "POST",
        body: form,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data === true) {
            Swal.fire(
              "Registrado!",
              "Se disminuyo el stock correctamente!",
              "success"
            );
            this.listadoProductos();
            $("#exampleModalStockd").modal("hide");
            document.getElementById("stockformd").reset();
          } else if (data === 0) {
            toastr["error"](
              "No se puede disminuir el stock, ya que es superior al existente!"
            );
            this.producto_disminuirstock.focus();
          }
        })
        .catch((error) => console.error(error));
    }
  };
  this.limpiarInputs = () => {
    this.producto_id.value = "";
    this.producto_codigoserial.value = "";
    this.producto_descripcion.value = "";
    this.producto_precioxMe.value = "";
    this.producto_precioxMa.value = "";
    this.producto_stock.value = "";
    this.producto_fechaelaboracion.value = "";
    this.producto_fechaexpiracion.value = "";
    $("#categoria_id").val("Seleccione").trigger("change");
    $("#lote_id").val("Seleccione").trigger("change");
    $("#proveedor_id").val("Seleccione").trigger("change");
    document.getElementById("categoria_id").focus();
    document.getElementById("producto_stock").readOnly = false;
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
})();
app.listadoProductos();
// app.lectorCodigoProducto();
