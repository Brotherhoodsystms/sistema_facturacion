const app = new (function () {
    // todo: array detalle
    this.arrayDetalle = [];
  
    // todo: cierre caja
    this.cierrecaja_id = document.getElementById("cierrecaja_id");
    this.cierrecaja_serie = document.getElementById("cierrecaja_serie");
    this.cierrecaja_fecha_asignacion = document.getElementById("cierrecaja_fecha_asignacion");
    this.cierrecaja_efectivo_asignacion = document.getElementById("cierrecaja_efectivo_asignacion");
    this.detalleCajas = document.getElementById("detalleCajas");  
    this.selectorUsuario = document.getElementById("selectorUsuario");
    this.selectorSucursal = document.getElementById("selectorSucursal");
  
    this.listadoRegistroCaja = () => {
      fetch("../controllers/cierrecaja/listadoRegistroCaja.php")
      .then((response) => response.json())
      .then((data) => {
          permisos = data.permisosMod;
          data=data.data;
        if (data.length > 0) {
          html = [];
          html+='<table class="table table-bordered text-center" id="example10">';
          html+=' <thead>';
          html+='  <tr>';
          html+='   <th>Sucursal</th>';
          html+='   <th>Fecha</th>';
          html+='   <th>Usuario</th>';
          html+='   <th>Efectivo Asignado</th>';
          html+='  <th style="width: 40px">Opciones</th>';
          html+='  </tr>';
          html+=' </thead>';
          html+=' <tbody id="tbody">';
          data.forEach((element) => {
            html += "<tr>";
            html +=
              "<td><strong>" + element.sucursal_nombre + "</strong></td>";
            html +=
              "<td><strong>" + element.cierrecaja_fecha_asignacion + "</strong></td>";
            html += "<td><strong>" + element.usuario_nombres + "</strong></td>";
            html +=
            "<td><strong>" + element.cierrecaja_efectivo_asignacion + "</strong></td>";
            /*
            html +=
              '<button type="button" style="border-radius: 50%;width: 30px;height: 35px;" data-toggle="modal" data-target="#exampleModalCerrarCaja"  class="btn btn-space btn-primary" title="Editar" onClick="app.cerrarCaja(' +
              element.cajachica_id +","+element.cajachica_usuarioid+","+element.cajachica_valorasignacion+
              ')"><i class= "fa fa-save"></i></button>';
            */
            html +='<td>';
            if (permisos["u"] === "1"){
             html +=
                "<button type='button' style='border-radius: 50%; width: 40px;height: 40px;' class='btn btn-info btn-sm' title='Editar' onClick='app.editar(" +
                element.cierrecaja_id +
                ")'><i class='fas fa-pencil-alt'></i></button>";
            }
            if (permisos["d"] === "1"){
            html +=
              "<button type='button' class='btn btn-danger btn-sm' style=' border-radius: 50%; width: 40x; height: 40px; margin: 0% 1%;' title='Eliminar' onClick='app.eliminar(" +
              element.cierrecaja_id +
              ")'><i class='fa fa-trash'></i></button>";
                }
            html +='</td>';
            html += "</tr>";
          });
          html+='</tbody></table>';
          this.detalleCajas.innerHTML = html;
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
            "iDisplayLength": 5,
            "order":[[0,"desc"]]
              });
              
        } else {
          this.detalleCajas.innerHTML =
            "<tr><td colspan='6'>No hay detalles de cajas</td></tr>";
        }
      })
      .catch((error) => console.error(error));
  
    };
    
    this.guardar = () => {
        if (this.cierrecaja_id.value === "") {
      const form = new FormData(document.getElementById("cierrecajaform"));
          fetch("../controllers/cierrecaja/guardarRegistroCaja.php", {
            method: "POST",
            body: form,
          })
            .then((response) => response.json())
            .then((data) => {
              if (data === true) {
                Swal.fire(
                  "Registrado!",
                  "Nueva caja agregada correctamente!",
                  "success"
                );
                this.listadoRegistroCaja();
                this.limpiarInputs();
                this.listadoRegistroCaja();
              } else  {
                toastr["warning"](
                  "Problemas al guardar la caja!"
                );
              }
            })
            .catch((err) => console.error(err));
        } else {
            const form = new FormData(document.getElementById("cierrecajaform"));
            fetch("../controllers/cierrecaja/actualizarRegistroCaja.php", {
              method: "POST",
              body: form,
            })
              .then((response) => response.json())
              .then((data) => {
                if (data === true) {
                  Swal.fire(
                    "Actualizado!",
                    "Caja actualizada correctamente!",
                    "success"
                  );
                  this.listadoRegistroCaja();
                  this.limpiarInputs();
                  this.listadoRegistroCaja();
                } else  {
                  toastr["warning"](
                    "Problemas al actualizar la caja!"
                  );
                }
              })
              .catch((err) => console.error(err));
        }
    };

    this.validacionInputCajaChica = (formInput) => {
      if (formInput.get("sucursal_id") === null) {
        toastr["warning"]("El sucursal es requerido, debe elegir uno..!");
        document.getElementById("sucursal_id").focus();
        return false;
      } else if (formInput.get("cierrecaja_serie") === "") {
        toastr["warning"]("El campo serie es requirido, debe escribir uno..!");
        this.cajachica_serie.focus();
        return false;
      } else if (formInput.get("cierrecaja_fecha_asignacion") === "") {
        toastr["warning"](
          "El campo fecha es requirido, debe escribir uno..!"
        );
        this.cierrecaja_fecha_asignacion.focus();
        return false;
      } else {
        return true;
      }
    };

    this.editar = (id) => {
      const formId = new FormData();
      formId.append("id", id);
      fetch("../controllers/cierrecaja/obtenerCajaId.php", {
        method: "POST",
        body: formId,
      })
        .then((response) => response.json())
        .then((data) => {
          toastr["info"](
            "Esta en modo de actualizar datos, solo puede modificar un dato..!"
          );
          this.cierrecaja_id.value = data.cierrecaja_id;
          $("#sucursal_id").val(data["sucursal_id"]).trigger("change");
          this.cierrecaja_serie.value = data.cierrecaja_serie;
          $("#tipo_usuario_id").val(data["cierrecaja_usuarioid"]).trigger("change");
          this.cierrecaja_fecha_asignacion.value = data.cierrecaja_fecha_asignacion;
          this.cierrecaja_efectivo_asignacion.value = data.cierrecaja_efectivo_asignacion;
          document.getElementById("cierrecaja_efectivo_asignacion").focus();
        })
        .catch((error) => console.error(error));
    };

    this.eliminar = (id) => {
        const formId = new FormData();
        formId.append("id", id);
        fetch("../controllers/cierrecaja/eliminarCaja.php", {
          method: "POST",
          body: formId,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              Swal.fire(
                "Eliminado!",
                "Caja eliminada correctamente!",
                "success"
              );
              this.listadoRegistroCaja();
            } else {
              Swal.fire(
                "icon: 'error'",
                "title: 'Error'",
                "text: 'No se pudo eliminar la caja'"
              );
              this.listadoRegistroCaja();
            }
          })
          .catch((error) => console.error(error));
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
      this.listarUsuario = () => {
          fetch("../controllers/usuario/listadoUsuario.php")
            .then((response) => response.json())
            .then((data) => {
              html =
                "<select class='form-control' name='tipo_usuario_id' id='tipo_usuario_id' autofocus required >"; //
              html +=
                "<option disabled='selected' selected='selected'>Seleccione</option>";
                permisos = data.permisosMod;
                data=data.data;
              data.forEach((element) => {
                html +=
                  "<option value='" +
                  element.usuario_id +
                  "'>" +
                  element.usuario_nombres +
                  "</option>";
              });
              html += "</select>";
              this.selectorUsuario.innerHTML = html;
            })
            .catch((error) => console.error(error));
        };
    this.serieCajaChica = () => {
      const nombre =
        document.getElementById("sucursal_id").options[
          document.getElementById("sucursal_id").selectedIndex
        ].text;
      this.mostrarSerieCajachica(nombre);
    };
    this.mostrarSerieCajachica = (nombre) => {
      var current = new Date();
      this.cierrecaja_serie.value =
        nombre +
        "-SERIE" +
        current.getMonth() +
        current.getHours() +
        current.getMinutes() +
        "-" +
        current.getSeconds();
    };
    this.limpiarInputs = () => {
      this.cierrecaja_serie.value = "";
      this.cierrecaja_fecha_asignacion.value = "";
      this.cierrecaja_efectivo_asignacion.value = "";
      $("#tipo_usuario_id").val("Seleccione").trigger("change");
      $("#sucursal_id").val("Seleccione").trigger("change");
    };
  })();
  app.listadoRegistroCaja();
  app.listarSucursal();
  app.listarUsuario();
  