<?php
/*
 Billing form of checkout page*/
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

function custom_override_checkout_fields( $fields ) {

    $fields['billing']['billing_company']['placeholder'] = 'Company Name';
    $fields['billing']['billing_company']['required'] = false;

    $fields['billing']['billing_email']['placeholder'] = 'Email*';
    $fields['billing']['billing_email']['required'] = true;

    $fields['billing']['billing_title'] = array(
        'label'     => 'Title',
        'placeholder'   => 'Title',
        'required'  => false
    );

    $fields['billing']['billing_first_name']['placeholder'] = 'First name*';
    $fields['billing']['billing_first_name']['required'] = true;

    $fields['billing']['billing_middle_name'] = array(
        'label'     => 'Middle Name',
        'placeholder'   => 'Middle Name',
        'required'  => false
    );

    $fields['billing']['billing_last_name']['placeholder'] = 'Last name*';
    $fields['billing']['billing_last_name']['required'] = true;

    $fields['billing']['billing_address_1']['placeholder'] = 'Address 1*';
    $fields['billing']['billing_address_1']['required'] = true;

    $fields['billing']['billing_address_2']['placeholder'] = 'Address 2';
    $fields['billing']['billing_address_2']['required'] = false;

    $fields['billing']['billing_postcode']['placeholder'] = 'ZIP / Postal Code*';
    $fields['billing']['billing_postcode']['required']  = true;

    $fields['billing']['billing_country'] = array(
        'type'      => 'select',
        'required'  => true,
        'options'   => array(
            'option_0' => '-- Country --',
            'BD' => 'Bangladesh',
            'GB' => 'UK',
            'IN' => 'India',
            'PK' => 'Pakistan',
            'UA' => 'Ukraine',
            'CA' => 'Canada',
            'DJ' => 'Dubai'
        )
    );


    $fields['billing']['billing_state']['required'] = true;
    $fields['billing']['billing_state']['type'] = 'select';
    $fields['billing']['billing_state']['options'] = array(
        'option_0' => '-- State/Province/Region --',
        'BD' => 'Bangladesh',
        'GB' => 'UK',
        'IN' => 'India',
        'PK' => 'Pakistan',
        'UA' => 'Ukraine',
        'CA' => 'Canada',
        'DJ' => 'Dubai'
    );

    $fields['billing']['billing_phone']['placeholder'] = 'Phone*';
    $fields['billing']['billing_phone']['required'] = true;

    $fields['billing']['billing_mobile_phone']['placeholder'] = 'Mobile phone';
    $fields['billing']['billing_mobile_phone']['required'] = false;

    $fields['billing']['billing_fax']['placeholder'] = 'Fax';
    $fields['billing']['billing_fax']['required'] = false;

    unset($fields['billing']['billing_city']);


    return $fields;
}