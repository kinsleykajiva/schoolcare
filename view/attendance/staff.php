<div class="page-header card">
	<div class="card-block">
		<button onclick="openClockInDialog();" class="btn btn-mini btn-round btn-info"> <i class="fa fa-clock-o"></i> Clock In</button>


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
		                    <label class="col-sm-2 col-form-label">Staff</label>
		                    <div class="col-sm-10">
			                    <select id="select_staff" class="form-control form-control-bold">

			                    </select>
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
                            <button onclick="saveClockIn()" class="col-sm-2 btn  btn-round btn-mini btn-info col-form-label" >Save</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="" id="ClockOutDialog" data-izimodal-title="Clock out Dialog">
<span id="selected_att_id" style='display:none;'></span>
    <div class="row">
        <div class="col-sm-12">
            <div class="">
                <div class="card-block">
                    <form onsubmit="return false;">
	                    <div class="form-group row">
		                    <label class="col-sm-2 col-form-label">Staff</label>
		                    <div class="col-sm-10">
			                    <select id="select_staff_out" class="form-control form-control-bold">

			                    </select>
		                    </div>
	                    </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="date" disabled="disabled" id="datetimepicker4_out" class="form-control form-control-normal datepicker" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Time Out</label>
                            <div class="col-sm-10">
	                            <input type="time"  id="timepicker_out" class="form-control form-control-normal datepicker" placeholder="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <button onclick="saveClockOut()" class="col-sm-2 btn  btn-round btn-mini btn-info col-form-label" >Save</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
