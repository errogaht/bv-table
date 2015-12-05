<?php
/**
 *
 */

$user = Auth::getUser();
$route_selected = Request::route()->getName();

$menu = [
    'contact.index' => 'Новые контакты',
    'user.index'       => [
        'label' => 'Пользователи',
        'show'  => $user->is_admin,
    ],
    'profile'       => 'Профиль',
    'contact.user'  => [
        'label'  => 'Мои контакты',
        'params' => [$user->id],
    ],
];

?>

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">&nbsp;</li>
            <?php foreach ($menu as $route_name => $opts): ?>
                <?php
                    $params = [];
                    $show = true;
                    if (is_array($opts)) {
                        extract($opts);
                    } else {
                        $label = $opts;
                    }
                ?>
                <?php if ($show): ?>
                <li<?php if ($route_selected == $route_name) echo ' class="active"';?>>
                    <a href="<?php echo route($route_name, $params); ?>"><span><?php echo $label; ?></span></a>
                </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>