<x-guest-layout>
    <div class="max-w-md mx-auto mt-10">
        @if (session('mensaje'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('mensaje') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verificar') }}">
            @csrf
            <input type="hidden" name="email" value="{{ old('email', $email) }}">
        
            <div>
                <label for="code" class="block text-sm text-gray-700 mb-2">Código de verificación</label>
                <input type="text" id="code" name="code" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
            </div>
        
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">
                Verificar Cuenta
            </button>
        </form>
        
    </div>
</x-guest-layout>
