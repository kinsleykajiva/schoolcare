let loggedUserName = null;
let loggedUserSex = Cookies.get ('sex');

let TOKEN = null;
const firstAPI = axios.create({
	//baseURL: 'https://github.com/'
});
axios.defaults.baseURL = 'app/api/';
axios.defaults.timeout = 1000 * 4;
accounting.settings = {
	currency: {
		symbol: 'R',   // default currency symbol is '$'
		format: "%s %v", // controls output: %s = symbol, %v = value/number (can be object: see below)
		decimal: ".",  // decimal point separator
		thousand: ",",  // thousands separator
		precision: 2   // decimal places
	},
	number: {
		precision: 0,  // default precision on numbers is 0
		thousand: ",",
		decimal: "."
	}
};
function checkAccess () {
	if (!Cookies.get ('JWT')) {
		window.location.href = "log?access=1";
		return;
	}
	
	const payloadObj = KJUR.jws.JWS.readSafeJSONString (b64utoutf8 (Cookies.get ('JWT').split (".")[1]));
	loggedUserName = payloadObj.username;
	TOKEN = payloadObj.jwt;
	
	$("#loggedUserName").text(capitaliseTextFristLetter(loggedUserName));
	$("#globalUserIcon").attr('src' ,  loggedUserSex === 'male' ? 'customes/logos/user.png' : 'customes/logos/female-user.png');
	axios.defaults.headers.common['Authorization'] = TOKEN;
	// Add a response interceptor
	axios.interceptors.response.use(function (res) {
		// Any status code that lie within the range of 2xx cause this function to trigger
		// Do something with response data
		checkAuth(res.data);
		
		return res;
	}, function (error) {
		// Any status codes that falls outside the range of 2xx cause this function to trigger
		// Do something with response error
		return Promise.reject(error);
	});
	
}
checkAccess ();

const MODAL_HEADER_COLOR = '#2989f7';

/*********************************************************************************************/
function allowTextInputOnly($objectInput) {
	$("#"+$objectInput).bind('keyup blur',function(){
		let node = $(this);
		node.val(node.val().replace(/[^a-z]/g,'') ); }
	);
}
/*********************************************************************************************/

function checkAuth(jdata){
	if(jdata === 'auth'){
		window.location.href = "log";
	}
	
}

/*********************************************************************************************/
String.prototype.replaceAll = function(f,r){return this.split(f).join(r);}
/*********************************************************************************************/
function groupBy ( xs , f ) {
	return xs.reduce (
		( r , v , i , a , k = f ( v ) ) => ( ( r[ k ] || ( r[ k ] = [] ) ).push (    v ), r ) , {} );
}
/*********************************************************************************************/
/**
 * Get the URL parameters
 * source: https://css-tricks.com/snippets/javascript/get-url-variabl
 es/
 * @param {String} url The URL
 * @return {Object}
 The URL parameters
 */
let getParams =  url=> {
	let params = {};
	let parser = document.createElement('a');
	parser.href = url;
	const query = parser.search.substring(1);
	const vars = query.split('&');
	if(vars.length < 1 || vars[0]==''){
		return null;
	}
	for (let i = 0; i < vars.length; i++) {
		let pair = vars[i].split('=');
		if(decodeURIComponent(pair[1]).trim() == ''){
			return null;
		}
		if(decodeURIComponent(pair[1]) == "undefined"){
			return null;
		}
		params[pair[0]] = decodeURIComponent(pair[1]);
	}
	return params;
};
/*********************************************************************************************/
function emptyInputs ( arrInput_ids , arrSelect_ids ) {
	
	for(let i = 0 ; i < arrInput_ids.length ; i ++){
		let id = arrInput_ids[i];
		$("#"+id).val('');
	}
	for(let i = 0 ; i < arrSelect_ids.length ; i ++){
		let id = arrSelect_ids[i];
		$("#"+id).val('null');
	}
	
}
/*********************************************************************************************/
function error_perInput(inputElement, errorMessage) {
	if (errorMessage === '') {
		$(inputElement).css(
			{
				"border-color":"black"
			}
		);
		//$(inputElement).text("");
	} else {
		$(inputElement).text(errorMessage);
		$(inputElement).css({
			"border-color": "red"
		});
		showErrorMessage(errorMessage, 5.5);
	}
}
/*********************************************************************************************/
function error_input_element(isTrue , elementId) {
	if(isTrue){
		$('#'+elementId).css({
			"border": "1px solid red",
			"background": "#ff4e44"
		});
		
	}else{
		$('#'+elementId).css({
			"border": "",
			"background": ""
		});
	}
	
}
/*********************************************************************************************/
/*********************************************************************************************/
function getcurrentDate() {
	let today = new Date();
	let dd = today.getDate();
	let mm = today.getMonth() + 1; //January is 0!
	let yyyy = today.getFullYear();
	if (dd < 10) {
		dd = '0' + dd ;
	}
	if (mm < 10) {
		mm = '0' + mm;
	}
	return mm + '/' + dd + '/' + yyyy;
}
/*********************************************************************************************/
function isEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}
/*********************************************************************************************/
function simpleAcronymExpression(text) {
	return text
		.split(/\s/)
		.reduce((accumulator, word) =>{
			word  = word === '&' ? '' : word;
			word  = word === 'and' ||  word === 'with' ||  word === 'is' ? '' : word;
			word  = word === 'to' || word === 'tO' || word === 'To' || word === 'TO' ? '' : word;
			word = word.replaceAll(',' , ' ');
			return accumulator + word.charAt(0).toUpperCase();
		}, '');
}
/*********************************************************************************************/
function removeLoadingOn(element_id_String){
	$('#' + element_id_String).unblock();
	
}

/*********************************************************************************************/
/*********************************************************************************************/
function removeEverythingAfterLastOccurrenceOfCharacter(str , char) {
    return str.substring(0, str.lastIndexOf(char) + 1);
}
/*********************************************************************************************/
function randString(x) {
	var s = "";
	while (s.length < x && x > 0) {
		var r = Math.random();
		s += (r < 0.1 ? Math.floor(r * 100) : String.fromCharCode(Math.floor(r * 26) + (r > 0.5 ? 97 : 65)));
	}
	return s;
}
/*********************************************************************************************/
/**
 * Gets the random integer between min and max (both included)
 *
 * @param      {number}  min     The minimum
 * @param      {number}  max     The maximum
 * @return     {<type>}  The random integer.
 */
function getRndInteger(min, max) {
	return Math.floor(Math.random() * (max - min + 1)) + min;
}
/*********************************************************************************************/
/**
 * Creates a random receipt Number between min and max (both included)
 * @return     {<String>}  random receipt Number.
 */
function receiptNumber() {
	let ret = "";
	ret = getcurrentDate(); //  dd + '/' + mm + '/' + yyyy;
	let dd = ret.split('/')[0];
	let mm = ret.split('/')[1];
	let yyyy = ret.split('/')[2];
	let ranS = randString(getRndInteger(5, 8)).toUpperCase();
	ret = dd + ranS.substring(2, 4) + ranS.charAt(getRndInteger(1, 2)) + '-' + mm + '-' + ranS.charAt(getRndInteger(1, 4)) + yyyy;
	return ret;
}
/*********************************************************************************************/
/**
 * Converts a Turkish Z-Date format to  date form MM/DD/YYYY
 * @param      {String} zDate   The date to be converted
 * @return     {String}  Date String.
 */
function dateConvertor(zDate) {
	return new Date(zDate).toDateString();
}
/*********************************************************************************************/
/**
 * Converts a Turkish Z-Date format to  date form MM/DD/YYYY
 * @param      {String} zDate   The date to be converted
 * @return     {String}  Date String.
 */
function getDateConvertion(zdate) {
	let date = new Date(zdate);
	return ((date.getMonth() + 1) + '/' + date.getDate() + '/' + date.getFullYear());
}
/*********************************************************************************************/
function getCurrentTimeLong(){
	return new Date().getTime();
}
/*********************************************************************************************/
/**
 * Creates a random String based on the chars input <br>
 * example of usage: randomString(5); or randomString(5,
 * 'PICKCHARSFROMTHISSET');
 * <br>
 * @param {integer} length - size of the output .
 * @param {string} chars - can be ignored ,but the the characters to use in
 *         creating the output.
 * @returns {String} Random string of size @param lenSize
 */
function randomIDString(lenSize, chars) {
	let charSet = chars || 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	let randomString = "";
	for (let i = 0; i < lenSize; i++) {
		let position = Math.floor(Math.random() * charSet.length);
		randomString += charSet.substring(position, position + 1);
	}
	return randomString;
}
function randomNumbers ( min , max ) {
	return (Math.floor(Math.random() * max) + min);
}
/*********************************************************************************************/
/**
 * Create a random String of alphabet and numbers
 * @returns {string} Random String
 */
function randomStringID() {
	var text = "";
	var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	for (var i = 0; i < 5; i++) {
		text += possible.charAt(Math.floor(Math.random() * possible.length));
	}
	return text;
}
/*********************************************************************************************/
/**This will reset the form*/
function resteForm(formIdObject) {
	formIdObject[0].reset();
}
/*********************************************************************************************/
function idleTimer() {
	let t;
	//window.onload = resetTimer;
	window.onmousemove = resetTimer; // catches mouse movements
	window.onmousedown = resetTimer; // catches mouse movements
	window.onclick = resetTimer; // catches mouse clicks
	window.onscroll = resetTimer; // catches scrolling
	window.onkeypress = resetTimer; //catches keyboard actions
	function logout() {
		window.location.href = '/action/logout'; //Adapt to actual logout script
	}
	
	function reload() {
		window.location = self.location.href; //Reloads the current page
	}
	
	function resetTimer() {
		clearTimeout(t);
		t = setTimeout(logout, 1800000); // time is in milliseconds (1000 is 1 second)
		t = setTimeout(reload, 300000); // time is in milliseconds (1000 is 1 second)
	}
}
/*********************************************************************************************/
/*********************************************************************************************/
function removeLoadingScreen () {
	$.unblockUI({
		fadeOut: 100
	});
}
/*********************************************************************************************/
function loadingScreenElement(elementID, show, message) {
	if (show) {
		$('#' + elementID).block({
			message: message == '' ? "<h1>Processing</h1>" : "<h1> " + message + " </h1>",
			css: {
				border: 'none',
				padding: '15px',
				backgroundColor: '#000',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				opacity: 0.5,
				color: '#fff'
			}
		});
	} else {
		$('#' + elementID).unblock();
	}
}
/**
 * This will show a UI blocking loading Screen*/
function loadingScreen(sho, message) {
	if (sho) {
		$.blockUI({
			message: message == '' ? "<h3> Processing.Please Wait...</h3>" : "<h3> " + message + "</h3>",
			css: {
				border: 'none',
				padding: '15px',
				backgroundColor: '#000',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				opacity: 0.5,
				color: '#fff'
			}
		});
	} else {
		$.unblockUI({
			fadeOut: 100
		});
	}
}
/*********************************************************************************************/
function showLoadingOn(element_id_String){
	$('#' + element_id_String).block({
		message: '<i class="fas fa-spin fa-sync text-white"></i>',
		overlayCSS: {
			backgroundColor: '#000',
			opacity: 0.5,
			cursor: 'wait'
		},
		css: {
			border: 0,
			padding: 0,
			backgroundColor: 'transparent'
		}
	});
}
/*********************************************************************************************/
function __(elementId) {
	return document.getElementById(elementId);
}
/*********************************************************************************************/
function isNumeric(num){
	return !isNaN(num);
}

/*********************************************************************************************/


// example filter function
function exampleFilter(el) {
	return elem.nodeName.toLowerCase() == 'a';
}
/*********************************************************************************************/

// usage
//el = document.querySelector('div');
// get all siblings of el
//var sibs = getSiblings(el);
// get only anchor element siblings of el
//var sibs_a = getSiblings(el, exampleFilter);
/*********************************************************************************************/
/**
 * This will convert a M/D/Y date format to dddd MMMM D YYYY
 * */
function convertDateToReadable(date_M_slash_D_slash_Y){
	// 02/12/2013
	let longDateStr = moment(date_M_slash_D_slash_Y, 'M/D/Y').format('dddd MMMM D YYYY');
	return (longDateStr);
}

/*********************************************************************************************/
/**
 * This will convert a M/D/Y date format to dddd MMMM D YYYY
 * */
function convertDateToReadableFormat(date_yyy_mm_dd){
	let longDateStr = moment(date_yyy_mm_dd, 'YYYY-MM-DD').format('dddd MMMM D YYYY');
	// alert(new Date("2018-07-27").toUTCString().split(" "))
	return (longDateStr);
}
/*********************************************************************************************/
/*********************************************************************************************/

function capitaliseTextFristLetter ( string ) {
	
	return string.charAt(0).toUpperCase() + string.slice(1);
}

/*********************************************************************************************/
function capitaliseTextFirstCaseForWords(text) {
	var firstLtr = 0;
	for (var i = 0;i < text.length;i++){
		if (i == 0 &&/[a-zA-Z]/.test(text.charAt(i)))
			firstLtr = 2;
		if (firstLtr == 0 &&/[a-zA-Z]/.test(text.charAt(i)))
			firstLtr = 2;
		if (firstLtr == 1 &&/[^a-zA-Z]/.test(text.charAt(i))){
			if (text.charAt(i) == "'"){
				if (i + 2 == text.length &&/[a-zA-Z]/.test(text.charAt(i + 1))) firstLtr = 3;
				else if (i + 2 < text.length &&/[^a-zA-Z]/.test(text.charAt(i + 2))) firstLtr = 3;
			}
			if (firstLtr == 3) firstLtr = 1;
			else firstLtr = 0;
		}
		if (firstLtr == 2){
			firstLtr = 1;
			text = text.substr(0, i) + text.charAt(i).toUpperCase() + text.substr(i + 1);
		}
		else {
			text = text.substr(0, i) + text.charAt(i).toLowerCase() + text.substr(i + 1);
		}
	}
	return text;
}

/*********************************************************************************************/
function scrollToElementID(elementIDOnly) {
	document.querySelector('#'+elementIDOnly).scrollIntoView({
		behavior: 'smooth'
	});
}
/*********************************************************************************************/
function chunkArrayGrouped(myArray, chunk_size){
	var index = 0;
	var arrayLength = myArray.length;
	var tempArray = [];
	let i = 1 ;
	for (index = 0; index < arrayLength; index += chunk_size) {
		
		const myChunk = myArray.slice(index, index+chunk_size);
		// Do something if you want with the group
		let objGroup = {[i]:myChunk};
		tempArray.push(objGroup);
		i++;
	}
	
	return tempArray;
}
// result
/*[[object Object] {
    1: [1, 2, 3]
}, [object Object] {
    2: [4, 5, 6]
}, [object Object] {
    3: [7, 8]
}]*/
/*********************************************************************************************/
/**
 * Returns an array with arrays of the given size.
 *
 * @param myArray {Array} array to split
 * @param chunk_size {Integer} Size of every group
 */
function chunkArray(myArray, chunk_size){
	var index = 0;
	var arrayLength = myArray.length;
	var tempArray = [];
	
	for (index = 0; index < arrayLength; index += chunk_size) {
		myChunk = myArray.slice(index, index+chunk_size);
		// Do something if you want with the group
		tempArray.push(myChunk);
	}
	
	return tempArray;
}
// Split in group of 3 items
// var result = chunkArray([1,2,3,4,5,6,7,8], 3);
// Outputs : [ [1,2,3] , [4,5,6] ,[7,8] ]
// console.log(result);
/*********************************************************************************************/
/**can be applied to any table*/
function noDataRow ( numberOfColumns , noDataMessage ) {
	let td = ``;
	for ( let i = 0 ; i < numberOfColumns ; i ++ ) {
		td += `
              <td style='color:red;'> ${ noDataMessage } </td>
            `;
	}
	return `<tr> ${ td } </tr>`;
}
/*********************************************************************************************/
/**can be applied to any table*/
function noDataRowDFlex ( numberOfColumns , noDataMessage ) {
	let td = ``;
	let isEven =   numberOfColumns % 2 === 0 ;
	let col = isEven ? 12 / numberOfColumns  : 12 / (numberOfColumns + 1);
	col = 'col-' + col ;
	for ( let i = 0 ; i < numberOfColumns ; i ++ ) {
		td += `
              <td class="${col}" style='color:red;'> ${ noDataMessage } </td>
            `;
	}
	return `<tr class="d-flex"> ${ td } </tr>`;
}

/*********************************************************************************************/

function isPasswordValid(str)
{
	// at least one number, one lowercase and one uppercase letter
	// at least six characters that are letters, numbers or the underscore
	var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$/;
	return re.test(str);
}
/*********************************************************************************************/

function __notify(message , from, align, icon, type, animIn, animOut ,time , title){
	$.growl({
		icon: icon,
		title: title,
		message: message,
		url: ''
	},{
		element: 'body',
		type: type,
		allow_dismiss: true,
		placement: {
			from: from,
			align: align
		},
		offset: {
			x: 30,
			y: 30
		},
		spacing: 10,
		z_index: 999999,
		delay: 2500,
		timer: 1000 * time,
		url_target: '_blank',
		mouse_over: false,
		animate: {
			enter: animIn,
			exit: animOut
		},
		icon_type: 'class',
		template: '<div data-growl="container" class="alert" role="alert">' +
							'<button type="button" class="close" data-growl="dismiss">' +
									'<span aria-hidden="true">&times;</span>' +
									'<span class="sr-only">Close</span>' +
							'</button>' +
							'<span data-growl="icon"></span>' +
							'<span data-growl="title"></span>' +
							'<span data-growl="message"></span>' +
							'<a href="#" data-growl="url"></a>' +
					'</div>'
	});
}


function showGeneralMessage (messageText,time) {
	iziToast.info({
		title: 'Information',
		message: messageText,
	});
		//__notify(messageText , 'top','right' , 'fa fa-check','inverse','animated fadeInRight','animated fadeOutRight',time , '');
}

function showErrorMessage (messageText,time) {
		//__notify(messageText , 'top','right' , 'fa fa-check','danger','animated fadeInRight','animated fadeOutRight',time,'');
	iziToast.error({
		title: 'Error',
		message: messageText,
	});
}


function showSuccessMessage (messageText,time) {
	iziToast.success({
		title: 'Success',
		message: messageText,
	});
		//__notify(messageText , 'top','right' , 'fa fa-check','success','animated fadeInRight','animated fadeOutRight',time , '');
}
/*********************************************************************************************/
function onDivLoadRemove (card) {
	card.parents ('.card').children (".card-loader").remove ();
	card.parents ('.card').removeClass ("card-load");
}
/*********************************************************************************************/
function onDivLoad () {
	const card = $ (".card-header-right .reload-card-remake");
	card.parents ('.card').addClass ("card-load");
	card.parents ('.card').append ('<div class="card-loader"><i class="fa fa-spinner rotate-refresh"></div>');
	return card;
}
/*********************************************************************************************/

function doesConnectionExist() {
	var xhr = new XMLHttpRequest();
	var file = "https://www.kirupa.com/blank.png";
	var randomNum = Math.round(Math.random() * 10000);
	
	xhr.open('HEAD', file + "?rand=" + randomNum, true);
	xhr.send();
	
	xhr.addEventListener("readystatechange", processRequest, false);
	
	function processRequest(e) {
		if (xhr.readyState === 4) {
			console.log (xhr.status)
			console.log (xhr)
			if (xhr.status >= 200 && xhr.status < 304) {
				alert("connection exists!");
			} else {
				alert("connection doesn't exist!");
			}
		}
	}
}
function hostReachable() {
	
	$.ajax({url: "http://api.themoviedb.org/2.1/Movie.search/en/json/23afca60ebf72f8d88cdcae2c4f31866/The Goonies",
		dataType: "jsonp",
		timeout:3000,
		statusCode: {
			200: function (response) {
				alert('status 200');
			},
			404: function (response) {
				alert('status  404 ');
			}
		}
	});
	/*$.ajax({url: "http://api.themoviedb.org/2.1/Movie.search/en/json/23afca60ebf72f8d88cdcae2c4f31866/The Goonies",
		type: "HEAD",
		timeout:1000,
		statusCode: {
			200: function (response) {
				alert('Working!');
			},
			400: function (response) {
				alert('Not working!');
			},
			0: function (response) {
				alert('Not working!');
			}
		}
	});*/
	/*axios.get('https://www.kirupa.com/blank.png')
		.catch(function (error) {
			if (error.response) {
				// The request was made and the server responded with a status code
				// that falls out of the range of 2xx
				console.log(error.response.data);
				console.log(error.response.status);
				console.log(error.response.headers);
			} else if (error.request) {
				// The request was made but no response was received
				// `error.request` is an instance of XMLHttpRequest in the browser and an instance of
				// http.ClientRequest in node.js
				console.log(error.request);
			} else {
				// Something happened in setting up the request that triggered an Error
				console.log('Error', error.message);
			}
			console.log(error.config);
		});*/
	
}
//hostReachable()
//console.log (hostReachable())
//doesConnectionExist();
/*********************************************************************************************/

function getCheckedInputsGetValues (className) {
	let checkedValue = [];
	let inputElements = document.getElementsByClassName(className);
	for(let i=0; inputElements[i]; ++i){
		if(inputElements[i].checked){
			checkedValue.push(inputElements[i].value);
		}
	}
	return  checkedValue;
}

function uncheckCheckedInputs (className) {
	
	let inputElements = document.getElementsByClassName(className);
	for(let i=0; inputElements[i]; ++i){
		if(inputElements[i].checked){
			inputElements[i].checked = false;
		}
	}
	
}

/*********************************************************************************************/
function globalInfoDialog (htmlContent , header__) {
	const cont = $("#GlobalIziModalModalHtmlContentDiv");
	cont.iziModal ({
		width: 700,
		radius: 5,
		padding: 20
	});
	cont.iziModal ('setHeaderColor', MODAL_HEADER_COLOR);
	cont.iziModal('setTitle', header__ + ' Info Dialog');
	
	cont.iziModal('setContent', htmlContent);
	cont.iziModal('open');
}
/*********************************************************************************************/

/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/

