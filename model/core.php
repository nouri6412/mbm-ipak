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
    public function menu()
    {
        add_menu_page('سیستم حسابداری', ' حسابداری ایپک', 'manage_options', 'ipak-hesab-dashboard',array($this,"dashboard"), '');
        add_submenu_page('ipak-hesab-dashboard', 'تعاریف', 'تعاریف', 'manage_options', 'ipak-hesab-dashboard', '');
        add_submenu_page('ipak-hesab-dashboard', 'تعاریف بانک', 'تعاریف بانک', 'manage_options', 'ipak-hesab-define-bank', '');
        add_submenu_page('ipak-hesab-dashboard', 'تعاریف طرف حساب', 'تعاریف طرف حساب', 'manage_options', 'ipak-hesab-define-contact', '');

        add_submenu_page('ipak-hesab-dashboard', 'عملیات', 'عملیات', 'manage_options', 'ipak-hesab-operation', '');
        add_submenu_page('ipak-hesab-operation', 'عملیات بانک', 'عملیات بانک', 'manage_options', 'ipak-hesab-operation-bank', '');
        add_submenu_page('ipak-hesab-operation', 'عملیات طرف حساب', 'عملیات طرف حساب', 'manage_options', 'ipak-hesab-operation-contact', '');

    }
}
