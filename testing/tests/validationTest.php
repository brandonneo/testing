
<?php
// imports for functions.
require_once __DIR__ . ('/../../functions/sanitize_functions.php');
require_once __DIR__ . ('/../../functions/validation_functions.php');

class validationTest extends \PHPUnit\Framework\TestCase {
    public function testNoCommonPasswordFunction(){
        $common_pass = "password";
        $NotACommonPassword = noCommonPass($common_pass);
        
        $this-> assertFalse($NotACommonPassword); // false as it is infact common
    }
}