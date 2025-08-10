<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sweet Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('css/DrinkenStyle.css') }}" rel="stylesheet">
    <style>
  /* Achtergrondkleur navbar: zacht pastelroze */
  .navbar-custom {
    background: #ffd6e8;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  }
  /* Menu links met zachte mintgroen hover */
  .navbar-custom .nav-link {
    color: #5a3e85; /* paarsige kleur */
    font-weight: 600;
    transition: color 0.3s ease;
  }
  .navbar-custom .nav-link:hover,
  .navbar-custom .nav-link.active {
    color: #55c4a1; /* mintgroen */
  }
  /* Logo met warme oranje tint */
  .navbar-brand {
    color: #ff6f61;
    font-weight: 900;
    font-family: 'Comic Sans MS', cursive, sans-serif;
    font-size: 1.8rem;
  }
  .navbar-brand:hover {
    color: #55c4a1; /* mintgroen */
  }
  /* Icoontjes kleur en hover */
  .navbar-custom svg {
    fill: #ff7f50;
    transition: fill 0.3s ease;
  }
  .navbar-custom a:hover svg {
    fill: #ffb347;
  }
  /* Dropdown open op hover */
.navbar-nav .dropdown:hover > .dropdown-menu {
  display: block;
  margin-top: 0;
}

</style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">Sweet Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item mx-3">
          <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
        </li>

        <!-- Dropdown menu -->
        <li class="nav-item dropdown mx-3">
          <a class="nav-link dropdown-toggle {{ request()->is('producten*') ? 'active' : '' }}" href="#" 
            id="productenDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Producten
          </a>
          <ul class="dropdown-menu" aria-labelledby="productenDropdown">
            <li><a class="dropdown-item" href="#">Snoep</a></li>
            <li><a class="dropdown-item" href="#">Donuts</a></li>
            <li><a class="dropdown-item" href="#">Taart</a></li>
            <li><a class="dropdown-item" href="#">Cake</a></li>
            <li><a class="dropdown-item" href="{{ route('producten.drinken') }}">Drinken</a></li>
          </ul>
        </li>

        <li class="nav-item mx-3">
          <a class="nav-link" href="#">Over ons</a>
        </li>
        <li class="nav-item mx-3">
          <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
        </li>
      </ul>
    </div>

    <div class="d-flex align-items-center gap-4">
      <a href="#" title="Zoeken" aria-label="Zoeken">
        <!-- Zoek icoon SVG hier -->
      </a>

      <a href="#" title="Winkelwagen" aria-label="Winkelwagen">
        <!-- Winkelwagen icoon SVG hier -->
      </a>
    </div>
  </div>
</nav>


@yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
