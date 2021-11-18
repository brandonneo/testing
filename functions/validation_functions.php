<?php
    require_once('./functions/sanitize_functions.php');

    //string item validate
    function alphaValidate($string, &$errormsg, &$stringbool){
        //username validation
        $var_alpha = "";
        if (empty($string)) {
            $errormsg .= "Error, text is empty. <br>";
            $stringbool = false;
        } else {
            $var_alpha = sanitize_input($string);

            //check for illegal characters in name
            if (!alpha_regex($string)) {
                $errormsg .= "Invalid alpha in text! <br>";
                $stringbool = false;
            }
        } //end else
        return $var_alpha;
    }

    function numValidate($num, &$errormsg, &$numbool){
        $var_num = "";
        if (empty($num)) {
            $errormsg .= "Error, number is empty. <br>";
            $numbool = false;
        } else {
            $var_num = sanitize_input($num);

            //check for illegal characters in name
            if (!num_regex($num)) {
                $errormsg .= "Invalid numbers in text! <br>";
                $numbool = false;
            }
        } //end else
        return $var_num;
    }
    
    function sizeValidate($num, &$errormsg, &$numbool){
        $var_num = "";
        if (empty($num)) {
            $errormsg .= "Error, number is empty. <br>";
            $numbool = false;
        } else {
            $var_num = sanitize_input($num);

            //check for illegal characters in name
            if (!num_regex($num)) {
                $errormsg .= "Invalid numbers in text! <br>";
                $numbool = false;
            }
        } //end else
        return $var_num;
    }
    function creditCardDateValidate($num, &$errormsg, &$numbool){
        $var_num = "";
        if (empty($num)) {
            $errormsg .= "Error, card date is empty. <br>";
            $numbool = false;
        } else {
            $var_num = sanitize_input($num);

            //check for illegal characters in name
            if (!credit_card_date_regex($num)) {
                $errormsg .= "Invalid card date in text! <br>";
                $numbool = false;
            }
        } //end else
        return $var_num;
    }

    function creditCardNumValidate($num, &$errormsg, &$numbool){
        $var_num = "";
        if (empty($num)) {
            $errormsg .= "Error, card number is empty. <br>";
            $numbool = false;
        } else {
            $var_num = sanitize_input($num);

            //check for illegal characters in name
            if (!credit_card_num_regex($num)) {
                $errormsg .= "Invalid card num in text! <br>";
                $numbool = false;
            }
        } //end else
        return $var_num;
    }

    function moneyValidate($num, &$errormsg, &$numbool){
        $var_num = "";
        if (empty($num)) {
            $errormsg .= "Error, money is empty. <br>";
            $numbool = false;
        } else {
            $var_num = sanitize_input($num);

            //check for illegal characters in name
            if (!money_regex($num)) {
                $errormsg .= "Invalid money format in text! <br>";
                $numbool = false;
            }
        } //end else
        return $var_num;
    }

    function alphaNumValidate($string, &$errormsg, &$stringbool){
        $var_alphanum = "";
        if (empty($string)) {
            $errormsg .= "Error, text is empty. <br>";
            $stringbool = false;
        } else {
            $var_alphanum = sanitize_input($string);

            //check for illegal characters in name
            if (!alphanum_regex($string)) {
                $errormsg .= "Invalid alpha-number in text! <br>";
                $stringbool = false;
            }
        } //end else
        return $var_alphanum;
    }

    function alphaNumSpecValidate($string, &$errormsg, &$stringbool){
        $var_alphanumspec = "";
        if (empty($string)) {
            $errormsg .= "Error, text is empty. <br>";
            $stringbool = false;
        } else {
            $var_alphanumspec = sanitize_input($string);

            //check for illegal characters in name
            if (!alphanumspec_regex($string)) {
                $errormsg .= "Invalid characters in text! <br>";
                $stringbool = false;
            }
        } //end else
        return $var_alphanumspec;
    }
    
    // Username Validation
    function usernameValidate($userName, &$errormsg, &$regOKbool){
        $var_userName = "";
        if (empty($userName)) {
            $errormsg .= "Error, username is empty. <br>";
            $regOKbool = false;
        } else {
            $var_userName = sanitize_input($userName);

            //check for illegal characters in name
            if (!username_regex($userName)) {
                $errormsg .= "Invalid characters in username! <br>";
                $regOKbool = false;
            }
        } //end else
        return $var_userName;
    }

    // Email Validation
    function emailValidate($email, &$errormsg, &$regOKbool){
        //code block for email validation
        $var_email = "";
        if (empty($email)) {
            $errormsg .= "Error, email is empty. <br>";
            $reg_OKbool = false;
        } else {
            $var_email = sanitize_input($email);

            // Additional check to make sure e-mail address is well-formed.
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errormsg .= "Error, e-mail is invalid. <br>";
                $reg_ok = false;
            }
            // if (strlen($email) > 50) {
            //     $errormsg .= "Error, e-mail is longer than 50 characters. <br>";
            //     $regOKbool = false;
            // }
        }// end else

        return $var_email;
    }

    // Password Validation for Registration Page
    function passRegValidate($pw,$pwRe,&$errormsg, &$regOKbool){
        //code block for password validation
        $var_pw = "";
        if (empty($pw) or empty($pwRe)) {
            $errormsg .= "Error, password is empty. <br>";
            $regOKbool = false;
        } else {
            $var_pw = sanitize_input($pw);
            // $var_pwRe = sanitize_input($pwRe);

            if (!pw_regex($pw) || !pw_regex($pwRe) || strlen($pw) < 12 or strlen($pwRe) < 12) {
                $errormsg .= "Error, password is Invalid. (At least 12 characters, an upper and lowercase character (abc,ABC)";
                $errormsg .= ", a number (1,2,3...) and a special character(!,@,#..)) <br>";
                $regOKbool = false;
            }
            if(!noCommonPass($_POST["pw"])){
                $errormsg .= "Error, the password: " . $pw . ", is a common password. <br>";
                $regOKbool = false;
            }
            if ($pw != $pwRe) {
                $errormsg .= "Error, the passwords that you have entered do not match. <br>";
                $regOKbool = false;
            }
        }// end else
        return $var_pw;
    }

    // Password Validation for Login Page
    function passLogValidate($pw,&$errormsg, &$regOKbool){
        //code block for password validation
        $var_pw = "";
        if (empty($pw)) {
            $errormsg .= "Error, password is empty. <br>";
            $regOKbool = false;
        } else {
            $var_pw = sanitize_input($pw);

            if (!pw_regex($pw) || strlen($pw) < 12) {
                $errormsg .= "Error, password is Invalid. (At least 12 characters, an upper and lowercase character (abc,ABC)";
                $errormsg .= ", a number (1,2,3...) and a special character(!,@,#..)) <br>";
                $regOKbool = false;
            }
        }// end else
        return $var_pw;
    }

    function fileValidate($uploadfilename, &$errormsg, &$filebool){  
        $filename = $_FILES[$uploadfilename]['tmp_name']; 
        echo "<script type='text/javascript'>alert('$filename');</script>"; 
    }