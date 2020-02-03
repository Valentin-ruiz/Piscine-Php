<?php
	require_once("./header.php");
	$_SESSION['current'] = "users.php";
?>
<?php
		if ($_GET['action'] === "finish" && !empty($_GET['uuid'])) {
			$sql = "DELETE FROM commands WHERE uuid=".$_GET['uuid'];
			if (mysqli_query($connect, $sql)) {
			    echo "La commande est validé";
			} else {
			    echo "Erreur: " . mysqli_error($connect);
			}
		}
		if ($_GET['action'] === "add") {
			if (empty($_GET['uuid']) || empty($_GET['product'])) {
				?>
					<form action="commands.php" method="GET">
						<input type="text" name="action" value="add" class="hidden" /><br />
						<label for="mail">User id :</label><br />
						<input type="uuid" name="uuid" /><br />
						<label for="product">Product id :</label><br />
						<input type="product" name="product" /><br />
						<label for="quantity">Quantité :</label><br />
						<input type="text" name="quantity" /><br />
						<hr />
						<input type="submit" name="submit" value="Créer" />
					</form>
				<?php
				}
			else {
				$sql = "SELECT uuid, name, img, price, stock FROM articles WHERE uuid='".$_GET['product'] . "'";
				$result = mysqli_query($connect, $sql);
				if ($result !== false && mysqli_num_rows($result) > 0) {
					$result = mysqli_fetch_assoc($result);
				}
				$result['quantity'] = $_GET['quantity'];
				$cart = array();
				array_push($cart, $result);
				print_r($cart);
				$price = $_GET['quantity'] * $result['price'];
				$sql = "INSERT INTO commands (uuid, tab, price) VALUES ('" . $_GET['uuid'] . "', '" . base64_encode(serialize($cart)) . "','" . $price . "')";

				if (mysqli_query($connect, $sql)) {
				  echo "La commande a été ajouté";
				}
				else {
				  echo "Erreur: ".$sql."<br />".mysqli_error($connect);
				}
			}
		}
		elseif ($_GET['action'] === "modif") {
			if ($_POST['submit'] === "Modifier") {
			$sql = "SELECT * FROM commands WHERE uuid=".$_POST['uuid'];
			$result = mysqli_query($connect, $sql);
			if ($result !== FALSE && mysqli_num_rows($result) > 0) {
				$result = mysqli_fetch_assoc($result);
				echo "<br />";
				$tab = base64_decode($result['tab']);
				$tab = unserialize($tab);
			}
			if (mysqli_query($connect, $sql)) {
			    echo "L'article a été modifié";
			} else {
			    echo "Erreur: " . mysqli_error($connect);
			}
		}
		else {
			$sql = "SELECT * FROM commands WHERE uuid=".$_GET['uuid'];
			$result = mysqli_query($connect, $sql);
			if ($result !== FALSE && mysqli_num_rows($result) > 0) {
				$result = mysqli_fetch_assoc($result);
				echo "<br />";
				$tab = base64_decode($result['tab']);
				$tab = unserialize($tab);
				?>
				<form action="commands.php?action=modif" method="POST">
				<?php
				$count = 0;
				foreach ($tab as $key => $val) {
					?>
					<label for="name">Nom :<?php echo $val['name']; ?></label><br />
					<input type="numeric" name="<?php echo($count); ?>" value="<?php echo $val['quantity']; ?>"></input><br />
					<?php
					$count += 1;
				}
				?>
				<input type="text" name="uuid" value="<?php echo $result['uuid']; ?>" class="hidden">
				<input type="submit" name="submit" value="Modifier" />
				</form>
				<?php
			}
			else {
				echo mysqli_error($connect);
			}
		}
	}
	?>
		<div class="title">
			<span>Toutes les commandes</span>
			<a href="commands.php?action=add"><div class="add">Ajouter une commande</div></a>
		</div>
		<div class="articles">
			<table>
				<tr>
					<td>Uuid Utilisateur</td>
					<td>Prix</td>
					<td>Achats</td>
					<td></td>
					<td></td>
				</tr>
		<?php
			$sql = "SELECT * FROM commands";
			$result = mysqli_query($connect, $sql);
			if (mysqli_num_rows($result) > 0) {
				$user = mysqli_fetch_all($result, MYSQLI_ASSOC);
				foreach ($user as $value) {
					$tab = base64_decode($value['tab']);
					$tab = unserialize($tab);
					$name = "";
					echo "<tr><td>".$value['uuid']."</td>";
					$tot = 0;
					foreach ($tab as $key => $valu) {
						$tot = $tot + $valu['price'] * $valu['quantity'];
						if ($tab[$key + 1])
							$name .= $valu['name']." x ".$valu['quantity'].", ";
						else
							$name .= $valu['name']." x ".$valu['quantity'];
					}
					echo "
						<td>".$tot."</td>
						<td>".$name."</td>
						<td><a href=\"commands.php?action=modif&uuid='".$value['uuid']."'\"><div class=\"modif\">Modifier</div></a></td>
						<td><a href=\"commands.php?action=finish&uuid='".$value['uuid']."'\"><div class=\"del\">Valider</div></a></td>
					</tr>";
				}
			}
	?>
	</table>
	</div>
</body>
</html>
