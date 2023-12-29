const app = new (function () {
    this.lote_descripcion = document.getElementById("lote_descripcion");
    this.lotes = document.getElementById("lotes");
    this.usuario_dni = document.getElementById("usuario_dni");
    this.usuario = document.getElementById("usuario");
    this.usuario_nombres = document.getElementById("usuario_nombres");
    this.usuario_email = document.getElementById("usuario_email");
    this.usuario_telefono = document.getElementById("usuario_telefono");
    this.usuario_direccion = document.getElementById("usuario_direccion");
    this.guardar = () => {
        const form = new FormData(document.getElementById("loteform"));
        if (this.validacionInputLote(form) === true) {
            fetch("../controllers/lote/guardarLote.php", {
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
                        this.listadoLotes();
                    } else if (data === 1) {
                        toastr["error"]("El campo lote ya existe, debe escribir otro..!");
                        this.lote_descripcion.focus();
                    }
                })
                .catch((error) => console.error(error));
        }
    };
    this.obtenerPerfil = () => {
        fetch("../controllers/perfil/obtenerPerfil.php", {
            method: "POST",
        })
            .then((response) => response.json())
            .then((data) => {
                if (data) {
                    this.usuario_dni.value = data.usuario_dni;
                    this.usuario.value = data.usuario;
                    this.usuario_nombres.value = data.usuario_nombres;
                    this.usuario_email.value = data.usuario_email;
                    this.usuario_telefono.value = data.usuario_telefono;
                    this.usuario_direccion.value = data.usuario_direccion;
                }
            })
            .catch((error) => console.error(error));
    };
    this.validacionInputLote = (formInput) => {
        if (formInput.get("lote_descripcion") === "") {
            toastr["warning"]("El campo lote es requirido, debe escribir uno..!");
            this.lote_descripcion.focus();
            return false;
        } else {
            return true;
        }
    };
    this.limpiarInputs = () => {
        this.lote_descripcion.value = "";
        this.lote_descripcion.focus();
    };
})();
app.obtenerPerfil();
