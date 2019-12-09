

function openNewStaffDialog () {

}
let phoneCounter = 1 ;
function addPhoneOption () {
	
	let html = `
	<div class="form-group row">
                            <label class="col-sm-2 col-form-label">Phone No.</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-normal" placeholder="">
                            </div>

                            <div class="col-sm-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="phoneNum" id="default_${phoneCounter}" value="1">
                                   Default
                                </label>
                            </div>
                        </div>
	
	`;
	$("#phoneNumberDiv").append(html);
	phoneCounter++;
	
}
addPhoneOption () ;