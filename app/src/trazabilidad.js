const app = new (function () {
  this.tipobodega_capacidad = document.getElementById("tipobodega_capacidad");
  this.tipobodega = document.getElementById("tipobodega");

  this.productos4 = document.getElementById("productos4");
  this.listaTrazabilidad = () => {
    fetch("../controllers/trazabilidad/listadoTrazabilidad.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html +=
          "<th>ID</th><th>Transacción</th><th>Código producto</th><th>Cantidad</th><th>Origen</th><th>Destino</th><th>Usuario</th><th>Fecha</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        data.forEach((element) => {
          html += "<tr>";
          html += "<td><center></center>" + element.historial_id + "</td>";

          html +=
            "<td>" + element.historial_tipo_proceso + "</strong></center></td>";

          html += "<td>" + element.producto_codigoserial + "</span></td>";
          if (element.historial_accion === "EGRESO DE PRODUCTOS") {
            html +=
              "<td><span class='badge badge-danger'>-" +
              element.tem_ubica_cantidad +
              "</span></td>";
          } else if (element.historial_accion === "INGRESO DE PRODUCTOS") {
            html +=
              "<td><span class='badge badge-success'>+" +
              element.tem_ubica_cantidad +
              "</span></td>";
          } else if (element.historial_accion === "INGRESO A BODEGA") {
            html +=
              "<td><span class='badge badge-success'>+" +
              element.tem_ubica_cantidad +
              "</span></td>";
          } else {
            html +=
              "<td><span class='badge badge-danger'>-" +
              element.tem_ubica_cantidad +
              "</span></td>";
          }
          html +=
            "<td>" +
            element.origen +
            "/<br>" +
            element.temp_ubica_descripciono +
            "</td>";
          html +=
            "<td>" +
            element.destino +
            "/<br>" +
            element.tem_ubica_descripcion +
            "</td>";
          html += "<td>" + element.usuario_nombres + "</td>";
          html += "<td>" + element.historial_fecha + "</td>";

         /* html +=
            "<td><button type='button' class='btn btn-primary btn-sm' title='Aumentar stock' onClick='app.aumentarStock(" +
            element.historial_id +
            ")'><i class='fas fa-cubes'></i></button></button></td>";*/
        });
        //")'><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-success btn-sm' title='Ubicacion' onClick='app.ubicacion(" +
        //  element.producto_id +
        this.productos4.innerHTML = html;
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
                  "title": "Trazabilidad",
                  "className": "btn btn-success",
              },{
                  "extend": "pdfHtml5",
                  "text": "<i class='fas fa-file-pdf'></i> PDF",
                  orientation: 'landscape',//todo::cambiar horzontal
                  "title": "Listado de Trazabilidad",
                  "titleAttr":"Esportar a PDF",
                  "className": "btn btn-danger"
              }
          ],
          "responsieve":"true",
          "bDestroy": true,
          "iDisplayLength": 10,
          "order":[[0,"desc"]]
            });
      })
      .catch((error) => console.error(error));
  };
})();
app.listaTrazabilidad();
// app.lectorCodigoProducto();
