@extends('layouts.app')

@section('content')
<div class="flex flex-col min-h-screen">
    <div class="flex flex-1">

        <!-- Sidebar -->

        <aside class="hidden w-64 bg-gray-800 md:block min-h-screen">
            <div
                class="py-3 text-2xl uppercase text-center tracking-widest bg-gray-900 border-b-2 border-gray-800 mb-8 flex items-center">
                <img class="rounded-lg" alt="Ismael image" src="https://pagedone.io/asset/uploads/1701235464.png" />
                <div class="text-right">
                    <p class="text-white font-semibold text-sm">{{ Auth::user()->name }}</p>
                    <p class="text-gray-400 text-xs text-center" style="padding-left: 15px;">
                        {{ Auth::user()->rol->nombre }}
                    </p>
                </div>

            </div>
            <nav class="text-sm text-gray-300">
                <ul class="flex flex-col">
                    <li class="px-4 cursor-pointer bg-gray-500 text-gray-800 hover:bg-gray-700  hover:text-white">
                        <a class="py-3 flex items-center" href="{{ url('/admin/dashboard') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>

                            Inicio
                        </a>
                    </li>
                    <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold">GESTIÓN DE USUARIOS
                    </li>
                    
                    </li>
                    <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold">GESTIÓN ACADEMICA
                    </li>
                    </li>
                    <li class="px-4 cursor-pointer hover:bg-gray-700">
                        <a class="py-3 flex items-center" href="{{ url('/clases') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                            </svg>
                            Clases
                        </a>
                    </li>
                    
                    <li class="px-4 cursor-pointer hover:bg-gray-700">
                        <a href="#" class="py-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>

                            Calendar
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Contenido principal -->
        <main class="flex-1 bg-gray-100 text-gray-800 p-6">
            <section class="bg-white-500 text-black py-10 text-center">
                <h1 class="text-3xl font-bold text-left mb-"> Clases</h1>

                <div class="flex flex-wrap items-center justify-between mb-6 " style="margin-top: 20px;">
                    <select id="filtroEstado" class="form-select" onchange="filtrarPorEstado()">
                        <option value="">Todos</option>
                        <option value="programada">Programada</option>
                        <option value="cancelada">Cancelada</option>
                    </select>

                    <a href="{{ route('clases.create') }}" target="_blank">
                        <button
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">
                            Agregar Nueva Clase
                        </button>
                    </a>
                </div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success m-4">
                    <p>{{ $message }}</p>
                </div>
                @endif


                <script>
                    function filtrarPorEstado() {
                        const estadoSeleccionado = document.getElementById('filtroEstado').value.toLowerCase();
                        const filas = document.querySelectorAll('table tbody tr');

                        filas.forEach(fila => {
                            const estado = fila.dataset.estado;
                            if (!estadoSeleccionado || estado === estadoSeleccionado) {
                                fila.style.display = '';
                            } else {
                                fila.style.display = 'none';
                            }
                        });
                    }
                </script>



                <!-- Roles Table -->
                <div class="overflow-x-auto bg-white rounded-lg shadow">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">ID</th>
                                <th class="py-3 px-6 text-left">Fecha</th>
                                <th class="py-3 px-6 text-left">Hora Inicio</th>
                                <th class="py-3 px-6 text-center">Hora Fin</th>
                                <th class="py-3 px-6 text-center">Estado</th>
                                <th class="py-3 px-6 text-center">Comentario Instructor</th>
                                <th class="py-3 px-6 text-center">Reporte</th>
                                <th class="py-3 px-6 text-center">Id Paquete</th>
                                <th class="py-3 px-6 text-center">Id Instructor</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">
                            @foreach ($clases as $clase)
                            <tr data-estado="{{ strtolower($clase->estado) }}" class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">{{ $clase->id }}</td>
                                <td class="py-3 px-6 text-left">{{ $clase->hora_inicio}}</td>
                                <td class="py-3 px-6 text-left">{{  $clase->hora_fin}}</td>
                                <td class="py-3 px-6 text-left">{{ $clase->estado}}</td>
                                <td class="py-3 px-6 text-left">{{$clase->comentario_Inst }}</td>
                                <td class="py-3 px-6 text-left">{{ $clase->reporte_estudiante }}</td>
                                <td class="py-3 px-6 text-left">{{  $clase->id_paquete }}</td>
                                <td class="py-3 px-6 text-left">{{ $clase->id_inst }}</td>

                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('clases.edit', $clase->id) }}"
                                            class="text-blue-500 hover:scale-110">📝 Editar</a>
                                        <form action="{{ route('clases.destroy', $clase->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:scale-110" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;">🗑
                                                Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $clases->withQueryString()->links() }}
                </div>
            </section>

        </main>

    </div>

    <!-- Footer -->

    <footer class="bg-gray-900 text-white pt-12 pb-8">
        <div class="w-full px-6">
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-12 gap-y-8 mb-8 justify-items-start md:justify-items-center">
                <!-- Company Info -->
                <div class="space-y-4" style="padding-top: 15px;">
                    <div class="flex items-center">
                        <svg class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="ml-2 text-xl font-bold">Company</span>
                    </div>
                    <p class="text-gray-400">Building innovative solutions for the modern world.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <span class="sr-only">LinkedIn</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="space-y-4" style="padding-top: 15px;">
                    <h3 class="text-lg font-semibold">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Services</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Pricing</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Blog</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="space-y-4" style="padding-top: 15px;">
                    <h3 class="text-lg font-semibold">Services</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Web Development</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Mobile Apps</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">UI/UX Design</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Digital Marketing</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Cloud Solutions</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm mb-4 md:mb-0">© 2025 Company. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-500 hover:text-white text-sm transition">Privacy Policy</a>
                    <a href="#" class="text-gray-500 hover:text-white text-sm transition">Terms of Service</a>
                    <a href="#" class="text-gray-500 hover:text-white text-sm transition">Cookies</a>
                </div>
            </div>
    </footer>
</div>

@endsection