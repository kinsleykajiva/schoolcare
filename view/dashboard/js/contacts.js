let CONTACTS_READ_ROW = [];
const modalAddContactDialogDialog = $ ("#addContactDialog");
const modalEditContactDialogDialog = $ ("#editContactDialog");
modalAddContactDialogDialog.iziModal ('setHeaderColor', MODAL_HEADER_COLOR);
modalEditContactDialogDialog.iziModal ('setHeaderColor', MODAL_HEADER_COLOR);

modalAddContactDialogDialog.iziModal ({
	width: 700,
	radius: 5,
	padding: 20
});

modalEditContactDialogDialog.iziModal ({
	width: 700,
	radius: 5,
	padding: 20
});


function onShowAddContactDialog () {
	modalAddContactDialogDialog.iziModal ('open');
	
}

function saveNewContact () {
	let newSelectType = $ ("#newSelectType").val ();
	let newName = $ ("#newName").val ();
	let newSurname = $ ("#newSurname").val ();
	let newOrg = $ ("#newOrg").val ();
	let newEmail = $ ("#newEmail").val ();
	let newPhone = $ ("#newPhone").val ();
	let newAddress = $ ("#newAddress").val ();
	
	let dataa = new FormData ();
	dataa.append ('newSelectType', newSelectType);
	dataa.append ('newName', newName);
	dataa.append ('newSurname', newSurname);
	dataa.append ('newOrg', newOrg);
	dataa.append ('newEmail', newEmail);
	dataa.append ('newPhone', newPhone);
	dataa.append ('newAddress', newAddress);
	if (newSelectType === '1') {
		if (newName === '') {
			showErrorMessage ('Name is required', 4);
			error_input_element (true, 'newName');
			return;
		}
		error_input_element (false, 'newName');
		if (newSurname === '') {
			showErrorMessage ('Surname is required', 4);
			error_input_element (true, 'newSurname');
			return;
		}
		error_input_element (false, 'newSurname');
	} else {
		if (newOrg === '') {
			showErrorMessage ('Organisation Name is required', 4);
			error_input_element (true, 'newOrg');
			return;
		}
		error_input_element (false, 'newOrg');
	}
	error_input_element (false, 'newName');
	error_input_element (false, 'newSurname');
	error_input_element (false, 'newOrg');
	if (newEmail === '') {
		showErrorMessage ('Email is required', 4);
		error_input_element (true, 'newEmail');
		return;
	}
	error_input_element (false, 'newEmail');
	
	if (newPhone === '') {
		showErrorMessage ('Phone is required', 4);
		error_input_element (true, 'newPhone');
		return;
	}
	error_input_element (false, 'newPhone');
	
	if (newAddress === '') {
		showErrorMessage ('Address required', 4);
		error_input_element (true, 'newAddress');
		return;
	}
	error_input_element (false, 'newAddress');
	modalAddContactDialogDialog.iziModal ('startLoading');
	axios ({url: '/backend/contacts', method: 'post', data: dataa}).then (res => {
		modalAddContactDialogDialog.iziModal ('stopLoading');
		if (res.statusText === 'OK' && res.data.status === 'ok') {
			modalAddContactDialogDialog.iziModal ('close');
			showSuccessMessage ('Saved Contact', 4);
			getDefaultData ();
			$ ('#newName ,#newSurname ,#newOrg ,#newEmail ,#newPhone ,#newAddress').val ('');
		} else {
			showErrorMessage ('Failed to connect', 4);
		}
	}).catch (err => {
		modalAddContactDialogDialog.iziModal ('stopLoading');
		showErrorMessage ('Failed to connect', 4);
	})
	
}

function saveEditContact () {
	let newSelectType = $ ("#editSelectType").val ();
	let newName = $ ("#editName").val ();
	let newSurname = $ ("#editSurname").val ();
	let newOrg = $ ("#editOrg").val ();
	let newEmail = $ ("#editEmail").val ();
	let newPhone = $ ("#editPhone").val ();
	let newAddress = $ ("#editAddress").val ();
	let id_rec = $ ("#edit_selected").text ();
	
	let dataa = new FormData ();
	dataa.append ('id_rec', id_rec);
	dataa.append ('editSelectType', newSelectType);
	dataa.append ('editName', newName);
	dataa.append ('editSurname', newSurname);
	dataa.append ('editOrg', newOrg);
	dataa.append ('editEmail', newEmail);
	dataa.append ('editPhone', newPhone);
	dataa.append ('editAddress', newAddress);
	if (newSelectType === '1') {
		if (newName === '') {
			showErrorMessage ('Name is required', 4);
			error_input_element (true, 'editName');
			return;
		}
		error_input_element (false, 'editName');
		if (newSurname === '') {
			showErrorMessage ('Surname is required', 4);
			error_input_element (true, 'editSurname');
			return;
		}
		error_input_element (false, 'editSurname');
	} else {
		if (newOrg === '') {
			showErrorMessage ('Organisation Name is required', 4);
			error_input_element (true, 'editOrg');
			return;
		}
		error_input_element (false, 'editOrg');
	}
	error_input_element (false, 'editName');
	error_input_element (false, 'editSurname');
	error_input_element (false, 'editOrg');
	if (newEmail === '') {
		showErrorMessage ('Email is required', 4);
		error_input_element (true, 'editEmail');
		return;
	}
	error_input_element (false, 'editEmail');
	
	if (newPhone === '') {
		showErrorMessage ('Phone is required', 4);
		error_input_element (true, 'editPhone');
		return;
	}
	error_input_element (false, 'editPhone');
	
	if (newAddress === '') {
		showErrorMessage ('Address required', 4);
		error_input_element (true, 'editAddress');
		return;
	}
	error_input_element (false, 'editAddress');
	modalEditContactDialogDialog.iziModal ('startLoading');
	axios ({url: '/backend/contacts', method: 'post', data: dataa}).then (res => {
		modalEditContactDialogDialog.iziModal ('stopLoading');
		if (res.statusText === 'OK' && res.data.status === 'ok') {
			modalEditContactDialogDialog.iziModal ('close');
			showSuccessMessage ('Updated Contact', 4);
			getDefaultData ();
			$ ('#editName ,#editSurname ,#editOrg ,#editEmail ,#editPhone ,#editAddress').val ('');
		} else {
			showErrorMessage ('Failed to connect', 4);
		}
	}).catch (err => {
		modalEditContactDialogDialog.iziModal ('stopLoading');
		showErrorMessage ('Failed to connect', 4);
	})
	
}

function editSelectsOnType () {
	let select = $ ("#editSelectType").val ();
	if (select === '1') {
		$ ("#editdivPerson").show ('slow');
		$ ("#editdivOrg").hide ('slow');
		$ ('#editOrg').val ('');
	} else {
		$ ("#editName,#editSurname").val ('');
		$ ("#editdivOrg").show ('slow');
		$ ("#editdivPerson").hide ('slow');
	}
}

function resetSelectsOnType () {
	let select = $ ("#newSelectType").val ();
	if (select === '1') {
		$ ("#divPerson").show ('slow');
		$ ("#divOrg").hide ('slow');
		$ ('#newOrg').val ('');
	} else {
		$ ("#newName,#newSurname").val ('');
		$ ("#divOrg").show ('slow');
		$ ("#divPerson").hide ('slow');
	}
}


function getDefaultData () {
	axios.get ('/view/contacts', {params: {def_cont: 231}}).then (res => {
		if (res.statusText === 'OK') {
			const j = res.data;
			//console.log (j);
			CONTACTS_READ_ROW = j.gen_contacts;
			renderContactsTable (j.gen_contacts);
		}
	}).catch (err => {
		showErrorMessage ('Failed to connect, please check your connection', 4);
	});
}

$ (() => getDefaultData ());

function onEditContactDialog (id) {
	$ ("#edit_selected").text (id);
	modalEditContactDialogDialog.iziModal ('open');
	let obj = CONTACTS_READ_ROW.filter (x => x.id == id)[0];
	$ ('#editName ').val (obj.name);
	$ ('#editSurname').val (obj.surname);
	$ ('#editOrg').val (obj.organisation);
	$ ('#editEmail').val (obj.email);
	$ ('#editPhone').val (obj.contacts);
	$ ('#editAddress').val (obj.address);
	$ ('#editSelectType').val ( obj.name !== 'NULL' ? '1' : '2');
	editSelectsOnType();
	
}

function onDeleteShowDialog (id) {
	iziToast.question({
		timeout: 20000,
		close: false,
		overlay: true,
		displayMode: 'once',
		id: 'question',
		zindex: 999,
		title: 'Confirmation',
		message: 'Are you sure about deleting?',
		position: 'center',
		buttons: [
			['<button><b>YES</b></button>', function (instance, toast) {
				$('body').loading({
					message: 'Deleting...'
				});
				instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
				let dataa = new FormData();
				dataa.append('rec_id_edit',id);
				axios({url:'/backend/contacts',method:'post',data:dataa}).then(res=>{
					$('body').loading('stop');
					if(res.statusText === 'OK' && res.data.status === 'ok'){
						iziToast.success({
							title: 'Record Removed',
							message: 'Successfully removed record!',
						});
						getDefaultData () ;
					}else{
						iziToast.error({
							title: 'Error Response',
							message: 'Failed to Delete !',
						});
					}
				}).catch(err=>{
					$('body').loading('stop');
					iziToast.error({
						title: 'Error Response',
						message: 'Failed to Connect,Check Internet Connection !',
					});
				})
				
			}, true],
			['<button>NO</button>', function (instance, toast) {
				
				instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
				
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

function renderContactsTable (data) {
	
	if (data.length === 0) {
		
		$ ("#tbody_contacts").html (noDataRow (6, '--'));
		return;
	}
	
	let rw = ``;
	_.forEach (data, (valls, inx) => {
		
		let cont = valls.name !== 'NULL' ? valls.name + ' '+ valls.surname : valls.organisation;
		rw += `
		
		<tr >
		     <th scope="row">${inx+1}</th>
		     <td>${cont}</td>
		     <td>${valls.contacts}</td>
		     <td>${valls.email}</td>
		     <td>${valls.address.split (',').join (' <br> ')}</td>
		     <td>
		      <div class="dropdown-default dropdown open">
		       <button class="btn btn-default btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
		       <div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
		        <a class="dropdown-item waves-light waves-effect" onclick="onEditContactDialog('${valls.id}');" href="javascript:void(0)">Edit</a>
		        <a class="dropdown-item waves-light waves-effect" onclick="onDeleteShowDialog('${valls.id}');" href="javascript:void(0)">Delete</a>
		       </div>
		      </div>
		     </td>
    	 </tr>
		
		`;
	});
	$ ("#tbody_contacts").html (rw);
}