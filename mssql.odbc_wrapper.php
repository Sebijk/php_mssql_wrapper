<?php
/* mssql to odbc wrapper
 * written by Sebijk */
if (!extension_loaded('mssql') && extension_loaded('odbc')) {
 define('MSSQL_DRIVER', 'Driver={ODBC Driver 17 for SQL Server}'); // ODBC Driver
 define('DATABASE', 'DATABASENAME'); // Set here your Database


	function mssql_connect($servername, $username, $password, $new_link = false) {
		$connection_string = MSSQL_DRIVER.";Server=".$servername.";Database=".DATABASE.";";
		$connection = odbc_connect($connection_string, $username, $password);
		mssql_last_link($connection);
		return $connection;
	}

	function mssql_pconnect($servername, $username, $password, $new_link = false) {
		$connection_string = MSSQL_DRIVER.";Server=".$servername.";Database=".DATABASE.";";
		$connection = odbc_pconnect($connection_string, $username, $password);
		mssql_last_link($connection);
		return $connection;
	}

	function mssql_last_link($link_identifier = null) {
        static $last = null;
        if ($link_identifier) {
            $last = $link_identifier;
        }
        return $last;
	}

	function mssql_close($connection_id) {
		return odbc_close($connection_id);
	}
	function mssql_fetch_array($result, $result_type = 'MSSQL_BOTH') {
		return odbc_fetch_array($result);
	}
	function mssql_fetch_assoc($result) {
		return odbc_fetch_array($result);
	}
	function mssql_fetch_field($field) {
		$link_identifier = mssql_last_link();
		return odbc_result($link_identifier, $field);
	}
	function mssql_fetch_object($result) {
		return odbc_fetch_object($result);
	}
	function mssql_fetch_row($result) {
		return odbc_fetch_row($result);
	}
	function mssql_field_name($result, $offset = null) {
		return odbc_field_name($result,$offset);
	}
	function mssql_field_length($result, $offset = null) {
		return odbc_field_len($result,$offset);
	}
	function mssql_free_result($result) {
		return odbc_free_result($result);
	}
	function mssql_get_last_message() {
		$link_identifier = mssql_last_link();
		return odbc_errormsg($link_identifier);
	}
	function mssql_next_result($result) {
		return odbc_next_result($result);
	}
	function mssql_num_fields($result) {
		return odbc_num_fields($result);
	}
	function mssql_num_rows($result) {
		return odbc_num_rows($result);
	}
	function mssql_query($query, $link_identifier = null, $batch_size = 0) {
		if (is_null($link_identifier)) {
		            $link_identifier = mssql_last_link();
		}
		return odbc_exec($link_identifier, $query);
	}
	function mssql_result($resource, $idnumber, $field) {
		/*for ($i=0; $i < $row; $i++) { 
			if($row<>0) odbc_next_result();
		}
		return odbc_result($resource, $field);*/
		$i = 0;
		if(is_numeric($field)) {
			while ($row = odbc_fetch_row($resource)) {
				$rows[$i] = $row;
				$i++;
			}
		}
		else {
			while ($row = odbc_fetch_array($resource)) {
				$rows[$i] = $row;
				$i++;
			}
		}
		return $rows[$idnumber][$field];
	}
	function mssql_select_db($database_name, $link_identifier = null) {
		if (is_null($link_identifier)) {
		            $link_identifier = mssql_last_link();
		}
		return odbc_exec($link_identifier, "USE ".$database_name);
	}
}
