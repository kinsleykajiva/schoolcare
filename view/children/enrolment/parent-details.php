<div class="row" id="divRow_ParentDetails" >
	<div class="col-sm-12">
		<!-- Basic Form Inputs card start -->
		<div class="card">

			<div class="card-block">
				<div class="row">
					<h4 class="col-sm-12 sub-title ">
						Parent <span id="parentCount">1</span> Details
						<div class="btn-group " style="float: right;display: none;" role="group" data-toggle="tooltip" data-placement="top" title="" data-original-title="Parents Navigation">
							<button id="btnParentPrev"  onclick="onParentPrev()" type="button" style="margin-right: 10px;display: none;" class="btn btn-primary btn-mini waves-effect waves-light"><i class="icofont icofont-arrow-left"></i> Prev</button>

							<button id="btnParentNext" onclick="onParentNext()" type="button" style="margin-left: 10px;display: none;" class="btn btn-primary btn-mini waves-effect waves-light"><i class="icofont icofont-arrow-right"></i> Next</button>
						</div>
					</h4>

				</div>

				<form onsubmit="return false;">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Name</label>
						<div class="col-sm-10">
							<input type="text" id="parentName" class="form-control">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Surname</label>
						<div class="col-sm-10">
							<input type="text" id="parentSurname" class="form-control">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">ID Number</label>
						<div class="col-sm-10">
							<input type="text" id="parentIDNumber" class="form-control">
						</div>
					</div>


					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Gender</label>
						<div class="col-sm-10">
							<select name="select" id="parentSex" class="form-control">
								<option value="null" selected="selected">Select </option>
								<option value="female">Female</option>
								<option value="male">Male</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Occupation</label>
						<div class="col-sm-10">
							<input type="text" id="parentOccupation" class="form-control">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Phone</label>
						<div class="col-sm-10">
							<input type="text" id="parentPhone" class="form-control" onpaste="return false;" data-inputmask-mask="(+27)99-999-9999" data-val="true" data-val-required="Required" >
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-10">
							<input type="text" id="parentEmail" class="form-control"  data-inputmask-alias="email" data-val="true" data-val-required="Required">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Home Address</label>
						<div class="col-sm-10">
							<input type="text" id="parentHomeAddress" placeholder="comma separate" class="form-control">
						</div>
					</div>


					<div class="form-group row" style="display: none;">
						<label class="col-sm-2 col-form-label">Static Text</label>
						<div class="col-sm-10">
							<div class="form-control-static">Hello !... This is
								static text
							</div>
						</div>
					</div>
					<div class="form-group row" >

						<div class="col-sm-10">
							<div class="form-control-static">
								.
							</div>
						</div>
						<div class="col-sm-2 ">
							<button onclick="onNextToChildDetails()" class="btn btn-info btn-round btn-sm ">Next <i class="fa fa-arrow-right"></i></button>
						</div>
					</div>

				</form>


			</div>
		</div>
		<!-- Basic Form Inputs card end -->


	</div>
</div>