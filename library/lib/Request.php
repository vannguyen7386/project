<?php
function get($key, $default = null){
    $request = new Zend_Controller_Request_Http();
    if ($request->get($key))
        return $request->get($key);
    else
        return $default;
}
?>
