const app = new (function () {
  this.facturas = document.getElementById("facturas");
  this.total_vendido = document.getElementById("total_vendido");
  this.clientes4 = document.getElementById("clientes4");
  this.productos = document.getElementById("productos");
  this.reservas = document.getElementById("reservas");
  this.nota_venta = document.getElementById("nota_venta");
  this.gastos = document.getElementById("gastos");
  this.compras = document.getElementById("compras");
  this.utilidad = document.getElementById("utilidad");
  this.ssisfinanciero = document.getElementById("ssisfinanciero");
  this.csisfinanciero = document.getElementById("csisfinanciero");
  this.cpdsisfinanciero = document.getElementById("cpdsisfinanciero");
  this.tardebitofinaciero = document.getElementById("tardebitofinaciero");
  this.tarcreditofinaciero = document.getElementById("tarcreditofinaciero");



  this.totalFacuras = () => {
    fetch("../controllers/dashboard/totalFacturas.php")
      .then((response) => response.json())
      .then((data) => {
        //permisos = data.permisosMod;

        html = "";
        html +=
          "<h4>Facturas</h4>" +
          "<p>" +
          "<b>" +
          data.total_facturas +
          "</b>" +
          "</p>";
        this.facturas.innerHTML = html;
        html = "";
        html +=
          "<h4>Reservas</h4>" +
          "<p>" +
          "<b>" +
          data.total_reserva +
          "</b>" +
          "</p>";
        this.reservas.innerHTML = html;
        html = "";
        html +=
          "<h4>Comprobante de Salida</h4>" +
          "<p>" +
          "<b>" +
          data.total_notaVenta +
          "</b>" +
          "</p>";
        this.nota_venta.innerHTML = html;

      })
      .catch((error) => console.error(error));
  };
  this.utilidadMesCompras = () => {
    fetch("../controllers/dashboard/totalFacturas.php")
      .then((response) => response.json())
      .then((data) => {
        //permisos = data.permisosMod;
        html = "";
        html +=
          "<h4>Compras Mes</h4>" +
          "<p>" +
          "<b>" +
          data.total_compras +
          "</b>" +
          "</p>";
        this.compras.innerHTML = html;

      })
      .catch((error) => console.error(error));
  };
  /*this.totalFacuras = () => {
    fetch("../controllers/dashboard/totalFacturas.php")
      .then((response) => response.json())
      .then((data) => {
        //permisos = data.permisosMod;

        html = "";
        html +=
          "<h4>Facturas</h4>" +
          "<p>" +
          "<b>" +
          data.total_facturas +
          "</b>" +
          "</p>";
        this.facturas.innerHTML = html;
        html = "";
        html +=
          "<h4>Reservas</h4>" +
          "<p>" +
          "<b>" +
          data.total_reserva +
          "</b>" +
          "</p>";
        this.reservas.innerHTML = html;
        html = "";
        html +=
          "<h4>Nota Venta</h4>" +
          "<p>" +
          "<b>" +
          data.total_notaVenta +
          "</b>" +
          "</p>";
        this.nota_venta.innerHTML = html;
        html = "";
        html +=
          "<h4>Compras Mes</h4>" +
          "<p>" +
          "<b>" +
          data.total_compras +
          "</b>" +
          "</p>";
        this.compras.innerHTML = html;
        html = "";
        html +=
          "<h4>Gatos Mes</h4>" +
          "<p>" +
          "<b>" +
          data.total_gastos +
          "</b>" +
          "</p>";
        this.gastos.innerHTML = html;
        html = "";
        html +=
          "<h4>Utilidad Mes</h4>" +
          "<p>" +
          "<b>" +
          data.total_utilidad +
          "</b>" +
          "</p>";
        this.utilidad.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  */
  this.totalVentas = () => {
    fetch("../controllers/dashboard/totalFacturas.php")
      .then((response) => response.json())
      .then((data) => {
        //permisos = data.permisosMod;

        html = "";
        html +=
          "<h4>Clientes</h4>" +
          "<p>" +
          "<b> " +
          data.total_clientes +
          "</b>" +
          "</p>";
        this.clientes4.innerHTML = html;

      })
      .catch((error) => console.error(error));
  };
  this.totalClientes = () => {
    fetch("../controllers/dashboard/totalFacturas.php")
      .then((response) => response.json())
      .then((data) => {
        //permisos = data.permisosMod;

        html = "";
        html +=
          "<h4>Productos</h4>" +
          "<p>" +
          "<b> " +
          data.total_productos +
          "</b>" +
          "</p>";
        this.productos.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  this.totalProductos = () => {
    fetch("../controllers/dashboard/totalFacturas.php")
      .then((response) => response.json())
      .then((data) => {
        //permisos = data.permisosMod;

        html = "";
        html +=
          "<h4>Ventas día</h4>" +
          "<p>" +
          "<b>$" +
          data.ventas_dia +
          "</b>" +
          "</p>";
        this.total_vendido.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };
  this.totalxsistemaFinanciero = () => {
    fetch("../controllers/dashboard/total_sinsistemafina.php")
      .then((response) => response.json())
      .then((data) => {
        //permisos = data.permisosMod;

        html = "";
        html +=
          "<p>" +
          "<b>$" +
          data +
          "</b>" +
          "</p>";
        this.ssisfinanciero.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };

  
  this.totalxcontemaFinanciero = () => {
    fetch("../controllers/dashboard/total_consistemafina.php")
      .then((response) => response.json())
      .then((data) => {
        //permisos = data.permisosMod;

        html = "";
        html +=
          "<p>" +
          "<b>$" +
          data +
          "</b>" +
          "</p>";
        this.csisfinanciero.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };

  
  this.totalxcompesDeuda = () => {
    fetch("../controllers/dashboard/total_conpensaciond.php")
      .then((response) => response.json())
      .then((data) => {
        //permisos = data.permisosMod;

        html = "";
        html +=
          "<p>" +
          "<b>$" +
          data +
          "</b>" +
          "</p>";
        this.cpdsisfinanciero.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };

  
  this.totalxTarjDebito = () => {
    fetch("../controllers/dashboard/total_sistarjeta.php")
      .then((response) => response.json())
      .then((data) => {
        //permisos = data.permisosMod;

        html = "";
        html +=
          "<p>" +
          "<b>$" +
          data +
          "</b>" +
          "</p>";
        this.tardebitofinaciero.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };

  
  this.totalxTarjCredito = () => {
    fetch("../controllers/dashboard/total_sistarjetaC.php")
      .then((response) => response.json())
      .then((data) => {

        html = "";
        html +=
          "<p>" +
          "<b>$" +
          data +
          "</b>" +
          "</p>";
        this.tarcreditofinaciero.innerHTML = html;
      })
      .catch((error) => console.error(error));
  };

 

})();
app.totalxTarjCredito();
app.totalxTarjDebito();
app.totalxcompesDeuda();
app.totalxcontemaFinanciero();
app.totalxsistemaFinanciero();
app.totalFacuras();
//app.totalVentas();
//app.totalClientes();
app.totalProductos();
//app.utilidadMesCompras();
