<?php
class MBM_Ipak_Core
{
    public function run()
    {
        add_action("admin_menu",array($this,"menu"));
    }
    public function dashboard()
    {
        echo 'hello';
    }
    public function define_bank()
    {
        
    }
    public function define_contact()
    {
        
    }
    public function define_cost()
    {
        
    }
    public function menu()
    {
        add_menu_page('سیستم حسابداری', ' حسابداری ایپک', 'manage_options', 'ipak-hesab-dashboard',array($this,"dashboard"), 'dashicons-money-alt');
        add_submenu_page('ipak-hesab-dashboard', 'داشبورد حسابداری', 'داشبورد حسابداری', 'manage_options', 'ipak-hesab-dashboard', array($this,"dashboard"));
        add_submenu_page('ipak-hesab-dashboard', 'تعاریف بانک', 'تعاریف بانک', 'manage_options', 'ipak-hesab-define-bank', array($this,"define_bank"));
        add_submenu_page('ipak-hesab-dashboard', '  تعاریف طرف حساب / اشخاص / شرکت', 'تعاریف طرف حساب / اشخاص / شرکت', 'manage_options', 'ipak-hesab-define-contact', array($this,"define_contact"));
        add_submenu_page('ipak-hesab-dashboard', 'تعاریف هزینه', 'تعاریف هزینه', 'manage_options', 'ipak-hesab-define-cost',  array($this,"define_cost"));
        add_submenu_page('ipak-hesab-dashboard', 'تعاریف درآمد', 'تعاریف درآمد', 'manage_options', 'ipak-hesab-define-income',  array($this,"define_income"));
        add_submenu_page('ipak-hesab-dashboard', 'ثبت هزینه', 'ثبت هزینه', 'manage_options', 'ipak-hesab-insert-cost', array($this,"insert_cost"));
        add_submenu_page('ipak-hesab-dashboard', 'ثبت درآمد', 'ثبت درآمد', 'manage_options', 'ipak-hesab-insert-income', array($this,"insert_income"));
        add_submenu_page('ipak-hesab-dashboard', 'ثبت بدهی', 'ثبت بدهی / به دیگران', 'manage_options', 'ipak-hesab-insert-debt', array($this,"insert_debt"));
        add_submenu_page('ipak-hesab-dashboard', 'ثبت مطالبه', 'ثبت مطالبه / از دیگران', 'manage_options', 'ipak-hesab-insert-demand', array($this,"insert_demand"));
        add_submenu_page('ipak-hesab-dashboard', 'پرداخت نقدی ', 'پرداخت نقدی ', 'manage_options', 'ipak-hesab-insert-pay', array($this,"insert_pay"));
        add_submenu_page('ipak-hesab-dashboard', 'دریافت نقدی', 'دریافت نقدی', 'manage_options', 'ipak-hesab-insert-cash', array($this,"insert_cash"));
        add_submenu_page('ipak-hesab-dashboard', 'گزارش هزینه', 'گزارش هزینه', 'manage_options', 'ipak-hesab-report-cost', array($this,"report_cost"));
        add_submenu_page('ipak-hesab-dashboard', 'گزارش درآمد', 'گزارش درآمد', 'manage_options', 'ipak-hesab-report-income', array($this,"report_income"));
        add_submenu_page('ipak-hesab-dashboard', 'گزارش بدهی ها', 'گزارش بدهی ها', 'manage_options', 'ipak-hesab-report-debt', array($this,"report_debt"));
        add_submenu_page('ipak-hesab-dashboard', 'گزارش مطالبه ها', 'گزارش مطالبه ها', 'manage_options', 'ipak-hesab-report-demand', array($this,"report_demand"));
        add_submenu_page('ipak-hesab-dashboard', 'گزارش پرداخت نقدی', 'گزارش پرداخت نقدی', 'manage_options', 'ipak-hesab-report-pay', array($this,"report_pay"));
        add_submenu_page('ipak-hesab-dashboard', 'گزارش دریافت نقدی', 'گزارش دریافت نقدی', 'manage_options', 'ipak-hesab-report-cash', array($this,"report_cash"));

        //add_submenu_page('ipak-hesab-dashboard', '', '', 'manage_options', 'ipak-hesab-define-bank', array($this,"define_bank"));

    }
}
