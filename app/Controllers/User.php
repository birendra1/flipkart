<?php


namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class User extends Controller
{
  function index(){
    $this->load->model('User_model');
    $users = $this->User_model->all();
    $data = array();
    $data['users']  = $users;
    $this->load->view('list',$data);
  }

   function create() {
       $this->load->model('User_model');
       $this->form_validation->set_rules('name', 'Name', 'required');
       $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
       $this->form_validation->set_rules('password', 'Password', 'required');
       $this->form_validation->set_rules('user_type', 'UserType', 'required');
       $this->form_validation->set_rules('mobile', 'Mobile', 'required');
       
       
       if ($this->form_validation->run() == FALSE) {
           # code...
           $this->load->view('create');
       } else {
           # save record in database
            $formarray = array();
            $formarray['name'] = $this->input->post('name');
            $formarray['email'] = $this->input->post('email');
            // $formarray['created_at'] = date('Y-m-d');
            $this->User_model->create($formarray);
            $this->session->set_flashdata('success','Record added successfully');
            
            redirect(base_url().'index.php/user/index');
            

       }
       



    //    $this->load->view('create');
    }

    function edit($userId){
        $this->load->model('User_model');
        $user= $this->User_model->getUser($userId);
        $data = array();
        $data['user'] = $user;

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
       
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('edit',$data);
        } else {
            # code...
            // dd("This page");
            $formarray = array();
            $formarray['name'] = $this->input->post('name');
            $formarray['email'] = $this->input->post('email');
            $this->User_model->updateUser($userId,$formarray);
            $this->session->set_flashdata('success', 'Record updated successfully');
            
            redirect(base_url().'index.php/user/index');

            
        }
        

        // $this->load->view('edit',$data);
    }

    function delete($userId){
        // print_r("here");
        $this->load->model('User_model');
        $user= $this->User_model->getUser($userId);

        if(empty($user)){
            $this->session->set_flashdata('failure','Record not found in database');
            
            redirect(base_url().'index.php/user/index');
            
        }
        $this->User_model->deleteUser($userId);
        $this->session->set_flashdata('success','Record deleted Successfully');

        
         redirect(base_url().'index.php/user/index');
        

    }
}




?>