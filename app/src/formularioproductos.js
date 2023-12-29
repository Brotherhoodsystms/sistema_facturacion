const formulario = document.getElementById("productoform");
const inputs = document.querySelectorAll("#productoform input");

const expresiones = {
  usuario: /^[a-zA-Z0-9À-ÿ\s-]{1,40}$/,  // Letras, numeros, guion y guion_bajo
  telefono: /^\d{1,20}$/, // 1 a 10 números.
  entero:/^[0-9]{1,20}$/,
  decimal:/^\d{1,20}(\.\d{1,2})?$/,


};

const campos = {
  usuario: false,
  telefono: false,
  entero:false,
  decimal:false,
};

const validarFormulario = (e) => {
  switch (e.target.name) {
    case "producto_codigoserial":
        validarCampo(expresiones.telefono,e.target,"cp");
      break;
    case "producto_descripcion":
      validarCampo(expresiones.usuario, e.target, "des");
      break;
    case "producto_stock":
      validarCampo(expresiones.entero, e.target, "st");
      
      break;
    case "producto_precio_compra":
      validarCampo(expresiones.decimal, e.target, 'pc');
      break;
    case "producto_precio_venta":
      validarCampo(expresiones.decimal, e.target, "pv");
      break;
  }
};

const validarCampo = (expresion, input, campo) => {
  if (expresion.test(input.value)) {
    document
      .getElementById(`grupo__${campo}`)
      .classList.remove("formulario__grupo-incorrecto");
    document
      .getElementById(`grupo__${campo}`)
      .classList.add("formulario__grupo-correcto");
    document
      .querySelector(`#grupo__${campo} i`)
      .classList.add("fa-circle-check");
    document
      .querySelector(`#grupo__${campo} i`)
      .classList.remove("fa-circle-xmark");
    document
      .querySelector(`#grupo__${campo} .formulario__input-error`)
      .classList.remove("formulario__input-error-activo");
    campos[campo] = true;
  } else {
    document
      .getElementById(`grupo__${campo}`)
      .classList.add("formulario__grupo-incorrecto");
    document
      .getElementById(`grupo__${campo}`)
      .classList.remove("formulario__grupo-correcto");
    document
      .querySelector(`#grupo__${campo} i`)
      .classList.add("fa-circle-xmark");
    document
      .querySelector(`#grupo__${campo} i`)
      .classList.remove("fa-circle-check");
    document
      .querySelector(`#grupo__${campo} .formulario__input-error`)
      .classList.add("formulario__input-error-activo");
    campos[campo] = false;
  }
};


inputs.forEach((input) => {
  input.addEventListener("keyup", validarFormulario);
  input.addEventListener("blur", validarFormulario);
});


