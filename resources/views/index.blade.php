<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="user-id" content="{{ auth()->user() ? auth()->user()->id : null }}">
    <meta name="user-roles" content="{{ auth()->user() ? json_encode(auth()->user()->getRoleNames()) : null }}">
    <link rel="stylesheet" href="/css/styles.css">
    <title>MfStock</title>
</head>
<body>
<div id="app">
    <v-header></v-header>
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <router-view></router-view>
        </div>
    </section>
    <v-footer></v-footer>
</div>

<script src="/js/app.js"></script>
</body>
</html>
