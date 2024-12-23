<div class="row">
    <a class="col-lg-3">
        <div class="card bg-info">
            <div class="card-body">
                <div class="d-flex no-block">
                    <div class="m-r-20 align-self-center"><img src="{{ asset('backend/assets/images/icon/expense-w.png') }}" alt="Income"></div>
                    <div class="align-self-center">
                        <h6 class="text-white m-t-10 m-b-0">Derechos Reales</h6>
                        <h2 class="m-t-0 text-white">{{ $totales['derechosReales'] }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </a>
    <a class="col-lg-3">
        <div class="card bg-success">
            <div class="card-body">
                <div class="d-flex no-block">
                    <div class="m-r-20 align-self-center"><img src="{{ asset('backend/assets/images/icon/expense-w.png') }}" alt="Income"></div>
                    <div class="align-self-center">
                        <h6 class="text-white m-t-10 m-b-0">Jueces y Secretarios</h6>
                        <h2 class="m-t-0 text-white">{{ $totales['sentenciasJudiciales'] }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </a>
    <a class="col-lg-3">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="d-flex no-block">
                    <div class="m-r-20 align-self-center"><img src="{{ asset('backend/assets/images/icon/expense-w.png') }}" alt="Income"></div>
                    <div class="align-self-center">
                        <h6 class="text-white m-t-10 m-b-0">Notarios de Fe Pública</h6>
                        <h2 class="m-t-0 text-white">{{ $totales['informeNotarial'] }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </a>
    <a class="col-lg-3">
        <div class="card bg-danger">
            <div class="card-body">
                <div class="d-flex no-block">
                    <div class="m-r-20 align-self-center"><img src="{{ asset('backend/assets/images/icon/expense-w.png') }}" alt="Income"></div>
                    <div class="align-self-center">
                        <h6 class="text-white m-t-10 m-b-0">SEPREC</h6>
                        <h2 class="m-t-0 text-white">{{ $totales['empresas'] }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>