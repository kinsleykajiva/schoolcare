
const modalselectLessonDialog = $("#selectLessonDialog");
modalselectLessonDialog.iziModal ({
	width: 900,
	zindex: 9999,
	radius: 5,
	padding: 0
});
let lastDaySelected = '';
modalselectLessonDialog.iziModal ('setHeaderColor', MODAL_HEADER_COLOR);
function onAddLessonOn (day) {
	lastDaySelected = day;
	openSelectLessonDialog();
	switch (day) {
		
		
		case 'Monday':
			
			break;
			
		case 'Tuesday':
			break;
			
		case 'Wdnesday':
			break;
			
		case 'Thursday':
			break;
			
		case 'Friday':
			break;
			
			
	}
}

function onSaveNewLesson () {
	
	const newLesson_title = $("#newLesson_title").val();
	const newLesson_categoy = $("#newLesson_categoy").val();
	const newLesson_description = $("#newLesson_description").val();
	const  newLesson_ages = $("#newLesson_ages").val();
	const newLesson_milestones = $("#newLesson_milestones").val();
	let data_ = new FormData();
	data_.append('newLesson_title' , newLesson_title);
	data_.append('newLesson_categoy' , newLesson_categoy);
	data_.append('newLesson_description' ,newLesson_description );
	data_.append('newLesson_ages' ,newLesson_ages );
	data_.append('newLesson_milestones' , newLesson_milestones);
	
	if(newLesson_title ===''){
		showErrorMessage('Title Required !' , 4);
		error_input_element(true,'newLesson_title');
		return;
	}
	error_input_element(false,'newLesson_title');
	
	if(newLesson_categoy ==='null'){
		showErrorMessage('Category Required !' , 4);
		$('#newLesson_categoy_error').css({'visibility':'visible'});
		return;
	}
	$('#newLesson_categoy_error').css({'visibility':'hidden'});
	
	$('body').loading({
		message: 'Saving Lesson...'
	});
	axios({url:'/backend/lessons' , method:'post',data:data_}).then(res=>{
		$('body').loading('stop');
		if(res.statusText === 'OK' && res.data.status === 'ok'){
			$('#newLesson_milestones').val('');
			emptyInputs(['newLesson_title','newLesson_description'],['newLesson_categoy','newLesson_ages'])
			showSuccessMessage('Lesson Added' , 5);
			getDefault();
			if(lastDaySelected !== ''){
				iziToast.question({
					timeout: 20000,
					close: false,
					overlay: true,
					displayMode: 'once',
					id: 'question',
					zindex: 9899,
					title: 'Proceed',
					message: 'Do you wish to proceed back to selecting Lesson(s) ? ',
					position: 'center',
					buttons: [
						['<button><b>YES</b></button>', function (instance, toast) {
							
							instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
							
						}, true],
						['<button>NO</button>', function (instance, toast) {
							
							instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
							
						}],
					],
					onClosing: function(instance, toast, closedBy){
						console.info('Closing | closedBy: ' + closedBy);
					},
					onClosed: function(instance, toast, closedBy){
						console.info('Closed | closedBy: ' + closedBy);
					}
				});
				
			}
		}else{
			showErrorMessage('Failed to save, try again' , 5);
		}
	}).catch(err=>{
		$('body').loading('stop');
		showErrorMessage('Failed to connect ,check your connection' , 5);
	});
	
	
	
	
	
}
function showAddNewClass () {
	modalselectLessonDialog.iziModal ('close');
	$("#divViewLesson").slideUp();
	$("#divCreateLesson").slideDown();
	
}

function openSelectLessonDialog () {
	// data-izimodal-title="Select Lesson Dialog"
	modalselectLessonDialog.iziModal('setTitle', 'Select Lesson Dialog for ' + lastDaySelected);
	modalselectLessonDialog.iziModal ('open');
}

function getDefault () {
	axios.get('/view/lessons',{
		params:{def_get:34}
	}).then(res=>{
		if(res.statusText === 'OK'){
			const j = res.data;
			renderLessonsSelects(j.lessons);
			renderMileStones(j.milestones);
			renderLessonsCategories(j.lesscategory);
			renderAgeRanges(j.age_range);
		}else{
			showErrorMessage('Failed to get Data Admin' ,4);
		}
	}).catch(err=>{
		showErrorMessage('Failed to get Data' , 4);
	});
}

function renderAgeRanges(data){
	//console.log (data)
	let opt = `<option value="null">Select</option>`;
	_.forEach(data ,(valls,inx)=>{
		opt += ` <option value="${valls.id}">${valls.start_age_in_months} - ${valls.end_age_in_months} Months</option> `;
	});
	$('#newLesson_ages').html(opt);
	$('#newLesson_ages').selectpicker('render').selectpicker('refresh');
}

function renderLessonsCategories(data){
	
	let opt = `<option value="null">Select</option>`;
	_.forEach(data ,(valls,inx)=>{
		opt += ` <option value="${valls.id}">${valls.title}</option> `;
	});
	$('#newLesson_categoy').html(opt);
	$('#newLesson_categoy').selectpicker('render').selectpicker('refresh');
}

function renderMileStones(data){
	let mData = groupBy(data , x=>[x.categoryTitle]);
	
	let optg = ``;
	Object.keys(mData).forEach((key,i)=>{
		let mKey = key ;
		optg += `<optgroup label="${mKey}">`;
		let mileStonesArr = mData[key];
		_.forEach(mileStonesArr,(valz,inz)=>{
			optg += `<option value="${valz.id}">${valz.title}</option>`;
		});
		optg += `</optgroup>`;
		
		//console.log (optg)
	});
	
	//console.log (optg);
	
	$('#newLesson_milestones').html(optg);
	$('#newLesson_milestones').selectpicker('render').selectpicker('refresh');
}

function renderLessonsSelects(data){
		let row ='';
		
		_.forEach(data,(valls,inx)=>{
			row +=`
			
			<div class="col-lg-4">
					<div class="card mb-5 mb-lg-0">
							<div class="card-body">
							
							<h6 class="card-price text-center">
								${valls.title}
							</h6>
							<h6 class="text-muted text-center">${valls.lessCate}</h6>
							<hr>
							<ul class="fa-ul">
							<li>
							<div id="module" class="">
							
							<p  style="overflow-y: auto; max-height: 100px;" aria-expanded="false">
							${valls.description}
							</p>
							
							</div>
							</li>
							
							<li>
							<div class="row d-flex justify-content-center label-main">
							<label class=" label label-inverse-info">${valls.age_range} Months</label>
							</div>
							</li>
							
							</ul>
							<!--<a href="#" class=" btn-primary t">Button</a>-->
							<div class=" row d-flex justify-content-center checkbox-fade fade-in-primary text-uppercase ">
							<label>
							<input type="checkbox" class="lessonClasses" value="${valls.id}">
							<span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
							<span class="text-inverse">Select </span>
							</label>
							</div>
							</div>
					</div>
		</div>
			
			
			
			`;
		});
		$("#divLessonsSelects").html(row);
}



$(()=>{getDefault();});



