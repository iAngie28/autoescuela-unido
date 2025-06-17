         <div
             class="py-3 mt-2 text-2xl uppercase text-center tracking-widest bg-gray-900 border-b-2 border-gray-800 mb-2 flex items-center">
             <img class="rounded-lg" alt="Ismael image" src="https://pagedone.io/asset/uploads/1701235464.png" />
             <div class="text-right">
                 <p class="text-white font-semibold text-sm">{{ Auth::user()->name }}</p>
                 <p class="text-gray-400 text-xs text-center" style="padding-left: 15px;">
                     {{ Auth::user()->rol->nombre }}</p>
             </div>

         </div>
         <nav class="text-sm text-gray-300">
             <ul class="flex flex-col">
                 <li class="px-4 cursor-pointer bg-gray-500 text-gray-800 hover:bg-gray-700  hover:text-white">
                     <a class="py-3 flex items-center" href="{{ url('/instructor/dashboard') }}">
                         <span class="material-symbols-outlined">
                             emoji_transportation
                         </span>
                         Inicio
                     </a>
                 </li>
                 <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold">ADMINISTRAR USUARIOS
                 </li>
                 <li class="px-4 cursor-pointer hover:bg-gray-700">
                     <a class="py-3 flex items-center" href="{{ route('profile') }}">
                         <span class="material-symbols-outlined mr-3">manage_accounts</span>
                         Editar Perfil
                     </a>
                 </li>
                 <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold">GESTIONAR INSCRIPCIÓN
                 </li>
                 </li>
                 <li class="px-4 cursor-pointer hover:bg-gray-700">
                     <a class="py-3 flex items-center" href="{{ route('instructor.students') }}">
                         <span class="material-symbols-outlined">auto_transmission</span>
                         Lista de Estudiantes
                     </a>
                 </li>

                 <li class="px-4 cursor-pointer hover:bg-gray-700">
                     <a class="py-3 flex items-center" href="{{ route('instructor.historial') }}">
                         <span class="material-symbols-outlined">auto_transmission</span>
                         Historial de Evaluaciones
                     </a>
                 </li>
<div class="flex flex-col w-64 bg-gray-800 transition-all duration-300 ease-in-out h-full">
    <div class="flex flex-col flex-1 overflow-y-auto">
        <nav class="flex-1 px-2 py-4 bg-gray-800">
            <a href="{{ url('/instructor/dashboard') }}" class="flex items-center px-4 py-2 text-gray-100 hover:bg-gray-700 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 group-hover:transform group-hover:rotate-90"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                Inicio
            </a>

            <!-- GESTIONAR USUARIOS -->
            <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold">ADMINISTRAR USUARIOS
            </li>
            <a href="#" class="flex items-center px-4 py-2 text-gray-100 hover:bg-gray-700 group">
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

            <!-- GESTIONAR INSCRIPCION CON SUB-MENÚ -->
            <div class="mb-2 relative group">
                <input type="checkbox" id="messages-toggle" class="hidden peer">

                <label for="messages-toggle"
                    class="px-12 py-2 text-xs flex items-center uppercase tracking-wider text-gray-500 font-bold flex">
                    GESTIONAR INSCRIPCIÓN
                </label>


                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor"
                    class="absolute top-2 left-4 text-white group-hover:hidden h-6 w-6 mr-2 peer-checked:hidden">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor"
                    class="absolute top-2 left-4 text-white hidden group-hover:block peer-checked:block h-6 w-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98V19.5Z" />
                </svg>


                <!-- sub-menu de GESTIONAR INSCRIPCION -->
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 ml-auto transition-transform transform peer-checked:rotate-180 absolute right-4 top-3 transform #dis--translate-y-1/2 text-white"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>

                <div class="hidden peer-checked:flex flex-col bg-white text-gray-800 mt-1 transition-all duration-300">
                    <a href="{{ url('/clases/instructor') }}" class="block px-4 py-2 hover:bg-gray-200"> Clases </a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200"> Proximamente </a>
                </div>
            </div>


            <!-- SEGUIMIENTO DEL PROGRESO -->

                 <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold">SEGUIMIENTO DEL PROGRESO
                 </li>
                 <li class="px-4 hover:bg-gray-700">
                     <a href="#" class="py-3 flex items-center">
                         <span class="material-symbols-outlined">
                             hourglass_bottom
                         </span>
                         Proximamente
                     </a>
                 </li>
                 <li class="px-4 hover:bg-gray-700">
                     <a href="#" class="py-3 flex items-center">
                         <span class="material-symbols-outlined">
                             hourglass_bottom
                         </span>
                         Proximamente
                     </a>
                 </li>
                 <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold">PAGOS Y NOTIFICACIONES
                 </li>
                 <li class="px-4 hover:bg-gray-700">
                     <a href="#" class="py-3 flex items-center">
                         <span class="material-symbols-outlined">
                             notifications
                         </span>
                         Notificaciones
                     </a>
                 </li>
                 <li class="px-4 hover:bg-gray-700">
                     <a href="#" class="py-3 flex items-center">
                         <span class="material-symbols-outlined">
                             payments
                         </span>
                         Pagos
                     </a>
                 </li>
             </ul>
         </nav>
