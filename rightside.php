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

    <title>I Bipolaristi - Right Side</title>

    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href='https://fonts.googleapis.com/css?family=Kalam' rel='stylesheet' type='text/css'>
    <link href="bootstrap/css/rightside.css" rel="stylesheet">

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

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Right Side
                    <small>Istrionico. Estroso. Libero.</small>
                </h1>

                <?php

                    // includiamo la pagina contenente il codice per la creazione delle anteprime
                    @include "anteprima.php";

                    // estraiamo i dati relativi agli articoli dalla tabella
                    $sql = "SELECT * FROM tb3_post ORDER BY id_post DESC";
                    $query = @mysql_query($sql) or die (mysql_error());

                    //verifichiamo che siano presenti records
                    if(mysql_num_rows($query) > 0){
                      // se la tabella contiene records mostriamo tutti gli articoli attraverso un ciclo
                      while($row = mysql_fetch_array($query)){
                        $art_id = $row['id_post'];
                        $autore = stripslashes($row['id_user']);
                        $titolo = stripslashes($row['title_post']);
                        $data = $row['data_post'];
                        $articolo = $row['article_post'];
                        $categoria = $row['id_category'];

                        $nomecognomeSQL = "SELECT name_user, surname_user FROM tb1_user WHERE id_user = '".$autore."'";
                        $queryAutore = @mysql_query($nomecognomeSQL) or die (mysql_error());
                        if(mysql_num_rows($queryAutore) > 0)
                                if ($riga = mysql_fetch_array($queryAutore)) {
                                  $nome_autore = $riga['name_user'];
                                  $cognome_autore = $riga['surname_user'];
                                }

                        $categoriaSQL = "SELECT * FROM tb2_category WHERE id_category = '".$categoria."'";
                        $queryCategoria = @mysql_query($categoriaSQL) or die (mysql_error());
                        if(mysql_num_rows($queryCategoria) > 0)
                                if ($riga = mysql_fetch_array($queryCategoria)) {
                                  $categoria = $riga['name_category'];
                                }
                ?>

                <?php

                        //valorizziamo una variabili con il link all'intero articolo
                        $link = " <br><a href=\"post.php?id=".$art_id."\">Leggi tutto</a>";

                        echo "<h2><a href=\"post.php?id=$art_id\">".$titolo."</a></h2>";
                        echo  "<p class=\"lead\">by <a href=\"#\">". $nome_autore . " " . $cognome_autore . "</a></p>";
                        // formattiamo la data nel formato europeo
                        $data = preg_replace('/^(.{4})-(.{2})-(.{2})$/','$3-$2-$1', $data);

                        // stampiamo una serie di informazioni
                        echo  "<p><span class=\"glyphicon glyphicon-time\"></span> Posted on " . $data . "</p><hr>";
                        echo "<img class=\"img-responsive\" src=\"http://placehold.it/900x300\" alt=\"\"><br>";

                       
                        // creaimo l'anteprima che mostra le prime 100 parole di ogni singolo articolo
                        // per farlo utilizzo una funzione che vi presenterò più avanti
                        echo "<p>".@anteprima($articolo, 100, $link)."</p>"; 
                        echo "<hr>";
                       
                        
                        //echo  "| Commenti: "; 
                      
                        // mostriamo il numero di commenti relativi ad ogni articolo
                        /*$conta = "SELECT COUNT(com_id) as conta from commenti WHERE com_art = '$art_id'";
                        $conto = @mysql_query ($conta);
                        $tot = @mysql_fetch_array ($conto);
                        echo $sum2 = $tot['conta'];*/
                        //echo "<hr>"; 
                      } 
                    }
                    else{
                      // se in tabella non ci sono records...
                      echo "Nessun articolo presente.";
                    
                    }

                ?>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

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
                        <!-- /.col-lg-6 -->
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
                <!-- /.col-lg-12 -->
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
