<div class="page-content page-container" id="page-content">
	<div class="padding">
		<div class="row container d-flex justify-content-center">
			<div class="col-md-5">
				<div class="card">
					<div class="card-body text-center">
						<div> 
						<img src="" id="iconPropic" class="img-lg rounded-circle mb-4" width='180' alt="logo">
							<h4 id='companyTitle'>Company Title</h4>
							<p class="text-muted mb-0" >...</p>
						</div>
						<p class="mt-2 card-text" id='companyemail'>Phone Numbers </p>
						<p class="mt-2 card-text" id='companyPhone'> Email Addresses  </p>
						<div class="border-top pt-3">
							<div class="row">
								<div class="col-12">
									<h5>Address</h5>
									<br>
									<p id='adddress_company'> </p>

								</div>

							</div>
						</div>
						<button class="btn btn-info btn-round btn-mini btn-sm mt-3 mb-4" onclick="editCompanyDetails()" >Edit</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="" id="editCompanyDialog" data-izimodal-title="Details Dialog" >

	<div class="card-block">
		<form onsubmit="return false;" style="">



			<div class="row" id="" >
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
				<div class="col-lg-6">
					<div class="form-group col-sm-12 ">
						<label class="col-form-label">Email</label> <br>
						<div class="">
							<input id="newEmail" class="form-control" type="text" placeholder="">
						</div>
					</div>
				</div>
				<div class="col-lg-6">
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
						<label class="col-form-label">Address <small>(Comma Separate)</small> </label> <br>
						<div class="">
							<input id="newAddress" class="form-control" type="text" placeholder="">
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div class="form-group col-sm-12 ">
						<label class="col-form-label">Logo Image</label> <br>
						<div class="">
							<input id="newLogo" accept="image/png" class="form-control" type="file" placeholder="">
						</div>
					</div>
				</div>
			</div>



			<div class="form-group row" style="padding-left: 20px;">
				<button onclick="saveDetailsContact()" class="col-sm-2 btn-mini btn btn-info btn-round">Save</button>
				<div class="col-sm-10">

				</div>
			</div>
		</form>
	</div>
</div>