<?php
    function replace_contents($filename, $replacements)
    {
        ob_start();                     // start buffering
        include $filename;              // include file
        $buffer = ob_get_contents();    // get contents of buffer
        ob_end_clean();                 // discard buffer contents
        foreach ($replacements as $key => $value) {
            $buffer = str_replace($key, $value, $buffer);
        }
        return $buffer;
    }
?>
