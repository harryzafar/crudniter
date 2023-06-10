<?php
class Authentication extends CI_Model{
    public function login($data){
     $row = $this->db->get_where('users', array('email' => $data['email']))->row_array();
      $hass_pass = $row['password'];
      if(password_verify($data['password'], $hass_pass)){
        $username = $row['name'];
        return $username;
      }
      else{
         return false;
      }
      
    }

    public function register($data){
       $result =  $this->db->insert('users', $data);
       if($result){
        return true;
       }
    }
}
?>