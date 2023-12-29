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
  
    this.categoria_kardex=document.getElementById("categoria_kardex");
    this.codigoproducto_kardex=document.getElementById("codigoproducto_kardex");
    this.codigoreferencia_kardex=document.getElementById("codigoreferencia_kardex");
    this.descripcionproducto_kardex=document.getElementById("descripcionproducto_kardex");
    this.preciocompra_kardex=document.getElementById("preciocompra_kardex");
    this.precioventa_kardex=document.getElementById("precioventa_kardex");
    this.tipoimpuesto_kardex=document.getElementById("tipoimpuesto_kardex");;
    this.valorimpuesto_kardex=document.getElementById("valorimpuesto_kardex");;
    this.stock_kardex=document.getElementById("stock_kardex");
    this.tipo_impuesto = document.getElementById("tipo_impuesto");

    this.producto_fechaexpiracion = document.getElementById(
      "producto_fechaexpiracion"
    );
    this.categoria = document.getElementById("categoria");
    this.porcentaje_iva = document.getElementById("porcentaje_iva");
  
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
    this.productosD4 = document.getElementById("productosD4");
    this.listadoProductos = () => {
      fetch("../controllers/kardex/listarProducto2.php")
        .then((response) => response.json())
        .then((data) => {
          html =
            "<table class='table table-striped table-bordered first' id='example11'>";
          html += "<thead>";
          html += "<tr>";
          html +=
            "<th>Código producto</th><th>Detalle</th><th>Opciones</th>";
          html += "</tr>";
          html += "</thead>";
          html += "<tbody>";
          permisos = data.permisosMod;
          data=data.data;
          data.forEach((element) => {
            html += "<tr>";
            html +=
              "<td><center><strong>" +
              element.producto_codigoserial +
              "</strong></center></td>";
            html += '<td>' + element.producto_descripcion.toUpperCase() + '</td>';
            html +="<td>";/*
            if (permisos["u"] === "1") {
              html +="<button type='button' class='btn btn-primary btn-sm' title='Aumentar stock' onClick='app.aumentarStock(" +
              element.producto_id +
              ")'><i class='fas fa-cubes'></i></button>";
            }
            if (permisos["u"] === "1") {
              html +="<button type='button' class='btn btn-danger btn-sm' title='Disminuir stock' onClick='app.disminuirStock(" +
              element.producto_id +
              ")'><i class='fas fa-cubes'></i></button>";
            }*/
            if (permisos["r"] === "1") {
            html +=
              "<button type='button' class='btn btn-warning btn-sm text-white' style=' border-radius: 50%; width: 40px; height: 40px; margin: 0% 2%; background:#5969ff; border-color:#5969ff' title='Ver Stock Sucursal' onclick='app.detallePorductoUbicacion("+element.producto_id+");')><i class='fas fa-eye'></i></button>";
            }
              html +=
              "<button type='button' class='btn btn-warning btn-sm text-white' style=' border-radius: 50%; width: 40px; height: 40px; margin: 0% 2%;' title='Código barra' onClick='app.codigomostrar(" +
              element.producto_id +
              ")' data-toggle='modal' data-target='#exampleModalCodigoserial'><i class='fas fa-barcode'></i></button>";
              if (permisos["d"] === "1") {
              html +=
              "<button type='button' class='btn btn-danger btn-sm' style=' border-radius: 50%; width: 40px; height: 40px; margin: 0% 2%;' title='Eliminar' onClick='app.eliminar(" +
              element.producto_id +
              ")'><i class='fa fa-trash'></i></button></td>";
              }
          });
          //")'><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-success btn-sm' title='Ubicacion' onClick='app.ubicacion(" +
          //  element.producto_id +
          this.productos4.innerHTML = html;
          $("#example11").DataTable({
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

    this.eliminar = (id) => {
      const formId = new FormData();
      formId.append("id", id);
      fetch("../controllers/producto/eliminarProducto.php", {
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
            this.listadoProductos();
          } else {
            Swal.fire(
              "icon: 'error'",
              "title: 'Error'",
              "text: 'No se pudo eliminar el producto'"
            );
            this.listadoProductos();
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
            document.getElementById("barras_producto_id").value=data.producto_id;
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
    this.actualizarProductoKardex = (id) => {
      $("#exampleModalProductoKardex").modal("show");
      $("#exampleModalDetalleUbicacion").modal("hide");
      this.producto_id_stocka.value = id;
      //console.log(producto_id_stocka);
      const formId = new FormData();
      formId.append("id", id);
      fetch("../controllers/producto/obtenerProductoDetalleStock.php", {
        method: "POST",
        body: formId,
      })
        .then((response) => response.json())
        .then((data) => {
          $("#categoria_id").val(data.categoria_id).trigger("change");
          this.categoria_kardex.value=data.categoria_id;
          this.codigoproducto_kardex.value=data.producto_codigoserial;
          this.codigoreferencia_kardex.value=data.producto_codigoreferencia;
          this.descripcionproducto_kardex.value=data.producto_descripcion;
          this.preciocompra_kardex.value=data.producto_precio_menor;
          this.precioventa_kardex.value=data.producto_precio_mayor;
          $("#tipo_impuesto_id").val(data.producto_tipo_imp).trigger("change");
          this.tipoimpuesto_kardex.value=data.producto_tipo_imp;
          $("#porcentaje_iva2").val(data.producto_porcentaje).trigger("change");
          this.valorimpuesto_kardex.value=data.producto_porcentaje;
          this.stock_kardex.value=data.ubicacion_cantidad;
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
            permisos = data.permisosMod;
          data=data.data;
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
    console.log(select);
    const formId = new FormData();
    formId.append("id", select.value);
    fetch("../controllers/producto/obtenerPorcentajesImpuesto.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='porcentaje_iva2' id='porcentaje_iva2' autofocus required >";
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
    this.detallePorductoUbicacion=(id)=>{
        $("#exampleModalDetalleUbicacion").modal("show");
      const formId = new FormData();
      formId.append("id", id);
        fetch("../controllers/kardex/listadoDetalleUbi.php",{
            method: "POST",
            body: formId,
          })
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
              html +="<button type='button' class='btn btn-primary btn-sm' style='border-radius: 50%;width: 40px;height: 40px;' title='Editar' onClick='app.actualizarProductoKardex(" +
              element.ubicacion_id +
              ")'><i class='fas fa-edit'></i></button>";
            }
/*
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
*/
          });
          //")'><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-success btn-sm' title='Ubicacion' onClick='app.ubicacion(" +
          //  element.producto_id +
          this.productosD4.innerHTML = html;
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
    }

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

    this.modificarProductoStock = () => {
      const form = new FormData(document.getElementById("stockforma"));
      
   //   if (this.validacionInputModalStockAumentar(form) === true) {
        fetch("../controllers/producto/actualizarProductoStock.php", {
          method: "POST",
          body: form,
        })
          .then((response) => response.json())
          .then((data) => {
            $("#exampleModalProductoKardex").modal("hide");
              $("#exampleModalDetalleUbicacion").modal("hide");
            if (data === true) {
              Swal.fire(
                "Registrado!",
                "Se actualizo el producto correctamente!",
                "success"
              );
              
              this.listadoProductos();
              document.getElementById("stockforma").reset();
            }else{
              Swal.fire("ERROR!", "No se puede actualizar stock", "warning");
            }
          })
          .catch((error) => console.error(error));
     // }
    };

    this.modificarStocka = () => {
      const form = new FormData(document.getElementById("stockforma"));
     // if (this.validacionInputModalStockAumentar(form) === true) {
        fetch("../controllers/producto/aumentarProductoStock.php", {
          method: "POST",
          body: form,
        })
          .then((response) => response.json())
          .then((data) => {
            $("#exampleModalStocka").modal("hide");
              $("#exampleModalDetalleUbicacion").modal("hide");
            if (data === true) {
              Swal.fire(
                "Registrado!",
                "Se aumento el stock correctamente!",
                "success"
              );
              
              this.listadoProductos();
              document.getElementById("stockforma").reset();
            }
          })
          .catch((error) => console.error(error));
     // }
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
            $("#exampleModalStockd").modal("hide");
            $("#exampleModalDetalleUbicacion").modal("hide");
            if (data === true) {
                Swal.fire(
                  "Registrado!",
                  "Se disminuyo el stock correctamente!",
                  "success"
                );
                
                this.listadoProductos();
                document.getElementById("stockforma").reset();
              }
          })
          .catch((error) => console.error(error));
      }
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
    this.imprimir = () => {
      data=codigo_serial.value;
      data=barras_producto_id.value;
      /*document.getElementById("codigoform").style.display = "none";
      document.getElementById("titulocardheader").style.display = "none";
      document.getElementById("imprimir").style.display = "none";
      window.print();
      window.location.href = "../views/generarcodigo.php";*/
      var ancho = 100;
      var alto = 100;
      var x = parseInt(window.screen.width / 2 - ancho / 2);
      var y = parseInt(window.screen.width / 2 - alto / 2);
      $url = "../../app/utils/factura/generarCodigoBarras.php?cl=1" + "&f=" + data;
      window.open(
        $url,
        "CodigoBarras",
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
  })();
  app.listadoProductos();
  app.listarTipoCategoria();
  app.listarTipoImpuesto();
  // app.lectorCodigoProducto();