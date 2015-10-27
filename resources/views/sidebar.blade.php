<?php
/**
 *
 */

$user = Auth::getUser();
$route_selected = Request::route()->getName();

$menu = [
    'contact.index' => 'Новые контакты',
    'user.index'    => 'Пользователи',
    'profile'       => 'Профиль',
];
?>

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">&nbsp;</li>
            <?php foreach ($menu as $route_name => $label): ?>
                <li<?php if ($route_selected == $route_name) echo ' class="active"';?>>
                    <a href="<?php echo route($route_name); ?>"><span><?php echo $label; ?></span></a>
                </li>
            <?php endforeach; ?>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>