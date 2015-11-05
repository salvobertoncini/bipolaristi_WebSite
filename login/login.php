<?php
session_start();// come sempre prima cosa, aprire la sessione 
include("db_con.php"); // Include il file di connessione al database
$username=mysql_real_escape_string($_POST["username_user"]);
$password=mysql_real_escape_string($_POST["password_user"]);
$query = mysql_query("SELECT username_user,password_user FROM tb1_user WHERE username_user='".$username."' AND password_user ='".$password."'")  //per selezionare nel db l'utente e pw che abbiamo appena scritto nel log
or DIE('query non riuscita'.mysql_error());
if(mysql_num_rows($query)>0)
{
	$_SESSION["username_user"]=$username; // con questo associo il parametro username che mi è stato passato dal form alla variabile SESSION username
	$_SESSION["password_user"]=$password; // con questo associo il parametro username che mi è stato passato dal form alla variabile SESSION password
	header("location:../cms/cms.php");
}
else
{
	echo "Username o password errati, verrai reindirizzato alla pagina di Login";
	echo "<script>
	function continueExecution()
	{
		location.replace(\"main_login.php\")
	}
	setTimeout(continueExecution, 3000)
	</script>";
}
/*
// Con il SELECT qua sopra selezione dalla tabella users l utente registrato (se lo è) con i parametri che mi ha passato il form di login, quindi
// Quelli dentro la variabile POST. username e password.

if(mysql_num_rows($query)>0){        //se c'è una persona con quel nome nel db allora loggati
	$row = mysql_fetch_assoc($query); // metto i risultati dentro una variabile di nome $row
	$_SESSION["logged"] = true;  // Nella variabile SESSION associo TRUE al valore logged

header("location:../gestione/manage.php"); // e mando per esempio ad una pagina esempio.php// in questo caso rimanderò ad una pagina prova.php
}else{
echo "non ti sei registrato con successo"; // altrimenti esce scritta a video questa stringa di errore
}*/
?>