<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once('globalJunson.inc.php');
include_once($JUNSON_COMMON_INC);
include_once($JUNSON_AUTH_INC);
CheckTimeoutByLicense($junsonlicense);

?>
<HTML><HEAD>
<meta charset="utf-8">
</HEAD>
<body class="background">
<?php
	echo "<table border=\"1\">";
	echo " <tr>";
	echo "  <td><a href='levellist.php' target='_blank'>".GetLangStr($junsonlanguage,"Level List")."</a></td>";
	echo "  <td><a href='userlevel.php' target='_blank'>".GetLangStr($junsonlanguage,"Mapping User Level")."</a></td>";
	echo "  <td><a href='grouplevel.php' target='_blank'>".GetLangStr($junsonlanguage,"Mapping Group Level")."</a></td>";
	echo "  <td><a href='logout.php' target='_self'>".GetLangStr($junsonlanguage,"Logout")."</a></td>";
	echo " </tr>";
	echo "</table>";

?>
</body>
</HTML>
