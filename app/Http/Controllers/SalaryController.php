<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class SalaryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salaries = Salary::all();
        $roles = Role::whereNotIn('name',['super-admin'])->get();
        $users = User::all();
        return view('backend.salary.index',compact('salaries','roles','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        // Get all users without the Super Admin role
        $roles = Role::whereNotIn('name',['super-admin'])->get();

        $employees = Employe::all();
        // $superAdminRoleId = Role::where('name', 'super_admin')->value('id');

        // $users = User::whereDoesntHave('roles', function ($query) use ($superAdminRoleId) {
        //     $query->where('id', $superAdminRoleId);
        // })->get();
        return view('backend.salary.create',compact('roles','employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request;
         $request->validate([
            'designation' => 'required',
            'employee_id' => 'required',
            'amount' => 'required',
            'pay' => 'required',
        ]);


        $data['due'] =  $request->amount - $request->pay;
        $data['status'] =  $request->due ? 'unpaid' : 'paid';
        Salary::create([
            'employee_id' => $data['employee_id'],
            'designation' => $data['designation'],
            'amount' => $data['amount'],
            'pay' => $data['pay'],
            'due' => $data['due'],
            'status' => $data['status'],
            'note' => $data['note'],
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salary $salary)
    {
        $data = $request;
         $request->validate([
            'designation' => 'required',
            'employee_id' => 'required',
            'amount' => 'required',
            'pay' => 'required',
        ]);


        $data['due'] =  $request->amount - $request->pay;
        $data['status'] =  $request->due ? 'unpaid' : 'paid';
        // dd($data);
        $salary->update([
            'employee_id' => $data['employee_id'],
            'designation' => $data['designation'],
            'amount' => $data['amount'],
            'pay' => $data['pay'],
            'due' => $data['due'],
            'status' => $data['status'],
            'note' => $data['note'],
        ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salary $salary)
    {
        $salary->delete();
        return back()->with('delete','Successfull Delete A Data');
    }
}
