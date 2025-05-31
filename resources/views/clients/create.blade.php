<x-layouts.app>
    <div class="p-4 lg:p-6 flex-grow">
        <div class="mb-5 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Criar Novo Cliente</h1>
                <a href="{{ route('clients.index') }}" class="inline-flex items-center gap-2 bg-gray-600 dark:bg-gray-700 px-4 py-2 text-sm font-medium text-white hover:bg-gray-700 dark:hover:bg-gray-600 rounded-md shadow transition focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-zinc-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                    Voltar
                </a>
            </div>    <div class="w-full">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-zinc-900 overflow-hidden rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('clients.store') }}" class="space-y-6">
                        @csrf

                        <!-- Nome -->
                        <div>
                            <x-input-label for="name" :value="__('Nome')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Site -->
                        <div>
                            <x-input-label for="site" :value="__('Site')" />
                            <x-text-input id="site" class="block mt-1 w-full" type="url" name="site" :value="old('site')" placeholder="https://exemplo.com" />
                            <x-input-error :messages="$errors->get('site')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="border-gray-300 dark:border-zinc-600 dark:bg-zinc-800/80 dark:text-gray-100 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-md shadow-sm block mt-1 w-full">
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Ativo</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inativo</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>                        <!-- API Key Note -->
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-md border border-blue-100 dark:border-blue-900">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-500 dark:text-blue-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3 text-sm text-blue-700 dark:text-blue-400">
                                    <p>Uma API Key <span class="font-semibold">SHA-256</span> será gerada automaticamente quando o cliente for criado.</p>
                                </div>
                            </div>
                        </div>                        <div class="flex flex-col sm:flex-row items-center justify-end mt-8 gap-3">
                            <a href="{{ route('clients.index') }}" class="w-full sm:w-auto px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white bg-gray-100 dark:bg-zinc-800/80 hover:bg-gray-200 dark:hover:bg-zinc-700 rounded-md transition text-center border border-gray-200 dark:border-zinc-700">
                                Cancelar
                            </a>
                            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-blue-600 dark:bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700 dark:hover:bg-blue-700 rounded-md shadow transition focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:ring-offset-2 dark:focus:ring-offset-zinc-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Criar Cliente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</x-layouts.app>
