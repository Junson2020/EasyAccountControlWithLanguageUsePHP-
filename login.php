<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once('globalJunson.inc.php');
include_once($JUNSON_COMMON_INC);
include_once($JUNSON_AUTH_INC);

$data = GetInput();
if(isset($data['uAccount'])) { $username = $data['uAccount']; } else { $username=""; }
if(isset($data['upswd'])) { $password = $data['upswd']; } else { $password=""; }
?>
<HTML>
<HEAD>
<?php
echo "<title>".GetLangStr($junsonlanguage,"Login")."</title>";
?>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
<script src='//code.jquery.com/jquery-2.1.3.min.js'></script>
<script> 
<?php 
  echo 'var Estr001="'.GetLangStr($junsonlanguage,'Ajax request Fail~').'";';
  echo 'var Estr002="'.GetLangStr($junsonlanguage,'Password not Match~').'";';
  echo 'var Estr003="'.GetLangStr($junsonlanguage,'Verification Code not Match~').'";';
  echo 'var Estr004="'.GetLangStr($junsonlanguage,'LOGIN OK').'";';
  echo 'var Estr005="'.GetLangStr($junsonlanguage,'Others').'";';
?>
$(document).ready ( function() {
  $('#loginB').click(function() {
    $.ajax (
            {
              url:'chklogin.php',
              data:
              {
                uAccount: $('#uAccount').val(),
                upswd:$('#upswd').val(),
                randpswd: $('#randpswd').val()
              },
              error: function(xhr)
              {
                alert(Estr001);
                location.href='login.php';
              },
              success:function(response)
              { 
                if(response=='Error')
                { alert(Estr002);
                  location.href='login.php?uAccount='+$('#uAccount').val();
                }else if(response=='Randnumber')
                { alert(Estr003);
                  location.href='login.php?uAccount='+$('#uAccount').val()+'&upswd='+$('#upswd').val();
                }else if(response=='OK')
                { alert(Estr004);
                  location.href='index.php';
                }else {
                	alert(Estr005+response);
                  location.href='login.php?uAccount='+$('#uAccount').val()+'&upswd='+$('#upswd').val();
                }
              }
    });
  });
});
</script>

<body>
<form>
	<table border="1">
<?php		
  echo "<legend>".GetLangStr($junsonlanguage,"Login Information")."</legend>";
  echo '<tr>';
  echo ' <td>'.GetLangStr($junsonlanguage,"Account").'</td>';
  echo ' <td><input type="text" id="uAccount" value="'.$username.'" size="20"></td>';
  echo '</tr>';

  echo '<tr>';
  echo ' <td>'.GetLangStr($junsonlanguage,"Password").'</td>';
  echo ' <td><input type="password" id="upswd" value="'.$password.'" size="20"></td>';
  echo '</td>';

  echo '<tr>';
  echo ' <td>'.GetLangStr($junsonlanguage,"CAPTCHA").'</td>';
  echo ' <td><font size="3" color="red"><b><img src="randimg.php"></img></b></font>';
  echo '	   <input type="text" id="randpswd" size="5"></td>';
  echo '</tr>';
  
  echo '<tr>';
  echo ' <td colspan=2>';
  echo '  <input type="button" name="loginB" id="loginB" value="'.GetLangStr($junsonlanguage,"Login").'">';
  echo ' </td>';
  echo '</tr>';
?>
  </table>
</form>
</body>
</HTML>