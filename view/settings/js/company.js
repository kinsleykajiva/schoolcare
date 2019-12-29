const modalEditCompanyDialogDialog = $ ("#editCompanyDialog");
modalEditCompanyDialogDialog.iziModal ('setHeaderColor', MODAL_HEADER_COLOR);


modalEditCompanyDialogDialog.iziModal ({
	width: 700,
	radius: 5,
	padding: 20
});

let COMPANY_READ_ROWS = [] ;

function getDefaultData () {
	axios.get('view/company',{params:{def_get:39}}).then(res=>{
		if(res.statusText === 'OK'){
			const j = res.data;
			COMPANY_READ_ROWS =j.comp;
			renderDetails();
		}
	}).catch(err=>{
		showErrorMessage('Failed to connect' , 3);
	});
}

$(()=>getDefaultData());
let url = window.location.href;     // Returns full URL (https://example.com/path/example.html)
url = url.replace('#!','');
let fullPath = removeEverythingAfterLastOccurrenceOfCharacter (url, "/");
function renderDetails(){

	$('#companyTitle').text(COMPANY_READ_ROWS.NAME);
	$('#newOrg').val(COMPANY_READ_ROWS.NAME);
	$('#adddress_company').text(COMPANY_READ_ROWS.ADDRESS);
	$('#newAddress').val(COMPANY_READ_ROWS.ADDRESS);
	$('#companyPhone').text(COMPANY_READ_ROWS.CONTACTS);
	$('#newPhone').val(COMPANY_READ_ROWS.CONTACTS);
	$('#companyemail').text(COMPANY_READ_ROWS.EMAIL);
	$('#newEmail').val(COMPANY_READ_ROWS.EMAIL);
	$('#iconPropic').attr('src',fullPath+COMPANY_READ_ROWS.LOGO.replaceAll('../../../',''));
	console.log(fullPath+COMPANY_READ_ROWS.LOGO.replaceAll('../../../',''));
}
function saveDetailsContact () {
	let newOrg = $('#newOrg').val();
	let newEmail = $('#newEmail').val();
	let newPhone = $('#newPhone').val();
	let newAddress = $('#newAddress').val();
	
	let newLogo  = document.getElementById('newLogo').files[0];
	let form_  = new FormData();
	form_.append( 'newOrg' , newOrg);
	form_.append( 'newEmail' , newEmail);
	form_.append( 'newPhone' , newPhone);
	form_.append( 'newAddress' ,newAddress );
	form_.append( 'newLogo' ,newLogo );
	
	if(newOrg === ''){
		showErrorMessage('Name is Required' ,4);
		error_input_element(true ,'newOrg');
		return;
	}
	error_input_element(false ,'newOrg');
	
	if(newEmail === ''){
		showErrorMessage('Email is Required' ,4);
		error_input_element(true ,'newEmail');
		return;
	}
	error_input_element(false ,'newEmail');
	
	if(newPhone === ''){
		showErrorMessage('Phone is Required' ,4);
		error_input_element(true ,'newPhone');
		return;
	}
	error_input_element(false ,'newPhone');
	
	if(newAddress === ''){
		showErrorMessage('Address is Required' ,4);
		error_input_element(true ,'newAddress');
		return;
	}
	error_input_element(false ,'newAddress');
	
	
	if(document.getElementById('newLogo').files .length === 0){
		showErrorMessage('Logo is Required' ,4);
		error_input_element(true ,'newLogo');
		return;
	}
	error_input_element(false ,'newLogo');
	modalEditCompanyDialogDialog.iziModal ('startLoading');
	axios({url:'backend/company',method:'post',data:form_}).then(res=>{
		modalEditCompanyDialogDialog.iziModal ('stopLoading');
		if(res.statusText === 'OK' && res.data.status ==='ok'){
			modalEditCompanyDialogDialog.iziModal ('close');
			showSuccessMessage('Updated Company Details' ,5);
			getDefaultData ();
		}else{
			showErrorMessage('Failed to save' , 5);
		}
	})
		.catch(err=>{
			modalEditCompanyDialogDialog.iziModal ('stopLoading');
			showErrorMessage('Failed to connect  Please check your connection' ,3);
		});
	
}
function editCompanyDetails () {
	modalEditCompanyDialogDialog.iziModal ('open');
}