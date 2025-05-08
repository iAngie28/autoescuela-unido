<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FullCalendar CSS y JS desde el CDN consolidado -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>

    <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm sticky-top" style="background-color: #111827;">
        <div class="container-fluid">
            <a href="{{ url('/estudiante/dashboard') }}" class="navbar-brand d-flex align-items-center">
                <h2 class="m-0 text-primary"><i class="fa fa-car me-2"></i>WUILLANS</h2>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="{{ url('/estudiante/dashboard') }}" class="nav-link active text-white">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="about.html" class="nav-link text-white">Sobre Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a href="courses.html" class="nav-link text-white">Cursos</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle text-white" id="menuDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Menú</a>
                        <ul class="dropdown-menu" aria-labelledby="menuDropdown">
                            <li><a href="feature.html" class="dropdown-item">Features</a></li>
                            <li><a href="appointment.html" class="dropdown-item">Appointment</a></li>
                            <li><a href="team.html" class="dropdown-item">Our Team</a></li>
                            <li><a href="testimonial.html" class="dropdown-item">Testimonial</a></li>
                            <li><a href="404.html" class="dropdown-item">404 Page</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="https://web.whatsapp.com/" class="nav-link text-white">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido del Calendario -->
    <div class="container mx-auto mt-5">
        <h1 class="text-2xl font-bold mb-4">Calendario de Clases</h1>
        <div id="calendar"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                events: [
                    {
                        title: 'Clase de Manejo',
                        start: '2025-05-10',
                        end: '2025-05-10',
                    },
                    {
                        title: 'Clase Teórica',
                        start: '2025-05-12',
                        end: '2025-05-12',
                    },

                    {
                        title: 'Clase de Conduccion Ismael',
                        start: '2025-05-12',
                        end: '2025-05-16',
                    },
                ],
            });
            calendar.render();
        });
    </script>
</body>
</html>
