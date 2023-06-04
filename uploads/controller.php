<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *	@author 	: Victor Mashaba
 *	date		: 22 march, 2023
 *	SIgnetBD
 *	sepataka12gmail.com
 */

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        $this->load->library('session');
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

    //Default function, redirects to logged in user area
    public function index() {

        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
            
        if ($this->session->userdata('admin1_login') == 1)
            redirect(base_url() . 'index.php?admin1/dashboard', 'refresh');
        
        if ($this->session->userdata('mentor_login') == 1)
            redirect(base_url() . 'index.php?mentor/dashboard', 'refresh');
            
        if ($this->session->userdata('superadmin_login') == 1)
            redirect(base_url() . 'index.php?superadmin/dashboardx', 'refresh');           
        
        if ($this->session->userdata('admin4_login') == 1)
            redirect(base_url() . 'index.php?admin4/dashboard', 'refresh');
            
        if ($this->session->userdata('admin5_login') == 1)
            redirect(base_url() . 'index.php?admin5/dashboard', 'refresh');
            
        if ($this->session->userdata('tutor_login') == 1)
            redirect(base_url() . 'index.php?tutor/dashboard', 'refresh');
        
        if ($this->session->userdata('science_login') == 1)
            redirect(base_url() . 'index.php?science/dashboard', 'refresh');
            
        if ($this->session->userdata('brightspace_login') == 1)
            redirect(base_url() . 'index.php?brightspace/dashboard', 'refresh');
        
        if ($this->session->userdata('sds_login') == 1)
            redirect(base_url() . 'index.php?sds/dashboard', 'refresh');                   
            
        if ($this->session->userdata('management_login') == 1)
            redirect(base_url() . 'index.php?management/dashboard', 'refresh');
            
        if ($this->session->userdata('art') == 1)
            redirect(base_url() . 'index.php?art/dashboard', 'refresh');
            
        

        if ($this->session->userdata('student_login') == 1)
            redirect(base_url() . 'index.php?student/dashboard', 'refresh');
        
        if ($this->session->userdata('lecturer_login') == 1)
            redirect(base_url() . 'index.php?lecturer/dashboard', 'refresh');
        if ($this->session->userdata('backtest_login') == 1)
            redirect(base_url() . 'index.php?backtest/dashboard', 'refresh');

        if ($this->session->userdata('parent_login') == 1)
            redirect(base_url() . 'index.php?parents/dashboard', 'refresh');
      

        $this->load->view('backend/login');
    }

    //Ajax login function
    function ajax_login() {
        $response = array();

        //Recieving post input of email, password from ajax request
        $email = $_POST["email"];
        $password = $_POST["password"];
        $response['submitted_data'] = $_POST;

        //Validating login
        $login_status = $this->validate_login($email, $password);
        $response['login_status'] = $login_status;
        if ($login_status == 'success') {
            $response['redirect_url'] = '';
        }

        //Replying ajax request with validation response
        echo json_encode($response);
    }
    

    //Validating login from ajax request
    function validate_login($email = '', $password = '') {
        $credential = array('email' => $email, 'password' => $password);


        // Checking login credential for admin
        $query = $this->db->get_where('admin', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('admin_login', '1');
            $this->session->set_userdata('admin_id', $row->admin_id);
            $this->session->set_userdata('login_user_id', $row->admin_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'admin');
            return 'success';
        }
        
          $query = $this->db->get_where('student', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('student_login', '1');
            $this->session->set_userdata('student_id', $row->student_id);
            $this->session->set_userdata('login_user_id', $row->student_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'student');
            return 'success';
        }
        
        $query = $this->db->get_where('admin1', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('admin1_login', '1');
            $this->session->set_userdata('admin1_id', $row->admin1_id);
            $this->session->set_userdata('login_user_id', $row->admin1_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'admin1');
            return 'success';
        }
        
        $query = $this->db->get_where('science', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('science_login', '1');
            $this->session->set_userdata('science_id', $row->science_id);
            $this->session->set_userdata('login_user_id', $row->science_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'science');
            return 'success';
        }
             
        $query = $this->db->get_where('backtest', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('backtest_login', '1');
            $this->session->set_userdata('backtest_id', $row->backtest_id);
            $this->session->set_userdata('login_user_id', $row->backtest_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'backtest');
            return 'success';
        }
        
         $query = $this->db->get_where('admin2', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('admin2_login', '1');
            $this->session->set_userdata('admin2_id', $row->admin2_id);
            $this->session->set_userdata('login_user_id', $row->admin2_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'admin2');
            return 'success';
        }
        
         $query = $this->db->get_where('superadmin', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('superadmin_login', '1');
            $this->session->set_userdata('superadmin_id', $row->super_admin_id);
            $this->session->set_userdata('login_user_id', $row->super_admin_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'superadmin');
            return 'success';
        }
        
        // Checking login credential for tutor
        $query = $this->db->get_where('tutor', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('tutor_login', $row->status);
            $this->session->set_userdata('tutor_id', $row->tutor_id);
            $this->session->set_userdata('login_user_id', $row->tutor_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'tutor');
            return 'success';
        }
        
        $query = $this->db->get_where('mentor', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('mentor_login', '1');
            $this->session->set_userdata('mentor_id', $row->mentor_id);
            $this->session->set_userdata('login_user_id', $row->mentor_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'mentor');
            return 'success';
        }
        
          $query = $this->db->get_where('brightspace', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('brightspace_login', '1');
            $this->session->set_userdata('brightspace_id', $row->brightspace_id);
            $this->session->set_userdata('login_user_id', $row->brightspace_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'brightspace');
            return 'success';
        }
        
         $query = $this->db->get_where('lecturer', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('lecturer_login', '1');
            $this->session->set_userdata('lecturer_id', $row->lecturer_id);
            $this->session->set_userdata('login_user_id', $row->lecturer_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'lecturer');
            return 'success';
        }
        
       
        
         $query = $this->db->get_where('admin4', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('admin4_login', '1');
            $this->session->set_userdata('admin4_id', $row->admin4_id);
            $this->session->set_userdata('login_user_id', $row->admin4_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'admin4');
            return 'success';
        }
         
          $query = $this->db->get_where('admin5', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('admin5_login', '1');
            $this->session->set_userdata('admin5_id', $row->admin5_id);
            $this->session->set_userdata('login_user_id', $row->admin5_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'mentor');
            return 'success';
        }
        
           

            $query = $this->db->get_where('sds', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('sds_login', '1');
            $this->session->set_userdata('sds_id', $row->sds_id);
            $this->session->set_userdata('login_user_id', $row->sds_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'sds');
            return 'success';
        }

          $query = $this->db->get_where('management', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('management_login', '1');
            $this->session->set_userdata('management_id', $row->management_id);
            $this->session->set_userdata('login_user_id', $row->management_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'management');
            return 'success';
        }
                 $query = $this->db->get_where('art', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('art_login', '1');
            $this->session->set_userdata('art_id', $row->art_id);
            $this->session->set_userdata('login_user_id', $row->art_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'art');
            return 'success';
        }

        

        // Checking login credential for student
       

        // Checking login credential for parent
        $query = $this->db->get_where('parent', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('parent_login', '1');
            $this->session->set_userdata('parent_id', $row->parent_id);
            $this->session->set_userdata('login_user_id', $row->parent_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'parent');
            return 'success';
        }

        return 'invalid';
    }

    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }

    // PASSWORD RESET BY EMAIL
    function forgot_password()
    {
        $this->load->view('backend/forgot_password');
    }

    function ajax_forgot_password()
    {
        $resp                   = array();
        $resp['status']         = 'false';
        $email                  = $_POST["email"];
        $reset_account_type     = '';
        //resetting user password here
        $new_password           =   substr( md5( rand(100000000,20000000000) ) , 0,7);

        // Checking credential for admin
        $query = $this->db->get_where('admin' , array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'admin';
            $this->db->where('email' , $email);
            $this->db->update('admin' , array('password' => $new_password));
            $resp['status']         = 'true';
        }
        
         // Checking credential for admin4
     
         
          // Checking credential for admin1
        $query = $this->db->get_where('admin1' , array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'admin1';
            $this->db->where('email' , $email);
            $this->db->update('admin1' , array('password' => $new_password));
            $resp['status']         = 'true';
        }
        
       
       
        // Checking credential for super admin
        $query = $this->db->get_where('admin2' , array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'admin2';
            $this->db->where('email' , $email);
            $this->db->update('admin2' , array('password' => $new_password));
            $resp['status']         = 'true';
        }
        
         $query = $this->db->get_where('admin4' , array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'admin4';
            $this->db->where('email' , $email);
            $this->db->update('admin4' , array('password' => $new_password));
            $resp['status']         = 'true';
        }
        // Checking credential for student
        $query = $this->db->get_where('student' , array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'student';
            $this->db->where('email' , $email);
            $this->db->update('student' , array('password' => $new_password));
            $resp['status']         = 'true';
        }
        // Checking credential for tutor
        $query = $this->db->get_where('tutor' , array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'tutor';
            $this->db->where('email' , $email);
            $this->db->update('tutor' , array('password' => $new_password));
            $resp['status']         = 'true';
        }

        
        // Checking credential for parent
        $query = $this->db->get_where('parent' , array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'parent';
            $this->db->where('email' , $email);
            $this->db->update('parent' , array('password' => $new_password));
            $resp['status']         = 'true';
        }

        // send new password to user email
        $this->email_model->password_reset_email($new_password , $reset_account_type , $email);

        $resp['submitted_data'] = $_POST;

        echo json_encode($resp);
    }

    /*     * *****LOGOUT FUNCTION ****** */

    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url(), 'refresh');
    }

}
 