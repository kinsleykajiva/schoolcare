const modalNewClockInDialog = $("#NewClockInDialog");

modalNewClockInDialog.iziModal({
	width: 700,
	radius: 5,
	padding: 20
});

modalNewClockInDialog.iziModal('setHeaderColor', MODAL_HEADER_COLOR);

function getDefaultData () {
	axios.get('view/children',{params:{get_def_clock:78}}).then(res=>{
		if(res.statusText === 'OK'){
			const j  = res.data;
			renderKidsList(j.children);
			renderRoomsSelects(j.rooms);
			renderAttendanceRegisterTable(j.att);
		}else{
			showErrorMessage('Failed to get Data please refresh' ,4);
		}
	}).catch(er=>{
		showErrorMessage("Failed to connect",3);
	})
}

$(()=>{
	getDefaultData ();
});


function renderAttendanceRegisterTable(data){
	let row = ``;
	if(data.length < 1){
		$("#tbody_data").html(noDataRow(6,'No Data'));
		return;
	}
	_.forEach(data,(valls,inx)=>{
		let checkOutOption = valls.time_sign_out === '--' ?  `<a class="dropdown-item waves-light waves-effect" onclick="showCheckoutDialog('${valls.id}','${capitaliseTextFirstCaseForWords(valls.childName)}');" href="javascript:void(0);">Clock Out</a>`: '';
		row += `
		
		<tr style="">
				<th scope="row">${inx + 1}</th>
				<td>${capitaliseTextFirstCaseForWords(valls.childName)}</td>
				<td>
					${valls.time_sign_in}
				</td>
				<td>${valls.time_sign_out}</td>
				<td>${valls.date_sign_in}</td>
				<td>
						<div class="dropdown-default dropdown open">
							<button class="btn btn-default btn-mini  dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
							<div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
								${checkOutOption}
							</div>
						</div>
				</td>
		</tr>
		
		
		`;
	});
	$("#tbody_data").html(row);
}
function showCheckoutDialog(id , kidName){
	let time = '';
	
	iziToast.question({
		timeout: 20000,
		overlay: true,
		displayMode: 'once',
		id: 'inputs',
		zindex: 999,
		title: 'Confirmation',
		message: 'Your About to clock Out ' + kidName,
		position: 'center',
		drag: false,
		inputs: [
			['<input type="time">', 'keyup', function (instance, toast, input, e) {
				time = input.value ;
			}]
		],
		buttons: [
			['<button><b>YES</b></button>', function (instance, toast) {
				if(time === ''){
					showErrorMessage("Set Time");
					return;
				}
				if(!moment(time, "HH:mm", true).isValid()){
					showErrorMessage("Set Valid Time");
					return;
				}
				
				
				instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
				let data=new FormData();
				const card = onDivLoad ();
				data.append('rec_signout_id' , id);
				data.append('time' , time);
				
				axios({url:'/backend/children',method:'post',data:data}).then(res=>{
					onDivLoadRemove(card);
					if(res.statusText === 'OK' && res.data.status === 'ok'){
						showSuccessMessage(kidName + ' checked  out for the day' ,4);
						getDefaultData ();
					}else{
						showErrorMessage('Failed to clock out , please try again' ,4);
					}
				}).catch(err=>{
					onDivLoadRemove(card);
					showErrorMessage('Failed to clock out' , 4);
				});
				
			}, true],
			['<button>NO</button>', function (instance, toast) {
				
				instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
				
			}],
		],
	});
}
let ageUniter = x=> Math.floor(x/12) ;
function openClockInDialog () {
	
	modalNewClockInDialog.iziModal('open');
	modalNewClockInDialog.iziModal('setTitle', 'Clock In Dialog');
	const now = new Date ();
	
	const day = ("0" + now.getDate ()).slice (-2);
	const month = ("0" + (now.getMonth () + 1)).slice (-2);
	
	const today = now.getFullYear () + "-" + (month) + "-" + (day);
	
	$('#datetimepicker4').val(today);
}

function renderRoomsSelects(data){
	let opt = `<option value="null"> All Rooms </option>`;
	_.forEach(data,(valls,inx)=>{
		opt += `<option value="${valls.id}"> ${valls.title} (${ageUniter(valls.ages.split('-')[0])} - ${ageUniter(valls.ages.split('-')[1])}  years)</option>`;
	});
	$('#select_rooms').html(opt);
}

let yearsCalc = x=> moment().diff(x, 'years');
function renderKidsList (data) {
	
	let row =``;
	
	_.forEach(data,(valls,inx)=>{
		row += `
						<div class="col-md-12">
							<div class="checkbox-fade fade-in-primary">
								<label>
									<input type="checkbox" class="kids_selected" value="${valls.id}">
									<span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
									<span class="text-inverse">${capitaliseTextFristLetter(valls.name)} ${capitaliseTextFristLetter(valls.surname)} (${yearsCalc(valls.date_of_birth)} years Old) </span>
								</label>
							</div>
						</div>
		
		`;
	});
	$("#kids_list").html(row);
}


function saveClockIn () {
	
	
	let kids_selected = getCheckedInputsGetValues('kids_selected');
	
	if(kids_selected.length<1){
		showErrorMessage('Please Select Kids To Sing In' , 4);
		return;
	}
	let datetimepicker4 = $('#datetimepicker4').val();
	let timepicker = $('#timepicker').val();
	if(timepicker === ''){
		error_input_element(true , 'timepicker');
		showErrorMessage('Set time clock Time' , 4);
		return;
	}
	error_input_element(false , 'timepicker');
	let select_rooms = $('#select_rooms').val();
	modalNewClockInDialog.iziModal('startLoading');
	let data = new FormData();
	data.append('kids_selected' , kids_selected+'');
	data.append('new_att' , '8900');
	data.append('datetimepicker4' , datetimepicker4);
	data.append('timepicker' , timepicker);
	data.append('select_rooms' , select_rooms);
	axios({url:'/backend/children',method:'post' , data:data}).then(res=>{
		modalNewClockInDialog.iziModal('stopLoading');
		if(res.statusText === 'OK' && res.data.status === 'ok'){
			modalNewClockInDialog.iziModal('close');
			showSuccessMessage('Attendance Added' ,5);
			uncheckCheckedInputs('kids_selected');
			$('#timepicker').val('');
			$('#select_rooms').val('null');
			getDefaultData ();
		}else{
			showErrorMessage('Failed to save' , 4);
		}
	}).catch(err=>{
		modalNewClockInDialog.iziModal('stopLoading');
		showErrorMessage('Faild to connect to a server ' , 3);
	});
}
