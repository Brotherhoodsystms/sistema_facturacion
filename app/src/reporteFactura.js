const app = new (function () {
  this.reporte_reserva = document.getElementById("reporte_factura");
  this.reporte_buscar = document.getElementById("reporte_buscar");
  this.reporte_fecha_i = document.getElementById("reporte_fecha_i");
  this.reporte_fecha_f = document.getElementById("reporte_fecha_f");
  this.tbody = document.getElementById("tbody");
  this.selectorComprobante=document.getElementById("selectorComprobante");
  this.selectorEmisor=document.getElementById("selectorEmisor");
  this.tbody = document.getElementById("tbody");
  this.listadoReporteReserva = (data = null) => {
      while (this.tbody.hasChildNodes()) {
        this.tbody.removeChild(this.tbody.firstChild);
      }
      if (data !== null) {
        var data1=data.busqueda;
        html =
        "<table class='table table-striped table-bordered first' id='example1'>";
      html += "<thead>";
      html += "<tr>";
      html += "<th>ID</th>";
      html += "<th>Emisor</th>";
        html += "<th>Secuencial Factura</th>";
        html += "<th>Fecha Generada</th>";
        html += "<th>Forma de pago</th>";
        html += "<th>Cliente</th>";
        html += "<th>Identificación</th>";
        html += "<th>Clave</th>";
        html += "<th>Base12%</th>";
        html += "<th>Porcentaje 12%</th>";
        html += "<th>Base0%</th>";
        html += "<th>Subtotal</th>";
        html += "<th>Total</th>";
      html += "</tr>";
      html += "</thead>";
      html += "<tbody>";
      data1.forEach((element) => {
        html += "<tr>";
        html += "<td>"+element.factura_id+"</td>";
        html += "<td>"+element.nombreComercial+"</td>";
        html += "<td>"+element.factura_serie+"</td>";
        html += "<td>"+element.factura_fechagenerada+"</td>";
         html += "<td>"+element.formpago_descripcion+"</td>";
         html += "<td>"+element.cliente_razonsocial+"</td>";
         html += "<td>"+element.cliente_ruc+"</td>";
         if(element.factura_clave === null){
          html += "<td>"+"Sin autorizar"+"</td>";
        }else{
          html += "<td>"+element.factura_clave+"</td>";
        }
        if(element.factura_base12 === null){
          html += "<td>"+""+"</td>";
        }else{
          html += "<td>"+element.factura_base12+"</td>";
        }
        if(element.factura_iva12 === null){
          html += "<td>"+""+"</td>";
        }else{
          html += "<td>"+element.factura_iva12+"</td>";
        }
        if(element.factura_base0 === null){
          html += "<td>"+""+"</td>";
        }else{
          html += "<td>"+element.factura_base0+"</td>";
        }
         html += "<td>"+element.factura_subtotal+"</td>";
         html += "<td>"+element.factura_total+"</td>";
        });
       var total=data.totales;
       html +=
       "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>Total</td><td>"+total.base12+"</td><td>"+total.iva12+"</td><td>"+total.base0+"</td><td></td><td>"+total.total+"</td></tr></tbody></table>";
     this.tbody.innerHTML = html;
     app.exportaciones();
      } else {
        fetch("../controllers/reporte/listadoFacturaReporte.php")
          .then((res) => res.json())
          .then((data) => {
            var data1=data.busqueda;
            html =
        "<table class='table table-striped table-bordered first' id='example1'>";
      html += "<thead>";
      html += "<tr>";
      html += "<th>ID</th>";
      html += "<th>Emisor</th>";
        html += "<th>Secuencial Factura</th>";
        html += "<th>Fecha Generada</th>";
        html += "<th>Forma de pago</th>";
        html += "<th>Cliente</th>";
        html += "<th>Identificación</th>";
        html += "<th>Clave</th>";
        html += "<th>Base12%</th>";
        html += "<th>Porcentaje 12%</th>";
        html += "<th>Base0%</th>";
        html += "<th>Subtotal</th>";
        html += "<th>Total</th>";
      html += "</tr>";
      html += "</thead>";
      html += "<tbody>";
            var data1=data.data;
          data1.forEach((element) => {
            html += "<tr>";
            html += "<td>"+element.factura_id+"</td>";
            html += "<td>"+element.nombreComercial+"</td>";
            html += "<td>"+element.factura_serie+"</td>";
            html += "<td>"+element.factura_fechagenerada+"</td>";
             html += "<td>"+element.formpago_descripcion+"</td>";
             html += "<td>"+element.cliente_razonsocial+"</td>";
             html += "<td>"+element.cliente_ruc+"</td>";
            if(element.factura_clave === null){
              html += "<td>"+"Sin autorizar"+"</td>";
            }else{
              html += "<td>"+element.factura_clave+"</td>";
            }
            if(element.factura_base12 === null){
              html += "<td>"+""+"</td>";
            }else{
              html += "<td>"+element.factura_base12+"</td>";
            }
            if(element.factura_iva12 === null){
              html += "<td>"+""+"</td>";
            }else{
              html += "<td>"+element.factura_iva12+"</td>";
            }
            if(element.factura_base0 === null){
              html += "<td>"+""+"</td>";
            }else{
              html += "<td>"+element.factura_base0+"</td>";
            }
             html += "<td>"+element.factura_subtotal+"</td>";
             html += "<td>"+element.factura_total+"</td>";
            });
           var total=data.totales;
           html +=
           "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>Total</td><td>"+total.base12+"</td><td>"+total.iva12+"</td><td>"+total.base0+"</td><td></td><td>"+total.total+"</td></tr></tbody></table>";
         this.tbody.innerHTML = html;
          app.exportaciones(data.usuario);
        });
      }
    };
    this.exportaciones=(data)=>{
        $("#example1").DataTable({
            searching: true,
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
            },'dom': 'lBfrtip',
            'buttons': [
               {
                    "extend": "excelHtml5",
                    "text": "<i class='fas fa-file-excel'></i> Excel",
                    "titleAttr":"Esportar a Excel",
                    "title": "Reporte de Facturas",
                    "className": "btn btn-success",
                },{
                    "extend": "pdfHtml5",
                    "text": "<i class='fas fa-file-pdf'></i> PDF",
                    orientation: 'landscape',//todo::cambiar horzontal
                    messageTop: 'Usuario:'+data+' Fecha:'+ Date(),
                    "title": "Reporte de Facturas",
                    "titleAttr":"Esportar a PDF",
                    "className": "btn btn-danger"
                }
            ],
            "resonsieve":"true",
            "bDestroy": true,
            "iDisplayLength": 10,
            "order":[[0,"desc"]]
              });
    }
  this.reporteBuscar = () => {
      if (this.reporte_reserva.value === "0") {
        toastr["warning"](
          "La opcion del reporte es requerida, debe elegir uno..!"
        );
        return this.reporte_reserva.focus();
      }
      if (this.reporte_reserva.value === "6") {
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
        form1.append("valor", this.reporte_reserva.value);
        form1.append("fecha_i", this.reporte_fecha_i.value);
        form1.append("fecha_f", this.reporte_fecha_f.value);
        var sucursal=document.getElementById("emisor_establecimiento");
          form1.append("sucursal",sucursal.value);
        fetch("../controllers/reporte/obtenerFacturaFecha.php", {
          method: "POST",
          body: form1,
        })
          .then((res) => res.json())
          .then((data) => {
            console.log(data);
              var data1=data.busqueda;
            if (data1.length >= 1) {
              this.listadoReporteReserva(data);
            } else if (data1.length == 0) {
              toastr["warning"](
                "No hubo resultados en su busqueda, debe elegir otro..!"
              );
              return this.reporte_fecha_i.focus();
            }
          })
          .catch((err) => console.error(err));
      } else {
        const form = new FormData();
        form.append("valor", this.reporte_reserva.value);
        switch(this.reporte_reserva.value){
            case '2':
                if (this.reporte_buscar.value === "") {
                toastr["warning"](
                  "El campo ingrese un dato es requerida, debe escribir uno..!"
                );
                return this.reporte_buscar.focus();
              }
              form.append("parametro", this.reporte_buscar.value);
              var sucursal=document.getElementById("emisor_establecimiento");
              form.append("sucursal",sucursal.value);
                break;
                case '4':
                if (this.reporte_buscar.value === "") {
                toastr["warning"](
                  "El campo ingrese un dato es requerida, debe escribir uno..!"
                );
                return this.reporte_buscar.focus();
              }
              form.append("parametro", this.reporte_buscar.value);
              var sucursal=document.getElementById("emisor_establecimiento");
              form.append("sucursal",sucursal.value);
                break;
            case'9':
                var sucursal=document.getElementById("emisor_establecimiento");
                form.append("sucursal", sucursal.value);
                break;
            case '8':
                  var comprobante_id=document.getElementById("comprobante_id");
                 form.append("parametro", comprobante_id.value);
                 var sucursal=document.getElementById("emisor_establecimiento");
                form.append("sucursal", sucursal.value);
                break;
        }
        fetch("../controllers/reporte/obtenerFacturaParametro.php", {
          method: "POST",
          body: form,
        })
          .then((res) => res.json())
          .then((data) => {
            var data1=data.busqueda;
            if (data1.length >= 1) {
              this.listadoReporteReserva(data);
            } else if (data1.length == 0) {
              toastr["error"](
                "Los campos o filtros no se encuentra en la busqueda, debe elegir otro..!"
              );
              return this.reporte_reserva.focus();
            }
          })
          .catch((err) => console.error(err));
      }
    };
  this.generarPdf = () => {
    const form = [];
    if (this.reporte_reserva.value === "6") {
      form["fecha_f"] = this.reporte_fecha_i.value;
      form["fecha_i"] = this.reporte_fecha_f.value;
      form["valor"] = this.reporte_reserva.value;
    } else {
      form["valor"] = this.reporte_reserva.value;
      form["parametro"] = this.reporte_buscar.value;
    }

  this.generearPDF(form);
  };
  this.generearPDF = (data) => {
    //console.log(data);
    var ancho = 1000;
    var alto = 800;
    var x = parseInt(window.screen.width / 2 - ancho / 2);
    var y = parseInt(window.screen.width / 2 - alto / 2);
    if (data.valor === "6") {
      $url =
        "../../app/utils/factura/generarReporteFactura.php?cl=" +
        data.fecha_i +
        "&fi=" +
        data.fecha_f +
        "&f=" +
        data.valor;
    } else {
      $url =
        "../../app/utils/factura/generarReporteFactura.php?cl=" +
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
  this.generarExcel=()=>{
    const form = [];
    if (this.reporte_reserva.value === "6") {
      form["fecha_f"] = this.reporte_fecha_i.value;
      form["fecha_i"] = this.reporte_fecha_f.value;
      form["valor"] = this.reporte_reserva.value;
    } else {
      form["valor"] = this.reporte_reserva.value;
      form["parametro"] = this.reporte_buscar.value;
    }

    this.generearEXCEL(form);
  };
  this.generearEXCEL = (data) => {
    var downloadLink;
    var dataType = 'text/csv;charset=utf-8';
    var tableSelect = document.getElementById("example1");
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    var filename ='Listado de Productos por ubicación';
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
  this.seleccionFecha = () => {
      if (this.reporte_reserva.value === "6") {
        document.getElementById("reporte_buscar").setAttribute("readonly", true);
        document.getElementById("reporte_fecha_i").removeAttribute("readonly");
        document.getElementById("reporte_fecha_f").removeAttribute("readonly");
      } else {
        document.getElementById("reporte_fecha_i").setAttribute("readonly", true);
        document.getElementById("reporte_fecha_f").setAttribute("readonly", true);
        document.getElementById("reporte_buscar").removeAttribute("readonly");
      }
      switch (this.reporte_reserva.value) {
        case '7':
            $("#div_listaforma").show();
            $("#div_parametro").hide();
            $("#div_listatipop").hide();
            $('#div_listarEmi').hide();
            app.listarFormaPago();
            document.getElementById("reporte_buscar").setAttribute("readonly", true);
          break;
        case '8':
            $("#div_listatipop").show();
        $("#div_listaforma").hide();
        $("#div_parametro").hide();
        $('#div_listarEmi').show();
        document.getElementById("reporte_buscar").setAttribute("readonly", true);
        app.listarComprobante();
        break;
        case '9':
          $("#div_listatipop").hide();
          $("#div_listaforma").hide();
          $("#div_parametro").hide();
          $('#div_listarEmi').show();
          document.getElementById("reporte_buscar").setAttribute("readonly", true);
        app.listarEmisores();
          break;
        default:
            $("#div_listatipop").hide();
            $("#div_listaforma").hide();
            $("#div_parametro").show();
      }
    };
  this.listarComprobante = () => {
    fetch("../controllers/ubicacion/listadoUbicacionR.php")
    .then((response) => response.json())
    .then((data) => {
      html =
        "<select class='form-control' name='comprobante_id' id='comprobante_id' autofocus required>";
      html +=
        "<option disabled='selected' selected='selected'>Seleccione</option>";
      data.forEach((element) => {
        html +=
          "<option value='" +
          element.ubicacion_id +
          "'>" +
          element.ubicacion_descripcion +
          "</option>";
      });
      html += "</select>";
      this.selectorComprobante.innerHTML = html;
    })
    .catch((error) => console.error(error));
    };
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
          this.selectorEmisor.innerHTML = html;
        })
        .catch((error) => console.error(error));
    };
    this.ocultarinput = ()=>{
      $("#div_listaforma").hide();
      $("#div_listatipop").hide();
      //$("#div_listarEmi").hide();
    };
})();
app.ocultarinput();
app.listarEmisores();
app.listadoReporteReserva((data = null));