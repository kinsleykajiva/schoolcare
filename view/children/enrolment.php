<div class="page-header card" >
	<div class="card-block">
		<h5 style="display: none;" class="m-b-10">Basic Form Inputs</h5>

		<button id="btnaddAnotherParent" onclick="addAnotherParent()" class="btn btn-mini btn-round btn-info"><i class="fa fa-plus-circle"></i> Add Another Parent</button>
		<button id="btnaddAnotherChild" style="display: none;" onclick="addAnotherChild()" class="btn btn-mini btn-round btn-info"><i class="fa fa-plus-circle"></i> Add Another Child</button>
	</div>
</div>

<div class="page-body">
	<?php
		include 'enrolment/parent-details.php';
		include 'enrolment/child-details.php';
	?>
</div>
