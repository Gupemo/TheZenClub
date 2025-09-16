// Selección de elementos globales
const check1 = document.getElementById('check1');
const patologies = document.getElementById('patologies');
const check2 = document.getElementById('check2');
const group = document.getElementById('group');
const hrform = document.getElementById('hrform');

// Evento para mostrar/ocultar el textarea de patologías
check1.addEventListener('change', () => {
  if (check1.checked) {
    patologies.classList.remove('hidden');
  } else {
    patologies.classList.add('hidden');
  }
});

// Evento para mostrar/ocultar persona de contacto y el hr de encima
check2.addEventListener('change', () => {
  if (check2.checked) {
    group.classList.remove('hidden');
    hrform.classList.remove('hidden');
  } else {
    group.classList.add('hidden');
    hrform.classList.add('hidden');
  }
});

let btnSubmit = document.getElementById('btnSubmit');
let form = document.querySelector('.form');

btnSubmit.addEventListener('click', (e)=>{
    // desactivando el boton, hasta que todo esté correcto.
    e.preventDefault();
    correct = check();
    // enviar el formulario si todo está correcto.
    if(correct == true){
        form.submit();
    }
})
// funcion para comprobar que todo esta nicely
function check(){
    // variables locales
    let userName = document.getElementById('userName');
    let userSubname = document.getElementById('userSubname');
    let userbirthDate = document.getElementById('userBirthDate');
    let userPassword = document.getElementById('userPassword');
    let userPhone = document.getElementById('userPhone');
    let userSex = document.getElementById('userSex');
    let privacy = document.getElementById('conditions');

/*     let userContactName = document.getElementById('contactName');
    let userContactSubname = document.getElementById('contactSubname');
    let userContactPhone = document.getElementById('contactPhone');
    let userContactRelationship = document.getElementById('relationship'); */

    // empezando a hacer los checks
    let correct = true
    if(userName.value == null || userName.value == ""){
        error(userName, "El campo es obligatorio, debes escribir tu nombre");
        correct = false
    }else{
        let re_name = /^[a-zA-ZÀ-ÿ\s]{2,50}$/;
        if(!re_name.test(userName.value)){
            error(userName, "El nombre solo puede contener letras");
            correct = false;
        }else{
            success(userName);
        }
    }

    if(userSubname.value == null || userSubname.value == ""){
        error(userSubname, "El campo es obligatorio, debes escribir tu nombre");
        correct = false;
    }else{
        let re_subname = /^[a-zA-ZÀ-ÿ\s]{2,50}$/;
        if(!re_subname.test(userSubname.value)){
            error(userSubname, 'El campo solo puede contener letras');
            correct = false;
        }else{
            success(userSubname);
        }
    }

    if(userPhone.value == null || userPhone.value == ''){
        error(userPhone, "El campo es obligatorio, debes escribir tu teléfono");
        correct = false;
    }else{
        let re_phone = /^[0-9]{9}$/;
        if(!re_phone.test(userPhone.value)){
            error(userPhone, "El campo solo puede contener números");
            correct = false;
        }else{
            success(userPhone);
        }
    }

    if(userbirthDate.value == null || userbirthDate.value == ''){
        error(userbirthDate, "Es obligatorio indicar la fecha de nacimiento");
        correct = false;
    }else{
        success(userbirthDate)
    }
    
    if(userPassword.value == null || userPassword.value == ''){
        error(userPassword, "Debes escribir una contraseña");
    }else{
        success(userPassword);
    }

    if(userSex.value == ''){
        error(userSex, "Debes elegir tu sexo");
        correct = false;
    }else{
        success(userSex)
    }

    if(!privacy.checked){
        error(privacy, 'No nos intentes pasar la guardia... ¡Debes aceptar los términos y condiciones!')
        correct = false;
    }

    if(correct == true){
        return true;
    }else{
        return false;
    }
    
};

function error(input, message){
    let formControl = input.parentElement;
    let small = formControl.querySelector("small");
    
    if (small) {
        small.innerText = message;
        small.classList.add("form-error"); // 
    }

    formControl.classList.add('form-error');
    formControl.classList.remove('form-correct');
}


function success(input){
    let formControl = input.parentElement;
    let small = formControl.querySelector("small");

    if (small) {
        small.innerText = "";
        small.classList.remove("form-error");
    }

    formControl.classList.add('form-correct');
    formControl.classList.remove('form-error');
}
