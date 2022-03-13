<?php

// Version 1.2 2022-03-13

add_filter( 'um_email_notifications',        'custom_email_notifications_role_is_changed', 10, 1 );
add_action( 'set_user_role',                 'custom_role_is_changed_email', 10, 3 );
add_action( 'um_after_email_template_part',  'custom_do_placeholders', 20, 3 );

    function custom_email_notifications_role_is_changed( $emails ) {

        $custom_emails = array(
            'role_is_changed_email'	 => array(
                    'key'			 => 'role_is_changed_email',
                    'title'			 => __( 'Role is changed email', 'ultimate-member' ),
                    'subject'		 => 'Role Change {site_name}',
                    'body'			 => '',
                    'description'	 => __( 'To send the user an email when the user role is changed', 'ultimate-member' ),
                    'recipient'		 => 'user',
                    'default_active' => true ));

        UM()->options()->options = array_merge( array(
                    'role_is_changed_email_on'  => 1,
                    'role_is_changed_email_sub' => 'Role Change {site_name}', ), 
                     UM()->options()->options );
    
        return array_merge( $custom_emails, $emails );
    }

    function custom_role_is_changed_email( $user_id, $role, $old_roles ) {

        if( !empty( $old_roles )) {

            $userdata = get_userdata( $user_id );
            $all_roles = UM()->roles()->get_roles();

            $old_role_names = array();
            foreach( $old_roles as $old_role ) {
                $old_role_names[] = $all_roles[$old_role];
            }

            $args = array(  '{role}'         => $all_roles[$role], 
                            '{old_role}'     => implode( ',', $old_role_names ),
                            '{display_name}' => $userdata->display_name,
                            '{email}'        => $userdata->user_email,
                            '{username}'     => $userdata->user_login
                        );

            UM()->mail()->send( $userdata->user_email, 'role_is_changed_email', $args );
        }
    }

    function custom_do_placeholders( $slug, $located, $args ) {

        if( $slug == 'role_is_changed_email' ) {
            echo str_replace( array_keys( $args ), $args, ob_get_clean() );
        }
    }
