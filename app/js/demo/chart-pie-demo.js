// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example




$(document).ready(function () {
  $.ajax({
    url: "http://localhost/sistema_facturacion/app/graficos/procesos.grafico.php",
    method: "GET",
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      console.log(respuesta);
      var ganancias = [];
      var tiempos = [];
      for (let index = 0; index < data.length; index++) {
        ganancias.push(data[index][0]);
        tiempos.push(data[index][1]);

      }
      var ctx = document.getElementById("myPieChart");
      var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: tiempos,
          datasets: [{
            data: ganancias,
            backgroundColor: ['#4e73df','#F6C23E', '#36b9cc','#1cc88a','#EA2C59'],
            
            
          }],
        },
        
      });

    }
  });


});