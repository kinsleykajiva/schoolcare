<?php
	include '../checkReqst.php';
// print $USER_ID ;

	if(isset($_POST['edit_selectRole'])){
		$edit_selectRole = $_POST['edit_selectRole'];
		$edit_newPassword = $_POST['edit_newPassword'];
		$edit_newUsername = $_POST['edit_newUsername'];
		$rec_id = $_POST['rec_id'];

		$res = $usersObj->UpdateUser($rec_id , $edit_newUsername , $edit_newPassword , $edit_selectRole );


		print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}
function emailUserWithDetails( $usernameMail, $username, $password , bool $isNew = TRUE):string {
	$message = 'Welcome to SchoolCare a PreSchool / Day School Management System we have created an account for you using this email address.';
	if(!$isNew){
		$message = ' Your access details have been updated to SchoolCare a PreSchool / Day School Management System  using this email address.';
	}
	return '
	
	
	<div style="background-color: #00b4ea; display: block; position: fixed; top: 0; width: 100%; height: 200px; z-index: -1;">&nbsp;</div>
<div style="background: #fff; padding: 20px 10px; width: 80%; z-index: 5; margin: auto; border: 1px solid rgba(0,0,0,.1);">
<table style="background: #fff; margin: auto;" width="80%">
<tbody>
<tr>
<td style="width: 141.975%;">
<h2 style="font-family: sans-serif; text-align: center;">SchoolCare Login Credential</h2>
</td>
<td style="width: 10%;">
<p style="color: #777; text-align: right;">&nbsp;</p>
</td>
</tr>
<tr>
<td style="width: 151.975%;" colspan="2">
<h3><img style="display: block; visibility: hidden; margin-left: auto; margin-right: auto;" alt="logo" width="118" height="118" /></h3>
<h3>Hi&nbsp; <img src="https://html5-editor.net/tinymce/plugins/emoticons/img/smiley-smile.gif" alt="smile" /> ,</h3>
<p>'.$message.' You can log in at any time with the following credentials:</p>
<p>&nbsp;</p>
<br />
<table style="width: 842px;">
<tbody>
<tr>
<td style="width: 278.933px;">-</td>
<td style="width: 545.067px;"><a href="https://legalware.site" target="_blank" rel="noopener">-</a></td>
</tr>
<tr>
<td style="width: 278.933px;">Login Page</td>
<td style="width: 545.067px;"><a href="https://legalware.site/log" target="_blank" rel="noopener">https://legalware.site/log</a></td>
</tr>
<tr>
<td style="width: 278.933px;">User Login</td>
<td style="width: 545.067px;">'.$usernameMail.'</td>
</tr>
<tr>
<td style="width: 278.933px;">User Name</td>
<td style="width: 545.067px;">'.$username.'</td>
</tr>
<tr>
<td style="width: 278.933px;">Password</td>
<td style="width: 545.067px;">'.$password.'</td>
</tr>
</tbody>
</table>
<br />
<p>Once logged in you can change your profile information or password as you please. Thank you for being a part of us.</p>
<br />
<p style="text-align: left;">&nbsp;Kind regards, <br />&nbsp;Administrator</p>
</td>
</tr>
<tr>
<td style="width: 151.975%;" colspan="2">&nbsp;</td>
</tr>
</tbody>
</table>
</div>
	
	
	
	';
}



