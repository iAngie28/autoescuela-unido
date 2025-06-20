@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const radioPaquete = document.getElementById('pago_paquete');
    const radioGrupo = document.getElementById('pago_grupo');
    const selectPaquete = document.getElementById('select_paquete');
    const selectGrupo = document.getElementById('select_grupo');
    const paqueteSelect = document.getElementById('paquete_id');
    const categoriaSelect = document.getElementById('categoria_id');
    const montoInput = document.getElementById('monto');

    function resetMonto() {
        montoInput.value = '';
    }

    radioPaquete.addEventListener('change', function () {
        if (this.checked) {
            selectPaquete.classList.remove('d-none');
            selectGrupo.classList.add('d-none');
            categoriaSelect.value = '';
            resetMonto();
        }
    });

    radioGrupo.addEventListener('change', function () {
        if (this.checked) {
            selectGrupo.classList.remove('d-none');
            selectPaquete.classList.add('d-none');
            paqueteSelect.value = '';
            resetMonto();
        }
    });

    paqueteSelect.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        montoInput.value = selected.getAttribute('data-monto') || '';
    });

    categoriaSelect.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        montoInput.value = selected.getAttribute('data-monto') || '';
    });
});
</script>
@endpush
