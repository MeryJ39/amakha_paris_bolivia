<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="p-4 bg-white shadow rounded-lg">
        <h2 class="text-lg font-semibold">Total de Usuarios</h2>
        <p class="text-3xl">{{ $this->getUsersCount() }}</p>
    </div>

    <div class="p-4 bg-white shadow rounded-lg">
        <h2 class="text-lg font-semibold">Total de Productos</h2>
        <p class="text-3xl">{{ $this->getProductsCount() }}</p>
    </div>

    <div class="p-4 bg-white shadow rounded-lg">
        <h2 class="text-lg font-semibold">Total de Órdenes</h2>
        <p class="text-3xl">{{ $this->getOrdersCount() }}</p>
    </div>

    <div class="p-4 bg-white shadow rounded-lg">
        <h2 class="text-lg font-semibold">Total Vendido</h2>
        <p class="text-3xl">${{ number_format($this->getTotalSales(), 2) }}</p>
    </div>
</div>
