document.addEventListener('DOMContentLoaded', () => {
  const container = document.querySelector('.schedule-table');
  const select = document.getElementById('selectSchedule');
  let dataGlobal = null;

  fetch('/assets/data/schedule.json')
    .then(res => res.json())
    .then(data => {
      dataGlobal = data;
      showTable(dataGlobal, 'completo');  // ¡Aquí debe ser "completo" con la o!
    })
    .catch(() => {
      container.textContent = 'Error cargando datos';
    });

  select.addEventListener('change', () => {
    showTable(dataGlobal, select.value);
  });

  function cleanContainer() {
    while (container.firstChild) {
      container.removeChild(container.firstChild);
    }
  }

  function showTable(data, filter) {
    console.log('Filtro recibido en showTable:', `"${filter}"`);
    filter = filter.trim().toLowerCase();
    cleanContainer();
    if (!data) return;

    const table = createTableSchedule(data, filter);
    container.appendChild(table);
  }

  function createTableSchedule(data, filter) {
    const { days, hours, schedule } = data;
    const table = document.createElement('table');

    // Crear encabezado
    const thead = document.createElement('thead');
    const trHead = document.createElement('tr');
    trHead.appendChild(document.createElement('th')); // esquina vacía
    days.forEach(day => {
      const th = document.createElement('th');
      th.textContent = day;
      trHead.appendChild(th);
    });
    thead.appendChild(trHead);
    table.appendChild(thead);

    // Crear cuerpo de tabla con horas y clases filtradas
    const tbody = document.createElement('tbody');
    hours.forEach(hour => {
      const tr = document.createElement('tr');

      // Primera columna con la hora
      const thHour = document.createElement('th');
      thHour.textContent = hour;
      tr.appendChild(thHour);

      days.forEach(day => {
        const td = document.createElement('td');
        const clase = schedule[day]?.[hour] || '';
        const claseLower = clase.toLowerCase();

        if (filter === 'completo' || (claseLower.includes(filter) && clase !== '')) {
          td.textContent = clase;
        } else {
          td.textContent = '';
        }
        tr.appendChild(td);
      });

      tbody.appendChild(tr);
    });

    table.appendChild(tbody);
    return table;
  }
});
