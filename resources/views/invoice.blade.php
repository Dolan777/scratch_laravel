<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>INVOICE</title>
        <style type="text/css">
            .clearfix:after {
                content: "";
                display: table;
                clear: both;
            }

            a {
                color: #0087C3;
                text-decoration: none;
            }

            body {
                position: relative;
                width:100%;  
                height: 29.7cm; 
                margin: 0 auto; 
                color: #555555;
                background: #FFFFFF; 
                font-family: Arial, sans-serif; 
                font-size: 14px; 
                font-family:Arial, Helvetica, sans-serif;
            }

            header {
                padding: 10px 0;
                margin-bottom: 20px;
                border-bottom: 1px solid #AAAAAA;
            }

            #logo {
                float: left;
                margin-top: 8px;
                margin: 0;
            }

            #logo img {
                height: 160px;
            }

            #pdf-rgt-part {
                float: right;
                text-align: right;
            }


            #details {
                margin-bottom: 50px;
            }

            #client {
                padding-left: 3px;
                border-left: 3px solid #0087C3;
                float: left;
                width: 400px;
            }

            #client .to {
                color: #777777;
            }

            h2.name {
                font-size: 1.4em;
                font-weight: normal;
                margin: 4px 0 0 0;
            }
            h2.name2 {
                font-size: 1.4em;
                font-weight: normal;
                margin: 0;
            }
            #invoice {
                float: right;
                text-align: right;
                width: 300px;
            }

            #invoice h1 {
                color: #0087C3;
                font-size: 15px;
                line-height: 1em;
                font-weight: bold;
                margin: 0 0 10px 0;
            }

            #invoice .date {
                font-size: 1.1em;
                color: #777777;
            }

            table {
                    width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                font-size: 16px;
                margin-bottom: 20px;
            }


            table td {
                padding: 10px;
                /* background: #EEEEEE;*/
                text-align: center;
                border-bottom: 1px solid #eee;
            }

            table th {padding: 10px;
                      text-align: right;
                      border-bottom: 1px solid #FFFFFF;
                      white-space: nowrap;        
                      font-weight: normal;
                      white-space: nowrap;
                      font-weight: normal;
                      background: #8bd2eb;
                      font-size: 16px;
                      font-weight: 600;
                      text-align: left;
                      color: #333;
            }

            table td {
                text-align: right;
            }

            table td h3{
                color: #666;
                font-weight: 600;
                font-size: 16px;
                /* font-weight: normal; */
                margin: 0 0 0.2em 0;
            }

            table .no {
                /* color: #191717; */
                text-align: left;
                color: #333;
                /* background: #045169; */
                /*                border-left: 1px solid #eee !important;*/
                border-bottom: 1px solid #eee !important;
            }

            table .desc {
                text-align: left;
            }
            table .desc h3{
                max-width: 300px;
            }
            table .desc p{
                max-width: 300px;
            }

            table .unit {
                /* background: #DDDDDD;*/
                text-align: center;
            }

            table .qty {
                text-align: center;
            }

            table .total {
                /* background: #35add2;
                 color: #FFFFFF;*/
                border-right: 1px solid #eee !important;
            }

            table td.unit,
            table td.qty,
            table td.total {
                font-size: 16px;
                text-align: center;
            }

            table tbody tr td {
                border: none;     
                border-bottom: 1px solid #eee;
                /*                border-right: 1px solid #eee;*/
            }

            table tfoot td {
                padding: 10px;
                background: #FFFFFF;
                border-bottom: none;
                font-size: 15px;
                white-space: nowrap;  
            }

            table tfoot tr:first-child td {
                border-top: none; 
            }

            table tfoot tr:last-child td {
                /*color: #57B223;*/
                font-size: 16px;
                /*  border-top: 1px solid #57B223; */

            }

            table tfoot tr td:first-child {
                border: none;
            }

            #thanks{
                font-size: 2em;
                margin-bottom: 50px;
            }

            #notices{
                padding-left: 6px;
                border-left: 6px solid #0087C3;  
            }

            #notices .notice {
                font-size: 14px;
            }

            footer {
                color: #045169;
                width: 100%;
               position: absolute; 
                bottom: 0;
                padding: 18px 0px;
                text-align: center;
                margin-top: 20px;
                background-color:#8bd2eb;
            }
            footer .left-part{
                display: inline-block;
                float: left;
                padding-left: 15px; font-size: 16px;
                font-weight: 600;
                padding-left: 15px;  
            }
            footer .right-part{
                display: inline-block;
                float: right;
                padding-right: 15px;  
                font-size: 16px;
                font-weight: 600;
            }
            @page {
                header: html_MyCustomHeader;
                margin-header:0mm;
                margin-top:5mm;
            }



            #student-name{
                display: inline-block;
            }
            #pdf-rgt-part {
                float: right;
                text-align: right;
            }
            #pdf-rgt-part h2{
                font-size: 2.5em;
                color: #008ec3;
                font-weight: 400;
            }
            #pdf-rgt-part ul li{
                list-style: none;
                color: #008ec3;
                font-size: 1.1em;
            }
            #pdf-rgt-part ul{
                margin: 5px 0px;
                    float: right;
            }
            #pdf-rgt-part ul li span{
                list-style: none;
                color: #008ec3;
                font-size: 1.1em;
                font-weight: 600;
                padding-left: 15px;
                min-width: 90px;
                display: inline-block;
                text-align: right;
            }

            #pdf-rgt-part h3{
                list-style: none;
                color: #008ec3;
                font-size: 1.5em;
                font-weight: 600;
                padding-left: 15px;
                min-width: 90px;
                display: inline-block;
                text-align: left;
                margin: 10px 0px;
            }
            .disp-tbl{
                display: table;
                width: 100%;
            }
            .disp-tbl-cell{
                display: table-cell;
                float: none;
                vertical-align: top;
            }
            .invo-lft-part{
                text-align: left;
                color: #666;
            }
            .invo-lft-part h1{
                font-size: 1.5em;
                margin-top: 0;
                margin-bottom: 5px;
            }
            .invo-lft-part h2{
                font-size: 1.2em;
                margin-top: 0;
            }
            .invo-lft-part ul{
                padding-left: 0px;
            }
            .invo-lft-part ul li{
                font-size: 1.2em;
                list-style: none;
                font-weight: 400;
            }
            .invo-mid-part{
                text-align: center;
            }
            .invo-mid-part h2{
                text-align: center;
                margin: 0;
                font-size: 1.5em;
                margin-bottom: 5px;
            }
            .invo-mid-part h2 span{
                display: block;
                font-size: 0.8em;
                font-weight: 400;
            }
            .invo-right-part{
                text-align:right;
            }
            .invo-right-part h3{
                font-size:2em;
                color: #008ec3;
                margin: 0;
                font-weight: 400;
            }
            .top-part {
                margin-bottom:10px;
            }
            .ttl-prc{
                font-size: 22px !important;
                color: #008ec3;
                margin: 0;
                font-weight: 400;
            }
            .ttl-prc-amnt{
                font-size: 27px !important;
                color: #008ec3;
                margin: 0;
                font-weight: 400;
            }
            .footer-nw-td{
                /*                background-color: #f5f5f5;
                                text-align: left;
                                padding: 15px;*/
            }
            .footer-nw-td h1{
                font-size: 14px;
                margin-top: 0;
                margin-bottom: 5px;
                max-width: 300px;
            }
            .footer-nw-td h2{
                font-size: 14px;
                margin-top: 0;    
                margin-bottom: 5px;
                max-width: 300px;
            }
            .footer-nw-td ul{
                padding-left: 0;
                margin-top: 0;    
                margin-bottom: 5px;
            }
            .footer-nw-td ul li{
                list-style: none;
                font-size: 14px;
            }

            tfoot{
                vertical-align: top;
                /*                border-top: 20px solid #ffff;*/
            }
            .ttl-prc{
                width: 100px;
            }
            .bg-div{
                background-color: #f5f5f5;
                text-align: left;
                padding: 15px;
            }
        </style>
    </head>
    <body>
    <htmlpageheader name="MyCustomHeader">
        <header class="clearfix">
            <div class="top-part clearfix">
                <div id="logo" style="width: 50%">
                    <img style="width: 250px;" src="{{ URL::asset('themes/frontend/assets/images/invoicelogo.png')}}" border="0" alt="0" />                                                            
                </div>

                <div id="pdf-rgt-part" style="width: 50%">
                    <h2 class="name"> INVOICE</h2>
                    <ul>
                        <li><span style="text-align:left;">Date:</span><span style="font-weight: 600; text-align: right;min-width: 100px;">{{date('d/m/Y')}}</span></li>
                        <li><span style="text-align:left;">Invoice #:</span><span style="font-weight: 600; text-align: right;min-width: 100px;">{{$model->invoice_id}}</span></li>
                    </ul>

                </div>
            </div>
            <div class="bottom-part clearfix disp-tbl">
                <div class="invo-lft-part disp-tbl-cell" style="width: 35%">
                    <h1>Sci-fi Cafe</h1>
                    <h2>ABN: 80789394799</h2>
                    <ul>
                        <li>Shop 1050</li>
                        <li>Westfield Hornsby</li>
                    </ul>
                </div>
                <div class="invo-mid-part disp-tbl-cell" style="width: 30%">
                    <h2 class="bill-to"> Bill To:<span>{{$user->name}}</span></h2>
                </div>
                <div class="invo-right-part disp-tbl-cell" style="width: 35%">
                    <h3 class="total-prc"><span>Total Due:</span> ${{$net_amount}}</h3>
                </div>

            </div>

        </header>
    </htmlpageheader>
    <main>

        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="no">Date</th>
                    <th class="desc">Description</th>
                    <th class="unit">Charges</th>
                    <th class="qty">Payments</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $students = \App\Model\Student::where('user_master_id', $user->id)->where('status', '1')->get()->all();
                foreach ($students as $student) {

                    $batches = [];
                    $batch_m = \App\Model\BatchStudent::where('student_id', $student->id)->where('status', '1')->get()->all();
                    foreach ($batch_m as $bat) {
                        if (!in_array($bat->batch_master_id, $batches)) {
                            array_push($batches, $bat->batch_master_id);
                        }
                    }

                    $events = DB::select(DB::raw("SELECT be.*, um.name as teacher_name, bm.batch_name as batch_name from batch_event as be left join batch_master as bm on bm.id=be.batch_master_id left join user_master as um on um.id=be.teacher_id WHERE (be.date between :start_date and :end_date) and be.status='1' and be.batch_master_id IN (" . implode(',', $batches) . ")"), array(
                                'start_date' => $model->start_date,
                                'end_date' => $model->end_date
                    ));


                    if (count($events) > 0) {
                        foreach ($events as $row) {
                            ?>


                            <tr>
                                <td class="no">{{$row->date}}</td>
                                <td class="desc">
                                    <h3>{{$student->name}}</h3>
                                    <p><?php echo date_format(new \DateTime($row->start_time), 'g:i a'); ?>  {{$row->batch_name}} Lesson with {{$row->teacher_name}} {{$student->name}} Student</p>
                                </td>
                                <td class="unit">${{$row->event_price}}</td>
                                <td class="qty"></td>
                            </tr>
        <?php }
    }
} ?>

                @if($gift_amount > 0){
                <tr>
                    <td class="no"></td>
                    <td class="desc">
                        <h3>Use Gift Card</h3>
                        <p></p>
                    </td>
                    <td class="unit">${{$gift_amount}}</td>
                    <td class="qty"></td>
                </tr>
                @endif
                @if($discount>0){
                <tr>
                    <td class="no"></td>
                    <td class="desc">
                        <h3>Sci-fi Cafe Discount</h3>
                        <p></p>
                    </td>
                    <td class="unit">${{$discount}}</td>
                    <td class="qty"></td>
                </tr>
                @endif

                <tr>
                    <td class="no"></td>
                    <td class="desc">
                        <h3>Taxes (Included In Total)</h3>
                        <p>GST - {{$gst_val}}%</p>
                    </td>
                    <td class="unit">${{$gst_amount}}</td>
                    <td class="qty"></td>
                </tr>



            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="footer-td footer-nw-td">
                        <div class="bg-div">
                            <h1>Please use invoice number as the reference for online banking.</h1>
                            <ul>
                                <li>
                                    <span>Bank:</span>Bankwest
                                </li>
                                <li>
                                    <span>Account Name:</span>Sci-fi Cafe Pty Ltd
                                </li>
                                <li>
                                    <span>BSB:</span>302-964
                                </li>
                                <li>
                                    <span>Account:</span>0177419
                                </li>
                            </ul>
                            <h2>Or you can pay by credit card online: http://bit.ly/2kJBmqD</h2>
                        </div>
                    </td>

                    <td style="border-top:1px solid #eee; " class="ttl-prc">Total Due:</td>
                    <td style="border-top:1px solid #eee;"  class="ttl-prc-amnt"><span class="ttl-prc">${{$net_amount}}</span></td>
                </tr>

            </tfoot>
        </table>

    </main>
    <footer class="clearfix">
        <div class="left-part">Sci-fi Cafe</div>
        <div class="right-part">Invoice</div>
    </footer>
</body>
</html>
