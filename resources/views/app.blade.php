<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="navbar-logo" content=""/>
    <meta property="og:title" content=""/>
    <meta property="og:type" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:image" content=""/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:title" content=""/>
    <meta name="twitter:description" content=""/>
    <meta name="twitter:image" content=""/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta property="fb:app_id" content=""/>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}"/>

    <title>CLOUDESK.SPACE</title>

    <link rel="stylesheet" href="https://cdn.cloudesk.space/front/tailwind.min.css"/>
    <link rel="stylesheet" href="https://cdn.cloudesk.space/front/styles.css"/>
</head>
<body>
<noscript>You need to enable JavaScript to run this app.</noscript>
<div id="root"></div>

<script>
    var API_URL = "{{ env('API_URL') }}";
</script>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
