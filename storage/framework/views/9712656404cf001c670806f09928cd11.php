<div class="min-h-screen bg-gray-50">

    <!-- Filtros Section - Full Width -->
    <div class="w-full bg-white border-b border-gray-200 py-10">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 rounded-xl p-8 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900">
                    Filtros de Busca
                </h2>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($name) || !empty($selectedCategories) || !empty($selectedBrands)): ?>
                    <button 
                        wire:click="clearFilters"
                        class="px-5 py-2.5 text-sm font-semibold text-white bg-gray-600 rounded-lg hover:bg-gray-700 transition-all duration-200 shadow-sm hover:shadow"
                    >
                        Limpar Filtros
                    </button>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Nome do Produto -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-3">
                        Nome do Produto
                    </label>
                    <div class="relative">
                        <input 
                            type="text" 
                            id="name"
                            wire:model.live.debounce.300ms="name"
                            placeholder="Buscar por nome..."
                            class="w-full px-4 py-3 pl-11 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 bg-white text-gray-900 placeholder-gray-400 shadow-sm hover:border-gray-300"
                        />
                        <svg class="absolute left-3.5 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Categorias (Multi-select) -->
                <div>
                    <label for="categories" class="block text-sm font-semibold text-gray-700 mb-3">
                        Categorias
                    </label>
                    <div 
                        x-data="{ 
                            open: false
                        }"
                        class="relative"
                    >
                        <button 
                            @click="open = !open"
                            type="button"
                            class="w-full px-4 py-3 text-left border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white hover:border-gray-300 transition-all duration-200 flex items-center justify-between text-gray-900 shadow-sm"
                        >
                            <span class="text-sm font-medium">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedCategories) > 0): ?>
                                    <?php echo e(count($selectedCategories)); ?> selecionada(s)
                                <?php else: ?>
                                    Selecione categorias
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </span>
                            <svg class="w-5 h-5 text-gray-400 transform transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div 
                            x-show="open"
                            @click.away="open = false"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute z-20 mt-2 w-full bg-white border-2 border-gray-200 rounded-lg shadow-xl max-h-60 overflow-auto"
                            style="display: none;"
                        >
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="flex items-center px-4 py-3 hover:bg-orange-50 cursor-pointer transition-colors duration-150 border-b border-gray-100 last:border-b-0">
                                    <input 
                                        type="checkbox"
                                        value="<?php echo e($category->id); ?>"
                                        wire:model.live="selectedCategories"
                                        class="mr-3 w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500"
                                    />
                                    <span class="text-sm font-medium text-gray-700"><?php echo e($category->name); ?></span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Marcas (Multi-select) -->
                <div>
                    <label for="brands" class="block text-sm font-semibold text-gray-700 mb-3">
                        Marcas
                    </label>
                    <div 
                        x-data="{ 
                            open: false
                        }"
                        class="relative"
                    >
                        <button 
                            @click="open = !open"
                            type="button"
                            class="w-full px-4 py-3 text-left border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white hover:border-gray-300 transition-all duration-200 flex items-center justify-between text-gray-900 shadow-sm"
                        >
                            <span class="text-sm font-medium">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedBrands) > 0): ?>
                                    <?php echo e(count($selectedBrands)); ?> selecionada(s)
                                <?php else: ?>
                                    Selecione marcas
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </span>
                            <svg class="w-5 h-5 text-gray-400 transform transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div 
                            x-show="open"
                            @click.away="open = false"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute z-20 mt-2 w-full bg-white border-2 border-gray-200 rounded-lg shadow-xl max-h-60 overflow-auto"
                            style="display: none;"
                        >
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="flex items-center px-4 py-3 hover:bg-orange-50 cursor-pointer transition-colors duration-150 border-b border-gray-100 last:border-b-0">
                                    <input 
                                        type="checkbox"
                                        value="<?php echo e($brand->id); ?>"
                                        wire:model.live="selectedBrands"
                                        class="mr-3 w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500"
                                    />
                                    <span class="text-sm font-medium text-gray-700"><?php echo e($brand->name); ?></span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtros Ativos -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($name) || !empty($selectedCategories) || !empty($selectedBrands)): ?>
                <div class="mt-8 pt-6 border-t-2 border-gray-200">
                    <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide mb-4">
                        Filtros Ativos
                    </p>
                    <div class="flex flex-wrap gap-2.5">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($name)): ?>
                            <span class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-800 rounded-lg text-sm font-semibold border border-orange-300 shadow-sm">
                                Nome: "<?php echo e($name); ?>"
                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($selectedCategories)): ?>
                            <span class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-800 rounded-lg text-sm font-semibold border border-orange-300 shadow-sm">
                                <?php echo e(count($selectedCategories)); ?> categoria(s)
                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($selectedBrands)): ?>
                            <span class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-800 rounded-lg text-sm font-semibold border border-orange-300 shadow-sm">
                                <?php echo e(count($selectedBrands)); ?> marca(s)
                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Resultados Section - Full Width -->
    <div class="w-full bg-white border-t border-gray-200 py-10">
        <div class="w-full px-4 sm:px-6 lg:px-8 mb-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">
                Produtos Encontrados
            </h3>
            <p class="text-base text-gray-600">
                <span class="font-bold text-orange-600"><?php echo e($products->total()); ?></span> produto(s) disponível(is)
            </p>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($products->count() > 0): ?>
            <div class="w-full px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="group bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-orange-400 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                            <!-- Product Info -->
                            <div class="space-y-4">
                                <!-- Name and Description -->
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900 line-clamp-2 mb-3 group-hover:text-orange-600 transition-colors">
                                        <?php echo e($product->name); ?>

                                    </h4>
                                    <p class="text-sm text-gray-600 line-clamp-3 leading-relaxed min-h-[3.75rem]">
                                        <?php echo e($product->description); ?>

                                    </p>
                                </div>
                                
                                <!-- Price - Destaque Principal -->
                                <div class="pt-4 border-t-2 border-gray-100">
                                    <div class="flex items-baseline justify-between">
                                        <div>
                                            <span class="text-xs text-gray-500 uppercase tracking-wide font-semibold">Preço</span>
                                            <div class="mt-2">
                                                <span class="text-3xl font-bold text-orange-600">
                                                    R$ <?php echo e(number_format($product->price, 2, ',', '.')); ?>

                                                </span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold shadow-sm <?php echo e($product->stock > 0 ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-red-100 text-red-800 border border-red-300'); ?>">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->stock > 0): ?>
                                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                <?php else: ?>
                                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                    </svg>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <?php echo e($product->stock); ?> un.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Brand and Categories -->
                                <div class="pt-3 space-y-3">
                                    <div>
                                        <span class="text-xs text-gray-500 uppercase tracking-wide font-semibold">Marca</span>
                                        <div class="mt-2">
                                            <span class="inline-flex items-center px-3 py-1.5 bg-orange-100 text-orange-800 rounded-lg text-xs font-bold border border-orange-300 shadow-sm">
                                                <?php echo e($product->brand->name); ?>

                                            </span>
                                        </div>
                                    </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->categories->count() > 0): ?>
                                        <div>
                                            <span class="text-xs text-gray-500 uppercase tracking-wide font-semibold">Categorias</span>
                                            <div class="mt-2 flex flex-wrap gap-2">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $product->categories->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <span class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-800 rounded-lg text-xs font-semibold border border-gray-300 shadow-sm">
                                                        <?php echo e($category->name); ?>

                                                    </span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->categories->count() > 2): ?>
                                                    <span class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-600 rounded-lg text-xs font-semibold border border-gray-300 shadow-sm">
                                                        +<?php echo e($product->categories->count() - 2); ?>

                                                    </span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <!-- Paginação -->
                <div class="mt-10 flex justify-center px-4 sm:px-6 lg:px-8">
                    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                        <?php echo e($products->links()); ?>

                    </div>
                </div>
            <?php else: ?>
                <div class="w-full px-4 sm:px-6 lg:px-8">
                    <div class="text-center py-16">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-orange-100 rounded-full mb-6">
                            <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Nenhum produto encontrado</h3>
                        <p class="text-base text-gray-600 mb-6">Tente ajustar os filtros para encontrar o que procura</p>
                        <button 
                            wire:click="clearFilters"
                            class="px-6 py-3 bg-orange-600 text-white font-semibold rounded-lg hover:bg-orange-700 transition-all duration-200 shadow-md hover:shadow-lg text-sm"
                        >
                            Limpar Filtros
                        </button>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/product-filter.blade.php ENDPATH**/ ?>