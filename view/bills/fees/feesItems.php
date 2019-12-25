
<div class="">
	<button onclick="openFeeItemDialog()" class="btn btn-mini btn-info btn-round">Add New Fee </button>
	<div class="card-block table-border-style">
		<div class="table-responsive">
			<table class="table">
				<thead>
				<tr>

					<th>Fee </th>
					<th>Total</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody id="tbody_fee_items">
				<tr>

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






<div class="" id="addFeeItemDialog" data-izimodal-title="Add New Fee Dialog">

	<div class="card-block">
		<form onsubmit="return false;">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Fee Title</label>
				<div class="col-sm-10">
					<input type="text" id="newFeeTitle" class="form-control form-control-normal" placeholder="Fee Name">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Fee Amount</label>
				<div class="col-sm-10">
					<input type="number"  id="newFeeAmount" class="form-control form-control-normal" placeholder="Fee Amount">
				</div>
			</div>


			<div class="form-group row">
				<button onclick="saveNewFeeItem()" class="col-sm-2 btn btn-info btn-round">Save Fee</button>
				<div class="col-sm-10">

				</div>
			</div>
		</form>
	</div>
</div>


<div class="" id="editFeeItemDialog" data-izimodal-title="Edit Fee Dialog" >
	<span id="editSelect_feeietm" style="display: none;"></span>
	<div class="card-block">
		<form onsubmit="return false;">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Fee Title</label>
				<div class="col-sm-10">
					<input type="text" id="editFeeTitle" class="form-control form-control-normal" placeholder="Fee Name">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Fee Amount</label>
				<div class="col-sm-10">
					<input type="number"  id="editFeeAmount" class="form-control form-control-normal" placeholder="Fee Amount">
				</div>
			</div>


			<div class="form-group row">
				<button onclick="saveEditFeeItem()" class="col-sm-2 btn btn-info btn-round">Save Fee</button>
				<div class="col-sm-10">

				</div>
			</div>
		</form>
	</div>
</div>

