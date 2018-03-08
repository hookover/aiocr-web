<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;

class BackendMenuController extends Controller
{
    public function __construct()
    {
        //用户账户
        if (Auth::user()->user_id) {

            Menu::macro('main', function () {
                return Menu::new()
                    ->addClass('nav')
                    ->setAttribute('id', 'nav-accordion')
                    ->add(Link::to('/user/dashboard', '<i class="ti-panel"></i> <p>仪表盘</p>'))
                    ->add(Link::to('/user/decode-log', '<i class="ti-align-right"></i> <p>识别日志</p>'))
                    ->add(Link::to('/user/payment', '<i class="ti-money"></i> <p>在线充值</p>'))
                    ->add(Link::to('/user/statistical-reports', '<i class="ti-layout-cta-left"></i> <p>识别统计</p>'))
                    ->submenu(
                        Menu::new()
                            ->prepend('<a data-toggle="collapse" href="#safety_management"><i class="ti-lock"></i><p>安全管理<b class="caret"></b></p></a>')
//                            ->addClass('nav')
                            ->addClass('collapse nav')
                            ->setAttribute('id', 'safety_management')
                            ->link('/user/reset-userinfo', '<span class="sidebar-mini">&nbsp;</span><span class="sidebar-normal">修改账户信息</span>')
                            ->link('/user/reset-password', '<span class="sidebar-mini">&nbsp;</span><span class="sidebar-normal">修改密码</span>')
                            ->setActive(function ($link) {
                                return $link->url() === explode('?', Request::getRequestUri())[0];
                            })
                    )
                    ->setActive(function (Link $link) {
                        return $link->url() === explode('?', Request::getRequestUri())[0];
                    });
//                ->setActiveFromRequest();
            });
        }

        //开发者账户
        if (Auth::user()->developer_id) {

            Menu::macro('main', function () {
                return Menu::new()
                    ->addClass('nav')
                    ->setAttribute('id', 'nav-accordion')
                    ->add(Link::to('/developer/dashboard', '<i class="ti-panel"></i> <p>仪表盘</p>'))
                    ->add(Link::to('/developer/app', '<i class="ti-package"></i> <p>APP管理</p>'))
                    ->add(Link::to('/developer/decode-log', '<i class="ti-align-right"></i> <p>识别日志</p>'))
                    ->add(Link::to('/developer/card', '<i class="ti-credit-card"></i> <p>充值卡管理</p>'))
                    ->add(Link::to('/developer/withdraw', '<i class="ti-stats-up"></i> <p>提现日志</p>'))
                    ->add(Link::to('/developer/payment', '<i class="ti-money"></i> <p>在线充值</p>'))
                    ->add(Link::to('/developer/statistical-reports', '<i class="ti-layout-cta-left"></i> <p>识别统计
</p>'))
                    ->submenu(
                        Menu::new()
                            ->prepend('<a data-toggle="collapse" href="#safety_management"><i class="ti-lock"></i><p>安全管理<b class="caret"></b></p></a>')
//                            ->addClass('nav')
                            ->addClass('collapse nav')
                            ->setAttribute('id', 'safety_management')
                            ->link('/developer/withdraw-account', '<span class="sidebar-mini">&nbsp;</span><span class="sidebar-normal">提款人信息</span>')
                            ->link('/developer/reset-userinfo', '<span class="sidebar-mini">&nbsp;</span><span class="sidebar-normal">修改账户信息</span>')
                            ->link('/developer/reset-password', '<span class="sidebar-mini">&nbsp;</span><span class="sidebar-normal">修改密码</span>')
                            ->setActive(function ($link) {
                                return $link->url() === explode('?', Request::getRequestUri())[0];
                            })
                    )
                    ->setActive(function (Link $link) {
                        return $link->url() === explode('?', Request::getRequestUri())[0];
                    });
//                ->setActiveFromRequest();

            });
        }


        //管理员
        if (Auth::user()->admin_id) {

            Menu::macro('main', function () {
                return Menu::new()
                    ->addClass('nav')
                    ->setAttribute('id', 'nav-accordion')
                    ->add(Link::to('/admin/dashboard', '<i class="ti-panel"></i> <p>仪表盘</p>'))
                    ->add(Link::to('/admin/payment', '<i class="ti-money"></i> <p>充值管理</p>'))
                    ->add(Link::to('/admin/payment_gift', '<i class="ti-cup"></i> <p>满送配置</p>'))
                    ->add(Link::to('/admin/withdraw', '<i class="ti-reload"></i> <p>提现管理</p>'))
                    ->add(Link::to('/admin/card', '<i class="ti-credit-card"></i> <p>充值卡管理</p>'))
                    ->add(Link::to('/admin/file', '<i class="ti-align-right"></i> <p>识别日志</p>'))
                    ->add(Link::to('/admin/file_type', '<i class="ti-layout-grid2"></i> <p>文件类型配置</p>'))
                    ->add(Link::to('/admin/app', '<i class="ti-package"></i> <p>APP管理</p>'))
                    ->add(Link::to('/admin/user', '<i class="ti-user"></i> <p>用户管理</p>'))
                    ->add(Link::to('/admin/developer', '<i class="ti-face-smile"></i> <p>开发者管理</p>'))
                    ->add(Link::to('/admin/news', '<i class="ti-new-window"></i> <p>新闻公告管理</p>'))
                    ->add(Link::to('/admin/server_id', '<i class="ti-server"></i> <p>服务器列表</p>'))
                    ->add(Link::to('/admin/contact_us', '<i class="ti-email"></i> <p>联系我们</p>'))
                    ->submenu(
                        Menu::new()
                            ->prepend('<a data-toggle="collapse" href="#statistical_reports"><i class="ti-layout-cta-left"></i><p>统计日志<b class="caret"></b></p></a>')
                            ->addClass('collapse nav')
                            ->setAttribute('id', 'statistical_reports')
                            ->link('/admin/statistical_reports_admin', '<span class="sidebar-mini">&nbsp;</span><span class="sidebar-normal">管理员统计</span>')
                            ->link('/admin/statistical_reports_developer', '<span class="sidebar-mini">&nbsp;</span><span class="sidebar-normal">开发者统计</span>')
                            ->link('/admin/statistical_reports_user', '<span class="sidebar-mini">&nbsp;</span><span class="sidebar-normal">用户统计</span>')
                            ->setActive(function ($link) {
                                return $link->url() === explode('?', Request::getRequestUri())[0];
                            })
                    )
                    ->submenu(
                        Menu::new()
                            ->prepend('<a data-toggle="collapse" href="#password_reset"><i class="ti-receipt"></i><p>找回密码token<b class="caret"></b></p></a>')
                            ->addClass('collapse nav')
                            ->setAttribute('id', 'password_reset')
                            ->link('/admin/password_developer_reset', '<span class="sidebar-mini">&nbsp;</span><span class="sidebar-normal">开发者找回密码</span>')
                            ->link('/admin/password_user_reset', '<span class="sidebar-mini">&nbsp;</span><span class="sidebar-normal">用户找回密码</span>')
                            ->setActive(function ($link) {
                                return $link->url() === explode('?', Request::getRequestUri())[0];
                            })
                    )
                    ->submenu(
                        Menu::new()
                            ->prepend('<a data-toggle="collapse" href="#login_log"><i class="ti-save"></i><p>操作日志<b class="caret"></b></p></a>')
                            ->addClass('collapse nav')
                            ->setAttribute('id', 'login_log')
                            ->link('/admin/developer_log', '<span class="sidebar-mini">&nbsp;</span><span class="sidebar-normal">开发者登录日志</span>')
                            ->link('/admin/user_log', '<span class="sidebar-mini">&nbsp;</span><span class="sidebar-normal">用户登录日志</span>')
                            ->setActive(function ($link) {
                                return $link->url() === explode('?', Request::getRequestUri())[0];
                            })
                    )
                    ->submenu(
                        Menu::new()
                            ->prepend('<a data-toggle="collapse" href="#admin-manger"><i class="ti-star"></i><p>管理员相关<b class="caret"></b></p></a>')
                            ->addClass('collapse nav')
                            ->setAttribute('id', 'admin-manger')
                            ->link('/admin/admin', '<span class="sidebar-mini">&nbsp;</span><span class="sidebar-normal">管理员列表</span>')
                            ->link('/admin/reset-password', '<span class="sidebar-mini">&nbsp;</span><span class="sidebar-normal">修改密码</span>')
                            ->setActive(function ($link) {
                                return $link->url() === explode('?', Request::getRequestUri())[0];
                            })
                    )
                    ->setActive(function (Link $link) {
                        return $link->url() === explode('?', Request::getRequestUri())[0];
                    });
//                ->setActiveFromRequest();
            });
        }

    }
}
