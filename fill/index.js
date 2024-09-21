function toggleDropdown() {
    document.getElementById("loginDropdown").classList.toggle("show");
  }
  window.onclick = function(event) {
    if (!event.target.matches('.login-btn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
