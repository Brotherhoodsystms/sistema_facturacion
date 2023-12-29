const app = new (function () {
  // todo: array detalle
  this.arrayDetalle = [];
  // todo: acumulador valor dinero
  this.acumuladorDinero = 0.0;
  this.acumuladorDineroReposicion = 0.0;

  // todo: caja chica
  this.cajachica_id = document.getElementById("cajachica_id");
  this.cajachica_serie = document.getElementById("cajachica_serie");
  this.cajachica_area = document.getElementById("cajachica_area");
  this.cajachica_dias = document.getElementById("cajachica_dias");
  this.cajachica_fechaasignacion = document.getElementById(
    "cajachica_fechaasignacion"
  );
  this.cajachica_fechaliquidacion = document.getElementById(
    "cajachica_fechaliquidacion"
  );
  this.cajachica_dineroasignacion = document.getElementById(
    "cajachica_dineroasignacion"
  );
  this.cajachica_dineroasignacion_a = document.getElementById(
    "cajachica_dineroasignacion_a"
  );
  this.dineroasignacion_o = document.getElementById("dineroasignacion_o");
  this.cajachica_dineroegreso = document.getElementById(
    "cajachica_dineroegreso"
  );
  this.cajachica_dineroreposicion = document.getElementById(
    "cajachica_dineroreposicion"
  );

  // todo: detalle de caja chica
  this.detacajachica_id = document.getElementById("detacajachica_id");
  this.detacajachicanumero = document.getElementById("detacajachicanumero");
  this.detacajachicavalor = document.getElementById("detacajachicavalor");
  this.detacajachicadescripcion = document.getElementById(
    "detacajachicadescripcion"
  );

  this.tbody = document.getElementById("tbody");
  this.selectorSucursal = document.getElementById("selectorSucursal");
  this.selectorCosto = document.getElementById("selectorCosto");
  this.selectorComprobante = document.getElementById("selectorComprobante");

  this.listadoDetalleCajaChica = (data) => {
    while (this.tbody.hasChildNodes()) {
      this.tbody.removeChild(this.tbody.firstChild);
    }
    if (data !== undefined) {
      data.forEach((element) => {
        tbody.innerHTML += `
            <tr>
                <td>${element.comprobanteDescripcion}</td>
                <td>${element.numero}</td>
                <td>${element.descripcion}</td>
                <td>${element.gastoDescripcion}</td>
                <td>${element.valor}</td>
            </tr>
            `;
      });
    } else {
      tbody.innerHTML += `
            <tr>
                <td colspan="5" align="center">No datos</td>
            </tr>
        `;
    }
  };
  this.guardar = () => {
    const formCajaChica = new FormData(
      document.getElementById("cajachicaform")
    );
    const formDetalleCajaChica = new FormData(
      document.getElementById("detacajachicaform")
    );
    if (this.validacionInputCajaChica(formCajaChica) === true) {
      if (this.validacionInputDetalleCajaChica(formDetalleCajaChica) === true) {
        if (
          parseFloat(this.cajachica_dineroasignacion.value) >=
          parseFloat(this.detacajachicavalor.value)
        ) {
          const obj = {
            comprobanteid: document.getElementById("comprobante_id").value,
            comprobanteDescripcion:
              document.getElementById("comprobante_id").options[
                document.getElementById("comprobante_id").selectedIndex
              ].text,
            gastoid: document.getElementById("gasto_id").value,
            gastoDescripcion:
              document.getElementById("gasto_id").options[
                document.getElementById("gasto_id").selectedIndex
              ].text,
            numero: this.detacajachicanumero.value,
            valor: this.detacajachicavalor.value,
            descripcion: this.detacajachicadescripcion.value,
          };
          this.acumuladorDinero += parseFloat(this.detacajachicavalor.value);
          this.arrayDetalle.push(obj);
          this.limpiarInputs();
          this.listadoDetalleCajaChica(this.arrayDetalle);
          this.cajachica_dineroegreso.value = this.acumuladorDinero;
          //if (parseFloat(this.cajachica_dineroreposicion.value) !== 0) {
          this.cajachica_dineroreposicion.value =
            parseFloat(this.cajachica_dineroasignacion_a.value) -
            parseFloat(this.cajachica_dineroegreso.value);
          //}
        } else {
          toastr["error"](
            "El campo valor dinero es superior al del dinero asignado, debe escribir otro..!"
          );
          this.detacajachicavalor.focus();
        }
      }
    }
  };
  this.guardarDetalleCaja = () => {
    if (this.arrayDetalle.length !== 0) {
      console.log(typeof this.arrayDetalle);
      const form = new FormData();
      form.append("detalleCaja", this.arrayDetalle);
      fetch("../controllers/cajachica/guardarCajachica.php", {
        method: "POST",
        body: form,
      })
        .then((response) => response.text())
        .then((data) => {
          console.log(data);
        })
        .catch((error) => console.error(error));
    } else {
      toastr["error"](
        "No hay detalle en la caja chica, debe llenar un detalle..!"
      );
    }
  };
  this.validacionInputDetalleCajaChica = (formInput) => {
    if (formInput.get("comprobante_id") === null) {
      toastr["warning"]("El comprobante es requerido, debe elegir uno..!");
      document.getElementById("comprobante_id").focus();
      return false;
    } else if (formInput.get("gasto_id") === null) {
      toastr["warning"]("El gasto es requerido, debe elegir uno..!");
      document.getElementById("gasto_id").focus();
      return false;
    } else if (formInput.get("detacajachicanumero") === "") {
      toastr["warning"]("El campo número es requirido, debe escribir uno..!");
      this.detacajachicanumero.focus();
      return false;
    } else if (formInput.get("detacajachicavalor") === "") {
      toastr["warning"]("El campo valor es requirido, debe escribir uno..!");
      this.detacajachicavalor.focus();
      return false;
    } else if (formInput.get("detacajachicadescripcion") === "") {
      toastr["warning"](
        "El campo descripción es requirido, debe escribir uno..!"
      );
      this.detacajachicadescripcion.focus();
      return false;
    } else {
      return true;
    }
  };
  this.validacionInputCajaChica = (formInput) => {
    if (formInput.get("sucursal_id") === null) {
      toastr["warning"]("El sucursal es requerido, debe elegir uno..!");
      document.getElementById("sucursal_id").focus();
      return false;
    } else if (formInput.get("cajachica_serie") === "") {
      toastr["warning"]("El campo serie es requirido, debe escribir uno..!");
      this.cajachica_serie.focus();
      return false;
    } else if (formInput.get("cajachica_area") === "") {
      toastr["warning"]("El campo area es requirido, debe escribir uno..!");
      this.cajachica_area.focus();
      return false;
    } else if (formInput.get("cajachica_fechaasignacion") === "") {
      toastr["warning"](
        "El campo fecha asignación es requirido, debe escribir uno..!"
      );
      this.cajachica_fechaasignacion.focus();
      return false;
    } else if (formInput.get("cajachica_fechaliquidacion") === "") {
      toastr["warning"](
        "El campo fecha liquidación es requirido, debe escribir uno..!"
      );
      this.cajachica_fechaliquidacion.focus();
      return false;
    } else if (formInput.get("cajachica_dineroasignacion") === "") {
      toastr["warning"](
        "El campo dinero asignación es requirido, debe escribir uno..!"
      );
      this.cajachica_dineroasignacion.focus();
      return false;
    } else {
      return true;
    }
  };
  this.listarSucursal = () => {
    fetch("../controllers/sucursal/listadoSucursal.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='sucursal_id' id='sucursal_id' autofocus required >";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.sucursal_id +
            "'>" +
            element.sucursal_provincia +
            " - " +
            element.sucursal_nombre +
            "</option>";
        });
        html += "</select>";
        this.selectorSucursal.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };

  this.listarCosto = () => {
    fetch("../controllers/costo/mostrarCosto.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='gasto_id' id='gasto_id' autofocus required>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.gastos_id +
            "'>" +
            element.gastos_descripcion +
            "</option>";
        });
        html += "</select>";
        this.selectorCosto.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  this.listarComprobante = () => {
    fetch("../controllers/comprobante/listadoComprobante.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='comprobante_id' id='comprobante_id' autofocus required>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.comprobante_id +
            "'>" +
            element.comprobante_descripcion +
            "</option>";
        });
        html += "</select>";
        this.selectorComprobante.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };

  this.editar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/cajachica/obtenerCajachica.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"](
          "Esta en modo de actualizar datos, solo puede modificar un dato..!"
        );
        this.cajachica_id.value = data.cajachica_id;
        this.cajachica_valor.value = data.cajachica_valor;
        this.cajachica_motivogasto.value = data.cajachica_motivogasto;
        $("#gasto_id").val(data["gasto_id"]).trigger("change");
        document.getElementById("gasto_id").focus();
      })
      .catch((error) => console.error(error));
  };
  this.limpiarInputs = () => {
    this.cajachica_id.value = "";
    this.cajachica_valor.value = "";
    this.cajachica_motivogasto.value = "";
    $("#sucursal_id").val("Seleccione").trigger("change");
    document.getElementById("gasto_id").focus();
  };
  this.serieCajaChica = () => {
    const nombre =
      document.getElementById("sucursal_id").options[
        document.getElementById("sucursal_id").selectedIndex
      ].text;
    this.mostrarSerieCajachica(nombre);
  };
  this.mostrarSerieCajachica = (nombre) => {
    var current = new Date();
    this.cajachica_serie.value =
      nombre +
      "-SERIE" +
      current.getMonth() +
      current.getHours() +
      current.getMinutes() +
      "-" +
      current.getSeconds();
  };
  this.restarDiasFechaCajachica = () => {
    const dia1 = new Date(this.cajachica_fechaasignacion.value);
    const dia2 = new Date(this.cajachica_fechaliquidacion.value);
    const direfencia = Math.abs(dia1 - dia2);
    const dias = direfencia / (1000 * 3600 * 24);
    this.cajachica_dias.value = dias;
  };
  this.asignarDinero = () => {
    if (this.cajachica_dineroasignacion.value === "0.00") {
      this.cajachica_dineroasignacion.value = parseFloat(
        this.cajachica_dineroasignacion_a.value
      );
    } else if (this.cajachica_dineroasignacion.value !== "0.00") {
      this.cajachica_dineroasignacion.value =
        parseFloat(this.cajachica_dineroasignacion.value) +
        parseFloat(this.cajachica_dineroasignacion_a.value);

      this.cajachica_dineroreposicion.value =
        parseFloat(this.cajachica_dineroasignacion.value) -
        parseFloat(this.cajachica_dineroegreso.value);
    }
  };
  this.limpiarInputs = () => {
    this.detacajachica_id.value = "";
    this.detacajachicanumero.value = "";
    this.detacajachicavalor.value = "";
    this.detacajachicadescripcion.value = "";
    $("#comprobante_id").val("Seleccione").trigger("change");
    $("#gasto_id").val("Seleccione").trigger("change");
    document.getElementById("comprobante_id").focus();
  };
})();
app.listadoDetalleCajaChica();
app.listarSucursal();
app.listarCosto();
app.listarComprobante();
