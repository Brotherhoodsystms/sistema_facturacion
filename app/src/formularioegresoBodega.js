const formulario = document.getElementById("ubicacionform");
const formulario1 = document.getElementById("bodegaform");
const formulario2 = document.getElementById("categoriaform");
const formulario3 = document.getElementById("cierrecajaform");
const formulario4 = document.getElementById("movimientoFrom");
const formulario5 = document.getElementById("cierreform");

const inputs = document.querySelectorAll("#ubicacionform input");
const inputs1 = document.querySelectorAll("#bodegaform input");
const inputs2 = document.querySelectorAll("#categoriaform input");
const inputs3 = document.querySelectorAll("#cierrecajaform input");
const inputs4 = document.querySelectorAll("#movimientoFrom input");
const inputs5 = document.querySelectorAll("#cierreform input");

const expresiones = {
  usuario: /^[a-zA-Z0-9À-ÿ\s.-]{0,80}$/, // Letras, numeros, guion y guion_bajo
  entero: /^[0-9]{1,20}$/,
  nb: /^[a-zA-Z0-9À-ÿ\s-]{1,80}$/,
  nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
  decimal:/^\d{1,20}(\.\d{1,2})?$/,

};

const campos = {
  usuario: false,
  entero: false,
  nb: false,
  nombre: false,
  decimal:false,
};

const validarFormulario = (e) => {
  switch (e.target.name) {
    case "producto_codigoserial":
      validarCampo(expresiones.usuario, e.target, "cp");
      break;
    case "descripcion_producto":
      validarCampo(expresiones.usuario, e.target, "dp");
      break;
    case "producto_stock":
      validarCampo(expresiones.entero, e.target, "st");

      break;
    case "producto_comprar":
      validarCampo(expresiones.entero, e.target, "pc");
      break;

    case "bodega_descripcion":
      validarCampo(expresiones.nb, e.target, "nb");
      break;

    case "categoria_descripcion":
      validarCampo(expresiones.nombre, e.target, "ct");
      break;

      case "cierrecaja_efectivo_asignacion":
      validarCampo(expresiones.decimal, e.target, "adc");
      break;
      
      
      case "movimiento_descripcion":
      validarCampo(expresiones.usuario, e.target, "descrip");
      break;

      case "movimiento_total":
      validarCampo(expresiones.decimal, e.target, "mt");
      break;

      case "usuario_entregado_cierrecaja":
      validarCampo(expresiones.nombre, e.target, "entre");
      break;
      case "efectivo_entregado_cierrecaja":
      validarCampo(expresiones.decimal, e.target, "efec");
      break;
      case "observacion_entregado_cierrecaja":
      validarCampo(expresiones.nombre, e.target, "obs");
      break;
      case "razonsocialclientenuevo":
      validarCampo(expresiones.nombre, e.target, "rso");
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

inputs1.forEach((input) => {
  input.addEventListener("keyup", validarFormulario);
  input.addEventListener("blur", validarFormulario);
});

inputs2.forEach((input) => {
  input.addEventListener("keyup", validarFormulario);
  input.addEventListener("blur", validarFormulario);
});

inputs3.forEach((input) => {
    input.addEventListener("keyup", validarFormulario);
    input.addEventListener("blur", validarFormulario);
  });

  inputs4.forEach((input) => {
    input.addEventListener("keyup", validarFormulario);
    input.addEventListener("blur", validarFormulario);
  });

  inputs5.forEach((input) => {
    input.addEventListener("keyup", validarFormulario);
    input.addEventListener("blur", validarFormulario);
  });

  inputs6.forEach((input) => {
    input.addEventListener("keyup", validarFormulario);
    input.addEventListener("blur", validarFormulario);
  });
  