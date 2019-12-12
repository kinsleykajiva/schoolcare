
$('.reload-card-remake').click(()=>{
	
	getDefaultData ();
});


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


function showEditDialog (id) {
	iziToast.question({
		timeout: 20000,
		close: false,
		overlay: true,
		displayMode: 'once',
		id: 'question',
		zindex: 999,
		title: 'Confirm',
		message: 'Are you sure about Editing?',
		position: 'center',
		buttons: [
			['<button><b>YES</b></button>', function (instance, toast) {
				
				instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
				
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

function showInfoDialog (id) {

}
