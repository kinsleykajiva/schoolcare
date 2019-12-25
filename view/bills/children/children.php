<div class="">
	<button id="btnPostSlected" style="display: none;" onclick="postChildrenDialog()" class="btn btn-mini btn-info btn-round"><i class="fa fa-address-book-o" aria-hidden="true"></i>
		 Post</button>
	<div class="card-block table-border-style">
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
					<td>Mark</td>
					<td>R 000</td>
					<td>
						<div class="dropdown-default dropdown open">
							<button class="btn btn-default btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Option</button>
							<div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">

								<a class="dropdown-item waves-light waves-effect" href="#">Edit</a>
							</div>
						</div>
					</td>
				</tr>

				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="" id="receiveChildPaymentDialog" data-izimodal-title="Receive Payment Dialog" >
    <span id="child_payment_yeared" style="display: none;"></span>
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
							<select  id="editFeeTitle" class="form-control form-control-normal selectpicker" >
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
				<button onclick="saveChildPayment()" class="col-sm-2 btn btn-info btn-round">Save Payment</button>
				<div class="col-sm-10">

				</div>
			</div>
		</form>
	</div>
</div>
