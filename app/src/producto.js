const app = new (function () {
  this.producto_id = document.getElementById("producto_id");
  this.historial_id = document.getElementById("historial_id");
  this.producto_codigoserial = document.getElementById("producto_codigoserial");
  this.producto_descripcion = document.getElementById("producto_descripcion");
  this.producto_precioxMe = document.getElementById("producto_precioxMe");
  this.producto_precioxMa = document.getElementById("producto_precioxMa");
  this.producto_stock = document.getElementById("producto_stock");
  this.total_factura = document.getElementById("total_factura");
  this.proveedor_identificador = document.getElementById("proveedor_identificador");


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
  this.tableDetalleProductos=document.getElementById("tableDetalleProductos");

//proveedores
this.proveedor_id=document.getElementById("proveedor_id");
this.razonSocialProveedor = document.getElementById("razonSocialProveedor");
this.rucProveedor = document.getElementById("rucProveedor");
this.direccionProveedor = document.getElementById("direccionProveedor");
this.emailProveedor = document.getElementById("emailProveedor");


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
  this.productosl=document.getElementById("productosl");
  this.clientesl=document.getElementById("clientesl");
  this.codigoReferenciaProducto=document.getElementById("codigoReferenciaProducto");
  this.producto_imagenes = document.getElementById("producto_imagenes");

 
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
  
  //todo::todo los datos de la tabla detalle temporal
  this.listadoDetalleTemporal = () => {
    fetch("../controllers/producto/listadoDetalleTemporal.php")
      .then((response) => response.json())
      .then((data) => {
        if (data.length >= 0) {
          html = [];
          html+='<table class="table table-bordered text-center" id="example10">';
          html+=' <thead>';
          html+='  <tr>';
          html+='   <th>Código producto</th>';
          html+='  <th>Descripción producto</th>';
          html+='  <th>Cantidad</th>';
          html+='  <th>Bodega Destino</th>';
          html+='   <th>Ubicacion Destino</th>';
          html+='   <th>Precio Compra</th>';
          html+='   <th>Total</th>';
          html+='  <th style="width: 40px">Opciones</th>';
          html+='  </tr>';
          html+=' </thead>';
          html+=' <tbody id="tbody">';
          data.forEach((element) => {
            html += "<tr>";
            html +=
              "<td><strong>" +
              element.temp_producto_codigoserial +
              "</strong></td>";
              html +=
              "<td><strong>" +
              element.temp_producto_descripcion +
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
            "<td><strong>" + element.temp_producto_precio_menor + "</strong></td>";
            html +=
            "<td><strong>" + (element.temp_producto_precio_menor*element.temp_producto_stock).toFixed(2) + "</strong></td>";
            html +=
              '<td><button type="button" style="margin:0% 1%" class="btn btn-success btn-sm" title="Generar Codigo"onClick="app.imprimirCodigo(' +
              element.temp_producto_id +
              ')"><i class="fas fa-barcode"></i></button><button type="button" class="btn btn-danger btn-sm" title="ELiminar" onClick="app.eliminar(' +
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
          });
          html +=
          "</tr></tbody></table>";
          this.tableDetalleProductos.innerHTML = html;

          $("#example10").DataTable({
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
            "iDisplayLength": 2,
            "order":[[0,"desc"]]
              });
              this.sumarSubTotalDeProducto();
        } else {
          this.tbody.innerHTML =
            "<tr><td colspan='6'>No hay detalles de productos</td></tr>";
        }
      })
      .catch((error) => console.error(error));
  };
  this.id_facturaCompra = document.getElementById("id_facturaCompra");
  this.listadoProductos = () => {
    fetch("../controllers/producto/listadoProducto.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html +=
          "<th>ID</th><th>Código producto</th><th>Detalle</th><th>Bodega</th><th>Precio</th><th>Stock</th><th>Categoria</th><th>Lote</th><th>Fecha elaboración</th><th>Fecha Expiracion</th><th>Opciones</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        data.forEach((element) => {
          html += "<tr>";
          html +=
            "<td><center></center>" +
            element.producto_id +
            "</td>";

          html +=
            "<td><center><img src='../../public/images/serial.png' alt='logo box' width='30px'><br/><strong>" +
            element.producto_codigoserial +
            "</strong></center></td>";

          html += "<td>" + element.producto_descripcion.toUpperCase() + "</td>";
          html +=
            "<td>" +
            element.bodega_descripcion +
            "/" +
            element.ubicacion_descripcion +
            "</td>";
          html +=
            "<td><i>Precio x menor:" +
            element.producto_precio_menor +
            "</i><br/><i>Precio x mayor:" +
            element.producto_precio_mayor +
            "</i></td>";
          html += "<td>" + element.ubicacion_cantidad + "</td>";
          html += "<td>" + element.categoria_descripcion + "</td>";
          html += "<td>" + element.lote_descripcion + "</td>";
          html += "<td>" + element.producto_fechaelaboracion + "</td>";
          html += "<td>" + element.producto_fechaexpiracion + "</td>";

          html +=
            "<td><button type='button' class='btn btn-info btn-sm' title='Editar' onClick='app.editar(" +
            element.producto_id +
            ")'><i class='fas fa-boxes'></i></button></button><button type='button' class='btn btn-primary btn-sm' title='Aumentar stock' onClick='app.aumentarStock(" +
            element.ubicacion_id +
            ")'><i class='fas fa-cubes'></i></button></button><button type='button' class='btn btn-danger btn-sm' title='Disminuir stock' onClick='app.disminuirStock(" +
            element.ubicacion_id +
            ")'><i class='fas fa-cubes'></i></button></button><button type='button' class='btn btn-warning btn-sm text-white' title='Código barra' onClick='app.codigomostrar(" +
            element.producto_id +
            ")' data-toggle='modal' data-target='#exampleModalCodigoserial'><i class='fas fa-barcode'></i></button></td>";
        });
        //")'><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-success btn-sm' title='Ubicacion' onClick='app.ubicacion(" +
        //  element.producto_id +
        html +=
          "</tr></tbody><tfoot><tr><th>Código producto</th><th>Logo</th><th>Detalle</th><th>Opciones</th></tr></tfoot></table>";
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
          },
        });
      })
      .catch((error) => console.error(error));
  };

  //Nuevo proveedor
  this.modalnuevoProveedorProducto = () => {
    const form = new FormData(document.getElementById("stockformproveedor"));
    //   if (this.validacionInputModalStockAumentar(form) === true) {
         fetch("../controllers/proveedor/guardarProveedorProducto.php", {
           method: "POST",
           body: form,
         })
           .then((response) => response.json())
           .then((data) => {
             if (data) {
               Swal.fire(
                 "Registrado!",
                 "Nuevo proveedor correctamente!",
                 "success"
               );
               console.log(data);
               $("#exampleModalNuevoProveedor").modal("hide");
               
               this.proveedor_identificador.value = data.proveedor_id;
               this.razonSocialProveedor.value = data.proveedor_razonsocial;
               this.rucProveedor.value = data.proveedor_ruc;
               this.direccionProveedor.value = data.proveedor_direccion;
               this.emailProveedor.value =  data.proveedor_email;
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
  this.guardar = () => {
    
    //console.log(codAuto.checked);
    secuencial=this.producto_codigoserial.value;
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
            if (data) {
              toastr["info"]("Ingreso  de Producto temporal!");
             // a=this.producto_codigoserial.value;
              this.listadoDetalleTemporal();
              this.limpiarInputs(); 
              this.listadoDetalleTemporal();
             //app.codigoAutomatico();
              app.obtenerSecuencialIngreso(secuencial);
              app.obtenerProducto();
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
  //todo::validar campos vacios id factura
  this.validacionInputProductoCompra = (formInput) => {
    if (formInput.get("id_facturaCompra") === "") {
      toastr["warning"](
        "El campo Numero de factura  es requirido, debe elegir uno..!"
      );
      this.id_facturaCompra.focus();
      return false;
    } else {
      return true;
    }
  };
  this.guardar_historial_ubicacion = () => {
    var id_facturaCompra = document.getElementById("id_facturaCompra");
    var factura_total = document.getElementById("total_factura");
    const formId = new FormData();
    formId.append("id_facturaCompra", id_facturaCompra.value);
    formId.append("factura_total", factura_total.value);
    if (this.validacionInputProductoCompra(formId) === true) {
      fetch("../controllers/producto/guardarIngresoProductos.php", {
        method: "POST",
        body: formId,
      })
        .then((response) => response.json())
        .then((data) => {
          //console.log(data);
          validacion = data[0];
          if (validacion.estado === true) {
            toastr["info"]("Ingreso de Productos guardados correctamente");
            app.codigoAutomatico();
            this.historial_id.value = validacion.id_historial;
            $("#btn-guardaringreso").hide();
            this.limpiarInputsIngreso();
            $("#btn-imprimir").show();
          } else if (validacion.estado === 2) {
            toastr["warning"]("No existen Productos para el ingreso");
          }
        })
        .catch((error) => console.error(error));
    }
  };
  //todo::generar impresion de ingreso
  this.imprimirIngreso = () => {
    var historial_id = document.getElementById("historial_id");
    const formId = new FormData();
    formId.append("historial_id", historial_id.value);
    //TODO::NOS FALTA LOS MODELOS PAR APODER IMPRIMRI YA TENMOS LAS BASES
    app.generearPDF(historial_id.value);
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
          $("#btn-imprimir").show();
        } else if (data.estado === 2) {
          toastr["warning"]("No existen Productos para el ingreso");
        }
      })
      .catch((error) => console.error(error));
  };
  //todo::impresion de codigo de barras
  this.imprimirCodigo = (id) => {
    data=id;
    /*document.getElementById("codigoform").style.display = "none";
    document.getElementById("titulocardheader").style.display = "none";
    document.getElementById("imprimir").style.display = "none";
    window.print();
    window.location.href = "../views/generarcodigo.php";*/
    var ancho = 100;
    var alto = 100;
    var x = parseInt(window.screen.width / 2 - ancho / 2);
    var y = parseInt(window.screen.width / 2 - alto / 2);
    $url = "../../app/utils/factura/generarCodigoBarras.php?cl=2" + "&f=" + data;
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
  //todo::impresion de codigo de barras
  this.generearPDF = (data) => {
    var ancho = 1000;
    var alto = 800;
    var x = parseInt(window.screen.width / 2 - ancho / 2);
    var y = parseInt(window.screen.width / 2 - alto / 2);
    $url = "../../app/utils/factura/generarIngresos.php?cl=1" + "&f=" + data;
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
    location.href = "../views/producto.php";
  };
  //todo::editar los registros
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
          "<select class='form-control' name='proveedor_id' id='proveedor_id' required >";
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

  
     //todo::poner lista proveedores
     this.modallistaProveedor  = () => {
      fetch("../controllers/proveedor/listadoProveedor.php")
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
          data=data.data;
          data.forEach((element) => {
            html += "<tr>";
            html +=
              "<td><a type='button' onclick='app.ponerValorSelectProveedor("+element.proveedor_id +");'>" +
              element.proveedor_ruc +
              "</a></td>";
            html += "<td><a type='button' onclick='app.ponerValorSelectProveedor("+element.proveedor_id +");'>" + element.proveedor_razonsocial.toUpperCase() + "</a></td>";

          });
          //")'><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-success btn-sm' title='Ubicacion' onClick='app.ubicacion(" +
          //  element.producto_id +
          html +=
            "</tr></tbody><tfoot><tr><th>Ruc</th><th>Identificación</th></tr></tfoot></table>";
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
    };
      //todo::poner el valor de la seleccion de los proveedores con triggers

this.ponerValorSelectProveedor=(id)=>{
  var form = new FormData();
    form.append("id", id);
    fetch("../controllers/proveedor/obtenerProveedor.php", {
      method: "POST",
      body: form,
    })
      .then((response) => response.json())
      .then((data) => {
        //$("#proveedor_id").val(id).trigger("change");
        this.proveedor_identificador.value=data.proveedor_id;
        this.razonSocialProveedor.value = data.proveedor_razonsocial;
        this.rucProveedor.value = data.proveedor_ruc;
        this.direccionProveedor.value = data.proveedor_direccion;
        this.emailProveedor.value = data.proveedor_email;
        $("#exampleModalProveedor").modal("hide");;
//        app.obtenerClienteR();
      })
    .catch((error) => console.error(error));

 
};

this.obtenerProveedor = () => {
  var form = new FormData();
  form.append("ruc_proveedor", this.rucProveedor.value);
  //fetch("../controllers/producto/obtenerProductoSerial.php", {
  fetch("../controllers/producto/obtenerProveedorVenta.php", {
    method: "POST",
    body: form,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data) {
          //app.obtenerStok(data.bodega_id);
          this.proveedor_id.value = data.proveedor_id;
          this.razonSocialProveedor.value = data.proveedor_razonsocial;
          this.rucProveedor.value = data.proveedor_ruc;
          this.direccionProveedor.value = data.proveedor_direccion;
          this.emailProveedor.value = data.proveedor_direccion;
      } 
    })
    .catch((err) => console.error(err));
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
    } else if (formInput.get("proveedor_identificador") === "") {
      toastr["warning"]("El proveedor es requerido, debe elegir uno..!");
      document.getElementById("proveedor_identificador").focus();
      //return false;
    } else if (formInput.get("sucursal_identificador") === null) {
      toastr["warning"]("La sucursa es requerido, debe elegir uno..!");
      document.getElementById("sucursal_identificador").focus();
      return false;
    } else if (formInput.get("bodega_identificador") === null) {
      toastr["warning"]("La bodega  es requerido, debe elegir uno..!");
      document.getElementById("bodega_identificador").focus();
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
    } else if (formInput.get("porcentaje_iva2") === "") {
      toastr["warning"]("El campo precio es requirido, debe escribir uno..!");
      this.porcentaje_iva.focus();
      return false;
    } else {
      return true;
    }
  };
  /*la siguiente funcion se modifica para evitar que valide el ingreso de datos en la fecha*/
  /*this.validacionInputProducto = (formInput) => {
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
    } else if (formInput.get("producto_precioMe") === "") {
      toastr["warning"]("El campo precio es requirido, debe escribir uno..!");
      this.producto_precio.focus();
      return false;
    } else if (formInput.get("producto_stock") === "") {
      toastr["warning"]("El campo stock es requirido, debe escribir uno..!");
      this.producto_stock.focus();
      return false;
    } else if (formInput.get("producto_fechaelaboracion") === "") {
      toastr["warning"](
        "El campo fecha de elaboración es requerida, debe elegir uno..!"
      );
      document.getElementById("producto_fechaelaboracion").focus();
      return false;
    } else if (formInput.get("producto_fechaexpiracion") === "") {
      toastr["warning"](
        "El campo fecha de expiración es requerida, debe elegir uno..!"
      );
      document.getElementById("producto_fechaexpiracion").focus();
      return false;
    } else {
      return true;
    }
  };*/
  this.validacionInputModalUbicacion = (formInput) => {
    if (formInput.get("sucursal_identificador") === null) {
      toastr["warning"]("La sucursal es requerida, debe elegir uno..!");
      document.getElementById("sucursal_identificador").focus();
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
/*
  this.obtenerCategoria = (id) => {
    var idProducto = id;
    const formId = new FormData();
    formId.append("id", idProducto);
    fetch("../controllers/producto/obtenerCategoriaProducto.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='categoria_id' id='categoria_id' autofocus required >";
        data.forEach((element) => {
         // console.log("d: "+element.categoria_descripcion);
          html +=
            "<option value='" +
            element.categoria_id +
            "'>" +
            //element.bodega_descripcion +
            //" - " +
            element.categoria_descripcion +
            "</option>";
        });
        html += "</select>";
        this.categoria.innerHTML = html;
        //this.producto_bodegas2.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
*/
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
            //element.bodega_descripcion +
            //" - " +
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
            let codigo=element.producto_codigoserial;
            let datos2=(JSON.stringify(codigo));
            html +=
              "<td><center><strong><a type='button' onclick='app.ponerValorCodigo("+datos2 +");'>" +
              element.producto_codigoserial +
              "</a></strong></center></td>";

            html += "<td><a type='button' onclick='app.ponerValorCodigo("+datos2+");'>" + element.producto_descripcion.toUpperCase() + "</a></td>";

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
    };
    this.ponerValorCodigo=(codigo)=>{
      //console.log(codigo);
      //this.tipo_producto.value='P';
      this.producto_codigoserial.value=codigo;
      app.obtenerProducto();
      app.obtenerPorcentaje();
      //app.obtenerCategoria(codigo);
      
      $("#exampleModalProductos").modal("hide");
      //document.getElementById("ubicacionform").reset();
    };

    this.validarCheck=()=>{
      //console.log(codigo);
      //this.tipo_producto.value='P';
      var checkCod = document.getElementById("codAutomatico");
      if (checkCod.checked == "" && app.obtenerSecuencialIngreso(1) == 1){
        document.getElementById('producto_codigoserial').readOnly = true;
        app.obtenerSecuencialIngreso(1);
        
      }if(checkCod.checked == "" && app.obtenerSecuencialIngreso(1) != 1){
        document.getElementById('producto_codigoserial').readOnly = true;
       
        app.codigoAutomatico();
      }else{
        this.producto_codigoserial.value="";
        document.getElementById('producto_codigoserial').readOnly = false;
      }
      //app.obtenerCategoria(codigo);
      //document.getElementById("ubicacionform").reset();
    };

    //todo::fin de la lista de productos hasta aqui poner todo
  //todo::producto
  this.obtenerProducto = () => {
    var form = new FormData();
    form.append("producto_codigoserial", this.producto_codigoserial.value);
    form.append("tipo_producto", "P");
    //fetch("../controllers/producto/obtenerProductoSerial.php", {
    fetch("../controllers/venta/obtenerProductoSerial.php", {
      method: "POST",
      body: form,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data) {
          this.tipo_impuesto_id = document.getElementById("tipo_impuesto_id");
          this.porcentaje_iva=document.getElementById("porcentaje_iva");
          this.categoria_idP=document.getElementById("categoria_idP");
          $("#categoria_id").val(data["categoria_id"]).trigger("change");
          //console.log(data.categoria_id);
          this.producto_descripcion.value = data.producto_descripcion;
          this.producto_precioxMe.value = data.producto_precio_menor;
          this.producto_precioxMa.value = data.producto_precio_mayor;
          this.tipo_impuesto_id.value =data.producto_tipo_imp; 
          this.codigoReferenciaProducto.value = data.producto_codigoreferencia;
          this.producto_imagenes.value = data.producto_imagen;
          //$("#producto_descripcion").disabled;
          var producto_descripcion = document.getElementById(
            "producto_descripcion"
          );

          //app.obtenerStok(data.bodega_id);
          // this.bodega_id_o.value = data.bodega_id;
          this.porcentaje_iva.value=data.producto_porcentaje;
        } else {
          var producto_descripcion = document.getElementById(
            "producto_descripcion"
          );
          producto_descripcion.disabled = false;
          this.producto_descripcion.value = "";
          this.producto_precioxMe.value = "";
          this.producto_precioxMa.value = "";
        }
      })
      .catch((err) => console.error(err));
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

  this.limpiarInputsIngreso = () => {
    this.producto_id.value = "";
    this.producto_codigoserial.value = "";
    this.producto_descripcion.value = "";
    this.producto_precioxMe.value = "";
    this.producto_precioxMa.value = "";
    this.producto_stock.value = "";
    this.producto_fechaelaboracion.value = "";
    this.producto_fechaexpiracion.value = "";
    this.ubicacion_descripcion.value = "";
    this.tableDetalleProductos.value="";
    this.total_factura.value="";
    this.id_facturaCompra.value="";
    this.ubicacion_descripcion.value="PUNTO-VENTA";
   // this.proveedor_id.value = "";
   // this.razonSocialProveedor.value = "";
   // this.rucProveedor.value = "";
   // this.direccionProveedor.value = "";
   // this.emailProveedor.value = "";
   this.codigoReferenciaProducto.value = "";
   $("#tbody").empty();
    $("#categoria_id").val("Seleccione").trigger("change");
    $("#proveedor_id").val("Seleccione").trigger("change");
    $("#sucursal_id").val("Seleccione").trigger("change");
    $("#producto_bodegas").val("Seleccione").trigger("change");
    $("#lote_id").val("Seleccione").trigger("change");
    $("#tipo_impuesto_id").val("Seleccione").trigger("change");
    $("#porcentaje_iva").val("Seleccione").trigger("change");
    document.getElementById("categoria_id").focus();
    document.getElementById("producto_stock").readOnly = false;
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
    this.ubicacion_descripcion.value = "";
    this.tableDetalleProductos.value="";
    this.ubicacion_descripcion.value="PUNTO-VENTA";
   // this.proveedor_id.value = "";
   // this.razonSocialProveedor.value = "";
   // this.rucProveedor.value = "";
   // this.direccionProveedor.value = "";
   // this.emailProveedor.value = "";
   this.codigoReferenciaProducto.value = "";
    $("#categoria_id").val("Seleccione").trigger("change");
    $("#proveedor_id").val("Seleccione").trigger("change");
    //$("#sucursal_id").val("Seleccione").trigger("change");
    //$("#producto_bodegas").val("Seleccione").trigger("change");
    $("#lote_id").val("Seleccione").trigger("change");
    $("#tipo_impuesto_id").val("Seleccione").trigger("change");
    $("#porcentaje_iva").val("Seleccione").trigger("change");
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
  //imputs ocultos por defecto para reserva
  this.ocultarInputs = () => {
    $("#btn-imprimir").hide();
  };
  this.obtenerSecuencialIngreso=(codigo_serie)=> {
    var form = new FormData();
    form.append("serie", codigo_serie);
    fetch("../controllers/producto/obtenerUltimocodigoS.php", {
      method: "POST",
      body: form,
    })
    .then((response) => response.json())
      .then((data) => {
        //console.log(data);
        this.producto_codigoserial.value=parseInt(data);

      })
  }
  this.sumarSubTotalDeProducto = () => {
       fetch("../controllers/producto/sumarSubTotalDeProducto.php")
       .then((response) => response.json())
       .then((data) => {
        this.total_factura.value = data.total_factura_producto;
       })
       .catch((err) => console.error(err));
  };
  //todo::proceso para validar el campo que no existe en la tabla producto 
  //todo:: ultimo codigo consecutivo cuando no se realiza ningun proceso
  this.codigoAutomatico =() => {
    fetch("../controllers/producto/obtenerUltimocodigo.php")
      .then((response) => response.json())
      .then((data) => {
        //console.log(data);
        var dato=data
        var variableValida= new buscarCodigoEx(dato);
        while (variableValida==='true'){
          dato=dato+1;
        }
        
        this.producto_codigoserial.value=dato;
        app.obtenerProducto();
      })
      .catch((error) => console.error(error));
  };
  function buscarCodigoEx(dato) {
    var form = new FormData();
    form.append("serie", dato);
    fetch("../controllers/producto/validarCodigoSerial.php", {
      method: "POST",
      body: form,
    })
    .then((response) => response.json())
      .then((data) => {
      //console.log(data);
        if(data.producto_id > 0){
          return 'true';
        }
      })
      .catch((error) => console.error(error));
  };
})();
app.listarTipoCategoria();
app.listarTipoLote();
app.listarTipoProveedor();
app.listadoDetalleTemporal();
app.listarTipoSucursal();
app.ocultarInputs();
app.listarTipoImpuesto();
app.codigoAutomatico();

// app.lectorCodigoProducto();
