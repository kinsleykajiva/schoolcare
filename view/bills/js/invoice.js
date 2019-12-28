$ (document).ready (function () {
	let i = 1;
	$ ("#add_row").click (function () {
		let b = i - 1;
		$ ('#addr' + i).html ($ ('#addr' + b).html ()).find ('td:first-child').html (i + 1);
		$ ('#tab_logic').append ('<tr id="addr' + (i + 1) + '"></tr>');
		i++;
	});
	$ ("#delete_row").click (() => {
		if (i > 1) {
			$ ("#addr" + (i - 1)).html ('');
			i--;
		}
		calc ();
	});
	
	$ ('#tab_logic tbody').on ('keyup change', function () {
		calc ();
	});
	$ ('#tax').on ('keyup change', function () {
		calc_total ();
	});
	
	
});
let ITEMS_CART_ARR = [];
let ITEMS_CART_TAX_OBJ = {};
let getRandom = receiptNumber ();

function calc () {
	ITEMS_CART_ARR = [];
	$ ('#tab_logic tbody tr').each (function (i, element) {
		let html = $ (this).html ();
		if (html != '') {
			let product = $ (this).find ('.product').val ();
			let qty = $ (this).find ('.qty').val ();
			let price = $ (this).find ('.price').val ();
			ITEMS_CART_ARR.push ({
				product: product,
				qty: qty,
				price: accounting.formatMoney(price),
				price_: price,
				total: accounting.formatMoney(qty * price),
				total_: (qty * price)
			});
			$ (this).find ('.total').val (qty * price);
			
			calc_total ();
		}
	});
}

function calc_total () {
	let total = 0;
	$ ('.total').each (function () {
		total += parseInt ($ (this).val ());
	});
	$ ('#sub_total').val (total.toFixed (2));
	let tax_sum = total / 100 * $ ('#tax').val ();
	$ ('#tax_amount').val (tax_sum.toFixed (2));
	$ ('#total_amount').val ((tax_sum + total).toFixed (2));
	ITEMS_CART_TAX_OBJ = {
		subtotal: accounting.formatMoney( total.toFixed (2)),
		subtotal_: total.toFixed (2),
		tax_sum: accounting.formatMoney(tax_sum.toFixed (2)),
		tax_sum_: tax_sum.toFixed (2),
		tax_perc: $ ('#tax').val (),
		total_amount: accounting.formatMoney((tax_sum + total).toFixed (2)),
		total_amount_: (tax_sum + total).toFixed (2)
	};
}

const url = window.location.href;     // Returns full URL (https://example.com/path/example.html)
let fullPath = removeEverythingAfterLastOccurrenceOfCharacter (url, "/");

function onSaveInvoice () {
	if (ITEMS_CART_ARR.length === 0) {
		showErrorMessage ('Please add details in the table', 4);
		return;
	}
	const dataArr = {
		cart: ITEMS_CART_ARR,
		tax: ITEMS_CART_TAX_OBJ
	}
	let toName = $ ('#toName').val ();
	if (toName === '') {
		showErrorMessage ('To name is Required', 4);
		error_input_element (true, 'toName');
		return;
	}
	error_input_element (false, 'toName');
	let toDueDate = $ ('#toDueDate').val ();
	if (toDueDate === '') {
		showErrorMessage ('Due Date is Required', 4);
		error_input_element (true, 'toDueDate');
		return;
	}
	error_input_element (false, 'toDueDate');
	let toPhone = $ ('#toPhone').val ();
	if (toPhone === '') {
		showErrorMessage ('Phone is Required', 4);
		error_input_element (true, 'toPhone');
		return;
	}
	error_input_element (false, 'toPhone');
	let toEmail = $ ('#toEmail').val ();
	if (toEmail === '') {
		showErrorMessage ('Email is Required', 4);
		error_input_element (true, 'toEmail');
		return;
	}
	error_input_element (false, 'toEmail');
	let toAddress = $ ('#toAddress').val ();
	$ ('body').loading ({
		message: 'Generating...'
	});
	let dataa = new FormData ();
	dataa.append ('dataArr', JSON.stringify (dataArr));
	dataa.append ('toAddress', toAddress);
	dataa.append ('toEmail', toEmail);
	dataa.append ('id_gen', getRandom);
	dataa.append ('toPhone', toPhone);
	dataa.append ('toDueDate', toDueDate);
	dataa.append ('toName', toName);
	axios ({url: '/backend/invoice', method: 'post', data: dataa}).then (res => {
		$ ('body').loading ('stop');
		if (res.statusText === 'OK') {
			
			if (res.data.result === 'ok') {
				let path = res.data.path;
				path = path.replace ('../../../', '');
				
				showSuccessMessage ('Creating File', 4);
				let win = window.open (fullPath + path, '_blank');
				if (win) {
					//Browser has allowed it to be opened
					win.focus ();
					getRandom = receiptNumber();
				} else {
					//Browser has blocked it
					alert ('Please allow popups for this website');
				}
			} else {
				showErrorMessage ('Failed Download File', 4);
			}
		} else {
			showErrorMessage ('Failed to generate Invoice File', 4);
		}
	}).catch (err => {
		$ ('body').loading ('stop');
		showErrorMessage ('Failed to connect', 4);
	});
	
	
	//console.log(dataArr);
}