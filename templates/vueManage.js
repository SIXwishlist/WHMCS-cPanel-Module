var alerts = new Vue({
    el: '#alerts',
    data: {
        errorAlert : false,
        successAlert: false,
        successMessage:null,
        errorMessage:null
    }
});
   
var ManageFtp = new Vue({
      el:'#ManageFtp',
      data: {
          items:[],
          nothing: false,
          loader: true,
          refresh:false,
          tab:false,
          addForm : false,
          newLogin : null,
          newPassword : null,
          newQuota : null,
          updateQuota : null,
          modalUser : null,
          formOpen : true,
          formClose : false       
      },
      beforeCreate: 
              function(){ 
              var self = this;
              alerts.errorAlert = false;
                axios.get("clientarea.php?action=productdetails&id="+serviceid+"&modop=custom&a=ftp&method=list")
                .then(function (response) { 
                if(response.data.error)
                {
                    alerts.errorMessage = response.data.error;
                    alerts.errorAlert = true;
                    self.refresh = true;
                    self.loader = false;
                }
                else
                {
                    var data = response.data;
                    data.forEach(function(value,key){
                       if(value.user == 'anonymous' || value.user == 'ftp' || value.user.indexOf('_logs') !== -1 || value.user == cuser)
                       {
                          data.splice(key,1);
                       }
                    });
                    self.items = data;
                    self.tab = true;
                    self.refresh = true;
                    self.loader = false;  
                }
                })
               .catch(function (error) {
        console.log(error);
        
        });
          },
      methods:{
          
          reloadTable : function(){
                var self = this;
                self.loader = true;
                self.refresh = false;
                self.tab = false;
                alerts.errorAlert = false;
                alerts.successAlert = false;
                axios.get("clientarea.php?action=productdetails&id="+serviceid+"&modop=custom&a=ftp&method=list")
                .then(function (response) {
                if(response.data.error)
                {
                    alerts.errorMessage = response.data.error;
                    alerts.errorAlert = true;
                    self.refresh = true;
                    self.loader = false;
                }
                else
                {
                    var data = response.data;
                    data.forEach(function(value,key){
                       if(value.user == 'anonymous' || value.user == 'ftp' || value.user.indexOf('_logs') !== -1 || value.user == cuser)
                       {
                          data.splice(key,1);
                       }
                    });
                    self.items = data;
                    self.tab = true;
                    self.refresh = true;
                    self.loader = false;
                    setTimeout(function()
                    {
                        alerts.successAlert = false;
                    }, 2000);
                    
                }
                })
               .catch(function (error) 
                {
                    console.log(error);
        });
          },
          
          addFtp: function(e)
            {
                var self = this;
                var refreshButton = document.getElementById('refresh');
                self.loader = true;
                self.refresh = false;
                alerts.errorAlert = false;
                e.preventDefault();
                self.addForm = false;
                self.formClose = false;
                self.formOpen = true;
                axios.post("clientarea.php?action=productdetails&id="+serviceid+"&method=create",
               {    login: self.newLogin,
                    password: self.newPassword,
                    quota : self.newQuota                             
                })
                .then(function (response) 
                {  
                    if(response.data.error)
                    {
                        alerts.errorMessage = response.data.error;
                        alerts.errorAlert = true;
                        self.refresh = true;
                        self.loader = false;
                    }
                    else if(response.data.msgSuccess)
                    {
                        refreshButton.click();
                        alerts.successMessage = response.data.msgSuccess;
                        alerts.successAlert = true;                   
                    }
                })
          },
          
          deleteFtp : function(user)
          {
            var self = this;
            var refreshButton = document.getElementById('refresh');
            self.loader = true;
            self.refresh = false;
            axios.get("clientarea.php?action=productdetails&id="+serviceid+"&modop=custom&a=ftp&method=delete&user="+user)
                .then(function (response) 
                {
                    if(response.data.error)
                    {
                        alerts.errorMessage = response.data.error;
                        alerts.errorAlert = true;
                        self.refresh = true;
                        self.loader = false;        
                    
                    }
                    else if(response.data.msgSuccess)
                    {
                        refreshButton.click();
                        alerts.successMessage = response.data.msgSuccess;
                        alerts.successAlert = true;
                    }
                })
          },
          
              updateFtp : function()
              { 
                var self = this;
                var refreshButton = document.getElementById('refresh');
                var modalClose = document.getElementById('closeModalButton');
                modalClose.click();
                self.loader = true;
                self.refresh = false;
                 axios.get("clientarea.php?action=productdetails&id="+serviceid+"&modop=custom&a=ftp&method=update&user="+self.modalUser+"&quota="+self.updateQuota)
                .then(function (response) 
                {
                    if(response.data.msgSuccess)
                    {
                        refreshButton.click();
                        alerts.successMessage = response.data.msgSuccess;
                        alerts.successAlert = true;
                    }
                })
          },
          
                updateModal : function(user)
              {
                  var self = this;
                  self.modalUser = user;
               },
          
          openForm : function()
            {
                var self = this;
                if(!self.addForm)
                {
                    self.addForm = true;
                    self.formClose = true;
                    self.formOpen = false;
                    
                }
                else
                {
                    self.addForm = false;
                    self.formClose = false;
                    self.formOpen = true;
                }
          }
          
      }
              
  });


