<div class="card-block">
    <span id="sleectedit_id" style="display: none;"></span>
    <form onsubmit="return false;">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" id="childName" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Surname</label>
            <div class="col-sm-10">
                <input type="text" id="childSurname" class="form-control">
            </div>
        </div>


        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Gender</label>
            <div class="col-sm-10">
                <select name="select" id="childSex" class="form-control">
                    <option value="null" selected="selected">Select</option>
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Date Of Birth</label>
            <div class="col-sm-10">
                <input type="text" id="childDOB" class="form-control" data-inputmask-alias="yyyy-mm-dd"
                       data-inputmask="'yearrange': { 'minyear': '2010', 'maxyear': '2019' }" data-val="true"
                       data-val-required="Required">
            </div>
        </div>


        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Notes</label>
            <div class="col-sm-10">
                <textarea rows="5" cols="5" id="childNotes" class="form-control"
                          placeholder="any notes on the child"></textarea>
            </div>
        </div>
        <hr>

        <div class="form-group row">
            <div class="col-sm-2 ">
                <button onclick="onSaveChildEditDetails()" class="btn btn-info btn-round btn-sm ">Save <i
                        class="fa fa-arrow-save"></i></button>
            </div>
            <div class="col-sm-8">
                <div class="form-control-static">
                    .
                </div>
            </div>
            <div class="col-sm-2 ">
                .
            </div>
        </div>

    </form>


</div>
