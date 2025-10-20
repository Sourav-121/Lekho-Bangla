  const loginBtn = document.getElementById("loginBtn");
      const loginModal = document.getElementById("loginModal");
      const googleBtnContainer = document.getElementById("googleBtnContainer");
      const userLogo = document.getElementById("userLogo");
      const userModal = document.getElementById("userModal");
      const closeSidebar = document.getElementById("closeSidebar");
      const modalName = document.getElementById("modalName");
      const modalEmail = document.getElementById("modalEmail");
      const modalPic = document.getElementById("modalPic");
      const logoutBtn = document.getElementById("logoutBtn");

      let googleButtonRendered = false;

      // ✅ Initialize Google when page loads (fixes missing client_id error)
      window.onload = () => {
        google.accounts.id.initialize({
          client_id:
            "65165833933-jjeav817ef93q86r53i27e3ft6mgc8ms.apps.googleusercontent.com",
          callback: handleCredentialResponse,
        });
      };

      // Session check
      window.addEventListener("DOMContentLoaded", () => {
        fetch("check_session.php")
          .then((res) => res.json())
          .then((data) => {
            if (data.status === "logged_in") {
              loginBtn.style.display = "none";
              userLogo.style.display = "inline-block";
              // userLogo.src = data.user.picture;
              // modalPic.src = data.user.picture;
              userLogo.src = 'image_proxy.php';
              modalPic.src = 'image_proxy.php';
              modalName.textContent = data.user.name;
              modalEmail.textContent = data.user.email;
            } else {
              loginBtn.style.display = "inline-block";
              userLogo.style.display = "none";
            }
          });
      });

      // Open modal & render Google button
      loginBtn.addEventListener("click", () => {
        loginModal.classList.add("active");
        if (!googleButtonRendered) {
          google.accounts.id.renderButton(googleBtnContainer, {
            theme: "outline",
            size: "large",
            text: "signin_with",
          });
          googleButtonRendered = true;
        }
      });

      // Close modal when clicking outside
      loginModal.addEventListener("click", (e) => {
        if (e.target === loginModal) loginModal.classList.remove("active");
      });

      // Handle Google login
      function handleCredentialResponse(response) {
        fetch("login.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: "credential=" + response.credential,
        })
          .then((res) => res.json())
          .then((data) => {
            if (data.status === "success") {
              loginModal.classList.remove("active");
              loginBtn.style.display = "none";

              userLogo.src = 'image_proxy.php';
        
              userLogo.style.display = "inline-block";

              modalName.textContent = data.user.name;
              modalEmail.textContent = data.user.email;
              
              modalPic.src = 'image_proxy.php';
            } else {
              alert("Login failed: " + data.error);
            }
          });
      }

      // Logout
      logoutBtn.addEventListener("click", () => {
        fetch("logout.php")
          .then((res) => res.json())
          .then((data) => {
            if (data.status === "logged_out") {
              loginBtn.style.display = "inline-block";
              userLogo.style.display = "none";
              userModal.classList.remove("active");
            }
          });
      });

      // Toggle sidebar when clicking user logo
      userLogo.addEventListener("click", (e) => {
        e.stopPropagation();
        userModal.classList.toggle("active");
      });

      // Close sidebar with close button
      closeSidebar.addEventListener("click", () => {
        userModal.classList.remove("active");
      });

      // Close sidebar if clicking outside of it
      document.addEventListener("click", (e) => {
        if (
          userModal.classList.contains("active") &&
          !userModal.contains(e.target) &&
          e.target !== userLogo
        ) {
          userModal.classList.remove("active");
        }
      });


      // Add error handling for images
userLogo.onerror = function() {
  console.error('User logo failed to load');
  this.style.display = 'none'; // Hide broken image
};

modalPic.onerror = function() {
  console.error('Modal pic failed to load');
  // You could set a fallback image here
  // this.src = 'fallback-image.jpg';
};