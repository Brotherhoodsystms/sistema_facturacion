tablaAccesos = $("#tablaAccesos").DataTable({
  columnDefs: [
    {
      targets: -1,
      data: null,
      defaultContent:
      "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>",
  },
  ],
  language: {
    lengthMenu: "Mostrar _MENU_ registros",
    zeroRecords: "No se encontraron resultados",
    info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
    infoFiltered: "(filtrado de un total de _MAX_ registros)",
    sSearch: "Buscar:",
    oPaginate: {
      sFirst: "Primero",
      sLast: "Último",
      sNext: "Siguiente",
      sPrevious: "Anterior",
    },
    sProcessing: "Procesando...",
  },
});

$("#btnNuevo").click(function () {
  $("#formAccesos").trigger("reset");
  $(".modal-header").css("background-color", "#1cc88a");
  $(".modal-header").css("color", "white");
  $(".modal-title").text("Nuevo Acceso");
  $("#modalCRUD").modal("show");
  id = null;
  opcion = 1; // Alta
});

var fila; // Capturar la fila para editar o borrar el registro

// Botón EDITAR
$(document).on("click", ".btnEditar", function () {
  fila = $(this).closest("tr");
  id = parseInt(fila.find("td:eq(0)").text());
  nombre = fila.find("td:eq(1)").text();
  estatus = fila.find("td:eq(2)").text(); // Obtener el valor del estatus

  // Crear campos de entrada
  var inputNombre =
    "<input type='text' id='editNombre' value='" + nombre + "'>";
  var badgeHtml =
    estatus === "1"
      ? "<div class='text-center'><span class='badge badge-success'>Activo</span></div>"
      : "<div class='text-center'><span class='badge badge-danger'>Inactivo</span></div>";

  // Guardar los valores originales
  fila.data("id", id);
  fila.data("nombre", nombre);
  fila.data("estatus", estatus);

  // Cambiar el contenido de las celdas por los campos de entrada y el badge
  fila.find("td:eq(1)").html(inputNombre);
  fila.find("td:eq(2)").html(badgeHtml);

  // Cambiar el botón Editar por los botones Guardar y Cancelar
  fila
    .find("td:eq(3)")
    .html(
      "<div class='text-center'><div class='btn-group'><button class='btn btn-success btn-sm btnGuardar' style='border-radius: 100%; width: 40px; height: 40px; margin: 0% 1%;'><i class='fas fa-save'></i></button><button class='btn btn-danger btnCancelar' style='border-radius: 100%; width: 40px; height: 40px; margin: 0% 1%;'><i class='fas fa-times'></i></button></div></div>"
    );
});

// Botón BORRAR
$(document).on("click", ".btnBorrar", function () {
  fila = $(this).closest("tr");
  id = parseInt($(this).closest("tr").find("td:eq(0)").text());
  opcion = 3; // Borrar
  var respuesta = confirm(
    "¿Está seguro de eliminar el registro: " + id + "?"
  );
  if (respuesta) {
    $.ajax({
      url: "http://localhost/sistema_facturacion/app/models/crud.php",
      type: "POST",
      dataType: "json",
      data: { opcion: opcion, acceso_id: id },
      success: function () {
        // Eliminar la fila de la tabla y luego redibujar la tabla
        tablaAccesos.row(fila).remove().draw();
      },
    });
  }
});

// Botón GUARDAR
$(document).on("click", ".btnGuardar", function () {
  fila = $(this).closest("tr");
  id = parseInt(fila.find("td:eq(0)").text());
  nombre = $("#editNombre").val();
  estatus = $("#editEstatus").val();

  // Realizar la actualización a través de AJAX
  $.ajax({
    url: "http://localhost/sistema_facturacion/app/models/crud.php",
    type: "POST",
    dataType: "json",
    data: {
      acceso_descripcion: nombre,
      estatus: estatus,
      acceso_id: id,
      opcion: 2,
    },
    success: function (data) {
      console.log(data);
      id = data[0].acceso_id;
      nombre = data[0].acceso_descripcion;
      estatus = data[0].estatus;      

      // Actualizar los datos en la tabla
      tablaAccesos
        .row(fila)
        .data([
          id,
          nombre,
          badgeHtml, // Actualizar la celda con el badge
          "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>",
        ])
        .draw();
    },
  });
});

// Botón CANCELAR
$(document).on("click", ".btnEditar", function () {
  fila = $(this).closest("tr");
  id = parseInt(fila.find("td:eq(0)").text());
  nombre = fila.find("td:eq(1)").text();
  estatus = fila.find("td:eq(2)").text(); // Obtener el valor del estatus

  // Crear campos de entrada
  var inputNombre =
    "<input type='text' id='editNombre' value='" + nombre + "'>";
  var badgeHtml =
    estatus === "1"
      ? "<div class='text-center'><span class='badge badge-success'>Activo</span></div>"
      : "<div class='text-center'><span class='badge badge-danger'>Inactivo</span></div>";

  // Guardar los valores originales
  fila.data("id", id);
  fila.data("nombre", nombre);
  fila.data("estatus", estatus); // Guardar el valor original de estatus

  // Cambiar el contenido de las celdas por los campos de entrada y el badge
  fila.find("td:eq(1)").html(inputNombre);
  fila.find("td:eq(2)").html(badgeHtml);

  // Cambiar el botón Editar por los botones Guardar y Cancelar
  fila
    .find("td:eq(3)")
    .html(
      "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnGuardar' style='border-radius: 100%; width: 40px; height: 40px; margin: 0% 1%;'><i class='fas fa-save'></i></button><button class='btn btn-danger btnCancelar' style='border-radius: 100%; width: 40px; height: 40px; margin: 0% 1%;'><i class='fas fa-times'></i></button></div></div>"
    );
});

$(document).on("click", ".btnCancelar", function () {
  fila = $(this).closest("tr");

  // Restaurar los valores originales
  var id = fila.data("id");
  var nombre = fila.data("nombre");

  // Lógica condicional para el color del badge
  var badgeHtml =
    "<div class='text-center'><span class='badge badge-success'>Activo</span></div>";

  // Restaurar el contenido original
  fila.find("td:eq(0)").text(id);
  fila.find("td:eq(1)").text(nombre);
  fila.find("td:eq(2)").html(badgeHtml); // Mostrar siempre "Activo"

  // Restaurar el botón Editar
  fila
    .find("td:eq(3)")
    .html(
      "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"
    );
});

$("#formAccesos").submit(function (e) {
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
      id = data[0].acceso_id;
      nombre = data[0].acceso_descripcion;
      estatus = data[0].estatus;

      // Actualizar la lógica condicional para el color del badge en la tabla
      var badgeHtmlTabla =
        estatus === "1"
          ? "<div class='text-center'><span class='badge badge-success'>Activo</span></div>"
          : "<div class='text-center'><span class='badge badge-danger'>Inactivo</span></div>";

      if (opcion == 1) {
        tablaAccesos.row.add([id, nombre, badgeHtmlTabla]).draw();
      } else {
        tablaAccesos.row(fila).data([id, nombre, badgeHtmlTabla]).draw();
      }
    },
  });
  $("#modalCRUD").modal("hide");
});

