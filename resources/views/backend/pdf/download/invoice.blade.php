{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts Start -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Google Fonts End -->
    <title>EPOS Invoice</title>
    <style>
        *,tr,td,tbody{
            vertical-align:baseline;
            font-family: 'Rubik', sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p{
            padding: 0;
            margin: 0;
        }
        .border{
            position: relative;
        }
        .border::after{
            position: absolute;
            bottom: 0px;
            background: #000000;
            width: 100%;
            height: 1px;
            content: '';
            left: 0;
        }

        .border-bottom{
            border-bottom: 1px solid #414141;
        }
    </style>
</head>
<body style="display: flex;justify-content: center;margin: 0;padding: 0;font-family: 'Rubik', sans-serif;">
    <!-- Table Start -->
    <table style="width:100%;" cellPading="0" cellSpacing="0">
        <!-- table heading or company info start  -->
        <thead>
            <tr>
                <td colspan="5">
                    <img src="https://i.postimg.cc/7hHcYhKz/kisspng-logo-font-flame-logo-5b4b2d7c7630f8-6261563915316535004841.png" alt="" style="width: 50px;display:block">

                <span style="padding-left: 10px;">
                    <h6 style="font-size: 16px;color: #E87117;margin: 0;">Epos Store ltd.</h6>
                    <p style="font-size: 12px;color: #979494;font-weight: 400;padding-top: 10px;margin: 0;">Sherpur-2210, Mymensing</p>
                    <p style="font-size: 12px;color: #979494;font-weight: 400;padding-top: 2px;margin: 0;">epos@gmail.com</p>
                </span>
                </td>

            </tr>
            <!-- Invoice Info Start -->
            <tr>
                <td colspan="2" style="padding-top: 100px">
                    <h2 style="color: #979494;font-size: 14px;">Bill To</h2>
                    <h4 style="font-size: 16px;color: #414141;font-weight: 600;">Md Sulaiman Rahman</h4>
                    <p style="font-size: 16px;color: #979494;font-weight: 400;padding-top: 4px;">Sultan Pur BajitKhila</p>
                    <p style="font-size: 16px;color: #979494;font-weight: 400;padding-top: 4px;">01786119237</p>
                </td>
                <td colspan="1" style="padding-top: 100px">
                    <h2 style="color: #979494;font-size: 14px;">Invocie Number</h2>
                    <h6  style="font-size: 16px;color: #414141;font-weight: 400;">#AB{{ $invoice->id}}</h6>
                </td>
                <td colspan="1" style="text-align: right;padding-top: 100px">
                    <h2 style="color: #979494;font-size: 14px;margin: 0;">Invoice of (Taka)</h2>
                    <p style="color: #E87117;font-size: 24px;font-weight: 600;margin: 0;padding: 0;">{{ $invoice->total_price}} tk</p>
                </td>
            </tr>
            <!-- Invoice Info End -->
        </thead>
        <!-- table heading or company info end  -->
        <!-- table body start  -->
        <tbody>

            <!-- Product Item Showing Start  -->
            <!-- *************************** -->
            <tr class="border">
                <td style="padding-top: 100px;padding-bottom:10px">
                    <h6 style="font-size: 14px;font-weight: 600;color: #414141;">SL.</h6>
                </td>
                <td style="padding-top: 100px;padding-bottom:10px">
                    <h6 style="font-size: 14px;font-weight: 600;color: #414141;">Product</h6>
                </td>
                <td style="padding-top: 100px;padding-bottom:10px">
                    <h6 style="font-size: 14px;font-weight: 600;color: #414141;">Qty</h6>
                </td>
                <td style="padding-top: 100px;padding-bottom:10px">
                    <h6 style="font-size: 14px;font-weight: 600;color: #414141;">Rate</h6>
                </td>
                <td style="padding-top: 100px;padding-bottom:10px">
                    <h6 style="font-size: 14px;font-weight: 600;color: #414141;">Amount</h6>
                </td>
            </tr>
            <!-- *************************** -->

            @foreach ($invoiceDetails as $invoiceDetail)
            <tr>
                <td class="no"  style="font-size: 14px;font-weight: 400;color: #979494;width:50px">{{ $loop->index + 1 }}</td>
                <td class="text-left"  style="font-size: 14px;font-weight: 400;color: #979494;width:250px">{{ $invoiceDetail->realationWithProduct->name }}</td>
                <td class="unit"  style="font-size: 14px;font-weight: 400;color: #979494;width:150px">{{ $invoiceDetail->quantity }}</td>
                <td class="qty"  style="font-size: 14px;font-weight: 400;color: #979494;width:200px">{{ $invoiceDetail->unit_price }}</td>
                <td class="qty"  style="font-size: 14px;font-weight: 400;color: #979494;width:150px"> {{ $invoiceDetail->unit_price*$invoiceDetail->quantity }}</td>
            </tr>
            @endforeach

            <tr class="">

                <td colspan="3" style="text-align: right;">
                </td>
                <td colspan="1" style="line-height: 1.7;padding-top:50px">
                    <p style="font-size: 14px;font-weight: 600;color: #414141;">SubTotal</p>
                    <p style="font-size: 14px;font-weight: 600;color: #414141;">Discount</p>
                    <p style="font-size: 14px;font-weight: 600;color: #414141;">Tex</p>
                    <p style="font-size: 14px;font-weight: 600;color: #414141;">Total Due</p>
                    <p style="font-size: 14px;font-weight: 600;color: #414141;">Total Price</p>

                </td>
                <td colspan="1" style="line-height: 1.7;padding-top:50px">
                    <p style="font-size: 14px;font-weight: 600;color: #414141;">{{ $invoice->sub_total }} <span>tk</span> </p>
                    <p style="font-size: 14px;font-weight: 600;color: #414141;">{{ $invoice->total_discount }} <span>tk</span> </p>
                    <p style="font-size: 14px;font-weight: 600;color: #414141;">{{ $invoice->total_tax }} <span>tk</span> </p>
                    <p style="font-size: 14px;font-weight: 600;color: #414141;">{{ $invoice->due }} <span>tk</span> </p>
                    <p style="font-size: 14px;font-weight: 600;color: #414141;">{{ $invoice->total_price}} <span>tk</span> </p>
                </td>
            </tr>
            <!-- Product Item Showing End  -->
        </tbody>
        <!-- table body end  -->
    </table>
    <!-- Table End -->
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice-EPOS</title>
    <!-- Google Fonts Start -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- Google Fonts End -->
    <style>
        body {
        font-family: "Work Sans", sans-serif;
        font-optical-sizing: auto;
        margin: 0;
        padding: 100px;
        }
        table{
            table-layout:auto;
            border-collapse: collapse;
        }
        tr,td{
            vertical-align: top;
        }
        td{
            padding: 10px;
        }
        h1,h2,h3,h4,h5,h6,a,p{
            margin: 0;
            padding: 0;
        }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body bgcolor="#010101">
    <table style="max-width: 1200px;min-width: 60%;background: #ffffff;margin: 0 auto;" border="0" cellpadding="0" cellspacing="0">
        <thead style="background: #251a1a;">
            <tr>
                <td style="padding: 0 50px;">
                    <!-- ===== Column Two Start ===== -->
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td width="50%" style="padding: 5px;">
                            <picture>
                                <img style="width: 100px;" src="https://i.ibb.co/8m67qKd/pngegg-1.png" alt="">
                            </picture>
                        </td>
                        <td width="50%" style="text-align: right;position: relative;">
                            <h6 style="display: inline-block;background: #9b0606;color: #ffffff; text-transform: uppercase;font-size: 62px;position: absolute;right: 50px;top: 0px;height: 70px;padding: 20px;padding-top: 80px;">Invoice</h6>
                        </td>
                     </tr>
                    </table>
                    <!-- ===== Column Two End ===== -->
                </td>
            </tr>
        </thead>
        <tbody>
            <!-- Invoice Info Start  -->
            <tr>
                <td style="padding: 0px 50px;">
                      <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
                        <tr>
                            <td width="33%" style="padding: 5px;">
                                <p><a style="color: #585858;font-size: 14px;line-height: 1.7;font-weight: 600;" href="https://wa.me/+88012365478">Whats.: +880 12365478</a></p>
                                <p><a style="color: #585858;font-size: 14px;line-height: 1.7;font-weight: 600;" href="mailto:36bdshop@gmail.com">36bdshop@gmail.com</a></p>

                            </td>
                            <td width="33%" style="padding: 5px;">
                                <p style="color: #585858;font-size: 14px;line-height: 1.7;font-weight: 600;">
                                    2A/3B, NilaKunjon-Juoran,TaiYan
                                </br>
                                    Na,Br-236Road
                                </p>

                            </td>
                            <td width="33%" style="padding: 5px;padding-top: 120px;padding-left: 20px;">

                                <!-- ===== Column Two Start ===== -->
                                <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
                                  <tr>
                                    <td width="50%" style="padding:0 5px;">
                                        <p style="color: #363636;font-size: 14px;line-height: 1.7;font-weight: 600;">Invoice</p>
                                    </td>
                                    <td width="50%" style="padding:0 5px;">
                                        <p style="color: #585858;font-size: 14px;line-height: 1.7;font-weight: 600;">: inv0023214</p>
                                    </td>
                                 </tr>
                                  <tr>
                                    <td width="50%" style="padding:0 5px;">
                                        <p style="color: #363636;font-size: 14px;line-height: 1.7;font-weight: 600;">Date</p>
                                    </td>
                                    <td width="50%" style="padding:0 5px;">
                                        <p style="color: #585858;font-size: 14px;line-height: 1.7;font-weight: 600;">: 2 Jan, 2024</p>
                                    </td>
                                 </tr>
                                  <tr>
                                    <td width="50%" style="padding:0 5px;">
                                        <p style="color: #363636;font-size: 14px;line-height: 1.7;font-weight: 600;">Due Date</p>
                                    </td>
                                    <td width="50%" style="padding:0 5px;">
                                        <p style="color: #585858;font-size: 14px;line-height: 1.7;font-weight: 600;">: 20 Mar, 2024</p>
                                    </td>
                                 </tr>
                                  <tr>
                                    <td width="50%" style="padding:0 5px;">
                                        <p style="color: #363636;font-size: 14px;line-height: 1.7;font-weight: 600;">Customer Id</p>
                                    </td>
                                    <td width="50%" style="padding:0 5px;">
                                        <p style="color: #585858;font-size: 14px;line-height: 1.7;font-weight: 600;">: cus_102302</p>
                                    </td>
                                 </tr>
                                </table>
                                <!-- ===== Column Two End ===== -->


                            </td>
                        </tr>
                      </table>
                </td>
            </tr>
            <!-- Invoice Info End  -->
            <!-- Invoice To Info Start  -->
            <tr>
                <td style="padding: 20px 50px;">
                    <p style="color: #00000086;font-size: 24px;text-transform: uppercase;">Invoice To</p>
                    <p style="color: #9b0606;font-size: 32px;font-weight: 700;padding-bottom: 20px;">Mr. Kamal Uddin</p>
                    <p><a style="color: #585858;font-size: 14px;line-height: 1.7;font-weight: 600;" href="https://wa.me/+88012365478">Whats.: +880 12365478</a></p>
                    <p><a style="color: #585858;font-size: 14px;line-height: 1.7;font-weight: 600;" href="mailto:36bdshop@gmail.com">kamaluddin@gmail.com</a></p>
                    <p style="color: #585858;font-size: 14px;line-height: 1.7;font-weight: 600;">
                        2A/3B, NilaKunjon-Juoran,TaiYan
                    </br>
                        Na,Br-236Road
                    </p>

                </td>
            </tr>
            <!-- Invoice To Info End  -->
            <!-- Invoice Details Start -->
            <tr>
                <td style="padding: 0 50px;">
                      <table width="100%" cellspacing="0" style="border: 1px solid #9b060600;" cellpadding="0" border="0" bgcolor="#ffffff">
                          <tr style="background:#9b0606;">
                                 <td width="10%" style="padding: 10px;">
                                    <p style="color: #ffffff;font-size: 14px;text-transform: uppercase;font-weight: 700;">No</p>
                                 </td>
                                 <td width="40%" style="padding: 10px;">
                                    <p style="color: #ffffff;font-size: 14px;text-transform: uppercase;font-weight: 700;">Description</p>
                                 </td>
                                 <td width="15%" style="padding: 10px;text-align: center;">
                                    <p style="color: #ffffff;font-size: 14px;text-transform: uppercase;font-weight: 700;">QTY</p>
                                 </td>
                                 <td width="15%" style="padding: 10px;text-align: center;">
                                    <p style="color: #ffffff;font-size: 14px;text-transform: uppercase;font-weight: 700;">price</p>
                                 </td>
                                 <td width="20%" style="padding: 10px;text-align: center;">
                                    <p style="color: #ffffff;font-size: 14px;text-transform: uppercase;font-weight: 700;">Total</p>
                                 </td>
                           </tr>
                           <!-- ********** Item Start ******** -->
                            <tr style="background:#ffffff;border-bottom: 1px solid #c7b9b9;">
                                <td width="10%" style="padding: 10px;background: #9b06068f;">
                                <p style="color: #ffffff;font-size: 14px;text-transform: uppercase;font-weight: 700;">1</p>
                                </td>
                                <td width="40%" style="padding: 10px;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">Laptop</p>
                                </td>
                                <td width="15%" style="padding: 10px;text-align: center;background: #e9cece;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">5pcs</p>
                                </td>
                                <td width="15%" style="padding: 10px;text-align: center;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">45000tk</p>
                                </td>
                                <td width="20%" style="padding: 10px;text-align: center;background: #eeb6b6;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">225000tk</p>
                                </td>
                            </tr>
                            <tr style="background:#ffffff;border-bottom: 1px solid #c7b9b9;">
                                <td width="10%" style="padding: 10px;background: #9b06068f;">
                                <p style="color: #ffffff;font-size: 14px;text-transform: uppercase;font-weight: 700;">2</p>
                                </td>
                                <td width="40%" style="padding: 10px;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">Laptop</p>
                                </td>
                                <td width="15%" style="padding: 10px;text-align: center;background: #e9cece;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">5pcs</p>
                                </td>
                                <td width="15%" style="padding: 10px;text-align: center;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">45000tk</p>
                                </td>
                                <td width="20%" style="padding: 10px;text-align: center;background: #eeb6b6;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">225000tk</p>
                                </td>
                            </tr>
                            <tr style="background:#ffffff;border-bottom: 1px solid #c7b9b9;">
                                <td width="10%" style="padding: 10px;background: #9b06068f;">
                                <p style="color: #ffffff;font-size: 14px;text-transform: uppercase;font-weight: 700;">3</p>
                                </td>
                                <td width="40%" style="padding: 10px;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">Laptop</p>
                                </td>
                                <td width="15%" style="padding: 10px;text-align: center;background: #e9cece;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">5pcs</p>
                                </td>
                                <td width="15%" style="padding: 10px;text-align: center;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">45000tk</p>
                                </td>
                                <td width="20%" style="padding: 10px;text-align: center;background: #eeb6b6;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">225000tk</p>
                                </td>
                            </tr>
                            <tr style="background:#ffffff;border-bottom: 1px solid #c7b9b9;">
                                <td width="10%" style="padding: 10px;background: #9b06068f;">
                                <p style="color: #ffffff;font-size: 14px;text-transform: uppercase;font-weight: 700;">4</p>
                                </td>
                                <td width="40%" style="padding: 10px;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">Laptop</p>
                                </td>
                                <td width="15%" style="padding: 10px;text-align: center;background: #e9cece;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">5pcs</p>
                                </td>
                                <td width="15%" style="padding: 10px;text-align: center;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">45000tk</p>
                                </td>
                                <td width="20%" style="padding: 10px;text-align: center;background: #eeb6b6;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">225000tk</p>
                                </td>
                            </tr>

                            <tr style="background:#ffffff;border-bottom: 1px solid #c7b9b9;">
                                <td width="10%" style="padding: 10px;background: #9b06068f;">
                                <p style="color: #ffffff;font-size: 14px;text-transform: uppercase;font-weight: 700;">5</p>
                                </td>
                                <td width="40%" style="padding: 10px;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">Laptop</p>
                                </td>
                                <td width="15%" style="padding: 10px;text-align: center;background: #e9cece;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">5pcs</p>
                                </td>
                                <td width="15%" style="padding: 10px;text-align: center;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">45000tk</p>
                                </td>
                                <td width="20%" style="padding: 10px;text-align: center;background: #eeb6b6;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">225000tk</p>
                                </td>
                            </tr>


                            <!-- ****** Invoice Calculate ****** -->
                            <tr style="background:#ffffff;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td width="15%" style="padding: 10px;text-align: left;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">Sub Total</p>
                                </td>
                                <td width="20%" style="padding: 10px;text-align: center;background: #eeb6b6;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">225000tk</p>
                                </td>
                            </tr>
                            <tr style="background:#ffffff;;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td width="15%" style="padding: 10px;text-align: left;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">Tax</p>
                                </td>
                                <td width="20%" style="padding: 10px;text-align: center;background: #eeb6b6;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">2200tk</p>
                                </td>
                            </tr>
                            <tr style="background:#ffffff;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td width="15%" style="padding: 10px;text-align: left;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">Grand Total</p>
                                </td>
                                <td width="20%" style="padding: 10px;text-align: center;background: #eeb6b6;">
                                <p style="color: #585858;font-size: 14px;text-transform: uppercase;font-weight: 700;">32225000tk</p>
                                </td>
                            </tr>


                      </table>
                </td>
            </tr>

            <tr>
                <td style="padding: 20px 50px;padding-top: 100px;">
                    <!-- ===== Column Two Start ===== -->
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
                      <tr>
                        <td width="50%" style="padding: 5px;vertical-align: bottom;">

                            <p style="color: #9b0606;font-size: 14px;font-weight: 700;">Terms And Condition</p>
                        </td>
                        <td width="50%" style="padding: 5px;">
                            <div>
                                <img src="" alt="">
                                <h2 style="font-weight: 600;font-size: 18px;color: #363636;text-align: right;padding-right: 20px;">Usman Ali</h2>
                                <h6 style="font-weight: 600;font-size: 14px;color: #919191;text-align: right;padding-right: 20px;">General Manager</h6>
                            </div>
                        </td>
                     </tr>
                    </table>
                    <!-- ===== Column Two End ===== -->
                </td>
            </tr>


            <!-- Invoice Details End -->
        </tbody>
        <tfoot style="background: #e9cece;">
            <tr>
                <td style="padding: 0 50px;">
                    <!-- ===== Column Two Start ===== -->
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td width="50%" style="padding: 5px; padding-right: 20px;">
                            <p style="color: #363636;font-size: 14px;line-height: 1.7;font-weight: 500;"> ipsum dolor, sit amet consectetur adipisicing elit. Dolorem, Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorem, soluta?</p>
                        </td>
                        <td width="50%" style="padding: 5px;text-align: right;">
                            <p style="color: #363636;font-size: 14px;line-height: 1.7;font-weight: 500;">Thanks for your business</p>
                        </td>
                     </tr>
                    </table>
                    <!-- ===== Column Two End ===== -->
                </td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
