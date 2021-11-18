<?php 

function noCommonPass($post_pass){
	$keyFile = fopen("assets/common-keys.txt", "r");
	if ($keyFile) {
		while (($line = fgets($keyFile)) !== false) {
            // process the line read.
			$line=str_replace("\n","",$line);
			if($line == $post_pass){
				// FAIL CASE: password is a common password
				return false;
			}
		}

        // PASS case: All lines read and no common password match!
		return true;
		fclose($keyFile);
	} else {
        // File error.
		return false;
	} 
}

function alpha_regex($data) {
	return preg_match('/^[a-zA-Z ]{1,256}$/', $data);
}

function num_regex($data) {
	return preg_match('/^[\d]{1,256}$/', $data);
}

function money_regex($data) {
	return preg_match('/^\\$?(([1-9](\\d*|\\d{0,2}(,\\d{3})*))|0)(\\.\\d{1,2})?$/', $data);
}

function alphanum_regex($data) {
	return preg_match('/^[a-zA-Z \d]{1,256}$/', $data);
}

function alphanumspec_regex($data) {
	return preg_match('/^[a-zA-Z \d\W]{1,256}$/', $data);
}

function username_regex($data) {
	return preg_match('/^[a-zA-Z ]{1,30}$/', $data);
}

function pw_regex($data) {
	return preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/', $data);
}

function credit_card_date_regex($data) {
	return preg_match('/^(0[1-9]|1[0-2]) ?\/? ?([0-9]{4}|[0-9]{2})$/', $data);
}

function credit_card_num_regex($data) {
	return preg_match('/^[\d ]{1,32}$/', $data);
}

function sanitize_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$data = RemoveXSS($data);
	return $data;
}

function RemoveXSS($val) {
	preg_replace('/<[^>]*>/', '', $val);
	str_replace(array("\r\n", "\r", "\n", "\t"), '', $val);
	$val = preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $val);

	$search = 'abcdefghijklmnopqrstuvwxyz';
	$search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$search .= '1234567890!@#$%^&*()';
	$search .= '~`";:?+/={}[]-_|\'\\';

	for ($i = 0; $i < strlen($search); $i++) {
		$val = preg_replace('/(&#[x|X]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val);
		$val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val);
	}

	$ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
	$ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');

	$ra = array_merge($ra1, $ra2);
	$found = true;
	while ($found == true) {
		$val_before = $val;
		for ($i = 0; $i < sizeof($ra); $i++) {
			$pattern = '/';
			for ($j = 0; $j < strlen($ra[$i]); $j++) {
				if ($j > 0) {
					$pattern .= '(';
					$pattern .= '(&#[x|X]0{0,8}([9][a][b]);?)?';
					$pattern .= '|(&#0{0,8}([9][10][13]);?)?';
					$pattern .= ')?';
				}
				$pattern .= $ra[$i][$j];
			}
			$pattern .= '/i';
			$replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag
			$val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
			if ($val_before == $val) {
				$found = false;
			}
		}
	}
	return $val;
}

?>