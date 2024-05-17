<?php

namespace App\Http\Livewire\Report;

use App\Models\Employe;
use App\Models\Salary as ModelsSalary;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Salary extends Component
{
    public $salary;
    public $employee;
    public $designation;
    public $pay_status;
    public $search_value;
    public $emp_id;

    public function hydrate()
    {
        $this->emit('select2');
    }
         //.......
    public function selectedCompanyItem($item)
    {
        if ($item) {
            $this->employee = $item;
        }
    }
    public function all_show(){
        $this->designation = '';
        $this->pay_status = '';
        $this->search_value = '';
        $this->emp_id = '';
    }
    public function render()
    {
        $roles = Role::all();
        $employees = Employe::all();

        $users = User::all();

        $salaries = ModelsSalary::all();
        $query = ModelsSalary::query();
        // $salaries = $this->employee ? ModelsSalary::where('employee_id',$this->employee)->where('designation',$this->designation)->where('status',$this->pay_status)->get():  ModelsSalary::all();
         // Fetch salaries based on filter options
         $emp = Employe::where('name','LIKE',"%$this->search_value%")->first();
         if($emp) $this->emp_id = $emp->id;

        if($this->emp_id){
            $query->where('employee_id', 'LIKE', "%$this->emp_id%");
        }
        if($this->designation){
            $query->where('designation', 'LIKE', "$this->designation");
        }
        if( $this->pay_status){
            $query->where('status', 'LIKE', "$this->pay_status");
        }
        $salaries = $query->get();
        return view('livewire.report.salary',compact('roles','employees','users','salaries'));
    }
}
