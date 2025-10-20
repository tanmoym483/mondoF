<header class="navbar">
  <div class="logo">mondoF</div>

  <nav class="nav-links" id="navLinks">
      <a href="<?= base_url('/') ?>">Home</a>
      <a href="<?= base_url('menu') ?>">Menu</a>
      <a href="<?= base_url('offers') ?>">Offers</a>
      <a href="<?= base_url('contact') ?>">Contact</a>
      <?php if (session()->get('isLoggedIn')): ?>
  <span class="text-white me-3">
    Hi, <?= esc(session()->get('role')) ?> (<?= esc(session()->get('mobile')) ?>)
  </span>
  <a href="<?= base_url('logout') ?>" class="login-btn">Logout</a>
<?php else: ?>
  <button id="loginBtn" class="login-btn">Login / Register</button>
<?php endif; ?>

  </nav>

  <div class="menu-toggle" id="menuToggle">☰</div>
</header>

<!-- ---------- LOGIN MODAL ---------- -->
<div class="modal" id="loginModal">
  <div class="modal-content">
    <span class="close" id="closeModal">&times;</span>

    <h2>Login / Register</h2>
    <div class="role-tabs">
      <button class="role-btn active" data-role="customer">Customer</button>
      <button class="role-btn" data-role="restaurant">Restaurant Partner</button>
      <button class="role-btn" data-role="rider">Delivery Rider</button>
    </div>

    <div class="otp-form">
      <input type="text" id="phoneNumber" placeholder="Enter mobile number" maxlength="10">
      <button id="sendOtpBtn">Send OTP</button>

      <div id="otpSection" style="display:none;">
        <input type="text" id="otpCode" placeholder="Enter OTP" maxlength="6">
        <button id="verifyOtpBtn">Verify OTP</button>
      </div>
    </div>
  </div>
</div>

<style>
/* ----- NAVBAR BASE ----- */
.navbar {
  position: fixed;
  top: 0; left: 0; right: 0;
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
.login-btn {
  background: #fff;
  color: #ff6b6b;
  border: none;
  border-radius: 6px;
  padding: 6px 12px;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.3s ease;
}
.login-btn:hover {
  background: #ffe5e5;
}

/* ----- MOBILE MENU TOGGLE ----- */
.menu-toggle {
  display: none;
  font-size: 28px;
  color: white;
  cursor: pointer;
}

/* ----- RESPONSIVE NAVBAR ----- */
@media (max-width: 768px) {
  .menu-toggle { display: block; }
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
    transition: left 0.3s ease;
  }
  .nav-links.active { left: 0; }
}

/* ----- MODAL STYLES ----- */
.modal {
  display: none;
  position: fixed;
  z-index: 2000;
  top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(0,0,0,0.5);
  justify-content: center;
  align-items: center;
}
.modal-content {
  background: #fff;
  border-radius: 10px;
  padding: 20px;
  width: 90%;
  max-width: 400px;
  position: relative;
}
.close {
  position: absolute;
  top: 10px; right: 15px;
  font-size: 24px;
  cursor: pointer;
}
.role-tabs {
  display: flex;
  justify-content: space-around;
  margin: 10px 0 20px;
}
.role-btn {
  flex: 1;
  padding: 8px;
  background: #f3f3f3;
  border: none;
  cursor: pointer;
  transition: background 0.3s;
}
.role-btn.active {
  background: #ff6b6b;
  color: #fff;
}
.otp-form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.otp-form input {
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 6px;
}
.otp-form button {
  background: #ff6b6b;
  color: white;
  border: none;
  border-radius: 6px;
  padding: 10px;
  cursor: pointer;
}
.otp-form button:hover {
  background: #ff4040;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const menuToggle = document.getElementById("menuToggle");
  const navLinks = document.getElementById("navLinks");
  const loginBtn = document.getElementById("loginBtn");
  const modal = document.getElementById("loginModal");
  const closeModal = document.getElementById("closeModal");
  const roleButtons = document.querySelectorAll(".role-btn");
  const sendOtpBtn = document.getElementById("sendOtpBtn");
  const otpSection = document.getElementById("otpSection");

  // Toggle sidebar menu (mobile)
  menuToggle.addEventListener("click", () => navLinks.classList.toggle("active"));

  // Open/close modal
  loginBtn.addEventListener("click", () => modal.style.display = "flex");
  closeModal.addEventListener("click", () => modal.style.display = "none");
  window.addEventListener("click", e => {
    if (e.target === modal) modal.style.display = "none";
  });

  // Switch roles (Customer / Restaurant / Rider)
  roleButtons.forEach(btn => {
    btn.addEventListener("click", () => {
      roleButtons.forEach(b => b.classList.remove("active"));
      btn.classList.add("active");
    });
  });

  // Mock OTP flow
  // ✅ Send OTP
sendOtpBtn.addEventListener("click", () => {
  const phone = document.getElementById("phoneNumber").value;
  const role = document.querySelector(".role-btn.active").dataset.role;

  if (phone.length !== 10) {
    alert("Please enter a valid 10-digit number");
    return;
  }

  fetch("<?= base_url('auth/sendOtp') ?>", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "mobile=" + encodeURIComponent(phone) + "&role=" + encodeURIComponent(role)
  })
  .then(res => res.json())
  .then(data => {
    alert(data.message);
    if (data.status === "success") otpSection.style.display = "block";
  });
});

// ✅ Verify OTP
document.getElementById("verifyOtpBtn").addEventListener("click", () => {
  const otp = document.getElementById("otpCode").value;

  fetch("<?= base_url('auth/verifyOtp') ?>", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "otp=" + encodeURIComponent(otp)
  })
  .then(res => res.json())
  .then(data => {
    alert(data.message);
    if (data.status === "success") location.reload();
  });
});

});
</script>
