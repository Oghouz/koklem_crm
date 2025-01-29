<nav class="navbar navbar-vertical navbar-expand-lg">
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <!-- scrollbar removed-->
        <div class="navbar-vertical-content">
        <ul class="navbar-nav flex-column" id="navbarVerticalNav">
            <li class="nav-item">
            <!-- label-->
            <p class="navbar-vertical-label">DASHBOARD
            </p>
            <hr class="navbar-vertical-line" />
            <!-- parent pages-->
            <!-- parent pages-->
            <div class="nav-item-wrapper">
                <div class="nav-item-wrapper"><a class="nav-link label-1" href="{{route('home')}}" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <span data-feather="calendar"></span>
                        </span>
                        <span class="nav-link-text-wrapper">
                            <span class="nav-link-text">Dashboard</span>
                        </span>
                    </div>
                    </a>
                </div>
                <a class="nav-link dropdown-indicator label-1" href="#nv-CMD" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-CMD">
                    <div class="d-flex align-items-center">
                        <div class="dropdown-indicator-icon-wrapper">
                            <span class="fas fa-caret-right dropdown-indicator-icon"></span>
                        </div>
                        <span class="nav-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        </span>
                        <span class="nav-link-text">Commandes</span>
                    </div>
                </a>
                <div class="parent-wrapper label-1">
                    <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-CMD">
                        <li class="collapsed-nav-item-title d-none">Commandes
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('order.index')}}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text">Liste des commandes</span>
                                </div>
                            </a>
                        <!-- more inner pages-->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('order.create')}}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text">Nouvelle commande</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="nav-item-wrapper">
                    <a class="nav-link label-1" href="{{route('invoice.index')}}" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span data-feather="file"></span>
                            </span>
                            <span class="nav-link-text-wrapper">
                                <span class="nav-link-text">Factures</span>
                            </span>
                        </div>
                    </a>
                </div>
            </div>
            <!-- parent pages-->
            <div class="nav-item-wrapper">
                <a class="nav-link dropdown-indicator label-1" href="#nv-project-management" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-project-management">
                <div class="d-flex align-items-center">
                    <div class="dropdown-indicator-icon-wrapper">
                        <span class="fas fa-caret-right dropdown-indicator-icon"></span>
                    </div>
                    <span class="nav-link-icon"><span data-feather="clipboard"></span></span>
                    <span class="nav-link-text">Produits</span>
                </div>
                </a>
                <div class="parent-wrapper label-1">
                <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-project-management">
                    <li class="collapsed-nav-item-title d-none">Produits
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('product.index')}}">
                            <div class="d-flex align-items-center"><span class="nav-link-text">Liste des produits</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('product.create')}}">
                            <div class="d-flex align-items-center"><span class="nav-link-text">Nouveau produit</span>
                            </div>
                        </a>
                    </li>
                </ul>
                </div>
            </div>
            <!-- parent pages-->
            <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#nv-gallery" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-gallery">
                <div class="d-flex align-items-center">
                    <div class="dropdown-indicator-icon-wrapper">
                        <span class="fas fa-caret-right dropdown-indicator-icon"></span>
                    </div>
                    <span class="nav-link-icon">
                        <span data-feather="image"></span>
                    </span>
                    <span class="nav-link-text">Design</span>
                </div>
                </a>
                <div class="parent-wrapper label-1">
                <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-gallery">
                    <li class="collapsed-nav-item-title d-none">Design
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{route('design.index')}}">
                        <div class="d-flex align-items-center"><span class="nav-link-text">List des Designs</span>
                        </div>
                    </a>
                    <!-- more inner pages-->
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{route('design.create')}}">
                        <div class="d-flex align-items-center"><span class="nav-link-text">Nouveau Design</span>
                        </div>
                    </a>
                    <!-- more inner pages-->
                    </li>
                </ul>
                </div>
            </div>
            <!-- parent pages-->
            <div class="nav-item-wrapper">
                <a class="nav-link dropdown-indicator label-1" href="#nv-email" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-email">
                    <div class="d-flex align-items-center">
                        <div class="dropdown-indicator-icon-wrapper">
                            <span class="fas fa-caret-right dropdown-indicator-icon"></span>
                        </div>
                        <span class="nav-link-icon">
                            <span data-feather="users"></span>
                        </span>
                        <span class="nav-link-text">Clients</span>
                    </div>
                </a>
                <div class="parent-wrapper label-1">
                <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-email">
                    <li class="collapsed-nav-item-title d-none">Clients</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('client.index')}}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-text">Liste des clients</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('client.create')}}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-text">Nouveau client</span>
                            </div>
                        </a>
                    </li>
                </ul>
                </div>
            </div>
            <!-- parent pages-->
            <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#nv-file-manager" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-file-manager">
                <div class="d-flex align-items-center">
                    <div class="dropdown-indicator-icon-wrapper"><span class="fas fa-caret-right dropdown-indicator-icon"></span></div><span class="nav-link-icon"><span data-feather="folder"></span></span><span class="nav-link-text">File manager</span><span class="badge ms-2 badge badge-phoenix badge-phoenix-warning nav-link-badge">new</span>
                </div>
                </a>
                <div class="parent-wrapper label-1">
                <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-file-manager">
                    <li class="collapsed-nav-item-title d-none">File manager
                    </li>
                    <li class="nav-item"><a class="nav-link" href="apps/file-manager/grid-view.html">
                        <div class="d-flex align-items-center"><span class="nav-link-text">Grid view</span>
                        </div>
                    </a>
                    <!-- more inner pages-->
                    </li>
                    <li class="nav-item"><a class="nav-link" href="apps/file-manager/list-view.html">
                        <div class="d-flex align-items-center"><span class="nav-link-text">List view</span>
                        </div>
                    </a>
                    <!-- more inner pages-->
                    </li>
                </ul>
                </div>
            </div>
            <!-- parent pages-->
            <div class="nav-item-wrapper"><a class="nav-link label-1" href="apps/calendar.html" role="button" data-bs-toggle="" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="calendar"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Calendar</span></span>
                </div>
                </a>
            </div>
        </li>
        </ul>
        </div>
    </div>
    <div class="navbar-vertical-footer">
        <button class="btn navbar-vertical-toggle border-0 fw-semibold w-100 white-space-nowrap d-flex align-items-center"><span class="uil uil-left-arrow-to-left fs-8"></span><span class="uil uil-arrow-from-right fs-8"></span><span class="navbar-vertical-footer-text ms-2">Collapsed View</span></button>
    </div>
</nav>