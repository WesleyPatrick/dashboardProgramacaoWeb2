@csrf
@if(isset($tipocontato))
@method('PUT')
@endif

<div class="mb-6">
    <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Nome: <span class="text-red-500">*</span></label>
    <input type="text" name="nome" id="nome"
        class="shadow-sm appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
        value="{{ $defaultValues['nome'] }}" required>
    <p class="text-xs text-gray-500 mt-1">O nome deve ser único e ter no máximo 80 caracteres.</p>
</div>

<div class="mb-6">
    <label for="descricao" class="block text-gray-700 text-sm font-bold mb-2">Descrição:</label>
    <textarea name="descricao" id="descricao" rows="4"
        class="shadow-sm appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ $defaultValues['descricao'] }}</textarea>
    <p class="text-xs text-gray-500 mt-1">Forneça uma descrição detalhada para este tipo de contato (opcional).</p>
</div>

<div class="flex items-center justify-between">
    <a href="{{ route('tipocontatos.index') }}"
        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
        Cancelar
    </a>
    <button type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ isset($tipocontato) ? 'Atualizar' : 'Salvar' }}
        </div>
    </button>
</div>