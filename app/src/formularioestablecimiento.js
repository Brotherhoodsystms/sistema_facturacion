const formulario = document.getElementById("formEstablecimiento");
const inputs = document.querySelectorAll("#formEstablecimiento input");

const expresiones = {
  usuario: /^[a-zA-Z0-9À-ÿ\s-]{1,40}$/,  // Letras, numeros, guion y guion_bajo
  nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
  telefono: /^\d{1,10}$/, // 1 a 10 números.
};

const campos = {
  usuario: false,
  nombre: false,
  telefono: false,
};

const validarFormulario = (e) => {
  switch (e.target.name) {
    case "nombre_establecimiento":
        validarCampo(expresiones.nombre,e.target,"nom");
      break;
    case "codigo_establecimiento":
      validarCampo(expresiones.telefono, e.target, "cod");
      break;
    case "nombre_comercial_estable":
      validarCampo(expresiones.nombre, e.target, "nc");
      
      break;
    case "direccion_establecimiento":
      validarCampo(expresiones.usuario, e.target, "dire");
      break;
    case "usuario_password":
        validarPassword2();
      break;
      case "usuario_direccion":
        validarCampo(expresiones.usuario,e.target,"direccion");
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