<?php
function customizer_data() {
	$customizer_data = [];
	$customizer_data = [
		[
			'info' => [
				'name' => 'header',
				'label' => 'Header',
				'description' => 'Section header',
				'priority' => 1,
			],
			'fields' => [
				[
					'name' => 'logo',
					'type' => 'image',
					'default' => '',
					'label' => 'Logo',
				],
				[
					'name' => 'slogan_small',
					'type' => 'text',
					'default' => '',
					'label' => 'Slogan small',
				],
				[
					'name' => 'slogan_large',
					'type' => 'text',
					'default' => '',
					'label' => 'Slogan large',
				],
				[
					'name' => 'phone_text',
					'type' => 'text',
					'default' => '',
					'label' => 'Phone text',
				],
				[
					'name' => 'phone',
					'type' => 'text',
					'default' => '',
					'label' => 'Phone',
				],
				[
					'name' => 'phone_tel',
					'type' => 'text',
					'default' => '',
					'label' => 'Phone tel',
				],
				[
					'name' => 'category_mobile',
					'type' => 'text',
					'default' => '',
					'label' => 'Category mobile',
				],
				[
					'name' => 'category_mobile_link',
					'type' => 'text',
					'default' => '',
					'label' => 'Category mobile link',
				],
				[
					'name' => 'id_category_ask',
					'type' => 'text',
					'default' => '',
					'label' => 'Id category ask form ask fly admin',
				],
			],
		],
		[
			'info' => [
				'name' => 'footer',
				'label' => 'Footer',
				'description' => 'Section footer',
				'priority' => 2,
			],
			'fields' => [
				[
					'name' => 'title_left',
					'type' => 'text',
					'default' => '',
					'label' => 'Title left',
				],
				[
					'name' => 'logo_footer',
					'type' => 'image',
					'default' => '',
					'label' => 'Logo',
				],
				[
					'name' => 'info',
					'type' => 'textarea',
					'default' => '',
					'label' => 'Info',
				],
				[
					'name' => 'title_right',
					'type' => 'text',
					'default' => '',
					'label' => 'Title right',
				],
				[
					'name' => 'address_left',
					'type' => 'textarea',
					'default' => '',
					'label' => 'Address left',
				],
				[
					'name' => 'address_right',
					'type' => 'textarea',
					'default' => '',
					'label' => 'Address right',
				],
				[
					'name' => 'copyright',
					'type' => 'text',
					'default' => '',
					'label' => 'Copyright',
				],
				[
					'name' => 'designby',
					'type' => 'text',
					'default' => '',
					'label' => 'Designby',
				],
			],
		],		
	];
	return $customizer_data;
}


function customizer_customizer( $wp_customize ) {
	$customizer_data =  customizer_data();

	foreach ($customizer_data as $customizer_section) {

		$ctm_section_name = $customizer_section["info"]["name"];
		$ctm_section_label = $customizer_section["info"]["label"];
		$ctm_section_description = $customizer_section["info"]["description"];
		$ctm_section_priority = $customizer_section["info"]["priority"];

	    $wp_customize->add_section (
	        $ctm_section_name,
	        array(
	            'title' => $ctm_section_label,
	            'description' => $ctm_section_description,
	            'priority' => $ctm_section_priority,
	        )
	    );

		foreach ($customizer_section["fields"] as $customizer_fields) {

			$ctm_name = $customizer_fields["name"];
			$ctm_type = $customizer_fields["type"];
			$ctm_default = $customizer_fields["default"];
			$ctm_label = $customizer_fields["label"];
			if(isset($customizer_fields["choices"])) {
				$ctm_choices = $customizer_fields["choices"];
			}

			if ($ctm_type == 'text') {
			    $wp_customize->add_setting (
			    	$ctm_name,
	                array(
		                'default' => $ctm_default,
		            )
            	);
			    $wp_customize->add_control (
			        $ctm_name,
			        array(
			            'type' => $ctm_type,
			            'label' => $ctm_label,
			            'section' => $ctm_section_name,
			            'settings' => $ctm_name,
			        )
			    );
			} elseif($ctm_type == 'select') {
			    $wp_customize->add_setting( $ctm_name );
			    $wp_customize->add_control(
			        $ctm_name,
			        array(
			            'type' => $ctm_type,
			            'label' => $ctm_label,
			            'section' => $ctm_section_name,
			            'settings' => $ctm_name,
			            
			            'choices' => $ctm_choices,
			        )
			    );
			} elseif($ctm_type == 'radio') {
			    $wp_customize->add_setting(
			        $ctm_name,
			        array(
			            'default' => $ctm_default,
			        )
			    );
			    $wp_customize->add_control(
			        $ctm_name,
			        array(
			            'type' => $ctm_type,
			            'label' => $ctm_label,
			            'section' => $ctm_section_name,
			            'settings' => $ctm_name,

			            'choices' => $ctm_choices,
			        )
			    );
			} elseif($ctm_type == 'checkbox') {
			    $wp_customize->add_setting ( $ctm_name );
			    $wp_customize->add_control(
			        $ctm_name,
			        array(
			            'type' => $ctm_type,
			            'label' => $ctm_label,
			            'section' => $ctm_section_name,
			            'settings' => $ctm_name,
			        )
			    );
			} elseif($ctm_type == 'image') {
			    $wp_customize->add_setting(
			    	$ctm_name,
	                array(
		                'default' => $ctm_default,
		            )
	            );
			    $wp_customize->add_control(
			        new WP_Customize_Image_Control(
			            $wp_customize,
			            $ctm_name,
			            array(
			                'type' => $ctm_type,
			                'label' => $ctm_label,
			                'section' => $ctm_section_name,
			                'settings' => $ctm_name,
			            )
			        )
			    );
			} elseif($ctm_type == 'color') {
			    $wp_customize->add_setting (
			    	$ctm_name,
	                array(
		                'default' => $ctm_default,
		            )
            	);
			    $wp_customize->add_control(
			        new WP_Customize_Color_Control(
			            $wp_customize,
			            $ctm_name,
			            array(
			                'label' => $ctm_label,
			                'section' => $ctm_section_name,
			                'settings' => $ctm_name,
			            )
			        )
			    );
			} elseif($ctm_type == 'textarea') {
			    $wp_customize->add_setting (
			    	$ctm_name,
	                array(
		                'default' => $ctm_default,
		            )
            	);
			    $wp_customize->add_control (
			        $ctm_name,
			        array(
			            'type' => $ctm_type,
			            'label' => $ctm_label,
			            'section' => $ctm_section_name,
			            'settings' => $ctm_name,
			        )
			    );
			}
		}
	}
}
	
add_action( 'customize_register', 'customizer_customizer' );
?>