// Pequeño JS para cambiar el input y mostrar/ocultar la password

const inputPw = document.getElementById("password");
const eyeImg = document.querySelector(".eye img");

eyeImg.addEventListener("click", () => {
  if (inputPw.type === "password") {
    inputPw.type = "text";
    eyeImg.src = "../assets/icons/svg/closed-eye.svg"; // ojo cerrado
  } else {
    inputPw.type = "password";
    eyeImg.src = "../assets/icons/svg/eye.svg"; // ojo abierto
  }
});
