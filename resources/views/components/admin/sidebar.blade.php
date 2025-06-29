<div class="bg-white w-64 h-screen flex flex-col p-6">
    <!-- Logo and Title -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-indigo-600">JewelBill</h1>
        <p class="text-sm text-gray-500 mt-1">Jewelry Billing System</p>
    </div>

    <!-- Navigation -->
    <nav class="space-y-1.5 flex-1">
        <a href="{{ route('dashboard') }}"
           class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-all duration-200
           {{ request()->routeIs('dashboard') 
                ? 'bg-gradient-to-r from-purple-500 to-indigo-500 text-white shadow-lg shadow-purple-100'
                : 'text-gray-700 hover:bg-purple-50 hover:text-purple-600' }}">
            <i class="fas fa-home text-lg"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('category.index') }}"
           class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-all duration-200
           {{ request()->routeIs('category.index') 
                ? 'bg-gradient-to-r from-purple-500 to-indigo-500 text-white shadow-lg shadow-purple-100'
                : 'text-gray-700 hover:bg-purple-50 hover:text-purple-600' }}">
            <i class="fas fa-file-invoice text-lg"></i>
            <span>Categories</span>
        </a>

        <a href="{{ route('products.index') }}"
           class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-all duration-200
           {{ request()->routeIs('products.index') 
                ? 'bg-gradient-to-r from-purple-500 to-indigo-500 text-white shadow-lg shadow-purple-100'
                : 'text-gray-700 hover:bg-purple-50 hover:text-purple-600' }}">
            <i class="fas fa-box text-lg"></i>
            <span>Inventory</span>
        </a>

        {{-- Add more links according to web.php --}}
        {{-- Example: Customers --}}
        @if(Route::has('customers.index'))
        <a href="{{ route('customers.index') }}"
           class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-all duration-200
           {{ request()->routeIs('customers.index') 
                ? 'bg-gradient-to-r from-purple-500 to-indigo-500 text-white shadow-lg shadow-purple-100'
                : 'text-gray-700 hover:bg-purple-50 hover:text-purple-600' }}">
            <i class="fas fa-users text-lg"></i>
            <span>Customers</span>
        </a>
        @endif

        {{-- Example: Sales --}}
        @if(Route::has('sales.index'))
        <a href="{{ route('sales.index') }}"
           class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-all duration-200
           {{ request()->routeIs('sales.index') 
                ? 'bg-gradient-to-r from-purple-500 to-indigo-500 text-white shadow-lg shadow-purple-100'
                : 'text-gray-700 hover:bg-purple-50 hover:text-purple-600' }}">
            <i class="fas fa-cash-register text-lg"></i>
            <span>Sales</span>
        </a>
        @endif

        {{-- Example: Users --}}
        @if(Route::has('users.index'))
        <a href="{{ route('users.index') }}"
           class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-all duration-200
           {{ request()->routeIs('users.index') 
                ? 'bg-gradient-to-r from-purple-500 to-indigo-500 text-white shadow-lg shadow-purple-100'
                : 'text-gray-700 hover:bg-purple-50 hover:text-purple-600' }}">
            <i class="fas fa-user-cog text-lg"></i>
            <span>Users</span>
        </a>
        @endif

        {{-- Remove or update Reports if not in web.php --}}
        {{-- @if(Route::has('reports.index'))
        <a href="{{ route('reports.index') }}"
           class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-all duration-200
           {{ request()->routeIs('reports.*') 
                ? 'bg-gradient-to-r from-purple-500 to-indigo-500 text-white shadow-lg shadow-purple-100'
                : 'text-gray-700 hover:bg-purple-50 hover:text-purple-600' }}">
            <i class="fas fa-chart-bar text-lg"></i>
            <span>Reports</span>
        </a>
        @endif --}}

        <a href="{{ route('metal.index') }}"
           class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-all duration-200
           {{ request()->routeIs('metal.index') 
                ? 'bg-gradient-to-r from-purple-500 to-indigo-500 text-white shadow-lg shadow-purple-100'
                : 'text-gray-700 hover:bg-purple-50 hover:text-purple-600' }}">
            <i class="fas fa-cog text-lg"></i>
            <span>Metals</span>
        </a>
    </nav>

    <div class="mt-auto pt-6 border-t">
        <div class="bg-purple-50 rounded-xl p-4">
            <h3 class="text-sm font-medium text-purple-900">Need Help?</h3>
            <p class="text-xs text-purple-600 mt-1">Contact our support team</p>
        </div>
    </div>
</div>
