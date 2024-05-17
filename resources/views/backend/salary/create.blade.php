@extends('layouts.backendMaster')
@section('style_body')
<style>
    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
@endsection
@section('backend_content')
<div class="row d-flex justify-content-center align-items-center">
    <div class="col-lg-6">
        <div class="card border-top border-0 border-4 border-info">
            <div class="card-body">
                <div class="border p-4 rounded">
                    <div class="card-title d-flex align-items-center">
                        <div class="parent-icon">
                            <i class="fadeIn animated bx bx-money text-info" style="font-size: 24px;margin-right:2px"></i>
						</div>
                        <h5 class="mb-0 text-info">Saraly Pay</h5>
                    </div>
                    <hr>
                    {{-- Error Message Alert Start --}}
                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $error }}</strong>
                            </div>
                        @endforeach
                        @endif
                    {{-- Error Message Alert End --}}
                    <form action="{{ route('salary.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row mb-3">
                                <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Designation</label>
                                <div class="col-sm-9">
                                    <select name="designation" id="" class="form-control">
                                        <option value="" disabled selected>Select job type...</option>
                                        @foreach ($roles as $role)
                                            @if ($role->name == 'employee')
                                                <option value="{{ $role->name }}" >{{ $role->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEnterYourName" class="col-sm-3 col-form-label">Employe</label>
                                <div class="col-sm-9">
                                    <select name="employee_id" id="" class="form-control">
                                        <option value="" disabled selected>Select Employee...</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Salary Amount</label>
                                <div class="col-sm-9">
                                    <input type="number" name="amount" class="form-control" id="inputPhoneNo2" placeholder="Salary Amount">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Pay</label>
                                <div class="col-sm-9">
                                    <input type="number" name="pay" class="form-control" id="inputEnterYourName" placeholder="Paying">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Due</label>
                                <div class="col-sm-9">
                                    <input type="number" name="due" class="form-control" id="inputEnterYourName" placeholder="Due">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Note</label>
                                <div class="col-sm-9">
                                    <input type="text" name="note" class="form-control" id="inputEmailAddress2" placeholder="Note...">
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-info px-5 text-light text-bold">Pay</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script_body')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('message'))
<script>
 const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'success',
        title: '{{ session('message') }}'
        })
</script>
@endif
@endsection
