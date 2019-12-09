

function closeNewStaffDialog () {
		$("#div_card_Newstaff_details").slideUp('fast');
	$("#btnCloseDialog").hide();
	$("#btnNewDialog").show();
}

function openNewStaffDialog () {
	$("#btnNewDialog").hide();
	$("#btnCloseDialog").show();
	$("#div_card_Newstaff_details").slideDown('fast');
}

function onNextToContactDetails(){
	$("#div_card_personal_details").hide('slow',()=>{
		$("#div_card_contact_details").show('slow');
	});
	
}

function onPrevFromFiles(){
	
	$("#div_card_personal_details").slideDown('slow');
	$("#div_card_contact_details").slideUp('slow');
}


function onNextToFiles(){
	$("#div_card_contact_details").slideUp('slow');
	$("#div_card_files_details").slideDown('slow');
}


function onPrevToContact(){
	
	$("#div_card_files_details").slideUp('slow');
	$("#div_card_contact_details").slideDown('slow');
}

function onsaveNewEmployee(){
let name = $("#name").val();
let surname = $("#surname").val();
let id_num = $("#id_num").val();
let sex = $("#sex").val();
let date_of_birth = $("#date_of_birth").val();
let pics  = $("#pics").val();
let email = $("#email").val();
let address = $("#address").val();
let select_jobPosition = $("#select_jobPosition").val();
let docss = $("#docss").val();

let data_ = new FormData();
	data_.append( name , name);
	data_.append(surname , surname);
	data_.append(id_num , id_num);
	data_.append(sex ,sex );
	data_.append(date_of_birth , date_of_birth);
	data_.append( pics, pics.files[0]);
	data_.append( email, email);
	data_.append( address, address);
	data_.append( select_jobPosition,select_jobPosition );
	data_.append( docss,docss );
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