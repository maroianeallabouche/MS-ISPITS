<nav class="sb-topnav navbar navbar-expand navbar-primary bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="./index.php">ISPITS-LAAYOUNE</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <p class="text-light mt-3">
            <?php echo $_SESSION['auth_user']['user_name'];   ?>
        </p>
    </form>

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
           
                <form action="allcode.php" method="post">
                    <button class="dropdown-item" name="logout" type="submit">Se déconnecter </button>
                </form>
            </ul>
        </li>
    </ul>
</nav>