<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        if ($this->_helper->FlashMessenger->hasMessages()) {
            $this->view->messages = $this->_helper->FlashMessenger->getMessages();
            $messages = $this->_helper->flashMessenger->getMessages();
            if(!empty($messages)){
                $this->_helper->layout->getView()->message = $messages[0];
            }            
        }
    }

    public function indexAction()
    {
        $user = new Application_Model_User();
        $form = new Application_Form_UserForm();
        $this->view->form = $form;
        
        if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getPost())){
                $data = $form->getValues();
                $data['password'] = md5($data['password']);
                $user->save($data);
                $this->_helper->flashMessenger->addMessage(var_dump($data));
                $this->redirect('/');
            }
        }
    }


}

