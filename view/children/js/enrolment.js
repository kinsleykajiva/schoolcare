let parentsArr = [] ;let childrenArr = [];
let parentCounter = childCounter = 1;
let isFormSubmittable = true ;
const MAX_PARENTS = 2;
const parentCount = $("#parentCount");
const childCount = $("#childCount");
$(":input[data-inputmask-mask]").inputmask();
$(":input[data-inputmask-alias]").inputmask();
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
	if(parentCounter > 1){
		// this we have pressed add parent button so we have to get the new values
		getParentDetails();
	}
	if(childCounter > 1){
		// this we have pressed add parent button so we have to get the new values
		getChildrenDetails();
	}
	//console.log (parentsArr);
	//console.log (childrenArr);
	//console.log (parentCounter);
	if(!isFormSubmittable){
		showErrorMessage('Please check if all fields are filled correctly !' ,4);
		return;
	}
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
			showSuccessMessage('Child Enrolled' , 4);
			
		}else{
			showErrorMessage('Failed to Enrol',4);
		}
		addCancelProcess ();
	}).catch(error=>{
		$('body').loading('stop');
		showErrorMessage('Failed to connect' , 4);
	})
}

function onParentNext () {
	$ ('#btnParentNext').hide ();
	$ ('#btnParentPrev').show ();
	$("#divRow_ParentDetails" ).hide("slide", { direction: "right" }, 1200,()=>{
		$("#divRow_ParentDetails" ).delay(400).show("slide", { direction: "left" }, 1200);
		
	});
}
function onChildNext () {
	$("#divRow_ChildDetails" ).hide("slide", { direction: "right" }, 1200,()=>{
		$("#divRow_ChildDetails" ).delay(400).show("slide", { direction: "left" }, 1200);
		
	});
	
}

function onChildPrev () {
	$ ("#divRow_ChildDetails").hide ("slide", {direction: "left"}, 1200, () => {
		$ ("#divRow_ChildDetails").delay (400).show ("slide", {direction: "right"}, 1200);
		childCount.text ((childCounter - 1));
		let index = childCounter - 2;
		let obj = childrenArr[index].data;
		$("#childName").val(obj.childName);
		$("#childSurname").val(obj.childSurname);
		$("#childSex").val(obj.childSex);
		$("#childDOB").val(obj.childDOB);
		$("#childNotes").val(obj.childNotes);
		
		console.log (obj);
		if(childrenArr.length === 1){
			$("#btnChildPrev").hide();
		}
		if(childrenArr.length > 1){
			
			$("#btnChildNext").show();
		}
		console.log (childCounter);
		if((childCounter-2) === childrenArr.length){
			childCounter--;
		}
		console.log (childCounter);
		
	});
}

function onParentPrev () {
	$ ("#divRow_ParentDetails").hide ("slide", {direction: "left"}, 1200, () => {
		$ ("#divRow_ParentDetails").delay (400).show ("slide", {direction: "right"}, 1200);
		
		
		parentCount.text ((parentCounter - 1));
		let index = parentCounter - 2;
		let obj = parentsArr[index].data;
		//console.log (obj);
		$ ('#btnParentPrev').hide ();
		
		$ ("#parentName").val (obj.parentName);
		$ ("#parentSurname").val (obj.parentSurname);
		$ ("#parentIDNumber").val (obj.parentIDNumber);
		$ ("#parentSex").val (obj.parentSex);
		$ ("#parentOccupation").val (obj.parentOccupation);
		$ ("#parentPhone").val (obj.parentPhone);
		$ ("#parentEmail").val (obj.parentEmail);
		$ ("#parentHomeAddress").val (obj.parentHomeAddress);
		parentCounter--;
		parentsArr=[];
	});
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
function addCancelProcess () {
	emptyInputs(['parentHomeAddress','parentEmail','parentName','parentSurname','parentIDNumber','parentOccupation','parentPhone'],['parentSex']);
	emptyInputs(['childName','childSurname','childDOB','childNotes'],['childSex']);
	parentsArr = [];childrenArr =[];
	parentCounter = 1;childCounter = 1;
	childCount.text(1);
	parentCount.text(1);
	onPrevToParent ();
	$("#btnParentPrev").hide();
}
function getParentDetails () {
	let parentName = $("#parentName").val();
	if(parentName === ''){
		isFormSubmittable = false;
		showErrorMessage('Name is Required');
		error_input_element(true , 'parentName');
		return;
	}
	isFormSubmittable = true;
	error_input_element(false , 'parentName');
	let parentSurname = $("#parentSurname").val();
	if(parentSurname === ''){
		isFormSubmittable = false;
		showErrorMessage('Surname is Required');
		error_input_element(true , 'parentSurname');
		return;
	}
	isFormSubmittable = true;
	error_input_element(false , 'parentSurname');
	
	let parentIDNumber = $("#parentIDNumber").val();
	if(parentIDNumber === ''){
		isFormSubmittable = false;
		showErrorMessage('ID is Required');
		error_input_element(true , 'parentIDNumber');
		return;
	}
	isFormSubmittable = true;
	error_input_element(false , 'parentIDNumber');
	
	let parentSex = $("#parentSex").val();
	if(parentSex === 'null'){
		isFormSubmittable = false;
		showErrorMessage('Gender is Required');
		error_input_element(true , 'parentSex');
		return;
	}
	isFormSubmittable = true;
	error_input_element(false , 'parentSex');
	let  parentOccupation = $("#parentOccupation").val();
	let parentPhone = $("#parentPhone").val();
	if(parentPhone === ''){
		isFormSubmittable = false;
		showErrorMessage('Contact is Required');
		error_input_element(true , 'parentPhone');
		return;
	}
	isFormSubmittable = true;
	error_input_element(false , 'parentPhone');
	let parentEmail = $("#parentEmail").val();
	if(parentEmail === ''){
		isFormSubmittable = false;
		showErrorMessage('Contact is Required');
		error_input_element(true , 'parentEmail');
		return;
	}
	isFormSubmittable = true;
	error_input_element(false , 'parentEmail');
	if(!isEmail(parentEmail) ){
		isFormSubmittable = false;
		showErrorMessage('Valid Email is Required');
		error_input_element(true , 'parentEmail');
		return;
	}
	isFormSubmittable = true;
	error_input_element(false , 'parentEmail');
	let parentHomeAddress = $("#parentHomeAddress").val();
	if(parentHomeAddress === ''){
		isFormSubmittable = false;
		showErrorMessage('Contact is Required');
		error_input_element(true , 'parentHomeAddress');
		return;
	}
	isFormSubmittable = true;
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
		isFormSubmittable = false;
		showErrorMessage('Name is Required');
		error_input_element(true , 'parentName');
		return;
	}
	error_input_element(false , 'parentName');
	let parentSurname = $("#parentSurname").val();
	if(parentSurname === ''){
		isFormSubmittable = false;
		showErrorMessage('Surname is Required');
		error_input_element(true , 'parentSurname');
		return;
	}
	error_input_element(false , 'parentSurname');
	
	let parentIDNumber = $("#parentIDNumber").val();
	if(parentIDNumber === ''){
		isFormSubmittable = false;
		showErrorMessage('ID is Required');
		error_input_element(true , 'parentIDNumber');
		return;
	}
	error_input_element(false , 'parentIDNumber');
	
	let parentSex = $("#parentSex").val();
	if(parentSex === 'null'){
		isFormSubmittable = false;
		showErrorMessage('Gender is Required');
		error_input_element(true , 'parentSex');
		return;
	}
	error_input_element(false , 'parentSex');
	let  parentOccupation = $("#parentOccupation").val();
	let parentPhone = $("#parentPhone").val();
	if(parentPhone === ''){
		isFormSubmittable = false;
		showErrorMessage('Contact is Required');
		error_input_element(true , 'parentPhone');
		return;
	}
	error_input_element(false , 'parentPhone');
	isFormSubmittable = true;
	let parentEmail = $("#parentEmail").val();
	if(parentEmail === ''){
		isFormSubmittable = false;
		showErrorMessage('Contact is Required');
		error_input_element(true , 'parentEmail');
		return;
	}
	error_input_element(false , 'parentEmail');
	isFormSubmittable = true;
	if(!isEmail(parentEmail) ){
		isFormSubmittable = false;
		showErrorMessage('Valid Email is Required');
		error_input_element(true , 'parentEmail');
		return;
	}
	error_input_element(false , 'parentEmail');
	isFormSubmittable = true;
	let parentHomeAddress = $("#parentHomeAddress").val();
	if(parentHomeAddress === ''){
		isFormSubmittable = false;
		showErrorMessage('Address is Required');
		error_input_element(true , 'parentHomeAddress');
		return;
	}
	error_input_element(false , 'parentHomeAddress');
	isFormSubmittable = true;
	$("#divRow_ParentDetails" ).hide("slide", { direction: "right" }, 1200,()=>{
		getParentDetails();
		parentCounter++;
		parentCount.text((parentCounter));
		$("#divRow_ParentDetails" ).delay(400).show("slide", { direction: "left" }, 1200);
		$("#btnParentPrev").show();
		if(parentCounter === MAX_PARENTS-1){
			$("#btnaddAnotherParent").hide('slow');
		}else{
			$("#btnaddAnotherParent").show('slow');
		}
	});
}
function getChildrenDetails () {
	let childName = $("#childName").val();
	if(childName === ''){
		isFormSubmittable = false;
		showErrorMessage('Child Name is Required');
		error_input_element(true , 'childName');
		return;
	}
	error_input_element(false , 'childName');
	isFormSubmittable = true;
	let childSurname = $("#childSurname").val();
	if(childSurname === ''){
		isFormSubmittable = false;
		showErrorMessage('Surname is Required');
		error_input_element(true , 'childSurname');
		return;
	}
	error_input_element(false , 'childSurname');
	isFormSubmittable = true;
	let childSex = $("#childSex").val();
	if(childSex === 'null'){
		isFormSubmittable = false;
		showErrorMessage('Gender is Required');
		error_input_element(true , 'childSex');
		return;
	}
	isFormSubmittable = true;
	error_input_element(false , 'childSex');
	let childDOB = $("#childDOB").val();
	if(childSex === 'null'){
		isFormSubmittable = false;
		showErrorMessage('Gender is Required');
		error_input_element(true , 'childSex');
		return;
	}
	error_input_element(false , 'childSex');
	isFormSubmittable = true;
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
		showErrorMessage('Child  Name is Required');
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
		$("#btnChildPrev").show();
		childCount.text((childCounter));
		/*if(childrenArr.length > 1){
			$("#btnChildNext").show();
		}*/
		$("#divRow_ChildDetails" ).delay(400).show("slide", { direction: "left" }, 1200);
	});
	// console.log (childrenArr)
}

$(document).keydown(function(event) {
	if (event.ctrlKey==true && (event.which == '118' || event.which == '86')) {
		alert('thou. shalt. not. PASTE!');
		event.preventDefault();
	}
});