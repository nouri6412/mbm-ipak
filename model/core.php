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
        add_submenu_page('ipak-hesab-dashboard', 'تعاریف طرف حساب', 'تعاریف طرف حساب', 'manage_options', 'ipak-hesab-define-contact', array($this,"define_contact"));
        add_submenu_page('ipak-hesab-dashboard', 'تعاریف هزینه', 'تعاریف هزینه', 'manage_options', 'ipak-hesab-define-cost',  array($this,"define_cost"));

    }
}
