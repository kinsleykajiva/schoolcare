
const modalNewClockInDialog = $("#NewClockInDialog");
const modalClockOutDialog = $("#ClockOutDialog");

modalNewClockInDialog.iziModal({
	width: 700,
	radius: 5,
	padding: 20
});

modalClockOutDialog.iziModal({
	width: 700,
	radius: 5,
	padding: 20
});

modalNewClockInDialog.iziModal('setHeaderColor', MODAL_HEADER_COLOR);
modalClockOutDialog.iziModal('setHeaderColor', MODAL_HEADER_COLOR);
let def_empl_select = 'null';
function getDefultData () {
	const card = onDivLoad ();
	axios.get('/view/staff',{params:{get_att:90}}).then(res=>{
		if(res.statusText === 'OK'){
			const j = res.data;
			def_empl_select = j.def_empl_select;
			renderStaffTable(j.att);
			renderStaffSeletcs(j.empl);
			
		}else{
			showErrorMessage('Failed to get data , please refresh', 4);
		}
		setTimeout (function () {
			onDivLoadRemove(card);
		}, 2000);
	}).catch(err=>{
		//console.log (err)
		setTimeout (function () {
			onDivLoadRemove(card);
		}, 2000);
		showErrorMessage('Failed to connect , check your connection' , 4);
	});
}

$(()=>{getDefultData();});


function renderStaffSeletcs (data) {

	let userID = data.filter(x=>x.userID  == def_empl_select )[0];
	def_empl_select = userID.id;
	let opt = `<option value="null" > Select</option>`;
	_.forEach(data,(valls,inx)=>{
		opt += `<option value="${valls.id}" > ${capitaliseTextFristLetter(valls.name)}  ${capitaliseTextFristLetter(valls.surname)}  </option>`;
	});
	$("#select_staff,#select_staff_out").html(opt);
	$("#select_staff,#select_staff_out").val(def_empl_select);
}
function saveClockIn () {
	let select_staff = $("#select_staff").val();
	if(select_staff === 'null'){
		showErrorMessage('Select Staff to clokc in for' , 4);
		error_input_element(true , 'select_staff');
		return;
	}
	error_input_element(false , 'select_staff');
	
	let datetimepicker4 = $("#datetimepicker4").val();
	let timepicker = $("#timepicker").val();
	
	if(timepicker === ''){
		showErrorMessage('Time Is Required' , 4);
		error_input_element(true , 'timepicker');
		return;
	}
	error_input_element(false , 'timepicker');
	let data_ = new FormData();
	data_.append( 'select_staff' ,select_staff );
	data_.append( 'datetimepicker4' , datetimepicker4);
	data_.append( 'timepicker' ,timepicker );
	data_.append( 'new_save_att' ,34 );
	modalNewClockInDialog.iziModal('startLoading');
	axios({url:'/backend/staff' , method:'post' ,data:data_ }).then(res=>{
		modalNewClockInDialog.iziModal('stopLoading');
		if(res.statusText === 'OK' && res.data.status === 'ok'){
			showSuccessMessage('Clocked In' ,5);
			modalNewClockInDialog.iziModal('close');
			getDefultData();
		}else{
			showErrorMessage('Failed to save , Please try again' , 4);
		}
	}).catch(err=>{
		modalNewClockInDialog.iziModal('stopLoading');
		showErrorMessage('Failed to connect , Please check your connection' , 4);
	});
	
}

function openClockInDialog () {
	
	modalNewClockInDialog.iziModal('open');
	modalNewClockInDialog.iziModal('setTitle', 'Clock In Dialog');
	var now = new Date();
	
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
	
	
	$('#datetimepicker4').val(today);
	//console.log (today)
	
	//$datepicker.open();
}
let READ_STAFF_ROWS =[];
function renderStaffTable (data) {
	READ_STAFF_ROWS = data;
	let row = ``;
	if(data.length < 1){
		$("#tbody_data").html(noDataRow(6,'No Data'));
		return;
	}
	_.forEach(data,(valls,inx)=>{
		let checkOption = valls.time_sign_out === '--' ?'':`style="display: none;"`;
		let checkOutOption = valls.time_sign_out === '--' ?  `<a class="dropdown-item waves-light waves-effect" onclick="showCheckoutDialog('${valls.id}');" href="javascript:void(0);">Clock Out</a>`: '';
		row += `
		
		<tr  >
				<th scope="row">${inx + 1}</th>
				<td>${valls.empName}</td>
				<td>
					${valls.time_sign_in}
				</td>
				<td>${valls.time_sign_out}</td>
				<td>${valls.date_sign_in}</td>
				<td >
						<div class="dropdown-default dropdown open" ${checkOption}>
						<button class="btn btn-mini btn-default dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Info</button>
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
function saveClockOut () {
	let select_staff_out = $("#select_staff_out").val();
	
	let datetimepicker4_out = $("#datetimepicker4_out").val();
	let timepicker_out = $("#timepicker_out").val();
	if(timepicker_out === ''){
		showErrorMessage('Time is required' , 4);
		error_input_element(true , 'timepicker_out');
		return;
	}
	error_input_element(false , 'timepicker_out');
	let id_record= $("#selected_att_id").text();
	let data_ = new FormData();
	data_.append('select_staff_out' , select_staff_out);
	data_.append('datetimepicker4_out' ,datetimepicker4_out );
	data_.append('timepicker_out' , timepicker_out);
	data_.append('id_record' , id_record);
	data_.append('new_edit_att' , id_record);
	modalClockOutDialog.iziModal('startLoading');
	axios({
		url:'/backend/staff' , method:'post', data:data_
	}).then(res=>{
		if(res.statusText === 'OK' && res.data.status === 'ok'){
			modalClockOutDialog.iziModal('close');
			getDefultData();
			showSuccessMessage('Clocked out' , 4);
		}else{
			showErrorMessage('Failed to clock out' , 4);
		}
	}).catch(err=>{
		modalClockOutDialog.iziModal('stopLoading');
		showErrorMessage('Failed to connect' , 4);
	});
	
}
$('.reload-card-remake').click(()=>{
	getDefultData ();
});

function showCheckoutDialog (id) {
	$("#selected_att_id").text(id);
	let obj = READ_STAFF_ROWS.filter(x=>x.id == id)[0];
	
	modalClockOutDialog.iziModal('open');
	$("#datetimepicker4_out").val(obj.date_sign_in);
	$("#timepicker_out").val('');
	$("#select_staff_out").val(def_empl_select);
	
	var now = new Date();
	
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
	
	
	$('#datetimepicker4_out').val(today);
}