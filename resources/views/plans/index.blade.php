    <div class="container py-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3>Plan Básico</h3>
                </div>
                <div class="card-body">
                    <h4>$299 MXN/mes</h4>
                    <ul>
                        <li>10 usuarios</li>
                        <li>Soporte básico</li>
                        <li>5GB almacenamiento</li>
                    </ul>
                    <form action="{{ route('subscribe') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan_id" value="basic">
                        <button type="submit" class="btn btn-primary">Suscribirse</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Repetir para otros planes -->
    </div>
</div>