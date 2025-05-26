<x-guest-layout>
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md bg-white shadow-md rounded-lg p-8">
            <h2 class="text-2xl font-bold mb-6 text-center">Verifica tu Correo Electrónico</h2>
            
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('verificar.email') }}" autocomplete="on" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm text-gray-700 mb-2">Código de Verificación</label>
                    <input type="text" name="verification_code" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                           placeholder="Ingresa el código de 6 dígitos"
                           required>
                    @error('verification_code')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <input type="hidden" name="email" value="{{ session('registered_email') }}">

                <button type="submit" 
                        class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-colors duration-300">
                    Verificar Código
                </button>

                <p class="text-sm text-gray-600 text-center mt-4">
                    ¿No recibiste el código? 
                    <a href="{{ route('register') }}" class="text-blue-500 hover:underline">
                        Volver al registro
                    </a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout> 