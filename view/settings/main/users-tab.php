<div class="card">
	<div class="card-header">

		<button onclick="openNewUserDialog()" class="btn btn-round btn-info btn-mini"><i class="fa fa-plus-circle"></i> New User</button>
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
				<tr >
					<th></th>
					<th>User Name</th>
					<th>Full Name</th>
					<th>Role</th>
					<th></th>
				</tr>
				</thead>
				<tbody id="tbodyUsers">
				<tr style="visibility: hidden;">
					<th scope="row">1</th>
					<td>Mark</td>
					<td>Otto</td>
					<td>-</td>
					<td>
						<div class="dropdown-default dropdown open">
							<button class="btn btn-default btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Info</button>
							<div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
								<a class="dropdown-item waves-light waves-effect" href="#">Edit</a>
								<a class="dropdown-item waves-light waves-effect" href="#">Delete</a>
							</div>
						</div>
					</td>
				</tr>

				</tbody>
			</table>
		</div>
	</div>
</div>

<div id="addNewUserModal" class="iziModal" data-izimodal-title="Create New User Dialog" >
	<form onsubmit="return false;">
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Employees</label>
			<div class="col-sm-10">
				<select id="selectEmployees" class="form-control" ></select>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Username</label>
			<div class="col-sm-10">
				<input type="text" id="newUsername" class="form-control" placeholder="...">
			</div>
		</div>


		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Password</label>
			<div class="col-sm-10">
				<input type="password" id="newPassword" class="form-control" placeholder="">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Role</label>
			<div class="col-sm-10">
				<select id="selectRole" class="form-control" ></select>
			</div>
		</div>


		<div class="form-group row">


			<button style="margin-left: 20px;" onclick="saveNewJobUser()"  class="btn btn-round btn-mini btn-primary">Save User</button>


		</div>
	</form>
</div>
<div id="editUserModal" class="iziModal" data-izimodal-title="Edit User Dialog" >
	<form onsubmit="return false;">

<span style="display: none;" id="selectUSerEdit"></span>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Username</label>
			<div class="col-sm-10">
				<input type="text" id="edit_newUsername" class="form-control" placeholder="...">
			</div>
		</div>


		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Password</label>
			<div class="col-sm-10">
				<input type="password" id="edit_newPassword" class="form-control" placeholder="Leave empty if no change is required!">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Role</label>
			<div class="col-sm-10">
				<select id="edit_selectRole" class="form-control" ></select>
			</div>
		</div>


		<div class="form-group row">


			<button style="margin-left: 20px;" onclick="saveUpdateUser()"  class="btn btn-round btn-mini btn-primary">Save User</button>


		</div>
	</form>
</div>