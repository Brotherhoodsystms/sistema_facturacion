const app = new (function () {
    this.proformasL=document.getElementById("proformasL");
this.listadoProformas = () => {
    fetch("../controllers/proforma/listadoProformas.php")
      .then((response) => response.json())
      .then((data) => {
        //generar columnas de la tabla
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html +="<th>Id</th>";
        html +="<th>Secuencial</th>";
        html +="<th>Fecha</th>";
        html +="<th>Total</th>";
        html +="<th>Forma de Pago</th>";
          html +="<th>Nombre Cliente</th>";
          html +="<th>CI/RUC Cliente</th>";
          html +="<th>Correo Cliente</th>";
          html +="<th>Estado</th>";
          html +="<th>Opciones</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        permisos = data.permisosMod;
        datos = data.data;
        datos.forEach((element) => {
          html += "<tr>";
          html += "<td>" + element.proforma_id  + "</td>";
          html += "<td>" + element.proforma_serie + "</td>";
          html += "<td>" + element.proforma_fechagenerada + "</td>";
          html += "<td>" + element.proforma_total + "</td>";
          html += "<td>" + element.formpago_descripcion + "</td>";
          html += "<td>" + element.cliente_razonsocial + "</td>";
          html += "<td>" + element.cliente_ruc  + "</td>";
          html +="<td>"+element.cliente_email +"</td>";
          if (element.proforma_estado.toUpperCase() === "A") {
            estado_factura = "CREADO";
            html +=
              "<td><span class='badge badge-info'>" +
              estado_factura +
              "</span></td>";
          } else if (element.proforma_estado.toUpperCase() === "F") {
            estado_factura = "AUTORIZADO";
            html +=
              "<td><span class='badge badge-success'>" +
              estado_factura +
              "</span></td>";
          } else if (element.proforma_estado.toUpperCase() === "D") {
            estado_factura = "DEVUELTA";
            html +=
              "<td><span class='badge badge-warning'>" +
              estado_factura +
              "</span></td>";
          } else if (element.proforma_estado.toUpperCase() === "X") {
            estado_factura = "ANULADA";
            html +=
              "<td><span class='badge badge-danger'>" +
              estado_factura +
              "</span></td>";
          }else{
            estado_factura = "ERROR";
            html +=
              "<td><span class='badge badge-danger'>" +
              estado_factura +
              "</span></td>";
          }
          html += "<td>";
          if (permisos["i"] === "1") {
            html +=
              "<button type='button' class='btn btn-primary btn-sm' title='Imprimir' style='border-radius: 50%; width: 40px; height: 40px; margin: 2% 2%;' onClick='app.imprimir(" +
              element.proforma_id +
              ")'><i class='fas fa-print'></i></button>";
          }
          if (permisos["i"] === "1") {
            html +=
              "<button type='button' class='btn btn-success btn-sm' title='Enviar Correo' style='border-radius: 50%; width: 40px; height: 40px; margin: 2% 2%;' onClick='app.enviarCorreo(" +
              element.proforma_id +
              ")'><i class='fas fa-envelope'></i></button>";
          }
          html += "</td>";
        });
        
        this.proformasL.innerHTML = html;
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
                  "title": "Listado de Proformas",
                  "className": "btn btn-success",
              },{
                  "extend": "pdfHtml5",
                  "text": "<i class='fas fa-file-pdf'></i> PDF",
                  orientation: 'landscape',//todo::cambiar horzontal
                  "title": "Listado de Proformas",
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
  this.imprimir = (id) => {
    const formId = new FormData();
    //this.generearPDF(id); /*
    formId.append("id", id);
    fetch("../controllers/proforma/obtenerCodigoFactura.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data) {
          var ancho = 1000;
          var alto = 800;
          var x = parseInt(window.screen.width / 2 - ancho / 2);
          var y = parseInt(window.screen.width / 2 - alto / 2);
          $url = data;

          window.open($url, "Proforma", "width=1000,height=800,scrollbars=NO");
          location.href = "../views/proformaL.php";
        } else {
          Swal.fire("ERROR!", "El archivo pdf no existe", "warning");
        }
      })
      .catch((error) => console.error(error));
  };
  //todo::correo cambiar la manera en la que se envia la nota de venta y la reserva
  this.enviarCorreo = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    formId.append("name", "email_notificacion_proforma");
    formId.append("asunto", "Proforma");
    formId.append("email", "javierlobitort@gmail.com");
    fetch("../controllers/factura/enviarCorreoN.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        if(data==true){
        toastr["info"]("El correo se a enviado correctamente");
      }
      })
      .catch((error) => console.error(error));
  };
})();

app.listadoProformas();