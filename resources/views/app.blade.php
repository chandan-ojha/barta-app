<!DOCTYPE html>
<html>
  <head>
    <title>Barta App</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <!-- tailwindcss cdn -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- AlpineJS CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    @vite('resources/js/app.js')
    @inertiaHead
    <style>
        * {
          font-family: "Inter", sans-serif;
        }
    </style>
  </head>
  <body class="bg-gray-100">
    @inertia
  </body>
</html>
