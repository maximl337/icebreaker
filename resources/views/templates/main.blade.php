<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Icebreker - Know more about your lead</title>
    <link href="//fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <!-- Temp styles -->
    <style type="text/css">
		body {
			padding-top: 70px;
		}

    nav {
      /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#87e0fd+0,53cbf1+44,0689db+100 */
      background: #87e0fd; /* Old browsers */
      background: -moz-linear-gradient(left,  #87e0fd 0%, #53cbf1 44%, #0689db 100%); /* FF3.6-15 */
      background: -webkit-linear-gradient(left,  #87e0fd 0%,#53cbf1 44%,#0689db 100%); /* Chrome10-25,Safari5.1-6 */
      background: linear-gradient(to right,  #87e0fd 0%,#53cbf1 44%,#0689db 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#87e0fd', endColorstr='#0689db',GradientType=1 ); /* IE6-9 */

    }

    .navbar .navbar-header a.navbar-brand {
      color: white;
    }
    </style>

    @yield('head')
</head>
<body>
<header>
	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">IceBreaker</a>
        </div>
        <!-- <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../navbar/">Default</a></li>
            <li><a href="../navbar-static-top/">Static top</a></li>
            <li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>
          </ul>
        </div> --><!--/.nav-collapse -->
      </div>
    </nav>	
</header>

<div class="container">
	@yield('content')
</div>

<!-- Scripts -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript">
  loadingGif = 'http://i.imgur.com/25twkci.gif';
</script>
@yield('footer')


</body>
</html>