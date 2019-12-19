
<div class="card" style="display: none;" id="divCreateLesson">
	<div class="card-header">
		<h5>Create New Lesson</h5>

	</div>
	<div class="card-block">
		<form onsubmit="return false;">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Title</label>
				<div class="col-sm-10">
					<input type="text" maxlength="60" id="newLesson_title" class="form-control form-control-normal" placeholder="">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Category</label>
				<div class="col-sm-10">
					<select id="newLesson_categoy" class="form-control form-control-normal selectpicker" >
						<option data-icon="fa fa-plus">Ketchup</option>
					</select>
					<div style="visibility: hidden;" id="newLesson_categoy_error" class="col-form-label text-danger">
						Category Required !
					</div>
				</div>

			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Description</label>
				<div class="col-sm-10">
					<input id="newLesson_description" type="text" maxlength="300" class="form-control form-control-normal" placeholder="">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Ages</label>
				<div class="col-sm-10">
					<select multiple id="newLesson_ages"  class="form-control form-control-normal selectpicker" >

					</select>
					<!--<div style="visibility: hidden;" id="newLesson_ages_error" class="col-form-label text-danger">
						Age Required !
					</div>-->
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Mile Stones</label>
				<div class="col-sm-10">
					<select  multiple id="newLesson_milestones" class="form-control form-control-normal selectpicker" >


					</select>

				</div>
			</div>


			<div class="form-group row">
				<label class="col-sm-2 col-form-label">
					<button onclick="onSaveNewLesson();" class="btn btn-info  btn-round">Save</button>
				</label>
				<div class="col-sm-10">

				</div>
			</div>

		</form>
	</div>
</div>

