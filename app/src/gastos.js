const app = new (function () {
    this.gastosid = document.getElementById("gastosid");
    this.gasto_factura = document.getElementById("gasto_factura");
    this.gastos_descripcion = document.getElementById("gastos_descripcion");
    this.tipo_gasto = document.getElementById("tipo_gasto");
    this.gastos_total = document.getElementById("gastos_total");
    this.gastos = document.getElementById("gastos");
    this.selectEmisor=document.getElementById("selectEmisor");
    this.listadoGastos = () => {
      fetch("../controllers/gastos/listadoGastos.php")
        .then((response) => response.json())
        .then((data) => {
          html =
            "<table class='table table-striped table-bordered first' id='example1'>";
          html += "<thead>";
          html += "<tr>";
          html += "<th>ID</th><th>Numero Factura</th><th>Fecha</th><th>Detalle Gasto</th><th>Valor Total</th><th>Tipo</th><th>Emisor</th>";
          html+="<th>Opciones</th>"
          html += "</tr>";
          html += "</thead>";
          html += "<tbody>";
          permisos = data.permisosMod;
          data=data.data;
          data.forEach((element) => {
            html += "<tr>";
            html +=
              "<td><strong>" + element.gastos_id + "</strong></td>";
            html +=
              "<td><strong>" + element.gastos_factura + "</strong></td>";
              html +=
              "<td><strong>" + element.gastos_fecha_i + "</strong></td>";
            html +=
              "<td><strong> " +
              element.gastos_descripcion +"</td>";
            html +=
              "<td><strong> " +
              element.gastos_total +"</td>";
              html +=
              "<td><strong>" +
              element.gasto_tipo +"</td>";
              html +=
              "<td><strong>" +
              element.nombreComercial +"</td>";
            html += "<td>";
            if(permisos["w"] === "1" && permisos["u"] === "1"){
               html +=
              "<button type='button' class='btn btn-info btn-sm' title='Editar' style='border-radius: 50%; width: 40px; height: 40px; margin: 0% 2%;' onClick='app.editar(" +
              element.gastos_id +
              ")'><i class='fas fa-pencil-alt'></i></button>";
            }
            if(permisos["d"] === "1"){
               html +=  
              "<button type='button' class='btn btn-danger btn-sm' title='Eliminar' style='border-radius: 50%; width: 40px; height: 40px; margin: 0% 2%;' onClick='app.eliminar(" +
              element.gastos_id +
              ")'><i class='fas fa-trash'></i></button>";
              }
            if(element.gasto_tipo==='COMPRA' && permisos["i"] === "1"){
                html +=
              "<button type='button' class='btn btn-success btn-sm' title='Imprimir' style='border-radius: 50%; width: 40px; height: 40px; margin: 0% 2%;' onClick='app.imprimirIngreso(" +
              element.historial_idIngreso +
              ")'><i class='fas fa-print'></i></button>";
              }
          html += "</td>";
              html +=
              "</tr>";
          });
                this.gastos.innerHTML = html;
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
                    "titleAttr":"Esportar a Excel",
                    "title": "Listado de Gastos",
                    "className": "btn btn-success",
                },{
                    "extend": "pdfHtml5",
                    "text": "<i class='fas fa-file-pdf'></i> PDF",
                    orientation: 'landscape',//todo::cambiar horzontal
                    "title": "Listado de Gastos",
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
      //todo::generar impresion de ingreso
  this.imprimirIngreso = (historial_id) => {
    var historial_id = historial_id;
    const formId = new FormData();
    formId.append("historial_id", historial_id);
    //TODO::NOS FALTA LOS MODELOS PAR APODER IMPRIMRI YA TENMOS LAS BASES
    app.generearPDF(historial_id);
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
    location.href = "../views/gastos.php";
  };
    this.guardar = () => {
      const form = new FormData(document.getElementById("gastosFrom"));
      if (this.validacionInputGastos(form) === true) {
        if (this.gastosid.value === "") {
          fetch("../controllers/gastos/guardarGastos.php", {
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
                this.listadoGastos();
              } else if (data === 1) {
                toastr["error"](
                  "El nombre sucursal ya existe, debe escribir otro..!"
                );
                this.gastos_descripcion.focus();
              }
            })
            .catch((error) => console.error(error));
        } else {
          fetch("../controllers/gastos/actualizarGastos.php", {
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
                this.listadoGastos();
              } else if (data === 1) {
                toastr["error"](
                  "El nombre sucursal ya existe, debe escribir otro..!"
                );
                this.gastos_descripcion.focus();
              }
            })
            .catch((error) => console.error(error));
        }
      }
    };
    this.editar = (id) => {
      const formId = new FormData();
      formId.append("id", id);
      fetch("../controllers/gastos/obtenerGastosId.php", {
        method: "POST",
        body: formId,
      })
        .then((response) => response.json())
        .then((data) => {
          toastr["info"](
            "Esta en modo de actualizar datos, solo puede modificar un dato..!"
          );
          this.gastosid.value = data.gastos_id;
          this.gasto_factura.value = data.gastos_factura;
          this.gastos_descripcion.value = data.gastos_descripcion;
          this.gastos_total.value = data.gastos_total;
          this.tipo_gasto.value = data.gasto_tipo;
          this.gasto_factura.focus();
        })
        .catch((error) => console.error(error));
    };
    this.eliminar = (id) => {
      const formId = new FormData();
      formId.append("id", id);
      Swal.fire({
        title: "¿Esta seguro de eliminar este registro de gastos?",
        text: "Se eliminará por completo de los registro..!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
      }).then((result) => {
        if (result.isConfirmed) {
          fetch("../controllers/gastos/eliminarGastos.php", {
            method: "POST",
            body: formId,
          })
            .then((response) => response.json())
            .then((data) => {
              if (data === true) {
                Swal.fire("Eliminado!", "Gasto eliminada.", "success");
                this.listadoGastos();
              }
            })
            .catch((error) => console.error(error));
        }
      });
    };
    this.validacionInputGastos = (formInput) => {
      if (formInput.get("gasto_factura") === "") {
        toastr["warning"]("La provincia es requerida, debe escribir uno..!");
        document.getElementById("gasto_factura").focus();
        return false;
      } else if (formInput.get("gastos_descripcion") === "") {
        toastr["warning"]("El nombre es requerido, debe escribir uno..!");
        document.getElementById("gastos_descripcion").focus();
        return false;
      } else if (formInput.get("gastos_total") === "") {
        toastr["warning"]("El telefono es requerido, debe escribir uno..!");
        document.getElementById("gastos_total").focus();
        return false;
      } else {
        return true;
      }
    };
    this.limpiarInputs = () => {
      this.gastosid.value = "";
      this.gasto_factura.value = "";
      this.gastos_descripcion.value = "";
      $("#tipo_gasto").val("Selected").trigger("change");
      this.gastos_total.value = "";
      this.gasto_factura.focus();
    };
/*
    this.listarEmisores = () => {
      fetch("../controllers/emisor/listadoEmisor.php")
        .then((response) => response.json())
        .then((data) => {
          html =
            "<select class='form-control' name='emisor_establecimiento' id='emisor_establecimiento' autofocus required>";
          html +=
            "<option disabled='selected' selected='selected'>Seleccione</option>";
          data.forEach((element) => {
            html +=
              "<option value='" +
              element.id +
              "'>" +
              element.razonSocial +
              "</option>";
          });
          html += "</select>";
          this.selectEmisor.innerHTML = html;
        })
        .catch((error) => console.error(error));
    };
*/
  })();
  app.listadoGastos();