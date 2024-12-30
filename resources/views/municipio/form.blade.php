@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row padding-1 p-1">
    <div class="col-12 col-md-8 col-lg-4">
        <label for="provincia" class="form-label">Provincia<span class="text-danger">*</span></label>
        <select name="provincia" class="form-control @error('provincia') is-invalid @enderror mb-2 mb20" id="provincia">
            <option value="" disabled selected>Selecciona una provincia</option>
            @foreach($provincias as $provincia)
            <option value="{{ $provincia }}" {{ old('provincia', $municipio?->provincia) == $provincia ? 'selected' : '' }}>
                {{ $provincia }}
            </option>
            @endforeach
        </select>

        <label for="nombre" class="form-label">Municipio<span class="text-danger">*</span></label>
        <select name="nombre" class="form-control @error('nombre') is-invalid @enderror mb-2 mb20" id="nombre">
            <option value="" disabled selected>Selecciona una provincia primero</option>
        </select>
    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Guardar </button>
    </div>
</div>

<script>
    // Objeto con provincias y municipios
    const provinciasYMunicipios = {
        "Arani": ["Arani", "Vacas"],
        "Arque": ["Arque", "Tacopaya"],
        "Ayopaya": ["Independencia", "Morochata", "Cocapata"],
        "Bolívar": ["Bolívar"],
        "Campero": ["Aiquile", "Omereque", "Pasorapa"],
        "Capinota": ["Capinota", "Santiváñez", "Sicaya"],
        "Carrasco": ["Totora", "Pocona", "Pojo", "Entre Ríos"],
        "Cercado": ["Cochabamba"],
        "Chapare": ["Villa Tunari", "Shinahota", "Puerto Villarroel", "Chimoré"],
        "Esteban Arze": ["Tarata", "Anzaldo", "Arbieto", "Sacabamba"],
        "Germán Jordán": ["Cliza", "Tolata", "Vila Vila"],
        "Mizque": ["Mizque", "Alalay"],
        "Punata": ["Punata", "San Benito", "Tacachi", "Cuchumuela", "Villa Martín"],
        "Quillacollo": ["Quillacollo", "Tiquipaya", "Vinto", "Sipe Sipe", "Colcapirhua"],
        "Tapacarí": ["Tapacarí"],
        "Tiraque": ["Tiraque"]
    };

    // Referencias a los selects
    const provinciaSelect = document.getElementById('provincia');
    const municipioSelect = document.getElementById('nombre');

    // Evento para cargar municipios al seleccionar una provincia
    provinciaSelect.addEventListener('change', function() {
        const provinciaSeleccionada = this.value;

        // Limpiar municipios existentes
        municipioSelect.innerHTML = '<option value="" disabled selected>Selecciona un municipio</option>';


        // Obtener municipios de la provincia seleccionada
        console.log(provinciaSeleccionada);
        console.log(provinciasYMunicipios);


        console.log(provinciasYMunicipios[provinciaSeleccionada]);

        if (provinciasYMunicipios[provinciaSeleccionada]) {
            provinciasYMunicipios[provinciaSeleccionada].forEach(municipio => {
                const option = document.createElement('option');
                option.value = municipio;
                option.textContent = municipio;
                municipioSelect.appendChild(option);
            });
        }
    });
</script>