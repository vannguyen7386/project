<?php

class User_IndexController extends Zend_Controller_Action {

    final public function preDispatch() {
        Zend_Layout::startMvc(array(
            'layout' => 'layout',
            'layoutPath' => APPLICATION_PATH . "/layout/scripts"
        ));
    }

    public function indexAction() {
        $users = $this->listUsers();
        $this->view->users = $users;
    }

    private function listUsers() {
        $users = Data::_db()->fetchAll("SELECT * FROM `users`");
        return $users;
    }

    public function editAction() {
        Zend_Layout::resetMvcInstance();
        $ID = $this->getRequest()->getParam('ID', 0);
        $isPost = $this->getRequest()->isPost();

        if ($ID > 0) {
            $use = Data::_db()->fetchRow("SELECT * FROM `users` WHERE `ID`=?", array($ID));
            if (!$isPost) {
                $this->view->user = $use;
            } else {
                $data = array();
                $data['username'] = $this->getRequest()->getParam('username');
                $data['password'] = $this->getRequest()->getParam('password');
                $db = Data::_db();
                try {
                    $db->beginTransaction();
                    $db->update("users", $data, "`ID`='{$ID}'");
                    $db->commit();
                } catch (Exception $e) {
                    $db->rollBack();
                }
                $this->redirect("/user");
            }
        }
    }

    public function addAction() {
        $isPost = $this->getRequest()->isPost();
        if ($isPost) {
            $data = array();
            $data['username'] = $this->getRequest()->getParam('username');
            $data['password'] = $this->getRequest()->getParam('password');
            $db = Data::_db();
            $db->beginTransaction();
            $db->insert("users", $data);
            $db->commit();
            $this->redirect("/user");
        }
    }

    public function deleteAction() {
        $ids = $this->getRequest()->getParam('ID', 0);
        if (!is_array($ids)) {
            $ids = (array) $ids;
        }
        $filter = array_filter($ids, "ctype_digit");
        if (count($filter) == 0) {
            
        }
        $ids = implode(',', $ids);
        $db = Data::_db();
        $db->beginTransaction();
        $db->delete("users", "`ID` IN ({$ids})");
        $db->commit();
        $this->redirect("/user");
    }

    public function loadAction() {
        Zend_Layout::resetMvcInstance();
    }

}

?>
