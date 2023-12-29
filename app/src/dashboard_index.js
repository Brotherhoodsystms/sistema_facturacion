const app = new (function () {
  this.total_vendido = document.getElementById("total_vendido");
  this.productos = document.getElementById("productos");
  this.gastos = document.getElementById("gastos");
  this.compras = document.getElementById("compras");
  this.utilidad = document.getElementById("utilidad");
  this.estadistica_dia = document.getElementById("estadistica_dia");
  this.estadistica_mes=document.getElementById("estadistica_mes");
  this.MesCompras = () => {
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
  this.gastosMes = () => {
    fetch("../controllers/dashboard/totalFacturas.php")
      .then((response) => response.json())
      .then((data) => {
        //permisos = data.permisosMod;
        html = "";
        html +=
          "<h4>Gatos Mes</h4>" +
          "<p>" +
          "<b>" +
          data.total_gastos +
          "</b>" +
          "</p>";
        this.gastos.innerHTML = html;

      })
      .catch((error) => console.error(error));
  };
  this.utilidadMes = () => {
    fetch("../controllers/dashboard/totalFacturas.php")
      .then((response) => response.json())
      .then((data) => {
        //permisos = data.permisosMod;
        html = "";
        html +=
          "<h4>Utilidad Mes</h4>" +
          "<p>" +
          "<b>" +
          data.total_utilidad.toFixed(2) +
          "</b>" +
          "</p>";
        this.utilidad.innerHTML = html;

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
  this.listadoxdia = () => {
    fetch("../controllers/dashboard/totalxdia.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<tbody>";
        data.forEach((element) => {
          html += "<tr>";
          html += "<td><strong>" + element.emisor + "</strong></td>";
          html +="<td><div class='col-md-6 col-lg-8'><div class='widget-small danger coloured-icon'><i class='fa-solid fa-money-check-dollar fa-2x' style='color:#1bd0e4;'></i><div id='gastos'class='info'><p>GASTOS</p><p><b>"+element.gastos+"</b></p></div></div></div></td>";
          html += "<td><div class='col-md-6 col-lg-8'><div class='widget-small danger coloured-icon'><i class='fa-solid fa-cart-shopping fa-2x' style='color:#0A84D6;'></i><div id='compras'class='info'><p>COMPRAS</p><p><b>"+element.compras+"</b></p></div></div></div></td>";
          html += "<td><div class='col-md-6 col-lg-8'><div class='widget-small danger coloured-icon'><i class='fa-solid fa-money-bill-trend-up fa-2x' style='color:#24B0C5;'></i><div id='compras'class='info'><p>VENTAS</p><p><b>"+element.ventas+"</b></p></div></div></div></td>";
          html += "<td><div class='col-md-6 col-lg-8'><div class='widget-small danger coloured-icon'><i class='fa-solid fa-hand-holding-dollar fa-2x' style='color:#4E73DF;'></i><div id='utilidad' class='info'><p>Utilidad</p><p><b>"+element.utilidad+"</b></p></div></div></div></td >";
          html += "</tr>";

          });
          this.estadistica_dia.innerHTML = html;
        })
        .catch ((error) => console.error(error));
    };
    this.listadoxmes=()=>
    {
      fetch("../controllers/dashboard/totalxmes.php")
      .then((response) => response.json())
      .then((data) => {
        html =
          "<table class='table table-striped table-bordered first' id='example1'>";
        html += "<tbody>";
        data.forEach((element) => {
          html += "<tr>";
          html += "<td><strong>" + element.emisor + "</strong></td>";
          html +="<td><div class='col-md-6 col-lg-8'><div class='widget-small danger coloured-icon'><i class='fa-solid fa-money-check-dollar fa-2x' style='color:#1bd0e4;'></i><div id='gastos'class='info'><p>GASTOS</p><p><b>"+element.gastos+"</b></p></div></div></div></td>";
          html += "<td><div class='col-md-6 col-lg-8'><div class='widget-small danger coloured-icon'><i class='fa-solid fa-cart-shopping fa-2x' style='color:#0A84D6;'></i><div id='compras'class='info'><p>COMPRAS</p><p><b>"+element.compras+"</b></p></div></div></div></td>";
          html += "<td><div class='col-md-6 col-lg-8'><div class='widget-small danger coloured-icon'><i class='fa-solid fa-money-bill-trend-up fa-2x' style='color:#24B0C5;'></i><div id='compras'class='info'><p>VENTAS</p><p><b>"+element.ventas+"</b></p></div></div></div></td>";
          html += "<td><div class='col-md-6 col-lg-8'><div class='widget-small danger coloured-icon'><i class='fa-solid fa-hand-holding-dollar fa-2x' style='color:#4E73DF;'></i><div id='utilidad' class='info'><p>Utilidad</p><p><b>"+element.utilidad+"</b></p></div></div></div></td >";
html += "</tr>";

          });
this.estadistica_mes.innerHTML = html;
        })
        .catch ((error) => console.error(error));

    }
    this.ocultarInput=()=>{
      $('#visualizarMes').show();
      $('#estadistica_mes').hide();
      $('#estadistica_dia').hide();
      $('#ocultarMes').hide();
      $('#ocultarDia').hide();
    }
    this.ocultarMes=()=>{
      $('#estadistica_mes').hide();
      $('#ocultarMes').hide();
      $('#visualizarMes').show();
    }
    this.ocultarDia=()=>{
      $('#estadistica_dia').hide();
      $('#ocultarDia').hide();
      $('#visualizarDia').show();
    }
    this.visualizarMes=()=>{
      $('#estadistica_mes').show();
      $('#ocultarMes').show();
      $('#visualizarMes').hide();
    }
    this.visualizarDia=()=>{
      $('#estadistica_dia').show();
      $('#ocultarDia').show();
      $('#visualizarDia').hide();
    }

  }) ();

//app.totalClientes();
//app.totalProductos();
//app.MesCompras();
//app.gastosMes();
//app.utilidadMes();
app.listadoxdia();
app.listadoxmes();
app.ocultarInput();