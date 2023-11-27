<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Déche'Tse</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/main.css" rel="stylesheet">
</head>
<body>

  <!-- ======= Header ======= -->
  <section id="topbar" class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">hello@dechetse.fr</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+33 0 12 34 56 78</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section><!-- End Top Bar -->

  <header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/logo.png" alt="">
        <h1>Déche'Tse<span>.</span></h1>
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.html#home">Accueil</a></li>
          <li><a href="index.html#about">Comment ça marche ?</a></li>
          <li><a href="index.html#">Des stats pour mieux comprendre !</a></li>
          <li><a href="fast-scan.php">Scan rapide</a></li>
          <li class="dropdown"><a href="#"><span>Pour aller plus loin</span><i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li class="dropdown"><a href="#"><span>About us</span><i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="index.html#">Le projet</a></li>
                  <li><a href="index.html#team">Notre équipe</a></li>
                  <li><a href="index.html#contact">Nous contacter</a></li>
                </ul>
              </li>
              <li><a href="index.html#portfolio">S'informer</a></li>
              <li><a href="index.html#recent-news">Les news</a></li>
              <li><a href="privacy-policy.html">Vos données</a></li>
              <li><a href="index.html#faq">FAQ</a></li>
              <li><a href="index.html#testimonials">Les commentaires</a></li>
              <li><a href="index.html#">Problèmes de connexion</a></li>
            </ul>
          </li>
          <li><!-- <a href=" connexion.html">Connexion</a> --> <a href="blog.html">Connexion</a></li>
        </ul>
      </nav><!-- .navbar -->

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->
  <!-- End Header -->

  <!-- ======= Breadcrumbs ======= -->
  <div class="breadcrumbs">
    <div class="page-header d-flex align-items-center" style="background-image: url('');">
      <div class="container position-relative">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6 text-center">
            <h2>Scan rapide</h2>
            <p>Vous hésitez à créer votre compte pour rejoindre l'aventure Deche'Tse ? <br><b>Faites un scan rapide et découvrez l'outil que vous ne quitterez plus !</b></p>
          </div>
        </div>
      </div>
    </div>
    <nav>
      <div class="container">
        <ol>
          <li><a href="index.html">Accueil</a></li>
          <li>Scan rapide</li>
        </ol>
      </div>
    </nav>
  </div><!-- End Breadcrumbs -->

  <script type="text/javascript" src="./SubmitErrorHandler.js"></script>

  <form action="fast-scan.php" method="post" enctype="multipart/form-data">
    Sélectionnez une image :
    <input type="file" name="fileToUpload">
    <input type="submit" value="Télécharger" name="submit">
  </form>

  <?php
  
	require 'database.php';
	
	session_start();
	
	$user = $_SESSION['login'];
    $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * from users where username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($user));
        $info_user = $q->fetch(PDO::FETCH_ASSOC);
		
		$sql = "SELECT * from recycling_stalk where user_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($info_user['user_id']));
        $data = $q->fetch(PDO::FETCH_ASSOC);
	
    if(isset($_POST["submit"])) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<img src='$target_file' alt='image'/>";
            $test = shell_exec("C:/Users/julie/AppData/Local/Programs/Python/Python311/python.exe model.py " . $target_file);
            switch($test) {
				case 'G&M':
					$nb = $data['nb_g_m'] + 1;
					$req = $pdo->prepare('INSERT INTO recycling_stalk(nb_g_m) VALUES(:nb) where user_id=:user_id');
					
					$req->execute(array(

						'nb' => $nb,

						'user_id' => $info_user['user_id']
					));
					$data = $req->fetch(PDO::FETCH_ASSOC);
					break;
				case 'Organic':
					$nb = $data['nb_organic'] + 1;
					$req = $pdo->prepare('INSERT INTO recycling_stalk(nb_organic) VALUES(:nb) where user_id=:user_id');
					
					$req->execute(array(

						'nb' => $nb,

						'user_id' => $info_user['user_id']
					));
					$data = $req->fetch(PDO::FETCH_ASSOC);
					break;
				case 'Other':
					$nb = $data['nb_other'] + 1;
					$req = $pdo->prepare('INSERT INTO recycling_stalk(nb_other) VALUES(:nb) where user_id=:user_id');
					
					$req->execute(array(

						'nb' => $nb,

						'user_id' => $info_user['user_id']
					));
					$data = $req->fetch(PDO::FETCH_ASSOC);
					break;
				case 'Paper':
					$nb = $data['nb_paper'] + 1;
					$req = $pdo->prepare('INSERT INTO recycling_stalk(nb_paper) VALUES(:nb) where user_id=:user_id');
					
					$req->execute(array(

						'nb' => $nb,

						'user_id' => $info_user['user_id']
					));
					$data = $req->fetch(PDO::FETCH_ASSOC);
					break;
				case 'Plastic':
					$nb = $data['nb_plastic'] + 1;
					$req = $pdo->prepare('INSERT INTO recycling_stalk(nb_plastic) VALUES(:nb) where user_id=:user_id');
					
					$req->execute(array(

						'nb' => $nb,

						'user_id' => $info_user['user_id']
					));
					$data = $req->fetch(PDO::FETCH_ASSOC);
					break;
			}

        } else {
            echo "Désolé, il y a eu une erreur lors du téléchargement de l'image.";
        }
		Database::disconnect();
    }
  ?>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <a href="index.html" class="logo d-flex align-items-center">
            <span>Déche'Tse</span>
          </a>
          <p>Avec Déche'Tse, recycler n'est plus une option.</p>
          <div class="social-links d-flex mt-4">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Liens utiles</h4>
          <ul>
            <li><a href="index.html#home">Accueil</a></li>
            <li><a href="index.html#">Comment ça marche ?</a></li>
            <li><a href="index.html#">Les stats !</a></li>
            <li><a href="index.html#team">Notre équipe</a></li>
            <li><a href="index.html#contact">Nous contacter</a></li>
            <li><a href="privacy-policy.html">Polique de traitement des données</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Nos services</h4>
          <ul>
            <li><a href="index.html#">Le projet</a></li>
            <li><a href="index.html#portfolio">S'informer</a></li> <!-- comment ça marche-->
            <li><a href="fast-scan.html">Scanner un déchet</a></li>
            <li><a href="">Connexion</a></li>
            <li><a href="index.html#recent-news">Les actus</a></li>
            <li><a href="index.html#testimonials">Les avis</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Nous contacter</h4>
          <p>
            25 rue Docteur Annino<br>
            Saint-Étienne, 42000<br>
            France<br><br>
            <strong>Téléphone :</strong> +33 0 12 34 56 78<br>
            <strong>Email :</strong> hello@dechetse.fr<br>
          </p>
        </div>
      </div>
    </div>

    <div class="container mt-4">
      <div class="copyright">
        &copy; Copyright <strong><span>Déche'Tse</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <strong><span>Julien MUGUET</span></strong>
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>