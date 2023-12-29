const app = new (function () {
  this.rol_id = document.getElementById("rol_id");
  this.nombre_rol = document.getElementById("nombre_rol");
  this.estatus_rol = document.getElementById("estatus_rol");
  //this.descripcion_rol = document.getElementById("descripcion_rol");
  this.roles = document.getElementById("roles");
  this.permisos1 = document.getElementById("permisos1");
  this.listadoRoles = () => {
    fetch("../controllers/rol/mostrarRol.php")
      .then((response) => response.json())
      .then((data) => {
        let html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html += "<th>Id</th>";
        html += "<th>Datos Roles</th>";
        html += "<th>Estatus</th>";
        html += "<th>Acciones</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        permisos = data.permisosMod;
        data = data.data;
        data.forEach((element) => {
          html += "<tr>";
          // Ocultar la columna "Id" en la fila
          html += "<td><strong>" + element.acceso_id + "</strong></td>";

          // Resto del código...

          // Mostrar el valor actual y ocultar el campo de entrada
          html +=
            "<td><span class='edit-field' data-field='nombre' data-id='" +
            element.acceso_id +
            "'>" +
            element.acceso_descripcion +
            "</span><input type='text' class='edit-input' data-field='nombre' data-id='" +
            element.acceso_id +
            "' value='" +
            element.acceso_descripcion +
            "' style='display:none;'></td>";

          // Mostrar el valor actual y ocultar el campo de entrada
          if (element.estatus === "1") {
            html +=
              "<td><span class='badge badge-success'>" +
              "Activo" +
              "</span></td>";
          } else {
            html +=
              "<td><span class='badge badge-danger'>" +
              "Inactivo" +
              "</span></td>";
          }

          html += "<td>";
          if (permisos["u"] === "1") {
            html +=
              "<button type='button' class='btn btn-info btn-sm btnEditar' title='Editar' data-id='" +
              element.acceso_id +
              "' style='border-radius: 50%;width: 40px;height: 40px;margin: 0% 1%;'><i class='fas fa-pencil-alt'></i></button>";

            // Mostrar el botón de permisos solo si no está en modo de edición
            if (!element.editando) {
              html +=
                "<button type='button' class='btn btn-primary btn-sm btnPermisos' title='Permisos' data-toggle='modal' data-target='#exampleModalPermiso' onClick='app.permisos(" +
                element.acceso_id +
                ")' style='border-radius: 50%;width: 40px;height: 40px;margin: 0% 1%;'><i class='fas fa-key'></i></button>";
            }

            html +=
              "<button type='button' class='btn btn-primary btn-sm btnGuardar' title='Guardar' data-id='" +
              element.acceso_id +
              "' style='border-radius: 50%;width: 30px;height: 30px;margin: 0% 1%;display:none;'><i class='fas fa-check'></i></button>";
            html +=
              "<button type='button' class='btn btn-danger btn-sm btnCancelar' title='Cancelar' data-id='" +
              element.acceso_id +
              "' style='border-radius: 50%;width: 30px;height: 30px;margin: 0% 1%;display:none;'><i class='fas fa-times'></i></button>";
          }
          html += "</td>";
          html += "</tr>";
        });
        html += "</tbody></table>";
        this.roles.innerHTML = html;
        $("#btnNuevo").click(function () {
          $("#formAccesos").trigger("reset");
          $(".modal-header").css("background-color", "#1cc88a");
          $(".modal-header").css("color", "white");
          $(".modal-title").text("Nuevo Acceso");
          $("#modalCRUD").modal("show");
          id = null;
          opcion = 1; // Alta
        });
        
        $("#formAccesos").off("submit").on("submit", function (e) {
          e.preventDefault();
          nombre = $.trim($("#nombre").val());
          estatus = $.trim($("#estatus").val());
        
          // Lógica condicional para el color del badge
          var badgeHtml =
            estatus === "1"
              ? "<span class='badge badge-success'>Activo</span>"
              : "<span class='badge badge-danger'>Inactivo</span>";
        
          $.ajax({
            url: "http://localhost/sistema_facturacion/app/models/crud.php",
            type: "POST",
            dataType: "json",
            data: {
              acceso_descripcion: nombre,
              estatus: estatus,
              acceso_id: id,
              opcion: opcion,
            },
            success: function (data) {
              console.log(data);
        
              // Desvincular el evento submit para evitar que se dispare nuevamente
              $("#formAccesos").off("submit");
        
              // Volver a vincular el evento submit después de completar la operación
              $("#formAccesos").on("submit", function (e) {
                // ... (tu lógica original)
              });
        
              // Actualizar la tabla con los nuevos datos
              app.listadoRoles();
            },
            error: function (xhr, status, error) {
              console.error("Error en la llamada AJAX:", xhr, status, error);
            },
          });
        
          $("#modalCRUD").modal("hide");
        });
        
        
        // Asignar eventos de clic a los botones
        $(".btnEditar").on("click", function () {
          const id = $(this).data("id");
          const row = $(this).closest("tr");

          // Ocultar el botón de permisos
          row.find(".btnPermisos").hide();

          row.find(".edit-field[data-id='" + id + "']").hide();
          row.find(".edit-input[data-id='" + id + "']").show();
          row.find(".btnEditar[data-id='" + id + "']").hide();
          row.find(".btnGuardar[data-id='" + id + "']").show();
          row.find(".btnCancelar[data-id='" + id + "']").show();
        });

        $(".btnCancelar").on("click", function () {
          const id = $(this).data("id");
          const row = $(this).closest("tr");

          // Mostrar el botón de permisos
          row.find(".btnPermisos").show();

          row.find(".edit-field[data-id='" + id + "']").show();
          row.find(".edit-input[data-id='" + id + "']").hide();
          row.find(".btnEditar[data-id='" + id + "']").show();
          row.find(".btnPermisos[data-id='" + id + "']").show();
          row.find(".btnGuardar[data-id='" + id + "']").hide();
          row.find(".btnCancelar[data-id='" + id + "']").hide();
        });

        $(".btnGuardar").on("click", function () {
          const id = $(this).data("id");
          const row = $(this).closest("tr");

          // Realizar la actualización a través de AJAX
          $.ajax({
            url: "http://localhost/sistema_facturacion/app/models/crud.php",
            type: "POST",
            dataType: "json",
            data: {
              acceso_descripcion: row
                .find(".edit-input[data-id='" + id + "']")
                .val(),
              estatus: row
                .find(".edit-input[data-field='estatus'][data-id='" + id + "']")
                .val(),
              acceso_id: id,
              opcion: 2,
            },
            success: function (data) {
              console.log(data);

              // Actualizar la tabla con los nuevos datos
              app.listadoRoles(data);
            },
            error: function (xhr, status, error) {
              console.error("Error en la llamada AJAX:", xhr, status, error);
            },
          });

          // Restaurar visibilidad de botones
          row.find(".btnPermisos").show();
          row.find(".btnEditar").show();
          row.find(".btnGuardar").hide();
          row.find(".btnCancelar").hide();
          row.find(".edit-field").show();
          row.find(".edit-input").hide();
        });

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
          },
        });
      })
      .catch((error) => console.error(error));
  };

  this.guardarRol = () => {
    const form = new FormData(document.getElementById("rolform"));
    if (this.validacionInputCategoria(form) === true) {
      if (this.rol_id.value === "") {
        fetch("../controllers/rol/guardarRol.php", {
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
              this.listadoRoles();
              this.limpiarInputs();
              this.listadoRoles();
            } else if (data === 1) {
              toastr["error"]("El nombre Rol ya existe, debe escribir otro..!");
              this.nombre_rol.focus();
            }
          })
          .catch((error) => console.error(error));
      } else {
        fetch("../controllers/rol/actualizarRol.php", {
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
              this.listadoRoles();
              this.limpiarInputs();
              this.listadoRoles();
            } else if (data === 1) {
              toastr["error"]("El nombre Rol ya existe, debe escribir otro..!");
              this.nombre_rol.focus();
            }
          })
          .catch((error) => console.error(error));
      }
    }
  };

  this.editar = function (id_rol) {
    const formId = new FormData();
    formId.append("id_rol", id_rol);

    fetch("../controllers/rol/obtenerRol.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"](
          "Está en modo de actualizar datos, solo puede modificar un dato..!"
        );

        const fila = $(this).closest("tr");
        const id = parseInt(fila.find("td:eq(0)").text(), 10);
        const nombre = fila.find("td:eq(1)").text();
        const estatus = fila.find("td:eq(2)").text();

        // Guardar los valores originales
        fila.data("id", id);
        fila.data("nombre", nombre);
        fila.data("estatus", estatus);

        // Cambiar el contenido de las celdas por campos de edición
        fila
          .find("td:eq(0)")
          .html(`<input type='text' id='editId' value='${id}' readonly>`);
        fila
          .find("td:eq(1)")
          .html(`<input type='text' id='editNombre' value='${nombre}'>`);
        fila
          .find("td:eq(2)")
          .html(`<input type='text' id='editEstatus' value='${estatus}'>`);

        // Cambiar el botón Editar por los botones Guardar y Cancelar
        fila.find("td:eq(3)").html(
          `<div class='text-center'>
                <button class='btn btn-success btnGuardar' onclick='guardarEdicion(${id})'>Guardar</button>
                <button class='btn btn-danger btnCancelar' onclick='cancelarEdicion(${id})'>Cancelar</button>
            </div>`
        );
      })
      .catch((error) => {
        console.error("Error durante la solicitud fetch:", error);
        toastr["error"]("Hubo un error al obtener los datos para editar.");
      });
  };

  this.validacionInputCategoria = (formInput) => {
    if (formInput.get("nombre_rol") === "") {
      toastr["warning"]("El campo nombre  es requirido, debe escribir uno..!");
      this.nombre_rol.focus();
      return false;
    } else {
      return true;
    }
  };
  this.limpiarInputs = () => {
    this.nombre_rol.value = "";
    this.rol_id.value = "";
    this.estatus_rol.value = "";
    this.nombre_rol.focus();
  };
  //lista de permisos por rol_id
  this.permisos = (id_rol) => {
    const formId = new FormData();
    formId.append("id_rol", id_rol);
    fetch("../controllers/rol/obtenerPermisos.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        html =
          "<input type='hidden'  name='id_rol' value='" +
          data.id_rol +
          "'><table class='table table-striped table-bordered first' id='example8'>";
        html += "<thead>";
        html += "<tr>";
        html += "<th>Id</th>";
        html += "<th>Modulo</th>";
        html += "<th>Leer</th>";
        html += "<th>Escribir</th>";
        html += "<th>Editar</th>";
        html += "<th>Eliminar</th>";
        html += "<th>Imprimir</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        i = 1;
        j = 0;
        modulos = data["modulos"];
        //console.log(modulos);
        data["paginas"].forEach((element) => {
          this.rCkek = element.accesos["r"] == 1 ? "checked='checked'" : "";
          this.wCkek = element.accesos["w"] == 1 ? "checked='checked'" : "";
          this.uCkek = element.accesos["u"] == 1 ? "checked='checked'" : "";
          this.dCkek = element.accesos["d"] == 1 ? "checked='checked'" : "";
          this.iCkek = element.accesos["i"] == 1 ? "checked='checked'" : "";
          html += "<tr>";
          html += "<td> <strong>" + i + "</strong></td>";

          html += "<td> <strong>" + element.nombre + "</strong></td>";
          html +=
            "<td> <div class='form-check'><input type='checkbox' name='modulos[" +
            j +
            "][r]' value='" +
            element.accesos["r"] +
            "'" +
            this.rCkek +
            "></div></td>";

          html +=
            "<td> <div class='form-check'><input type='checkbox' name='modulos[" +
            j +
            "][w]' value='" +
            element.accesos["w"] +
            "'" +
            this.wCkek +
            "></div></td>";

          html +=
            "<td> <div class='form-check'><input type='checkbox' name='modulos[" +
            j +
            "][u]' value='" +
            element.accesos["u"] +
            "'" +
            this.uCkek +
            "><input type='hidden' name='modulos[" +
            j +
            "][id_modulo]' value='" +
            element["id_modelo"] +
            "'></div></td>";
          html +=
            "<td> <div class='form-check'><input type='checkbox' name='modulos[" +
            j +
            "][d]' value='" +
            element.accesos["d"] +
            "'" +
            this.dCkek +
            "'></div></td>";
          html +=
            "<td> <div class='form-check'><input type='checkbox' name='modulos[" +
            j +
            "][i]' value='" +
            element.accesos["i"] +
            "'" +
            this.iCkek +
            "'></div></td>";

          i = i + 1;
          j = j + 1;
        });
        html += "</tr></tbody></table>";
        this.permisos1.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  //actualizar permisos por rol actualizarPermisos
  this.actualizarPermisos = () => {
    const form = new FormData(document.getElementById("permisosform"));
    fetch("../controllers/rol/actualizarPermisos.php", {
      method: "POST",
      body: form,
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        if (data === true) {
          Swal.fire(
            "Actualizado!",
            "Los permisos han sido actualizados!",
            "success"
          );
          $("#exampleModalPermiso").modal("hide");
          //this.limpiarInputs();
          this.listadoRoles();
        } else if (data === false) {
          toastr["error"]("No se pudo guardar los permisos.!");
          this.nombre_rol.focus();
        }
      })
      .catch((error) => console.error(error));
  };
})();
app.listadoRoles();
