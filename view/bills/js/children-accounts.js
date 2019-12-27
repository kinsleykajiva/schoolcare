let checkCounter = 0;
const modalReceiveChildPaymentDialogDialog = $("#receiveChildPaymentDialog");
const modalAddFeePackageToFeesDialogDialog = $("#addFeePackageToFeesDialog");
modalAddFeePackageToFeesDialogDialog.iziModal ({
	width: 700,
	radius: 5,
	padding: 20
});

modalReceiveChildPaymentDialogDialog.iziModal ({
	width: 700,
	radius: 5,
	padding: 20
});



modalAddFeePackageToFeesDialogDialog.iziModal ('setHeaderColor', MODAL_HEADER_COLOR);
modalReceiveChildPaymentDialogDialog.iziModal ('setHeaderColor', MODAL_HEADER_COLOR);

function openAddChildToFeesDialog () {
	modalAddFeePackageToFeesDialogDialog.iziModal ('open');
}



let FEES_CHILD_POSTED_SELECTS_DATA = {} ;
function onchangefeePaymentPackages () {
	let select = $("#feePaymentPackages").val() ;
	FEES_CHILD_POSTED_SELECTS_DATA = {} ;
	let obj = FEES_PACKAGES_READ_ROWS.filter(x=>x.id == select )[0];
	const ids_str =obj.fee_items_ids;
	let cost = sumUp(ids_str);
	$("#packageCostSelected").text( accounting.formatMoney( cost));
	let arr = ids_str.split(',');
	let ret = ``;
	let objData = [];
	_.forEach(arr,(valz,ix)=>{
		let objj = FEES_ITEMS_READ_ROWS.filter(x=>x.id == valz)[0];
		objData.push({
			feeID:objj.id,
			feeTitle:objj.title,
			feeItemCost:objj.cost
		});
		ret += `<li>
  					<i class="icofont icofont-stylish-right text-danger"></i> ${objj.title}  ${accounting.formatMoney(objj.cost)}
                </li>`;
	});
	FEES_CHILD_POSTED_SELECTS_DATA = {
		id_package:select ,
		pack_obj:obj,
		totalCost:cost,
		fees:objData
	};
	$("#list_fee_items_for_packag").html(ret);
	
}







function getPosttableData (year) {
	$('body').loading({
		message: 'Loading...'
	});
	axios.get ('/view/fees', {
		params: {
			get_def: year
		}
	}).then (res => {
		if (res.statusText === 'OK') {
			const j = res.data;
			FINANCIAL_YEARS_READ_ROWS = j.years;
			POSTED_CHILDREN_READ_ROWS = j.postedChildren;
			FEES_ITEMS_READ_ROWS = j.fee_items;
			FEES_PACKAGES_READ_ROWS = j.fees_packages;
			renderPostChildrenTable();
			
		}
	}).catch (err => {
		$('body').loading('stop');
		showErrorMessage ('Failed to connect', 4);
	})
}

$('#children_select_all').click(function(event) {
	if(this.checked) {
		// Iterate each checkbox
		$('.fee_table_check').each(function() {
			this.checked = true;
		});
		$("#btnPostSlected,#btnAddFeesTolected").slideDown('slow');
		checkCounter = POSTED_CHILDREN_READ_ROWS.length;
	}
	else {
		$('.fee_table_check').each(function() {
			this.checked = false;
		});
		checkCounter = 0;
		$("#btnPostSlected,#btnAddFeesTolected").slideUp('slow');
	}
	
});

function onSavePaymentDialog (id , childName , year) {
	$("#child_payment_yeared").text(id);
	$("#payment_details").text(childName + ' for year ' + year );
	modalReceiveChildPaymentDialogDialog.iziModal ('open');
}
function onchangeYearOnPostTable () {
	
	let select = $("#table_select_year_11").val();
	let year = FINANCIAL_YEARS_READ_ROWS.filter(x=>x.id == select)[0].year;

	getPosttableData(year)
	
}
function renderYearSelects () {
	
	let opt =`<option value="00">Select Year</option>`;
	_.forEach(FINANCIAL_YEARS_READ_ROWS,(valls,ix)=>{
		let selected = valls.year == thisYear ? 'selected="selected"' : '';
		
			opt += `<option ${selected} value="${valls.id}"> year ${valls.year}</option>`;
		
	});
	
	$("#table_select_year_11").html(opt);
	//$("#table_select_year_11").selectpicker('render');
	//$("#table_select_year_11").selectpicker('refresh');
}
function postChildrenDialog () {
	const nextYear = new Date().getFullYear() +1;     // Get the four digit year (yyyy);
	let opt =`<option value="null">Select</option>`;
	_.forEach(FINANCIAL_YEARS_READ_ROWS,(valls,ix)=>{
		let selected = valls.year == nextYear ? 'selected="selected"' : '';
		if(parseInt(valls.year) >= nextYear) {
			opt += `<option ${selected} value="${valls.id}">${valls.year}</option>`;
		}
	});
	iziToast.question({
		rtl: false,
		layout: 1,
		drag: false,
		timeout: false,
		close: false,
		overlay: true,
		displayMode: 1,
		id: 'question',
		progressBar: true,
		title: 'Confirmation',
		message: 'Post all selected to which new Financial Year ?',
		position: 'center',
		inputs: [
			/*['<input type="text">', 'keyup', function (instance, toast, input, e) {
				console.info(e);
				console.info(input);
			}, true],
			['<input type="number">', 'keydown', function (instance, toast, input, e) {
				console.info(e);
				console.info(input);
			}],*/
			[
				`<select>
					${opt}
				</select>`,
				'change', function (instance, toast, select, e) {
				console.info(select.options[select.selectedIndex].value);
				// console.info(select);
			}]
		],
		buttons: [
			['<button><b>Yes Post</b></button>', function (instance, toast, button, e, inputs) {
				
				console.info(button);
				console.info(e);
				
				alert(inputs[0].options[inputs[0].selectedIndex].value)
				
				instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
				
				/* iziToast.success({
					 id: 'success',
					 zindex: 9999,
					 timeout: 2000,
					 title: 'Success',
					 overlay: true,
					 message: 'Thank you',
					 position: 'center'
				 });*/
				
			}, false], // true to focus
			['<button>Cancel</button>', function (instance, toast, button, e) {

				//console.info(button);
			//	console.info(e);

				 instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

			}]
		],
		onClosing: function(instance, toast, closedBy){
			// console.info('Closing | closedBy: ' + closedBy);
		},
		onClosed: function(instance, toast, closedBy){
			// console.info('Closed | closedBy: ' + closedBy);
		}
	});
	
	
	
}
function saveChildrenFeePackages () {
	let feePaymentPackages = $("#feePaymentPackages").val();
	if(feePaymentPackages === 'null'){
		showErrorMessage('Please select a package ' , 4);
		error_input_element(true , 'feePaymentPackages');
		return;
	}
	error_input_element(false , 'feePaymentPackages');
	
	let post_id_children = getCheckedInputsGetValues('fee_table_check');
	FEES_CHILD_POSTED_SELECTS_DATA['post_id_children'] = post_id_children;
	//console.log (FEES_CHILD_POSTED_SELECTS_DATA);
	let dataa = new FormData();
	dataa.append('newChildFeePackge' , JSON.stringify(FEES_CHILD_POSTED_SELECTS_DATA));
	modalAddFeePackageToFeesDialogDialog.iziModal ('startLoading');
	axios({url:'/backend/fees',method:'post',data:dataa}).then(res=>{
		modalAddFeePackageToFeesDialogDialog.iziModal ('stopLoading');
		if(res.statusText === 'OK' && res.data.status === 'ok'){
			modalAddFeePackageToFeesDialogDialog.iziModal ('close');
			showSuccessMessage('Fee Structure added to selected Kids');
			getDefaultData ();
		}else{
			showErrorMessage('Failed to Save' ,4);
		}
	}).catch(err=>{
		showErrorMessage('Failed to connect Please check Your Connection' , 3);
		modalAddFeePackageToFeesDialogDialog.iziModal ('stopLoading');
	});
}

function saveChildPayment () {
	let amountPayment = $("#amountPayment").val();
	let typePayment = $("#typePayment").val();
	let refPayment = $("#refPayment").val();
	let notesPayment = $("#notesPayment").val();
	let child_payment_yeared = $("#child_payment_yeared").text();
	if(amountPayment === ''){
		showErrorMessage('Amount Required' , 4);
		error_input_element(true , 'amountPayment');
		return;
	}
	error_input_element(false , 'amountPayment');
	
	
	modalReceiveChildPaymentDialogDialog.iziModal ('startLoading');
	let dataa = new FormData();
	dataa.append( 'amountPayment', amountPayment);
	dataa.append( 'typePayment', typePayment);
	dataa.append( 'refPayment', refPayment);
	dataa.append( 'notesPayment', notesPayment);
	dataa.append( 'child_payment_yeared', child_payment_yeared);
	
	axios({url:'/backend/fees',method:'post',data:dataa}).then(res=>{
		modalReceiveChildPaymentDialogDialog.iziModal ('stopLoading');
		if(res.statusText === 'OK' && res.data.status === 'ok'){
			modalReceiveChildPaymentDialogDialog.iziModal ('close');
			showSuccessMessage('Saved Payment' , 4);
			getDefaultData ();
		}else{
			showErrorMessage('Failed to Save' , 4);
		}
	}).catch(err=>{
		modalReceiveChildPaymentDialogDialog.iziModal ('stopLoading');
		showErrorMessage('Failed to connect' , 4);
	});
	
}
