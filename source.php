<?php

// Version 1.3 2022-03-13

add_filter( 'um_email_notifications', 'custom_email_notifications_role_is_changed', 10, 1 );
add_action( 'set_user_role',          'custom_role_is_changed_email', 10, 3 );

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

        if( !empty( $old_roles ) && !in_array( $role, $old_roles )) {

            $all_roles = UM()->roles()->get_roles();

            $old_role_names = array();
            foreach( $old_roles as $old_role ) {
                $old_role_names[] = $all_roles[$old_role];
            }

            $args['tags'] = array(  '{role}', 
                                    '{old_role}' );

            $args['tags_replace'] = array(  $all_roles[$role], 
                                            implode( ',', $old_role_names ));

            um_fetch_user( $user_id );
            UM()->mail()->send( um_user( 'user_email' ), 'role_is_changed_email', $args );
        }
    }
