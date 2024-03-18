<nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" style="width:200px;" href="#">

        <img class="lazy loaded w-100" src="https://stegback.com/root/storage/uploads/white-logo.png">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      @auth('stores')
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="{{route('RetailShop.store-dashboard')}}">Dashboard</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Products
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="{{route('RetailShop.product_list')}}">Product List</a></li>
              <li><a class="dropdown-item" href="#">Request New Product</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Orders
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="{{route('RetailShop.order_list')}}">Order List</a></li>
              <li><a class="dropdown-item" href="#">Create Offline Order</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('RetailShop.store-wallet',['s' => '','wallet-type'=>'commission'])}}">My Wallet <i class="bi bi-wallet2"></i> </a>
          </li>
          
        </ul>
        <div class="d-flex">
          <a class="nav-link text-white" href="{{route('RetailShop.logout')}}">Logout  </a>
      </div>
      </div>
      @endauth
      @auth('web')
        
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="{{route('RetailShop.admin-dashboard')}}">Dashboard</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Store
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="{{route('RetailShop.store_add')}}">Add New Store</a></li>
              <li><a class="dropdown-item" href="{{route('RetailShop.store_list')}}">Store List</a></li>
              <li><a class="dropdown-item" href="{{route('RetailShop.assign_product')}}">Assign Product</a></li>
            </ul>
          </li>
        </ul>
        <div class="d-flex">
            <a class="nav-link text-white" href="{{route('RetailShop.admin.logout')}}">Logout  </a>
        </div>
      </div>
      @endauth
    </div>
  </nav>

