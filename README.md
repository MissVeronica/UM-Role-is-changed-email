# Role-is-changed-email

This is an additional custom email template to the Ultimate Member email templates.
If enabled an user role change by an administrator will trigger sending of the email to the users email address.
Available placeholders for the email template are:

{role}         New user role 

{old_role}     Old user role

{display_name} Display name

{email}        User email address

{username}     User name

## Installation

Install the source.php file to your child-theme's functions.php file or use the "Code Snippets" plugin.

Activate the email template at UM Settings -> Email -> "Role is changed email"

Copy the Email body from email_body.txt and save in the template while the text area is in text mode.

Save the "Role is changed email" template after your text adjustments or translation.
