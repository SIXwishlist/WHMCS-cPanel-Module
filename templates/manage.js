var open = false;
jQuery(function(){
jQuery('#refresh').click();
jQuery('#aaa').click(function(){
if(open == false){
    jQuery('#adddiv').show();
    jQuery('#aaa').removeClass();
    jQuery('#aaa').addClass('btn btn-warning');
    jQuery('#aaa').html('Close Form');
    open = true;
} 
else
{
    jQuery('#adddiv').hide();
    jQuery('#aaa').removeClass();
    jQuery('#aaa').addClass('btn btn-success');
    jQuery('#aaa').html("Add An Account <span class='glyphicon glyphicon-arrow-down' style='color:white'></span>");
    open = false;
}
});
function changeEdit(id)
{
    var quota = jQuery('#edit'+id).val();
    var user = jQuery('#edit'+id).attr('data-user');
    $('#titleEdit').html('Change Quota: ' + user);
    $('#q').val(quota); 
    $('#edituser').val(user); 
}

jQuery('#addftpacc').submit(function(ev){
ev.preventDefault();
jQuery('#addacc').prop('disabled',true);
jQuery('#refresh').hide();
jQuery('.loader').show();
var $form = jQuery(this),
serviceid = jQuery('#serviceid').val(),
login = jQuery('#addlogin').val(),
pass = jQuery('#addpass').val(),
quota = jQuery('#addquota').val(),
url = $form.attr('action');
var request = jQuery.ajax({
    type: 'POST',
    url: url+"&id="+serviceid+"&method=create",
    data: {user : login , pass : pass , quota : quota}
    });
request.done(function(data){
		var result = JSON.parse(data);
        if(result.error)
        {
            jQuery('.loader').hide();
            jQuery('#errordiv').html(result.error).show();
            jQuery('#refresh').show();
            jQuery('#addacc').prop('disabled',false);
            setTimeout(function(){
            jQuery('#errordiv').hide();
            },7000);
        }
        else
        {
            jQuery('#successdiv').html('Success!').show();
            jQuery('#addlogin').val('');
            jQuery('#addpass').val('');
            jQuery('#addquota').val('');
            jQuery('#addacc').prop('disabled',false);
            jQuery('#refresh').click();   
        }  
     });
request.fail(function(){
    jQuery('#errordiv').html('Error occured!').show();
    jQuery('#refresh').click();
    });
});

jQuery('#editForm').submit(function(ev){
ev.preventDefault();
jQuery('#edit').prop('disabed',true);
jQuery('#refresh').hide();
jQuery('#editModal .close').click();
jQuery('.loader').show();
var user = jQuery('#edituser').val();
var quota = jQuery('#q').val();
jQuery.get("clientarea.php?action=productdetails&id="+serviceid+"&modop=custom&a=ftp&user="+user+"&quota="+quota+"&method=update")
        .done(function(data){
            var result = JSON.parse(data);
            if(result.error)
            {
                jQuery('.loader').hide();
                jQuery('#errordiv').html(result.error).show();
                jQuery('#refresh').show();
                setTimeout(function(){
            	jQuery('#errordiv').hide();
            },7000);
                jQuery('#refresh').click();
            }
            else
            {
                jQuery('#successdiv').html('Success!').show();
                jQuery('#edit').prop('disabled',false);
                jQuery('#refresh').click();   
            }  
            
        });
});

function deleteF(id)
{
    var user = jQuery('#del'+id).val();
    var serviceid = jQuery('#serviceid').val();
    var url = jQuery('#addftpacc').attr('action');
    var sender = jQuery('#del' + id);
    var parents =  jQuery(sender).parent().parent();
    jQuery(sender).parent().parent().html('<td colspan="5" style="text-align:center ; color:red">Deleted</td>');
    jQuery.get(url+"&id="+serviceid+"&user="+user+"&method=delete")
            .done(function(){
                jQuery(parents).remove();
                jQuery('#refresh').click();
                
    });    
}

jQuery('#refresh').click(function(){
    jQuery('#refresh').hide();
    jQuery('#ca_table').hide();
    jQuery('.loader').show();
    jQuery.get("clientarea.php?action=productdetails&id="+serviceid+"&modop=custom&a=ftp&method=list")
        .done(function(data){
            var result = JSON.parse(data);
            if(result == null)
            {
                jQuery('.loader').hide();
                jQuery('#aaa').hide();
                jQuery('#errordiv').html('You need to create a cPanel account first!').show(); 
            }
            else if(result.error)
            {
                jQuery('.loader').hide();
                jQuery('#errordiv').html(result.error).show();
                jQuery('#refresh').show();
                setTimeout(function(){
            	jQuery('#errordiv').hide();
            },7000);
            }
            else
            {
            var id = 1;                        
            jQuery('tbody').html('');
            jQuery.each(result,function(i,value){
                if(result.length == 4)
                {
                    jQuery('.loader').hide();
                    jQuery('#refresh').show();
                    jQuery('tbody').append('<tr><td colspan="5" style="text-align:center ; color:black">Nothing to display.</td></tr>');
                    jQuery('#ca_table').show();
                    return false;
                }
                else
                {
            	if(value.user == 'anonymous' || value.user == 'ftp' || value.user.indexOf('_logs') !== -1 || value.user == cuser)
            	{
            		return true;
            	}
                var delButton = "<button type='button' class='btn btn-danger' onclick='deleteF("+id+")' id='del"+id+"' value="+value.serverlogin+"><span class='glyphicon glyphicon-trash' style='color:white'></span></button>";
                var editButton = "<button type='button'  class='btn btn-warning' onclick='changeEdit("+id+")' id='edit"+id+"' value="+value.q+" data-user="+value.serverlogin+" data-toggle='modal' data-target='#editModal'><span class='glyphicon glyphicon-pencil' style='color:white'></span></button>";
                jQuery('tbody').append('<tr><td>'+id+'<td>'+value.serverlogin+'</td><td>'+value.dir+'</td><td>'+value.diskquota+'</td><td>'+delButton+''+editButton+'</td></tr>');
                id = id + 1;
                setTimeout(function(){
                    jQuery('#successdiv').hide();
                },2000);
                        }});
                jQuery('#refresh').show();
                jQuery('#ca_table').show();
                jQuery('.loader').hide();         
                    }});
});
   

});


