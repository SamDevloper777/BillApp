<header class="bg-gradient-to-r from-white to-purple-50 shadow-lg sticky top-0 z-50">
    <div class="max-w-[1600px] mx-auto">
        <div class="flex items-center justify-between px-6 md:px-8 h-20">
            <div class="flex items-center gap-6">
                <button id="mobile-menu" class="md:hidden text-gray-600 hover:text-purple-600 transition-all duration-200 hover:scale-110">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
                <span class="md:hidden text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-indigo-600">JB</span>
                <div class="hidden md:block relative group">
                    <input type="text" placeholder="Search anything..." 
                        class="w-72 lg:w-96 pl-12 pr-4 h-11 rounded-xl border border-gray-200 
                        focus:outline-none focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition-all
                        group-hover:border-purple-300">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-hover:text-purple-500 transition-colors"></i>
                </div>
            </div>

            <div class="flex items-center space-x-8">
                <div class="hidden md:flex items-center space-x-4">
                    <button class="p-2.5 text-gray-600 hover:text-purple-600 rounded-lg hover:bg-purple-100 transition-all duration-200 hover:scale-105">
                        <i class="fas fa-plus text-lg"></i>
                    </button>
                    <button class="p-2.5 text-gray-600 hover:text-purple-600 rounded-lg hover:bg-purple-100 transition-all duration-200 hover:scale-105">
                        <i class="fas fa-file-invoice text-lg"></i>
                    </button>
                </div>

                <button class="text-gray-600 hover:text-purple-600 relative transition-all duration-200 hover:scale-110">
                    <i class="fas fa-bell text-2xl"></i>
                    <span class="absolute -top-1.5 -right-1.5 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center">3</span>
                </button>
                
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none group">
                        <span class="hidden md:block font-medium text-gray-700 group-hover:text-purple-600 transition-colors">Admin User</span>
                        <img src="https://ui-avatars.com/api/?name=Admin+User&background=7c3aed&color=fff" 
                            class="w-10 h-10 rounded-lg ring-2 ring-purple-500 ring-offset-2 transition-transform group-hover:scale-105">
                        <i class="fas fa-chevron-down text-sm text-gray-600 group-hover:text-purple-600 transition-colors"></i>
                    </button>
                    
                    <div x-show="open" @click.away="open = false" 
                        class="absolute right-0 mt-4 w-64 bg-white rounded-xl shadow-xl py-2 border border-gray-100" 
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100">
                        <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors">
                            <i class="fas fa-user w-5"></i>
                            <span class="ml-3">Profile</span>
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors">
                            <i class="fas fa-cog w-5"></i>
                            <span class="ml-3">Settings</span>
                        </a>
                        <hr class="my-2 border-gray-100">
                        <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-red-600 transition-colors">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span class="ml-3">Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>