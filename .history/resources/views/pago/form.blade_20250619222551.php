<div class="row p-1">
    <div class="col-md-12">
        <!-- Select de Estudiante -->
        <div class="mb-3">
            <label for="id_est" class="form-label">Estudiante</label>
            <select name="id_est" id="id_est" class="form-select @error('id_est') is-invalid @enderror">
                <option value="">Seleccione un estudiante</option>
                @foreach ($usuariosEstudiantes as $usuario)
                    @if ($usuario->estudiante)
                        <option value="{{ $usuario->estudiante->id }}">
                            {{ $usuario->name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <!-- Tipo de pago -->
        <div class="mb-3">
            <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de pago</label>
            <div id="tipo-pago-opciones" class="flex items-center gap-4">
                <label for="pago_paquete"
                    class="radio-label inline-flex items-center px-4 py-2 border rounded cursor-pointer text-gray-700 border-gray-300 transition">
                    <input type="radio" name="tipo_pago" id="pago_paquete" value="paquete" class="hidden">
                    Paquete
                </label>
                <label for="pago_grupo"
                    class="radio-label inline-flex items-center px-4 py-2 border rounded cursor-pointer text-gray-700 border-gray-300 transition">
                    <input type="radio" name="tipo_pago" id="pago_grupo" value="grupo" class="hidden">
                    Grupo
                </label>
            </div>
        </div>

        <!-- Select de Paquetes -->
        <div class="mb-3 hidden" id="select_paquete">
            <label for="paquete_id" class="form-label">Seleccione un paquete</label>
            <select name="paquete_id" id="paquete_id" class="form-select">
                <option value="">Seleccione un paquete</option>
                @foreach ($paquetes as $paquete)
                    <option value="{{ $paquete->id }}" data-monto="{{ $paquete->costo }}">
                        {{ $paquete->cant_class }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Select de Categorías -->
        <div class="mb-3 hidden" id="select_grupo">
            <label for="categoria_id" class="form-label">Seleccione una categoría</label>
            <select name="categoria_id" id="categoria_id" class="form-select">
                <option value="">Seleccione una categoría</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" data-monto="{{ $categoria->costo }}">
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Descuento -->
        <div class="mb-3">
            <label for="descuento" class="form-label">Descuento (Bs)</label>
            <input type="number" name="descuento" id="descuento" min="0" value="0" class="form-control">
        </div>

        <!-- Monto (visible pero no editable) alineado a la derecha -->
        <div class="mb-3 d-flex justify-content-end text-end">
            <div>
                <label class="form-label">Monto</label>
                <p id="monto" class="text-lg font-semibold text-gray-800 bg-gray-100 border rounded px-3 py-2">
                    Bs 0.00
                </p>
            </div>
        </div>



        <!-- Botón -->
        <div class="mt-3">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition duration-200">
                Registrar pago
            </button>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radioPaquete = document.getElementById('pago_paquete');
        const radioGrupo = document.getElementById('pago_grupo');
        const selectPaquete = document.getElementById('select_paquete');
        const selectGrupo = document.getElementById('select_grupo');
        const paqueteSelect = document.getElementById('paquete_id');
        const categoriaSelect = document.getElementById('categoria_id');
        const montoTexto = document.getElementById('monto'); // Usamos un <p> ahora
        const radioLabels = document.querySelectorAll('.radio-label');

        function resetMonto() {
            montoTexto.textContent = 'Bs 0.00';
        }

        function toggleSelects() {
            if (radioPaquete.checked) {
                selectPaquete.classList.remove('hidden');
                selectGrupo.classList.add('hidden');
                categoriaSelect.value = '';
            } else if (radioGrupo.checked) {
                selectGrupo.classList.remove('hidden');
                selectPaquete.classList.add('hidden');
                paqueteSelect.value = '';
            } else {
                selectPaquete.classList.add('hidden');
                selectGrupo.classList.add('hidden');
                paqueteSelect.value = '';
                categoriaSelect.value = '';
            }
            resetMonto();

            // estilos visuales
            radioLabels.forEach(label => {
                label.classList.remove('bg-gray-200', 'border-gray-400', 'text-gray-900');
                label.classList.add('border-gray-300', 'text-gray-700');
            });
            if (radioPaquete.checked) {
                document.querySelector('label[for="pago_paquete"]').classList.add('bg-gray-200',
                    'border-gray-400', 'text-gray-900');
            }
            if (radioGrupo.checked) {
                document.querySelector('label[for="pago_grupo"]').classList.add('bg-gray-200',
                    'border-gray-400', 'text-gray-900');
            }
        }

        // Inicialización
        toggleSelects();

        // Eventos
        radioPaquete.addEventListener('change', toggleSelects);
        radioGrupo.addEventListener('change', toggleSelects);

        paqueteSelect.addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            montoTexto.textContent = `Bs ${selected.getAttribute('data-monto') || '0.00'}`;
        });

        categoriaSelect.addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            montoTexto.textContent = `Bs ${selected.getAttribute('data-monto') || '0.00'}`;
        });
    });
</script>
