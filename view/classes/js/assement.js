let CHILDREN_READ_ROWS = [];
let ASSES_MARKERS_READ_ROWS = [];
let MILE_STONE_CATEGORY_READ_ROWS = [];
let ASSESEMENT_READ_ROWS = [];

function getDefault () {
	axios.get('/view/assessment' , {params:{get_deff:38}}).then(res=>{
		if(res.statusText === 'OK'){
			const j = res.data;
			ASSESEMENT_READ_ROWS = j.assesment;
			MILE_STONE_CATEGORY_READ_ROWS = j.m_cates;
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
	const childDataGroup = groupBy(ASSESEMENT_READ_ROWS,(x=>[x.id_child]));
	let row = ``;
	_.forEach(CHILDREN_READ_ROWS,(valls,inx)=>{
		
		const childID=valls.id;
		
				row += `
				
				<tr class="d-flex">
					<th scope="row" class="col-2">${capitaliseTextFristLetter(valls.name)} ${capitaliseTextFristLetter(valls.surname)}</th>
				`;
		
		let cellsArr = (childDataGroup[childID]);
		console.log (cellsArr)
		if(cellsArr) {
			
			_.forEach (cellsArr, (ell, iel) => {
				
				for (let i = 1; i < MILE_STONE_CATEGORY_READ_ROWS.length ; i++) {
					console.log (i,parseInt(ell.id_milestone_category));
					if(i === parseInt(ell.id_milestone_category)){
						console.log ('yes');
						row += `<td class="col-1"> ${simpleAcronymExpression(ell.camtitle)} </td>`;
						
						i = 100;// used to break out the loop
					}else{
						//console.log ('no')
						if(i < MILE_STONE_CATEGORY_READ_ROWS.length ){
							row += `<td class="col-1"> 00++ </td>`;
						}
						
					}
				}
				
				//row += `<td class="col-1"> ${simpleAcronymExpression(ell.camtitle)} </td>`;
			});
			// lets create the difference remaining
			for (let i = 0; i < MILE_STONE_CATEGORY_READ_ROWS.length - cellsArr.length; i++) {
				row += `<td class="col-1"> 00-- </td>`;
			}
		}else{
			for (let i = 0; i < MILE_STONE_CATEGORY_READ_ROWS.length ; i++) {
				row += `<td class="col-1"> 00 </td>`;
			}
		}
		
		row += `</tr>	`;
		
	});
	
	$("#tbidy_assessment").html(row);
}


$(()=>{
	getDefault();
});