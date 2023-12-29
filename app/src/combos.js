const app = new (function () {
  
    this.sucursal_identificador=document.getElementById("sucursal_identificador");
    this.bodega_identificador=document.getElementById("bodega_identificador");
    // todo: combos totales
    this.combos_subtotal = document.getElementById("combos_subtotal");
    this.combos_total = document.getElementById("combos_total");
    this.combos_iva = document.getElementById("combos_iva");
    this.codigo_combo = document.getElementById("codigo_combo");
    this.nombre_producto_combo = document.getElementById("nombre_producto_combo");
    this.temp_combos_id_add = document.getElementById("temp_combos_id_add");
    this.cantidadactual_combos = document.getElementById("cantidadactual_combos");
    this.precio_producto_combos = document.getElementById("precio_producto_combos");
    this.temp_combos_precio_add = document.getElementById("temp_combos_precio_add");
    this.cantidadnueva_combos = document.getElementById("cantidadnueva_combos");
    this.tipo_impuesto = document.getElementById("tipo_impuesto");
    this.porcentaje_iva = document.getElementById("porcentaje_iva");
    this.combos_total = document.getElementById("combos_total");
    this.categoria = document.getElementById("categoria");
    // todo: detalle temporal
    this.tbody = document.getElementById("tbody");
    this.productosListado = document.getElementById("productosListado");
    this.productosListadoCombos = document.getElementById("productosListadoCombos");
    this.productosCombos = document.getElementById("productosCombos");
    
  
    this.listadoProductosCombos = () => {
      var sucursalid = this.sucursal_identificador.value;
      var bodegaid = this.bodega_identificador.value;
      fetch("../controllers/combos/listadoProductos.php")
        .then((response) => response.json())
        .then((data) => {
          permisos = data.permisosMod;
          data=data.data;
          html =
            "<table class='table table-striped table-bordered first' id='example11'>";
          html += "<thead>";
          html += "<tr>";
          html +=
            "<th>Imagen</th>";
          html += "<th>Descripción producto</th>";
          html += "</tr>";
          html += "</thead>";
          html += "<tbody>";
          data.forEach((element) => {
            html += "<tr>";
            if(element.producto_imagen === "Sin Imagen" || element.producto_imagen ===  "../../img/"){
              html +=
            "<td><center><img src='../utils/img/product.png' style='width:45%' onclick='app.agregarDetalleTemporalCombos("+element.producto_id+","+sucursalid+","+bodegaid+","+element.producto_precio_mayor+")'></center></td>";
            }else{
              const cadena = element.producto_imagen;
              let imagen = cadena.slice(3);
              html += "<td><center><img src="+imagen+" style='width:45%' onclick='app.agregarDetalleTemporalCombos("+element.producto_id+","+sucursalid+","+bodegaid+","+element.producto_precio_mayor+")'></center></td>";
            }
            html +=
            "<td><a onclick='app.agregarDetalleTemporalCombos("+element.producto_id+","+sucursalid+","+bodegaid+","+element.producto_precio_mayor+")'> <strong> Código Producto: " +
            element.producto_codigoserial +
            "</strong><br/><strong>Referencia: " +
            element.producto_codigoreferencia +
            "</strong><br/><strong>Descripción: " +
            element.producto_descripcion +
            "</strong><br/>Precio: $ " +
            element.producto_precio_mayor +
            "</a></td>";
          });
          html +=
            "</tr></tbody><tfoot><tr><th>Imagen</th><th>Descripción producto</th></tr></tfoot></table>";
          this.productosListado.innerHTML = html;
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
              "iDisplayLength": 3,
              "order":[[0,"desc"]]
          });
        })
        .catch((error) => console.error(error));
    };

    this.agregarDetalleTemporalCombos = (producto_id,sucursal_id,bodega_id,producto_precio_mayor) => {
      var producto_id = producto_id;
      var sucursal_id = sucursal_id;
      var bodega_id = bodega_id;
      var producto_precio_mayor = producto_precio_mayor;
      var cantidadvender = 1;
      const formId = new FormData();
      formId.append("producto_id",producto_id);
      formId.append("sucursal_id",sucursal_id);
      formId.append("bodega_id",bodega_id);
      formId.append("producto_precio_mayor",producto_precio_mayor);
      formId.append("precio_xcantidad",cantidadvender);
  
      fetch("../controllers/combos/guardarDetalleTemporalCombos.php", {
        method: "POST",
        body: formId,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data === 1) {
            toastr["success"]("Producto agregado!");
            $("#tbody").show();
            this.listadoDetalleTemporalCombos();
            this.listadoProductosCombos();
          }else{
            toastr["warning"]("El producto ya esta en el combo!");
          }
        })
        .catch((err) => console.error(err));
  };

  //todo::eliminar producto de tabla temporal
  this.modificar = (
    temp_combos_id,
    temp_combos_cantidad,
    temp_combos_precio
  ) => {
    this.temp_combos_id_add.value = temp_combos_id;
    this.cantidadactual_combos.value = temp_combos_cantidad;
    this.temp_combos_precio_add.value = temp_combos_precio;
  };

      //todo::eliminar producto de tabla temporal
      this.eliminar = (
        temp_combos_id
      ) => {
        const formEliminar = new FormData();
        formEliminar.append("temp_combos_id", temp_combos_id);
        fetch("../controllers/combos/eliminarFilaDetalleTemporalCombos.php", {
          method: "POST",
          body: formEliminar,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === 1) {
              toastr["error"]("Producto eliminado del combo!");  
              this.listadoDetalleTemporalCombos();
              this.sumarSubTotal();
              this.limpiarInputs();
              this.listadoProductosCombos();
            }
          })
          .catch((err) => console.error(err));
      };

  this.modalnuevaCantidadStock = () => {
      
    const form = new FormData(document.getElementById("stockformnuevacantidadcombos"));
   
        fetch("../controllers/combos/actualizarFilaDetalleTemporalCombos.php", {
          method: "POST",
          body: form,
        })
      .then((response) => response.json())
      .then((data) => {
        if (data === 1) {
          toastr["info"]("Cantidad actualizada detalle combo!");
          $("#exampleModalNuevaCantidad").modal("hide");
          this.listadoDetalleTemporalCombos();
          this.limpiarInputsCantidad();
          this.listadoProductosCombos();
        }
      })
      .catch((err) => console.error(err));
  };
    //todo::todo los datos de la tabla detalle temporal
    this.listadoDetalleTemporalCombos = () => {
      fetch("../controllers/combos/listadoDetalleTemporalCombos.php")
        .then((response) => response.json())
        .then((data) => {
          if (data.length > 0) {
            html = [];
            html+='<table class="table table-bordered text-center" id="example10">';
            html+=' <thead>';
            html+='  <tr>';
            html+='   <th>Código</th>';
            html+='  <th>Descripción</th>';
            html+='  <th>Cantidad</th>';
            html+='  <th>Precio x U</th>';
            html+='  <th>Total</th>';
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
              html += "<td><strong>" + element.temp_combos_cantidad + "</strong></td>";
              html += "<td><strong>" + element.temp_combos_precio + "</strong></td>";
              html += "<td><strong>" + element.temp_combos_total  + "</strong></td>";
              html +=
                '<td><button type="button" style="border-radius: 50%;width: 30px;height: 35px;" data-toggle="modal" data-target="#exampleModalNuevaCantidad"  class="btn btn-space btn-primary" title="Editar" onClick="app.modificar(' +
                element.temp_combos_id +
                "," +
                element.temp_combos_cantidad +
                "," +
                element.temp_combos_precio +
                ')"><i class= "fa fa-edit"></i></button>';
              html +=
                '<button type="button" style="border-radius: 50%;width: 35px;height: 35px;" class="btn btn-danger btn-sm" title="ELiminar" onClick="app.eliminar('+
                element.temp_combos_id +
                ')"><i class= "fa fa-trash"></i></button></td>';
              html += "</tr>";
            });
            html+='</tbody></table>';
            this.tbody.innerHTML = html;
            
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
              "iDisplayLength": 3,
              "order":[[0,"desc"]]
                });
                this.sumarSubTotal();
                
          } else {
            this.tbody.innerHTML =
              "<tr><td colspan='6'>No hay detalles de productos</td></tr>";
            this.combos_subtotal.value = "0.00";
            this.combos_total.value = "0.00";
            this.combos_iva.value = "0.00";
          }
        })
        .catch((error) => console.error(error));
    };

    // todo: detalle del producto a vender
        this.sumarSubTotal = () => {
            // var iva = document.getElementById("factura_ivas").value;
             fetch("../controllers/combos/sumDetalleTemporalCombos.php")
               .then((response) => response.json())
               .then((data) => {
              
                 //this.factura_subtotal.value=data.total*iva;
                 this.combos_subtotal.value = data.sin_impuesto;
                 //var totaliva = (data.total / 1.12).toFixed(2);
                 this.combos_total.value = data.com_impuesto;
                 this.combos_iva.value =  (this.combos_total.value - this.combos_subtotal.value).toFixed(2);
               })
               .catch((err) => console.error(err));
           };

    //todo::guardado de detalle temporal de
    this.guardar = () => {
      var categoria_id = document.getElementById("categoria_id");
      var codigo_combo = this.codigo_combo.value;
      var nombre_producto_combo = this.nombre_producto_combo.value;
      var tipo_impuesto_id = document.getElementById("tipo_impuesto_id");
      var porcentaje_iva = document.getElementById("porcentaje_iva");
      var combos_total = this.combos_total.value;
      const formId = new FormData();
      formId.append("categoria_id", categoria_id.value);
      formId.append("codigo_combo", codigo_combo);
      formId.append("nombre_producto_combo", nombre_producto_combo);
      formId.append("tipo_impuesto_id", tipo_impuesto_id.value);
      formId.append("porcentaje_iva", porcentaje_iva.value);
      formId.append("combos_total", combos_total);
     if (this.validacionInputCombo(formId) === true) {
         fetch("../controllers/combos/guardarCombo.php", {
           method: "POST",
           body: formId,
         })
           .then((response) => response.json())
           .then((data) => {
             if (data === true) {
              Swal.fire(
                "Registrado!",
                "El combo se guardo correctamente!",
                "success"
              );
               $("#tbody").show();
               this.listadoDetalleTemporalCombos();
               this.listadoCombos();
               this.limpiarInputs();
               this.listadoCombos();
               this.sumarSubTotal();
               this.listadoDetalleTemporalCombos();
             } else if (data === 1) {
              toastr["error"](
                "El campo código combo ya existe, debe escribir otro..!"
              );
              this.codigo_combo.focus();
             }else{
              toastr["warning"](
                "No se puede crear combo!"
              );
             }
           })
           .catch((err) => console.error(err));
     }
      
    };
    //todo::validar campos vacios factura
    this.validacionInputCombo = (formInput) => {
      if (formInput.get("nombre_producto_combo") === "") {
        toastr["warning"]("El nombre del combo es necesario, debe escribir uno..!");
        document.getElementById("nombre_producto_combo").focus();
        return false;
      } else if (formInput.get("tipo_impuesto_id") === "Seleecione") {
        toastr["warning"]("El tipo de impuesto es necesario, debe seleccionar uno..!");
        document.getElementById("tipo_impuesto_id").focus();
        return false;
      } else if (formInput.get("porcentaje_iva") === "Seleccione") {
        toastr["warning"]("El porcentaje de impuesto es obligatorio, debe seleccionar uno..!");
        document.getElementById("porcentaje_iva").focus();
        return false;
      } else if (formInput.get("combos_total") === "") {
        toastr["warning"]("El total del combo es obligatorio, debe escribir uno..!");
        document.getElementById("combos_total").focus();
        return false;
      }else if (formInput.get("categoria_id") === "Seleccione") {
        toastr["warning"]("La categoria es obligatoria, debe seleccionar uno..!");
        document.getElementById("categoria_id").focus();
        return false;
      }else if (formInput.get("codigo_combo") === "") {
        toastr["warning"]("El codigo del combo es obligatorio, debe escribir uno..!");
        document.getElementById("codigo_combo").focus();
        return false;
      }
      return true;
    };  


    this.limpiarInputs = () => {
      this.nombre_producto_combo.value = "";
      $("#tipo_impuesto_id").val("Seleccione").trigger("change");
      $("#porcentaje_iva").val("selected").trigger("change");
      $("#categoria_id").val("Seleccione").trigger("change");
      this.codigo_combo.value = "";
    };

    this.limpiarInputsCantidad = () => {
        this.cantidadnueva_combos.value = "";
      };

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

      this.listadoCombos = () => {
        fetch("../controllers/combos/listadoCombos.php")
          .then((response) => response.json())
          .then((data) => {
            //generar columnas de la tabla
            html =
              "<table class='table table-striped table-bordered first' id='example1'>";
            html += "<thead>";
            html += "<tr>";
            html +="<th>Id</th>";
            html +="<th>Imagen</th>";
            html +="<th>Categoria</th>";
            html +="<th>Código combo</th>";
            html +="<th>Detalle</th>";
            html +="<th>Precio Venta</th>";
            html +="<th>Opciones</th>";
            html += "</tr>";
            html += "</thead>";
            html += "<tbody>";
            permisos = data.permisosMod;
            datos = data.data;
            datos.forEach((element) => {
              html += "<tr>";
              html += "<td>" + element.producto_id + "</td>";
              if(element.producto_imagen === "Sin Imagen" || element.producto_imagen === "../../img/" || element.producto_imagen === ""){
                html +=
              "<td><center><img src='../utils/img/product.png' style='width:20%'></center></td>";
              }else{
                const cadena = element.producto_imagen;
                let imagen = cadena.slice(3);
                html += "<td><center><img src="+imagen+" style='width:20%'></center></td>";
              }
              html += "<td>" + element.categoria_descripcion + "</td>";
              html += "<td>" + element.producto_codigoserial + "</td>";
              html += "<td>" + element.producto_descripcion + "</td>";
              html += "<td>" + element.producto_precio_mayor + "</td>";
              html += "<td>";
                html +=
                  "<button type='button' class='btn btn-info btn-sm' title='Ver' style='border-radius: 50%; width: 40px; height: 40px; margin: 2% 2%;' onClick='app.listadoCombosProducto(" +
                  element.producto_id +
                  ")'><i class='fas fa-eye'></i></button>";
              /*
              if (permisos["u"] === "1") {
                html +=
                  "<button type='button' class='btn btn-info btn-sm' title='SRI' style='border-radius: 50%; width: 40px; height: 40px; margin: 2% 2%;' onClick='app.firmarEnviar(" +
                  element.factura_id +
                  ")'>Editar</button>";
              }
              */
              if (permisos["d"] === "1") {
                  html += "<button type='button' class='btn btn-danger btn-sm' title='Eliminar' style='border-radius: 50%; width: 40px; height: 40px; margin: 2% 2%;' onClick='app.eliminar(" +
                  element.producto_id +
                  ")'><i class='fas fa-times'></i></button>";
              }
              html += "</td>";
              html += "</tr>";
            });
            html +=
              "</tr></tbody></table>";
            this.productosListadoCombos.innerHTML = html;
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
              },'dom': 'lBfrtip',
              'buttons': [
                 {
                      "extend": "excelHtml5",
                      "text": "<i class='fas fa-file-excel'></i> Excel",
                      "titleAttr":"Exportar a Excel",
                      "title": "Listado de Facturas",
                      "className": "btn btn-success",
                  },{
                      "extend": "pdfHtml5",
                      "text": "<i class='fas fa-file-pdf'></i> PDF",
                      orientation: 'landscape',//todo::cambiar horzontal
                      "title": "Listado de Facturas",
                      "titleAttr":"Exportar a PDF",
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

      this.listadoCombosProducto = (id) => {
        $("#exampleModalCombos").modal("show");
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
            this.productosCombos.innerHTML = html;
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

      this.eliminar = (id) => {
        const formId = new FormData();
        formId.append("id", id);
        fetch("../controllers/combos/eliminarCombos.php", {
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
              this.listadoDetalleTemporalCombos();
              this.listadoCombos();
              this.listadoDetalleTemporalCombos();
            } else {
              Swal.fire(
                "icon: 'error'",
                "title: 'Error'",
                "text: 'No se pudo eliminar el producto'"
              );
              this.listadoDetalleTemporalCombos();
              this.listadoCombos();
              this.listadoDetalleTemporalCombos();
            }
          })
          .catch((error) => console.error(error));
      };
    
  })();
  app.listarTipoImpuesto();
  app.listarTipoCategoria();
  app.listadoDetalleTemporalCombos();
  app.sumarSubTotal();
  app.listadoCombos();
  app.listadoProductosCombos();
