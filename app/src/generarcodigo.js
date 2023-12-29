const app = new (function () {
  this.codigo_serial = document.getElementById("codigo_serial");
  this.tipo_codigo = document.getElementById("tipo_codigo");
  this.codigoNuevo = document.getElementById("codigoNuevo");
  this.button = document.createElement("input");
  this.container = document.getElementById("botonImprimir");
  this.generar = () => {
    if (this.codigo_serial.value === "") {
      toastr["warning"](
        "El campo código o serial es requerido, debe escribir uno..!"
      );
      this.codigo_serial.focus();
    } else if (this.tipo_codigo.value === "0") {
      toastr["warning"](
        "El campo tipo código es requerido, debe elegir uno..!"
      );
      this.tipo_codigo.focus();
    } else {
      JsBarcode("#codigoNuevo", this.codigo_serial.value, {
        format: this.tipo_codigo.value,
        displayValue: true,
      });
      this.button.type = "button";
      this.button.id = "imprimir";
      this.button.value = "imprimir";
      this.button.className = "btn btn-success btn-sm";
      this.container.appendChild(this.button);
    }
    this.imprimir = () => {
      data=codigo_serial.value;
      /*document.getElementById("codigoform").style.display = "none";
      document.getElementById("titulocardheader").style.display = "none";
      document.getElementById("imprimir").style.display = "none";
      window.print();
      window.location.href = "../views/generarcodigo.php";*/
      var ancho = 100;
      var alto = 100;
      var x = parseInt(window.screen.width / 2 - ancho / 2);
      var y = parseInt(window.screen.width / 2 - alto / 2);
      $url = "../../app/utils/factura/generarCodigoBarras.php?cl=1" + "&f=" + data;
      window.open(
        $url,
        "CodigoBarras",
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
    this.limpiarInputs = () => {
      this.codigo_serial.value = "";
      this.tipo_codigo.value = "";
      this.codigo_serial.focus();
      this.container.removeChild(this.button);
    };
  };
})();
