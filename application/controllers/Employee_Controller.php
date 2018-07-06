<?php if (!defined('BASEPATH')) exit('Direct Access Forbidden!');

    class Employee_Controller extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Employee_Model');
        }

        public function index()
        {
            $data['title'] = "Employee Records";
            $this->load->view('common/footbar.php');
            $this->load->view('employee/view_employee.php', $data);
            $this->load->view('common/end_wrapper.php');
        }

        public function get_employees()
        {
            //Variables for DataTables
            $draw = intval($this->input->get('draw'));
            $start = intval($this->input->get('start'));
            $length = intval($this->input->get('length'));

            $employeesList = $this->Employee_Model->get_employees();
            $data = array();

            foreach ($employeesList->result() as $row) {
                $data[] = array(
                    $row->employee_id,
                    $row->full_name,
                    $row->address,
                    $row->email,
                    $row->contact_no,
                    '<button class="btn_edit btn btn-secondary btn-sm text-center" data-employee_id="'.$row->employee_id.'">
                        <span class="fa fa-pencil"></span>
                    </button> &nbsp;
                    <button class="btn_delete btn btn-danger btn-sm text-center" data-employee_id="'.$row->employee_id.'">
                        <span class="fa fa-times"></span>
                    </button>'
                );
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $employeesList->num_rows(),
                "recordsFiltered" => $employeesList->num_rows(),
                "data" => $data
            );

            echo json_encode($output);
            // exit();
        }
    }
?>