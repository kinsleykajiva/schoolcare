$('.reload-card-remake').click(()=>{

	getDefaultData ();
});

function getDefaultData () {
	const card = onDivLoad ();
	axios.get('/view/jobposition',{
		params:{
			get_def:'all'
		}
	}).then(res=>{

		if(res.statusText === 'OK'){
			checkAuth(res.data);
			renderJobsTable(res.data.jobPos);
			//console.log (res.data);
		}else{
			showErrorMessage('Failed to get data , reload page again' , 4);
		}
		setTimeout (function () {
			onDivLoadRemove(card);
		}, 2000);

	}).catch(err=>{
		showErrorMessage('Failed to Connect, check your connection.',4);
		console.log (err);
	});
}
getDefaultData () ;
function renderJobsTable (data) {
	let row = ``;
	if(data.length < 1){
		row = noDataRowDFlex(4 , '--');
		$("#job_pos_tbody").html(row);
		return ;
	}

	_.forEach(data , (valls,inx)=>{
		row+= `
		<tr  class="d-flex">
                    <th class="col-1" scope="row">${(inx+   1)}</th>
                    <td class="col-9">
						${valls.title} &nbsp;&nbsp;
						<u>Description:</u> &nbsp;&nbsp;&nbsp;&nbsp;
						${valls.description}
                    </td>

                    <td  class="col-2">
                        <div class="dropdown-inverse dropdown open">
                            <button class="btn btn-mini btn-default dropdown-toggle waves-effect waves-light " type="button" id="dropdown-7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action</button>
                            <div class="dropdown-menu" aria-labelledby="dropdown-7" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                                <a class="dropdown-item waves-light waves-effect" onclick="editJobRow('${valls.id}','${valls.title}','${valls.description}');" href="javascript:void(0);">Edit</a>
                                <a class="dropdown-item waves-light waves-effect" onclick="deleteJobRow('${valls.id}');" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
		`;
	});

	$("#job_pos_tbody").html(row);

}
const modalNewJobPosition = $(".iziModal");
const modalEditJobPosition = $(".iziModalEdit");


modalEditJobPosition.iziModal({
	width: 700,
	radius: 5,
	padding: 20
});

modalNewJobPosition.iziModal({
	width: 700,
	radius: 5,
	padding: 20
});


modalEditJobPosition.iziModal('setHeaderColor', MODAL_HEADER_COLOR);
modalNewJobPosition.iziModal('setHeaderColor', MODAL_HEADER_COLOR);

function openDialog () {

	modalNewJobPosition.iziModal('open');
	//
}
function deleteJobRow (id) {
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
				$('body').loading({
					message: 'Deleting...'
				});
				let data_ = new FormData();
				data_.append('delete' ,id);
				axios({url:'/backend/jobposition' , method:'post' , data:data_}).then(res=>{
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
function editJobRow (id ,  title , description) {
	$("#updateJobID").text(id);
	modalEditJobPosition.iziModal('open');
	$("#updateJobTitle").val(title);
	$("#updateJobDescription").val(description);
}
function saveUpdateJobPosition () {
	let updateJobID = $("#updateJobID").text();
	let newJobTitle = $("#updateJobTitle").val().trim();
	let newJobDescription = $("#updateJobDescription").val().trim();
	if(newJobTitle === ''){
		error_input_element(true , 'updateJobTitle');
		showErrorMessage("Title Required" , 4);
		return;
	}
	error_input_element(false , 'updateJobTitle');
	let data_ = new FormData();
	data_.append('updateJobID' ,updateJobID );
	data_.append('updateJobTitle' ,newJobTitle );
	data_.append('updateJobDescription' ,newJobDescription );
	modalEditJobPosition.iziModal('startLoading');
	axios({
		url:'/backend/jobposition' , method:'post' , data:data_
	}).then(res=>{
		//console.log (res)
		modalEditJobPosition.iziModal('stopLoading');
		if(res.statusText === 'OK'){
			if(res.data.status === 'ok'){
				showSuccessMessage('Updated Job Details');
				modalEditJobPosition.iziModal('close');
				getDefaultData ();
			}else{
				showErrorMessage("Failed to save" , 4);
			}
		}
	}).catch(err =>{
		modalEditJobPosition.iziModal('stopLoading');
	});
}
function saveNewJobPosition () {
	let newJobTitle = $("#newJobTitle").val().trim();
	let newJobDescription = $("#newJobDescription").val().trim();
	if(newJobTitle === ''){
		error_input_element(true , 'newJobTitle');
		showErrorMessage("Title Required" , 4);
		return;
	}
	error_input_element(false , 'newJobTitle');
	let data_ = new FormData();
	data_.append('newJobTitle' ,newJobTitle );
	data_.append('newJobDescription' ,newJobDescription );
	modalNewJobPosition.iziModal('startLoading');

	axios({
		url:'/backend/jobposition' , method:'post' , data:data_
	}).then(res=>{
		//console.log (res)
		modalNewJobPosition.iziModal('stopLoading');
		if(res.statusText === 'OK'){
			if(res.data.status === 'ok'){
				showSuccessMessage('Saved New Job Position');
				modalNewJobPosition.iziModal('close');
				getDefaultData ();
			}else{
				showErrorMessage("Failed to save" , 4);
			}
		}
	}).catch(err =>{
		modalNewJobPosition.iziModal('stopLoading');
	});


}
