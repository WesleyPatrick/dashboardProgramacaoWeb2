<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tipos de Contato') }}
            </h2>
            <a href="{{ route('tipocontatos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Novo Tipo de Contato
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                    <div id="success-message" class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-md">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ session('success') }}
                        </div>
                    </div>
                    <script>
                        setTimeout(() => {
                            const successMessage = document.getElementById('success-message');
                            if (successMessage) {
                                successMessage.style.display = 'none';
                            }
                        }, 5000);
                    </script>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($tipocontatos as $tipocontato)
                        <div class="bg-gray-50 rounded-lg shadow-md hover:shadow-lg transition duration-300 overflow-hidden">
                            <div class="p-5 border-b border-gray-200">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-semibold text-gray-800 cursor-pointer"
                                        onclick="exibe('descricao-{{ $tipocontato->id }}')">
                                        {{ $tipocontato->nome }}
                                    </h3>
                                    <div class="flex space-x-2">
                                        <a href="{{ url("tipocontatos") }}/{{ $tipocontato->id }}/edit"
                                            class="bg-green-600 hover:bg-green-700 text-white text-sm font-bold py-1 px-2 rounded transition duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <button onclick="confirmDelete('{{ $tipocontato->id }}')"
                                            class="bg-red-600 hover:bg-red-700 text-white text-sm font-bold py-1 px-2 rounded transition duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                        <form id="form-tipocontatos-excluir-{{$tipocontato->id}}"
                                            action="{{route('tipocontatos.destroy',$tipocontato->id)}}"
                                            method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="descricao-{{ $tipocontato->id }}" class="p-5 bg-white descricao" style="display: none;">
                                <p class="text-gray-700">
                                    {{ $tipocontato->descricao ?: 'Nenhuma descrição disponível.' }}
                                </p>
                                <div class="mt-3 text-xs text-gray-500">
                                    <p>Criado em: {{ $tipocontato->created_at->format('d/m/Y H:i') }}</p>
                                    <p>Atualizado em: {{ $tipocontato->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if(count($tipocontatos) == 0)
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="mt-2 text-gray-500">Nenhum tipo de contato cadastrado.</p>
                        <a href="{{ route('tipocontatos.create') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                            Criar o primeiro
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function exibe(id) {
            var descricao = document.getElementById(id);
            if (descricao.style.display === "none") {
                descricao.style.display = "block";
            } else {
                descricao.style.display = "none";
            }
        }

        function confirmDelete(id) {
            if (confirm('Tem certeza que deseja excluir este tipo de contato? Esta ação não pode ser desfeita.')) {
                document.getElementById('form-tipocontatos-excluir-' + id).submit();
            }
        }
    </script>
</x-app-layout>