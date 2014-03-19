<?php
class UsersController extends Zend_Controller_Action
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
                $this->_helper->flashMessenger->addMessage('пользователь добавлен');
                $this->redirect('/');
            }
        }
    }
    public function deleteuserAction(){
        
        $user = new Application_Model_User();
        $id = $this->_getParam('id')*1;
        $user->delete($id);
        $this->_helper->flashMessenger->addMessage('пользователь удален');
        $this->redirect('/');
        
    }
    public function userlistAction(){
        
        $user = new Application_Model_User();
        $users = $user->userlist();
        $paginator = new Zend_Paginator($users); 
        $paginator->setItemCountPerPage(5)->setPageRange(5)->setCurrentPageNumber($this->getParam('page', 1));
        $this->view->users = $users;
        $this->view->paginator = $paginator;
        $this->view->userlist = $users;
    }
    public function editAction(){
        $id = $this->_getParam('id')*1;
        $this->view->id = $id;
        $form = new Application_Form_UserForm();
        $users = new Application_Model_User();
        $user = $users->getById($id);
        $form->populate($user);
        $this->view->form = $form;
    }
    
}

