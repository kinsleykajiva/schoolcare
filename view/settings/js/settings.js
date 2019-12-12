

let READ_USERS_ROWS = [];
const modalNewUser= $("#addNewUserModal");
const modalEditUser= $("#editUserModal");

modalNewUser.iziModal({
	width: 700,
	radius: 5,
	padding: 20
});
modalEditUser.iziModal({
	width: 700,
	radius: 5,
	padding: 20
});
modalNewUser.iziModal('setHeaderColor', MODAL_HEADER_COLOR);
modalEditUser.iziModal('setHeaderColor', MODAL_HEADER_COLOR);
$('.reload-card-remake').click(()=>{
	getDefaultData ();
});


function getDefaultData () {
	const card = onDivLoad ();
	
	axios.get('/view/users',{params:{get_def:'343'}}).then(res=>{
		if(res.statusText === 'OK'){
			const j = res.data;
			renderUsersTable(j.users);
			renderRolesSelects(j.roles);
			renderEmployeesSelects(j.empl_no_acc);
			setTimeout (function () {
				onDivLoadRemove(card);
			}, 2000);
		}
	}).catch(err=>{
		onDivLoadRemove(card);
		showErrorMessage('Failed to connect' , 4);
	})
}
$(()=>{getDefaultData ()});

function renderEmployeesSelects (data) {
	let opt = `<option value="null"> Select Employee</option>`;
	_.forEach(data,(vals,inx)=>{
		opt += `<option value="${vals.id}"> ${vals.name} ${vals.surname}</option>`;
	});
	$("#selectEmployees").html(opt);

}
function renderRolesSelects (data) {
	let opt = `<option value="null"> Select Role</option>`;
	_.forEach(data,(vals,inx)=>{
		opt += `<option value="${vals.id}"> ${vals.title}</option>`;
	});
	$("#selectRole").html(opt);
	$("#edit_selectRole").html(opt);
}
function renderUsersTable (data) {
	READ_USERS_ROWS = data;
	let row =``;
	
	_.forEach(data,(vall,inx)=>{
		row += `
		
						
						
						<tr>
						<td scope="row">.</td>
						<td> ${vall.USERNAME} </td>
						<td> ${vall.fullName} </td>
						<td>${vall.roleTitle}</td>
						
						
						<td>
							<div class="dropdown-default dropdown open">
									<button class="btn btn-default btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Info</button>
									<div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
									<a class="dropdown-item waves-light waves-effect" onclick="openEditUserDialog('${vall.ID}')" href="javascript:void(0)">Edit</a>
									<a class="dropdown-item waves-light waves-effect" href="javascript:void(0);" onclick="openDeleteDialog('${vall.ID}')">Delete</a>
									</div>
							</div>
						</td>
				</tr>
		
		`;
	});
	$("#tbodyUsers").html(row);
}
function openDeleteDialog(id)  {
	iziToast.question({
		timeout: 20000,
		close: false,
		overlay: true,
		displayMode: 'once',
		id: 'question',
		zindex: 999,
		title: 'Confirmation',
		message: 'Are you sure about deleting this record ?',
		position: 'center',
		buttons: [
			['<button><b>YES</b></button>', function (instance, toast) {
				
				instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
				
				deleteUser(id);
			}, true],
			['<button>NO</button>', function (instance, toast) {
				
				instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
				
			}],
		],
		onClosing: function(instance, toast, closedBy){
			console.info('Closing | closedBy: ' + closedBy);
		},
		onClosed: function(instance, toast, closedBy){
			console.info('Closed | closedBy: ' + closedBy);
		}
	});
}
function deleteUser (id) {
	$('body').loading({
		message: 'Deleting...'
	});
	let data_ = new FormData();
	data_.append('delete_user' ,id);
	axios({url:'/backend/users' , method:'post' , data:data_}).then(res=>{
		$('body').loading('stop');
		if(res.statusText === 'OK' && res.data.status === 'ok'){
			iziToast.success({
				title: 'Record Removed',
				message: 'Operation Done Successfully !',
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
}
function saveUpdateUser () {
	
	let edit_newUsername =  $("#edit_newUsername").val();
	let edit_newPassword = $("#edit_newPassword").val();
	let edit_selectRole = $("#edit_selectRole").val();
	let id = $("#selectUSerEdit").text(); ;
	let data_ = new FormData();
	data_.append('rec_id',id);
	data_.append('edit_selectRole',edit_selectRole);
	data_.append('edit_newPassword',edit_newPassword);
	data_.append('edit_newUsername',edit_newUsername);
	if(edit_newUsername === ''){
		error_input_element(true , 'edit_newUsername');
		showErrorMessage("Username Required" , 4);
		return;
	}
	error_input_element(false , 'edit_newUsername');
	
	if(edit_selectRole === 'null'){
		error_input_element(true , 'edit_selectRole');
		showErrorMessage("Role Required" , 4);
		return;
	}
	error_input_element(false , 'edit_selectRole');
	modalEditUser.iziModal('startLoading');
	axios({url:'/backend/users',method:'post',data:data_}).then(res=>{
		modalEditUser.iziModal('stopLoading');
		if(res.statusText === 'OK' && res.data.status === 'ok'){
			showSuccessMessage('Updated Users Details');
			modalEditUser.iziModal('close');
		}else{
			showErrorMessage('Failed to update' , 3);
		}
	}).catch(err=>{
		modalEditUser.iziModal('stopLoading');
		showErrorMessage('Failed to connect' , 5);
	});
	
}
function openEditUserDialog (id) {
	$("#selectUSerEdit").text(id);
	modalEditUser.iziModal('open');
	let obj = READ_USERS_ROWS.filter(x=>x.ID == id)[0];
	 $("#edit_newUsername").val(obj.USERNAME);
	$("#edit_newPassword").val('');
	  $("#edit_selectRole").val(obj.ID_ROLE);
	 
}
function openNewUserDialog () {
	modalNewUser.iziModal('open');
}
function saveNewJobUser () {
	let newUsername = $("#newUsername").val();
	let newPassword = $("#newPassword").val();
	let selectRole = $("#selectRole").val();
	let selectEmployees = $("#selectEmployees").val();
	
	
	if(selectEmployees === 'null'){
		error_input_element(true , 'selectEmployees');
		showErrorMessage("Employee Required" , 4);
		return;
	}
	error_input_element(false , 'selectEmployees');
	
	
	if(newUsername === ''){
		error_input_element(true , 'newUsername');
		showErrorMessage("Username Required" , 4);
		return;
	}
	error_input_element(false , 'newUsername');
	
	
	
	if(newPassword === ''){
		error_input_element(true , 'newPassword');
		showErrorMessage("Password Required" , 4);
		return;
	}
	error_input_element(false , 'newPassword');
	
	if(selectRole === 'null'){
		error_input_element(true , 'selectRole');
		showErrorMessage("Role Required" , 4);
		return;
	}
	error_input_element(false , 'selectRole');
	
	let data_ = new FormData();
	data_.append('type' ,'new' );
	data_.append('newUsername' , newUsername);
	data_.append('selectEmployees' , selectEmployees);
	data_.append('selectRole' , selectRole);
	data_.append('newPassword' , newPassword);
	modalNewUser.iziModal('startLoading');
	axios({url:'/backend/users' , method:'post' , data:data_}).then(res=>{
		modalNewUser.iziModal('stopLoading');
		if(res.statusText === 'OK' && res.data.status ==='ok'){
			getDefaultData ();
			modalNewUser.iziModal('close');
			showSuccessMessage('User Created');
			emptyInputs(['newUsername','newPassword'],[]);
		}else{
			showErrorMessage('Failed to create user' , 5);
		}
	}).catch(err=>{
		modalNewUser.iziModal('stopLoading');
		showErrorMessage('Failed to connect' , 5);
	})
	
	
	
}