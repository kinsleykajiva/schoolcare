let checkCounter = 0;
const modalReceiveChildPaymentDialogDialog = $("#receiveChildPaymentDialog");
modalReceiveChildPaymentDialogDialog.iziModal ({
	width: 700,
	radius: 5,
	padding: 20
});

modalReceiveChildPaymentDialogDialog.iziModal ('setHeaderColor', MODAL_HEADER_COLOR);
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
		$("#btnPostSlected").slideDown('slow');
		checkCounter = POSTED_CHILDREN_READ_ROWS.length;
	}
	else {
		$('.fee_table_check').each(function() {
			this.checked = false;
		});
		checkCounter = 0;
		$("#btnPostSlected").slideUp('slow');
	}
	
});

function onSavePaymentDialog (id , childName , year) {
	$("#child_payment_yeared").text(id);
	$("#payment_details").text(childName + ' for year ' + year );
	modalReceiveChildPaymentDialogDialog.iziModal ('open');
}
function onchangeYearOnPostTable () {
	
	let select = $("#table_select_year").val();
	let year = FINANCIAL_YEARS_READ_ROWS.filter(x=>x.id == select)[0].year;

	getPosttableData(year)
	
}
function renderYearSelects () {
	
	let opt =`<option value="00">Select</option>`;
	_.forEach(FINANCIAL_YEARS_READ_ROWS,(valls,ix)=>{
		let selected = valls.year == thisYear ? 'selected="selected"' : '';
		
			opt += `<option ${selected} value="${valls.id}">${valls.year}</option>`;
		
	});
	
	$("#table_select_year").html(opt).selectpicker('render').selectpicker('refresh');
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
