let ROOMS_READ_ROOWS = [] ;
const modalNewRoom = $("#NewRoomDialog");
const modalEditRoomDialog = $("#EditRoomDialog");

modalNewRoom.iziModal({
	width: 700,
	radius: 5,
	padding: 20
});


modalEditRoomDialog.iziModal({
	width: 700,
	radius: 5,
	padding: 20
});


modalNewRoom.iziModal('setHeaderColor', MODAL_HEADER_COLOR);
modalEditRoomDialog.iziModal('setHeaderColor', MODAL_HEADER_COLOR);

function openNewRoomDialog () {
	
	modalNewRoom.iziModal('open');
	
}
$('.reload-card-remake').click(()=>{
	
	getDefaultData ();
});

function updateNewRoom () {
	const newRoomName = $("#editRoomName").val();
	const newAgeRanges = $("#editAgeRanges").val();
	
	if(newRoomName === ''){
		showErrorMessage('Room Name is required' , 3);
		error_input_element(true , 'editRoomName');
		return;
	}
	error_input_element(false , 'editRoomName');
	if(newAgeRanges === 'null'){
		showErrorMessage('Age Range  is required' , 3);
		error_input_element(true , 'editAgeRanges');
		return;
	}
	error_input_element(false , 'editAgeRanges');
	let rec_id = $("#selected_edit_id").text();
	modalEditRoomDialog.iziModal('startLoading');
	let data_ = new FormData();
	data_.append('newRoomName' , newRoomName);
	data_.append('newAgeRanges' , newAgeRanges);
	data_.append('sent_type_edit' , rec_id);
	axios({url:'/backend/rooms',method:'post',data:data_}).then(res=>{
		modalEditRoomDialog.iziModal('stopLoading');
		
		if(res.statusText === 'OK' && res.data.status === 'ok'){
			showSuccessMessage('New Room Added ' , 5);
			modalEditRoomDialog.iziModal('close');
			getDefaults ();
			$("#editRoomName").val('');
			$("#editAgeRanges").val('null');
		}else{
			showErrorMessage('Failed to update , please try again' , 5);
		}
		
	}).catch(error=>{
		modalEditRoomDialog.iziModal('stopLoading');
		showErrorMessage('Failed to Connect Please check your connection' ,4);
	});
	
	
}
function saveNewRoom () {
	const newRoomName = $("#newRoomName").val();
	const newAgeRanges = $("#newAgeRanges").val();
	
	if(newRoomName === ''){
		showErrorMessage('Room Name is required' , 3);
		error_input_element(true , 'newRoomName');
		return;
	}
	error_input_element(false , 'newRoomName');
	if(newAgeRanges === 'null'){
		showErrorMessage('Age Range  is required' , 3);
		error_input_element(true , 'newAgeRanges');
		return;
	}
	error_input_element(false , 'newAgeRanges');
	modalNewRoom.iziModal('startLoading');
	let data_ = new FormData();
	data_.append('newRoomName' , newRoomName);
	data_.append('newAgeRanges' , newAgeRanges);
	data_.append('sent_type_new' , 'new');
	axios({url:'/backend/rooms',method:'post',data:data_}).then(res=>{
		modalNewRoom.iziModal('stopLoading');
		
		if(res.statusText === 'OK' && res.data.status === 'ok'){
			showSuccessMessage('New Room Added ' , 5);
			modalNewRoom.iziModal('close');
			getDefaults ();
			$("#newRoomName").val('');
			$("#newAgeRanges").val('null');
		}else{
			showErrorMessage('Failed to save , please try again' , 5);
		}
		
	}).catch(error=>{
		modalNewRoom.iziModal('stopLoading');
		showErrorMessage('Failed to Connect Please check your connection' ,4);
	});
	
	
}
function renderRoomsTable (data) {
	let row = ``;
	ROOMS_READ_ROOWS = data;
	if(data.length < 1){
		$('#tbody_data_row').html(noDataRow(4 , 'No Data'));
		return;
	}
	_.forEach(data,(valls,inx)=>{
		row += `
			<tr style="">
						<th scope="row">${inx + 1}</th>
						<td>${valls.title}</td>
						<td> ${valls.ages} months  (${ageUniter(valls.ages.split('-')[0])} -  ${ageUniter(valls.ages.split('-')[1])} years )</td>
						<td>
									<div class="dropdown-info dropdown open">
									<button class="btn btn-default btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Info</button>
									<div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
									<a class="dropdown-item waves-light waves-effect" onclick="renameDialog('${valls.id}')" href="javascript:void(0)">Rename</a>
									
									</div>
									</div>
                        </td>
			</tr>
		`;
	});
	$('#tbody_data_row').html(row);
}

function renderAgesSelects (data) {
	let opt = `<option value="null">Select Age Ranges </option>`;
	_.forEach(data,(valls,inx)=>{
		opt += `
				<option value="${valls.id}"> ${valls.start_age_in_months}  - ${valls.end_age_in_months} Months  (${ageUniter(valls.start_age_in_months)} - ${ageUniter(valls.end_age_in_months)} years)</option>
		`;
	});
	$("#newAgeRanges,#editAgeRanges").html(opt);
}
let ageUniter = x=> Math.floor(x/12) ;
function renameDialog (id) {
	let obj = ROOMS_READ_ROOWS.filter(x=>x.id == id)[0];
	$("#selected_edit_id").text(id);
	$("#editRoomName").val(obj.title);
	$("#editAgeRanges").val(obj.id_age_range);
	modalEditRoomDialog.iziModal('open');
	
}
function getDefaults () {
	const card = onDivLoad ();
	axios.get('/view/rooms',{
		params:{
			get_def:32
		}
	}).then(res=>{
		if(res.statusText === 'OK'){
			const j  = res.data;
			
			renderRoomsTable(j.rooms);
			renderAgesSelects(j.ages);
		}
		setTimeout ( ()=> onDivLoadRemove(card), 2000);
	}).catch(err=>{
		setTimeout ( ()=> onDivLoadRemove(card), 2000);
		showErrorMessage('Failed to connect Please check your connection' , 5);
	})
}

$(()=>{getDefaults();})