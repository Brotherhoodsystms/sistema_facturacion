const app = new (function () {
    this.vendedor_id = document.getElementById("vendedor_id");
    this.vendedor_dni = document.getElementById("vendedor_dni");
    this.vendedor_nombres = document.getElementById("vendedor_nombres");
    this.vendedor_telefono = document.getElementById("vendedor_telefono");
    this.vendedor_direccion = document.getElementById("vendedor_direccion");
    this.vendedores = document.getElementById("vendedores");
    this.listadoVendedores = () => {
        fetch("../controllers/vendedor/listadoVendedor.php")
            .then((response) => response.json())
            .then((data) => {
                html =
                    "<table class='table table-striped table-bordered first' id='example1'>";
                html += "<thead>";
                html += "<tr>";
                html += "<th>Imagen</th><th>Datos Vendedor</th><th>Opciones</th>";
                html += "</tr>";
                html += "</thead>";
                html += "<tbody>";
                permisos = data.permisosMod;
                data=data.data;
                data.forEach((element) => {
                    html += "<tr>";
                    html +=
                             "<td><center><img src='../../public/images/clients.png' alt='logo box' width='50px'></center></td>";
                    html +=
                        "<td> <strong> Dni: " +
                        element.vendedor_dni.toUpperCase() +
                        "</strong><br/><strong>Nombres: " +
                        element.vendedor_nombres +
                        "</strong><br/><u>Telefono: " +
                        element.vendedor_telefono +
                        "</strong><br/><u>Direccion: " +
                        element.vendedor_direccion +
                        "</u></td>";
                    html += "<td>";
                  if (permisos["u"] === "1"){ 
                    html +=
                        "<button type='button' class='btn btn-info btn-sm' style = 'border-radius:50%; width:50px; height:50px;' title='Editar' onClick='app.editar(" +
                        element.vendedor_id +
                        ")'><i class='fas fa-pencil-alt'></i></button>";
                  }
                  if (permisos["d"] === "1"){ 
                    html +=
                        "<button type='button' class='btn btn-danger btn-sm' style = 'border-radius:50%; width:50px; height:50px; margin:0% 2%;' title='Eliminar' onClick='app.eliminar(" +
                        element.vendedor_id +
                        ")'><i class='fa fa-trash'></i></button>";
                  }
                        html += "</td>";
                });
                html +=
                    "</tr></tbody><tfoot><tr><th>Imagen</th><th>Datos Vendedor</th><th>Opciones</th></tr></tfoot></table>";
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
                    },
                });
            })
            .catch((error) => console.error(error));
    };
    /* guardar */
    this.guardar = () => {
        const form = new FormData(document.getElementById("vendedorform"));
        if (this.validacionInputVendedor(form) === true) {
            if (this.vendedor_id.value === "") {
                fetch("../controllers/vendedor/guardarVendedor.php", {
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
                            this.listadoVendedores();
                        } else if (data === 0) {
                            toastr["error"]("El campo dni ya existe, debe escribir otro..!");
                            this.vendedor_dni.focus();
                        }
                    })
                    .catch((error) => console.error(error));
            } else {
                /* Actualizar los campos con validaciones*/
                fetch("../controllers/vendedor/actualizarVendedor.php", {
                    method: "POST",
                    body: form,
                })
                    .then((response) => response.json())
                    .then((data) => {
                        console.log(data);
                        if (data === true) {
                            Swal.fire(
                                "Actualizado!",
                                "Su información se actualizo correctamente!",
                                "success"
                            );
                            this.limpiarInputs();
                            this.listadoVendedores();
                        } else if (data === 0) {
                            toastr["error"]("El campo dni ya existe, debe escribir otro..!");
                            this.vendedor_dni.focus();
                        } 
                    })
                    .catch((error) => console.error(error));
            }
        }
    };
    this.editar = (id) => {
        const formId = new FormData();
        formId.append("id", id);
        fetch("../controllers/vendedor/obtenerVendedor.php", {
            method: "POST",
            body: formId,
        })
            .then((response) => response.json())
            .then((data) => {
                toastr["info"](
                    "Esta en modo de actualizar datos, solo puede modificar un dato..!"
                );
                this.vendedor_id.value = data.vendedor_id;
                this.vendedor_dni.value = data.vendedor_dni;
                this.vendedor_nombres.value = data.vendedor_nombres;
                this.vendedor_telefono.value = data.vendedor_telefono;
                this.vendedor_direccion.value = data.vendedor_direccion;
                })
            .catch((error) => console.error(error));
    };

    this.eliminar = (id) => {
        const formId = new FormData();
        formId.append("id", id);
        fetch("../controllers/vendedor/eliminarVendedor.php", {
          method: "POST",
          body: formId,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data === true) {
              Swal.fire(
                "Eliminado!",
                "Producto eliminado correctamente!",
                "success"
              );
              this.listadoVendedores();
            } else {
              Swal.fire(
                "icon: 'error'",
                "title: 'Error'",
                "text: 'No se pudo eliminar el producto'"
              );
              this.listadoVendedores();
            }
          })
          .catch((error) => console.error(error));
      };

    this.validacionInputVendedor = (formInput) => {
        if (formInput.get("vendedor_dni") === "") {
            toastr["warning"](
                "El campo dni es requirido, debe escribir uno..!"
            );
            this.vendedor_dni.focus();
            return false;
        } else if (formInput.get("vendedor_nombres") === "") {
            toastr["warning"]("El campo nombre es requirido, debe escribir uno..!");
            this.vendedor_nombres.focus();
            return false;
        } else if (formInput.get("vendedor_telefono") === "") {
            toastr["warning"]("El campo telefono es requirido, debe escribir uno..!");
            this.vendedor_telefono.focus();
            return false;
        } else {
            return true;
        }
    };
 
    this.limpiarInputs = () => {
        this.vendedor_id.value = "";
        this.vendedor_dni.value = "";
        this.vendedor_nombres.value = "";
        this.vendedor_telefono.value = "";
        this.vendedor_direccion.value = "";
        };
})();
app.listadoVendedores();
