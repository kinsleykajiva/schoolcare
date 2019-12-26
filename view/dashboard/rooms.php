
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="card-block">

			<button onclick="openNewRoomDialog()" class="btn btn-round btn-info btn-mini"><i class="fa fa-plus-circle"></i> New Room</button>

		</div>
	</div>
	<!-- Page-header end -->

	<!-- Page-body start -->
	<div class="page-body">
		<!-- Basic table card start -->
		<div class="card">
			<div class="card-header">
				<h5>Rooms</h5>

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
				<div class="table-responsive">
					<table class="table">
						<thead>
						<tr>
							<th>#</th>
							<th>Room</th>
							<th>Age Limits</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody id="tbody_data_row">
						<tr style="display: none;">
							<th scope="row">1</th>
							<td>Mark</td>
							<td>.</td>
							<td>
								<div class="dropdown-info dropdown open">
									<button class="btn btn-default btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Info</button>
									<div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
										<a class="dropdown-item waves-light waves-effect" href="javascript:void(0)">Rename</a>

									</div>
								</div>
                            </td>
						</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- Basic table card end -->





	<!-- Page-body end -->
</div>

	<div class="" id="NewRoomDialog" data-izimodal-title="Add New Room Dialog">
		<div class="row">
			<div class="col-sm-12">
				<div class="">
					<div class="card-block">
						<form onsubmit="return false;">
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Room Name</label>
								<div class="col-sm-10">
									<input type="text" id="newRoomName" class="form-control form-control-normal" placeholder="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Age Range</label>
								<div class="col-sm-10">
									<select id="newAgeRanges" class="form-control form-control-bold">

									</select>
								</div>
							</div>

							<div class="form-group row">
								<button onclick="saveNewRoom()" class="col-sm-2 btn  btn-round btn-mini btn-info col-form-label" >Save</button>

							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="" id="EditRoomDialog" data-izimodal-title="Edit Room Dialog">
        <span id="selected_edit_id" style="display: none;"></span>
        <div class="row">
            <div class="col-sm-12">
                <div class="">
                    <div class="card-block">
                        <form onsubmit="return false;">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Room Name</label>
                                <div class="col-sm-10">
                                    <input type="text" id="editRoomName" class="form-control form-control-normal" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Age Range</label>
                                <div class="col-sm-10">
                                    <select id="editAgeRanges" class="form-control form-control-bold">

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <button onclick="updateNewRoom()" class="col-sm-2 btn  btn-round btn-mini btn-info col-form-label" >Update</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>