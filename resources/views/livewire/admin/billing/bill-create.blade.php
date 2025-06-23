<div class=" min-h-screen p-4">
    <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-2xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-8 text-center">
            <h1 class="text-4xl font-bold mb-2">Billing System</h1>
            <p class="text-indigo-100">Create invoices and manage customer billing</p>
        </div>

        <div class="p-8">
            <!-- Flash Messages -->
            @if (session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Customer Search Section -->
            <div class="bg-gray-50 rounded-xl p-6 mb-8 border-l-4 border-indigo-500">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Customer Information
                </h2>
                
                <div class="flex gap-4 mb-4">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Search by Phone Number</label>
                        <input type="tel" wire:model="phone_search" placeholder="Enter phone number" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                        @error('phone_search')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex items-end">
                        <button wire:click="searchCustomer" 
                                class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium">
                            <span wire:loading.remove wire:target="searchCustomer">Search Customer</span>
                            <span wire:loading wire:target="searchCustomer">Searching...</span>
                        </button>
                    </div>
                </div>

                <!-- Customer Messages -->
                @if (session()->has('customer_success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('customer_success') }}
                    </div>
                @endif

                @if (session()->has('customer_info'))
                    <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded mb-4">
                        {{ session('customer_info') }}
                    </div>
                @endif

                <!-- Customer Details Form -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Customer Name *</label>
                        <input type="text" wire:model="customer_name" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('customer_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" wire:model="customer_phone"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('customer_phone')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" wire:model="customer_email"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('customer_email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <textarea wire:model="customer_address" rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                        @error('customer_address')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Customer Found Display -->
                @if($customer_found)
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mt-4">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-green-800 font-medium">Customer Found</span>
                        </div>
                        <div class="text-sm text-green-700 grid grid-cols-2 gap-4">
                            <div><strong>Name:</strong> {{ $customer_name }}</div>
                            <div><strong>Phone:</strong> {{ $customer_phone }}</div>
                            <div><strong>Email:</strong> {{ $customer_email ?: 'N/A' }}</div>
                            <div><strong>Address:</strong> {{ $customer_address ?: 'N/A' }}</div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Bill Information -->
            <div class="bg-gray-50 rounded-xl p-6 mb-8 border-l-4 border-blue-500">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Bill Information
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bill Number *</label>
                        <input type="text" wire:model="bill_no" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('bill_no')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date *</label>
                        <input type="date" wire:model="date" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Payment Type</label>
                        <select wire:model="payment_type" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="Cash">Cash</option>
                            <option value="Card">Card</option>
                            <option value="UPI">UPI</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                        </select>
                        @error('payment_type')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Items Section -->
            <div class="bg-gray-50 rounded-xl p-6 mb-8 border-l-4 border-yellow-500">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        Items
                    </h2>
                    <button wire:click="addItem" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        Add Item
                    </button>
                </div>

                <div class="overflow-x-auto bg-white rounded-lg border">
                    <table class="w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Product</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Qty</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Weight (g)</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Rate</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Making Charge</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Total</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $index => $item)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <select wire:model="items.{{ $index }}.product_id" 
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                            <option value="">Select Product</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        @error("items.{$index}.product_id")
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="number" wire:model="items.{{ $index }}.quantity" min="1" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        @error("items.{$index}.quantity")
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="number" wire:model="items.{{ $index }}.weight" step="0.001" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        @error("items.{$index}.weight")
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="number" wire:model="items.{{ $index }}.rate" step="0.01" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        @error("items.{$index}.rate")
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="number" wire:model="items.{{ $index }}.making_charge" step="0.01" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        @error("items.{$index}.making_charge")
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="number" value="{{ $item['total_price'] }}" readonly step="0.01"
                                               class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-100 font-semibold">
                                    </td>
                                    <td class="px-4 py-3">
                                        <button wire:click="removeItem({{ $index }})" 
                                                class="px-3 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors">
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Totals Section -->
            <div class="bg-gray-50 rounded-xl p-6 mb-8 border-l-4 border-green-500">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    Bill Summary
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Subtotal</label>
                            <input type="number" value="{{ $total_amount }}" readonly step="0.01"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Discount (%)</label>
                            <input type="number" wire:model="discount" step="0.01"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tax (%)</label>
                            <input type="number" wire:model="tax" step="0.01"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Final Amount</label>
                            <input type="number" value="{{ $final_amount }}" readonly step="0.01"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-xl font-bold text-green-600">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-center space-x-4">
                <button wire:click="calculateTotals" 
                        class="px-8 py-4 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors font-medium text-lg">
                    <span wire:loading.remove wire:target="calculateTotals">Calculate Total</span>
                    <span wire:loading wire:target="calculateTotals">Calculating...</span>
                </button>
                <button wire:click="saveBill" 
                        class="px-8 py-4 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors font-medium text-lg">
                    <span wire:loading.remove wire:target="saveBill">Save Bill</span>
                    <span wire:loading wire:target="saveBill">Saving...</span>
                </button>
                <button wire:click="resetForm" 
                        class="px-8 py-4 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors font-medium text-lg">
                    Reset Form
                </button>
            </div>
        </div>
    </div>
</div>