

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
	let name = $("#name").val();
	let surname = $("#surname").val();
	let id_num = $("#id_num").val();
	let sex = $("#sex").val();
	let date_of_birth = $("#date_of_birth").val();
	
	if(name === ''){
		showErrorMessage('Name is Required' , 4);
		error_input_element(true , 'name');
		return;
	}
	error_input_element(false , 'name');
	
	if(surname === ''){
		showErrorMessage('Surname is Required' , 4);
		error_input_element(true , 'surname');
		return;
	}
	error_input_element(false , 'surname');
	
	if(id_num === ''){
		showErrorMessage('ID Number is Required' , 4);
		error_input_element(true , 'id_num');
		return;
	}
	error_input_element(false , 'id_num');
	
	if(sex === 'null'){
		showErrorMessage('Sex Selection is Required' , 4);
		error_input_element(true , 'sex');
		return;
	}
	error_input_element(false , 'sex');
	if(date_of_birth === 'null'){
		showErrorMessage('Date Of Birth is Required' , 4);
		error_input_element(true , 'date_of_birth');
		return;
	}
	error_input_element(false , 'date_of_birth');
	
	
	$("#div_card_personal_details").hide('slow',()=>{
		$("#div_card_contact_details").show('slow');
	});
	
}

function onPrevFromFiles(){
	
	$("#div_card_personal_details").slideDown('slow');
	$("#div_card_contact_details").slideUp('slow');
}


function onNextToFiles(){
	let phone = $("#phoneNum_1").val();
	let email = $("#email").val();
	if(email === ''){
		showErrorMessage('Email is Required' , 4);
		error_input_element(true , 'email');
		return;
	}
	error_input_element(false , 'email');
	
	if(!isEmail(email) ){
		showErrorMessage('Valid Email is Required' , 4);
		error_input_element(true , 'email');
		return;
	}
	error_input_element(false , 'email');
	if(phone === ''){
		showErrorMessage('Phone is Required' , 4);
		error_input_element(true , 'phoneNum_1');
		return;
	}
	error_input_element(false , 'phoneNum_1');
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
let pics  =  document.getElementById('pics');
let email = $("#email").val();
let address = $("#address").val();
let select_jobPosition = $("#select_jobPosition").val();
let docss = document.getElementById('docss');
let ins = docss.files.length;
let data_ = new FormData();
	data_.append( 'name' , name);
	data_.append('surname' , surname);
	data_.append('id_num' , id_num);
	data_.append('sex' ,sex );
	data_.append('date_of_birth' , date_of_birth);
	data_.append( 'pics', pics.files[0]);
	data_.append( 'email', email);
	data_.append( 'address', address);
	
	data_.append( 'select_jobPosition',select_jobPosition );
	
	for (var x = 0; x < ins; x++) {
		data_.append("docss[]", docss.files[x]);
		
	}
	let phone = $("#phoneNum_1").val();
	data_.append( phone, phone);
	/*let added_multi_phone = [] ;
	$(".added_multi_phone" ).each(()=>{
		var currentElement = $(this);
		console.log (currentElement.is(':checked'));
		console.log ($(this));
		if($(this).is(':checked')){
			
			let iid = $(this).attr('id');
			console.log (iid);
		}
	});
	return;*/
	$('body').loading({
		message: 'Saving...'
	});
	axios({url:'/backend/staff',method:'post',data:data_}).then(res=>{
		$('body').loading('stop');
		if(res.statusText === 'OK'&& res.data.status === 'ok'){
			showSuccessMessage('Saved the Details' , 4);
		}else{
			showErrorMessage('Failed to save,Try again .' ,6);
		}
	})
		.catch(err=>{
			showErrorMessage('Failed to connect Please check your connection' ,6);
			$('body').loading('stop');
		})
	
}


let phoneCounter = 1 ;
function addPhoneOption () {
	
	let html = `
	<div class="form-group row" id="phone_aaded_${phoneCounter}">
                            <label class="col-sm-2 col-form-label">Phone No.</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-normal" id="phoneNum_${phoneCounter}" placeholder="">
                            </div>

                            <div style="display: none;" class="col-sm-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input added_multi_phone" name="phoneNum" id="default_${phoneCounter}" value="1">
                                   Default
                                </label>
                            </div>
                        </div>
	
	`;
	$("#phoneNumberDiv").append(html);
	//phoneCounter++;
	
}
addPhoneOption () ;