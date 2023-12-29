const app = new (function () {
    this.reporte_buscar = document.getElementById("reporte_buscar");
    this.reporte_fecha_i = document.getElementById("reporte_fecha_i");
    this.reporte_fecha_f = document.getElementById("reporte_fecha_f");
    this.tbody = document.getElementById("tbody");
    //todo::listas
    this.reporteBuscar = () => {
      if (this.reporte_buscar.value === "") {
        toastr["warning"](
          "La cédula del cliente es requerida, debe elegir uno..!"
        );
        return this.reporte_buscar.focus();
      }
      if (this.reporte_buscar.value !== "") {
        if (this.reporte_fecha_i.value === "") {
          toastr["warning"](
            "El campo fecha inicio es requerida, debe escribir uno..!"
          );
          return this.reporte_fecha_i.focus();
        }
        if (this.reporte_fecha_f.value === "") {
          toastr["warning"](
            "El campo fecha final es requerida, debe escribir uno..!"
          );
          return this.reporte_fecha_f.focus();
        }
        const form1 = new FormData();
        form1.append("valor", this.reporte_buscar.value);
        form1.append("fecha_i", this.reporte_fecha_i.value);
        form1.append("fecha_f", this.reporte_fecha_f.value);
        fetch("../controllers/reporte/obtenerProductosVentas.php",{
        method: "POST",
        body: form1,
      })
          .then((response) => response.json())
          .then((data) => {
            html =
              "<table class='table table-striped table-bordered first' id='example1' style='border-radius:1%'>";
            html += "<thead>";
            html += "<tr>";
            html+="<th>Factura</th>";
            html+="<th>Fecha Compra</th>";
            html+="<th>Código Producto</th>";
            html+="<th>Descripción</th>";
            html+="<th>Cantidad</th>";
            html+="<th>Total</th>";
            html+="<th>Opciones</th>";
            html += "</tr>";
            html += "</thead>";
            html += "<tbody>";
            data.forEach((element) => {
              html += "<tr>";
                html += "<td>" +element.factura_id +"</td>";
                html += "<td>" +element.detafatc_fecha_i +"</td>";
                html +=
                "<td><center><img src='../../public/images/serial.png' alt='logo box' width='30px'><br/><strong>" +
                element.producto_codigoserial +
                "</strong></center></td>";
                html += "<td>" +element.producto_descripcion +"</td>";
                html += "<td>" +element.detafact_cantidad +"</td>";
                html += "<td>" +element.detafact_total +"</td>";
                //console.log(producto_fechaelaboracion);
                html +=
                "<td><button type='button' style='border-radius: 50%; width: 40px;height: 40px;' class='btn btn-info btn-sm' title='Ver Factura' onClick='app.imprimir(" +
                element.factura_id +
                ")'><i class='fas fa-eye'></i></button></td>";
            });
              this.tbody.innerHTML = html;
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
                }
              },'dom': 'lBfrtip',
              'buttons': [
                 {
                      "extend": "excelHtml5",
                      "text": "<i class='fas fa-file-excel'></i> Excel",
                      "titleAttr":"Exportar a Excel",
                      "title": "Listado de Productos",
                      "className": "btn btn-success",
                  },{
                      "extend": "pdfHtml5",
                      "text": "<i class='fas fa-file-pdf'></i> PDF",
                      orientation: 'landscape',//todo::cambiar horzontal
                      "title": "Listado de Productos",
                      "titleAttr":"Exportar a PDF",
                      "className": "btn btn-danger",
                      "style":"border-radius:5%"
                  }
              ],
              "resonsieve":"true",
              "bDestroy": true,
              "iDisplayLength": 10,
              "order":[[0,"desc"]]
                });
          })
          .catch((error) => console.error(error));
      }
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
    this.generearPDF = (data) => {
      //console.log(data);
      var ancho = 1000;
      var alto = 800;
      var x = parseInt(window.screen.width / 2 - ancho / 2);
      var y = parseInt(window.screen.width / 2 - alto / 2);
      if (data.valor === "6") {
        $url =
          "../../app/utils/factura/generarReporteFacturaVentas.php?cl=" +
          data.fecha_i +
          "&fi=" +
          data.fecha_f +
          "&f=" +
          data.valor;
      } else {
        $url =
          "../../app/utils/factura/generarReporteFacturaVentas.php?cl=" +
          data.parametro +
          "&f=" +
          data.valor;
      }

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
    this.generearEXCEL = (data) => {
      var downloadLink;
      var dataType = 'text/csv;charset=utf-8';
      var tableSelect = document.getElementById("example1");
      var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
      var filename ='Listado de Facturas';
      filename = filename?filename+'.xls':'excel_data.xls';
      // Create download link element
      downloadLink = document.createElement("a");
      document.body.appendChild(downloadLink);
      if(navigator.msSaveOrOpenBlob){
          var blob = new Blob(['\ufeff', tableHTML], {
              type: dataType
          });
          navigator.msSaveOrOpenBlob( blob, filename);
      }else{
          // Create a link to the file
          downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
          // Setting the file name
          downloadLink.download = filename;
          //triggering the function
          downloadLink.click();
      }
    };
  })();