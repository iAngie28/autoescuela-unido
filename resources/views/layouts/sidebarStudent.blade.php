<div class="flex flex-col w-64 bg-gray-800 transition-all duration-300 ease-in-out h-full">
    <div class="flex flex-col flex-1 overflow-y-auto">
        <nav class="flex-1 px-2 py-4 bg-gray-800">
            <a href="{{ url('/estudiante/dashboard') }}"
                class="flex items-center px-4 py-2 text-white hover:bg-gray-700 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 group-hover:transform group-hover:rotate-90"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                Inicio
            </a>

            <!-- GESTIONAR USUARIOS -->
            <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold">ADMINISTRAR USUARIOS
            </li>
            <a href="#" class="flex items-center px-4 py-2 text-white hover:bg-gray-700 group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="group-hover:hidden h-6 w-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="hidden group-hover:block h-6 w-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                Editar Perfil
            </a>

            <!-- GESTIONAR INSCRIPCIÓN SIN SUB-MENÚ -->
            <div class="mb-2 relative">
                <label class="px-12 py-2 text-xs flex items-center uppercase tracking-wider text-gray-500 font-bold">
                    GESTIONAR INSCRIPCIÓN
                </label>

                <a href="{{ url('/clase-est') }}" class="block px-4 py-2 hover:bg-gray-200 text-white">Clases</a>
                <a href={{ route('coursesPay.index') }} class="block px-4 py-2 hover:bg-gray-200 text-white">Pagar Clases</a>
            </div>


            <!-- SEGUIMIENTO DEL PROGRESO -->

            <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold">SEGUIMIENTO DEL PROGRESO
            </li>
            <a href="{{ route('estudiante.mis-evaluaciones') }}"
                class="flex items-center px-4 py-2 mt-2 text-white hover:bg-gray-700 group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-6 w-6 mr-2 group-hover:hidden">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="hidden group-hover:block h-6 w-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                </svg>

                Mis Evaluaciones

            </a>

            <!-- PAGOS Y NOTIFICACIONES SIN SUB-MENÚ -->
            <div class="mb-2 relative">
                <label class="px-12 py-2 text-xs flex items-center uppercase tracking-wider text-gray-500 font-bold">
                    PAGOS Y NOTIFICACIONES
                </label>

                <a href="{{ route('estudiante.mis-pagos') }}" class="block px-4 py-2 hover:bg-gray-200 text-white">Mis Pagos</a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-200 text-white">Notificaciones</a>
            </div>

        </nav>
    </div>
</div>
