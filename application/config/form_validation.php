<?php
    $config = array(
        'employee' => array(
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
                'rules' => 'valid_email|max_length[30]'
            ),
            array(
                'field' => 'contact_no',
                'label' => 'Contact No',
                'rules' => 'required|numeric|exact_length[10]|is_unique[employee.contact_no]'
            )
        ),
        'employee_update' => array(
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
                'rules' => 'valid_email|max_length[30]'
            )
            //Set Contact_no VRules Manually or dont set it at all
            //is_unique constraint for same contact no can cause problems
            //Contact no is also the username, so changing it would not be wise
        ),
        'service' => array(
            array(
                'field' => 'service_name',
                'label' => 'service name',
                'rules' => 'required|trim|regex_match[/^[a-zA-Z\s-_]+$/]|max_length[30]'
            ),
            array(
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required|max_length[100]'
            )
        ),
        'item' => array(
            array(
                'field' => 'item_name',
                'label' => 'item name',
                'rules' => 'required|trim|regex_match[/^[a-zA-Z\s-_]+$/]|max_length[30]'
            )
        )
    );
?>