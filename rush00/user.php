<?php
	require_once('./include/include.php');
	if (is_connected()) {
		$_SESSION['success'] = '';
		if(modif($_POST, $connect)) {
			$_SESSION['current'] = "user.php";
			header('Location: '.$_SESSION['current']);
		}
		if ($_GET['action'] === "del" && $_GET['uuid']) {
			$sql = "DELETE FROM users WHERE uuid=".$_GET['uuid'];
			if (mysqli_query($connect, $sql)) {
	            header("Location: signout.php");
			} else {
			    echo "Erreur: " . mysqli_error($connect);
			}
		}
	}
	else
		header('Location: signin.php');
	require_once("./header.php");
?>
<div id="body">
	<div id="title">Modification du compte</div>
	<div class="success">
		<center><?php echo $_SESSION['success']; ?></center>
	</div>
	<div class="error">
		<center><?php echo $_SESSION['error'];
		$_SESSION['error'] = '';
		?></center>
	</div>
		<form action="user.php?action=modif&uuid=<?php echo $_SESSION['uuid']; ?>" method="POST">
			<label for="mail">Email :</label><br />
			<input type="email" name="mail" value="<?php echo $_SESSION['mail']; ?>" /><br />
			<label for="password">Mot de passe :</label><br />
			<input type="password" name="password1" /><br />
			<hr />
			<input type="submit" name="submit" value="Modifier" />
		</form>
	<?php
	echo "<a href=\"user.php?action=del&uuid='".$_SESSION['uuid']."'\"><div class=\"del\">Supprimer mon compte</div></a>";
	?>
</div>
<?php
	include 'footer.php';
?>
