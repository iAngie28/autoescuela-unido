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
                     <a class="py-3 flex items-center" href="{{ url('/admin/dashboard') }} ">
                         <span class="material-symbols-outlined">
                             emoji_transportation
                         </span>
                         Inicio
                     </a>
                 </li>
                 <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold">ADMINISTRAR USUARIOS
                 </li>
                 <li class="px-4 cursor-pointer hover:bg-gray-700">
                     <a class="py-3 flex items-center" href="{{ url('/users') }}">
                         <span class="material-symbols-outlined mr-3">manage_accounts</span>
                         Usuarios
                     </a>
                 </li>
                 <li class="px-4 cursor-pointer hover:bg-gray-700">
                     <a class="py-3 flex items-center" href="{{ url('/rols') }}">
                         <span class="material-symbols-outlined">
                             user_attributes
                         </span>
                         Roles
                     </a>
                 </li>
                 <li class="px-4 cursor-pointer hover:bg-gray-700">
                     <a class="py-3 flex items-center" href="{{ route('users.create') }}" target="_blank">
                         <span class="material-symbols-outlined">person_add</span>

                         Registrar Usuarios
                     </a>
                 </li>
                 <li class="px-4 cursor-pointer hover:bg-gray-700">
                     <a class="py-3 flex items-center" href="{{ route('bitacora.index') }}">
                         <span class="material-symbols-outlined">
                             storage
                         </span>

                         Bitácora de Usuarios
                     </a>
                 </li>
                 <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold">GESTIONAR INSCRIPCIÓN
                 </li>
                 </li>
                 <li class="px-4 cursor-pointer hover:bg-gray-700">
                     <a class="py-3 flex items-center" href="{{ url('/clases') }}">
                         <span class="material-symbols-outlined">
                             auto_transmission
                         </span>
                         Clases
                     </a>
                 </li>
                 <li class="px-4 cursor-pointer hover:bg-gray-700">
                     <a class="py-3 flex items-center" href="{{ url('/asignar_clase') }}">
                         <span class="material-symbols-outlined">
                             auto_transmission
                         </span>
                         Inscribir Estudiante a clase
                     </a>
                 </li>
                 <li class="px-4 cursor-pointer hover:bg-gray-700">
                     <a class="py-3 flex items-center" href="{{ url('/grupo-examen/asignar-estudiante') }}">
                         <span class="material-symbols-outlined">
                             auto_transmission
                         </span>
                        Inscribir a Grupo
                     </a>
                 </li>
                 <li class="px-4 cursor-pointer hover:bg-gray-700">
                     <a class="py-3 flex items-center" href="{{ url('/clase-reprogramar') }}">
                         <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                             fill="#e3e3e3" class="w-4 mr-3">
                             <path
                                 d="M200-80q-33 0-56.5-23.5T120-160v-560q0-33 23.5-56.5T200-800h40v-80h80v80h320v-80h80v80h40q33 0 56.5 23.5T840-720v200h-80v-40H200v400h280v80H200Zm0-560h560v-80H200v80Zm0 0v-80 80ZM560-80v-123l221-220q9-9 20-13t22-4q12 0 23 4.5t20 13.5l37 37q8 9 12.5 20t4.5 22q0 11-4 22.5T903-300L683-80H560Zm300-263-37-37 37 37ZM620-140h38l121-122-18-19-19-18-122 121v38Zm141-141-19-18 37 37-18-19Z" />
                         </svg>
                         Reprogramar Clase
                     </a>
                 </li>
                 <li class="px-4 cursor-pointer hover:bg-gray-700">
                     <a class="py-3 flex items-center" href="{{ url('/tipo-vehiculos') }}">
                         <span class="material-symbols-outlined">
                             traffic_jam
                         </span>
                         Tipo de Vehiculo
                     </a>
                 </li>
                 <li class="px-4 cursor-pointer hover:bg-gray-700">
                     <a class="py-3 flex items-center" href="{{ url('/vehiculos') }}">
                         <span class="material-symbols-outlined mr-3">directions_car</span>
                         Vehículos
                     </a>
                 </li>
                <li class="px-4 cursor-pointer hover:bg-gray-700">
                     <a class="py-3 flex items-center" href="{{ url('/asignar_vehiculo') }}">
                         <span class="material-symbols-outlined mr-3">directions_car</span>
                        Asignar Vehículos
                     </a>
                 </li>

                 <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold">SEGUIMIENTO DEL PROGRESO
                 </li>
                 <li class="px-4 hover:bg-gray-700">
                     <a href="/grupo-examen" class="py-3 flex items-center">
                         <span class="material-symbols-outlined">
                             hourglass_bottom
                         </span>
                        Grupos
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
                     <a href="/pagos" class="py-3 flex items-center">
                         <span class="material-symbols-outlined">
                             payments
                         </span>
                         Pagos
                     </a>
                 </li>
                 <li class="px-4 hover:bg-gray-700">
                     <a href="/paquetes" class="py-3 flex items-center">
                         <span class="material-symbols-outlined">
                             payments
                         </span>
                         Paquetes
                     </a>
                 </li>
                 <li class="px-4 hover:bg-gray-700">
                     <a href="/examen-categoria-aspiras" class="py-3 flex items-center">
                         <span class="material-symbols-outlined">
                             payments
                         </span>
                         Categorias
                     </a>
                 </li>
             </ul>
         </nav>