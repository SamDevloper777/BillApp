<?php

namespace App\Livewire\Admin\Billing;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BillCreate extends Component
{   
  public $phone_search = '';
    public $customer_id = null;
    public $customer_name = '';
    public $customer_phone = '';
    public $customer_email = '';
    public $customer_address = '';
    public $customer_found = false;

    // Bill properties
    public $bill_no = '';
    public $date = '';
    public $payment_type = 'Cash';

    // Items properties
    public $items = [];
    public $item_counter = 0;

    // Totals
    public $total_amount = 0;
    public $discount = 0;
    public $tax = 0;
    public $final_amount = 0;

    public $products = [];

    protected $rules = [
        'customer_name' => 'required|string|max:255',
        'bill_no' => 'required|string|unique:sales,bill_no',
        'date' => 'required|date',
        'payment_type' => 'required|string',
        'items.*.product_id' => 'required|exists:products,id',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.weight' => 'required|numeric|min:0.001',
        'items.*.rate' => 'required|numeric|min:0',
        'items.*.making_charge' => 'numeric|min:0',
    ];

    public function mount()
    {
        $this->date = now()->format('Y-m-d');
        $this->bill_no = 'BILL-' . now()->format('ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $this->products = Product::all();
        $this->addItem();
    }

    public function searchCustomer()
    {
        $this->validate(['phone_search' => 'required|string|min:10']);

        $customer = Customer::where('phone', $this->phone_search)->first();

        if ($customer) {
            $this->customer_id = $customer->id;
            $this->customer_name = $customer->name;
            $this->customer_phone = $customer->phone;
            $this->customer_email = $customer->email ?? '';
            $this->customer_address = $customer->address ?? '';
            $this->customer_found = true;

            session()->flash('customer_success', 'Customer found successfully!');
        } else {
            $this->customer_id = null;
            $this->customer_name = '';
            $this->customer_phone = $this->phone_search;
            $this->customer_email = '';
            $this->customer_address = '';
            $this->customer_found = false;

            session()->flash('customer_info', 'Customer not found. Please fill in the details for new customer.');
        }
    }

    public function addItem()
    {
        $this->items[] = [
            'id' => ++$this->item_counter,
            'product_id' => '',
            'quantity' => 1,
            'weight' => 0,
            'rate' => 0,
            'making_charge' => 0,
            'total_price' => 0,
        ];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
        $this->calculateTotals();
    }

    public function updatedItems($value, $key)
    {
        $parts = explode('.', $key);
        $index = $parts[0];

        if (in_array($parts[1], ['quantity', 'weight', 'rate', 'making_charge'])) {
            $this->calculateItemTotal($index);
        }
    }

    public function calculateItemTotal($index)
    {
        if (isset($this->items[$index])) {
            $item = &$this->items[$index];
            $item['total_price'] = ($item['weight'] * $item['rate']) + $item['making_charge'];
        }
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->total_amount = collect($this->items)->sum('total_price');
        
        $discount_amount = ($this->total_amount * $this->discount) / 100;
        $taxable_amount = $this->total_amount - $discount_amount;
        $tax_amount = ($taxable_amount * $this->tax) / 100;
        
        $this->final_amount = $taxable_amount + $tax_amount;
    }

    public function updatedDiscount()
    {
        $this->calculateTotals();
    }

    public function updatedTax()
    {
        $this->calculateTotals();
    }

    public function saveBill()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            // Create or update customer
            if ($this->customer_id) {
                $customer = Customer::find($this->customer_id);
                $customer->update([
                    'name' => $this->customer_name,
                    'phone' => $this->customer_phone,
                    'email' => $this->customer_email ?: null,
                    'address' => $this->customer_address ?: null,
                ]);
            } else {
                $customer = Customer::create([
                    'name' => $this->customer_name,
                    'phone' => $this->customer_phone ?: null,
                    'email' => $this->customer_email ?: null,
                    'address' => $this->customer_address ?: null,
                ]);
                $this->customer_id = $customer->id;
            }

            // Create sale record
            $sale = Sale::create([
                'bill_no' => $this->bill_no,
                'customer_id' => $this->customer_id,
                'date' => $this->date,
                'total_amount' => $this->total_amount,
                'discount' => ($this->total_amount * $this->discount) / 100,
                'tax' => (($this->total_amount - (($this->total_amount * $this->discount) / 100)) * $this->tax) / 100,
                'final_amount' => $this->final_amount,
            ]);

            // Create billing record
            $billing = Billing::create([
                'sale_id' => $sale->id,
                'payment_type' => $this->payment_type,
                'amount' => $this->final_amount,
            ]);

            // Create sale items
            foreach ($this->items as $item) {
                if ($item['product_id'] && $item['quantity'] > 0) {
                    SaleItem::create([
                        'sale_id' => $sale->id,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'weight' => $item['weight'],
                        'rate' => $item['rate'],
                        'making_charge' => $item['making_charge'],
                        'total_price' => $item['total_price'],
                    ]);
                }
            }

            DB::commit();

            session()->flash('success', 'Bill saved successfully! Bill No: ' . $this->bill_no);
            
            // Reset form
            $this->resetForm();

        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', 'Error saving bill: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->reset([
            'phone_search', 'customer_id', 'customer_name', 'customer_phone', 
            'customer_email', 'customer_address', 'customer_found', 'items',
            'total_amount', 'discount', 'tax', 'final_amount'
        ]);
        
        $this->date = now()->format('Y-m-d');
        $this->bill_no = 'BILL-' . now()->format('ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $this->payment_type = 'Cash';
        $this->item_counter = 0;
        $this->addItem();
    }


    public function render()
    {
        return view('livewire.admin.billing.bill-create', );
    }
}
