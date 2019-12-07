let loggedUserName = null;
let TOKEN = null;
axios.defaults.baseURL = 'app/api/';

function checkAccess () {
	if (!Cookies.get ('JWT')) {
		window.location.href = "http://localhost/projects/AAllAA/schoolcare/log?access=1";
		return;
	}
	
	const payloadObj = KJUR.jws.JWS.readSafeJSONString (b64utoutf8 (Cookies.get ('JWT').split (".")[1]));
	loggedUserName = payloadObj.username;
	TOKEN = payloadObj.jwt;
	
	
	axios.defaults.headers.common['Authorization'] = TOKEN;
	
}
checkAccess ();
