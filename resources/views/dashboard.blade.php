@extends('layouts.backendMaster')
@section('backend_content')
    <div class="page-content">
        <div class="row">
            <div class="col-sm-4">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <p>Total Product</p>
                        <h3>{{ totalProduct()->sum('quantity') }}pcs</h3>
                        <p class="mb-0">100% <span class="float-end">{{ totalProduct()->sum('price') }} BDT</span></p>
                    </div>
                    <div class="progress-wrapper">
                        <div class="progress" style="height: 7px;">
                            <div class="progress-bar" role="progressbar" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <p>Total Sell</p>
                        <h3>{{ totalSell()->sum('quantity') }}pcs</h3>
                        <p class="mb-0">{{ round((totalSell()->sum('quantity')/totalProduct()->sum('quantity'))*100) }}% <span class="float-end">{{ totalSell()->sum('unit_price') }} BDT</span></p>
                    </div>
                    <div class="progress-wrapper">
                        <div class="progress" style="height: 7px;">
                            <div class="progress-bar" role="progressbar" style="width: {{ round((totalSell()->sum('quantity')/totalProduct()->sum('quantity'))*100) }}%;background:rgb(1, 155, 13)"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <p>Total Earning</p>
                        <h3>1M BDT</h3>
                        <p class="mb-0">72% <span class="float-end">Current Month</span></p>
                    </div>
                    <div class="progress-wrapper">
                        <div class="progress" style="height: 7px;">
                            <div class="progress-bar" role="progressbar" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <p>Salary Paid </p>
                        <h3>533k BDT</h3>
                        <p class="mb-0">72% <span class="float-end">Current Month</span></p>
                    </div>
                    <div class="progress-wrapper">
                        <div class="progress" style="height: 7px;">
                            <div class="progress-bar" role="progressbar" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <p>Salray Due</p>
                        <h3>639k BDT</h3>
                        <p class="mb-0">72% <span class="float-end">Current month</span></p>
                    </div>
                    <div class="progress-wrapper">
                        <div class="progress" style="height: 7px;">
                            <div class="progress-bar" role="progressbar" style="width: 25%;background:red"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <p>Total Employ</p>
                        <h3>{{ totalEmploye()->count() }} peoples</h3>
                        <p class="mb-0">100% <span class="float-end">Current month</span></p>
                    </div>
                    <div class="progress-wrapper">
                        <div class="progress" style="height: 7px;">
                            <div class="progress-bar" role="progressbar" style="width: 100%;background:#ffc400"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
