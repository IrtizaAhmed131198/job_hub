<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Job Hub</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{url('public/admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('public/admin/dist/css/adminlte.min.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{url('public/admin/plugins/summernote/summernote-bs4.min.css')}}">
  <!-- CodeMirror -->
  {{-- <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css"> --}}
  <link rel="icon" type="image/png" href="{{ url('public/front/images/favicon.png') }}">

  <link rel="stylesheet" href="{{url('public/admin/plugins/codemirror/codemirror.css')}}">
  <link rel="stylesheet" href="{{url('public/admin/plugins/codemirror/theme/monokai.css')}}">
    {{-- <link rel="stylesheet" href="{{url('public/admin/dist/css/line-awesome.min.css')}}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <style>
    body::before {
            background-image: none;
            background: url("{{ url('front/images/loginBackground.png') }}") no-repeat center center fixed;
            background-size: cover;
            opacity: 0.5; /* Adjust the opacity based on your preference */
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            position: fixed;
            z-index: -2;
        }
    thead,
    tfoot,
    .card-header {
      background-color: #1F2E80 !important;
      color: #fff !important;
    }

    .btn-custom {
      color: #fff !important;
      background-color: #1F2E80 !important;
      border-color: #13237e !important;
    }

    .btn-custom:hover {
      color: #fff !important;
      background-color: #16205a !important;
      border-color: #0e1a5c !important;
    }

    .page-item.active .page-link {
      background-color: #1F2E80 !important;
      border-color: #13237e !important;
    }

    thead th {
      white-space: nowrap;
    }

    .main-footer {
      text-align: center;
      font-size: 13px;
    }

    .main-footer span{
      font-weight: 600;
    }

    .main-footer span a{
      color: #1F2E80;
    }
    [class*=sidebar-dark-] .nav-sidebar>.nav-item.menu-open>.nav-link, [class*=sidebar-dark-] .nav-sidebar>.nav-item:hover>.nav-link, [class*=sidebar-dark-] .nav-sidebar>.nav-item>.nav-link:focus {
      background-color: #1F2E80;
      color: #fff !important;
    }
    .content-header .container-fluid .row .col-sm-6 h1 {
      font-size: 1.5rem;
    }
  </style>
</head>
