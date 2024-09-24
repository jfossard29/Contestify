<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Back</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>style/Back_office/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="<?php echo base_url();?>index.php/back/afficher">Contestify</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Recherche..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo base_url();?>index.php/back/profil">Profil</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="<?php echo base_url();?>index.php/back/deconnexion">Deconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <?php if($_SESSION['role']=="J") {?>
                            <div class="sb-sidenav-menu-heading">Jury</div>
                            <a class="nav-link" href="<?php echo base_url();?>index.php/jury/concours">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Concours
                            </a>
                            </div>
                            <?php
                            } else {
                            ?>
                            <div class="sb-sidenav-menu-heading">Administrateur</div>
                            <a class="nav-link" href="<?php echo base_url();?>index.php/admin/comptes">
                                <div class="sb-nav-link-icon"><i class="fas fa-user fa-fw"></i></div>
                                Comptes
                            </a>
                            <a class="nav-link" href="<?php echo base_url();?>index.php/admin/concours">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Concours
                            </a>
                            
                            </div>
                            <?php
                            }
                            ?>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Connecté en tant que :</div>
                        <?php
                        echo $_SESSION['username']."<br>";
                            if($_SESSION['role']=="J") {
                                echo "(Jury)";
                            } else {
                                echo "(Administrateur)";
                            }
                        ?>
                    </div>
                </nav>
            </div>