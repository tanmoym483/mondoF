<header class="navbar">
  <div class="logo">mondoF</div>
  <nav class="nav-links" id="navLinks">
      <a href="<?= base_url('/') ?>">Home</a>
      <a href="<?= base_url('menu') ?>">Menu</a>
      <a href="<?= base_url('offers') ?>">Offers</a>
      <a href="<?= base_url('contact') ?>">Contact</a>
      <?php if (!session()->get('user')): ?>
        <button id="loginBtn" class="login-btn">Login / Register</button>
      <?php else: ?>
        <span class="user-info">Hi, <?= esc(session()->get('user')['mobile']) ?> (<?= esc(session()->get('user')['role']) ?>)</span>
        <a href="<?= base_url('auth/logout') ?>" class="logout-btn">Logout</a>
      <?php endif; ?>
  </nav>
  <div class="menu-toggle" id="menuToggle">☰</div>
</header>

<!-- Modal -->
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

<script>
document.addEventListener("DOMContentLoaded", function() {
  const loginBtn = document.getElementById("loginBtn");
  const modal = document.getElementById("loginModal");
  const closeModal = document.getElementById("closeModal");
  const sendOtpBtn = document.getElementById("sendOtpBtn");
  const verifyOtpBtn = document.getElementById("verifyOtpBtn");
  const otpSection = document.getElementById("otpSection");
  const roleButtons = document.querySelectorAll(".role-btn");
  let selectedRole = "customer";

  // Toggle modal
  if (loginBtn) loginBtn.addEventListener("click", () => modal.style.display = "flex");
  if (closeModal) closeModal.addEventListener("click", () => modal.style.display = "none");

  // Switch roles
  roleButtons.forEach(btn => {
    btn.addEventListener("click", () => {
      roleButtons.forEach(b => b.classList.remove("active"));
      btn.classList.add("active");
      selectedRole = btn.dataset.role;
    });
  });

  // Send OTP
  sendOtpBtn.addEventListener("click", () => {
    const mobile = document.getElementById("phoneNumber").value;
    if (mobile.length !== 10) {
      alert("Enter valid mobile number");
      return;
    }

    fetch("<?= base_url('auth/sendOtp') ?>", {
      method: "POST",
      headers: {"Content-Type": "application/x-www-form-urlencoded"},
      body: new URLSearchParams({mobile, role: selectedRole})
    })
    .then(res => res.json())
    .then(data => {
      if (data.status === "success") {
        alert("OTP sent to " + mobile);
        otpSection.style.display = "block";
      } else {
        alert(data.msg);
      }
    });
  });

  // Verify OTP
  verifyOtpBtn.addEventListener("click", () => {
    const mobile = document.getElementById("phoneNumber").value;
    const otp = document.getElementById("otpCode").value;

    fetch("<?= base_url('auth/verifyOtp') ?>", {
      method: "POST",
      headers: {"Content-Type": "application/x-www-form-urlencoded"},
      body: new URLSearchParams({mobile, otp})
    })
    .then(res => res.json())
    .then(data => {
      alert(data.msg);
      if (data.status === "success") location.reload();
    });
  });
});
</script>
