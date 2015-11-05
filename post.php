<?php
session_start();
// includiamo il file di configurazione
@include "config.php";

 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="bootstrap/css/leftside.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">I Bipolaristi</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->
                <?php


                // controlliamo che sia stato inviato un id numerico alla pagina
                if(isset($_GET['id'])&&(is_numeric($_GET['id']))){
                  // valorizziamo la variabile relativa all'id dell'articolo e includiamo il file di configurazione
                  $art_id = $_GET['id'];
                  @include "config.php";

                  // selezioniamo dalla tabella i dati relativi all'articolo
                  $sql = "SELECT * FROM tb3_post WHERE id_post='$art_id'";
                  $query = @mysql_query($sql) or die (mysql_error());

                  // se per quell'id esiste un articolo..
                  if(mysql_num_rows($query) > 0){
                    // ...estraiamo i dati e mostriamoli a video
                    $row = mysql_fetch_array($query) or die (mysql_error());
                    $autore = stripslashes($row['id_user']);
                    $titolo = stripslashes($row['title_post']);
                    $data = $row['data_post'];
                    $articolo = ($row['article_post']);

                    $nomecognomeSQL = "SELECT name_user, surname_user FROM tb1_user WHERE id_user = '".$autore."'";
                    $queryAutore = @mysql_query($nomecognomeSQL) or die (mysql_error());
                    if(mysql_num_rows($queryAutore) > 0)
                            if ($riga = mysql_fetch_array($queryAutore)) {
                              $nome_autore = $riga['name_user'];
                              $cognome_autore    = $riga['surname_user'];
                            }
                   

                    echo "<h1 class=\"page-header\">".$titolo."</h1>"."<p class=\"lead\">by <a href=\"#\">". $nome_autore . " " .$cognome_autore. "</a></p>";
                    $data = preg_replace('/^(.{4})-(.{2})-(.{2})$/','$3-$2-$1', $data);
                    echo "<p><span class=\"glyphicon glyphicon-time\"></span> Posted on " . $data . " </p><hr>";
                    echo "<img class=\"img-responsive\" src=\"http://placehold.it/900x300\" alt=\"\"><br>";
                    echo "<p>". $articolo ."</p><hr>";
                    
                    echo "<div id=\"fb-root\"></div><script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;js.src = \"//connect.facebook.net/it_IT/all.js#xfbml=1\";fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                        <div id='social'>
                        <div class=\"fb-share-button\" data-href=\"articolo.php?id=".$art_id."\" data-width=\"200\" data-type=\"button\"></div>";
                    echo " <a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-lang=\"it\" data-count=\"none\">Tweet</a></div>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>";
                                  
                    // link alla pagina dei commenti  
                    //echo "<br><a href=\"insert_comment.php?id=$art_id\">Invia un commento</a><br><br>";

                    // visualizzianmo tutti i commenti
                    /*$sql_com = "SELECT com_autore, com_testo FROM commenti WHERE com_art='$art_id'";
                    $query_com = @mysql_query($sql_com) or die (mysql_error());
                    if(mysql_num_rows($query_com) > 0){
                      echo "Commenti:<br>";
                      while($row_com = mysql_fetch_array($query_com)){
                        $com_autore = stripslashes($row_com['com_autore']);
                        $com_testo = stripslashes($row_com['com_testo']);
                        echo $com_testo . "<br>";
                        echo "Inserito da <b>". $com_autore . "</b>";
                        echo "<hr>"; 
                      } 
                    }*/
                  }
                }else{
                  // se per l'id non esiste un articolo..
                  echo "Nessun articolo trovato.";
                }
                ?>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="img-circle" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="img-circle" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="img-circle" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                </div>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Categorie</h4>
                    <?php 

                        $sql = "SELECT * FROM `tb2_category` ORDER BY `id_category`";
                        $query = @mysql_query($sql) or die (mysql_error());
                        $i=0;
                        if(mysql_num_rows($query)>0)
                          while($row = mysql_fetch_array($query)){
                            $name[$i] = stripslashes($row['name_category']);
                            $i++;
                        }

                    ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                
                                <?php
                                $i=0;
                                while ($i<4) {
                                    echo '<li><a href="#">'.$name[$i].'</a></li>';
                                    $i++;
                                }


                                ?>
                                
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <ul class="list-unstyled"><?php
                                $i=0;
                                while ($i<4) {
                                    echo '<li><a href="#">'.$name[$i].'</a></li>';
                                    $i++;
                                }


                                ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                 <!-- Side Widget Well -->
                <div class="well">
                    <h4>Seguici su Twitter</h4>
                    <p><a class="twitter-timeline" href="https://twitter.com/twitter" data-widget-id="660233632943054848">Tweet di @twitter</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></p>
                </div>
                <div class="well">
                    <h4>Inserimento Widget</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>
            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="bootstrap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
