@extends('layouts.backendMaster')
@section('backend_content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Applications</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Invoice</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body">
            <div id="invoice">
                <div class="toolbar hidden-print">
                    <div class="text-end">
                        <a href="{{ route('invoice',$invoice->id) }}" type="button" class="btn btn-dark"><i class="fa fa-print"></i> Print</a>
                        {{-- <a href="{{ route('invoice.export',$invoice->id) }}" type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export as PDF</a> --}}
                        <a href="{{ route('invoice.export',$invoice->id) }}" type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export as PDF</a>
                    </div>
                    <hr>
                </div>
                <div class="invoice overflow-auto">
                    <div style="min-width: 600px">
                        <header>
                            <div class="row">
                                <div class="col">
                                    <a href="javascript:;">
                                        <img src="assets/images/logo-icon.png" width="80" alt="">
                                    </a>
                                </div>
                                <div class="col company-details">
                                    <h2 class="name">
                        <a target="_blank" href="javascript:;">
                        {{ Config('app.name') }}
                        </a>
                    </h2>
                                    <div>455 Foggy Heights, AZ 85004, US</div>
                                    <div>(123) 456-789</div>
                                    <div>{{ Config('mail.from.address') }}</div>
                                </div>
                            </div>
                        </header>
                        <main>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <div class="text-gray-light">INVOICE TO:</div>
                                    <h2 class="to">{{ \App\Models\User::find($invoice->customer_id)->name }}</h2>
                                    <div class="address">{{ \App\Models\User::find($invoice->customer_id)->address }}</div>
                                    <div class="email"><a href="mailto:john@example.com">{{ \App\Models\User::find($invoice->customer_id)->email }}</a>
                                    </div>
                                </div>
                                <div class="col invoice-details">
                                    <h1 class="invoice-id">INVOICE {{ '1010'. $invoice->id }}</h1>
                                    <div class="date">Date of Invoice: {{ $invoice->created_at->format('d-m-Y') }}</div>
                                    <div class="date">Due Date: 30/10/2018</div>
                                </div>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">PRODUCT</th>
                                        <th class="text-right">QUANTITY</th>
                                        <th class="text-right">PRICE</th>
                                        <th class="text-right">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoiceDetails as $invoiceDetail)
                                    <tr>
                                        <td class="no">{{ $invoiceDetail->id }}</td>
                                        <td class="text-left">{{ $invoiceDetail->realationWithProduct->name }}</td>
                                        <td class="unit">{{ $invoiceDetail->quantity }}</td>
                                        {{-- <td class="qty">{{ $invoiceDetail->unit_price }}</td> --}}

                                        <td class="qty">{{ $invoiceDetail->unit_price }}</td>
                                        <td class="qty">{{ $invoiceDetail->unit_price*$invoiceDetail->quantity }}</td>

                                        {{-- <td class="total">{{ ($invoiceDetail->realationWithProduct->discount_type == 'fixed') ? ($invoiceDetail->quantity *($invoiceDetail->realationWithProduct->price - $invoiceDetail->realationWithProduct->discount)):($invoiceDetail->realationWithProduct->price - ($invoiceDetail->realationWithProduct->price*$invoiceDetail->realationWithProduct->discount/100)) }}</td> --}}
                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">SUBTOTAL</td>
                                        <td>{{ $invoice->sub_total }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">Total Discount</td>
                                        <td>{{ $invoice->total_discount }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">TAX 25%</td>
                                        <td>{{ $invoice->total_tax }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2" style="color:red">DUE TOTAL</td>
                                        <td style="color:red">{{ $invoice->due }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">GRAND TOTAL</td>
                                        <td>{{ $invoice->total_price}}</td>
                                    </tr>

                                </tfoot>
                            </table>
                            <div class="thanks">Thank you!</div>
                            <div class="notices">
                                <div>NOTICE:</div>
                                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                            </div>
                        </main>
                        <footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
                    </div>
                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
