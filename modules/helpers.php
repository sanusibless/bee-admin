<?php 
function send_mail($sender,$receiver,$subject,$message) {
	mail($receiver, $subject, $message, "From " . $sender)
}

function view(string $filename, array $data) {
	foreach ($data as $key => $value) {
		$$key = $value;
	}

	require __DIR__  . "/" . $filename;
}