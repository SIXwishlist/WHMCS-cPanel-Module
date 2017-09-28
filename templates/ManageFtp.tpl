<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/vue"></script>

<div id='alerts'>
    <div class="alert alert-danger text-center" v-if="errorAlert"> {literal}{{errorMessage}}{/literal}</div>
    <div class="alert alert-success text-center" v-if='successAlert'>{literal}{{successMessage}}{/literal}</div>
</div>
<div id="ManageFtp">    
<h3 id="header1">Manage FTP</h3>
</br>
<button type="button" v-bind:class="{ 'btn btn-success': formOpen, 'btn btn-warning': formClose }" v-on:click="openForm">Add An Account <span class="glyphicon glyphicon-arrow-down" style="color:white" ></span></button>
</br>
</br>
<div v-if="addForm">
    <form method="post" action="#" id="addftpacc">
    <fieldset class="form-horizontal">
        <div style="float:left">
            <div class="form-group">
                <label class="col-sm-4 control-label" for="user">Login</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="user" id="test" v-model="newLogin"   />
                </div>
            </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="pass">Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" name="pass" id="addpass" v-model="newPassword"  />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="quota">Quota</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" name="quota" id="addquota" value="0" min='1' v-model="newQuota" />
            </div>
        </div>
		<p class='text-center'>
                    <button type="submit" id='addacc'  name="submit" class="btn btn-success" v-on:click="addFtp" />Proceed <span class="glyphicon glyphicon-plus"></span></button>
		</p>
		</div>
		</fieldset>
		<input type="hidden" name="serviceid" id="serviceid" value="{$serviceid}" />
		<input type="hidden" name="modop" value="custom" />
		<input type="hidden" name="a" value="ftp" />
</form>
</div>
                
</br>
               
<button type="button" class='btn btn-primary' v-if='refresh' id='refresh' v-on:click="reloadTable">Refresh <span class="glyphicon glyphicon-refresh"></span></button><div class="loader"    v-if="loader"></div>
                
<div align="left">
    <table width="100%" cellspacing="1" cellpadding="0" class="" >
                <table width="100%" border="0" cellpadding="2" cellspacing="2" class="table table-striped" v-if="tab" >
                    <thead>
                        <tr>
                            <th>LOGIN</th>
                            <th>DIRECTORY</th>
                            <th>QUOTA</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                <tbody >
                    <tr v-if="nothing" ><td colspan="5" style="text-align:center ; color:black">Nothing to display.</td></tr>
                    <tr v-for="item in items">
                        <td>{literal}{{ item.serverlogin }} {/literal}</td>
                        <td>{literal}{{ item.dir }} {/literal}</td>
                        <td>{literal}{{ item.diskquota }} {/literal}</td>
                        <td min-width="50%"><button type='button' class='btn btn-danger' v-on:click="deleteFtp(item.user)"  ><span class='glyphicon glyphicon-trash' style='color:white'></span></button>
                            <button type='button'  class='btn btn-warning' v-on:click="updateModal(item.user)" data-toggle='modal' data-target='#editModal'><span class='glyphicon glyphicon-pencil' style='color:white'></span></button>
                        </td>
                    </tr>
              
                    
                </tbody>
                </table> 
    </table>
</div>
                
                <!-- EditModal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="EditModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="titleEdit"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">          
          <form method="POST" action="">
            <div class='form-group' style="padding-bottom: 30px;">
            <label class="col-sm-4 control-label" for="pass">Set Quota:</label>
            <div class='col-xs-4'>
             <input type="number" v-model="updateQuota"  class="form-control" name="quota" min='1'  />
             <input type="hidden" v-model="modalUser" class="form-control"  />
              </div>
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closeModalButton"  data-dismiss="modal">Close</button>
        <button type="button"  v-on:click="updateFtp()"  class="btn btn-primary">Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
                        
<style>
.loader {
    border: 8px solid #f3f3f3; /* Light grey */
    border-top: 8px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
}
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
#addacc{
float:left;
}
#header1{
  width:17%;
  border-bottom: 2px solid #3498db;
}

</style>
<script>
var serviceid = {$serviceid},
cuser = '{$cusername}';
</script>
<SCRIPT type="text/javascript" SRC="modules/servers/MichalZa/Templates/vueManage.js">
</SCRIPT>

