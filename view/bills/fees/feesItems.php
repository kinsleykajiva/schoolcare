<div class="">

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