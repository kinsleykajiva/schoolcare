$ ('.duallistbox').bootstrapDualListbox ();
let FEES_ITEMS_READ_ROWS = [] ;
let FEES_PACKAGES_READ_ROWS = [] ;
let POSTED_CHILDREN_READ_ROWS = [] ;
let FINANCIAL_YEARS_READ_ROWS = [] ;
const thisYear = new Date().getFullYear() ;
const modalNewPackageDialogDialog = $("#NewPackageDialog");
const modalEditPackageDialogDialog = $("#EditPackageDialog");
const modalEaddFeeItemDialogDialog = $("#addFeeItemDialog");
const modaleditFeeItemDialogDialog = $("#editFeeItemDialog");


modaleditFeeItemDialogDialog.iziModal ({
	width: 700,
	radius: 5,
	padding: 20
});



modalEaddFeeItemDialogDialog.iziModal ({
	width: 700,
	radius: 5,
	padding: 20
});


modalEditPackageDialogDialog.iziModal ({
	width: 700,
	radius: 5,
	padding: 20
});


modalNewPackageDialogDialog.iziModal ({
	width: 700,
	radius: 5,
	padding: 20
});


modaleditFeeItemDialogDialog.iziModal ('setHeaderColor', MODAL_HEADER_COLOR);
modalEaddFeeItemDialogDialog.iziModal ('setHeaderColor', MODAL_HEADER_COLOR);
modalNewPackageDialogDialog.iziModal ('setHeaderColor', MODAL_HEADER_COLOR);
modalEditPackageDialogDialog.iziModal ('setHeaderColor', MODAL_HEADER_COLOR);

function openFeeItemDialog(){
	modalEaddFeeItemDialogDialog.iziModal ('open');
	
}

function openNewPackageDialog(){
	modalNewPackageDialogDialog.iziModal ('open');
	
	
}

//********************************//
// Multi selection Dual Listbox
//********************************//
let selection = $ ('.duallistbox-multi-selection').bootstrapDualListbox ({
	nonSelectedListLabel: 'Non-selected ',
	selectedListLabel: 'Selected',
	preserveSelectionOnMove: 'moved',
	moveOnSelect: false
});
//********************************//
// for font awesome
//********************************//
$ (function () {
	$ ('.moveall i').removeClass ().addClass ('fa fa-angle-right');
	$ ('.removeall i').removeClass ().addClass ('fa fa-angle-left');
	$ ('.move i').removeClass ().addClass ('fa fa-angle-right');
	$ ('.remove i').removeClass ().addClass ('fa fa-angle-left');
	getDefaultData ();
});

function getDefaultData () {
	axios.get ('/view/fees', {
		params: {
			get_def: thisYear
		}
	}).then (res => {
		if (res.statusText === 'OK') {
			const j = res.data;
			FINANCIAL_YEARS_READ_ROWS = j.years;
			POSTED_CHILDREN_READ_ROWS = j.postedChildren;
			FEES_ITEMS_READ_ROWS = j.fee_items;
			FEES_PACKAGES_READ_ROWS = j.fees_packages;
			renderPackagesTable (j.fees_packages);
			renderPaymentSelects(j.paymentPeriods);
			renderFeesSelects(j.fee_items);
			renderFeesTable();
			renderPostChildrenTable();
			renderYearSelects();
			renderFeePackagesDialogData();
			
		}
	}).catch (err => {
		showErrorMessage ('Failed to connect', 4);
	})
}



function renderPostChildrenTable () {
	
	$('body').loading('stop');
	let row = ``;
	_.forEach(POSTED_CHILDREN_READ_ROWS,(valls,inx)=>{
		let costOfPaid = valls.check_has_fees? ''+ accounting.formatMoney(valls.check_has_fees) + ' of /' : '';
		row += `
		
		<tr>
     <th scope="row">

       <div  class="checkbox-fade fade-in-primary">
        <label>
         <input type="checkbox" class="fee_table_check" value="${valls.id}">
         <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
		 <span class="text-inverse"> ${valls.year} ${valls.check_has_fees? 'FS':'NF'}</span>
        </label>
       </div>

     </th>
     <td>${valls.childname}</td>
     <td> ${costOfPaid}  ${valls.paidamount ? accounting.formatMoney(valls.paidamount) : accounting.formatMoney(0.00)} </td>
     <td>
      <div class="dropdown-default dropdown open">
       <button class="btn btn-default btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Option</button>
       <div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">

        <a class="dropdown-item waves-light waves-effect" onclick="onSavePaymentDialog('${valls.id_child}' , '${valls.childname}' , '${valls.year}');" href="javascript:void(0);">Receive Payment</a>
       </div>
      </div>
     </td>
    </tr>
		
		
		`;
	});
	$("#tbody_children_posted").html(row);
	$('.fee_table_check').click(function(event) {
		
		if(this.checked) {
			checkCounter++;
			$("#btnPostSlected,#btnAddFeesTolected").slideDown('slow');
		}
		else {
			checkCounter--;
			if(checkCounter === 0){
				$("#btnPostSlected,#btnAddFeesTolected").slideUp('slow');
			}
			
		}
	});
}


function renderFeesTable () {
	let row =``;
	_.forEach(FEES_ITEMS_READ_ROWS,(valls,inx)=>{
		row +=`
		<tr>
				<td>${valls.title}</td>
				<td> ${accounting.formatMoney(valls.cost)}</td>
				<td>
				<div class="dropdown-default dropdown open">
				<button class="btn btn-default btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Option</button>
				<div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
				
					<a class="dropdown-item waves-light waves-effect" onclick="openEditFeeIyemDialog('${valls.id}');" href="javascript:void(0);">Edit</a>
				</div>
				</div>
				</td>
		</tr>`;
	});
	$("#tbody_fee_items").html(row);
}

function openEditFeeIyemDialog (id) {
	$("#editSelect_feeietm").text(id);
	modaleditFeeItemDialogDialog.iziModal ('open');
	let obj = FEES_ITEMS_READ_ROWS.filter(x=>x.id == id)[0];
	$("#editFeeTitle").val(obj.title);
	$("#editFeeAmount").val(obj.cost);
	
}
function renderPaymentSelects (data) {
		let opt = ` <option value="null">  Select </option>`;
		
		_.forEach(data,(valls,inx)=>{
			opt += `
				 <option value="${valls.id}">${valls.title}  </option>
			`;
		});
		$("#feePaymentPeriodSelects,#editfeePaymentPeriodSelects").html(opt)
}

function renderFeesSelects (data) {
		let opt = ``;
		
		_.forEach(data,(valls,inx)=>{
			opt += `
				 <option value="${valls.id}">${valls.title} ( ${accounting.formatMoney(valls.cost)}) </option>
			`;
		});
		$("#feeItemSelects").html(opt);
	selection.bootstrapDualListbox('refresh', true);
}

function saveEditPackage () {
	let newPackageTitle = $("#editPackageTitle").val();
	let feeItemSelects= $("#editfeeItemSelects").val();
	let feePaymentPeriodSelects= $("#editfeePaymentPeriodSelects").val();
	
	if(newPackageTitle === ''){
		showErrorMessage('Title Required ' ,4);
		error_input_element(true , 'newPackageTitle');
		return;
	}
	error_input_element(false , 'newPackageTitle');
	
	
	if(feePaymentPeriodSelects === 'null'){
		showErrorMessage('Payment Period Required ' ,4);
		error_input_element(true , 'feePaymentPeriodSelects');
		return;
	}
	error_input_element(false , 'feePaymentPeriodSelects');
	
	if(feeItemSelects === '' || feeItemSelects.length < 1){
		showErrorMessage('Select at least one Fee Required ' ,4);
		return;
	}
	let dataa = new FormData();
	let rec_id = $("#selected_package_edit").text();
	dataa.append('editPackagerec_id',rec_id);
	dataa.append('editPackageTitle',newPackageTitle);
	dataa.append('editfeeItemSelects',feeItemSelects);
	dataa.append('editfeePaymentPeriodSelects',feePaymentPeriodSelects);
	modalEditPackageDialogDialog.iziModal ('startLoading');
	axios({url:'/backend/fees',method:'post',data:dataa}).then(res=>{
		modalEditPackageDialogDialog.iziModal ('stopLoading');
		if(res.statusText === 'OK' && res.data.status === 'ok'){
			modalEditPackageDialogDialog.iziModal ('open');
			$("#newPackageTitle").val('');
			showSuccessMessage('Saved Package Updates' ,4);
			getDefaultData ()
		}else{
			showErrorMessage('Failed to save , try again' , 3);
		}
	}).catch(err=>{
		modalEditPackageDialogDialog.iziModal ('stopLoading')
		showErrorMessage('Failed to connect' , 4);
	});
}

function savePackage () {
	let newPackageTitle = $("#newPackageTitle").val();
	let feeItemSelects= $("#feeItemSelects").val();
	let feePaymentPeriodSelects= $("#feePaymentPeriodSelects").val();
	
	if(newPackageTitle === ''){
		showErrorMessage('Title Required ' ,4);
		error_input_element(true , 'newPackageTitle');
		return;
	}
	error_input_element(false , 'newPackageTitle');
	
	
	if(feePaymentPeriodSelects === 'null'){
		showErrorMessage('Payment Period Required ' ,4);
		error_input_element(true , 'feePaymentPeriodSelects');
		return;
	}
	error_input_element(false , 'feePaymentPeriodSelects');
	
	if(feeItemSelects === '' || feeItemSelects.length < 1){
		showErrorMessage('Select at least one Fee Required ' ,4);
		return;
	}
	let dataa = new FormData();
	dataa.append('newPackageTitle',newPackageTitle);
	dataa.append('feeItemSelects',feeItemSelects);
	dataa.append('feePaymentPeriodSelects',feePaymentPeriodSelects);
	modalNewPackageDialogDialog.iziModal ('startLoading');
	axios({url:'/backend/fees',method:'post',data:dataa}).then(res=>{
		modalNewPackageDialogDialog.iziModal ('stopLoading');
		if(res.statusText === 'OK' && res.data.status === 'ok'){
			modalNewPackageDialogDialog.iziModal ('open');
			$("#newPackageTitle").val('');
			showSuccessMessage('Saved Package' ,4);
			getDefaultData ()
		}else{
			showErrorMessage('Failed to save , try again' , 3);
		}
	}).catch(err=>{
		modalNewPackageDialogDialog.iziModal ('stopLoading')
		showErrorMessage('Failed to connect' , 4);
	});
	
}
function renderFeePackagesDialogData () {
	let opt=`<option value="null"> </option>`;
	_.forEach(FEES_PACKAGES_READ_ROWS,(valls,inx)=>{
		
		opt+= `<option value="${valls.id}"> ${valls.title} / (${valls.payment_period_title}) </option>`;
	});
	$("#feePaymentPackages").html(opt);
}
function sumUp(str){
	let arr = str.split(',');
	let ret = 0;
	_.forEach(arr,(valz,ix)=>{
		let costt = FEES_ITEMS_READ_ROWS.filter(x=>x.id == valz)[0];
		ret += parseFloat(costt.cost);
	});
	return ret.toFixed(2);
}
function renderPackagesTable (data) {
	let row = ``;
	if(data.length === 0){
		$("#tbody_packages").html(noDataRow(3,'--'));
		return;
	}
	_.forEach (data, (valls, inx) => {
		let costOf = accounting.formatMoney(sumUp(valls.fee_items_ids)) ;
		
		row += `
					<tr>

					<td>${valls.title} / (${valls.payment_period_title})</td>
					<td> ${costOf}</td>
							<td>
							<div class="dropdown-default dropdown open">
							<button class="btn btn-default btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Option</button>
							<div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
							<a class="dropdown-item waves-light waves-effect" onclick="openInfoView('${valls.id}')" href="javascript:void(0);">Info</a>
							<a class="dropdown-item waves-light waves-effect" onclick="openEditView('${valls.id}')"  href="#">Edit</a>
							</div>
							</div>
							</td>
					</tr>

			
			`;
	});
	
	$("#tbody_packages").html(row);
}

function openEditView (id) {
	$("#selected_package_edit").text(id);
	modalEditPackageDialogDialog.iziModal ('open');
	let opt= ``;
	let arr  = FEES_PACKAGES_READ_ROWS.filter(x=>x.id == id)[0];
	let arrSele  = arr.fee_items_ids.split(',');
	$("#editPackageTitle").val(arr.title);
	$("#editfeePaymentPeriodSelects").val(arr.id_payment_periods);
	
	_.forEach(FEES_ITEMS_READ_ROWS,(valls,inx)=>{
		if(arrSele .includes(valls.id ) ){
			opt += ` <option selected="selected" value="${valls.id}">${valls.title} ( ${accounting.formatMoney(valls.cost)}) </option>`;
		}else{
			opt += ` <option value="${valls.id}">${valls.title} (${accounting.formatMoney(valls.cost)}) </option>`;
		}
		
		
	});
	$("#editfeeItemSelects").html(opt);
	selection.bootstrapDualListbox('refresh', true);
}

function openInfoView (id) {
	// modalEditPackageDialogDialog.iziModal ('open');
	let arr  = FEES_PACKAGES_READ_ROWS.filter(x=>x.id == id)[0];
	let arrSele  = arr.fee_items_ids.split(',');
	let htmlData= `<h4> Package Title : ${arr.title}</h4> <br>`;
	_.forEach(FEES_ITEMS_READ_ROWS,(valls,inx)=>{
		if(arrSele .includes(valls.id ) ){
			htmlData += ` Fee  <label >${valls.title} @ ( ${accounting.formatMoney(valls.cost)}) </label> <br>`;
		}
		
		
	});
	htmlData = `<div class="" style="padding-left: 50px;">	` + htmlData;
	htmlData = htmlData +  `</div>`;
	globalInfoDialog(htmlData , '');
	
	
}



function saveEditFeeItem () {
		let newFeeTitle = $("#editFeeTitle").val();
		let newFeeAmount = $("#editFeeAmount").val();

		
		if(newFeeTitle === ''){
			showErrorMessage('Fee Title is required' , 4);
			error_input_element(true , 'newFeeTitle');
			return;
		}
	error_input_element(false , 'newFeeTitle');
		
		if(newFeeAmount === ''){
			showErrorMessage('Fee Cost is required' , 4);
			error_input_element(true , 'newFeeAmount');
			return;
		}
	error_input_element(false , 'newFeeAmount');
	modaleditFeeItemDialogDialog.iziModal ('startLoading');
		let dataa = new FormData();
		let child_id = $("#editSelect_feeietm").text();
	dataa.append('editFeeTitle' , newFeeTitle);
	dataa.append('edit_rec_id' , child_id);
	dataa.append('editFeeAmount' , newFeeAmount);
	
		axios({url:'/backend/fees' , method:'post',data:dataa}).then(res=>{
			modaleditFeeItemDialogDialog.iziModal ('stopLoading');
			if(res.statusText === 'OK' && res.data.status === 'ok'){
				$("#editFeeTitle,#editFeeAmount").val('');
				modaleditFeeItemDialogDialog.iziModal ('close');
				showSuccessMessage('Updated Fee',4);
				getDefaultData ();
				
			}else{
				showErrorMessage('Failed to update , try again' , 4);
			}
		}).catch(err=>{
			modaleditFeeItemDialogDialog.iziModal ('stopLoading');
		
			showErrorMessage('Failed to connect ' , 3);
		});
}

function saveNewFeeItem () {
		let newFeeTitle = $("#newFeeTitle").val();
		let newFeeAmount = $("#newFeeAmount").val();

		
		if(newFeeTitle === ''){
			showErrorMessage('Fee Title is required' , 4);
			error_input_element(true , 'newFeeTitle');
			return;
		}
	error_input_element(false , 'newFeeTitle');
		
		if(newFeeAmount === ''){
			showErrorMessage('Fee Cost is required' , 4);
			error_input_element(true , 'newFeeAmount');
			return;
		}
	error_input_element(false , 'newFeeAmount');
		let dataa = new FormData();
	dataa.append('newFeeTitle' , newFeeTitle);
	dataa.append('newFeeAmount' , newFeeAmount);
	modalEaddFeeItemDialogDialog.iziModal ('startLoading');
	
		axios({url:'/backend/fees' , method:'post',data:dataa}).then(res=>{
			modalEaddFeeItemDialogDialog.iziModal ('stopLoading');
			if(res.statusText === 'OK' && res.data.status === 'ok'){
				$("#newFeeTitle,#newFeeAmount").val('');
				modalEaddFeeItemDialogDialog.iziModal ('close');
				showSuccessMessage('Saved Fee',4);
				getDefaultData ();
			}else{
				showErrorMessage('Failed to save , try again' , 4);
			}
		}).catch(err=>{
			modalEaddFeeItemDialogDialog.iziModal ('stopLoading');
			
			showErrorMessage('Failed to connect ' , 3);
		});
}