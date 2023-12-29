const formulario = document.getElementById("clienteVform");
const formulario1 = document.getElementById("productoform");
const formulario2 = document.getElementById("gastosFrom");
const formulario3 = document.getElementById("cajachicaform");
const formulario4 = document.getElementById("detacajachicaform");
const formulario5 = document.getElementById("vendedorRegistroform");
const inputs = document.querySelectorAll("#clienteVform input");
const inputs1 = document.querySelectorAll("#productoform input");
const inputs2 = document.querySelectorAll("#gastosFrom input");
const inputs3 = document.querySelectorAll("#cajachicaform input");
const inputs4 = document.querySelectorAll("#detacajachicaform input");
const inputs5 = document.querySelectorAll("#vendedorRegistroform input");

const expresiones = {
  usuario: /^[a-zA-Z0-9À-ÿ\s-]{1,80}$/, // Letras, numeros, guion y guion_bajo
  nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
  correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
  telefono: /^\d{1,10}$/, // 1 a 10 números.
  entero: /^[0-9]{1,20}$/,
  decimal: /^\d{1,20}(\.\d{1,2})?$/,
};

const campos = {
  usuario: false,
  nombre: false,
  correo: false,
  telefono: false,
  entero: false,
  decimal: false,
};

const validarFormulario = (e) => {
  switch (e.target.name) {
    case "cliente_razonsocial":
      validarCampo(expresiones.nombre, e.target, "rs");
      break;
    case "cliente_ruc":
      validarCampo(expresiones.telefono, e.target, "id");
      break;
    case "cliente_telefono":
      validarCampo(expresiones.telefono, e.target, "tel");

      break;
    case "cliente_direccion":
      validarCampo(expresiones.usuario, e.target, "dire");
      break;
    case "cliente_email":
      validarCampo(expresiones.correo, e.target, "email");
      break;
    case "cliente_contacto":
      validarCampo(expresiones.nombre, e.target, "contacto");
      break;
    case "producto_codigoserial":
      validarCampo(expresiones.usuario, e.target, "cp");
      break;
    case "producto_descripcion":
      validarCampo(expresiones.usuario, e.target, "pd");
      break;
    case "producto_precioxMe":
      validarCampo(expresiones.decimal, e.target, "pc");
      break;

    case "producto_precioxMa":
      validarCampo(expresiones.decimal, e.target, "pv");
      break;

    case "producto_comprar":
      validarCampo(expresiones.entero, e.target, "pco");
      break;
    case "gastos_descripcion":
      validarCampo(expresiones.usuario, e.target, "gd");
      break;
    case "gastos_total":
      validarCampo(expresiones.decimal, e.target, "gt");
      break;
    case "cajachica_dineroasignacion_a":
      validarCampo(expresiones.decimal, e.target, "adc");
      break;
      case "cajachica_area":
      validarCampo(expresiones.usuario, e.target, "ar");
      break;
      case "detacajachicavalor":
      validarCampo(expresiones.decimal, e.target, "vd");
      break;
      case "detacajachicadescripcion":
      validarCampo(expresiones.usuario, e.target, "dcd");
      break;
      case "vendedoras_nombre":
      validarCampo(expresiones.nombre, e.target, "vn");
      break;
      case "vendedoras_contacto":
      validarCampo(expresiones.nombre, e.target, "vc");
      break;
      case "vendedoras_telefono":
      validarCampo(expresiones.telefono, e.target, "vt");
      break;
      case "vendedora_sector":
      validarCampo(expresiones.nombre, e.target, "vs");
      break;
      case "vendedoras_observacion":
      validarCampo(expresiones.nombre, e.target, "vo");
      break;
      case "vendedor_direccion":
      validarCampo(expresiones.usuario, e.target, "vdi");
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
