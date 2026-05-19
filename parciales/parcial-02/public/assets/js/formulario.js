//cedula y pasaporte valida
const tipoDoc = document.getElementById('tipo_doc');
const documento = document.getElementById('documento');

const regexCedula = /^(PE|E|N|[23456789](?:AV|PI)?|1[0123]?(?:AV|PI)?)-(\d{1,4})-(\d{1,6})$/;
const regexPasaporte = /^[A-Z0-9]{6,9}$/i;

function validarDocumento() {
    const tipo = tipoDoc.value;
    const valor = documento.value.trim();

    if (tipo === 'cedula') {
        if (!regexCedula.test(valor)) {
            documento.setCustomValidity('Cédula inválida. Ejemplo: 8-123-456789');
        } else {
            documento.setCustomValidity('');
        }
    } else if (tipo === 'pasaporte') {
        if (!regexPasaporte.test(valor)) {
            documento.setCustomValidity('Pasaporte inválido. Entre 6 y 9 caracteres alfanuméricos.');
        } else {
            documento.setCustomValidity('');
        }
    }
}
//cedula y pasaporte vaklido


//no nacio hoy y no es mayor de edad
const fechaNacimiento = document.getElementById('fecha_nacimiento');

function validarEdad() {
    const valor = fechaNacimiento.value;
    if (!valor) return;

    const hoy = new Date();
    const nacimiento = new Date(valor);
    const edad = hoy.getFullYear() - nacimiento.getFullYear();
    const mes = hoy.getMonth() - nacimiento.getMonth();
    const edadReal = mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate()) ? edad - 1 : edad;

    if (edadReal < 18) {
        fechaNacimiento.setCustomValidity('Debes tener al menos 18 años.');
    } else if (edadReal > 100) {
        fechaNacimiento.setCustomValidity('La edad máxima es 100 años.');
    } else {
        fechaNacimiento.setCustomValidity('');
    }
}
//no nacio hoy y no es mayor de edad

//no shananigans para lo demas
const nombre = document.getElementById('nombre');
const apellido = document.getElementById('apellido');
const residencia = document.getElementById('residencia');

const regexTexto = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;

function validarTexto(campo) {
    if (!regexTexto.test(campo.value)) {
        campo.setCustomValidity('No se permiten números ni caracteres especiales.');
    } else {
        campo.setCustomValidity('');
    }
}
//no shananigans para lo demas

nombre.addEventListener('input', () => validarTexto(nombre));
apellido.addEventListener('input', () => validarTexto(apellido));
residencia.addEventListener('input', () => validarTexto(residencia));
fechaNacimiento.addEventListener('change', validarEdad);
documento.addEventListener('input', validarDocumento);
tipoDoc.addEventListener('change', validarDocumento);