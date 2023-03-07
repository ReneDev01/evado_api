<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-orange elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
      <img src=" {{asset("assets/dist_admin/img/AdminLTELogo.png")}} " alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">D-bla Dash</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src=" {{asset("assets/dist_admin/img/user2-160x160.jpg")}} " class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> {{Auth::user()->name}} {{Auth::user()->surname}} </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href=" {{route("customer.index")}} " class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Clients
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="" class="nav-link active">
              <i class="fas fa-tag nav-icon"></i>
              <p>
                Prix de livraison
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href=" {{route("price.index")}} " class="nav-link ">
                  <i class="fas fa-align-left nav-icon"></i>
                  <p>Liste</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{route("price.create")}} " class="nav-link ">
                  <i class="fab fa-adversal nav-icon"></i>
                  <p>Ajouter</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item ">
            <a href="" class="nav-link active">
              <i class="fas fa-tag nav-icon"></i>
              <p>
                Commandes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href=" {{route("order.all")}} " class="nav-link ">
                  <i class="fas fa-align-left nav-icon"></i>
                  <p>Toute les commandes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{route("order.progress")}} " class="nav-link ">
                  <i class="fas fa-align-left nav-icon"></i>
                  <p>En cours</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{route("order.delived")}} " class="nav-link ">
                  <i class="fas fa-align-left nav-icon"></i>
                  <p>Livrées</p>
                </a>
              </li>
            </ul>
          </li>
         {{--  <li class="nav-item ">
            <a href="" class="nav-link active">
              <i class="fas fa-tag nav-icon"></i>
              <p>
                Produits
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href=" {{route("meal.index")}} " class="nav-link ">
                  <i class="fas fa-align-left nav-icon"></i>
                  <p>Liste</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{route("meal.create")}} " class="nav-link ">
                  <i class="fab fa-adversal nav-icon"></i>
                  <p>Ajouter</p>
                </a>
              </li>
            </ul>
          </li> --}}
          <li class="nav-item ">
            <a href="" class="nav-link active">
              <i class="fas fa-tag nav-icon"></i>
              <p>
                Types
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href=" {{route("type.index")}} " class="nav-link ">
                  <i class="fas fa-align-left nav-icon"></i>
                  <p>Liste</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{route("type.create")}} " class="nav-link ">
                  <i class="fab fa-adversal nav-icon"></i>
                  <p>Ajouter</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item ">
            <a href="" class="nav-link active">
              <i class="fas fa-tag nav-icon"></i>
              <p>
                Parteners
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href=" {{route("partener.index")}} " class="nav-link ">
                  <i class="fas fa-align-left nav-icon"></i>
                  <p>Liste</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{route("partener.create")}} " class="nav-link ">
                  <i class="fab fa-adversal nav-icon"></i>
                  <p>Ajouter</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link active">
              <i class="fas fa-tag nav-icon"></i>
              <p>
                Menus
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href=" {{route("group.index")}} " class="nav-link ">
                  <i class="fas fa-align-left nav-icon"></i>
                  <p>Liste</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{route("group.create")}} " class="nav-link ">
                  <i class="fab fa-adversal nav-icon"></i>
                  <p>Ajouter</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item ">
            <a href="" class="nav-link active">
              <i class="fas fa-tag nav-icon"></i>
              <p>
                Publicités
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href=" {{route("pub.index")}} " class="nav-link ">
                  <i class="fas fa-align-left nav-icon"></i>
                  <p>Liste</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{route("pub.create")}} " class="nav-link ">
                  <i class="fab fa-adversal nav-icon"></i>
                  <p>Ajouter</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item ">
            <a href="" class="nav-link active">
              <i class="fas fa-tag nav-icon"></i>
              <p>
                Promotions
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href=" {{route("promo.index")}} " class="nav-link ">
                  <i class="fas fa-align-left nav-icon"></i>
                  <p>Liste</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{route("promo.create")}} " class="nav-link ">
                  <i class="fab fa-adversal nav-icon"></i>
                  <p>Ajouter</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item ">
            <a href="" class="nav-link active">
              <i class="fas fa-tag nav-icon"></i>
              <p>
                Livreurs
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href=" {{route("delever.index")}} " class="nav-link ">
                  <i class="fas fa-align-left nav-icon"></i>
                  <p>Liste</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{route("delever.create")}} " class="nav-link ">
                  <i class="fab fa-adversal nav-icon"></i>
                  <p>Ajouter</p>
                </a>
              </li>
            </ul>
          </li> 
          <li class="nav-item ">
            <a href="" class="nav-link active">
              <i class="fas fa-users-cog nav-icon"></i>
              <p>
                Utilisateurs
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href=" {{route("user.index")}} " class="nav-link ">
                  <i class="fas fa-align-left nav-icon"></i>
                  <p>Liste</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{route("user.create")}} " class="nav-link ">
                  <i class="fab fa-adversal nav-icon"></i>
                  <p>Ajouter</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
        <br>
        <br>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>