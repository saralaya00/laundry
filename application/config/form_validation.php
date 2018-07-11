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
        )
    );
?>