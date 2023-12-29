const app = new (function () {
  this.facturaA = document.getElementById("facturaA");

  this.listadoFacturaA = () => {
    fetch("../controllers/factura/listadoFacturaA.php")
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
          html +="<th>Clave de Acceso</th>";
          html +="<th>Base IVA 12</th>";
          html +="<th>IVA 12%</th>";
          html +="<th>BaseIVA 0</th>";
          html +="<th>Estado</th>";
          html +="<th>Opciones</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        permisos = data.permisosMod;
        datos = data.data;
        datos.forEach((element) => {
          html += "<tr>";
          html += "<td>" + element.factura_id + "</td>";
          html += "<td>" + element.factura_serie + "</td>";
          html += "<td>" + element.factura_fechagenerada + "</td>";
          html += "<td>" + element.factura_total + "</td>";
          html += "<td>" + element.formpago_descripcion + "</td>";
          html += "<td>" + element.cliente_razonsocial + "</td>";
          html += "<td>" + element.cliente_ruc  + "</td>";
          html +="<td>"+element.cliente_email +"</td>";
          if(element.factura_clave == null){
            html +="<td><p>"+"Factura sin autorizar"+"</p> </td>";
          }else{
            html +=
            "<td><p>"+element.factura_clave+"</p> </td>";
          }
            html +=
            "<td>"+element.factura_subtotal +"</td>";
            html +=
            "<td>"+element.factura_iva +"</td>";
          if(element.factura_base0 == null){
            html+=
            "<td>"+ "0.00" +"</td>";
          }else{
            html +=
            "<td>"+element.factura_base0 +"</td>";
          }
          if (element.factura_estado.toUpperCase() === "A") {
            estado_factura = "CREADO";
            html +=
              "<td><span class='badge badge-info'>" +
              estado_factura +
              "</span></td>";
          } else if (element.factura_estado.toUpperCase() === "F") {
            estado_factura = "AUTORIZADO";
            html +=
              "<td><span class='badge badge-success'>" +
              estado_factura +
              "</span></td>";
          } else if (element.factura_estado.toUpperCase() === "D") {
            estado_factura = "DEVUELTA";
            html +=
              "<td><span class='badge badge-warning'>" +
              estado_factura +
              "</span></td>";
          } else if (element.factura_estado.toUpperCase() === "X") {
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
          if (permisos["w"] === "1" && element.factura_estado.toUpperCase() === "A") {
            html +=
              "<button type='button' class='btn btn-info btn-sm' title='SRI' style='border-radius: 50%; width: 40px; height: 40px; margin: 2% 2%;' onClick='app.firmarEnviar(" +
              element.factura_id +
              ")'>SRI</button>";
          } else if (permisos["u"] === "1" && element.factura_estado.toUpperCase() === "D") {
            html +=
              "<button type='button' class='btn btn-info btn-sm' title='SRI' style='border-radius: 50%; width: 40px; height: 40px; margin: 2% 2%;' onClick='app.firmarEnviar(" +
              element.factura_id +
              ")'>SRI</button>";
              html += "<button type='button' class='btn btn-danger btn-sm' title='Anular' style='border-radius: 50%; width: 40px; height: 40px; margin: 2% 2%;' onClick='app.anularFactura(" +
              element.factura_id +
              ")'><i class='fas fa-times'></i></button>";
          } else if (permisos["d"] === "1" && element.factura_estado.toUpperCase() === "F") {
            
              html += "<button type='button' class='btn btn-danger btn-sm' title='Anular' style='border-radius: 50%; width: 40px; height: 40px; margin: 2% 2%;' onClick='app.anularFactura(" +
              element.factura_id +
              ")'><i class='fas fa-times'></i></button>";
          } 
          if (permisos["i"] === "1") {
            html +=
              "<button type='button' class='btn btn-primary btn-sm' title='Imprimir' style='border-radius: 50%; width: 40px; height: 40px; margin: 2% 2%;' onClick='app.imprimir(" +
              element.factura_id +
              ")'><i class='fas fa-print'></i></button>";
          }
          if (permisos["i"] === "1") {
            html +=
              "<button type='button' class='btn btn-success btn-sm' title='Enviar Correo' style='border-radius: 50%; width: 40px; height: 40px; margin: 2% 2%;' onClick='app.enviarCorreo(" +
              element.factura_id +
              ")'><i class='fas fa-envelope'></i></button>";
          }
          html += "</td>";
          html += "</tr>";
        });
        html +=
          "</tr></tbody></table>";
        this.facturaA.innerHTML = html;
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
  this.imprimir = (id) => {
    const formId = new FormData();
    //this.generearPDF(id); /*
    formId.append("id", id);
    fetch("../controllers/factura/obtenerCodigoFactura.php", {
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

          window.open($url, "Factura", "width=1000,height=800,scrollbars=NO");
        } else {
          Swal.fire("ERROR!", "El archivo pdf no existe", "warning");
        }
      })
      .catch((error) => console.error(error));
  };
  //enviar correo llamado de los datos desde la tabla para realizar dinamicamente
  this.enviarCorreo = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    formId.append("name", "email_notificacion_orden");
    formId.append("asunto", "Nuevo Comprobante Electronico");
    formId.append("email", "javierlobitort@gmail.com");
    fetch("../controllers/factura/enviarCorreo.php", {
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
  this.email=(name, email,mesaje)=>{
    Email.send({
    Host : "smtp.elasticemail.com",
    Username : "javierlobitort@gmail.com",
    Password : "3B333D9C89514ED0CBA7129F171DEC509D49",
    To : "javierlobitort@gmail.com",
    From : "javierlobitort@gmail.com",
    Subject : "Factura Electronica",
    Body : "And this is the body"
}).then(
  message => alert(message)
);
  };
  this.generearPDF = (data) => {
    var ancho = 1000;
    var alto = 800;
    var x = parseInt(window.screen.width / 2 - ancho / 2);
    var y = parseInt(window.screen.width / 2 - alto / 2);
    $url = "../../app/utils/factura/factura_175.pdf";

    window.open($url, "Factura", "width=1000,height=800,scrollbars=NO");
  };
  this.firmarEnviar = (id) => {
    console.log(id);
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/factura/firmarEnviar.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.estado === true) {
          Swal.fire(
            "Factura Autorizada!",
            "Enviada al correo electronico correctamente!",
            "success"
          );
          location.href = "../views/facturaA.php";
        } else {
          Swal.fire("ERROR!", data.mensaje, "warning");
          //location.href = "../views/facturaA.php";
        }
      })
      .catch((error) => console.error(error));
  };
  this.anularFactura = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/factura/anularFactura.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data === true) {
          Swal.fire(
            "Factura Anulada!",
            "Debe anular su factura en el Sistema de SRI!",
            "success"
          );
          app.listadoFacturaA();
        } else {
          Swal.fire("ERROR!", data.mensaje, "warning");
        }
      })
      .catch((error) => console.error(error));
  };
})();
app.listadoFacturaA();
