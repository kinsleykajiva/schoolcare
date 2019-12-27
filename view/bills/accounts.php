<div class="page-header card">
	<div class="card-block">

		<ul class="nav nav-tabs md-tabs" role="tablist">
			<li class="nav-item">
				<a class="nav-link " data-toggle="tab" href="#home31" role="tab">Children</a>
				<div class="slide"></div>
			</li>
			<li class="nav-item">
				<a class="nav-link " data-toggle="tab" href="#profile33" role="tab">Fees</a>
				<div class="slide"></div>
			</li>
			<li class="nav-item" style="">
				<a class="nav-link active" data-toggle="tab" href="#invoicesTab" role="tab">Invoices</a>
				<div class="slide"></div>
			</li>
			<!--<li class="nav-item" style="display: none;">
				<a class="nav-link" data-toggle="tab" href="#settings3" role="tab">Settings</a>
				<div class="slide"></div>
			</li>-->
		</ul>

	</div>
</div>

<div class="card">
	<div class="tab-content card-block">
		<div class="tab-pane  " id="home31" role="tabpanel">
<?php include 'children/children.php';?>
</div>
		<div class="tab-pane " id="profile33" role="tabpanel">
			<p class="m-0">
<?php include 'fees/fees.php';?>
</p>
		</div>
		<div class="tab-pane active" id="invoicesTab" role="tabpanel">
<?php include 'invoice/invoice.php';?>
		</div>
		<!--<div class="tab-pane" id="settings3" role="tabpanel">
			<p class="m-0">4.Cras elis amet.</p>
		</div>-->
	</div>
</div>