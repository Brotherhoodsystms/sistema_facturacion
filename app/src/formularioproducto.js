const formulario = document.getElementById("productoform");
const formulario1 = document.getElementById("stockformproveedor");
const formulario2 = document.getElementById("stockformclientes");
const inputs = document.querySelectorAll("#productoform input");
const inputs1 = document.querySelectorAll("#stockformproveedor input");
const inputs2 = document.querySelectorAll("#stockformclientes input");


const expresiones = {
  usuario: /^[a-zA-Z0-9À-ÿ\s-]{1,40}$/,  // Letras, numeros, guion y guion_bajo
  nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
  telefono: /^\d{1,20}$/, // 1 a 10 números.
  entero:/^[0-9]{1,20}$/,
  decimal:/^\d{1,20}(\.\d{1,2})?$/,
  correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
};

const campos = {
  usuario: false,
  nombre:false,
  telefono: false,
  entero:false,
  decimal:false,
  correo:false,
};

const validarFormulario = (e) => {
  switch (e.target.name) {
    case "codigoReferenciaProducto":
        validarCampo(expresiones.telefono,e.target,"cr");
      break;
    case "producto_descripcion":
      validarCampo(expresiones.usuario, e.target, "des");
      break;
    case "producto_stock":
      validarCampo(expresiones.entero, e.target, "cant");
      
      break;
    case "producto_precioxMe":
      validarCampo(expresiones.decimal, e.target, 'pc');
      
      break;
    case "producto_precioxMa":
      validarCampo(expresiones.decimal, e.target, "pv");
      break;
      case "razonsocialproveedornuevo":
      validarCampo(expresiones.nombre, e.target, "rsp");
      break;
      case "rucproveedornuevo":
      validarCampo(expresiones.telefono, e.target, "rucp");
      break;
      case "correoelectroniconuevoproveedor":
      validarCampo(expresiones.correo, e.target, "emailp");
      break;
      case "contactoreferenciaproveedor_nuevo":
      validarCampo(expresiones.nombre, e.target, "crp");
      break;
      case "telefonoproveedor_nuevo":
      validarCampo(expresiones.telefono, e.target, "tp");
      break;
      case "direccionproveedornuevo":
      validarCampo(expresiones.usuario, e.target, "dp");
      break;
      case "razonsocialclientenuevo":
      validarCampo(expresiones.nombre, e.target, "rsv");
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

