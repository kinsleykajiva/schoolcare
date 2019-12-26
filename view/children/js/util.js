class Util {
	constructor() {
	
	}
	renderParentEdit(jsonArray){
		let html = '';
		let tabHeads = ``;let tabContent = ``;
		let active = ``;
		_.forEach(jsonArray , (valls,inx)=>{
			active = inx === 0 ? 'active': '';
			tabHeads+= `
		 <li class="nav-item">
		    <a class="nav-link ${active}" data-toggle="tab" href="#edit_tab_${inx}" role="tab" aria-expanded="false">Parent ${inx + 1}</a>
		   </li>`;
			let name = valls.parent.split(' ')[0];
			let surname = valls.parent.split(' ')[1];
			let sex = valls.sex === 'male'? ` <option value="female">Female</option> <option selected="selected"  value="male">Male</option>`
										:`<option  selected="selected" value="female">Female</option> <option  value="male">Male</option>`;
			tabContent+= `
							<div style="margin: 10px 0 0 0;" class="tab-pane ${active}" id="edit_tab_${inx}" role="tabpanel" aria-expanded="false">
						    		<p class="m-0"> <span id="selected_id-${inx}" style="display: none;" >${valls.id_parent}</span>
						    		<div class="card-block">


									  <form onsubmit="return false;">
									   <div class="form-group row">
									    <label class="col-sm-2 col-form-label">Name</label>
									    <div class="col-sm-10">
									     <input type="text" id="parentName-${valls.id_parent}" value="${name}" class="form-control">
									    </div>
									   </div>
									   <div class="form-group row">
									    <label class="col-sm-2 col-form-label">Surname</label>
									    <div class="col-sm-10">
									     <input type="text" id="parentSurname-${valls.id_parent}" value="${surname}" class="form-control">
									    </div>
									   </div>
									   <div class="form-group row">
									    <label class="col-sm-2 col-form-label">ID Number</label>
									    <div class="col-sm-10">
									     <input type="text" value="${valls.id_number}" id="parentIDNumber-${valls.id_parent}" class="form-control">
									    </div>
									   </div>
									
									
									   <div class="form-group row">
									    <label class="col-sm-2 col-form-label">Gender</label>
									    <div class="col-sm-10">
									     <select name="select" id="parentSex-${valls.id_parent}" class="form-control">
									      <option value="null" >Select </option>
									      ${sex}
									     </select>
									    </div>
									   </div>
									   <div class="form-group row">
									    <label class="col-sm-2 col-form-label">Occupation</label>
									    <div class="col-sm-10">
									     <input type="text" id="parentOccupation-${valls.id_parent}" value="${valls.occupation}" class="form-control">
									    </div>
									   </div>
									   <div class="form-group row">
									    <label class="col-sm-2 col-form-label">Phone</label>
									    <div class="col-sm-10">
									     <input type="text" id="parentPhone-${valls.id_parent}" value="${valls.contact}" class="form-control" onpaste="return false;" data-inputmask-mask="(+27)99-999-9999" data-val="true" data-val-required="Required" >
									    </div>
									   </div>
									   <div class="form-group row">
									    <label class="col-sm-2 col-form-label">Email</label>
									    <div class="col-sm-10">
									     <input type="text" id="parentEmail-${valls.id_parent}" value="${valls.email}" class="form-control" data-inputmask-alias="email" data-val="true" data-val-required="Required">
									    </div>
									   </div>
									   <div class="form-group row">
									    <label class="col-sm-2 col-form-label">Home Address</label>
									    <div class="col-sm-10">
									     <input type="text" id="parentHomeAddress-${valls.id_parent}" value="${valls.address}"placeholder="comma separate" class="form-control">
									    </div>
									   </div>
									
									
									   <div class="form-group row" >
									
									    <div class="col-sm-10">
									     <div class="form-control-static">
									      .
									     </div>
									    </div>
									    <div class="col-sm-2 ">
									     <button onclick="onSaveParentEditDetails('${valls.id_parent}')" class="btn btn-info btn-round btn-sm ">Save <i class="fa fa-save"></i></button>
									    </div>
									   </div>
									
									  </form>
									
									
									 </div>
						    		</p>
						   </div>
			`;
		});
		html+= `
		
		
		<div class="row">
		 <div class="col-lg-12 col-xl-12">
		  
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs  tabs" role="tablist" id="edit_tabs_heades">
		  ${tabHeads}
		
		  </ul>
		  <!-- Tab panes -->
		  <div class="tab-content tabs card-block">
		  
			${tabContent}
		
		  </div>
		 </div>
		</div>
		
		
		`;
		
		
		return html;
	}
}