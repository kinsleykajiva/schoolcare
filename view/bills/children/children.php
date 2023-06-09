<div class="">
	<div class="row">
		<div class="col-sm-2">
			<button id="btnPostSlected" style="display: none;" onclick="postChildrenDialog()" class="btn  btn-mini btn-info btn-round">
				<i class="fa fa-address-book-o" aria-hidden="true"></i>	 Post
			</button>
		</div>
		<div class="col-sm-2">
			<button id="btnAddFeesTolected" style="display: none;" onclick="openAddChildToFeesDialog()" class="btn  btn-mini btn-info btn-round">
				<i class="fa fa-address-book-o" aria-hidden="true"></i>	 Add Fees
			</button>
		</div>
	
	
	</div>
	<div class="card-block table-border-style" style="min-height: 300px;">
		<div class="row">
			<div class="col-sm-2">
				<label class="badge badge-primary">FS - Has Fees Structure</label>
			</div>
			<div class="col-sm-1"></div>
			<div class="col-sm-2">
				<label class="badge badge-danger">NF - Has No Fees Structure</label>
			</div>
			<div class="col-sm-2"></div>
		</div>
		<label for="table_select_year_11"></label>
		<select onchange="onchangeYearOnPostTable()" id="table_select_year_11" class="form-control"  ><option></option></select>
		<div class="table-responsive">
			<table class="table">
				<thead>
				<tr>

					<th>

						<div  class="checkbox-fade fade-in-primary">
							<label>
								<input type="checkbox"  id="children_select_all" value="all">
								<span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
								<span class="text-inverse">All</span>
							</label>
						</div>

					</th>
					<th>Name </th>
					<th>Payment Status</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody id="tbody_children_posted">
				<tr>
					<th scope="row">

						<div  class="checkbox-fade fade-in-primary">
							<label>
								<input type="checkbox" value="">
								<span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>

							</label>
						</div>

					</th>
					<td>Loading ....</td>
					<td>Loading...</td>
					<td>
						Loading...
					</td>
				</tr>

				</tbody>
			</table>
		</div>
	</div>
</div>



<div class="" id="receiveChildPaymentDialog" data-izimodal-title="Receive Payment Dialog" >
    <span id="child_payment_yeared" style="display: none;"></span>
    <h6 id="payment_details" ">Nail</h6>
	<div class="card-block">
		<form onsubmit="return false;">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group col-sm-12 ">
						<label class="col-form-label">Amount</label> <br>
						<div class="">
							<input type="number" step="any" id="amountPayment" class="form-control form-control-normal" placeholder="0.00">
						</div>
					</div>
				</div>
				<div class="col-lg-6">
                    <div class="form-group col-sm-12 ">
						<label class=" col-form-label">Payment Type</label> <br>
						<div class="">
							<select  id="typePayment" class="form-control form-control-normal selectpicker" >

								<option value="1">Cash</option>
								<option value="2">Cheque</option>
								<option value="3">Other</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Reference</label>
				<div class="col-sm-10">
					<input type="text"  id="refPayment" class="form-control form-control-normal" placeholder="">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Notes</label>
				<div class="col-sm-10">
					<textarea id="notesPayment" class="form-control form-control-normal" placeholder="Notes/Description"></textarea>
				</div>
			</div>


			<div class="form-group row">
				<button onclick="saveChildPayment()" class="col-sm-4 btn btn-info btn-round">Save Payment</button>
				<div class="col-sm-8">

				</div>
			</div>
		</form>
	</div>
</div>



<div class="" id="addFeePackageToFeesDialog" data-izimodal-title="Add Fee All Selected Children Dialog" >
    <span id="child_payment_yeared" style="display: none;"></span>
    <h6 id="packageCostSelected" >R 0.00</h6>
	<div class="card-block">
		<form onsubmit="return false;">
			<div class="row">

				<div class="col-lg-6">
                    <div class="form-group col-sm-12 ">
						<label class=" col-form-label">Packages</label> <br>
						<div class="">
							<select onchange="onchangefeePaymentPackages();"  id="feePaymentPackages" class="form-control form-control-normal " >


							</select>
						</div>
					</div>
				</div>
                <div class="col-lg-6">
                    <div class="form-group col-sm-12 ">
                        <label class="col-form-label">Fee Item</label> <br>
                        <div class="">
                            <ul id="list_fee_items_for_packag">


                            </ul>
                        </div>
                    </div>
                </div>
			</div>



			<div class="form-group row">
				<button onclick="saveChildrenFeePackages()" class="col-sm-4 btn btn-info btn-round">Save</button>
				<div class="col-sm-8">

				</div>
			</div>
		</form>
	</div>
</div>



