const app = new (function () {
    
    
    this.movimientoid=document.getElementById("movimientoid");
    this.movimiento_fecha=document.getElementById("movimiento_fecha");
    this.movimiento_descripcion=document.getElementById("movimiento_descripcion");
    this.movimiento_total=document.getElementById("movimiento_total");
    this.tipo_movimiento=document.getElementById("tipo_movimiento");
    this.selectorSucursal=document.getElementById("selectorSucursal");
    this.listadoMovimientoCaja=document.getElementById("listadoMovimientoCaja");
    

    this.listadoMovimientos = () => {
      fetch("../controllers/cierrecaja/listadoMovimientoCaja.php")
        .then((response) => response.json())
        .then((data) => {
          html =
            "<table class='table table-striped table-bordered first' id='example1'>";
          html += "<thead>";
          html += "<tr>";
          html += "<th>Sucursal</th><th>Usuario</th><th>Fecha</th><th>Tipo Movimiento</th><th>Descripcion</th><th>Total</th><th>Opciones</th>";
          html += "</tr>";
          html += "</thead>";
          html += "<tbody>";
          permisos = data.permisosMod;
          data=data.data;
          data.forEach((element) => {
            html += "<tr>";
            html +=
              "<td><strong>" + element.sucursal_nombre + "</strong></td>";
            html +=
              "<td><strong>" + element.usuario_nombres + "</strong></td>";
            html +=
              "<td><strong>" + element.movimiento_fecha + "</strong></td>";
              html +=
              "<td><strong>" + element.movimiento_tipo + "</strong></td>";
            html +=
              "<td><strong> " +
              element.movimiento_descripcion +"</td>";
              if (element.movimiento_tipo.toUpperCase() === "ENTRADA") {
                html +=
                  "<td><span class='badge badge-success'>" +
                  element.movimiento_total +
                  "</span></td>"; 
              } else if (element.movimiento_tipo.toUpperCase() === "SALIDA") {
                html +=
                  "<td><span class='badge badge-danger'>" +
                  element.movimiento_total +
                  "</span></td>";
              }
            html += "<td>";
              if (permisos["u"] === "1"){
                html +=
                "<button type='button' style='border-radius: 50%; width: 40px;height: 40px; margin: 0% 2%;' class='btn btn-info btn-sm' title='Editar' onClick='app.editar(" +
                element.movimiento_id +
                ")'><i class='fas fa-pencil-alt'></i></button>";
              }
              if (permisos["d"] === "1"){
                html +=
                  "<button type='button' class='btn btn-danger btn-sm' style=' border-radius: 50%; width: 40x; height: 40px; margin: 0% 1%;' title='Eliminar' onClick='app.eliminar(" +
                  element.movimiento_id +
                  ")'><i class='fa fa-trash'></i></button>";
              }
              html += "</td>";
              html +=
              "</tr>";
          });
            this.listadoMovimientoCaja.innerHTML = html;
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

    this.guardar = () => {
      const form = new FormData(document.getElementById("movimientoFrom"));
      if (this.validacionInputMovimiento(form) === true) {
        if (this.movimientoid.value === "") {
          fetch("../controllers/cierrecaja/guardarMovimientoCaja.php", {
            method: "POST",
            body: form,
          })
            .then((response) => response.json())
            .then((data) => {
              if (data === true) {
                Swal.fire(
                  "Registrado!",
                  "Su movimiento se guardo correctamente!",
                  "success"
                );
                this.listadoMovimientos();
                this.limpiarInputs();
                this.listadoMovimientos();
              }
            })
            .catch((error) => console.error(error));
        } else {
          fetch("../controllers/cierrecaja/actualizarMovimientoCaja.php", {
            method: "POST",
            body: form,
          })
            .then((response) => response.json())
            .then((data) => {
              if (data === true) {
                Swal.fire(
                  "Registrado!",
                  "Su movimiento de efectivo se actualizo correctamente!",
                  "success"
                );
                this.listadoMovimientos();
                this.limpiarInputs();
                this.listadoMovimientos();
              } else if (data === 1) {
                toastr["error"](
                  "No se puede actualizar el movimiento efectivo..!"
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
      fetch("../controllers/cierrecaja/obtenerMovimientoId.php", {
        method: "POST",
        body: formId,
      })
        .then((response) => response.json())
        .then((data) => {
          toastr["info"](
            "Esta en modo de actualizar datos, solo puede modificar un dato..!"
          );
          this.movimientoid.value = data.movimiento_id;
          $("#sucursal_id").val(data["sucursal_id"]).trigger("change");
          $("#tipo_movimiento").val(data["movimiento_tipo"]).trigger("change");
          this.movimiento_descripcion.value = data.movimiento_descripcion;
          this.movimiento_total.value = data.movimiento_total;
          this.movimiento_descripcion.focus();
        })
        .catch((error) => console.error(error));
    };
    this.eliminar = (id) => {
      const formId = new FormData();
      formId.append("id", id);
      Swal.fire({
        title: "¿Esta seguro de eliminar este movimiento de efectivo?",
        text: "Se eliminará por completo de los registro..!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
      }).then((result) => {
        if (result.isConfirmed) {
          fetch("../controllers/cierrecaja/eliminarMovimiento.php", {
            method: "POST",
            body: formId,
          })
            .then((response) => response.json())
            .then((data) => {
              if (data === true) {
                Swal.fire("Eliminado!", "Movimiento efectivo eliminado.", "success");
                this.listadoMovimientos();
              }else{
                toastr["info"](
                    "No se puede eliminar el registro..!"
                  );
              }
            })
            .catch((error) => console.error(error));
        }else{
            this.listadoMovimientos();
        }
      });
    };
    this.validacionInputMovimiento = (formInput) => {
      if (formInput.get("movimiento_descripcion") === "") {
        toastr["warning"]("El nombre es requerido, debe escribir uno..!");
        document.getElementById("gastos_descripcion").focus();
        return false;
      } else if (formInput.get("movimiento_total") === "") {
        toastr["warning"]("El telefono es requerido, debe escribir uno..!");
        document.getElementById("gastos_total").focus();
        return false;
      } else if (formInput.get("tipo_movimiento") === "") {
        toastr["warning"]("El telefono es requerido, debe escribir uno..!");
        document.getElementById("tipo_movimiento").focus();
        return false;
       } else {
        return true;
      }
    };
    this.limpiarInputs = () => {
      this.movimientoid.value = "";
      this.movimiento_descripcion.value = "";
      this.movimiento_total.value = "";
      $("#sucursal_id").val("Seleccione").trigger("change");
      $("#tipo_movimiento").val("Selected").trigger("change");
    };
    this.listarSucursal = () => {
        fetch("../controllers/sucursal/listadoSucursal.php")
          .then((response) => response.json())
          .then((data) => {
            html =
              "<select class='form-control' name='sucursal_id' id='sucursal_id' autofocus required >";
            html +=
              "<option disabled='selected' selected='selected'>Seleccione</option>";
            data.forEach((element) => {
              html +=
                "<option value='" +
                element.sucursal_id +
                "'>" +
                element.sucursal_provincia +
                " - " +
                element.sucursal_nombre +
                "</option>";
            });
            html += "</select>";
            this.selectorSucursal.innerHTML = html;
          })
          .catch((error) => console.error(error));
      };
  })();
  app.listadoMovimientos();
  app.listarSucursal();
  