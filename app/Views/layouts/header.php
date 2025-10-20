<header class="navbar">
  <div class="logo">mondoF</div>

  <nav class="nav-links" id="navLinks">
      <a href="<?= base_url('/') ?>">Home</a>
      <a href="<?= base_url('menu') ?>">Menu</a>
      <a href="<?= base_url('offers') ?>">Offers</a>
      <a href="<?= base_url('contact') ?>">Contact</a>
  </nav>

  <div class="menu-toggle" id="menuToggle">
      ☰
  </div>
</header>

<style>
/* ----- NAVBAR BASE ----- */
.navbar {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  height: 70px;
  background-color: #ff6b6b;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 40px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  z-index: 1000;
}

.navbar .logo {
  font-size: 1.8rem;
  font-weight: bold;
  color: #fff;
}

.nav-links {
  display: flex;
  gap: 25px;
}

.nav-links a {
  color: white;
  text-decoration: none;
  font-weight: bold;
  transition: color 0.3s ease;
}

.nav-links a:hover {
  color: #ffe5e5;
}

/* ----- MOBILE MENU TOGGLE ----- */
.menu-toggle {
  display: none;
  font-size: 28px;
  color: white;
  cursor: pointer;
}

/* ----- RESPONSIVE BEHAVIOR ----- */
@media (max-width: 768px) {
  .menu-toggle {
    display: block;
  }

  .nav-links {
    position: fixed;
    top: 70px;
    left: -100%;
    width: 200px;
    height: calc(100vh - 70px);
    background-color: #ff6b6b;
    flex-direction: column;
    align-items: center;
    justify-content: start;
    padding-top: 30px;
    gap: 20px;
    transition: right 0.3s ease;
  }

  .nav-links.active {
    left: 0;
  }

  .nav-links a {
    font-size: 1.1rem;
  }
}

/* ----- Add padding to page content below header ----- */
/* body {
  margin: 0;
  padding-top: 70px; 
  font-family: Arial, sans-serif;
} */
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const menuToggle = document.getElementById("menuToggle");
  const navLinks = document.getElementById("navLinks");

  menuToggle.addEventListener("click", () => {
    navLinks.classList.toggle("active");
  });
});
</script>
