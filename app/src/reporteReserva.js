const app = new (function () {
  this.reporte_reserva = document.getElementById("reporte_reserva");
  this.reporte_buscar = document.getElementById("reporte_buscar");
  this.reporte_fecha_i = document.getElementById("reporte_fecha_i");
  this.reporte_fecha_f = document.getElementById("reporte_fecha_f");
  this.tbody = document.getElementById("tbody");
  this.listadoReporteReserva = (data = null) => {
    while (this.tbody.hasChildNodes()) {
      this.tbody.removeChild(this.tbody.firstChild);
    }
    if (data !== null) {
      data.forEach((element) => {
        this.tbody.innerHTML += `
            <tr>
                <td>${element.reserva_numero}</td>
                <td>${element.formpago_descripcion}</td>
                <td>${element.cliente_razonsocial} - ${element.cliente_ruc}</td>
                <td>${element.vendedor_dni} - ${element.vendedor_nombres}</td>
                <td>${element.reserva_abono}</td>
                <td>${element.reserva_total}</td>
                
            </tr>
            `;
      });

      // <td><button type='button' class='btn btn-danger btn-sm' title='Pdf' onClick='app.pdf(
      //   ${element.reserva_id})'><i class='fas fa-print'></i></button></td>
    } else {
      fetch("../controllers/reserva/listadoReserva.php")
        .then((res) => res.json())
        .then((data) => {
          data.forEach((element) => {
            this.tbody.innerHTML += `
                <tr>
                   <td>${element.reserva_numero}</td>
                    <td>${element.formpago_descripcion}</td>
                    <td>${element.cliente_razonsocial} - ${element.cliente_ruc}</td>
                    <td>${element.vendedor_dni} - ${element.vendedor_nombres}</td>
                    <td>${element.reserva_abono}</td>
                <td>${element.reserva_total}</td>
                </tr>
                `;
          });
        })
        .catch((err) => console.error(err));
    }
  };
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
      fetch("../controllers/reserva/obtenerReservaFecha.php", {
        method: "POST",
        body: form1,
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.length >= 1) {
            this.listadoReporteReserva(data);
          } else if (data.length == 0) {
            toastr["warning"](
              "No hubo resultados en su busqueda, debe elegir otro..!"
            );
            return this.reporte_fecha_i.focus();
          }
        })
        .catch((err) => console.error(err));
    } else {
      if (this.reporte_buscar.value === "") {
        toastr["warning"](
          "El campo ingrese un dato es requerida, debe escribir uno..!"
        );
        return this.reporte_buscar.focus();
      }
      const form = new FormData();

      form.append("valor", this.reporte_reserva.value);
      form.append("parametro", this.reporte_buscar.value);
      fetch("../controllers/reserva/obtenerReservaParametro.php", {
        method: "POST",
        body: form,
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.length >= 1) {
            this.listadoReporteReserva(data);
          } else if (data.length == 0) {
            toastr["error"](
              "Los campos o filtros no conciden con la busqueda, debe elegir otro..!"
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
    console.log(data);
    var ancho = 1000;
    var alto = 800;
    var x = parseInt(window.screen.width / 2 - ancho / 2);
    var y = parseInt(window.screen.width / 2 - alto / 2);
    if (data.valor === "6") {
      $url =
        "../../app/utils/factura/generarReporteReserva.php?cl=" +
        data.fecha_i +
        "&fi=" +
        data.fecha_f +
        "&f=" +
        data.valor;
    } else {
      $url =
        "../../app/utils/factura/generarReporteReserva.php?cl=" +
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
  };
})();
app.listadoReporteReserva((data = null));
