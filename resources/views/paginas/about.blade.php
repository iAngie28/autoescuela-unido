<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>AUTOESCUELA</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}"rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset("lib/animate/animate.min.css")}}" rel="stylesheet">
    <link href="{{ asset("lib/owlcarousel/assets/owl.carousel.min.css")}} "rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark text-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small>Av. Centenario 22</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <small class="far fa-clock text-primary me-2"></small>
                    <small>Lun - Vie : 08.00 AM - 12.00 PM & 13.00 PM - 18.00 PM</small>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>75004675</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center mx-n2">
                    <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary"
                        href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href=""><i
                            class="fab fa-twitter"></i></a>
                    <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href=""><i
                            class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-square btn-link rounded-0" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
            <h2 class="m-0"><i class="fa fa-car text-primary me-2"></i>WUILLANS</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ url('/') }}" class="nav-item nav-link">Inicio</a>
                <a href="{{ url('/about') }}" class="nav-item nav-link active">Sobre Nosotros</a>
                <a href="{{ url('/cursos') }}" class="nav-item nav-link">CURSOS</a>
                <a href="https://web.whatsapp.com/" class="nav-item nav-link" target="_blank" rel="noopener noreferrer">
                    Contacto
                </a>
            </div>
            @if (Route::has('login'))
                @auth
                    @php
                        // Definir la ruta del Dashboard según el rol del usuario
                        $dashboardRoute = '#'; // Valor por defecto

                        if (Auth::user()->id_rol === 1) {
                            $dashboardRoute = url('/admin/dashboard'); // Dashboard de Administrador
                        } elseif (Auth::user()->id_rol === 2) {
                            $dashboardRoute = url('/estudiante/dashboard'); // Dashboard de Estudiante
                        } elseif (Auth::user()->id_rol === 3) {
                            $dashboardRoute = url('/instructor/dashboard'); // Dashboard de Instructor
                        }
                    @endphp

                    <!-- Botón dinámico al dashboard según el rol -->
                    <a href="{{ $dashboardRoute }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">
                        Dashboard<i class="fa fa-arrow-right ms-3"></i>
                    </a>
                @else
                    <!-- Botón para Log in -->
                    <a href="{{ route('login') }}"
                        class="btn btn-primary px-lg-4 py-lg-3 px-md-3 py-md-2 px-sm-2 py-sm-1 d-inline-block" style="height:70px;margin-left: 10px;">
                        Log in<i class="fa fa-arrow-right ms-2"></i>
                    </a>

                @endauth
            @endif
    </nav>
    <!-- Navbar End -->


    <!-- About Start -->
    <div class="container-xxl py-3">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative overflow-hidden ps-5 pt-5 h-100" style="min-height: 400px;">
                        <img class="position-absolute w-100 h-100" src="img/about-1.jpg" alt=""
                            style="object-fit: cover;">
                        <img class="position-absolute top-0 start-0 bg-white pe-3 pb-3" src="img/about-2.jpg"
                            alt="" style="width: 200px; height: 200px;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <h6 class="text-primary text-uppercase mb-2">SOBRE NOSOTROS</h6>
                        <h1 class="display-6 mb-4">Ayudamos a los estudiantes a aprobar el examen y obtener su licencia a la primera</h1>
                        <p>En WUILLANS, nos dedicamos a formar conductores responsables, seguros y confiables. Con años de experiencia en educación vial, ofrecemos un aprendizaje práctico y eficiente para que nuestros estudiantes adquieran las habilidades necesarias para conducir con confianza.

                        </p>
                        <p class="mb-4">Nos esforzamos por ofrecer una enseñanza moderna con vehículos equipados y tecnología avanzada para un entrenamiento óptimo. Además, nuestro enfoque personalizado permite que cada estudiante aprenda a su propio ritmo, en un ambiente seguro y de apoyo.</p>
                        <div class="row g-2 mb-4 pb-2">
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Licencia Totalmente Aprobada
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Seguimiento Personalizado
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Tarifa Asequible
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Instructores Capacitados
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <a class="d-inline-flex align-items-center btn btn-outline-primary border-2 p-2"
                                    href="tel:+0123456789">
                                    <span class="flex-shrink-0 btn-square bg-primary">
                                        <i class="fa fa-phone-alt text-white"></i>
                                    </span>
                                    <span class="px-3">75004675</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->




    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer my-6 mb-0 py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5 justify-content-between">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Ponte en Contacto</h4>
                    <h2 class="text-primary mb-4"><i class="fa fa-car text-white me-2"></i>Wuillans</h2>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Av. Centenario 22</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>75004267</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>Wuillans@hotmail.com</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Contactanos</h4>
                    <a class="btn btn-link" href="">Sobre Nosotros</a>
                    <a class="btn btn-link" href="">Contáctanos</a>
                    <a class="btn btn-link" href="">Nuestros Servicios</a>

                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Recibi Noticias</h4>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control p-3 border-0" placeholder="Correo Electrónico">
                            <button class="btn btn-primary">Suscribirse</button>
                        </div>
                    </form>
                    <h6 class="text-white mt-4 mb-3">Síguenos</h6>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light me-1" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light me-1" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light me-1" href=""><i
                                class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light me-0" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright text-light py-4 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a href="#">Wuillans</a>, Todos los derechos reservados.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Diseñado Por <a href="">Grupo 9 - Si1</a>

                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
