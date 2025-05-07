<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  {{-- Bootstrap CSS --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  {{-- Opcional: Font‑Awesome --}}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  {{-- Aquí se inyecta todo el contenido de la vista hija --}}
  <div class="min-vh-100">
    @yield('content')
  </div>
  <style>
    /* elimina el padding-left de la celda de acciones */
    .table td.actions {
      padding-left: 0 !important;
    }
    /* fija un ancho máximo para la columna de acciones */
    .table th.actions,
    .table td.actions {
      width: 180px;
    }
    /* opcional: reduce el gap entre botones si quieres aún más compactos */
    .table td.actions .btn {
      margin-right: 0.25rem;
    }
  </style>

  {{-- Bootstrap JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
