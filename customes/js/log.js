
$('form, input, select').attr('autocomplete', 'new-password');

function loginUser() {
	const username = $("#username").val().trim();
	const password = $("#password").val().trim();
	let status_response = $("#status_response");
	if(username === ''){
		status_response.text("Username Required !");
		return;
	}
	if(password === ''){
		status_response.text("Password Required !");
		return;
	}
	status_response.text("Loading..");


	// makeToken('124212wadewr');
	$.post('app/api/backend/login',{username:username , password:password}).done(res=>{

		if (res === 'error_parse') {
									 //alert("Put Valid email log");
									 status_response.text('Put Valid email log');

							 }else if (res === 'lol_non_wrong'){
								 	status_response.text('Your not Registered to use the system !');
							 }else{
		let  j = JSON.parse(res);

		if(j.status=== 'ok'){
			makeToken (j.jwt, username ,j.sex);
			//	alert('in');
			window.location.href = "http://localhost/projects/AAllAA/schoolcare/render-home";
		}else{
			if(j.status === 'none'){
				status_response.text("User not found !");
			}
			if(j.status === 'auth'){
				status_response.text("Access Denied..");
			}
		}
	}

	}).fail((xhr, rd, err) => {
                status_response.text('Something Went  Wrong');
            });
}


function makeToken (token,username , sex) {
// Header
	var oHeader = {alg: 'HS256', typ: 'JWT'};
// Payload
	let oPayload = {};
	let tNow = KJUR.jws.IntDate.get('now');
	let tEnd = KJUR.jws.IntDate.get('now + 1day');
	oPayload.iss = "http://foo.com";
	oPayload.sub = "mailto:mike@foo.com";
	oPayload.nbf = tNow;
	oPayload.iat = tNow;
	oPayload.exp = tEnd;
	oPayload.jwt = token;
	oPayload.username = username;
	oPayload.aud = "http://foo.com/employee";
// Sign JWT, password=616161
	let sHeader = JSON.stringify(oHeader);
	let sPayload = JSON.stringify(oPayload);
	let sJWT = KJUR.jws.JWS.sign("HS256", sHeader, sPayload, "616161");
	//console.log (sJWT);
	const payloadObj = KJUR.jws.JWS.readSafeJSONString(b64utoutf8(sJWT.split(".")[1]));
//	console.log (payloadObj.username)
	// expires 7 days from now
	Cookies.set('JWT', sJWT, { expires: 7 });
	Cookies.set('sex', sex, { expires: 7 });

	///
	//Cookies.get('name') // => 'value'
	//Cookies.get('nothing') // => undefined

}
