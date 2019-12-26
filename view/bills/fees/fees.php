<div class="row">
	<div class="col-lg-12 col-xl-12">

		<!-- Nav tabs -->
        <ul class="nav nav-tabs  tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#feesPackageTab" role="tab" aria-expanded="false">Make Fees Packages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#feesTab" role="tab" aria-expanded="true">Fees </a>
            </li>

        </ul>
		<!-- Tab panes -->
        <div class="tab-content tabs card-block">
            <div class="tab-pane active" id="feesPackageTab" role="tabpanel" aria-expanded="false">
                <?php include 'feesPackages.php';?>
            </div>
            <div class="tab-pane " id="feesTab" role="tabpanel" aria-expanded="true">
	            <?php include 'feesItems.php';?>
            </div>

        </div>
	</div>

</div>