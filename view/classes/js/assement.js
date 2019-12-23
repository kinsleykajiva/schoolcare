let CHILDREN_READ_ROWS = [];
let ASSES_MARKERS_READ_ROWS = [];
let MILE_STONE_CATEGORY_READ_ROWS = [];
let ASSESEMENT_READ_ROWS = [];
const modalassesChildDilaog = $ ("#assesChildDilaog");
let ASSETSMENT_SELECTS = '';

modalassesChildDilaog.iziModal ({
	width: 900,
	zindex: 9999,
	radius: 5,
	padding: 20
});

modalassesChildDilaog.iziModal ('setHeaderColor', MODAL_HEADER_COLOR);
function getDefault () {
	axios.get ('/view/assessment', {params: {get_deff: 38}}).then (res => {
		if (res.statusText === 'OK') {
			const j = res.data;
			ASSESEMENT_READ_ROWS = j.assesment;
			MILE_STONE_CATEGORY_READ_ROWS = j.m_cates;
			renderTableHeading (j.m_cates);
			CHILDREN_READ_ROWS = (j.children);
			ASSES_MARKERS_READ_ROWS = (j.markers);
			renderMarkersDefinations();
			renderAsseentTable (j.m_cates);
			renderAssessDialog();
		} else {
			showErrorMessage ('Failed to get data , reload page', 4)
		}
	}).catch (err => {
		showErrorMessage ('Failed to connect please check your connection', 4)
	});
}
function renderAssessDialog () {
	
	let row = ``;
	_.forEach(MILE_STONE_CATEGORY_READ_ROWS,(valls,inx)=>{
		row += `
					<div class="col-lg-12">
						<label style="margin-top: 15px;" class="" >${valls.title}</label>
						<br>
						<select class=" form-control ">${ASSETSMENT_SELECTS}</select>
					</div>
					<br>
		`;
	});
	$("#assement_div").html(row);
}
function  renderMarkersDefinations() {
	let txt = ``;
	ASSETSMENT_SELECTS +=`<option value="null">  </option>`;
	_.forEach(ASSES_MARKERS_READ_ROWS,(valls,inx)=>{
		ASSETSMENT_SELECTS +=`<option value="${valls.id}"> ${valls.title} </option>`;
		txt += `<div class="col" >  <strong>${simpleAcronymExpression(valls.title)}</strong> <code>${(valls.title)}</code> </div>`;
	});
	$('#text_definations').html(txt);
	
}
function renderTableHeading (data) {
	let col = 'col-1';
	if (data.length % 2 !== 0) {
		col = 'col'
	}
	let row = ` <tr class="d-flex" >`;
	row += `<th class="col-2">Name</th>`;
	_.forEach (data, (valls, inx) => {
		row += `
		
		<th class="${col}" >
		<a href="#!" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="${(valls.title)}">${simpleAcronymExpression (valls.title)}</a>
		
				</th>
		
		`;
	});
	
	row += `<tr>`;
	
	$ ("#thead_data").html (row);
	$ ('[data-toggle="tooltip"]').tooltip ();
	
}



function renderAsseentTable () {
	//console.log (ASSESEMENT_READ_ROWS);
	//const childDataGroup = groupBy(ASSESEMENT_READ_ROWS,(x=>[x.id_child]));
	let row = ``;
	_.forEach (CHILDREN_READ_ROWS, (valls, inx) => {
		
		const childID = valls.id;
		
		row += `
				
				<tr class="d-flex">
					<th scope="row" class="col-2">
							<a onclick="openAssessChildDialog('${valls.id}' , '${valls.name}' ,  '${valls.surname}');" href="javascript:voie(0);">${capitaliseTextFristLetter (valls.name)} ${capitaliseTextFristLetter (valls.surname)}</a>
					</th>
				`;
		
		//let cellsArr = (childDataGroup[childID]);
		//console.log (cellsArr);
		for (let i = 0; i < (MILE_STONE_CATEGORY_READ_ROWS.length); i++) {
			let col_id = MILE_STONE_CATEGORY_READ_ROWS[i].id;
			row += `<td class="col-1 center-block text-center"  id="cell_${childID}_${col_id}">  </td>`;
		}
		
		
		row += `
			
			</tr>	`;
		
	});
	
	$ ("#tbidy_assessment").html (row);
	
	for (let i = 0; i < (CHILDREN_READ_ROWS.length); i++) {
		const childID = CHILDREN_READ_ROWS[i].id;
		let assArr = ASSESEMENT_READ_ROWS.filter (x => x.id_child == childID);
		//console.log (assArr)
		if (assArr) {
			for (let k = 0; k < assArr.length; k++) {
				let id_milestone_category= assArr[k].id_milestone_category;
				let selectorr = $ ("#" + `cell_${childID}_${id_milestone_category}`);
				if (selectorr.length) {
					let evalMarker = assArr[k].camtitle;
					selectorr.html( `<label class="label label-info ">${simpleAcronymExpression(evalMarker)}</label>`);
				}
			}
		}
	}
	
}
function openAssessChildDialog(id , name ,surname){
	modalassesChildDilaog.iziModal ('setTitle', 'Child Assessment  Dialog for ' + name + ' ' + surname  );
	modalassesChildDilaog.iziModal ('open');
	
}

$ (() => {
	getDefault ();
});