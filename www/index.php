<!DOCTYPE html>
<html lang="en">
<head>
    <title>AppMonday by Nathan Fallet & Code Community</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bootstrap 4 landing page template for developers and startups">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <!-- FontAwesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js" integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9" crossorigin="anonymous"></script>
    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">

</head>

<body>
    <!-- ******HEADER****** -->
    <header id="header" class="header">
        <div class="container">
            <h1 class="logo">
                <a class="scrollto" href="#hero">
                    <span class="logo-icon-wrapper"><img class="logo-icon" src="assets/images/logo-icon.svg" alt="icon"></span>
                    <span class="text"><span class="highlight">APP</span>MONDAY</span></a>
            </h1><!--//logo-->
            <nav class="main-nav navbar-expand-md float-right navbar-inverse" role="navigation">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button><!--//nav-toggle-->

                <div id="navbar-collapse" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"><a class="active nav-link scrollto" href="#hero">About</a></li>
                        <li class="nav-item"><a class="nav-link scrollto" href="#submit">Submit an app</a></li>
                        <li class="nav-item"><a class="nav-link scrollto" href="#list">App list</a></li>
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </nav><!--//main-nav-->
        </div><!--//container-->
    </header><!--//header-->

    <div id="hero" class="hero-section">

      <div id="hero-carousel" class="hero-carousel carousel carousel-fade slide" data-ride="carousel" data-interval="10000">

  			<!-- Wrapper for slides -->
  			<div class="carousel-inner">

  				<div class="carousel-item item-1 active">
  					<div class="item-content container">
      					<div class="item-content-inner">

  				            <h2 class="heading">What is AppMonday?</h2>
  				            <p class="intro">Every Monday, we will share one app you submitted here in our Instagram story. Fill this form and share with us your project! It can be a website, a mobile app, an open source project, ... everything you coded.</p>
  				            <a class="btn btn-primary btn-cta scrollto" href="#submit">Submit an app</a>

      					</div><!--//item-content-inner-->
  					</div><!--//item-content-->
  				</div><!--//item-->

  			</div><!--//carousel-inner-->

  		</div><!--//carousel-->

    </div><!--//hero-->

    <div id="submit" class="about-section">
        <div class="container text-center">
            <h2 class="section-title">Submit your app!</h2>
            <p class="intro">Here is our form</p>

            <div class="items-wrapper row">

                <form id="form" class="col-md-6">
                    <div class="form-group">
                      <label for="name">App name:</label>
                      <input type="text" class="form-control" id="name" placeholder="My app">
                    </div>
                    <div class="form-group">
                      <label for="description">Description:</label>
                      <textarea class="form-control" rows="3" id="description"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="user">Instagram username:</label>
                      <input type="text" class="form-control" id="user" placeholder="@username">
                    </div>
                    <div class="form-group">
                      <label for="link">App link:</label>
                      <input type="text" class="form-control" id="link" placeholder="https://">
                    </div>
                    <div class="form-group">
                      <label for="logo">App logo: (optional - square)</label>
                      <input type="text" class="form-control" id="logo" placeholder="https://">
                    </div>
                    <input type="submit" class="btn btn-primary btn-cta" value="Submit">
                </form>
                <div class="col-md-6">
                  <p>Fill this form blabla...</p>
                </div>
            </div>
        </div><!--//container-->
    </div><!--//about-section-->

    <div id="list" class="testimonials-section">
        <div class="container">
            <h2 class="section-title text-center">App list</h2>
            <div id="applist"></div>
        </div><!--//container-->
    </div><!--//testimonials-->

    <footer class="footer text-center">
        <div class="container">
            <!--/* This template is released under the Creative Commons Attribution 3.0 License. Please keep the attribution link below when using for your own project. Thank you for your support. :) If you'd like to use the template without the attribution, you can buy the commercial license via our website: themes.3rdwavemedia.com */-->
            <small class="copyright">Designed with <i class="fas fa-heart"></i> by <a href="https://themes.3rdwavemedia.com/" target="_blank">Xiaoying Riley</a> for developers</small>


        </div><!--//container-->
    </footer>

    <!-- Javascript -->
    <script type="text/javascript" src="assets/plugins/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/plugins/jquery-scrollTo/jquery.scrollTo.min.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>

</body>
</html>
