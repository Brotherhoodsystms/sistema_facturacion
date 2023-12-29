const app = new (function () {
  this.notadeventa = document.getElementById("notadeventa");

  this.listadoNotaventa = () => {
    fetch("../controllers/notaventa/listarNotaventas.php")
      .then((response) => response.json())
      .then((data) => {
        //generar columnas de la tabla
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html += "<th>Id</th>";
        html += "<th>Fecha</th>";
          html+= "<th>Serie</th>";
          html+= "<th>Cliente</th>";
          html+= "<th>Identificacion</th>";
          html+="<th>Forma de Pago</th>";
          html+="<th>Total</th>";
          html+="<th>Estado</th>";
          html+="<th>Opciones</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        permisos = data.permisosMod;
        data=data.data;
        data.forEach((element) => {
          html += "<tr>";
          html += "<td><center>" + element.notaventa_id.toUpperCase() + "</td>";
          html += "<td><center>" + element.notaventa_fechagenerada + "</td>";
          html += "<td><center>" + element.notaventa_serie + "</td>";
          html += "<td><center>" + element.cliente_razonsocial.toUpperCase() + "</td>";
          html += "<td><center>" + element.cliente_ruc.toUpperCase() + "</td>";
          html += "<td><center>" + element.formpago_descripcion.toUpperCase() + "</td>";
          html += "<td><center>" + element.notaventa_total + "</td>";
          if (element.notaventa_estado.toUpperCase() === "A") {
            estado_factura = "CREADO";
            html +=
              "<td><span class='badge badge-info'>" +
              estado_factura +
              "</span></td>";
          }
          html += "<td>";
          if (permisos["i"] === "1") {
          html +=
            "<button type='button' class='btn btn-success btn-sm' title='Enviar' style='border-radius: 50%; width: 40px; height: 40px; margin: 2% 2%;' onClick='app.enviarCorreo(" +
            element.notaventa_id +
            ")'><i class='fas fa-envelope'></i></button><button type='button' class='btn btn-primary btn-sm' title='Imprimir' style='border-radius: 50%; width: 40px; height: 40px;' onClick='app.imprimir(" +
            element.notaventa_id +
            ")'><i class='fas fa-print'></i></button>";
          }
          html += "</td>";
        });
        html +=
          "</tr></tbody></table>";
        this.notadeventa.innerHTML = html;
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
                  "title": "Listado de Comprobante de Salida",
                  "className": "btn btn-success",
              },{
                  "extend": "pdfHtml5",
                  "text": "<i class='fas fa-file-pdf'></i> PDF",
                  orientation: 'landscape',//todo::cambiar horzontal
                  "title": "Listado de Comprobante de Salida",
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
  //todo::imprimir pdf de reserva
  this.imprimir = (id) => {
    const formId = new FormData();
    this.generearPDF(id);
    formId.append("id", id);
    fetch("../controllers/reserva/generarPdf.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data === true) {
          this.listadoReserva();
        }
      })
      .catch((error) => console.error(error));
  };
  this.generearPDF = (data) => {
    var ancho = 1000;
    var alto = 800;
    var x = parseInt(window.screen.width / 2 - ancho / 2);
    var y = parseInt(window.screen.width / 2 - alto / 2);
    $url = "../../app/utils/factura/generarNotaventa.php?cl=1" + "&f=" + data;
    window.open(
      $url,
      "Factura",
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
  //enviar correo llamado de los datos desde la tabla para realizar dinamicamente
  this.enviarCorreo = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    formId.append("name", "email_notificacion_notaVenta");
    formId.append("asunto", "Nuevo Comprobante Electronico");
    //se va a eliminar el campo email ya que esta en modo estatico debemos crear una funcion para enviar
    //el correo de forma actomatica  tanto en la nota de venta como en la factura pendiente
    formId.append("email", "javierlobitort@gmail.com");
    fetch("../controllers/factura/enviarCorreoN.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"]("El correo se a enviado correctamente");
      })
      .catch((error) => console.error(error));
  };
})();
app.listadoNotaventa();
