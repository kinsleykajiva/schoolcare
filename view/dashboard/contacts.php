<div class="page-header card">
	<div class="card-block">
		<button onclick="onShowAddContactDialog()" class="btn btn-mini btn-round btn-info"> <i class="fa fa-plus-square"></i> New Contact</button>

	</div>
</div>

<div class="card">
	<div class="card-header">
		<h5>General Contacts</h5>
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
					<th>Full Name</th>
					<th>Contact</th>
					<th>Email</th>
					<th>Address</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody id="tbody_contacts">
				<tr >
					<th scope="row">1</th>
					<td>Loading</td>
					<td>Loading</td>
					<td>Loading...</td>
					<td>Loading ...</td>
					<td>
						Loading ...
					</td>
				</tr>

				</tbody>
			</table>
		</div>
	</div>
</div>



<div class="" id="addContactDialog" data-izimodal-title="New Contact Dialog" >

	<div class="card-block">
		<form onsubmit="return false;" style="">
			<div class="row">
				<div class="col-lg-12">
					<div class="form-group col-sm-12 ">

						<div class="">
							<select onchange="resetSelectsOnType()" id="newSelectType" class="form-control" type="text" >
								<option value="1">Person</option>
								<option value="2">Organisation</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row" id="divPerson">
				<div class="col-lg-6">
					<div class="form-group col-sm-12 ">
						<label class="col-form-label">Name</label> <br>
						<div class="">
							<input id="newName" class="form-control" type="text" placeholder="">
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group col-sm-12 ">
						<label class="col-form-label">Surname</label> <br>
						<div class="">
							<input id="newSurname" class="form-control" type="text" placeholder="">
						</div>
					</div>
				</div>
			</div>

			<div class="row" id="divOrg" style="display: none;">
				<div class="col-lg-12">
					<div class="form-group col-sm-12 ">
						<label class="col-form-label">Organisation</label> <br>
						<div class="">
							<input id="newOrg" class="form-control" type="text" placeholder="">
						</div>
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-lg-12">
					<div class="form-group col-sm-12 ">
						<label class="col-form-label">Email</label> <br>
						<div class="">
							<input id="newEmail" class="form-control" type="text" placeholder="">
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div class="form-group col-sm-12 ">
						<label class="col-form-label">Phone</label> <br>
						<div class="">
							<input id="newPhone" class="form-control" type="text" placeholder="">
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div class="form-group col-sm-12 ">
						<label class="col-form-label">Address</label> <br>
						<div class="">
							<input id="newAddress" class="form-control" type="text" placeholder="">
						</div>
					</div>
				</div>
			</div>





			<div class="form-group row">
				<button onclick="saveNewContact()" class="col-sm-4 btn-mini btn btn-info btn-round">Save</button>
				<div class="col-sm-8">

				</div>
			</div>
		</form>
	</div>
</div>
<div class="" id="editContactDialog" data-izimodal-title="Edit Contact Dialog" >
	<span id="edit_selected" style="display: none;"></span>
	<div class="card-block">
		<form onsubmit="return false;" style="">
			<div class="row">
				<div class="col-lg-12">
					<div class="form-group col-sm-12 ">

						<div class="">
							<select onchange="editSelectsOnType()" id="editSelectType" class="form-control" type="text" >
								<option value="1">Person</option>
								<option value="2">Organisation</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row" id="editdivPerson">
				<div class="col-lg-6">
					<div class="form-group col-sm-12 ">
						<label class="col-form-label">Name</label> <br>
						<div class="">
							<input id="editName" class="form-control" type="text" placeholder="">
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group col-sm-12 ">
						<label class="col-form-label">Surname</label> <br>
						<div class="">
							<input id="editSurname" class="form-control" type="text" placeholder="">
						</div>
					</div>
				</div>
			</div>

			<div class="row" id="editdivOrg" style="display: none;">
				<div class="col-lg-12">
					<div class="form-group col-sm-12 ">
						<label class="col-form-label">Organisation</label> <br>
						<div class="">
							<input id="editOrg" class="form-control" type="text" placeholder="">
						</div>
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-lg-12">
					<div class="form-group col-sm-12 ">
						<label class="col-form-label">Email</label> <br>
						<div class="">
							<input id="editEmail" class="form-control" type="text" placeholder="">
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div class="form-group col-sm-12 ">
						<label class="col-form-label">Phone</label> <br>
						<div class="">
							<input id="editPhone" class="form-control" type="text" placeholder="">
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div class="form-group col-sm-12 ">
						<label class="col-form-label">Address</label> <br>
						<div class="">
							<input id="editAddress" class="form-control" type="text" placeholder="">
						</div>
					</div>
				</div>
			</div>





			<div class="form-group row">
				<button onclick="saveEditContact()" class="col-sm-4 btn-mini btn btn-info btn-round">Update</button>
				<div class="col-sm-8">

				</div>
			</div>
		</form>
	</div>
</div>
