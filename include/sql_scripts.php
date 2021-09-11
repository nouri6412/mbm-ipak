<?php
class MBM_Ipak_Sql_Scripts
{
  public function get_install_script()
  {
    global $wpdb;
    $table_name = $wpdb->prefix . "hesab_model";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
                `id` BIGINT(18) NOT NULL AUTO_INCREMENT,
                `type_id` BIGINT(18) NOT NULL,
                `title` varchar(500) CHARACTER SET utf8 NOT NULL,
                PRIMARY KEY (`id`)
              ) $charset_collate; ";

    $table_name = $wpdb->prefix . "hesab_model_type";
    $sql .= "CREATE TABLE $table_name (
                    `id` BIGINT(18) NOT NULL,
                    `title` varchar(500) CHARACTER SET utf8 NOT NULL,
                    `title_fa` varchar(500) CHARACTER SET utf8 NOT NULL,
                    PRIMARY KEY (`id`)
                  ) $charset_collate; ";

    $sql .= "INSERT INTO $table_name(id,title,title_fa) select '1','bank','بانک' where not exists(select * from $table_name where title = 'bank');  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) select '2','contact','طرف حساب' where not exists(select * from $table_name where title = 'contact');  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) select '3','cost','هزینه' where not exists(select * from $table_name where title = 'cost');  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) select '4','income','درآمد' where not exists(select * from $table_name where title = 'income');  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) select '5','insert_cost','ثبت هزینه' where not exists(select * from $table_name where title = 'insert_cost');  ";



    $table_name = $wpdb->prefix . "hesab_model_type_meta";
    $sql .= "CREATE TABLE $table_name (
                    `id` BIGINT(18) NOT NULL AUTO_INCREMENT,
                    `type_id` BIGINT(18) NOT NULL,
                    `key_meta` varchar(500) CHARACTER SET utf8 NOT NULL,
                    `label_meta` varchar(500) CHARACTER SET utf8 NOT NULL,
                    `type_meta` varchar(500) CHARACTER SET utf8 NOT NULL,
                    PRIMARY KEY (`id`)
                  ) $charset_collate; ";

    $table_name = $wpdb->prefix . "hesab_sanad";
    $sql .= "CREATE TABLE $table_name (
  `id` bigint(18) NOT NULL AUTO_INCREMENT,
  `sanad_date` date NOT NULL,
  `description` text COLLATE utf8mb4_persian_ci NOT NULL,
  `hesab_model_id` bigint(20) NOT NULL,
  `bed` bigint(20) NOT NULL,
  `bes` bigint(18) NOT NULL,
  `sanad_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
          ) $charset_collate; ";

    $table_name = $wpdb->prefix . "hesab_model_meta";
    $sql .= "CREATE TABLE $table_name (
            `id` BIGINT(18) NOT NULL AUTO_INCREMENT,
            `key_meta_id` BIGINT(18)  NOT NULL,
            `model_id` BIGINT(18)  NOT NULL,
            `value_meta` text CHARACTER SET utf8 NOT NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate; ";
    return $sql;
  }
}
