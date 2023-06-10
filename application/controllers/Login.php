<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


    public function __construct(){
        parent::__construct();
        $this->load->MODEL('Authentication');
        $this->load->library('form_validation');
    }

     public function check_email($data){
        $result = $this->db->get_where('users', array('email' => $data));
        if($result->num_rows() == 1){
         return true;
        }else{
         return false;
        }
     }

	public function index()
	{
    
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if($this->form_validation->run()== true){
            $email = $this->input->post('email');
            if($this->check_email($email)){   //call check_mail function to check mail is valid or not
                $formdata = [
                    'email'=> $email,
                    'password' => $this->input->post('password')
                ];
                $username = $this->Authentication->login($formdata);
                if($username !== false){
                    $this->session->set_userdata('user', $username);
                    redirect(base_url('home'));
                }
                else{
                    $this->session->set_flashdata('loginError', 'Incorrect Email or Password');
                }
            }
            else{
                $this->session->set_flashdata('loginError', 'Invalid Email ID');
            }
        }


		$this->load->view('login');
	}
    public function register(){
        
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]', array('is_unique'=> 'This %s is already exist'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if($this->form_validation->run()==true){
            $password = $this->input->post('password');
            $hass_pass = password_hash($password, PASSWORD_DEFAULT);
            $formdata = [
                'name'=> $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => $hass_pass
            ];

           $register =  $this->Authentication->register($formdata);
           if($register == true){
            $this->session->set_flashdata('registration', "Registration successfully");
            redirect('login');
           }
        }
       
        $this->load->view('register');
    }

    public function logout(){
        $this->session->unset_userdata('user');
        redirect(base_url('login'));
    }
}
