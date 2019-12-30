function getDefaultData(){

    axios.get('/view/profile',{params:{def_get:3243}}).then(res=>{
        if(res.statusText === 'OK'){
            renderDetails(res.data.data);
        }
    }).catch(err=>{
        showErrorMessage('Failed to connect please check your connection' ,5);
    })
}

$(()=>getDefaultData());

function renderDetails(data){
    data = data[0];
    $('#employeeName').text(data.name + ' ' + data.surname);
    $('#jobposition').text(data.jobposition);
    $('#employeeDateOfBirth').text(data.date_of_birth);

    $('#UserName').text(capitaliseTextFristLetter(loggedUserName));

    $('#employeeSex').text(capitaliseTextFristLetter(data.sex));

    $("#userLogo").attr('src' ,  data.sex === 'male' ? 'customes/logos/user.png' : 'customes/logos/female-user.png');


    $('#employeeID').text(data.id_number);
    $('#employeeAddress').text(data.address);
    $('#employeeEmail').text(data.email);
    $('#employeePhone').text(data.phonecontact);
}
