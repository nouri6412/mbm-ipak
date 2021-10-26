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
              )ENGINE=InnoDB $charset_collate; ";

    $sql .= "INSERT INTO $table_name(id,type_id,title) VALUES('-1','1','بانک ووکامرس') ON DUPLICATE KEY UPDATE type_id = '1';  ";
    $sql .= "INSERT INTO $table_name(id,type_id,title) VALUES('-2','4','فروش محصولات ووکامرس') ON DUPLICATE KEY UPDATE type_id = '4';  ";
    $sql .= "INSERT INTO $table_name(id,type_id,title) VALUES('-3','2','مشتری ووکامرس') ON DUPLICATE KEY UPDATE type_id = '2';  ";

    $table_name = $wpdb->prefix . "hesab_model_type";
    $sql .= "CREATE TABLE $table_name (
                    `id` BIGINT(18) NOT NULL,
                    `title` varchar(500) CHARACTER SET utf8 NOT NULL,
                    `title_fa` varchar(500) CHARACTER SET utf8 NOT NULL,
                    PRIMARY KEY (`id`)
                  )ENGINE=InnoDB $charset_collate; ";

    $sql .= "INSERT INTO $table_name(id,title,title_fa) VALUES('1','bank','بانک') ON DUPLICATE KEY UPDATE title = 'bank';  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) VALUES('2','contact','طرف حساب') ON DUPLICATE KEY UPDATE title = 'contact';  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) VALUES('3','cost','هزینه') ON DUPLICATE KEY UPDATE title = 'cost';  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) VALUES('4','income','درآمد') ON DUPLICATE KEY UPDATE title = 'income';  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) VALUES('5','insert_cost','ثبت هزینه') ON DUPLICATE KEY UPDATE title = 'insert_cost';  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) VALUES('6','insert_income','ثبت درآمد') ON DUPLICATE KEY UPDATE title = 'insert_income';  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) VALUES ('7','insert_debt','ثبت بدهکار') ON DUPLICATE KEY UPDATE title = 'insert_debt';  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) VALUES ('8','insert_demand','ثبت طلبکار') ON DUPLICATE KEY UPDATE title = 'insert_demand';  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) VALUES ('9','insert_pay','پرداخت نقدی') ON DUPLICATE KEY UPDATE title = 'insert_pay';  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) VALUES ('10','insert_cash','دریافت نقدی') ON DUPLICATE KEY UPDATE title = 'insert_cash';  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) VALUES ('11','report_cost',' گزارش هزینه') ON DUPLICATE KEY UPDATE title = 'report_cost';  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) VALUES ('12','report_cost',' گزارش درآمد') ON DUPLICATE KEY UPDATE title = 'report_cost';  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) VALUES ('13','report_cost',' گزارش بدهکاران و طلبکاران') ON DUPLICATE KEY UPDATE title = 'report_cost';  ";
    $sql .= "INSERT INTO $table_name(id,title,title_fa) VALUES ('14','report_cost',' گزارش   موجودی بانک') ON DUPLICATE KEY UPDATE title = 'report_bank';  ";




    $table_name = $wpdb->prefix . "hesab_model_type_meta";
    $sql .= "CREATE TABLE $table_name (
                    `id` BIGINT(18) NOT NULL AUTO_INCREMENT,
                    `type_id` BIGINT(18) NOT NULL,
                    `key_meta` varchar(500) CHARACTER SET utf8 NOT NULL,
                    `label_meta` varchar(500) CHARACTER SET utf8 NOT NULL,
                    `type_meta` varchar(500) CHARACTER SET utf8 NOT NULL,
                    PRIMARY KEY (`id`)
                  )ENGINE=InnoDB $charset_collate; ";

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
          )ENGINE=InnoDB $charset_collate; ";

    $table_name = $wpdb->prefix . "hesab_model_meta";
    $sql .= "CREATE TABLE $table_name (
            `id` BIGINT(18) NOT NULL AUTO_INCREMENT,
            `key_meta_id` BIGINT(18)  NOT NULL,
            `model_id` BIGINT(18)  NOT NULL,
            `key_meta` varchar(500) CHARACTER SET utf8 NOT NULL,
            `value_meta` text CHARACTER SET utf8 NOT NULL,
            PRIMARY KEY (`id`)
          )ENGINE=InnoDB $charset_collate; ";
    return $sql;
  }
}
