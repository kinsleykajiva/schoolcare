<div class="page-header card">
	<div class="card-block">


		<div class="row">
			<!------>
			<div class=" col-lg-2 "><button onclick="openClockInDialog();" class="btn btn-mini btn-info"> <i class="fa fa-clock-o"></i> Clock In</button></div>
			<div class=" col-lg-10 ">
				<select class="form-control" id="selectDateRanges" onchange="renderOnDate()">

				</select>

			</div>
			<!------>
		</div>

	</div>
</div>

<div class="card">
	<div class="card-header">
		<h5>Attendance</h5>

		<div class="card-header-right">
			<ul class="list-unstyled card-option">
				<li><i class="fa fa-chevron-left"></i></li>
				<li><i class="fa fa-window-maximize full-card"></i></li>
				<li><i class="fa fa-minus minimize-card"></i></li>
				<li><i class="fa fa-refresh reload-card-remake"></i></li>

			</ul>
		</div>

	</div>
	<div class="card-block table-border-style">
		<div class="table-responsive" style="min-height: 200px;">
			<table class="table">
				<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Time Signed In</th>
					<th>Time Signed Out</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody id="tbody_data">
				<tr style="display: none;">
					<th scope="row">1</th>
					<td>Mark</td>
					<td>Otto</td>
					<td>@mdo</td>
					<td>@mdo</td>
					<td>
						<div class="dropdown-info dropdown open">
							<button class="btn btn-info dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Info</button>
							<div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
								<a class="dropdown-item waves-light waves-effect" href="#">Action</a>
								<a class="dropdown-item waves-light waves-effect" href="#">Another action</a>
								<a class="dropdown-item waves-light waves-effect" href="#">Something else here</a>
							</div>
						</div>
					</td>
				</tr>

				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="" id="NewClockInDialog" data-izimodal-title="Clock In Dialog">
	<div class="row">
		<div class="col-sm-12">
			<div class="">
				<div class="card-block">
					<form onsubmit="return false;">

						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Kids</label>
							<div class="col-sm-10">
								<div class="row m-t-25 text-left" id="kids_list" style="overflow-y: auto; max-height: 200px;">
									<div class="col-md-12">
										<div class="checkbox-fade fade-in-primary">
											<label>
												<input type="checkbox" value="">
												<span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
												<span class="text-inverse">xxxxxx </span>
											</label>
										</div>
									</div>


								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Date</label>
							<div class="col-sm-10">
								<input type="date" disabled="disabled" id="datetimepicker4" class="form-control form-control-normal datepicker" placeholder="">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Time In</label>
							<div class="col-sm-10">
								<input type="time"  id="timepicker" class="form-control form-control-normal datepicker" placeholder="">
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Rooms</label>
							<div class="col-sm-10">
								<select id="select_rooms"  class="form-control form-control-bold">

								</select>
							</div>
						</div>

						<div class="form-group row">
							<button onclick="saveClockIn()" class="col-sm-2 btn  btn-round btn-mini btn-info col-form-label" >Save</button>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
