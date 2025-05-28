document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById('modal');
  const openBtn = document.getElementById('termsModal');
  const closeBtn = document.getElementById('closeSpan');
  const modalContent = document.getElementById('modal__text');

  openBtn.addEventListener('click', (e) => {
    e.preventDefault();
    modal.style.display = 'block';

    modalContent.textContent = "Cargando...";

    fetch("../assets/data/terms.json")
      .then(res => res.json())
      .then(data => {
        modalContent.textContent = "";

        const ul = document.createElement('ul');

        data.forEach(item => {
          const li = document.createElement('li');
          const strong = document.createElement('strong');

          strong.textContent = item.titulo + ":";
          li.appendChild(strong);
          li.appendChild(document.createElement('br'));
          li.appendChild(document.createTextNode(item.texto));

          ul.appendChild(li);
        });

        modalContent.appendChild(ul);
      })
      .catch(() => {
        modalContent.textContent = "Error de lectura";
      });
  });

  closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  window.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === "Escape") {
      modal.style.display = 'none';
    }
  });
});
