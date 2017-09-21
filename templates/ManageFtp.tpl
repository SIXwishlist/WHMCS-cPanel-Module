<div class="alert alert-danger text-center" id='errordiv'></div>
<div class="alert alert-success text-center" id='successdiv'></div>
<h3 id="header1">Manage FTP</h3>
</br>
<button type="button" id='aaa' class="btn btn-success">Add An Account <span class="glyphicon glyphicon-arrow-down" style="color:white"></span></button>
</br>
</br>
<div id='adddiv'>
<form method="post" action="clientarea.php?action=productdetails" id="addftpacc">
<fieldset class="form-horizontal">
<div style="float:left">
  <div class="form-group">
            <label class="col-sm-4 control-label" for="user">Login</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="user" id="addlogin"   />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="pass">Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" name="pass" id="addpass"  />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="quota">Quota</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" name="quota" id="addquota" value="0" min='1' />
            </div>
        </div>
		<p class='text-center'>
                    <button type="submit" id='addacc'  name="submit" class="btn btn-success" />Proceed <span class="glyphicon glyphicon-plus"></span></button>
		</p>
		</div>
		</fieldset>
		<input type="hidden" name="serviceid" id="serviceid" value="{$serviceid}" />
		<input type="hidden" name="modop" value="custom" />
		<input type="hidden" name="a" value="ftp" />
</form>
</div>
                </br>
                
                <button type="button" class='btn btn-primary' id='refresh'>Refresh <span class="glyphicon glyphicon-refresh"></span></button><div class="loader"></div>

<div align="left">
    <table width="100%" cellspacing="1" cellpadding="0" class="" id="table">
                <table width="100%" border="0" cellpadding="2" cellspacing="2" class="table table-striped" id="ca_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>LOGIN</th>
                            <th>DIRECTORY</th>
                            <th>QUOTA</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                <tbody>
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
          <form method="POST" action="" id='editForm'>
            <div class='form-group' style="padding-bottom: 30px;">
            <label class="col-sm-4 control-label" for="pass">Set Quota:</label>
            <div class='col-xs-4'>
             <input type="number" id='q' class="form-control" name="quota" min='1'  />
              </div>
              </div>
                <input type="hidden" name="id" value="{$serviceid}" />
		            <input type="hidden" name="modop" value="custom" />
		            <input type="hidden" name="a" value="ftp" />
                <input type="hidden" name="user" id="edituser" value=""> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="edit" id='edit' class="btn btn-primary">Confirm</button>
        </form>
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
jQuery('#errordiv').hide();
jQuery('#successdiv').hide();
jQuery('#adddiv').hide();
var serviceid = {$serviceid},
cuser = '{$cusername}';
</script>
<SCRIPT type="text/javascript" SRC="modules/servers/MichalZa/Templates/manage.js">
</SCRIPT>

