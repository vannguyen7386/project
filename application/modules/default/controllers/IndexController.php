<?php
class IndexController extends Zend_Controller_Action {
 
    public function indexAction(){
        $this->view->headTitle("First Demo Of Zend");
        $options = array(
            'layout' => "layout",
            'layoutPath' => APPLICATION_PATH . "/layout/scripts"
        );
        Zend_Layout::startMvc($options);
        $baseurl = $this->_request->getbaseurl();  
        $data = array(
            'name' => 'Zend Framework For Beginner', 
            'price' => 200
        );
        $this->view->products = $data;
        $this->view->headLink()->appendStylesheet($baseurl . "/public/style/css/style1.css");
        $this->view->headScript()->appendFile($baseurl . "/public/style/js/script.js");
        $registry = new Zend_Registry();
        $registry->set('index', 12);
    }
    
    //Call other view
    public function demoAction(){     
        $options = array(
            layout => "layout",
            layoutPath => APPLICATION_PATH . "/layout/scripts"
        );
        Zend_Layout::startMvc($options);
        $this->view->hello = "Hello World!!! This is demo Action";
        
    }
    
    public function productAction(){
        $this->getLayout();
        $users = Data::_db()->fetchAll("SELECT * FROM `users` WHERE `username` LIKE ?", array('%a%'));
        $this->view->users = $users;
    }
    
    private function getLayout(){
        $options = array(
            'layout' => "layout",
            'layoutPath' => APPLICATION_PATH . "/layout/scripts"
        );
        Zend_Layout::startMvc($options);
    }
}
?>
