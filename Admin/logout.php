<?php
error_reporting(0);
session_destroy();
echo "
			<script>
			alert('Anda Telah Keluar');
			window.location = '../index.php'
			</script>
	";

?>