<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div id="app"></div>
<div class="content">    Laravel</div>
<script src="{{ mix('js/app.js') }}"></script>

<script>
var channel = Echo.channel('my-channel');
channel.listen('MyEvent', function(data) {
  console.log();
  document.getElementById("app").innerHTML = data.message;
});
</script>
</body>
</html>
