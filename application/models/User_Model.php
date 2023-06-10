<?php
class User_Model extends CI_Model{

    public function read(){
       $rows = $this->db->get('crudniter')->result_array();
       return $rows;
    }

    public function insert($data){
      $result = $this->db->insert('crudniter', $data);
      if($result){
        return true;
      }
      else{
        return false;
      }
    }

    public function update($id, $formdata){
      $this->db->where('id', $id);
      $result = $this->db->update('crudniter', $formdata);
      if($result){
        return true;
      }
      else{
        return false;
      }
    }

    public function delete($id){
      $this->db->where('id', $id);
      $result = $this->db->delete('crudniter');
      if($result){
        return true;
      }
      else{
        return false;
      }
    }
}
?>