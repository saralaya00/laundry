<?php
    class Dashboard_Controller extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this -> form_validation -> set_error_delimiters('<label class="col-md-5 col-form-label text-danger">', '</label>');
        }

        public function index()
        {
            $data['title'] = "Dashboard";
            $this->load->view('common/footbar.php');
            $this->load->view('dashboard/view_cards.php');
            $this->load->view('common/end_wrapper.php');
        }

        public function md_employee()
        {
            return $this->load->view('dashboard/md_employee.php');
        }

        public function add_employee()
        {
            //todo: Add Validation rules

            $this -> form_validation -> set_rules($this -> rules_list('employee'));

            // $this -> form_validation -> set_rules('full_name', 'Full name', $rules_fullname);
            // $this -> form_validation -> set_rules('address', 'Address', 'required');
            // $this -> form_validation -> set_rules('email', 'Email', 'required|valid_email');
            // $this -> form_validation -> set_rules('contact_no', 'Contact No', 'required|numeric');

            if ($this->form_validation->run() == FALSE)
            {
                return $this->load->view('dashboard/md_employee.php');
            }
             return $this->load->view('dashboard/succ_employee.php');
        }

        function rules_list($rule)
        {
            switch ($rule) {
                case 'employee':{
                        $employee_rules = array(
                            array(
                                'field' => 'full_name',
                                'label' => 'Full name',
                                'rules' => 'required|trim|regex_match[/^[A-z]*(\s)[A-z]*$/]|max_length[30]'
                            ),
                            array(
                                'field' => 'address',
                                'label' => 'Address',
                                'rules' => 'required|max_length[100]'
                            ),
                            array(
                                'field' => 'email',
                                'label' => 'Email',
                                'rules' => 'required|valid_email|max_length[30]'
                            ),
                            array(
                                'field' => 'contact_no',
                                'label' => 'Contact No',
                                'rules' => 'required|numeric|exact_length[10]'
                            )
                        );

                        return $employee_rules;
                    }
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }
?>