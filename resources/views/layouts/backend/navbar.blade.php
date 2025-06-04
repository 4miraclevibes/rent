        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="#" class="app-brand-link m-auto">
                    <span class="app-brand-logo demo">
                        <div class="d-flex flex-column align-items-center">
                            <img src="https://menara-agung.com/mawp/wp-content/uploads/2024/04/cropped-cropped-logo-red-1-1.png" alt="Donor Darah Logo" style="height: 40px; width: auto;">
                        </div>
                    </span>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1 mt-3 border-top">
                <!-- Dashboard -->
                <li class="menu-item {{ Route::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('cars.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-home"></i>
                        <div data-i18n="Dashboard">Dashboard</div>
                    </a>
                </li>
                <!-- Cars -->
                <li class="menu-item {{ Route::is('cars*') ? 'active' : '' }}">
                    <a href="{{ route('cars.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-user"></i>
                        <div data-i18n="Users">Cars</div>
                    </a>
                </li>
                <!-- Orders -->
                <li class="menu-item {{ Route::is('orders*') ? 'active' : '' }}">
                    <a href="{{ route('orders.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-user"></i>
                        <div data-i18n="Users">Orders</div>
                    </a>
                </li>
            </ul>
        </aside>
        <!-- / Menu -->
