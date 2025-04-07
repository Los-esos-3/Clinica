@if(session('verification_sent'))
<div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
    <div class="flex items-start">
        <svg class="h-5 w-5 text-blue-500 mt-1 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
            <p class="font-medium text-blue-800">Verificación requerida</p>
            <p class="text-sm text-blue-600 mt-1">
                Hemos enviado un código a <span class="font-semibold">{{ session('registered_email') }}</span>.
                Revise su bandeja de entrada y spam.
            </p>
        </div>
    </div>
</div>
@endif

<form method="POST" action="{{ route('verificar.email') }}">
    @csrf
    <input type="hidden" name="email" value="{{ $email ?? old('email') }}">
    
    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Código de verificación</label>
        <input type="text" name="verification_code" 
               class="w-full px-3 py-2 border rounded-md @error('verification_code') border-red-500 @enderror"
               required autofocus>
        @error('verification_code')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">
        Verificar Cuenta
    </button>
</form>