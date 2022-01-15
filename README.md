# Role-is-changed-email

This is an additional custom email template to the Ultimate Member email templates.
If enabled an user role change by an administrator will trigger sending of the email to the users email address.

Available user placeholders for the email template are:

{role}         New user role 

{old_role}     Old user role

{display_name} Display name

{email}        User email address

{username}     User name

{site_name}    Site name

{site_url}     Site URL

{admin_email}  Site administration email

{login_url}    Login URL

## Installation

Install the "source.php" file to your child-theme's functions.php file or use the "Code Snippets" plugin.

Activate the email template at UM Settings -> Email -> "Role is changed email"

Copy the Email Body from "email_body.txt" and save in the template Message Body while the text area is in Text Mode.

Save the "Role is changed email" template after your text adjustments or translation in Visual Mode.

## Reference

How to add and use custom email templates

https://docs.ultimatemember.com/article/1515-how-to-add-and-use-custom-email-templates

"Code Snippets" plugin

https://wordpress.org/plugins/code-snippets/
