<?php
$title = "The Zen Club - Inicio";
$description = "Escuela de artes marciales, especializada en Jiu Jitsu brasileño";
$keywords = "escuela, bjj, jiu jitsu, jiu jitsu brasileño, brazilian jiu jitsu, las palmas, academia artes marciales, artes marciales";

include __DIR__ . '/../includes/header.php';
?>
        <main class="main">
            <article class="articulo">
                <h1>Nuestros horarios</h1>

                <p><strong>Nuestros horarios están diseñados para adaptarse a todos los niveles y edades, en un ambiente responsable y familiar.</strong></p>

                <p>En nuestro dojo, el Jiu Jitsu se practica con compromiso y respeto, fomentando la mejora continua y la camaradería.</p>

                <p>Los lunes y miércoles, las clases de adultos se dividen en grupos de principiantes y avanzados, para que cada alumno pueda progresar a su ritmo.</p>

                <p>El horario completo está siempre disponible, pero puedes usar el selector para ver solo las clases que más te interesan: infantil, juveniles, adultos o MMA. Así encontrarás fácilmente el horario que mejor se adapte a ti.</p>

                <label for="selectSchedule">Selecciona el horario: </label>
                <select name="selectSchedule" id="selectSchedule">
                    <option value="completo">Horario Completo</option>
                    <option value="infantil">BJJ Infantil</option>
                    <option value="juveniles">BJJ Juveniles</option>
                    <option value="adultos">BJJ Adultos</option>
                    <option value="mma">MMA</option>
                </select>

                <div id="schedule-table" class="schedule-table"></div>
            </article>
        </main>

        <?php include __DIR__ . '/../includes/footer.php'; ?>
    </div>
    <script src="../js/hamburguesa.js"></script>
    <script src="../js/schedule.js"></script>
</body>
</html>
