<div class="page-header card">
    <div class="card-block">
        <!--<h5 class="m-b-10"></h5>-->
        <button id="btnNewDialog" onclick="openNewStaffDialog()" class="btn btn-round btn-mini btn-primary btn-sm"><i class="icofont icofont-user-alt-3"></i>New Staff</button>
        <button id="btnCloseDialog" style="display: none;" onclick="closeNewStaffDialog()" class="btn btn-round btn-mini btn-warning btn-sm"><i class="icofont icofont-close-alt-3"></i>Cancel</button>
    </div>
</div>


<?php include 'view-staff.php';?>

<div class="page-body" id="div_card_Newstaff_details" style="display: none;">
    <span id="id_selected_record" style="display: none;"></span>
    <div class="row">
        <div class="col-sm-12">
            <!-- Basic Form Inputs card start -->
            <div class="card" id="div_card_personal_details" >
                <div class="card-header">
                    <h5>Personal Details</h5>

                    <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>

                    <div class="card-header-right">
                        <i class="icofont icofont-spinner-alt-5"></i>
                    </div>

                </div>
                <div class="card-block">

                    <form onsubmit="return false;">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" id="name"  class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Surname</label>
                            <div class="col-sm-10">
                                <input type="text" id="surname" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">ID Num.</label>
                            <div class="col-sm-10">
                                <input type="text" id="id_num"  class="form-control" placeholder="">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Sex</label>
                            <div class="col-sm-10">
                                <select type="text" id="sex" class="form-control" >
                                    <option value="null">Select</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Date Of Birth</label>
                            <div class="col-sm-10">
                                <input type="text" id="date_of_birth"  class="form-control" value="">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Upload Picture</label>
                            <div class="col-sm-10">
                                <input type="file" id="pics" accept="image/png"  class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">

                            <button onclick="onNextToContactDetails()" class="col-sm-2 btn btn-mini btn-round btn-info">Next </button>
                            <div class="col-sm-10" style="display: none">

                            </div>
                        </div>

                    </form>


                </div>
            </div>
            <!-- Basic Form Inputs card end -->

            <!-- Input Alignment card start -->
            <div class="card" id="div_card_contact_details" style="display: none;">
                <div class="card-header">
                    <h5>Contact Details</h5>

                    <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
                </div>
                <div class="card-block">
                    <form onsubmit="return false;">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email Address</label>
                            <div class="col-sm-8">
                                <input type="email" id="email" class="form-control form-control-lowercase" placeholder="">
                            </div>

                        </div>
                        <div id="phoneNumberDiv"></div>

                        <div class="form-group row" style="display: none;">
                            <button onclick="addPhoneOption ();" class="col-sm-2 btn btn-mini btn-round btn-success">Add Number</button>
                            <div class="col-sm-10" style="display: none">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Address  </label>
                            <div class="col-sm-8">
                                <input type="text" id="address" class="form-control form-control-capitalize" placeholder="(comma separate)">
                            </div>

                        </div>

                        <div class="form-group row" style="margin-top: 20px;">
                            <button onclick="onPrevFromFiles()" class="col-sm-2 btn btn-mini btn-round btn-default">Prev </button>
                            <button style="visibility: hidden;" class="col-sm-2 btn btn-mini btn-round btn-info">. </button>
                            <button onclick="onNextToFiles()" class="col-sm-2 btn btn-mini btn-round btn-info">Next </button>
                            <div class="col-sm-10" style="display: none">

                            </div>
                        </div>


                    </form>
                </div>
            </div>
            <!-- Input Alignment card end -->

            <!-- Input Alignment card start -->
            <div class="card" id="div_card_files_details" style="display: none;">
                <div class="card-header">
                    <h5>Files Details</h5>

                    <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
                </div>
                <div class="card-block">
                    <form onsubmit="return false;">

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Position</label>
                            <div class="col-sm-8">
                                <select type="text" id="select_jobPosition" class="form-control ">
                                    <option value="null">Select Position</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Documents</label>
                            <div class="col-sm-8">
                                <input type="file" multiple id="docss" accept="text/plain,application/pdf,image/png," class="form-control form-control-uppercase" placeholder="">
                            </div>

                        </div>

                        <div class="form-group row" style="margin-top: 20px;">
                            <button onclick="onPrevToContact()" class="col-sm-2 btn btn-mini btn-round btn-default">Prev </button>
                            <button style="visibility: hidden;" class="col-sm-2 btn btn-mini btn-round btn-info">. </button>
                            <button onclick="onsaveNewEmployee()" id="btnSaveEmp" class="col-sm-2 btn btn-mini btn-round btn-info">Save </button>
                            <button onclick="onsaveUpdateEmployee()" id="btnUpdate" style="display: none;" class="col-sm-2 btn btn-mini btn-round btn-info">Update </button>
                            <div class="col-sm-10" style="display: none">

                            </div>
                        </div>


                    </form>
                </div>
            </div>
            <!-- Input Alignment card end -->
        </div>
    </div>
</div>