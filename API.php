<?php
date_default_timezone_set("Asia/Bangkok");
$sToken = "LINE TOKEN";
$blynktoken="BLYNK TOKEN";
$texttime = array( "ตอนเช้า", "ตอนสาย", "ตอนเที่ยง", "ตอนบ่าย", "ตอนเย็น", "ตอนค่ำ", "ตอนดึก" );
$numtime = date( "G.i" );

if ( $numtime >= "5.00" && $numtime <= "7.59" ) {
	$sn = "0"; 
}else if ( $numtime >= "8.00" && $numtime <= "10.59" ) { 
	$sn = "1"; 
}else if ( $numtime >= "11.00" && $numtime <= "12.59" ) { 
	$sn = "2"; 
}else if ( $numtime >= "13.00" && $numtime <= "16.59" ) { 
	$sn = "3"; 
}else if ( $numtime >= "17.00" && $numtime <= "18.59" ) { 
	$sn = "4"; 
}else if ( $numtime >= "19.00" && $numtime <= "19.59" ) { 
	$sn = "5"; 
}else if ( $numtime >= "20.00" && $numtime <= "23.59" ) { 
	$sn = "6"; 
}else if ( $numtime >= "00.00" && $numtime <= "4.59" ) { 
	$sn = "6"; 
}

if($_GET[action]=="on_light"){
	//เปิดไฟเมื่อกลับบ้าน
	//เช็คก่อนว่าช่วงเวลาไหน
	if($sn>="4" and $sn <="6"){
		//ช่วง 5โมงเย็นถึง ตี5
		//เปิดไฟนอกบ้านและในบ้าน 
		//ไฟหน้าห้องน้ำ
		$light_1 = "http://blynk-cloud.com/$blynktoken/update/V106?value=1";
		$show_light_1 = json_decode(file_get_contents($light_1), true); 
		//ไฟรั้ว
		$light_2 = "http://blynk-cloud.com/$blynktoken/update/V100?value=1";
		$show_light_2 = json_decode(file_get_contents($light_2), true);
		//ไฟโรงรถ
		$light_3 = "http://blynk-cloud.com/$blynktoken/update/V101?value=1";
		$show_light_3 = json_decode(file_get_contents($light_3), true);
		//ไฟห้องนั่งเล่น
		$light_4 = "http://blynk-cloud.com/$blynktoken/update/V102?value=1";
		$show_light_4 = json_decode(file_get_contents($light_4), true);  
		
	$sMessage = "ต้อนรับกลับบ้าน เปิดไฟให้แล้ว!!";
	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
	$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
	curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $chOne ); 
	}
}
if($_GET[action]=="off_light"){
 		//ปิดไฟตลอดเวลาถ้าออกจากบ้าน
		//ไฟหน้าห้องน้ำ
		$light_1 = "http://blynk-cloud.com/$blynktoken/update/V106?value=0";
		$show_light_1 = json_decode(file_get_contents($light_1), true); 
		//ไฟรั้ว
		$light_2 = "http://blynk-cloud.com/$blynktoken/update/V100?value=0";
		$show_light_2 = json_decode(file_get_contents($light_2), true);
		//ไฟโรงรถ
		$light_3 = "http://blynk-cloud.com/$blynktoken/update/V101?value=0";
		$show_light_3 = json_decode(file_get_contents($light_3), true);
		//ไฟห้องนั่งเล่น
		$light_4 = "http://blynk-cloud.com/$blynktoken/update/V102?value=0";
		$show_light_4 = json_decode(file_get_contents($light_4), true);  
		
	$sMessage = "ปิดไฟทั้งบ้านให้หมดแล้ว!!!";
	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
	$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
	curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $chOne ); 
 
}
?>
