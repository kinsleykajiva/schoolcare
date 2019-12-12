let parentsArr = [] ;let childrenArr = [];
let parentCounter = childCounter = 1;
const parentCount = $("#parentCount");
const childCount = $("#childCount");
function onPrevToParent () {
	$("#divRow_ChildDetails").slideUp('slow');
	$("#divRow_ParentDetails").slideDown('slow');
	$("#btnaddAnotherParent").show();
	$("#btnaddAnotherChild").hide();
}

function onSaveForm () {
	if(parentsArr.length === 0){
		getParentDetails();
	}
	if(childrenArr.length === 0){
		getChildrenDetails();
	}
	//console.log (parentsArr);
//	console.log (childrenArr);
	let parentJson = JSON.stringify(parentsArr);
	let childrenJson = JSON.stringify(childrenArr);
	
	let data_ = new FormData();
	data_.append('parentJson',parentJson);
	data_.append('childrenJson',childrenJson);
	$('body').loading({
		message: 'Saving...'
	});
	axios({url:'/backend/enrolement',method:'post',data:data_}).then(res=>{
		$('body').loading('stop');
		if(res.statusText==='OK' && res.data.status === 'ok'){
			showSuccessMessage('Saved' , 4);
			emptyInputs(['parentHomeAddress','parentEmail','parentName','parentSurname','parentIDNumber','parentOccupation','parentPhone'],['parentSex']);
			emptyInputs(['childName','childSurname','childDOB','childNotes'],['childSex']);
			parentsArr = [];childrenArr =[];
			parentCounter = 1;childCounter = 1;
			childCount.text(1);
			parentCount.text(1);
			onPrevToParent ();
		}else{
			showErrorMessage('Failed to save',4);
		}
	}).catch(error=>{
		$('body').loading('stop');
		showErrorMessage('Failed to connect' , 4);
	})
}

function onNextToChildDetails () {
	let parentName = $("#parentName").val();
	if(parentName === ''){
		showErrorMessage('Name is Required');
		error_input_element(true , 'parentName');
		return;
	}
	error_input_element(false , 'parentName');
	let parentSurname = $("#parentSurname").val();
	if(parentSurname === ''){
		showErrorMessage('Surname is Required');
		error_input_element(true , 'parentSurname');
		return;
	}
	error_input_element(false , 'parentSurname');
	
	let parentIDNumber = $("#parentIDNumber").val();
	if(parentIDNumber === ''){
		showErrorMessage('ID is Required');
		error_input_element(true , 'parentIDNumber');
		return;
	}
	error_input_element(false , 'parentIDNumber');
	
	let parentSex = $("#parentSex").val();
	if(parentSex === 'null'){
		showErrorMessage('Gender is Required');
		error_input_element(true , 'parentSex');
		return;
	}
	error_input_element(false , 'parentSex');
	let  parentOccupation = $("#parentOccupation").val();
	let parentPhone = $("#parentPhone").val();
	if(parentPhone === ''){
		showErrorMessage('Contact is Required');
		error_input_element(true , 'parentPhone');
		return;
	}
	error_input_element(false , 'parentPhone');
	let parentEmail = $("#parentEmail").val();
	if(parentEmail === ''){
		showErrorMessage('Contact is Required');
		error_input_element(true , 'parentEmail');
		return;
	}
	error_input_element(false , 'parentEmail');
	let parentHomeAddress = $("#parentHomeAddress").val();
	if(parentHomeAddress === ''){
		showErrorMessage('Contact is Required');
		error_input_element(true , 'parentHomeAddress');
		return;
	}
	error_input_element(false , 'parentHomeAddress');
$("#divRow_ParentDetails").slideUp('slow');
$("#divRow_ChildDetails").slideDown('slow');
$("#btnaddAnotherChild").show();
$("#btnaddAnotherParent").hide();
}
function getParentDetails () {
	let parentName = $("#parentName").val();
	if(parentName === ''){
		showErrorMessage('Name is Required');
		error_input_element(true , 'parentName');
		return;
	}
	error_input_element(false , 'parentName');
	let parentSurname = $("#parentSurname").val();
	if(parentSurname === ''){
		showErrorMessage('Surname is Required');
		error_input_element(true , 'parentSurname');
		return;
	}
	error_input_element(false , 'parentSurname');
	
	let parentIDNumber = $("#parentIDNumber").val();
	if(parentIDNumber === ''){
		showErrorMessage('ID is Required');
		error_input_element(true , 'parentIDNumber');
		return;
	}
	error_input_element(false , 'parentIDNumber');
	
	let parentSex = $("#parentSex").val();
	if(parentSex === 'null'){
		showErrorMessage('Gender is Required');
		error_input_element(true , 'parentSex');
		return;
	}
	error_input_element(false , 'parentSex');
	let  parentOccupation = $("#parentOccupation").val();
	let parentPhone = $("#parentPhone").val();
	if(parentPhone === ''){
		showErrorMessage('Contact is Required');
		error_input_element(true , 'parentPhone');
		return;
	}
	error_input_element(false , 'parentPhone');
	let parentEmail = $("#parentEmail").val();
	if(parentEmail === ''){
		showErrorMessage('Contact is Required');
		error_input_element(true , 'parentEmail');
		return;
	}
	error_input_element(false , 'parentEmail');
	if(!isEmail(parentEmail) ){
		showErrorMessage('Valid Email is Required');
		error_input_element(true , 'parentEmail');
		return;
	}
	error_input_element(false , 'parentEmail');
	let parentHomeAddress = $("#parentHomeAddress").val();
	if(parentHomeAddress === ''){
		showErrorMessage('Contact is Required');
		error_input_element(true , 'parentHomeAddress');
		return;
	}
	error_input_element(false , 'parentHomeAddress');
	emptyInputs(['parentHomeAddress','parentEmail','parentName','parentSurname','parentIDNumber','parentOccupation','parentPhone'],['parentSex']);
	parentsArr.push({
		'pos':parentCounter ,
		'data':{
			parentName:parentName ,
			parentSurname:parentSurname,
			parentIDNumber:parentIDNumber,
			parentSex:parentSex,
			parentOccupation:parentOccupation,
			parentPhone:parentPhone,
			parentEmail:parentEmail,
			parentHomeAddress:parentHomeAddress
		}
	});
}
function addAnotherParent () {
	let parentName = $("#parentName").val();
	if(parentName === ''){
		showErrorMessage('Name is Required');
		error_input_element(true , 'parentName');
		return;
	}
	error_input_element(false , 'parentName');
	let parentSurname = $("#parentSurname").val();
	if(parentSurname === ''){
		showErrorMessage('Surname is Required');
		error_input_element(true , 'parentSurname');
		return;
	}
	error_input_element(false , 'parentSurname');
	
	let parentIDNumber = $("#parentIDNumber").val();
	if(parentIDNumber === ''){
		showErrorMessage('ID is Required');
		error_input_element(true , 'parentIDNumber');
		return;
	}
	error_input_element(false , 'parentIDNumber');
	
	let parentSex = $("#parentSex").val();
	if(parentSex === 'null'){
		showErrorMessage('Gender is Required');
		error_input_element(true , 'parentSex');
		return;
	}
	error_input_element(false , 'parentSex');
	let  parentOccupation = $("#parentOccupation").val();
	let parentPhone = $("#parentPhone").val();
	if(parentPhone === ''){
		showErrorMessage('Contact is Required');
		error_input_element(true , 'parentPhone');
		return;
	}
	error_input_element(false , 'parentPhone');
	let parentEmail = $("#parentEmail").val();
	if(parentEmail === ''){
		showErrorMessage('Contact is Required');
		error_input_element(true , 'parentEmail');
		return;
	}
	error_input_element(false , 'parentEmail');
	if(!isEmail(parentEmail) ){
		showErrorMessage('Valid Email is Required');
		error_input_element(true , 'parentEmail');
		return;
	}
	error_input_element(false , 'parentEmail');
	let parentHomeAddress = $("#parentHomeAddress").val();
	if(parentHomeAddress === ''){
		showErrorMessage('Contact is Required');
		error_input_element(true , 'parentHomeAddress');
		return;
	}
	error_input_element(false , 'parentHomeAddress');
	$("#divRow_ParentDetails" ).hide("slide", { direction: "right" }, 1200,()=>{
		getParentDetails();
		parentCounter++;
		parentCount.text(parentCounter);
		$("#divRow_ParentDetails" ).delay(400).show("slide", { direction: "left" }, 1200);
	});
}
function getChildrenDetails () {
	let childName = $("#childName").val();
	if(childName === ''){
		showErrorMessage('Name is Required');
		error_input_element(true , 'childName');
		return;
	}
	error_input_element(false , 'childName');
	let childSurname = $("#childSurname").val();
	if(childSurname === ''){
		showErrorMessage('Surname is Required');
		error_input_element(true , 'childSurname');
		return;
	}
	error_input_element(false , 'childSurname');
	let childSex = $("#childSex").val();
	if(childSex === 'null'){
		showErrorMessage('Gender is Required');
		error_input_element(true , 'childSex');
		return;
	}
	error_input_element(false , 'childSex');
	let childDOB = $("#childDOB").val();
	if(childSex === 'null'){
		showErrorMessage('Gender is Required');
		error_input_element(true , 'childSex');
		return;
	}
	error_input_element(false , 'childSex');
	let childNotes = $("#childNotes").val();
	emptyInputs(['childName','childSurname','childDOB','childNotes'],['childSex']);
	childrenArr.push({
		'pos':childCounter ,
		'data':{
			childName:childName,
			childSurname:childSurname,
			childSex:childSex,
			childDOB:childDOB,
			childNotes:childNotes
		}
	});
}
function addAnotherChild () {
	/*the code below is a duplication but i had to do it for the sake of validation*/
	let childName = $("#childName").val();
	if(childName === ''){
		showErrorMessage('Name is Required');
		error_input_element(true , 'childName');
		return;
	}
	error_input_element(false , 'childName');
	let childSurname = $("#childSurname").val();
	if(childSurname === ''){
		showErrorMessage('Surname is Required');
		error_input_element(true , 'childSurname');
		return;
	}
	error_input_element(false , 'childSurname');
	let childSex = $("#childSex").val();
	if(childSex === 'null'){
		showErrorMessage('Gender is Required');
		error_input_element(true , 'childSex');
		return;
	}
	error_input_element(false , 'childSex');
	let childDOB = $("#childDOB").val();
	if(childSex === 'null'){
		showErrorMessage('Gender is Required');
		error_input_element(true , 'childSex');
		return;
	}
	error_input_element(false , 'childSex');
	
	$("#divRow_ChildDetails" ).hide("slide", { direction: "right" }, 1200,()=>{
		getChildrenDetails ();
	childCounter++;
	childCount.text(childCounter);
		$("#divRow_ChildDetails" ).delay(400).show("slide", { direction: "left" }, 1200);
	});
	// console.log (childrenArr)
}