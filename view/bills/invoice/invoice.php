<div class="card-block table-border-style">
    <div clasS="row clearfix" style="margin-bottom:20px;">
        <div class="col-lg-8"> Make Invoice On The Fly</div>
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
            <button onclick="onSaveInvoice()" clasS=" btn btn-mini btn-success btn-round pull-right"> Generate Inv.
            </button>
        </div>
    </div>
    <div clasS="row clearfix" style="margin-bottom:20px;">
        <div class="col-lg-4">
            <label>To </label>
            <input class="form-control" id='toName' placeholder="Mr/Mrs. ..." type="text">
        </div>
        <div class="col-lg-4">
            <label>Due Date </label>
            <input class="form-control" id='toDueDate' type="date">
        </div>
        <div class="col-lg-4">

        </div>
    </div>
    <div clasS="row clearfix" style="margin-bottom:20px;">
        <div class="col-lg-4">
            <label>Phone Number</label>
            <input class="form-control" id='toPhone' type="text">
        </div>
        <div class="col-lg-4">
            <label>Email</label>
            <input class="form-control" id='toEmail' type="email">
        </div>
        <div class="col-lg-4">
            <label>Address</label>
            <input class="form-control" id='toAddress' type="address">
            <!-- <textarea class="form-control"></textarea> -->
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-md-12">
            <table class="table table-bordered table-hover" id="tab_logic">
                <thead>
                <tr>
                    <th class="text-center"> #</th>
                    <th class="text-center"> Item</th>
                    <th class="text-center"> Qty</th>
                    <th class="text-center"> Price</th>
                    <th class="text-center"> Total</th>
                </tr>
                </thead>
                <tbody>
                <tr id='addr0'>
                    <td>1</td>
                    <td><input type="text" name='product[]' placeholder='Enter item Name/Description'
                               class="form-control product"/></td>
                    <td><input type="number" name='qty[]' placeholder='Enter Qty' class="form-control qty" step="any"
                               min="0"/></td>
                    <td><input type="number" name='price[]' placeholder='Enter Unit Price' class="form-control price"
                               step="any" min="0"/></td>
                    <td><input type="text" name='total[]' placeholder='0.00' class="form-control total" readonly/></td>
                </tr>
                <tr id='addr1'></tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="row clearfix">
        <div class="col-md-12" style="margin: 10px;">
            <button id="add_row" class="btn btn-info btn-round btn-mini pull-left"><i class="ti-plus"></i>Add</button>
            <button id='delete_row' class="pull-right btn btn-warning btn-mini btn-round "><i class="ti-minus"></i>Remove
            </button>
        </div>
    </div>
    <div class="row clearfix" style="margin-top:20px">
        <div class="pull-right col-md-8"></div>
        <div class="pull-right col-md-4">
            <table class="table table-bordered table-hover" id="tab_logic_total">
                <tbody>
                <tr>
                    <th class="text-center">Sub Total</th>
                    <td class="text-center"><input type="number" name='sub_total' placeholder='0.00'
                                                   class="form-control" id="sub_total" readonly/></td>
                </tr>
                <tr>
                    <th class="text-center">Tax</th>
                    <td class="text-center">
                        <div class="input-group mb-2 mb-sm-0">
                            <input type="number" step="any" class="form-control" id="tax" placeholder="0">
                            <div class="input-group-addon">%</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center">Tax Amount</th>
                    <td class="text-center"><input type="text" name='tax_amount' id="tax_amount" placeholder='0.00'
                                                   class="form-control" readonly/></td>
                </tr>
                <tr>
                    <th class="text-center">Grand Total</th>
                    <td class="text-center"><input type="text" name='total_amount' id="total_amount" placeholder='0.00'
                                                   class="form-control" readonly/></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>