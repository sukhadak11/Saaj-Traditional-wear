document.addEventListener("DOMContentLoaded", function() {
    const loginButton = document.getElementById("login-button");
    const logoutButton = document.getElementById("logout-button");
  
    loginButton.addEventListener("click", function(event) {
      event.preventDefault();
      // Perform login logic here
  
      // Show the logout button and hide the login button
      logoutButton.classList.remove("hidden");
      loginButton.classList.add("hidden");
    });
  
    logoutButton.addEventListener("click", function(event) {
      event.preventDefault();
      // Perform logout logic here
  
      // Show the login button and hide the logout button
      loginButton.classList.remove("hidden");
      logoutButton.classList.add("hidden");
    });
  });
  