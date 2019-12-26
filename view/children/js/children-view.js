const util = new Util();
const modalinformationDialog = $("#informationDialog");
const modalEditChildDialog = $("#editChildDialog");
const modalEditParentDialog = $("#editParentDialog");

modalEditParentDialog.iziModal ({
	width: 700,
	radius: 5,
	padding: 20
});

modalEditChildDialog.iziModal ({
	width: 700,
	radius: 5,
	padding: 20
});

modalinformationDialog.iziModal ({
	width: 700,
	radius: 5,
	padding: 20
});



modalinformationDialog.iziModal ('setHeaderColor', MODAL_HEADER_COLOR);
modalEditParentDialog.iziModal ('setHeaderColor', MODAL_HEADER_COLOR);
modalEditChildDialog.iziModal ('setHeaderColor', MODAL_HEADER_COLOR);



$('.reload-card-remake').click(()=>{
	
	getDefaultData ();
});

function getChildDetail (id) {
	modalinformationDialog.iziModal ('startLoading');
	axios.get('/view/children',{params:{rec_get:id}}).then(res=>{
		setTimeout (function () {
			modalinformationDialog.iziModal ('stopLoading');
		}, randomNumbers(1,4) * 1000);
		
		if(res.statusText === 'OK'){
			let details='';
			let j = res.data.childDetails[0];
			let data = res.data.childDetails;
			
			
			 details +=`
			
						<h4 class="sub-title">Child Details</h4>
						<dl class="dl-horizontal row">
							<dt class="col-sm-3">Full Name</dt>
							<dd class="col-sm-9">${(j.name)} ${(j.surname)} </dd>
							
							<dt class="col-sm-3">Sex</dt>
							<dd class="col-sm-9">${j.sex}.</dd>
							
							<dt class="col-sm-3">Date Of Birth</dt>
							<dd class="col-sm-9">${j.date_of_birth}.</dd>
						
						</dl>
						`;
			
			//console.log (j);
			const col_size = Math.floor( 12 / data.length) ;
			details+=`<h4 class="sub-title">Parents Details</h4>
						
						<div class="row" >`;
			_.forEach(data,(valls,inx)=>{
				
				details+=`
							<div class="col-lg-${col_size}">
								
									<h4 class="sub-title">Parent ${inx + 1}</h4>
									<dl class="dl-horizontal row">
									
										<dt class="col-sm-3"> Name </dt>
										<dt class="col-sm-9"> ${capitaliseTextFirstCaseForWords(valls.parent?valls.parent:'None')}</dt>
										
										<dt class="col-sm-3"> Gender </dt>
										<dt class="col-sm-9">${capitaliseTextFristLetter(valls.sex?valls.sex:'None')} </dt>
										
										<dt class="col-sm-3">Contact </dt>
										<dt class="col-sm-9">${valls.contact?valls.contact:'None'} </dt>
										
										<dt class="col-sm-3"> Email</dt>
										<dt class="col-sm-9">${valls.email?valls.email:'None'} </dt>
										
										<dt class="col-sm-3"> ID No. </dt>
										<dt class="col-sm-9"> ${valls.id_number ? valls.id_number : 'None'}</dt>
										
										<dt class="col-sm-3">Occu. </dt>
										<dt class="col-sm-9">${valls.occupation?valls.occupation:''} </dt>
										
										<dt class="col-sm-3">Address </dt>
										<dt class="col-sm-9">${valls.address? valls.address.split(',').join(' <br> ') : ''} </dt>
										
									</dl>
							</div>
						
			`;
			});
			details+=` </div>`;
			$("#div_details_info_dialog").html(details);
			//console.log (res.data.childDetails)
		}
	}).catch(err=>{
		console.log (err)
		modalinformationDialog.iziModal ('stopLoading');
		modalinformationDialog.iziModal ('close');
		showErrorMessage('Failed to connect' ,4);
	});
}

function getDefaultData () {
	const card = onDivLoad ();
	axios.get('/view/children',{params:{get_def:3}}).then(res=>{
		checkAuth(res.data);
		if(res.statusText === 'OK'){
			const j = res.data;
			renderChildrenTable(j.children);
		}
		setTimeout ( ()=> onDivLoadRemove(card), 2000);
	}).catch(err=>{
		onDivLoadRemove(card);
	})
}

function renderChildrenTable(data){
	let row = '' ;
	_.forEach(data,(valls,inx)=>{
		row += `
		
		<tr>
				<th scope="row">${(inx+1)}</th>
				<td>${capitaliseTextFristLetter(valls.name)} ${capitaliseTextFristLetter(valls.surname)}</td>
				<td>${capitaliseTextFristLetter(valls.sex)}</td>
				<td>${valls.date_of_birth}</td>
				<td>
				<div class="dropdown-default dropdown open">
				<button class="btn btn-default btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Info</button>
				<div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
				
				<a class="dropdown-item waves-light waves-effect" onclick="showInfoDialog('${valls.id}')" href="javascript:void(0)">Info</a>
				
				<a class="dropdown-item waves-light waves-effect" onclick="showEditDialog('${valls.id}')" href="javascript:void(0)">Edit</a>
				<a class="dropdown-item waves-light waves-effect" onclick="openDeleteDdialog('${valls.id}')" href="javascript:void(0)">Delete</a>
				</div>
				</div>
				</td>
			</tr>
		
		`;
	});
	$("#tbody_childrenview").html(row);
}
function openDeleteDdialog(id){
	iziToast.question({
		timeout: 20000,
		close: false,
		overlay: true,
		displayMode: 'once',
		id: 'question',
		zindex: 999,
		title: 'Confirm',
		message: 'Are you sure about Deleting ?',
		position: 'center',
		buttons: [
			['<button class="btn-danger"><b>YES Delete</b></button>', function (instance, toast) {
				
				instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
				deleteRecord(id);
				
			}, true],
			['<button>NO</button>', function (instance, toast) {
				
				instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
				
			}],
		],
		onClosing: function(instance, toast, closedBy){
			//console.info('Closing | closedBy: ' + closedBy);
		},
		onClosed: function(instance, toast, closedBy){
		//	console.info('Closed | closedBy: ' + closedBy);
		}
	});
	
}
function deleteRecord(id){
	let data_ = new FormData();
	data_.append('delete_rec' , id);
	$('body').loading({
		message: 'Deleting...'
	});
	axios({url:'/backend/children' , method:'post',data:data_}).then(res=>{
		$('body').loading('stop');
		if(res.statusText === 'OK' && res.data.status === 'ok'){
			showSuccessMessage('Record Removed/Delete' , 5);
			getDefaultData();
		}else{
			showErrorMessage('Failed to delete, try again' , 5);
		}
	}).catch(err=>{
		$('body').loading('stop');
		showErrorMessage('Failed to connect ,check your connection' , 5);
	});
}
$(()=>getDefaultData());


function onSaveChildEditDetails () {
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
	if(childDOB === ''){
		isFormSubmittable = false;
		showErrorMessage('Date Of Birth is Required');
		error_input_element(true , 'childDOB');
		return;
	}
	error_input_element(false , 'childDOB');
	isFormSubmittable = true;
	let childNotes = $("#childNotes").val();
	let data_ = new FormData();
	let rec_id = $("#sleectedit_id").text();
	data_.append('child_edit_rec',rec_id);
	data_.append('childName',childName);
	data_.append('childSurname',childSurname);
	data_.append('childSex',childSex);
	data_.append('childDOB',childDOB);
	data_.append('childNotes',childNotes);
	modalEditChildDialog.iziModal('startLoading');
	axios({url:'/backend/children',method:'post',data:data_}).then(res=>{
		modalEditChildDialog.iziModal('stopLoading');
		if(res.statusText === 'OK' && res.data.status === 'ok'){
			showSuccessMessage('Saved Update' , 5);
			modalEditChildDialog.iziModal('close');
			getDefaultData();
		}else {
			showErrorMessage('Failed to save' , 4);
		}
	}).catch(err=>{
		modalEditChildDialog.iziModal('stopLoading');
		showErrorMessage('Failed to connect check connection' , 4 );
	});
	
}
let isFormSubmittable = true;
function onSaveParentEditDetails (id_parent) {
	let parentName = $("#parentName"+'-'+id_parent).val();
	if(parentName === ''){
		isFormSubmittable = false;
		showErrorMessage('Name is Required');
		error_input_element(true , 'parentName'+'-'+id_parent);
		return;
	}
	isFormSubmittable = true;
	error_input_element(false , 'parentName'+'-'+id_parent);
	let parentSurname = $("#parentSurname"+'-'+id_parent).val();
	if(parentSurname === ''){
		isFormSubmittable = false;
		showErrorMessage('Surname is Required');
		error_input_element(true , 'parentSurname'+'-'+id_parent);
		return;
	}
	isFormSubmittable = true;
	error_input_element(false , 'parentSurname'+'-'+id_parent);
	
	let parentIDNumber = $("#parentIDNumber").val();
	if(parentIDNumber === ''){
		isFormSubmittable = false;
		showErrorMessage('ID is Required');
		error_input_element(true , 'parentIDNumber'+'-'+id_parent);
		return;
	}
	isFormSubmittable = true;
	error_input_element(false , 'parentIDNumber'+'-'+id_parent);
	
	let parentSex = $("#parentSex"+'-'+id_parent).val();
	if(parentSex === 'null'){
		isFormSubmittable = false;
		showErrorMessage('Gender is Required');
		error_input_element(true , 'parentSex'+'-'+id_parent);
		return;
	}
	isFormSubmittable = true;
	error_input_element(false , 'parentSex'+'-'+id_parent);
	let  parentOccupation = $("#parentOccupation").val();
	let parentPhone = $("#parentPhone"+'-'+id_parent).val();
	if(parentPhone === ''){
		isFormSubmittable = false;
		showErrorMessage('Contact is Required');
		error_input_element(true , 'parentPhone'+'-'+id_parent);
		return;
	}
	isFormSubmittable = true;
	error_input_element(false , 'parentPhone'+'-'+id_parent);
	let parentEmail = $("#parentEmail"+'-'+id_parent).val();
	if(parentEmail === ''){
		isFormSubmittable = false;
		showErrorMessage('Contact is Required');
		error_input_element(true , 'parentEmail'+'-'+id_parent);
		return;
	}
	isFormSubmittable = true;
	error_input_element(false , 'parentEmail'+'-'+id_parent);
	if(!isEmail(parentEmail) ){
		isFormSubmittable = false;
		showErrorMessage('Valid Email is Required');
		error_input_element(true , 'parentEmail'+'-'+id_parent);
		return;
	}
	isFormSubmittable = true;
	error_input_element(false , 'parentEmail'+'-'+id_parent);
	let parentHomeAddress = $("#parentHomeAddress").val();
	if(parentHomeAddress === ''){
		isFormSubmittable = false;
		showErrorMessage('Contact is Required');
		error_input_element(true , 'parentHomeAddress'+'-'+id_parent);
		return;
	}
	isFormSubmittable = true;
	error_input_element(false , 'parentHomeAddress'+'-'+id_parent);
	let data_ = new FormData();
	data_.append('parent_edit_rec_id' , id_parent);
	data_.append('parentName' , parentName);
	data_.append('parentSurname' , parentSurname);
	data_.append('parentIDNumber' ,parentIDNumber );
	data_.append('parentSex' ,parentSex );
	data_.append('parentOccupation' ,parentOccupation );
	data_.append('parentPhone' ,parentPhone );
	data_.append('parentEmail' , parentEmail);
	data_.append('parentHomeAddress' ,parentHomeAddress );
	modalEditParentDialog.iziModal('startLoading');
	axios({url:'/backend/children',method:'post',data:data_}).then(res=>{
		modalEditParentDialog.iziModal('stopLoading');
		if(res.statusText === 'OK' && res.data.status === 'ok'){
			showSuccessMessage('Saved Update' , 5);
			modalEditParentDialog.iziModal('close');
			getDefaultData();
		}else {
			showErrorMessage('Failed to save' , 4);
		}
	}).catch(err=>{
		modalEditParentDialog.iziModal('stopLoading');
		showErrorMessage('Failed to connect check connection' , 4 );
	});
	// parentsArr = [...new Set(parentsArr)];
	//console.log (parentsArr)
}

function showEditDialog (id) {
	$("#sleectedit_id").text(id);
	iziToast.question({
		timeout: 20000,
		close: false,
		overlay: true,
		displayMode: 'once',
		id: 'question',
		zindex: 999,
		title: 'Confirm',
		message: 'You Want To Edit ',
		position: 'center',
		buttons: [
			['<button><b>the Child</b></button>', function (instance, toast) {
				
				instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
				modalEditChildDialog.iziModal('open');
				axios.get('/view/children',{params:{rec_get:id}}).then(res=>{
					if(res.statusText === 'OK'){
						renderEditChild(res.data.childDetails);
						
					}
				}).catch(err=>{
					showErrorMessage('Failed to connect', 4);
				});
			}, true],
			['<button>the Parent(s)</button>', function (instance, toast) {
				
				instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
				modalEditParentDialog.iziModal('open');
				modalEditParentDialog.iziModal('startLoading');
				axios.get('/view/children',{params:{rec_get:id}}).then(res=>{
					if(res.statusText === 'OK'){
						renderEditParent(res.data.childDetails);
						
					}
				}).catch(err=>{
					console.log (err)
					showErrorMessage('Failed to connect', 4);
				});
				
			}],
		],
		onClosing: function(instance, toast, closedBy){
			//console.info('Closing | closedBy: ' + closedBy);
		},
		onClosed: function(instance, toast, closedBy){
			//console.info('Closed | closedBy: ' + closedBy);
		}
	});
}
function renderEditChild (data) {
	data = data[0];
	
	
	$("#childName").val(data.name);
	$("#childSurname").val(data.surname);
	$("#childSex").val(data.sex);
	$("#childDOB").val(data.date_of_birth);
	$("#childNotes").val(data.notes);
	
	$(":input[data-inputmask-mask]").inputmask();
	$(":input[data-inputmask-alias]").inputmask();
	
}

function renderEditParent (data) {
	
	modalEditParentDialog.iziModal('setZindex', 9999);
	const html = util.renderParentEdit(data);
	$("#renderEditDiv").html(html);
	modalEditParentDialog.iziModal('stopLoading');
	//modalEditParentDialog.iziModal('setFullscreen', true);
	$(":input[data-inputmask-mask]").inputmask();
	$(":input[data-inputmask-alias]").inputmask();
	
	//console.log (data)
}



function showInfoDialog (id) {
	modalinformationDialog.iziModal ('open');
	getChildDetail(id);
}
