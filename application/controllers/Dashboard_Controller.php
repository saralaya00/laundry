<?php
    class Dashboard_Controller extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Dashboard_Model');
            $this->load->model('Employee_Model');
            $this->load->model('Service_model');
            $this->load->model('Item_model');

            $this -> form_validation -> set_error_delimiters('<span>', '</span>');
        }

        public function index()
        {
            $data['title'] = "Dashboard";

            if($this->input->post('salt') != '' || $_SESSION['salt'] != '')
            {
                $_SESSION['salt'] = $this->input->post('salt');
                $this->load->view('common/footbar.php',$data);
                $this->load->view('dashboard/view_cards.php');
                $this->load->view('common/end_wrapper.php');
            }

            else redirect(base_url());
        }

        public function md_employee()
        {
            //Called by Modal
            return $this->load->view('employee/md_employee.php');
        }

        public function add_employee()
        {
            // $this -> form_validation -> set_rules('contact_no', 'Contact No', 'required|numeric');

            if ($this->form_validation->run('employee') == FALSE)
            {
                return $this->load->view('employee/md_employee.php');
            }
            else {
                $empdata = array(
                    'user_id' => '', //UserID is the generated autonum from users table
                    'full_name' => $this -> input -> post('full_name'),
                    'address' => $this -> input -> post('address'),
                    'email' => $this -> input -> post('email'),
                    'contact_no' => $this -> input -> post('contact_no')
                );

                if ($this->Employee_Model->add_employee($empdata))
                {
                    $_POST['message'] = 'Employee Added!';
                    return $this->load->view('employee/rdonly_employee.php');
                }

                else return $this->load->view('employee/md_employee.php');                
            }
        }

        public function md_service()
        {
            //Called by Modal
            return $this->load->view('service/md_service.php');
        }

        public function add_service()
        {
            if ($this->form_validation->run('service') == FALSE)
            {
                return $this->load->view('service/md_service.php');
            }
            else {
                $service_data = array(
                    'service_id' => '',
                    'service_name' => $this -> input -> post('service_name'),
                    'description' => $this -> input -> post('description'),
                );

                if ($this->Service_model->add_service($service_data))
                {
                    $_POST['message'] = 'Service Added!';
                    return $this->load->view('service/rdonly_service.php');
                }

                else return $this->load->view('service/md_service.php');                
            }
        }
        public function md_item()
        {
            //Called by Modal
            return $this->load->view('item/md_item.php');
        }

        public function add_item()
        {
            if ($this->form_validation->run('item') == FALSE)
            {
                return $this->load->view('item/md_item.php');
            }
            else {
                $item_data = array(
                    'item_id' => '',
                    'item_name' => $this -> input -> post('item_name'),
                    
                );

                if ($this->Item_model->add_item($item_data))
                {
                    $_POST['message'] = 'Item Added!';
                    return $this->load->view('item/rdonly_item.php');
                }

                else return $this->load->view('item/md_item.php');                
            }
        }

    }
?>