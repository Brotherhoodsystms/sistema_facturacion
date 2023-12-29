const app = new (function () {
  this.producto_id = document.getElementById("producto_id");
  this.producto_codigoserial = document.getElementById("producto_codigoserial");
  this.producto_descripcion = document.getElementById("producto_descripcion");
  this.producto_precio_compra = document.getElementById("producto_precio_compra");
  this.producto_precio_venta=document.getElementById("producto_precio_venta");
  this.producto_stock = document.getElementById("producto_stock");
  this.producto_fechaelaboracion = document.getElementById("producto_fechaelaboracion");
  this.producto_fechaexpiracion = document.getElementById("producto_fechaexpiracion");
  this.categoria = document.getElementById("categoria");
  this.lote = document.getElementById("lote");
  this.proveedor = document.getElementById("proveedor");
  this.productos = document.getElementById("productos");
  this.producto_sucursal = document.getElementById("producto_sucursal");
  this.producto_bodegas = document.getElementById("producto_bodegas");
  this.ubicacion_descripcion = document.getElementById("ubicacion_descripcion");
  // ubicacion formulario modal
  this.producto_id_ubicacion = document.getElementById("producto_id_ubicacion");
  // stock formulario modal
  this.producto_id_stocka = document.getElementById("producto_id_stocka");
  this.producto_capacidadstocka = document.getElementById("producto_capacidadstocka");
  this.tipo_impuesto = document.getElementById("tipo_impuesto");
  this.producto_aumentarstocka = document.getElementById("producto_aumentarstocka");
  this.producto_id_stockd = document.getElementById("producto_id_stockd");
  this.producto_capacidadstockd = document.getElementById("producto_capacidadstockd");
  this.producto_disminuirstock = document.getElementById("producto_disminuirstock");
  this.ubicaciones=document.getElementById("ubicaciones");
  this.porcentaje_iva = document.getElementById("porcentaje_iva");
  this.foto = document.getElementById("foto");
  this.producto_imagenes = document.getElementById("producto_imagenes");
  this.porcentaje_iva_producto = document.getElementById("porcentaje_iva_producto");
  
  this.vista_preliminar = (event)=>{
    let leer_img = new FileReader();
    let id_img = document.getElementById("img-foto");

    leer_img.onload = () =>{
      if(leer_img.readyState == 2){
        id_img.src = leer_img.result;
      }
    }
    leer_img.readAsDataURL(event.target.files[0]);
  }

  this.listadoProductos = () => {
    fetch("../controllers/productos/listadoProducto.php")
      .then((response) => response.json())
      .then((data) => {
        
        html =
          "<table class='table table-striped table-bordered first' id='example1' style='border-radius:1%'>";
        html += "<thead>";
        html += "<tr>";
        html +="<th>Imagen</th>";
          html +="<th>Código producto</th>";
          html+="<th>Detalle</th>";
          html+="<th>Precio Compra</th>";
          html+="<th>Precio Venta</th>";
          html+="<th>Stock</th>";
          html+="<th>Categoria</th>";
          html+="<th>Fecha Elaboración</th>";
          html+="<th>Fecha Expiración</th>";
          html+="<th>Opciones</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        permisos = data.permisosMod;
        data=data.data;
        data.forEach((element) => {
         
          html += "<tr>";
          if(element.producto_imagen === "Sin Imagen" || element.producto_imagen === "../../img/" || element.producto_imagen === ""){
            html +=
          "<td><center><img src='../utils/img/product.png' style='width:70%'></center></td>";
          }else{
            const cadena = element.producto_imagen;
            let imagen = cadena.slice(3);
            html += "<td><center><img src="+imagen+" style='width:70%'></center></td>";
          }
          html +=
            "<td><center><img src='../../public/images/serial.png' alt='logo box' width='30px'><br/><strong>" +
            element.producto_codigoserial +
            "</strong></center></td>";
            html += "<td>" +element.producto_descripcion +"</td>";
            html += "<td>$" +element.producto_precio_menor +"</td>";
            html += "<td>$" +element.producto_precio_mayor +"</td>";
            html += "<td>" +element.producto_stock +"</td>";
            html += "<td>" +element.categoria_descripcion +"</td>";
            //console.log(producto_fechaelaboracion);
            //fecha elaboracion
            if(element.producto_fechaelaboracion == '0000-00-00' || element.producto_fechaelaboracion == null ){
              html += "<td>Sin Fecha</td>"
            }else{
              html += "<td>" +element.producto_fechaelaboracion +"</td>";
            }
            //fecha expiracion
            if(element.producto__fechaexpiracion == '0000-00-00' || element.producto__fechaexpiracion == null ){
              html += "<td>Sin Fecha</td>"
            }else{
              html += "<td>" +element.producto__fechaexpiracion +"</td>";
            }
            html += "<td>";
            if (permisos["u"] === "1"){
            html +=
            "<button type='button' style='border-radius: 50%; width: 40px;height: 40px;' class='btn btn-info btn-sm' title='Editar' onClick='app.ponerValorCodigo(" +
            element.producto_id +
            ")'><i class='fas fa-pencil-alt'></i></button>";
          }
          if (permisos["d"] === "1"){
            html +=
              "<button type='button' class='btn btn-danger btn-sm' style=' border-radius: 50%; width: 40x; height: 40px; margin: 0% 1%;' title='Eliminar' onClick='app.eliminar(" +
              element.producto_id +
              ")'><i class='fa fa-trash'></i></button>";
          }
            html += "</td>";
        });
          this.productos.innerHTML = html;
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
            }
          },'dom': 'lBfrtip',
          'buttons': [
             {
                  "extend": "excelHtml5",
                  "text": "<i class='fas fa-file-excel'></i> Excel",
                  "titleAttr":"Exportar a Excel",
                  "title": "Listado de Productos",
                  "className": "btn btn-success",
              },{
                  "extend": "pdfHtml5",
                  "text": "<i class='fas fa-file-pdf'></i> PDF",
                  orientation: 'landscape',//todo::cambiar horzontal
                  "title": "Listado de Productos",
                  "titleAttr":"Exportar a PDF",
                  "className": "btn btn-danger",
                  "style":"border-radius:5%"
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
  /*
  const $nombre = document.querySelector("#producto_codigoserial");
    $nombre.addEventListener("keydown", (evento) => {
      if (evento.key == "Enter") {
        // Prevenir
        evento.preventDefault();
        return false;
      }
    });
    */
  this.guardar = () => {
    const form = new FormData(document.getElementById("productoform"));
    
    if (this.validacionInputProducto(form) === true) {
      if (this.producto_id.value === "") {
        fetch("../controllers/productos/guardarProductos.php", {
          method: "POST",
          body: form,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data) {
              /*
              Swal.fire(
                "Registrado!",
                "Su información se guardo correctamente!",
                "success"
              );
              this.limpiarInputs();
              this.listadoProductos();
                */
               this.agregarUbicacion(data.producto_id,data.producto_stock,data.producto_precio_menor);
            } else if (data === false) {
              toastr["error"](
                "El campo código serial ya existe, debe escribir otro..!"
              );
              this.producto_codigoserial.focus();
            }
          })
          .catch((error) => console.error(error));
      } else {
        fetch("../controllers/productos/actualizarProductos.php", {
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
              this.limpiarInputs();
              this.listadoProductos();
              window.location.href = "../views/productos.php";
            } else {
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

  this.agregarUbicacion = (id,stock,preciocompra) => {
    const formId = new FormData();
    formId.append("id", id);
    formId.append("ubicacion_cantidad", stock);
    formId.append("producto_precio_menor", preciocompra);
    fetch("../controllers/productos/agregarUbicacion.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data === true) {
          Swal.fire(
            "Registrado!",
            "Producto agregado correctamente!",
            "success"
          );
          this.limpiarInputs();
          this.listadoProductos();
          window.location.href = "../views/productos.php";
        } else {
          Swal.fire(
            "icon: 'error'",
            "title: 'Error'",
            "text: 'No se pudo agregar a la bodega'"
          );
          this.listadoProductos();
        }
      })
      .catch((error) => console.error(error));
  };

  this.eliminar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/productos/eliminarProductos.php", {
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

  this.ponerValorCodigo=(codigo)=>{
    app.obtenerPorcentaje();
    app.editar(codigo);
  };
  this.editar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/productos/obtenerProducto.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"](
          "Esta en modo de actualizar datos, solo puede modificar un dato..!"
        );
        this.tipo_impuesto_id = document.getElementById("tipo_impuesto_id");
        $("#tipo_impuesto_id").val(data["producto_tipo_imp"]).trigger("change");
        //app.obtenerPorcentaje();
        this.producto_id.value=data.producto_id;
        this.producto_stock.value = data.producto_stock;
      document.getElementById("producto_stock").readOnly = true;
      this.porcentaje_iva=document.getElementById("porcentaje_iva");
        this.producto_codigoserial.value=data.producto_codigoserial;
        this.producto_descripcion.value = data.producto_descripcion;
        this.producto_precio_compra.value = data.producto_precio_menor;
        this.producto_precio_venta.value = data.producto_precio_mayor;
        this.tipo_impuesto_id.value =data.producto_tipo_imp;
        this.producto_imagenes.value = data.producto_imagen;
        //app.obtenerStok(data.bodega_id);
        // this.bodega_id_o.value = data.bodega_id;
        $("#categoria_id").val(data["categoria_id"]).trigger("change").prop('disabled', 'disabled');
        $("#lote_id").val(data["lote_id"]).trigger("change").prop('disabled', 'disabled');
        $("#proveedor_id").val(data["proveedor_id"]).trigger("change").prop('disabled', 'disabled');
        $("#porcentaje_iva").val(data["producto_porcentaje"]).trigger("change");
        //this.porcentaje_iva.value=data.producto_porcentaje;
        this.porcentaje_iva_producto.value=data.producto_porcentaje;
        document.getElementById("producto_codigoserial").focus();
        app.ponerporcentaje(data.producto_porcentaje);
        app.obtenerUbicaciones();
      })
      .catch((error) => console.error(error));
  };
  this.listarTipoCategoria = () => {
    fetch("../controllers/categoria/mostrarCategoria.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='categoria_id' id='categoria_id' autofocus >";
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
  this.listarTipoLote = () => {
    fetch("../controllers/lote/mostrarLote.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='lote_id' id='lote_id' >";
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
          "<select class='form-control' name='proveedor_id' id='proveedor_id' >";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
          data=data.data;
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
    } else if (formInput.get("") === "") {
      toastr["warning"]("El campo precio es requirido, debe escribir uno..!");
      this.producto_precio.focus();
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
          "<select class='form-control' name='sucursal_id' id='sucursal_id' autofocus required onChange='app.obtenerValor()'>";
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
        this.producto_sucursal.innerHTML = html;
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
          "<select class='form-control' name='bodega_id' id='bodega_id' required >";
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
    this.producto_precio_compra.value = "";
    this.producto_precio_venta.value = "";
    this.producto_stock.value = "";
    this.producto_fechaelaboracion.value = "";
    this.producto_fechaexpiracion.value = "";
    this.foto.value = "";
    $("#categoria_id").val("Seleccione").trigger("change");
    $("#lote_id").val("Seleccione").trigger("change");
    $("#proveedor_id").val("Seleccione").trigger("change");
    $("#porcentaje_iva").val("Seleccione").trigger("change");
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
        "<select class='form-control' name='porcentaje_iva2' id='porcentaje_iva2'  >";
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
this.ponerporcentaje = (data) => {
  $("#porcentaje_iva").val(data).trigger("change");
  //this.porcentaje_iva.value=data.producto_porcentaje;
  this.porcentaje_iva.value=data;
};
  //todo::busqueda de todas las ubicaciones del producto y ponerlo en el kardex
  this.obtenerUbicaciones=()=>{
    var select = document.getElementById("producto_id");
    const formId = new FormData();
    formId.append("id", select.value);
    fetch("../controllers/ubicacion/obtenerUbicacionparaProductos.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='ubicacion_id' id='ubicacion_id' autofocus required onChange='app.obtenerCantidadUbicacion()'>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.ubicacion_id +
            "'>" +
            //element.bodega_descripcion +
            //" - " +
            element.ubicacion_descripcion +
            "" +
            "</option>";
        });
        html += "</select>";
        this.ubicaciones.innerHTML = html;

        //this.producto_bodegas2.innerHTML = html;
      })
      .catch((error) => console.error(error));
    };
    this.obtenerCantidadUbicacion = () => {
      var ubicacion_id = document.getElementById("ubicacion_id").value;

      const formId = new FormData();
      formId.append("id", ubicacion_id);
      fetch("../controllers/ubicacion/obtenerUbicacionIdParaProduCantidad.php", {
        method: "POST",
        body: formId,
      })
        .then((response) => response.json())
        .then((data) => {
          this.producto_stock.value = data["ubicacion_cantidad"];
          document.getElementById("producto_stock").readOnly = false;
          //this.producto_idE.value = data["producto_id"];
          //this.bodega_idE.value = data["bodega_id"];
        })
        .catch((error) => console.error(error));
    };

})();
app.listarTipoCategoria();
app.listarTipoLote();
app.listarTipoProveedor();
app.listadoProductos();
app.listarTipoSucursal();
 app.listarTipoImpuesto();
