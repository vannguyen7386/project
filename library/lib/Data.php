<?php


class Data {
    
    public static function _db(){
        $config = include APPLICATION_PATH . "/configs/config.php";
        if (!($db = Zend_Db_Table::getDefaultAdapter())){
            $db = Zend_Db::factory($config['Adapter'], $config['db']);
            $db->setFetchMode(Zend_Db::FETCH_BOTH);
            Zend_Db_Table::setDefaultAdapter($db);
        }else{
            $db = Zend_Db_Table::getDefaultAdapter();
            
        }
        return $db;
    }
    
}
?>
