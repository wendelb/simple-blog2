<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{$html_title}</title>

    <!-- Bootstrap -->
    <link href="/assets/styles.css" rel="stylesheet">
</head>
<body>
<a href="/">
    <img src="/assets/banner.png" alt="Banner" />
</a>

<div class="nav">
    <a href="/">Startseite
        {if $loggedin}
        <a href="/?page=newpage">Eintrag hinzufügen</a>
        <a href="/?page=login&action=logout">Logout</a>
        {else}
        <a href="/?page=login">Login</a>
        {/if}
</div>