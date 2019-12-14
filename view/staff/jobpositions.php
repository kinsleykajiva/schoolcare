<div class="page-header card">
    <div class="card-block">
        <!--<h5 class="m-b-10"></h5>-->
        <button onclick="openDialog()" class="btn btn-round btn-mini btn-primary btn-sm"><i class="icofont icofont-user-alt-3"></i>New Position</button>
    </div>
</div>

<div class="card" id="div_content">
    <div class="card-header">
        <h5>Job Positions</h5>

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
        <div class="table-responsive" style="min-height: 300px;">
            <table class="table">
                <thead>
                <tr  class="d-flex">
                    <th class="col-1"></th>
                    <th class="col-9">Title</th>

                    <th class="col-2">Options</th>
                </tr>
                </thead>
                <tbody id="job_pos_tbody">
                <tr  class="d-flex" style="display: none;">
                    <th class="col-1" scope="row">.</th>
                    <td class="col-9">Mark</td>

                    <td  class="col-2">
                        <div class="dropdown-inverse dropdown open">
                            <button class="btn btn-mini btn-default dropdown-toggle waves-effect waves-light " type="button" id="dropdown-7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action</button>
                            <div class="dropdown-menu" aria-labelledby="dropdown-7" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
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

<div id="modal-oneEdit" class="iziModalEdit" data-izimodal-title="Edit Position Dialog" >
    <form onsubmit="return false;">
    <span id="updateJobID" style="display: none;"></span>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" id="updateJobTitle" class="form-control" placeholder="Title of the job...">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <textarea rows="5" cols="5" id="updateJobDescription" class="form-control" placeholder="Job Description"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <button style="margin-left: 20px;" onclick="saveUpdateJobPosition()"  class="btn btn-round btn-mini btn-primary">Update Position</button>

        </div>
    </form>
</div>

<div id="modal-one" class="iziModal" data-izimodal-title="New Position Dialog" >
    <form onsubmit="return false;">

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" id="newJobTitle" class="form-control" placeholder="Title of the job...">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <textarea rows="5" cols="5" id="newJobDescription" class="form-control" placeholder="Job Description"></textarea>
            </div>
        </div>
        <div class="form-group row">


            <button style="margin-left: 20px;" onclick="saveNewJobPosition()"  class="btn btn-round btn-mini btn-primary">Save Position</button>


        </div>
    </form>
</div>