<x-layouts.app>
    <div class="min-h-screen bg-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <div class="mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900 mb-1">
                        Logs de Atividade
                    </h1>
                    <p class="text-sm text-gray-600">Registro de todas as atividades realizadas no sistema</p>
                </div>

                <!-- Filtros -->
                <form method="GET" action="{{ route('admin.activity-logs.index') }}" class="mb-6 bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Ação</label>
                            <select name="action" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all text-sm bg-white">
                                <option value="">Todas</option>
                                @foreach($actions as $action)
                                    <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                                        {{ ucfirst($action) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Tipo de Modelo</label>
                            <select name="model_type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all text-sm bg-white">
                                <option value="">Todos</option>
                                @foreach($modelTypes as $modelType)
                                    <option value="{{ $modelType }}" {{ request('model_type') == $modelType ? 'selected' : '' }}>
                                        {{ class_basename($modelType) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Data Inicial</label>
                            <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all text-sm bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Data Final</label>
                            <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all text-sm bg-white">
                        </div>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-orange-600 text-white font-medium rounded-md hover:bg-orange-700 transition-colors duration-150 text-sm">
                            Filtrar
                        </button>
                        <a href="{{ route('admin.activity-logs.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 transition-colors duration-150 text-sm">
                            Limpar
                        </a>
                    </div>
                </form>

                <!-- Tabela de Logs -->
                <div class="overflow-x-auto border border-gray-200 rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Modelo</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Ação</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Descrição</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">IP</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Data</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($logs as $log)
                                <tr class="hover:bg-gray-50 transition-colors duration-100">
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $log->id }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                        <span class="font-medium">{{ class_basename($log->model_type) }}</span> 
                                        <span class="text-gray-500">#{{ $log->model_id }}</span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded 
                                            @if($log->action == 'created') bg-green-50 text-green-700 border border-green-200
                                            @elseif($log->action == 'updated') bg-yellow-50 text-yellow-700 border border-yellow-200
                                            @else bg-red-50 text-red-700 border border-red-200
                                            @endif">
                                            {{ ucfirst($log->action) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $log->description }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 font-mono">{{ $log->ip_address }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                        {{ $log->created_at->format('d/m/Y H:i:s') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <p class="text-sm text-gray-500 font-medium">Nenhum log encontrado</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginação -->
                <div class="mt-4 flex justify-center">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
