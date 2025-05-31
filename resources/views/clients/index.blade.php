<x-layouts.app>
    <div class="p-4 lg:p-6 flex-grow">
        <div class="mb-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Gerenciamento de Clientes</h1>
                <a href="{{ route('clients.create') }}" class="inline-flex items-center justify-center gap-2 bg-blue-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-700 rounded-md shadow transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 w-full sm:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Novo Cliente
                </a>
            </div>
            
            <div class="w-full">
                <div class="bg-white dark:bg-zinc-900 overflow-hidden rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if (session('success'))
                            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded" role="alert">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p>{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif

                        <div class="overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-zinc-800">
                                        <tr>
                                            <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nome</th>
                                            <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden md:table-cell">Site</th>
                                            <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                            <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden lg:table-cell">API Key</th>
                                            <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-zinc-900 divide-y divide-gray-200 dark:divide-gray-700">
                                        @forelse ($clients as $client)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50 transition">
                                                <td class="px-4 sm:px-6 py-4">
                                                    <div class="font-medium text-gray-900 dark:text-white">{{ $client->name }}</div>
                                                    <div class="text-sm text-gray-500 dark:text-gray-400 md:hidden">
                                                        @if ($client->site)
                                                            <a href="{{ $client->site }}" target="_blank" class="text-blue-600 hover:underline">
                                                                {{ Str::limit($client->site, 30) }}
                                                            </a>
                                                        @else
                                                            <span class="text-gray-400">Sem site</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="px-4 sm:px-6 py-4 hidden md:table-cell">
                                                    @if ($client->site)
                                                        <a href="{{ $client->site }}" target="_blank" class="text-blue-600 hover:underline">
                                                            {{ Str::limit($client->site, 30) }}
                                                        </a>
                                                    @else
                                                        <span class="text-gray-400">N/A</span>
                                                    @endif
                                                </td>
                                                <td class="px-4 sm:px-6 py-4">
                                                    @if ($client->status === 'active')
                                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-green-500"></span>
                                                            Ativo
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                                                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-red-500"></span>
                                                            Inativo
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-4 sm:px-6 py-4 hidden lg:table-cell">
                                                    <div class="flex items-center">
                                                        <span class="text-xs bg-gray-100 dark:bg-zinc-800 p-1.5 rounded font-mono truncate max-w-[180px]">
                                                            {{ substr($client->api_key, 0, 12) }}...
                                                        </span>
                                                        <button onclick="copyToClipboard('{{ $client->api_key }}')" class="ml-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none" title="Copiar API Key">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="px-4 sm:px-6 py-4 text-sm font-medium">
                                                    <div class="flex gap-3">
                                                        <a href="{{ route('clients.edit', $client) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 transition flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 sm:mr-1">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                            </svg>
                                                            <span class="hidden sm:inline">Editar</span>
                                                        </a>

                                                        <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition flex items-center focus:outline-none" 
                                                                onclick="return confirm('Tem certeza que deseja excluir este cliente?')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 sm:mr-1">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                </svg>
                                                                <span class="hidden sm:inline">Excluir</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                                    <div class="flex flex-col items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mb-4 text-gray-400">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                                        </svg>
                                                        <p class="mb-2">Nenhum cliente encontrado.</p>
                                                        <a href="{{ route('clients.create') }}" class="text-blue-600 hover:underline font-medium">
                                                            Adicionar um novo cliente
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
