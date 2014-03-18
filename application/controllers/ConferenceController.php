<?php

class ConferenceController extends Zend_Controller_Action
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
    public function indexAction(){
        
           
    }
    
    public function newAction(){
        
        $form = new Application_Form_ConferenceForm();
        $this->view->form = $form;
        if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getPost())){
                $data = $form->getValues();
                $data['date'] = strtotime($data['date']);
                $conf = new Application_Model_Conference();
                if($data['user_id']==$data['participant_id']){                    
                   $this->_helper->flashMessenger->addMessage('выберите разных пользователей');
                   $this->redirect('/conference/new');
                }
                if($conf->getByDate($data['date'], $data['user_id'], $data['participant_id'])){
                    
                }
                else {
                   $this->_helper->flashMessenger->addMessage('один из участников будт занят в это время');
                   $this->redirect('/conference/new');
                }
            }
        }
    }
    
}
