@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Completa tu suscripción</div>

                <div class="card-body">
                    <div id="wallet_container"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SDK MercadoPago.js -->
<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const mp = new MercadoPago('{{ $public_key }}', {
        locale: 'es-MX'
    });
    
    mp.bricks().create("wallet", "wallet_container", {
        initialization: {
            preferenceId: "{{ $preference_id }}"
        }
    });
</script>
@endsection