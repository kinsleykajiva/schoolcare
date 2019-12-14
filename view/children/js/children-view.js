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

$(":input[data-inputmask-mask]").inputmask();
$(":input[data-inputmask-alias]").inputmask();

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
		if(res.statusText === 'OK'){
			const j = res.data;
			renderChildrenTable(j.children);
		}
		setTimeout (function () {
			onDivLoadRemove(card);
		}, 2000);
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
				<td>${valls.sex}</td>
				<td>${valls.date_of_birth}</td>
				<td>
				<div class="dropdown-default dropdown open">
				<button class="btn btn-default btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Info</button>
				<div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
				
				<a class="dropdown-item waves-light waves-effect" onclick="showInfoDialog('${valls.id}')" href="javascript:void(0)">Info</a>
				
				<a class="dropdown-item waves-light waves-effect" onclick="showEditDialog('${valls.id}')" href="javascript:void(0)">Edit</a>
				</div>
				</div>
				</td>
			</tr>
		
		`;
	});
	$("#tbody_childrenview").html(row);
}
$(()=>getDefaultData());


function onSaveChildEditDetails () {

}
function onSaveParentEditDetails () {
	util.renderParentEdit()
}

function showEditDialog (id) {
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
	
	console.log (data)
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
