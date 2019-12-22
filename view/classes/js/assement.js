let CHILDREN_READ_ROWS = [];
let ASSES_MARKERS_READ_ROWS = [];

function getDefault () {
	axios.get('/view/assessment' , {params:{get_deff:38}}).then(res=>{
		if(res.statusText === 'OK'){
			const j = res.data;
			renderTableHeading(j.m_cates);
			CHILDREN_READ_ROWS = (j.children);
			ASSES_MARKERS_READ_ROWS = (j.markers);
			renderAsseentTable(j.m_cates);
	}else{
			showErrorMessage('Failed to get data , reload page' , 4)
	}
	}).catch(err=>{
		showErrorMessage('Failed to connect please check your connection'  ,4)
	});
}
function renderTableHeading (data) {
	let col  = 'col-1';
	if(data.length % 2 !== 0){
		col = 'col'
	}
	let row = ` <tr class="d-flex" >`;
	 row += `<th class="col-2">Name</th>`;
	_.forEach(data,(valls,inx)=>{
		row += `
		
		<th class="${col}" >
		<a href="#!" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="${(valls.title)}">${simpleAcronymExpression(valls.title)}</a>
		
				</th>
		
		`;
	});
	row += `<tr>`;
	
	$("#thead_data").html(row);
	$('[data-toggle="tooltip"]').tooltip();
	
}

function renderAsseentTable(){
	let row = ``;
	_.forEach(CHILDREN_READ_ROWS,(valls,inx)=>{
		row += `
		
		<tr class="d-flex">
			<th scope="row" class="col-2">${capitaliseTextFristLetter(valls.name)} ${capitaliseTextFristLetter(valls.surname)}</th>
			<td class="col-1">Mark</td>
			<td class="col-1">Mark</td>
			<td class="col-1">Mark</td>
			<td class="col-1">Mark</td>
			<td class="col-1">Mark</td>
			<td class="col-1">Mark</td>
			<td class="col-1">Mark</td>
			<td class="col-1">Mark</td>
			<td class="col-1">Mark</td>
			<td class="col-1">Mark</td>
			
			</tr>

		
		`;
	});
	
	$("#tbidy_assessment").html(row);
}


$(()=>{
	getDefault();
});