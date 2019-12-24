<div class="">
	<button onclick="openNewPackageDialog()" class="btn btn-mini btn-info btn-round">Add New Package</button>
	<div class="card-block table-border-style">
		<div class="table-responsive">
			<table class="table">
				<thead>
				<tr>

					<th>Fee Package</th>
					<th>Total</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody id="tbody_packages">
				<tr>

					<td>Mark</td>
					<td>R 000</td>
					<td>
						<div class="dropdown-default dropdown open">
							<button class="btn btn-default btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Option</button>
							<div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
								<a class="dropdown-item waves-light waves-effect" href="#">Info</a>
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


<div class="" id="NewPackageDialog" data-izimodal-title="New Package Dialog">
    <div class="row">
        <div class="col-sm-12">
            <div class="">
                <div class="card-block">
	                <div class="form-group row">
		                <label class="col-sm-2 col-form-label">Package Title</label>
		                <div class="col-sm-10">
			                <input type="text" id="newPackageTitle" class="form-control form-control-normal" placeholder="">
		                </div>
	                </div>
	                <div class="form-group row">
		                <label class="col-sm-2 col-form-label">Payment Period</label>
		                <div class="col-sm-10">
			                <select id="feePaymentPeriodSelects" class="form-control">

			                </select>
		                </div>
	                </div>
	                <!--<i class="fas fa-angle-double-left"></i>-->
	                <div class="" id="" >

		                <select multiple="multiple" size="10" id="feeItemSelects" class="duallistbox-multi-selection">

		                </select>

	                </div>
	                <br>
	                <br>
	                <button onclick="savePackage();" class="btn btn-info btn-round">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>