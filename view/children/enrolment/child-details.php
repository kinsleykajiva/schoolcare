<div class="row" id="divRow_ChildDetails" style="display: none;" >
	<div class="col-sm-12">
		<!-- Basic Form Inputs card start -->
		<div class="card">

			<div class="card-block">
				<h4 class="sub-title">
					Child	<span id="childCount">1</span> Details
					<div class="btn-group " style="float: right;display: none;" role="group" data-toggle="tooltip" data-placement="top" title="" data-original-title="Parents Navigation">
						<button id="btnChildPrev"  onclick="onChildPrev()" type="button" style="margin-right: 10px;display: none;" class="btn btn-primary btn-mini waves-effect waves-light"><i class="icofont icofont-arrow-left"></i> Prev</button>

						<button id="btnChildNext" onclick="onChildNext()" type="button" style="margin-left: 10px;display: none;" class="btn btn-primary btn-mini waves-effect waves-light"><i class="icofont icofont-arrow-right"></i> Next</button>
					</div>
				</h4>
				<form onsubmit="return false;">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Name</label>
						<div class="col-sm-10">
							<input type="text" id="childName" class="form-control">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Surname</label>
						<div class="col-sm-10">
							<input type="text" id="childSurname" class="form-control">
						</div>
					</div>



					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Gender</label>
						<div class="col-sm-10">
							<select name="select" id="childSex" class="form-control">
								<option value="null" selected="selected">Select </option>
								<option value="female">Female</option>
								<option value="male">Male</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Date Of Birth</label>
						<div class="col-sm-10">
							<input type="text" id="childDOB" class="form-control" data-inputmask-alias="yyyy-mm-dd" data-inputmask="'yearrange': { 'minyear': '2010', 'maxyear': '2019' }" data-val="true" data-val-required="Required">
						</div>
					</div>



					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Notes</label>
						<div class="col-sm-10">
							<textarea rows="5" cols="5" id="childNotes" class="form-control" placeholder="any notes on the child"></textarea>
						</div>
					</div>
					<hr>

					<div class="form-group row" >
						<div class="col-sm-2 ">
							<button onclick="onPrevToParent()" class="btn btn-info btn-round btn-sm "><i class="fa fa-arrow-left"></i> Prev </button>
						</div>
						<div class="col-sm-8">
							<div class="form-control-static">
								.
							</div>
						</div>
						<div class="col-sm-2 ">
							<button onclick="onSaveForm()" class="btn btn-info btn-round btn-sm ">Save <i class="fa fa-save"></i></button>
						</div>
					</div>

				</form>


			</div>
		</div>
		<!-- Basic Form Inputs card end -->


	</div>
</div>