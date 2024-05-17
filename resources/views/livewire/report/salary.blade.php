<div>
{{-- Product Filter Form Start  --}}
<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body p-5">
        <div class="card-title d-flex align-items-center">
            <h5 class="mb-0 text-primary">Search Form with valid information</h5>
        </div>
        <hr>
        <form class="row g-3" method="get" >
            <div class="col-md-4">
                <label for="inputState" class="form-label">Name/Id</label>
                <input type="text" class="form-control" wire:model="search_value">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Designation</label>
                <select class="form-control" wire:model="designation">
                    <option selected> -- Select a designation --</option>
                    @foreach ($roles as $role)
                        @if ($role->name != 'admin')
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Pay Status</label>
                <select class="form-control" wire:model="pay_status">
                    <option selected> -- Select a pay status --</option>
                    <option value="paid">Paid</option>
                    <option value="unpaid">Unpaid</option>
                </select>
            </div>
            <div class="col-12">
                <button wire:click="all_show" type="submit" class="btn btn-primary px-5">All Report Show</button>
            </div>
        </form>
    </div>
</div>

{{-- Product Report Show Table Start  --}}
<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body">
        <table class="table table-sm mb-0">
            <thead>
                <tr>
                    <th scope="col">SL. No</th>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Disegnation</th>
                    <th scope="col">Salary</th>
                    <th scope="col">Pay</th>
                    {{-- <th scope="col">Advanced Salary</th> --}}
                    <th scope="col">Due Salary</th>
                    <th scope="col">Note</th>
                    <th scope="col">Status</th>
                    <th scope="col">Month</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salaries as $item)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>#emp_00{{ $item->employee_id }}</td>
                    <td>{{ $item->relationWithEmployee->name }}</td>
                    <td>{{ $item->designation }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>{{ $item->pay }}</td>
                    <td>{{ $item->due }}</td>
                    <td>{{ $item->note }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
