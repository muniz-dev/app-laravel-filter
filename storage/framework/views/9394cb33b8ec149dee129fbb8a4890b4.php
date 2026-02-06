<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="min-h-screen bg-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <div class="mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900 mb-1">
                        Logs de Pesquisa
                    </h1>
                    <p class="text-sm text-gray-600">Registro de todas as pesquisas realizadas no sistema</p>
                </div>

                <!-- Estatísticas -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-600 font-medium mb-1">Total de Pesquisas</p>
                                <p class="text-2xl font-semibold text-gray-900"><?php echo e(number_format($totalSearches)); ?></p>
                            </div>
                            <div class="w-10 h-10 bg-orange-100 rounded flex items-center justify-center">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-600 font-medium mb-1">Média de Resultados</p>
                                <p class="text-2xl font-semibold text-gray-900"><?php echo e($avgResultsCount); ?></p>
                            </div>
                            <div class="w-10 h-10 bg-orange-100 rounded flex items-center justify-center">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-600 font-medium mb-1">Termo Mais Pesquisado</p>
                                <p class="text-sm font-semibold text-gray-900">
                                    <?php echo e($mostSearchedTerm ? $mostSearchedTerm->search_term . ' (' . $mostSearchedTerm->count . 'x)' : 'N/A'); ?>

                                </p>
                            </div>
                            <div class="w-10 h-10 bg-orange-100 rounded flex items-center justify-center">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filtros -->
                <form method="GET" action="<?php echo e(route('admin.search-logs.index')); ?>" class="mb-6 bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Termo de Pesquisa</label>
                            <input type="text" name="search_term" value="<?php echo e(request('search_term')); ?>" 
                                placeholder="Digite o termo..." 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all text-sm bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Data Inicial</label>
                            <input type="date" name="date_from" value="<?php echo e(request('date_from')); ?>" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all text-sm bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Data Final</label>
                            <input type="date" name="date_to" value="<?php echo e(request('date_to')); ?>" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all text-sm bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Mín. Resultados</label>
                            <input type="number" name="min_results" value="<?php echo e(request('min_results')); ?>" 
                                placeholder="0" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all text-sm bg-white">
                        </div>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-orange-600 text-white font-medium rounded-md hover:bg-orange-700 transition-colors duration-150 text-sm">
                            Filtrar
                        </button>
                        <a href="<?php echo e(route('admin.search-logs.index')); ?>" class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 transition-colors duration-150 text-sm">
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
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Termo</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Filtros</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Resultados</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">IP</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Data</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-gray-50 transition-colors duration-100">
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo e($log->id); ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-900">
                                        <span class="font-medium"><?php echo e($log->search_term ?? '-'); ?></span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-900">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($log->filters): ?>
                                            <div class="flex flex-wrap gap-1.5">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($log->filters['categories']) && count($log->filters['categories']) > 0): ?>
                                                    <span class="px-2 py-1 bg-orange-50 text-orange-700 text-xs font-medium rounded border border-orange-200">
                                                        <?php echo e(count($log->filters['categories'])); ?> cat.
                                                    </span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($log->filters['brands']) && count($log->filters['brands']) > 0): ?>
                                                    <span class="px-2 py-1 bg-orange-50 text-orange-700 text-xs font-medium rounded border border-orange-200">
                                                        <?php echo e(count($log->filters['brands'])); ?> marcas
                                                    </span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-gray-400">-</span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                        <span class="px-2 py-1 bg-orange-50 text-orange-700 rounded font-medium border border-orange-200">
                                            <?php echo e($log->results_count); ?>

                                        </span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 font-mono"><?php echo e($log->ip_address); ?></td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo e($log->created_at->format('d/m/Y H:i:s')); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
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
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Paginação -->
                <div class="mt-4 flex justify-center">
                    <?php echo e($logs->links()); ?>

                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/admin/search-logs/index.blade.php ENDPATH**/ ?>