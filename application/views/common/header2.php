<!doctype html>
  <html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?=base_url()?>assets/img/gob.ico">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/bootstrap5/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/jquery.toast.min.css">
     <link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>assets/css/trirand/ui.jqgrid-bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>assets/css/estilos.css">
    <link href="<?=base_url()?>assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/icons.css" >
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/sweetalert2/sweetalert2.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/select2-bootstrap-5-theme.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/chosen/component-chosen.css">
    <title>Premio estatal - <?=$SECCIONACTUAL?></title>
    <style>
    /* width */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }
    /* Track */
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }
    /* Handle */
    ::-webkit-scrollbar-thumb {
      background: #888;
      border-radius: 10px;
    }
    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
      background: #555;
    }
  </style>
  </head>

  <body class="loading" data-layout-config='{"leftSideBarTheme":"dark", "darkMode":false, "leftSidebarCondensed":true, "leftSidebarScrollable":false}'>
    <input type="hidden" id="token" value="<?=$tok?>">
    <input type="hidden" id="token_name" value="<?=$tok_name?>">
   <?php
   if(!$this->session->flashdata("usuario_incorrecto") && $this->session->userdata('pb_LogIn')){
    include('nav.php');
   }
   ?>