<?php

class Register extends CI_Controller
{
    public function index()
    {
        $this->load->view('register');
    }

    public function registerIt()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'First name', 'required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('email_one', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('email_two', 'Email confirmation', 'required|valid_email|matches[email_one]');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[5]|max_length[12]');


        $this->load->library('form_validation');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register');
        } else {
            $this->load->model('User');
            $this->User->insert_entry();
            $this->load->view('formsuccess');
        }
    }
}