<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once('globalJunson.inc.php');
include_once($JUNSON_COMMON_INC);
include_once($JUNSON_AUTH_INC);
CheckTimeoutByLicense($junsonlicense);

$today=getdate(); $starttime=mktime($today["hours"],$today["minutes"],$today["seconds"],$today["mon"],$today["mday"],$today["year"]);

$data = GetInput();
if(isset($data['param'])) { $param = $data['param']; } else { $param=""; }

if(empty($param) or $param=="") {	echo GetLangStr($junsonlanguage,"ERROR: Parameter Empty ~"); exit; }

$keyitem=GetKeyByRand($param);
if(empty($keyitem) or $keyitem=="") {	echo GetLangStr($junsonlanguage,"ERROR: Item Empty ~"); exit; }

$UserListLevel=CheckLevelByLicense($junsonlicense,"LangSave",1);

?>
<HTML><HEAD>
<meta charset="utf-8">
<script src='//code.jquery.com/jquery-2.1.3.min.js'></script>
<script> 
<?php
  echo "var Estr001='".GetLangStr($junsonlanguage,'Ajax request Fail~')."';";
  echo "var Estr002='".GetLangStr($junsonlanguage,'Not Modify ~ Parameter Empty~')."';";
  echo "var Estr003='".GetLangStr($junsonlanguage,'Not Modify ~ Function Error~')."';";
  echo "var Estr004='".GetLangStr($junsonlanguage,'Not Modify ~ Power is Number form 11111 to 88888 ~')."';";
  echo "var Estr008='".GetLangStr($junsonlanguage,'OK')."';";
?>
$(document).ready ( function() {
  $('#edit').click(function() {
    $.ajax (
            {
              url:'langupt.php',
              data:
              {
                langname: $('#langname').val(),
                descr:$('#descr').val(),
                stopyn: $('#stopyn').val(),
                chkdel: $('#chkdel:checked').val(),
                randkey: $('#randkey').val()
              },
              error: function(xhr)
              {
                alert(Estr001);
              },
              success:function(response)
              { 
                if(response=='EPARA') {
                	alert(Estr002);
                	document.getElementById('AfterEditMessage').innerHTML=Estr002;
                }else if(response=='EFUNC') { 
                	alert(Estr003);
                	document.getElementById('AfterEditMessage').innerHTML=Estr003;
                }else if(response=='OK') { 
                	alert(Estr008);
                	location.href='langlist.php';
                }else if(response.indexOf('Deleted') > -1) {
                	alert(response); 
                	location.href='langlist.php';
                }else {
                	alert(response);
                	document.getElementById('#AfterEditMessage').innerHTML=response;
                }
              }
    });
  });
});
</script>
</HEAD>
<body>
<?php
$LangData=array();
if($keyitem=="NEW") {
	
}else {
  $LangData=GetDataList("GETLANGITEM",$keyitem,0);
}

echo "<br><br><br>";
echo "<table cellspacing='1' cellpadding='1' border='1' width='600'>";  
echo " <caption><font color='black' size='3'>".GetLangStr($junsonlanguage,"Language Edit")."</font></caption>";
echo "<thead>";
echo "  <tr bgcolor='#e2f5cf' valign='center' align='center'>";
echo "    <th><font size='2'>".GetLangStr($junsonlanguage,"Item")."</font></th>";
echo "    <th><font size='2'>".GetLangStr($junsonlanguage,"Value")."</font></th>";
echo "  </tr>";
echo "</thead>";

echo "<tbody>";

echo " <tr>";
echo "  <td>".GetLangStr($junsonlanguage,"Language Name")."</td>";
if($keyitem=='NEW') {
	$LandData[0][$JUNSON_DESCR]="x";
	$LangData[0][$JUNSON_STOPYN]="";	
	echo "  <td><input type='text' id='langname' size='20' maxlength='20'></td>";
} else {
  echo "  <td>".$keyitem."<input type='hidden' id='langname' value='".$keyitem."' ></td>";
}
echo " </tr>";

echo " <tr>";
echo "  <td>".GetLangStr($junsonlanguage,"Description")."</td>";
echo "  <td><input type='text' id='descr' value='".$LangData[0][$JUNSON_DESCR]."' size='20' maxlength='20'></td>";
echo " </tr>";

$stoptmp[0]="N";
$stoptmp[1]="Y";
echo "  <td>".GetLangStr($junsonlanguage,"Stop")."</td>";
echo "  <td>";
echo "   <select id='stopyn'>";
$n=count($stoptmp);
for($i=0; $i < $n;$i++) {
	if($LangData[0][$JUNSON_STOPYN]==$stoptmp[$i]) { $sel="selected"; } else { $sel=""; }
	echo "<option value='".$stoptmp[$i]."' ".$sel.">".$stoptmp[$i]."</option>";
}
echo "   </select>";
echo "  </td>";
echo " </tr>";

echo " <tr>";
echo "  <td>".GetLangStr($junsonlanguage,"DeleteLanguage")."</td>";
echo "  <td><input type='checkbox' id='chkdel' value='1'><font color='red'>".GetLangStr($junsonlanguage,"Will Delete This Language")."</font></td>";
echo " </tr>";

$keyA="LANGEDIT";
$randsnA=insRandKey($keyA,$keyitem,$junsonlicense);
echo "<input type='hidden' id='randkey' name='randkey' value='".$randsnA."'>";

echo " <tr>";
echo "  <td>".GetLangStr($junsonlanguage,"Action")."</td>";
if($keyitem=='NEW') { $action=GetLangStr($junsonlanguage,"Add"); } else { $action=GetLangStr($junsonlanguage,"Modify"); }
echo "  <td><input name='edit' id='edit' type='submit' value='".$action."' >";
echo " </tr>";

echo " <tr><td colspan='2'>";
echo "  <font color='red'><span id=\"AfterEditMessage\"></span></font>";
echo " </td></tr>";

echo "</tbody>";
echo "</table>"; 

?>
</body>
</HTML>
