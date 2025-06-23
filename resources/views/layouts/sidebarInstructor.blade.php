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
                  
                 <div class="hidden peer-checked:flex flex-col bg-white text-gray-800 mt-1 transition-all duration-300">
                    <a href="{{ url('/clases/instructor') }}" class="block px-4 py-2 hover:bg-gray-200"> Clases </a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200"> Proximamente </a>
                </div>
                 <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold">SEGUIMIENTO DEL PROGRESO
                 </li>
                 <li class="px-4 cursor-pointer hover:bg-gray-700">
                     <a class="py-3 flex items-center" href="{{ url('/clases/instructor') }}">
                         <span class="material-symbols-outlined">auto_transmission</span>
                         Clases
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
                 <!-- sidebar-instructor.blade.php -->
                <li class="px-4 hover:bg-gray-700">
                    <a href="{{ route('notificaciones.mias') }}" class="py-3 flex items-center">
                        <span class="material-symbols-outlined">notifications</span>
                        Mis Notificaciones
                        @if($notiNoLeidas ?? 0 > 0)
                            <span class="ml-auto bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $notiNoLeidas }}
                            </span>
                        @endif
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
