<?php
header("Content-type:application/json;charset=utf-8");
if( $code == 0 )
{
	$array = array(
		'error_code' => 0,
		'sEcho' => isset($_REQUEST['sEcho'])? intval($_REQUEST['sEcho']):0,
		'iTotalRecords' => $iTotal,
		'iTotalDisplayRecords' => $iFilteredTotal,
		'aaData' => $aaData
	);
	echo json_encode( $array );
}
else
{
	$array = array();
	$array['error_code'] = intval($code);
	if(isset($message))
	{
		$array['error_message'] = $message;
	}
	else
	{
		$array['error_message'] = 'null';
	}

	$array['sEcho']=isset($_REQUEST['sEcho'])?$_REQUEST['sEcho']:0;
	$array['iTotalRecords']=0;
	$array['iTotalDisplayRecords']=0;
	$array['aaData']=array();
	echo json_encode( $array );
}

?>