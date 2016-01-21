<?php
function add_grav_forms(){
    $role = get_role('editor');
    $role->add_cap('gform_full_access');
}
//add_action('admin_init','add_grav_forms');


?>