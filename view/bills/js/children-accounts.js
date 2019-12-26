let checkCounter = 0;
const modalReceiveChildPaymentDialogDialog = $("#receiveChildPaymentDialog");
modalReceiveChildPaymentDialogDialog.iziModal ({
	width: 700,
	radius: 5,
	padding: 20
});

modalReceiveChildPaymentDialogDialog.iziModal ('setHeaderColor', MODAL_HEADER_COLOR);

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

function postChildrenDialog () {
	
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
		title: 'Hey',
		message: 'How old are you?',
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
			['<select><option value="Select">Select</option><option value="10 ~ 20">10 ~ 20</option><option value="21 ~ 30">21 ~ 30</option><option value="31 ~ 40">31 ~ 40</option><option value="40+">40+</option></select>', 'change', function (instance, toast, select, e) {
				console.info(select.options[select.selectedIndex].value);
				// console.info(select);
			}]
		],
		buttons: [
			['<button><b>Confirm</b></button>', function (instance, toast, button, e, inputs) {
				
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
			/*['<button>NO</button>', function (instance, toast, button, e) {

				console.info(button);
				console.info(e);

				// instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

			}]*/
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
