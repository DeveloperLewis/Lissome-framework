<nav class = "navbar navbar-expand-lg bg-dark navbar-dark">
    <div class = "container">
        <button class = "navbar-toggler" type = "button" data-bs-toggle = "collapse" data-bs-target = "#navbarSupportedContent"
                aria-controls = "navbarSupportedContent" aria-expanded = "false" aria-label = "Toggle navigation">
            <span class = "navbar-toggler-icon"></span>
        </button>
        <div class = "collapse navbar-collapse" id = "navbarSupportedContent">
            <ul class = "navbar-nav mx-auto mb-2 mb-lg-0">
                <li class = "nav-item text-center">
                    <a class = "nav-link" href = "/">Home</a>
                </li>
                <li class = "nav-item text-center">
                    <a class = "nav-link" href = "/docs">Docs</a>
                </li>

                <?php if (isLoggedIn()) { ?>
                    <li class = "nav-item text-center">
                        <a class = "nav-link" href = "/user/logout">Logout</a>
                    </li>
                <?php } else { ?>
                    <li class = "nav-item text-center">
                        <a class = "nav-link" href = "/user/login">Login</a>
                    </li>

                    <li class = "nav-item text-center">
                        <a class = "nav-link" href = "/user/register">Register</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
