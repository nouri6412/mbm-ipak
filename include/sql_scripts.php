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

    $sql .= "INSERT INTO $table_name(id,type_id,title) select '-1','1','بانک ووکامرس' where not exists(select * from $table_name where id = '-1');  ";
    $sql .= "INSERT INTO $table_name(id,type_id,title) select '-2','4','فروش محصولات ووکامرس' where not exists(select * from $table_name where id = '-2');  ";
    $sql .= "INSERT INTO $table_name(id,type_id,title) select '-3','2',' مشتری ووکامرس' where not exists(select * from $table_name where id = '-3');  ";

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
    $sql .= "INSERT INTO $table_name(id,title,title_fa) select '6','insert_income','ثبت درآمد' where not exists(select * from $table_name where title = 'insert_income');  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) select '7','insert_debt','ثبت بدهکار' where not exists(select * from $table_name where title = 'insert_debt');  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) select '8','insert_demand','ثبت طلبکار' where not exists(select * from $table_name where title = 'insert_demand');  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) select '9','insert_pay','پرداخت نقدی' where not exists(select * from $table_name where title = 'insert_pay');  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) select '10','insert_cash','دریافت نقدی' where not exists(select * from $table_name where title = 'insert_cash');  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) select '11','report_cost',' گزارش هزینه' where not exists(select * from $table_name where title = 'report_cost');  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) select '12','report_cost',' گزارش درآمد' where not exists(select * from $table_name where title = 'report_cost');  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) select '13','report_cost',' گزارش بدهکاران و طلبکاران' where not exists(select * from $table_name where title = 'report_cost');  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) select '14','report_cost',' گزارش   موجودی بانک' where not exists(select * from $table_name where title = 'report_bank');  ";




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
  `model_id` bigint(18) NOT NULL,
  `sanad_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
          ) $charset_collate; ";

    $table_name = $wpdb->prefix . "hesab_model_meta";
    $sql .= "CREATE TABLE $table_name (
            `id` BIGINT(18) NOT NULL AUTO_INCREMENT,
            `key_meta_id` BIGINT(18)  NOT NULL,
            `model_id` BIGINT(18)  NOT NULL,
            `key_meta` varchar(500) CHARACTER SET utf8 NOT NULL,
            `value_meta` text CHARACTER SET utf8 NOT NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate; ";
    return $sql;
  }
}
