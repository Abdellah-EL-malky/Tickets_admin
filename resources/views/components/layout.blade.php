<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>

<nav>
    <ul>
        <li>  <x-nav-link  href="/" :active="request()->is('/')" >Home</x-nav-link>  </li>
        <li>   <x-nav-link href="/about" :active="request()->is('about')" >About</x-nav-link></li>
        <li>   <x-nav-link href="/dashboard" :active="request()->is('dashboard') " type="button" >Dashboard</x-nav-link></li>

    </ul>
</nav>
<div>
    {{$heading }}
</div>
<main>

    {{ $slot }}
</main>

</body>

