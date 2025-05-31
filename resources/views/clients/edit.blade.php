<x-layouts.app>
    <div class="p-4 lg:p-6 flex-grow">
        <div class="mb-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Editar Cliente: <span class="text-blue-600 dark:text-blue-400">{{ $client->name }}</span>
            </h1>
                <a href="{{ route('clients.index') }}" class="inline-flex items-center justify-center gap-2 bg-gray-600 dark:bg-gray-700 px-4 py-2.5 text-sm font-medium text-white hover:bg-gray-700 dark:hover:bg-gray-600 rounded-md shadow transition focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-zinc-800 w-full sm:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                    Voltar
                </a>
            </div>
            <div class="w-full">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-zinc-900 overflow-hidden rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-700 text-green-800 dark:text-green-300 p-4 mb-6 rounded-lg shadow-sm" role="alert">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3 text-green-600 dark:text-green-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('clients.update', $client) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Nome -->
                        <div>
                            <x-input-label for="name" :value="__('Nome')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $client->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Site -->
                        <div>
                            <x-input-label for="site" :value="__('Site')" />
                            <x-text-input id="site" class="block mt-1 w-full" type="url" name="site" :value="old('site', $client->site)" placeholder="https://exemplo.com" />
                            <x-input-error :messages="$errors->get('site')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="border-gray-300 dark:border-zinc-600 dark:bg-zinc-800/80 dark:text-gray-100 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-md shadow-sm block mt-1 w-full">
                                <option value="active" {{ old('status', $client->status) == 'active' ? 'selected' : '' }}>Ativo</option>
                                <option value="inactive" {{ old('status', $client->status) == 'inactive' ? 'selected' : '' }}>Inativo</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>                        <!-- API Key -->
                        <div>
                            <label for="api_key" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">API Key</label>
                            <div class="mb-2">
                                <div class="relative w-full">
                                    <div class="flex flex-col sm:flex-row items-stretch w-full overflow-hidden rounded-md shadow-sm">
                                        <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400 dark:text-gray-400">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                                                </svg>
                                            </div>
                                            <input type="text" name="api_key" id="api_key" 
                                                class="font-mono bg-gray-50 dark:bg-zinc-800/80 border-gray-300 dark:border-zinc-600 text-gray-900 dark:text-gray-100 focus:border-blue-500 dark:focus:border-blue-400 block w-full sm:rounded-l-md rounded-md sm:rounded-r-none shadow-sm pl-10 py-2.5 text-sm overflow-x-auto" 
                                                value="{{ $client->api_key }}" readonly 
                                                onclick="this.select();" 
                                                style="padding-right: 10px; min-width: 300px;">
                                        </div>
                                        <button type="button" 
                                            onclick="copyToClipboard('{{ $client->api_key }}')" 
                                            class="mt-2 sm:mt-0 sm:relative sm:-ml-px inline-flex items-center justify-center rounded-md sm:rounded-l-none sm:rounded-r-md border border-gray-300 dark:border-zinc-600 bg-gray-50 dark:bg-zinc-700/80 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-zinc-600 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-gray-600 dark:text-blue-400">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184" />
                                            </svg>
                                            Copiar
                                        </button>
                                    </div>
                                </div>
                            </div>                                <div class="mt-3">
                                    <a href="#" class="flex items-center text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 focus:outline-none hover:bg-blue-50 dark:hover:bg-blue-900/20 py-1.5 px-2 rounded-md transition-all" 
                                        onclick="event.preventDefault(); if(confirm('Tem certeza? Isso invalidará a API Key atual e pode afetar integrações existentes.')) document.getElementById('regenerate-form').submit();">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                        </svg>
                                        Regenerar API Key
                                    </a>
                                </div>
                        </div>                        <div class="flex flex-col sm:flex-row items-center justify-end mt-8 gap-3">
                            <a href="{{ route('clients.index') }}" class="w-full sm:w-auto px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white bg-gray-100 dark:bg-zinc-800/80 hover:bg-gray-200 dark:hover:bg-zinc-700 rounded-md transition text-center border border-gray-200 dark:border-zinc-700">
                                Cancelar
                            </a>
                            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-blue-600 dark:bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700 dark:hover:bg-blue-700 rounded-md shadow transition focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:ring-offset-2 dark:focus:ring-offset-zinc-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                                Atualizar Cliente
                            </button>
                        </div>
                    </form>
                    
                    <!-- Formulário separado para regenerar a API key -->
                    <form id="regenerate-form" action="{{ route('clients.regenerate-api-key', $client) }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                const notification = document.createElement('div');
                notification.className = 'fixed bottom-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-md z-50';
                notification.innerHTML = '<p class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>API Key copiada com sucesso!</p>';
                document.body.appendChild(notification);
                setTimeout(() => {
                    notification.remove();
                }, 3000);
            }, function() {
                alert('Não foi possível copiar a API Key');
            });
        }
    </script>
</x-layouts.app>
