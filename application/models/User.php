<?php 
class Application_Model_User extends Application_Model_Model {
	
	protected $_dbtable = 'Users';
	
	public function save($data){
		
		$this->getDbTable()->insert($data);
		
	}
        
        public function delete($id){
            $data = array();
            $data['status'] = 'deleted';
            $where = $this->getDbTable()->getAdapter()->quoteInto('id = ?', $id);
            $this->getDbTable()->update($data, $where);
        }
	
        public function userlist(){
            
            $where = $this->getDbTable()->select()->from(array('u'=>'users'), array('u.name as name', 'u.lastname as lastname', 'COUNT(c.user_id) as usercount', 'COUNT(c.participant_id) as participantcount'))->setIntegrityCheck(false)->joinLeft(array('c'=>'conferences'), 'u.id = c.user_id')->where('u.status = ? ', 'active')->group('u.id');
            $result = $this->getDbTable()->fetchAll($where);
            return $result;
        }
        
        public function users(){
            
            $where = $this->getDbTable()->select()->where('status = ?', 'active');
            $result = $this->getDbTable()->fetchAll($where);
            if ($result){
              return $result->toArray();
            }
            else {
                return array();               
            }
        }
}
