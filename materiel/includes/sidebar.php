<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <div class="sb-sidenav-menu-heading">gestion de matériels </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-prescription-bottle-alt"></i></div>
                                Matériels
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="ajouter_categorie.php">ajouter catégorie</a>
                                    <a class="nav-link" href="ajouter_article.php">ajouter les articles</a>
                                    <a class="nav-link" href="affiche_article.php">afficher les articles</a>
                                    <a class="nav-link" href="affiche_rest_mat.php">Rest au depot</a>
                                </nav>
                            </div>
                                  
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsrt" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                                Demandes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsrt" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="affiche_demande.php">afficher demandes</a>
                                    <a class="nav-link" href="affiche_dotation.php">dotation medicament</a>
                                    <a class="nav-link" href="affiche_situation.php">Situation</a>
                                    <a class="nav-link" href="affiche_observation.php">Affiche l'observation</a>
                                    <a class="nav-link" href="situation_acs.php">Inventaire</a>
                                </nav>
                            </div>
                            
                        </div>
                    </div>
                    <!-- <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div> -->
                </nav>
            </div>