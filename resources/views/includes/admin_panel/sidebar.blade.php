<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="/assets/images/admin_logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
        <div style="direction: rtl">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                <div class="image">
                    <img src="/assets/images/hanie_heydari.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{auth()->user()->name}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="/admin" class="nav-link {{$sidebar_item == 'dashboard' ? 'active' : ''}}">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>داشبورد</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview {{in_array($sidebar_item, ['users', 'users_create']) ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                کاربران
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/users" class="nav-link {{$sidebar_item == 'users' ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>لیست کاربران</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/users/create" class="nav-link {{$sidebar_item == 'users_create' ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>ایجاد کاربر جدید</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview {{in_array($sidebar_item, ['courses', 'courses_create']) ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-laptop"></i>
                            <p>
                                دوره ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/courses" class="nav-link {{$sidebar_item == 'courses' ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>لیست دوره ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/courses/create" class="nav-link {{$sidebar_item == 'courses_create' ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>ایجاد دوره جدید</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview {{in_array($sidebar_item, ['orders', 'orders_create']) ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-shopping-bag"></i>
                            <p>
                                سفارشات
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/orders" class="nav-link {{$sidebar_item == 'orders' ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>لیست سفارشات</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/orders/create" class="nav-link {{$sidebar_item == 'orders_create' ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>ایجاد سفارش جدید</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview {{in_array($sidebar_item, ['payments', 'payments_create']) ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-money"></i>
                            <p>
                                پرداخت ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/payments" class="nav-link {{$sidebar_item == 'payments' ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>لیست پرداخت ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/payments/create" class="nav-link {{$sidebar_item == 'payments_create' ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>ایجاد پرداخت جدید</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview {{in_array($sidebar_item, ['discounts', 'discounts_create']) ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-money"></i>
                            <p>
                                کدهای تخفیف
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/discounts" class="nav-link {{$sidebar_item == 'discounts' ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>لیست کدهای تخفیف</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/discounts/create" class="nav-link {{$sidebar_item == 'discounts_create' ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>ایجاد کد تخفیف جدید</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="/logout" class="nav-link">
                            <i class="nav-icon fa fa-sign-out"></i>
                            <p>خروج</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>