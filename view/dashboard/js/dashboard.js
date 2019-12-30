

function getDefaultData(){
  axios.get('/view/home?get_def=1').then(res=>{
      if(res.statusText  === 'OK'){
        const j = res.data;
            renderRowOne();
      }else{
        showErrorMessage('Failed to get data' , 5);
      }
  }).catch(err=>{
    showErrorMessage('Failed to connect , please check if your connection is proper' ,5);
  });
}

function renderRowOne(){

}

$(()=>getDefaultData());
