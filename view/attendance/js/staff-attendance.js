//const $datepicker =  $('.datepicker').pickadate();
$('#datepicker').datetimepicker();
const modalNewClockInDialog = $("#NewClockInDialog");

modalNewClockInDialog.iziModal({
	width: 700,
	radius: 5,
	padding: 20
});
modalNewClockInDialog.iziModal('setHeaderColor', MODAL_HEADER_COLOR);
let def_empl_select = 'null';
function getDefultData () {
	axios.get('/view/staff',{params:{get_att:90}}).then(res=>{
		if(res.statusText === 'OK'){
			const j = res.data;
			def_empl_select = j.def_empl_select;
			renderStaffTable(j.att);
			renderStaffSeletcs(j.empl);
			
		}else{
			showErrorMessage('Failed to get data , please refresh', 4);
		}
	}).catch(err=>{
		console.log (err)
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
	$("#select_staff").html(opt);
	$("#select_staff").val(def_empl_select);
}

function openClockInDialog () {
	modalNewClockInDialog.iziModal('open');
	$('#datepicker').datetimepicker('show');
	//$datepicker.open();
}

function renderStaffTable (data) {
	let row = ``;
	if(data.length < 1){
		$("#tbody_data").html(noDataRow(6,'No Data'));
		return;
	}
	_.forEach(data,(valls,inx)=>{
		row += `
		
		<tr style="">
				<th scope="row">1</th>
				<td>Mark</td>
				<td>Otto</td>
				<td>@mdo</td>
				<td>@mdo</td>
				<td>
						<div class="dropdown-info dropdown open">
						<button class="btn btn-info dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Info</button>
						<div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
						<a class="dropdown-item waves-light waves-effect" onclick="" href="javascript:void(0);">Action</a>
						<a class="dropdown-item waves-light waves-effect" href="#">Another action</a>
						</div>
						</div>
				</td>
				</tr>
		
		`;
	});
	$("#tbody_data").html(row);
}