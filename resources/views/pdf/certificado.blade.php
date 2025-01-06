<style>
    .titulo-recibo {
        text-align: center;
        font-weight: bold;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    th,
    td {
        padding: 8px;
        text-align: center;
    }

    th {
        font-size: 12px;
        text-transform: uppercase;
    }

    .footer {
        margin-top: 5px;
        text-align: left;
    }

    .verificado {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -150%);
        opacity: 0.1;
        font-size: 45px;
        color: #9c9c9c;
        z-index: -1;
    }

    .img-escudo {
        width: 50px;
        text-align: center;
    }

    .img-logo1 {
        width: 100px;
        text-align: center;
    }

    .img-logo2 {
        width: 100px;
        text-align: center;
    }

    .img-logo3 {
        width: 100px;
        text-align: center;
    }


    .titulo-main span {
        text-align: center;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .seccion-alquiler {
        text-align: center;
        text-transform: uppercase;
        margin-bottom: 5px;
        font-size: 13px;
    }

    .datos-persona {
        font-size: 12px;
        text-align: left;
        text-transform: uppercase;

    }

    .datos-persona__titulo {
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 100px !important;
    }

    .datos-persona__datos {
        font-weight: normal !important;
        text-transform: uppercase;
    }

    .seccion-descripcion td {
        border: 1px solid #b4b3b3;
    }

    .precio-total {
        font-weight: bold;
        text-transform: uppercase;
        font-size: 14px;
    }

    .total-nro {
        font-weight: bold;
        font-size: 16px;
    }
</style>

</head>

<body>
    <!-- Tamaño de ancho de la hoja es 660px -->
    <!-- Encabezado titulo -->
    <table>
        <tr>
            <th style="width: 220px;">
                @php
                $imagePath = public_path('img/logo1.png');
                $imageData = base64_encode(file_get_contents($imagePath));
                $imageSrc = 'data:image/png;base64,' . $imageData;
                @endphp
                <img class="img-logo1" src="{{ $imageSrc }}" alt="Escudo gamdc">
            <th style="width: 220px;">
                @php
                $imagePath = public_path('img/logo2.png');
                $imageData = base64_encode(file_get_contents($imagePath));
                $imageSrc = 'data:image/png;base64,' . $imageData;
                @endphp
                <img class="img-logo2" src="{{ $imageSrc }}" alt="Logo gamdc">
            </th>
            <th style="width: 220px;">
                @php
                $imagePath = public_path('img/logo3.png');
                $imageData = base64_encode(file_get_contents($imagePath));
                $imageSrc = 'data:image/png;base64,' . $imageData;
                @endphp
                <img class="img-logo3" src="{{ $imageSrc }}" alt="Logo gamdc">
            </th>
        </tr>
        <tr>
            <td colspan="3" class="titulo-main">
                <span>CONSTANCIA DE PRESENTACIÓN</span><br>
                <span>{{ $certificado->tipoAgente}}</span><br>
                <span>(DECRETO DEPARTAMENTAL N° 4666)</span><br>
            </td>
        </tr>
    </table>
    <hr>

    <table>
        <tr>
            <th style="width: 180px;">

            <th style="width: 300px;">
                <span class="datos-persona__titulo" style="font-size: 16px;">DATOS AGENTE DE INFORMACIÓN</span>
            </th>
            <th style="width: 180px;">

            </th>
        </tr>
    </table>


    <!-- Datos del agente -->
    <table class="seccion-descripcion">
        <tr>
            <td class="datos-persona__titulo">NOMBRE COMPLETO</td>
            <td class="datos-persona__datos">{{ $certificado->nombres }}</td>
        </tr>
        <tr>
            <td class="datos-persona__titulo">CÉDULA DE IDENTIDAD</td>
            <td class="datos-persona__datos">{{ $certificado->cedula }}</td>
        </tr>
        <tr>
            <td class="datos-persona__titulo">{{ $certificado->tipoAgente }}</td>
            <td class="datos-persona__datos">{{ $certificado->descripcionAgente }}</td>
        </tr>
        <tr>
            <td class="datos-persona__titulo">JURISDICCIÓN O MUNICIPIO</td>
            <td class="datos-persona__datos">{{ $certificado->municipio }}</td>
        </tr>
        <tr>
            <td class="datos-persona__titulo">PERIODO</td>
            <td class="datos-persona__datos">{{ $certificado->periodo }}</td>
        </tr>
        <tr>
            <td class="datos-persona__titulo">FECHA Y HORA DE PRESENTACIÓN</td>
            <td class="datos-persona__datos">{{ $certificado->fechaHora }}</td>
        </tr>
    </table>
    <hr>
    <table>
        <tr>
            <th style="width: 150px;">

            <th style="width: 360px;">
                <span class="datos-persona__titulo" style="font-size: 16px;">RESUMEN DEL INFORME PRESENTADO</span>
            </th>
            <th style="width: 150px;">

            </th>
        </tr>
    </table>

    <table class="seccion-descripcion">
        <tr>
            <td class="datos-persona__titulo">CANTIDAD DE REGISTROS</td>
            <td class="datos-persona__datos">{{ $certificado->cantidadRegistros }}</td>
        </tr>
        <tr>
            <td class="datos-persona__titulo">OBSERVACIÓN</td>
            <td class="datos-persona__datos">{{ $verificacion->observacion }}</td>
        </tr>
        <tr>
            <td class="datos-persona__titulo">NÚMERO DE CONSTANCIA</td>
            <td class="datos-persona__datos">{{ $verificacion->constancia }}</td>
        </tr>
    </table>
</body>