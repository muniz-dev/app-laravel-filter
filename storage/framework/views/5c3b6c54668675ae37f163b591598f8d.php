<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="antialiased bg-white">
    <div class="min-h-screen">
        <!-- Navbar -->
        <nav class="bg-white border-b border-gray-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center">
                        <a href="<?php echo e(route('products.index')); ?>" class="flex items-center space-x-3 group">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-600 to-orange-500 rounded-xl flex items-center justify-center group-hover:from-orange-700 group-hover:to-orange-600 transition-all duration-200 shadow-md group-hover:shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900">
                                <?php echo e(config('app.name')); ?>

                            </span>
                        </a>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="<?php echo e(route('products.index')); ?>" class="text-sm text-gray-700 hover:text-orange-600 font-semibold transition-colors duration-200 px-4 py-2 rounded-lg hover:bg-orange-50">
                            Início
                        </a>
                        <a href="<?php echo e(route('admin.activity-logs.index')); ?>" class="text-sm text-gray-700 hover:text-orange-600 font-semibold transition-colors duration-200 px-4 py-2 rounded-lg hover:bg-orange-50">
                            Logs de Atividade
                        </a>
                        <a href="<?php echo e(route('admin.search-logs.index')); ?>" class="text-sm text-gray-700 hover:text-orange-600 font-semibold transition-colors duration-200 px-4 py-2 rounded-lg hover:bg-orange-50">
                            Logs de Pesquisa
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <main>
            <?php echo e($slot); ?>

        </main>
    </div>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH /var/www/html/resources/views/components/layouts/app.blade.php ENDPATH**/ ?>