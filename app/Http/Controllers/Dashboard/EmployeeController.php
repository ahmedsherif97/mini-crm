<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list employee')->only(['index']);
        $this->middleware('permission:create employee')->only(['create', 'store']);
        $this->middleware('permission:delete employee')->only(['destroy']);
    }
    public function index()
    {
        $employees = Employee::with('user')->latest()->get();
        return view('dashboard.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('dashboard.employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('employee');

        Employee::query()->create([
            'user_id' => $user->id,
        ]);

        return redirect()->route('dashboard.employees.index')->with('success', 'Employee added successfully.');
    }

    public function destroy(Employee $employee)
    {
        $user = $employee->user;
        $user->removeRole('employee');
        $employee->delete();
        $user->delete();

        return redirect()->route('dashboard.employees.index')->with('success', 'Employee deleted successfully.');
    }
}
