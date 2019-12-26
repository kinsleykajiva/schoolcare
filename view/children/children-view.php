<div class="page-body">
	<div class="card">
		<div class="card-header">
			<h5>All Children</h5>

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
						<th>Full Name</th>
						<th>Sex</th>
						<th>Date Of Birth</th>
						<th> . </th>
					</tr>
					</thead>
					<tbody id="tbody_childrenview">
					<tr style="display: none;">
						<th scope="row">1</th>
						<td>Mark</td>
						<td>Otto</td>
						<td>@mdo</td>
						<td>
							<div class="dropdown-default dropdown open">
								<button class="btn btn-default btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Info</button>
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
</div>

<div class="" id="editChildDialog" data-izimodal-title="Child Edit Dialog">
	<?php include 'edit/child-edit.php'; ?>
</div>

<div class="" id="editParentDialog" data-izimodal-title="Parent Edit Dialog">
	<?php include 'edit/parent-edit.php'; ?>
</div>

<div class="" id="informationDialog" data-izimodal-title="Child Info Dialog">
	<div class="row">
		<div class="col-sm-12">
			<div class="">
				<div class="card-block">
					<div class="row">

						<div class="col-sm-12 col-xl-12" id="div_details_info_dialog">

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>