const formulario = document.getElementById("emisorform");
const inputs = document.querySelectorAll("#emisorform input");

const expresiones = {
  usuario: /^[a-zA-Z0-9À-ÿ\s-]{1,40}$/,  // Letras, numeros, guion y guion_bajo
  nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
  password: /^.{4,12}$/, // 4 a 12 digitos.
  correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
  telefono: /^\d{1,13}$/, // 1 a 10 números.
};

const campos = {
  usuario: false,
  nombre: false,
  password: false,
  correo: false,
  telefono: false,
};

const validarFormulario = (e) => {
  switch (e.target.name) {
    case "emisor_ruc":
        validarCampo(expresiones.telefono,e.target,"ruc");
      break;
    case "emisor_razon_social":
      validarCampo(expresiones.nombre, e.target, "rs");
      break;
    case "emisor_ncomercial":
      validarCampo(expresiones.nombre, e.target, "nc");
      
      break;
    case "emisor_direcion":
      validarCampo(expresiones.usuario, e.target, 'dir');
      break;
      case "emisor_passFirma_first":
        validarCampo(expresiones.password, e.target, 'cf');
        validarPassword2();
        break;
        case "emisor_passFirma_second":
        validarPassword2();
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

const validarPassword2 = () => {
  const inputPassword1 = document.getElementById("emisor_passFirma_first");
  const inputPassword2 = document.getElementById("emisor_passFirma_second");

  if (inputPassword1.value !== inputPassword2.value) {
    document
      .getElementById(`grupo__rec`)
      .classList.add("formulario__grupo-incorrecto");
    document
      .getElementById(`grupo__rec`)
      .classList.remove("formulario__grupo-correcto");
    document
      .querySelector(`#grupo__rec i`)
      .classList.add("fa-circle-xmark");
    document
      .querySelector(`#grupo__rec i`)
      .classList.remove("fa-circle-check");
    document
      .querySelector(`#grupo__rec .formulario__input-error`)
      .classList.add("formulario__input-error-activo");
    campos["emisor_passFirma_first"] = false;
  } else {
    document
      .getElementById(`grupo__rec`)
      .classList.remove("formulario__grupo-incorrecto");
    document
      .getElementById(`grupo__rec`)
      .classList.add("formulario__grupo-correcto");
    document
      .querySelector(`#grupo__rec i`)
      .classList.remove("fa-circle-xmark");
    document
      .querySelector(`#grupo__rec i`)
      .classList.add("fa-circle-check");
    document
      .querySelector(`#grupo__rec .formulario__input-error`)
      .classList.remove("formulario__input-error-activo");
    campos["emisor_passFirma_first"] = true;
  }
};

inputs.forEach((input) => {
  input.addEventListener("keyup", validarFormulario);
  input.addEventListener("blur", validarFormulario);
});
