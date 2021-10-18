<?php
function add_export_publish_posts_button()
{
    if ( current_user_can( 'manage_options' ) ) {
        
        $screen = get_current_screen();
        if ( isset( $screen->parent_file )
                && ( 'edit.php' == $screen->parent_file ) ) {
            ?>
            <input class="button button-primary"
                   type="submit"
                   id="export_posts"
                   name="export_posts"
                   value="خروجی CSV">
            <script type="text/javascript">
                jQuery( function ($) {
                    $( '#export_posts' ).insertAfter( '#post-query-submit' );
                });
            </script>
            <?php
        }
        
    }
}
//add_action( 'restrict_manage_posts', 'add_export_publish_posts_button' );


function do_export_posts()
{
    if ( current_user_can( 'manage_options' ) && isset( $_GET['export_posts'] ) ) {
        $arg = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => -1,
        );

        $post_list = get_posts( $arg );
        if ( $post_list ) {
            header( 'Content-Encoding: UTF-8' );
            header( 'Content-type: text/csv; charset=utf-8' );
            header( 'Content-Disposition: attachment; filename="wp.csv"' );
            header( 'Pragma: no-cache' );
            header( 'Expires: 0' );
            $file = fopen( 'php://output', 'w' );
            fputs( $file, "\xEF\xBB\xBF" ); // UTF-8

            global $post;
            foreach ( $post_list as $post ) {
                setup_postdata( $post );
                fputcsv( $file, array( get_the_title(), get_the_author(), get_the_permalink() ) );
            }
            exit();
        }
    }
}
//add_action( 'init', 'do_export_posts' );


function do_export_models()
{
    global $wpdb;
    if (  isset( $_GET['export_model'] ) ) {

        $model_in=mbm_ipak\tools::get_model_from_url();
        $MBM_Ipak_Models = new MBM_Ipak_Models;

        $model = $MBM_Ipak_Models->get_model($model_in);
      

        $data = mbm_ipak\tools::get_sql(1, 1, true, $wpdb->prefix . "hesab_model", $model["fields"], " and type_id='" . $model["id"] . "'");

        $sql_main = $data["sql"];
 
        $list = $wpdb->get_results($sql_main, 'ARRAY_A');

            header( 'Content-Encoding: UTF-8' );
            header( 'Content-type: text/csv; charset=utf-8' );
            header( 'Content-Disposition: attachment; filename="wp.csv"' );
            header( 'Pragma: no-cache' );
            header( 'Expires: 0' );
            $file = fopen( 'php://output', 'w' );
            fputs( $file, "\xEF\xBB\xBF" ); // UTF-8



            foreach ( $list as $item ) {
                $rows=[];
                foreach($item  as $cell)
                {
                    $rows[]=$cell;
                }
                fputcsv( $file, $rows );
            }
            exit();

    }
}
add_action( 'init', 'do_export_models' );