
const modalselectLessonDialog = $("#selectLessonDialog");
modalselectLessonDialog.iziModal ({
	width: 700,
	radius: 5,
	padding: 20
});

modalselectLessonDialog.iziModal ('setHeaderColor', MODAL_HEADER_COLOR);
function onAddLessonOn (day) {
	openSelectLessonDialog();
	switch (day) {
		
		
		case 'mon':
			
			break;
			
		case 'tue':
			break;
			
		case 'wed':
			break;
			
		case 'thu':
			break;
			
		case 'fri':
			break;
			
			
	}
}
function openSelectLessonDialog () {
	modalselectLessonDialog.iziModal ('open');
}

function getDefault () {

}

$(()=>{getDefault();});



