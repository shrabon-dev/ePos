<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class EmployeManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employes = Employe::all();
        return view('backend.employe.list',compact('employes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('backend.employe.add',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Form Validation Start
        $request->validate([
            'name' => 'required',
            'contact_number' => 'required',
            'photo' => 'image|mimes:png,jpg,jpeg,gif|max:2024',
            'email' => 'required|email',
            'address' => 'required',
            'job_type' => 'required',
            'salary' => 'numeric',
        ]);

        // Form Submit Start
        if($request->hasFile('photo')){
            Employe::insert([
                'name' => $request->name,
                'phone' => $request->contact_number,
                'photo' => $request->file('photo')->getClientOriginalName(),
                'email' => $request->email,
                'address' => $request->address,
                'job_type' => $request->job_type,
                'reference' => $request->reference,
                'salary' => $request->salary,
                'created_at' => Carbon::now(),
            ]);
            $request->file('photo')->storeAs('/public/employe/',$request->file('photo')->getClientOriginalName());

        }else{
            Employe::insert([
                'name' => $request->name,
                'phone' => $request->contact_number,
                'email' => $request->email,
                'address' => $request->address,
                'job_type' => $request->job_type,
                'reference' => $request->reference,
                'salary' => $request->salary,
                'created_at' => Carbon::now(),
            ]);
        }

        return back()->with('message','Successfully added a new employe');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // View All Information of Employe
        $employe = Employe::find($id);
        return view('backend.employe.view',compact('employe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // Form Validation Start
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'job_type' => 'required',
            'salary' => 'numeric',
        ]);

        // Form Submit Start
        if($request->hasFile('photo')){

            // Photo Validation
            $request->validate([
                'photo' => 'image|mimes:png,jpg,jpeg,gif|max:2024',
            ]);

            // Delete previous image from storage
            $previousImg = Employe::find($id)->photo;

            if($previousImg && Storage::disk('public')->exists('employe/'.$previousImg)){
                Storage::disk('public')->delete('employe/'.$previousImg);
                $request->file('photo')->storeAs('/public/employe/',$request->file('photo')->getClientOriginalName());
            }

            Employe::find($id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'photo' => $request->file('photo')->getClientOriginalName(),
                'email' => $request->email,
                'address' => $request->address,
                'job_type' => $request->job_type,
                'reference' => $request->reference,
                'salary' => $request->salary,
            ]);

        }else{
            Employe::find($id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'job_type' => $request->job_type,
                'reference' => $request->reference,
                'salary' => $request->salary,
            ]);
        }

        return back()->with('message','Successfully added a new employe');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Employe::find($id)->delete();

        return back()->with('delete','Successfully deleted');
    }
}
