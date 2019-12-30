

function getDefaultData(){
  axios.get('/view/home?get_def=1').then(res=>{
      if(res.statusText  === 'OK'){
        const j = res.data;
            renderRowOne(j.children);
      }else{
        showErrorMessage('Failed to get data' , 5);
      }
  }).catch(err=>{
    showErrorMessage('Failed to connect , please check if your connection is proper' ,5);
  });
}

function renderRowOne(data){
      $('#txtChildrenCounter').text(data.child_counter);
      $('#MaleKidsCounter').text('Male ' +data.male);
      $('#FeMaleKidsCounter').text('Female ' +data.female);
      $('#birthdaysCounter').text(data.birthdays_today.length + '');
}

$(()=>getDefaultData());
