<?php
// Bu satiri kendinize gore duzenleyiniz mysqli("mysql sunucu", "kullanici adi", "parola", "veritabani adi")
$mysqli = new mysqli("localhost", "root", "", "demo") or die("Veritabani Bulunamadi veya Baglanilamadi");
$mysqli->set_charset("utf8");
$mysqli->query("SET COLLATION_CONNECTION = �utf8_unicode_ci�");

$sorgula = $mysqli->query("SELECT * FROM notification WHERE notif='1'");
if ($sorgula->num_rows > 0){
	while ($veri = $sorgula->fetch_assoc()){
		if($veri['notif'] == '1'){
			echo '<div id="alerts">
			<audio id="audioplayer" autoplay=true>
			<source src="sound/glass.mp3" type="audio/mpeg">
			Tarayiciniz ses elementlerini desteklemiyor. </audio>
			<li>
			<img src="icons/no.png" align="top" style="float:left; margin-right:2px;" />
			<div><strong>Yeni Mesaj Var</strong><br /> <i>'.$veri['konu'].'</i><br />  </div> '.$veri['mesaj'].'
			</li>
			</div>';
			$mysqli->query("UPDATE notification SET notif='0' WHERE id=".$veri['id']." ");
		}else {

		}
	}
}
?>