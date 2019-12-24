
$('.duallistbox').bootstrapDualListbox();
//********************************//
// for font awesome
//********************************//
$(function() {
	// fa fa-arrow-left
	// <i class="fas fa-angle-double-left"></i>
	// fa fa-angle-double-left
	/*$('.moveall i').removeClass().addClass('');
	$('.removeall i').removeClass().addClass('fa fa-arrow-left');
	$('.move i').removeClass().addClass('fa fa-arrow-right');
	$('.remove i').removeClass().addClass('fa fa-arrow-left');*/
	
	
	$('.moveall i').removeClass().addClass('fa fa-angle-right');
	$('.removeall i').removeClass().addClass('fa fa-angle-left');
	$('.move i').removeClass().addClass('fa fa-angle-right');
	$('.remove i').removeClass().addClass('fa fa-angle-left');
});

//********************************//
// Multi selection Dual Listbox
//********************************//
$('.duallistbox-multi-selection').bootstrapDualListbox({
	nonSelectedListLabel: 'Non-selected Dual',
	selectedListLabel: 'Selected',
	preserveSelectionOnMove: 'moved',
	moveOnSelect: false
});
function saveNewFeeItem () {

}