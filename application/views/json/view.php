<?php
header("Content-type:application/json;charset=utf-8");
if( $code == 0 )
{
	$array = array();
	$array['error_code'] = 0;
	$array['value'] = $json;
	echo json_encode( $array );
}
else
{
	$array = array();
	$array['error_code'] = intval($code);
	$array['error_message'] = $message;
	echo json_encode( $array );
}

?>