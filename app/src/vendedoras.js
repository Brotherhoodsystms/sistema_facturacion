const app = new (function () {
  //todo::datos para ingreso de vendedor registro
  this.registro_idvendedor = document.getElementById("registro_idvendedor");
  this.vendedoras_nombre = document.getElementById("vendedoras_nombre");
  this.vendedoras_contacto = document.getElementById("vendedoras_contacto");
  this.vendedoras_telefono = document.getElementById("vendedoras_telefono");
  this.vendedoras_telefono2 = document.getElementById("vendedoras_telefono2");
  this.vendedoras_correo = document.getElementById("vendedoras_correo");
  this.vendedora_sector = document.getElementById("vendedora_sector");
  this.vendedoras_estatus = document.getElementById("vendedoras_estatus");
  this.vendedora_horainicion = document.getElementById("vendedora_horainicion");
  this.vendedor_direccion = document.getElementById("vendedor_direccion");
  this.vendedoras_detalle = document.getElementById("vendedoras_detalle");
  this.vendedoras_coordenadas = document.getElementById(
    "vendedoras_coordenadas"
  );
  this.vendedoras_observacion = document.getElementById(
    "vendedoras_observacion"
  );
  this.vendedores = document.getElementById("vendedores");
  this.listadoVendedores = () => {
    fetch("../controllers/vendedoras/listadoVendedoras.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<thead>";
        html += "<tr>";
        html +=
          "<th>Id</th><th>Fecha</th><th>Nombre Cliente</th><th>Contacto</th><th>Vendedor</th><th>Sector</th><th>Dirección</th><th>Hora Inicio</th><th>Hora Final</th><th>Telefono</th><th>Observacion</th><th>Coordenadas</th><th>Estatus</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        data.forEach((element) => {
          html += "<tr>";
          html += "<td>" + element.vendedoras_id + "</td>";
          html += "<td>" + element.vendedoras_fecha.toUpperCase() + "</td>";
          html += "<td>" + element.vendedoras_nombres.toUpperCase() + "</td>";
          html += "<td>" + element.vendedoras_contacto.toUpperCase() + "</td>";
          html += "<td>" + element.usuario_nombres.toUpperCase() + "</td>";
          html += "<td>" + element.vendedoras_sector.toUpperCase() + "</td>";
          html += "<td>" + element.vendedoras_direccion.toUpperCase() + "</td>";
          html +=
            "<td>" + element.vendedora_hora_inicio.toUpperCase() + "</td>";
          html += "<td>" + element.vendedoras_fechaI.toUpperCase() + "</td>";
          html += "<td>" + element.vendedoras_telefono.toUpperCase() + "</td>";
          html +=
            "<td>" + element.vendedoras_observacion.toUpperCase() + "</td>";
          html +=
            "<td>" + element.vendedoras_coordenadas.toUpperCase() + "</td>";
          html +=
            "<td>" + element.vendedoras_estatus.toUpperCase() + "</td></tr>";
        });
        this.vendedores.innerHTML = html;
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
                  "title": "Listado de Reporte vendedoras",
                  "className": "btn btn-success",
              },{
                  "extend": "pdfHtml5",
                  "text": "<i class='fas fa-file-pdf'></i> PDF",
                  orientation: 'landscape',//todo::cambiar horzontal
                  "title": "Listado de Reporte vendedoras",
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

  this.guardar = () => {
    const form = new FormData(document.getElementById("vendedorRegistroform"));
    if (this.validacionInputBodega(form) === true) {
      fetch("../controllers/vendedoras/guardarReporteVendedores.php", {
        method: "POST",
        body: form,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data === true) {
            Swal.fire(
              "Registrado!",
              "Su información se guardo correctamente!",
              "success"
            );
            this.listadoVendedores();
            this.limpiarInputs();
            this.listadoVendedores();
          } else if (data === 1) {
            toastr["error"](
              "Ese nombre de esa registo ya existe, debe escribir otro..!"
            );
            this.vendedoras_nombres.focus();
          }
        })
        .catch((error) => console.error(error));
    }
  };

  this.editar = (id) => {
    const formId = new FormData();
    formId.append("id", id);
    fetch("../controllers/bodega/obtenerBodega.php", {
      method: "POST",
      body: formId,
    })
      .then((response) => response.json())
      .then((data) => {
        toastr["info"](
          "Esta en modo de actualizar datos, solo puede modificar un dato..!"
        );
        this.bodega_id.value = data.bodega_id;
        this.bodega_descripcion.value = data.bodega_descripcion;
        $("#sucursal_id").val(data["sucursal_id"]).trigger("change");
        $("#tipobodega_id").val(data["tipobodega_id"]).trigger("change");
        document.getElementById("sucursal_id").focus();
      })
      .catch((error) => console.error(error));
  };

  this.validacionInputBodega = (formInput) => {
    if (formInput.get("vendedoras_nombre") === "") {
      toastr["warning"](
        "El nombre del cliente es requerido, debe escribir uno..!"
      );
      document.getElementById("vendedoras_nombre").focus();
      return false;
    } else if (formInput.get("vendedoras_telefono") === "") {
      toastr["warning"]("El telefono es requerido , debe escribir uno..!");
      document.getElementById("vendedoras_telefono").focus();
      return false;
    } else if (formInput.get("vendedora_sector") === "") {
      toastr["warning"]("El sector es requerido , debe escribir uno..!");
      //this.vendedora_sector.focus();
      document.getElementById("vendedora_sector").focus();

      return false;
    } else if (formInput.get("vendedoras_estatus") === null) {
      toastr["warning"]("El estatus es requerido , debe escribir uno..!");
      this.vendedoras_estatus.focus();
      //document.getElementById("vendedoras_estatus").focus();

      return false;
    } else {
      return true;
    }
  };

  this.listarTipoSucursal = () => {
    fetch("../controllers/sucursal/listadoSucursal.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<select class='form-control' name='sucursal_id' id='sucursal_id' autofocus required>";
        html +=
          "<option disabled='selected' selected='selected'>Seleccione</option>";
        data.forEach((element) => {
          html +=
            "<option value='" +
            element.sucursal_id +
            "'>" +
            element.sucursal_provincia +
            " - " +
            element.sucursal_nombre;
          ("</option>");
        });
        html += "</select>";
        this.sucursal.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };

  this.obtenerGPS = () => {
    geoFindMe();
  };

  this.limpiarInputs = () => {
    this.vendedoras_nombre.value = "";
    this.vendedoras_contacto.value = "";
    this.vendedoras_telefono.value = "";
    this.vendedora_sector.value = "";
    this.vendedora_horainicion.value = "";
    this.vendedoras_observacion.value = "";
    this.vendedor_direccion.value = "";
    this.vendedoras_coordenadas.value = "";
    $("#vendedoras_estatus").val("selected").trigger("change");
    document.getElementById("vendedoras_nombre").focus();
    // document.getElementById("sucursal_id").removeAttribute("disabled");
  };
  //todos::controles de tipo de bodega
  this.ocultarDiv = () => {
    $("#div_descripcion").hide();
  };
  this.guardarT = () => {
    const form = new FormData(document.getElementById("tipobodegaform"));
    if (this.validacionInputTipoBodega(form) === true) {
      if (this.tipobodega_id.value === "") {
        fetch("../controllers/tipobodega/guardarTipobodega.php", {
          method: "POST",
          body: form,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              Swal.fire(
                "Registrado!",
                "Su información se guardo correctamente!",
                "success"
              );
              this.limpiarInputs();
            } else if (data === 0) {
              toastr["error"](
                "Esa capacidad ya existe en esa especificación, debe escribir otro..!"
              );
              this.tipobodega_capacidad.focus();
            }
          })
          .catch((error) => console.error(error));
      } else {
        fetch("../controllers/tipobodega/actualizarTipobodega.php", {
          method: "POST",
          body: form,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              Swal.fire(
                "Registrado!",
                "Su información se actualizo correctamente!",
                "success"
              );
              this.limpiarInputs();
              this.listadoTipoBodega();
            } else if (data === 0) {
              toastr["error"](
                "Esa información ya existe, debe escribir otro..!"
              );
              this.tipobodega_capacidad.focus();
            }
          })
          .catch((error) => console.error(error));
      }
    }
  };

  this.validacionInputTipoBodega = (formInput) => {
    if (formInput.get("tipobodega_especificacion") === "") {
      toastr["warning"](
        "El campo especificación es requirido, debe escribir uno..!"
      );
      this.tipobodega_especificacion.focus();
      return false;
    } else if (formInput.get("tipobodega_capacidad") === "") {
      toastr["warning"](
        "El campo capcacidad es requirido, debe escribir uno..!"
      );
      this.tipobodega_capacidad.focus();
      return false;
    } else {
      return true;
    }
  };
  function geoFindMe() {
    const status = document.querySelector("#status");
    const mapLink = document.querySelector("#vendedoras_coordenadas");

    mapLink.href = "";
    mapLink.textContent = "";

    function success(position) {
      const latitude = position.coords.latitude;
      const longitude = position.coords.longitude;

      status.textContent = "";
      mapLink.href = `https://www.openstreetmap.org/#map=18/${latitude}/${longitude}`;
      mapLink.value = `${latitude},${longitude}`;
    }

    function error() {
      status.textContent = "No se puede obtener tu ubicación";
    }

    if (!navigator.geolocation) {
      status.textContent =
        "El geolocalizacion no es soportado en su dispositivo";
    } else {
      status.textContent = "Localisando";
      navigator.geolocation.getCurrentPosition(success, error);
    }
  }
})();
app.listadoVendedores();
