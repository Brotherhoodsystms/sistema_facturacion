const formulario = document.getElementById("clienteform");
const inputs = document.querySelectorAll("#clienteform input");

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
    case "cliente_razonsocial":
      validarCampo(expresiones.nombre, e.target, "razon");
      break;

    case "cliente_ruc":
      validarCampo(expresiones.telefono, e.target, "identificacion");

      break;

      case "cliente_telefono":
      validarCampo(expresiones.telefono, e.target, "telefono");

      break;

      case "cliente_email":
      validarCampo(expresiones.correo, e.target, "email");
      break;

      case "cliente_contacto":
      validarCampo(expresiones.nombre, e.target, "contacto");
      break;

      case "cliente_direccion":
        validarCampo(expresiones.usuario, e.target, "direccion");
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
  const inputPassword1 = document.getElementById("password");
  const inputPassword2 = document.getElementById("usuario_password");

  if (inputPassword1.value !== inputPassword2.value) {
    document
      .getElementById(`grupo__repassword`)
      .classList.add("formulario__grupo-incorrecto");
    document
      .getElementById(`grupo__repassword`)
      .classList.remove("formulario__grupo-correcto");
    document
      .querySelector(`#grupo__repassword i`)
      .classList.add("fa-circle-xmark");
    document
      .querySelector(`#grupo__repassword i`)
      .classList.remove("fa-circle-check");
    document
      .querySelector(`#grupo__repassword .formulario__input-error`)
      .classList.add("formulario__input-error-activo");
    campos["password"] = false;
  } else {
    document
      .getElementById(`grupo__repassword`)
      .classList.remove("formulario__grupo-incorrecto");
    document
      .getElementById(`grupo__repassword`)
      .classList.add("formulario__grupo-correcto");
    document
      .querySelector(`#grupo__repassword i`)
      .classList.remove("fa-circle-xmark");
    document
      .querySelector(`#grupo__repassword i`)
      .classList.add("fa-circle-check");
    document
      .querySelector(`#grupo__repassword .formulario__input-error`)
      .classList.remove("formulario__input-error-activo");
    campos["password"] = true;
  }
};

inputs.forEach((input) => {
  input.addEventListener("keyup", validarFormulario);
  input.addEventListener("blur", validarFormulario);
});
