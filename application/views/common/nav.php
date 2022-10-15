<style type="text/css">
  .lol {
    background-color: #073c77!important;
}
.lol2 {
    color: #fff!important;
    background-color: #073c77!important;
    border-color: #073c77!important;
}
</style>

<!-- Begin page -->
<div class="wrapper">
    <!-- ========== Left Sidebar Start ========== -->
    <div class="leftside-menu">

        <!-- LOGO -->
        <a href="inicio" class="logo text-center logo-light">
            <span class="logo-lg">
                <img src="<?php echo base_url() ?>assets/img/logo-idey-bco.svg" alt="" >
            </span>
            <span class="logo-sm">
                <img src="<?php echo base_url() ?>assets/img/gob.ico" alt="" >
            </span>
        </a>

        <!-- LOGO -->
        <a href="" class="logo text-center logo-dark">
            <span class="logo-lg">
                <img src="<?php echo base_url() ?>assets/img/gob.ico" alt="" >
            </span>
            <span class="logo-sm">
                <img src="<?php echo base_url() ?>assets/img/gob.ico" alt="" >
            </span>
        </a>

        <div class="h-100" id="leftside-menu-container" data-simplebar="">
            <!--- Menú -->
            <ul class="side-nav">
              <li class="side-nav-item">
                <a class="side-nav-link <?=(isset($menu) && $menu == "inicio") ? "lol": ""?>"
                 href="inicio">
                <i class="bi bi-house"></i>
                <span class="btn-label">Inicio</span>
                </a>
              </li>

              <!-- <li class="side-nav-item">
                <a class="side-nav-link ?=(isset($menu) && $menu == "voto") ? "lol": ""?>"
                 href="voto">
                <i class="bi bi-briefcase"></i>
                <span class="btn-label">Votos</span>
                </a>
              </li> -->

            <ul class="side-nav">
                 <?php if($idPerfil!=3){?>
              <li class="side-nav-item">
                <a class="side-nav-link <?=(isset($menu) && $menu == "asociacion") ? "lol": ""?>"
                 href="asociacion">
                <i class="bi bi-briefcase"></i>
                <span class="btn-label">Asociación</span>
                </a>
              </li>

             <ul class="side-nav">
              <li class="side-nav-item">
                <a class="side-nav-link <?=(isset($menu) && $menu == "modalidad") ? "lol": ""?>"
                 href="modalidad">
                <i class="bi bi-card-checklist"></i>
                <span class="btn-label">Modalidad</span>
                </a>
              </li>

              <ul class="side-nav">
              <li class="side-nav-item">
                <a class="side-nav-link <?=(isset($menu) && $menu == "nominado") ? "lol2": ""?>"
                 href="nominado">
                <i class="bi bi-person-lines-fill"></i>
                <span class="btn-label">Nominados</span>
                </a>
              </li>
                <?php }?>

              <ul class="side-nav">
              <li class="side-nav-item">
                <a class="side-nav-link <?=(isset($menu) && $menu == "voto") ? "lol": ""?>"
                 href="voto">
                <i class="bi bi-check2-circle"></i>
                <span class="btn-label">Voto</span>
                </a>
              </li>

               <?php if($idPerfil==1){?>
                <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarConfig" aria-expanded="false" aria-controls="sidebarConfig"
                class="side-nav-link <?=(in_array($menu,array("rentrenador","rdeportista","rfomento"))) ? "lol2": ""?>">
                <i class="bi bi-card-list"></i>
                <span> Resultados</span>
            </a>
            <div class="collapse" id="sidebarConfig" >
                <ul class="side-nav">
                    <li>
                        <a href="rdeportista"
                        class="side-nav-link <?=(isset($menu) && $menu == "rdeportista") ? "lol": ""?>">
                        <i class="bi bi-file-lock"></i>
                        <span class="btn-label">Deportista</span></a>
                    </li>
                    <li>
                        <a href="rentrenador"
                        class="side-nav-link <?=(isset($menu) && $menu == "rentrenador") ? "lol": ""?>">
                        <i class="bi bi-people"></i>
                        <span class="btn-label">Entrenador</span></a>
                    </li>
                    <li>
                        <a href="rfomento"
                        class="side-nav-link <?=(isset($menu) && $menu == "rfomento") ? "lol": ""?>">
                        <i class="bi bi-card-list"></i>
                        <span class="btn-label">Fomento</span></a>
                    </li>
                </ul>
            </div>
        </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarConfig" aria-expanded="false" aria-controls="sidebarConfig"
                class="side-nav-link <?=(in_array($menu,array("usuario","perfil","estatus"))) ? "lol2": ""?>">
                <i class="bi bi-gear"></i>
                <span> Configuración</span>
            </a>
            <div class="collapse" id="sidebarConfig" >
                <ul class="side-nav">
                    <li>
                        <a href="perfil"
                        class="side-nav-link <?=(isset($menu) && $menu == "perfil") ? "lol": ""?>">
                        <i class="bi bi-file-lock"></i>
                        <span class="btn-label">Perfil</span></a>
                    </li>
                    <li>
                        <a href="usuario"
                        class="side-nav-link <?=(isset($menu) && $menu == "usuario") ? "lol": ""?>">
                        <i class="bi bi-people"></i>
                        <span class="btn-label">Usuario</span></a>
                    </li>
                    <li>
                        <a href="estatus"
                        class="side-nav-link <?=(isset($menu) && $menu == "estatus") ? "lol": ""?>">
                        <i class="bi bi-card-list"></i>
                        <span class="btn-label">Estatus</span></a>
                    </li>
                </ul>
            </div>
        </li>
    <?php }?>


    <li class="side-nav-item">
        <a  class="side-nav-link" href="salir">
            <i class="bi bi-box-arrow-left"></i>
            <span class="btn-label">Salir</span>
        </a>
    </li>
</ul>
<!-- Fin menú-->
<div class="clearfix"></div>
</div>
<!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <div class="content">
        <!-- Topbar Start -->
        <div class="navbar-custom">
            <ul class="list-unstyled topbar-menu float-end mb-0">
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="account-user-avatar">
                            <img src="<?php echo base_url() ?>assets/img/users/user.png" alt="user-image" class="rounded-circle">
                        </span>
                        <span>
                            <span class="account-user-name"><?=$this->session->userdata('pb_usuario')?></span>
                            <span class="account-position"><?=$this->session->userdata('pb_perfil')?></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                        <!-- item-->
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Bienvenido!</h6>
                        </div>
                        <!-- item-->
                        <a href="contrasena" class="dropdown-item notify-item">
                            <i class="bi bi-key"></i>
                            <span>Cambiar contraseña</span>
                        </a>
                        <!-- item-->
                        <a href="salir" class="dropdown-item notify-item">
                            <i class="bi bi-box-arrow-left"></i>
                            <span>Salir</span>
                        </a>
                    </div>
                </li>
            </ul>
            <button class="button-menu-mobile open-left">
                <i class="bi bi-list"></i>
            </button>
        </div>