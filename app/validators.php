
<?php

Validator::extend('alpha_custom', function($attribute, $value)
{
    return preg_match('/^[0-9a-zA-Z\@\*\_\-\+\.]+$/', $value);
});

Validator::extend('alpha_spaces', function($attribute, $value)
{
    return preg_match('/^[0-9a-zA-Z\À\Á\Â\Ã\Ä\Å\Æ\Ç\È\É\Ê\Ë\Ì\Í\Î\Ï\Ð\Ñ\Ò\Ó\Ô\Õ\Ö\Ø\Ù\Ú\Û\Ü\Ý\Þ\ß\à\á\â\ã\ä\å\æ\ç\è\é\ê\ë\ì\í\î\ï\ð\ñ\ò\ó\ô\õ\ö\ù\ú\û\ü\ý\ø\þ\ÿ\Ð\d\Œ\-\s]+$/', $value);
    
});  

?>