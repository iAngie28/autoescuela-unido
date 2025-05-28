     <aside class="w-64 bg-gray-800 min-h-screen pt-16">
         <div
             class="py-3 text-2xl uppercase text-center tracking-widest bg-gray-900 border-b-2 border-gray-800 mb-8 flex items-center">
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
                     <a class="py-3 flex items-center" href="{{ url('/admin/dashboard') }}">
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
                     <a class="py-3 flex items-center" href="{{ route('register') }}">
                         <span class="material-symbols-outlined">person_add</span>

                         Registrar Usuarios
                     </a>
                 </li>
                 <li class="px-4 cursor-pointer hover:bg-gray-700">
                     <a class="py-3 flex items-center" href="{{ route('register') }}">
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
                     <a class="py-3 flex items-center" href="{{ url('/tipo-vehiculos') }}">
                         <span class="material-symbols-outlined">
                             traffic_jam
                         </span>
                         Tipo de Vehiculo
                     </a>
                 </li>
                 <li class="px-4 cursor-pointer hover:bg-gray-700">
                     <a class="py-3 flex items-center" href="{{ url('/tipo-vehiculos') }}">
                         <span class="material-symbols-outlined mr-3">directions_car</span>
                         Vehículos
                     </a>
                 </li>

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
     </aside>
