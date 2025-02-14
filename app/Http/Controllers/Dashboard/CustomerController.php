<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Customer;
use App\Models\CustomerEmployee;
use App\Models\Employee;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list customer')->only(['index']);
        $this->middleware('permission:create customer')->only(['create', 'store']);
        $this->middleware('permission:delete customer')->only(['destroy']);
        $this->middleware('permission:reassign customer')->only(['reassign']);
    }

    public function index()
    {
        $customers = Customer::with('employees.user')
            ->when(auth()->user()->hasRole('Employee'), function ($query) {
                $query->whereHas('employees', function ($q) {
                    $q->where('employee_id', auth()->user()->employee?->id);
                });
            })
            ->latest()
            ->get();


        if (auth()->user()->employee)
            $employees = Employee::with('user')->where('user_id', auth()->id())->get();
        else
            $employees = Employee::with('user')->get();
        return view('dashboard.customers.index', compact('customers', 'employees'));
    }


    public function create()
    {
        if (!auth()->user()->hasRole('employee')) {
            $employees = Employee::with('user')->get();
        }
        return view('dashboard.customers.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $isEmployee = auth()->user()->hasRole('Employee');

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
        ];

        if (!$isEmployee) {
            $rules['employee_id'] = 'required|exists:employees,id';
        }

        $validated = $request->validate($rules);

        if ($isEmployee) {
            $validated['employee_id'] = auth()->user()->employee->id;
        }

        $customer = Customer::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'] ?? null,
            'created_by' => auth()->id(),
        ]);

        CustomerEmployee::query()->create([
            'customer_id' => $customer->id,
            'employee_id' => $validated['employee_id'],
            'assigned_by' => auth()->id(),
        ]);

        return redirect()->route('dashboard.customers.index')->with('success', 'Customer added successfully.');
    }

    public function reassign(Request $request, Customer $customer)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
        ]);

        CustomerEmployee::query()->where('customer_id', $customer->id)->delete();

        CustomerEmployee::query()->create([
            'customer_id' => $customer->id,
            'employee_id' => $request->employee_id,
            'assigned_by' => auth()->id(),
        ]);

        return redirect()->route('dashboard.customers.index')->with('success', 'Customer reassigned successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->employees()->detach();
        $customer->delete();

        return redirect()->route('dashboard.customers.index')->with('success', 'Customer deleted successfully.');
    }
}
