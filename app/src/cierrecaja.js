const app = new (function () {
    
    
    this.movimientoid=document.getElementById("movimientoid");
    this.usuario_entregado_cierrecaja=document.getElementById("usuario_entregado_cierrecaja");
    this.usuario_id=document.getElementById("usuario_id");
    this.total_ventas_cierrecaja =document.getElementById("total_ventas_cierrecaja");;
    this.total_movimientos_cierrecaja =document.getElementById("total_movimientos_cierrecaja");;
    this.total_cierrecaja =document.getElementById("total_cierrecaja");
    this.listamovimientos=document.getElementById("listamovimientos");
    this.cierrecaja_id=document.getElementById("cierrecaja_id");
    this.caja_inicial_cierrecaja=document.getElementById("caja_inicial_cierrecaja");
    this.efectivo_entregado_cierrecaja = document.getElementById("efectivo_entregado_cierrecaja");;
    this.fecha_entregada_cierrecaja = document.getElementById("fecha_entregada_cierrecaja");;
    this.observacion_entregado_cierrecaja = document.getElementById("observacion_entregado_cierrecaja");;
    

    this.listadoMovimientos = () => {
      fetch("../controllers/cierrecaja/listadoMovimientoCierreCaja.php")
        .then((response) => response.json())
        .then((data) => {
          html =
            "<table class='table table-striped table-bordered first' id='example1'>";
          html += "<thead>";
          html += "<tr>";
          html += "<th>Fecha</th><th>Tipo Movimiento</th><th>Descripcion</th><th>Total</th>";
          html += "</tr>";
          html += "</thead>";
          html += "<tbody>";
          permisos = data.permisosMod;
          data=data.data;
          data.forEach((element) => {
            html += "<tr>";
            html +=
              "<td><strong>" + element.movimiento_fecha + "</strong></td>";
              html +=
              "<td><strong>" + element.movimiento_tipo + "</strong></td>";
            html +=
              "<td><strong> " +
              element.movimiento_descripcion +"</td>";
              if (element.movimiento_tipo.toUpperCase() === "ENTRADA") {
                html +=
                  "<td><span class='badge badge-success'>" +
                  element.movimiento_total +
                  "</span></td>"; 
              } else if (element.movimiento_tipo.toUpperCase() === "SALIDA") {
                html +=
                  "<td><span class='badge badge-danger'>" +
                  element.movimiento_total +
                  "</span></td>";
              }
              html +=
              "</tr>";
          });
            this.listamovimientos.innerHTML = html;
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
                },
                "resonsieve":"true",
                  "bDestroy": true,
                  "iDisplayLength": 3,
                  "order":[[0,"desc"]]
              });
        })
        .catch((error) => console.error(error));
    };

    this.guardar = () => {
      const form = new FormData(document.getElementById("cierreform"));
      if (this.validacionInputMovimiento(form) === true) {
        
          fetch("../controllers/cierrecaja/entregaCajaUsuarios.php", {
            method: "POST",
            body: form,
          })
            .then((response) => response.json())
            .then((data) => {
              if (data === true) {
                Swal.fire(
                  "Registrado!",
                  "Su caja se cerro correctamente!",
                  "success"
                );
                this.listadoMovimientos();
                this.limpiarInputs();
                this.listadoMovimientos();
              }else{
                toastr["error"](
                    "No se puede cerrar caja..!"
                  );
              }
            })
            .catch((error) => console.error(error));
        
      }
    };
    this.listadoPrecios = () => {
        const formId = new FormData();
        formId.append("id", this.usuario_id.value);
        fetch("../controllers/cierrecaja/obtenerTotalesCierreCaja.php", {
          method: "POST",
          body: formId,
        })
          .then((response) => response.json())
          .then((data) => {
            cierrecajaid = data.cierrecajaid;
            totalventas = data.totalVentas;
            totalmovimientos=data.totalMovimientos;
            totalcierre = data.total;
            if(data === 1){
                toastr["error"](
                    "No tiene una caja asignada, no se puede cerrar caja..!"
                  );
            }else{
             this.cierrecaja_id.value = cierrecajaid.cierrecaja_id;
             this.caja_inicial_cierrecaja.value = cierrecajaid.cierrecaja_efectivo_asignacion;
             this.total_ventas_cierrecaja.value = totalventas;
             this.total_movimientos_cierrecaja.value = totalmovimientos;
             this.total_cierrecaja.value = totalcierre;
            }
          })
          .catch((error) => console.error(error));
      };

    this.validacionInputMovimiento = (formInput) => {
      if (formInput.get("usuario_entregado_cierrecaja") === "") {
        toastr["warning"]("El usuario a entregar es requerido, debe escribir uno..!");
        document.getElementById("usuario_entregado_cierrecaja").focus();
        return false;
      } else if (formInput.get("efectivo_entregado_cierrecaja") === "") {
        toastr["warning"]("El efectivo recibido es requerido, debe escribir uno..!");
        document.getElementById("efectivo_entregado_cierrecaja").focus();
        return false;
      }else if (formInput.get("fecha_entregada_cierrecaja") === "") {
        toastr["warning"]("La fecha cierre es requerido, debe escribir uno..!");
        document.getElementById("fecha_entregada_cierrecaja").focus();
        return false;
        } else {
        return true;
      }
    };
    this.limpiarInputs = () => {
      this.usuario_entregado_cierrecaja.value = "";
      this.efectivo_entregado_cierrecaja.value = "";
      this.fecha_entregada_cierrecaja.value ="";
      this.observacion_entregado_cierrecaja.value ="";
      this.caja_inicial_cierrecaja.value = "";
      this.total_ventas_cierrecaja.value = "";
      this.total_movimientos_cierrecaja.value = "";
      this.total_cierrecaja.value = "";
    };
  })();
  app.listadoMovimientos();
  app.listadoPrecios();
