const formularioPersona = document.getElementById('persona-form');
const formularioProducto = document.getElementById('producto-form');

const expresiones = {
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    apellido: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    dni: /^[0-9]{8}$/, // 8 dígitos numéricos para DNI
    direccion: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    codigo: /^[a-zA-Z0-9]{1,10}$/, // Letras y números para código
    producto: /^[a-zA-Z0-9\s]{1,50}$/, // Letras, números y espacios para producto
    precio: /^\d+(\.\d{1,2})?$/, // Números enteros o decimales con hasta 2 decimales para precio
    cantidad: /^\d+$/ // Números enteros para cantidad
};

const campos = {
    nombre: false,
    apellido: false,
    dni: false,
    direccion: false,
    codigo: false,
    producto: false,
    precio: false,
    cantidad: false
};

const validarCampo = (expresion, input, campo) => {
    if (expresion.test(input.value)) {
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos[campo] = true;
    } else {
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos[campo] = false;
    }
}

const validarFormularioPersona = (e) => {
    switch (e.target.name) {
        case "nombre":
            validarCampo(expresiones.nombre, e.target, 'nombre');
            break;
        case "apellido":
            validarCampo(expresiones.apellido, e.target, 'apellido');
            break;
        case "dni":
            validarCampo(expresiones.dni, e.target, 'dni');
            break;
        case "direccion":
            validarCampo(expresiones.direccion, e.target, 'fecha-nacimiento');
            break;
    }
}

const validarFormularioProducto = (e) => {
    switch (e.target.name) {
        case "codigo":
            validarCampo(expresiones.codigo, e.target, 'codigo');
            break;
        case "producto":
            validarCampo(expresiones.producto, e.target, 'producto');
            break;
        case "precio":
            validarCampo(expresiones.precio, e.target, 'precio');
            break;
        case "cantidad":
            validarCampo(expresiones.cantidad, e.target, 'cantidad');
            break;
    }
}

formularioPersona.addEventListener('keyup', validarFormularioPersona);
formularioPersona.addEventListener('blur', validarFormularioPersona);

formularioProducto.addEventListener('keyup', validarFormularioProducto);
formularioProducto.addEventListener('blur', validarFormularioProducto);
