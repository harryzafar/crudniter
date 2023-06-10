<?php
class Home extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('user')){
            $this->session->set_flashdata('loginError', "Please Login First");
            redirect(base_url());

        }
        $this->load->MODEL('User_Model');
    }
    public function index(){
        $data['rows'] = $this->User_Model->read();
        $this->load->view('home', $data);
    }

    public function create(){
        $filename = $_FILES['img']['name'];
        if(empty($filename)){ // if insert only data not image
            $formdata = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('desc'),
            ];
            $insert = $this->User_Model->insert($formdata);
            if($insert){
                $this->session->set_flashdata('success', "Note Added Successfully");
                redirect(base_url('home'));
            }else{
                $this->session->set_flashdata('alert', "Error! Note Not Added");
                redirect(base_url('home'));
            }
           
        }
        else{ //if insert with file

            $config['upload_path']          =  "./public/";
            $config['allowed_types']        = 'gif|jpg|jpeg|png';

            $this->load->library('upload', $config);
           if($this->upload->do_upload('img')){ //if upload done
            $upload_data = $this->upload->data();
            $formdata = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('desc'),
                'image' => $upload_data['file_name']
            ];
            $insert = $this->User_Model->insert($formdata);
            if($insert){
                $this->session->set_flashdata('success', "Note Added Successfully");
                redirect(base_url('home'));
            }else{
                $this->session->set_flashdata('alert', "Error! Note Not Added");
                redirect(base_url('home'));
            }
           }
           else{ //if not upload
            $upload__error = $this->upload->display_errors();
            $this->session->set_flashdata('alert', $upload__error);
            redirect(base_url('home'));
           }
        }
        
        
    }
  
    public function edit($id){
        $data['row'] = $this->db->get_where('crudniter', array('id'=> $id))->row_array();
        $this->load->view('edit', $data);

    }
    public function update($id){
        $row = $this->db->get_where('crudniter', array('id'=> $id))->row_array();
        $filename = $_FILES['img']['name'];
        if(empty($filename)){ // if insert only data not image
            
            $formdata = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('desc'),
            ];
            $update = $this->User_Model->update($id, $formdata);
            if($update){
                $this->session->set_flashdata('success', "Note Updated Successfully");
                redirect(base_url('home'));
            }else{
                $this->session->set_flashdata('alert', "Error! Note Not Updated");
                redirect(base_url('home'));
            }
           
        }
        else{ //if insert with file

             //delete old image
             if(file_exists('./public/'.$row['image'])){
                unlink('./public/'.$row['image']);
            }

            $config['upload_path']          =  "./public/";
            $config['allowed_types']        = 'gif|jpg|jpeg|png';

            $this->load->library('upload', $config);
           if($this->upload->do_upload('img')){ //if upload done
            $upload_data = $this->upload->data();
            $formdata = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('desc'),
                'image' => $upload_data['file_name']
            ];
            $update = $this->User_Model->update($id, $formdata);
            if($update){
                $this->session->set_flashdata('success', "Note Updated Successfully");
                redirect(base_url('home'));
            }else{
                $this->session->set_flashdata('alert', "Error! Note Not Updated");
                redirect(base_url('home'));
            }
           }
           else{ //if not upload
            $upload__error = $this->upload->display_errors();
            $this->session->set_flashdata('alert', $upload__error);
            redirect(base_url('home'));
           }
        }
    }
    public function delete($id){
        $row = $this->db->get_where('crudniter', array('id'=> $id))->row_array(); //fetch id data from database
        
        //delete file into directory
        if(file_exists('./public/'.$row['image'])){
            unlink('./public/'.$row['image']);
        }
        //delete record from database
        $delete = $this->User_Model->delete($id);
        if($delete){
            $this->session->set_flashdata('success', 'Notes Deleted Successfully');
            redirect(base_url('home'));
        }
        else{
            $this->session->set_flashdata('alert', 'Notes not Deleted');
            redirect(base_url('home'));
        }

    }
}
?>