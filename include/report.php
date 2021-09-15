<?php
function my_admin_footer_function() {
    echo "<script>alert('salam script');</script>";
}
add_action('admin_footer', 'my_admin_footer_function',10,0);