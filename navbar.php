<section id="header">
    <div class="container">
        <nav class="nav">
            <input type="checkbox" id="nav-check">
            <div class="nav-header">
                <div class="nav-title">
                    <a href="#" id="logo-link">  
                        <img src="assets/img/Amity-online-logo.png" class="logo">
                    </a>
                </div>
            </div>
            <div class="nav-btn">
                <label for="nav-check">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>
            </div>
            <ul class="nav-list">
                <li><a href="#programmes">Courses</a></li>
                <li><a href="#approvals">Approvals</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#faqs">FAQ</a></li>
            </ul>
            <button class="topBtn" onclick="openPopup()">Apply Now</button>
        </nav>
    </div>
</section>
<script>  document.addEventListener("DOMContentLoaded", function() {
        var logoLink = document.getElementById("logo-link");
        var currentURL = window.location.href; 
        var domain = currentURL.split('/')[2]; 
        var newURL = "https://" + domain + "/";
        logoLink.setAttribute("href", newURL); 
    });</script>
