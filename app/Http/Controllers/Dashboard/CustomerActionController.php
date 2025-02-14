<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Customer;
use App\Models\CustomerAction;
use Illuminate\Http\Request;

class CustomerActionController extends Controller
{
    public function index(Customer $customer)
    {
        $actions = CustomerAction::with('employee.user')
            ->where('customer_id', $customer->id)
            ->latest()
            ->get();

        return view('dashboard.customers.actions.index', compact('actions', 'customer'));
    }

    public function store(Request $request, Customer $customer)
    {
        $request->validate([
            'action_type' => 'required|in:call,visit,follow_up',
            'action_date' => 'required|date',
            'result' => 'nullable|string',
        ]);

        CustomerAction::query()->create([
            'customer_id' => $customer->id,
            'employee_id' => auth()->user()->employee?->id,
            'action_type' => $request->action_type,
            'action_date' => $request->action_date,
            'result' => $request->result,
        ]);

        return redirect()->route('dashboard.customers.actions.index', $customer->id)->with('success', 'Action added successfully.');
    }

    public function updateResult(Request $request, CustomerAction $action)
    {
        if ($action->employee_id !== auth()->user()->employee->id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'result' => 'required|string',
        ]);

        $action->update(['result' => $request->result]);

        return response()->json(['success' => true, 'message' => 'Action result updated successfully.']);
    }
}
