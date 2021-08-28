<?php
/* https://gist.github.com/JonathanRowley/4721830 */
if (!extension_loaded('mssql') && extension_loaded('sqlsrv')) {

  function mssql_connect($server = "XXXXXX",$mssqlUser = "XXXXXX",$mssqlPassword = "XXXXXX",$bool = true){		
		$connectionInfo = array("CharacterSet" => "UTF-8", "UID" => $mssqlUser, "PWD" => $mssqlPassword);
		$GLOBALS['sqlsrvConnection'] = sqlsrv_connect($server,$connectionInfo);
		mssql_last_link($GLOBALS['sqlsrvConnection']);
		return $GLOBALS['sqlsrvConnection'];
	}

	function mssql_last_link($link_identifier = null) {
    	static $last = null;
	    if ($link_identifier) {
	        $last = $link_identifier;
	    }
	    	return $last;
	}
	function mssql_select_db($db, $link=""){
		$qry = "USE ".$db;
		return sqlsrv_query($GLOBALS['sqlsrvConnection'], $qry);
	}
	function mssql_query($qry, $rubbish= ""){
		//if((strrpos($qry, 'INSERT') !== false) || (strrpos($qry, 'DELETE') !== false) || (strrpos($qry, 'UPDATE') !== false)){
		return sqlsrv_query($GLOBALS['sqlsrvConnection'], $qry);
	}
	function mssql_fetch_array($result, $resultType = SQLSRV_FETCH_BOTH){
		switch ($resultType){
			case 'MSSQL_BOTH' : $resultType = SQLSRV_FETCH_BOTH;
			break;
			case 'MSSQL_NUM': $resultType = SQLSRV_FETCH_NUMERIC;
			break;
			
			case 'MSSQL_ASSOC': $resultType = SQLSRV_FETCH_ASSOC;
			break;
		}	
		return sqlsrv_fetch_array($result, $resultType);
	}
	function mssql_num_rows($result){
		return sqlsrv_num_rows($result);
	}
	function mssql_fetch_object($result){
		return sqlsrv_fetch_object ($result);
	}
	// Extend by Sebijk
	function mssql_close($connection_id) {
		return sqlsrv_close($connection_id);
	}
	function mssql_fetch_assoc($result){
		return sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
	}
	function mssql_fetch_row($result){
		return sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC);
	}
	function mssql_free_result($result) {
		unset($result);
	}
	function mssql_free_statement($result) {
		return sqlsrv_free_stmt($result);
	}
	function mssql_get_last_message() {
		return sqlsrv_errors();
	}
	function mssql_num_fields($result) {
		return sqlsrv_num_fields($result);
	}
	function mssql_rows_affected($result) {
		return sqlsrv_rows_affected($result);
	}
	function mssql_next_result($result) {
		return sqlsrv_next_result($result);
	}
	function mssql_result($resource, $idnumber, $field) {
		$i = 0;
		while ($row = sqlsrv_fetch_array($resource, SQLSRV_FETCH_BOTH)) {
				$rows[$i] = $row;
				$i++;
			}
		return $rows[$idnumber][$field];
	}
}