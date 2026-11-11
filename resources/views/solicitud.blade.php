
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Solicitud de seguros estudiantiles</title>

    <!-- FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css"
          rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: #222;
            background: #fff;
        }

        /* ENCABEZADO */

        header {
            height: 110px;
            background: #414d51;
            border-top: 28px solid #189bd0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 5%;
            color: white;
        }

        header h1 {
            font-size: 32px;
            font-weight: 500;
        }

        .logo-placeholder {
            width: 170px;
            height: 65px;
            border: 1px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ddd;
            font-size: 13px;
        }

        /* FORMULARIO */

        main {
            max-width: 1120px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .campo {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 15px;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #d4d4d4;
            border-radius: 8px;
            font-size: 15px;
            background: white;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #189bd0;
        }

        textarea {
            resize: vertical;
            min-height: 90px;
        }

        input:disabled {
            background: #eee;
            cursor: not-allowed;
        }

        /* BUSCADOR DE MATERIAS */

        .materia-container {
            position: relative;
        }

        #resultados-materia {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #ddd;
            border-radius: 6px;
            z-index: 10;
            max-height: 180px;
            overflow-y: auto;
        }

        .opcion-materia {
            padding: 10px;
            cursor: pointer;
        }

        .opcion-materia:hover {
            background: #eaf6fc;
        }

        /* CALENDARIO */

        .calendario-contenedor {
            display: grid;
            grid-template-columns: minmax(280px, 1fr) minmax(280px, 1fr);
            gap: 25px;
            align-items: start;
        }

        #calendario {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px;
            font-size: 13px;
        }

        .fc .fc-button-primary {
            background: #189bd0;
            border-color: #189bd0;
        }

        .fc .fc-button-primary:hover {
            background: #117eac;
        }

        .fc .selected-date {
            background: #cceeff !important;
        }

        .ayuda {
            font-size: 13px;
            color: #666;
            margin: 8px 0 15px;
        }

        /* TARJETAS DE FECHAS */

        #lista-fechas {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .fecha-card {
            width: 235px;
            border: 1px solid #d5d5d5;
            border-radius: 8px;
            padding: 12px;
            position: relative;
        }

        .fecha-card strong {
            display: block;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .fecha-card .horarios {
            display: flex;
            gap: 8px;
        }

        .fecha-card input {
            min-width: 0;
            padding: 8px;
        }

        .fecha-card label {
            font-size: 12px;
            margin-bottom: 5px;
        }

        .eliminar-fecha {
            position: absolute;
            right: 8px;
            top: 7px;
            border: none;
            background: none;
            color: #c33;
            cursor: pointer;
            font-size: 18px;
        }

        /* TABLAS */

        .tabla-contenedor {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 9px;
            text-align: left;
            min-width: 100px;
        }

        th {
            color: #777;
            font-weight: normal;
        }

        td[contenteditable="true"]:focus {
            outline: 2px solid #189bd0;
            outline-offset: -2px;
        }

        .boton-agregar {
            background: white;
            border: 2px solid #aaa;
            border-radius: 6px;
            color: #888;
            font-size: 25px;
            width: 42px;
            height: 42px;
            cursor: pointer;
        }

        .boton-agregar:hover {
            border-color: #189bd0;
            color: #189bd0;
        }

        .tabla-fila {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* BOTONES FINALES */

        .acciones {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 35px;
        }

        .acciones button {
            border: none;
            border-radius: 7px;
            padding: 13px 35px;
            cursor: pointer;
            font-size: 15px;
            color: white;
        }

        .cancelar {
            background: #303030;
        }

        .enviar {
            background: #189bd0;
        }

        @media(max-width: 700px) {
            header h1 {
                font-size: 20px;
            }

            .logo-placeholder {
                width: 100px;
            }

            .calendario-contenedor {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<header>
    <h1>Gestión de solicitud de seguros</h1>

    <!-- Reemplazar por el logo real -->
    <div class="logo-placeholder">
        LOGO UNCAUS
    </div>
</header>

<main>

<form id="formularioSeguro"
      action="{{ route('formulario.store') }}"
      method="POST">

    @csrf

    <!-- CARRERA -->

    <div class="campo">
        <label for="carrera">Carrera</label>

        <select name="carrera" id="carrera" required>
            <option value="">Seleccione una carrera</option>
            <option value="Ingeniería en Sistemas">
                Ingeniería en Sistemas
            </option>
            <option value="Contador Público">
                Contador Público
            </option>
            <option value="Abogacía">
                Abogacía
            </option>
            <option value="Licenciatura en Administración">
                Licenciatura en Administración
            </option>
        </select>
    </div>

    <!-- MATERIA -->

    <div class="campo">
        <label for="materia">Materia</label>

        <div class="materia-container">
            <input type="text"
                   id="materia"
                   name="materia"
                   placeholder="Primero seleccione una carrera"
                   disabled
                   autocomplete="off"
                   required>

            <div id="resultados-materia"></div>
        </div>
    </div>

    <!-- ACTIVIDAD -->

    <div class="campo">
        <label for="actividad">
            Actividad a realizar (detallar brevemente)
        </label>

        <textarea name="actividad"
                  id="actividad"
                  maxlength="255"
                  required></textarea>
    </div>

    <!-- FECHAS -->

    <div class="campo">

        <label>Fechas de las actividades a realizar</label>

        <p class="ayuda">
            Seleccione días individuales haciendo clic sobre ellos,
            o arrastre el cursor para seleccionar un rango de fechas.
        </p>

        <div class="calendario-contenedor">

            <div id="calendario"></div>

            <div>
                <h3>Fechas seleccionadas</h3>

                <p class="ayuda">
                    Puede modificar el horario de cada día
                    individualmente.
                </p>

                <div id="lista-fechas"></div>
            </div>

        </div>

        <!-- Los datos se enviarán como JSON -->
        <input type="hidden"
               name="fechas"
               id="fechas">

    </div>

    <!-- LUGAR -->

    <div class="campo">
        <label for="nom_lugar">
            Nombre del establecimiento/lugar al que asistirán
        </label>

        <input type="text"
               name="nom_lugar"
               id="nom_lugar"
               maxlength="155"
               required>
    </div>

    <!-- DIRECCION -->

    <div class="campo">
        <label for="dir_lugar">
            Dirección del establecimiento/lugar al que asistirán
        </label>

        <input type="text"
               name="dir_lugar"
               id="dir_lugar"
               maxlength="155"
               required>
    </div>

    <!-- ESTUDIANTES -->

    <div class="campo">

        <label>Nómina de estudiantes</label>

        <p class="ayuda">
            Puede escribir directamente en las celdas o pegar
            datos copiados desde Excel o Word.
        </p>

        <div class="tabla-fila">

            <div class="tabla-contenedor" style="flex:1">

                <table id="tabla-estudiantes">

                    <thead>
                        <tr>
                            <th>Nombre completo</th>
                            <th>DNI</th>
                            <th>Domicilio</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td contenteditable="true"></td>
                            <td contenteditable="true"></td>
                            <td contenteditable="true"></td>
                        </tr>
                    </tbody>

                </table>

            </div>

            <button type="button"
                    class="boton-agregar"
                    onclick="agregarFila('tabla-estudiantes')">
                +
            </button>

        </div>

        <input type="hidden"
               name="estudiantes"
               id="estudiantes">

    </div>

    <!-- PROFESORES -->

    <div class="campo">

        <label>Nómina de profesores</label>

        <div class="tabla-fila">

            <div class="tabla-contenedor" style="flex:1">

                <table id="tabla-profesores">

                    <thead>
                        <tr>
                            <th>Nombre completo</th>
                            <th>DNI</th>
                            <th>Domicilio</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td contenteditable="true"></td>
                            <td contenteditable="true"></td>
                            <td contenteditable="true"></td>
                        </tr>
                    </tbody>

                </table>

            </div>

            <button type="button"
                    class="boton-agregar"
                    onclick="agregarFila('tabla-profesores')">
                +
            </button>

        </div>

        <input type="hidden"
               name="profesores"
               id="profesores">

    </div>

    <!-- CORREO -->

    <div class="campo">
        <label for="email">
            Indíquenos su correo electrónico para mantenerlo informado
        </label>

        <input type="email"
               name="email"
               id="email"
               required>
    </div>

    <!-- BOTONES -->

    <div class="acciones">

        <button type="reset" class="cancelar">
            Cancelar
        </button>

        <button type="submit" class="enviar">
            Enviar
        </button>

    </div>

</form>

</main>

<script>

// ==========================================
// 1. CARRERAS Y MATERIAS
// ==========================================

const materiasPorCarrera = {

    "Ingeniería en Sistemas": [
        "Programación I",
        "Programación II",
        "Sistemas Operativos",
        "Bases de Datos",
        "Ingeniería de Software"
    ],

    "Contador Público": [
        "Contabilidad I",
        "Contabilidad II",
        "Auditoría",
        "Matemática Financiera"
    ],

    "Abogacía": [
        "Derecho Civil",
        "Derecho Penal",
        "Derecho Constitucional"
    ],

    "Licenciatura en Administración": [
        "Administración General",
        "Economía",
        "Marketing",
        "Gestión de Recursos Humanos"
    ]

};

const carrera = document.getElementById("carrera");
const materia = document.getElementById("materia");
const resultados = document.getElementById("resultados-materia");

let materiaSeleccionada = false;

carrera.addEventListener("change", function() {

    materia.value = "";
    materiaSeleccionada = false;
    resultados.innerHTML = "";

    materia.disabled = !this.value;

    materia.placeholder = this.value
        ? "Buscar materia..."
        : "Primero seleccione una carrera";

});

materia.addEventListener("input", function() {

    materiaSeleccionada = false;
    mostrarMaterias(this.value);

});

function mostrarMaterias(texto) {

    resultados.innerHTML = "";

    const materias = materiasPorCarrera[carrera.value] || [];

    const coincidencias = materias.filter(m =>
        m.toLowerCase().includes(texto.toLowerCase())
    );

    coincidencias.forEach(nombre => {

        const opcion = document.createElement("div");

        opcion.className = "opcion-materia";
        opcion.textContent = nombre;

        opcion.addEventListener("click", function() {

            materia.value = nombre;
            materiaSeleccionada = true;
            resultados.innerHTML = "";

        });

        resultados.appendChild(opcion);

    });

}

document.addEventListener("click", function(e) {

    if (!materia.contains(e.target) &&
        !resultados.contains(e.target)) {

        resultados.innerHTML = "";

    }

});


// ==========================================
// 2. CALENDARIO Y HORARIOS
// ==========================================

const fechasSeleccionadas = new Map();

const listaFechas = document.getElementById("lista-fechas");

function fechaLocal(fecha) {

    const año = fecha.getFullYear();
    const mes = String(fecha.getMonth() + 1).padStart(2, "0");
    const dia = String(fecha.getDate()).padStart(2, "0");

    return `${año}-${mes}-${dia}`;

}

function agregarFecha(fecha) {

    if (fechasSeleccionadas.has(fecha)) return;

    fechasSeleccionadas.set(fecha, {
        inicio: "08:00",
        fin: "12:00"
    });

    actualizarFechas();

}

function alternarFecha(fecha) {

    if (fechasSeleccionadas.has(fecha)) {

        fechasSeleccionadas.delete(fecha);

    } else {

        agregarFecha(fecha);

    }

    actualizarFechas();

}

function agregarRango(inicio, fin) {

    const actual = new Date(inicio + "T12:00:00");
    const limite = new Date(fin + "T12:00:00");

    while (actual < limite) {

        agregarFecha(fechaLocal(actual));

        actual.setDate(actual.getDate() + 1);

    }

}

function actualizarFechas() {

    listaFechas.innerHTML = "";

    const fechas = Array.from(fechasSeleccionadas.keys())
        .sort();

    fechas.forEach(fecha => {

        const horario = fechasSeleccionadas.get(fecha);

        const fechaBonita = new Date(fecha + "T12:00:00")
            .toLocaleDateString("es-AR", {
                weekday: "long",
                day: "2-digit",
                month: "2-digit",
                year: "numeric"
            });

        const tarjeta = document.createElement("div");

        tarjeta.className = "fecha-card";

        tarjeta.innerHTML = `
            <button type="button"
                    class="eliminar-fecha"
                    aria-label="Eliminar fecha">
                ×
            </button>

            <strong>${fechaBonita}</strong>

            <div class="horarios">

                <div>
                    <label>Hora de salida</label>
                    <input type="time"
                           class="hora-inicio"
                           value="${horario.inicio}">
                </div>

                <div>
                    <label>Hora de llegada</label>
                    <input type="time"
                           class="hora-fin"
                           value="${horario.fin}">
                </div>

            </div>
        `;

        tarjeta.querySelector(".eliminar-fecha")
            .addEventListener("click", () => {

                fechasSeleccionadas.delete(fecha);
                actualizarFechas();

            });

        tarjeta.querySelector(".hora-inicio")
            .addEventListener("change", function() {

                horario.inicio = this.value;

            });

        tarjeta.querySelector(".hora-fin")
            .addEventListener("change", function() {

                horario.fin = this.value;

            });

        listaFechas.appendChild(tarjeta);

    });

    // Mantener sincronizado el calendario
    calendario.render();

}

// Inicializar calendario

const calendario = new FullCalendar.Calendar(
    document.getElementById("calendario"),
    {

        initialView: "dayGridMonth",
        locale: "es",

        selectable: true,
        unselectAuto: true,

        height: "auto",

        buttonText: {
            today: "Hoy",
            month: "Mes"
        },

        dateClick: function(info) {

            alternarFecha(info.dateStr);

        },

        select: function(info) {

            agregarRango(info.startStr, info.endStr);

        },

        dayCellClassNames: function(info) {

            const fecha = fechaLocal(info.date);

            return fechasSeleccionadas.has(fecha)
                ? ["selected-date"]
                : [];

        }

    }
);

calendario.render();


// ==========================================
// 3. TABLAS DINÁMICAS
// ==========================================

function agregarFila(idTabla) {

    const tbody = document.querySelector(
        `#${idTabla} tbody`
    );

    const fila = document.createElement("tr");

    for (let i = 0; i < 3; i++) {

        const celda = document.createElement("td");

        celda.contentEditable = "true";

        fila.appendChild(celda);

    }

    tbody.appendChild(fila);

}


// Pegar desde Excel o Word

document.querySelectorAll("table").forEach(tabla => {

    tabla.addEventListener("paste", function(e) {

        const celda = e.target.closest(
            'td[contenteditable="true"]'
        );

        if (!celda) return;

        e.preventDefault();

        let filas = [];

        // Intentar obtener tabla HTML copiada
        const html = e.clipboardData.getData("text/html");

        if (html && html.includes("<table")) {

            const doc = new DOMParser().parseFromString(
                html, "text/html"
            );

            filas = Array.from(
                doc.querySelectorAll("tr")
            ).map(tr =>
                Array.from(tr.querySelectorAll("th, td"))
                    .map(td => td.innerText)
            );

        } else {

            const texto = e.clipboardData.getData("text/plain");

            filas = texto.trimEnd().split(/\r?\n/).map(f =>
                f.split("\t")
            );

        }

        const tbody = tabla.querySelector("tbody");

        let filaActual = celda.parentElement;
        let columnaInicial = Array.from(
            filaActual.children
        ).indexOf(celda);

        filas.forEach((datos, indice) => {

            let filaDestino = filaActual;

            if (indice > 0) {

                filaDestino = filaActual.nextElementSibling;

                if (!filaDestino) {

                    filaDestino = document.createElement("tr");

                    for (let i = 0; i < 3; i++) {

                        const td = document.createElement("td");
                        td.contentEditable = "true";
                        filaDestino.appendChild(td);

                    }

                    tbody.appendChild(filaDestino);

                }

                filaActual = filaDestino;

            }

            datos.forEach((valor, col) => {

                const destino = filaDestino.children[
                    columnaInicial + col
                ];

                if (destino) {
                    destino.textContent = valor;
                }

            });

        });

    });

});


// ==========================================
// 4. PREPARAR DATOS PARA ENVIAR
// ==========================================

document.getElementById("formularioSeguro")
    .addEventListener("submit", function(e) {

        // Validar materia
        if (!materiaSeleccionada) {

            e.preventDefault();

            alert("Debe seleccionar una materia de la lista.");

            return;

        }

        // Validar fechas
        if (fechasSeleccionadas.size === 0) {

            e.preventDefault();

            alert("Debe seleccionar al menos una fecha.");

            return;

        }

        const fechas = Array.from(fechasSeleccionadas)
            .map(([fecha, horario]) => ({
                fecha: fecha,
                hora_inicio: horario.inicio,
                hora_fin: horario.fin
            }));

        for (const fecha of fechas) {

            if (!fecha.hora_inicio || !fecha.hora_fin ||
                fecha.hora_inicio >= fecha.hora_fin) {

                e.preventDefault();

                alert("Revise los horarios de las fechas seleccionadas.");

                return;

            }

        }

        // Guardar fechas
        document.getElementById("fechas").value =
            JSON.stringify(fechas);

        // Obtener contenido de las tablas
        function obtenerFilas(id) {

            return Array.from(
                document.querySelectorAll(`#${id} tbody tr`)
            )
            .map(fila =>
                Array.from(fila.cells).map(celda =>
                    celda.innerText.trim()
                )
            )
            .filter(fila => fila.some(valor => valor !== ""));

        }

        document.getElementById("estudiantes").value =
            JSON.stringify(obtenerFilas("tabla-estudiantes"));

        document.getElementById("profesores").value =
            JSON.stringify(obtenerFilas("tabla-profesores"));

    });

</script>

</body>
</html>
