<?php
session_start();

$scitani = false;
$odcitani = false;
$nasobeni = false;
$deleni = false;

$pocetSloupcu = 5;
$pocetPrikladuSloupec = 20;
$maxValue = 10;

$chyba["pocetSloupcu"] = null;
$chyba["pocetPrikladuSloupec"] = null;

if (array_key_exists("practiceOnline", $_GET) || array_key_exists("examplesPrint", $_GET)) {
	unset($_SESSION["scitani"]);
	unset($_SESSION["odcitani"]);
	unset($_SESSION["nasobeni"]);
	unset($_SESSION["deleni"]);
	
	$znaminka = [];

	if (isset($pocetSloupcu)) {
		$pocetSloupcu = $_GET["pocetSloupcu"];
	}

	if (isset($pocetPrikladuSloupec)) {
		$pocetPrikladuSloupec = $_GET["pocetPrikladuSloupec"];
	}

	$maxValue = (int)$_GET["maxValue"];


	if (array_key_exists("scitani", $_GET)) {
		array_push($znaminka, "+");
		$scitani = true;
		$_SESSION["scitani"] = true;
	}

	if (array_key_exists("odcitani", $_GET)) {
		array_push($znaminka, "-");
		$odcitani = true;
		$_SESSION["odcitani"] = true;
	}

	if (array_key_exists("nasobeni", $_GET)) {
		array_push($znaminka, "x");
		$nasobeni = true;
		$_SESSION["nasobeni"] = true;
	}

	if (array_key_exists("deleni", $_GET)) {
		array_push($znaminka, "÷");
		$deleni = true;
		$_SESSION["deleni"] = true;
	}

	if (empty($pocetSloupcu)) {
		$chyba["pocetSloupcu"] = "Musí být vyplněno";
	} else if (!is_numeric($pocetSloupcu)) {
		$chyba["pocetSloupcu"] = "Zadaná hodnota musí být číslo";
	} else if ($pocetSloupcu > 5) {
		$chyba["pocetSloupcu"] = "Počet sloupců může být maximálně 5";
	} else if ($pocetSloupcu < 1) {
		$chyba["pocetSloupcu"] = "Hodnota musí být v rozmezí 1 až 5";
	}  

	if (empty($pocetPrikladuSloupec)) {
		$chyba["pocetPrikladuSloupec"] = "Musí být vyplněno";
	} else if (!is_numeric($pocetPrikladuSloupec)) {
		$chyba["pocetPrikladuSloupec"] = "Zadaná hodnota musí být číslo";
	} else if ($pocetPrikladuSloupec > 20) {
		$chyba["pocetPrikladuSloupec"] = "Počet příkladů ve slopupci může být maximálně 20";
	} else if ($pocetPrikladuSloupec < 1) {
		$chyba["pocetPrikladuSloupec"] = "Hodnota musí být v rozmezí 1 až 20";
	}  
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="container">
		<header>
			Tiskni a Počítej
		</header>

		<div class="content">
			<aside>
				<div class="sloupce">
					<div class="text">
						<p>Vyberte:</p>
						<p>(Vybrat můžete více možností.)</p>
					</div>
					<nav>
						<form method="get">
							<div class="input_wrap">
								<label for="scitani">Sčítání</label><input type="checkbox" name="scitani" id="scitani" <?php if (isset($_SESSION["scitani"])) {echo "checked";} ?> >
							</div>

							<div class="input_wrap">
								<label for="odcitani">Odčítání</label>
								<input type="checkbox" name="odcitani" id="odcitani"  <?php if (isset($_SESSION["odcitani"])) {echo "checked";} ?> >
							</div>

							<div class="input_wrap">
								<label for="nasobeni">Násobení</label>
								<input type="checkbox" name="nasobeni" id="nasobeni"  <?php if (isset($_SESSION["nasobeni"])) {echo "checked";} ?> >
							</div>

							<div class="input_wrap">
								<label for="deleni">Dělení</label>
								<input type="checkbox" name="deleni" id="deleni"  <?php if (isset($_SESSION["deleni"])) {echo "checked";} ?> >
							</div>

							<!-- <div class="input_wrap">
								<label for="porovnavani">Porovnávání</label>
								<input type="checkbox" name="porovnavani" id="porovnavani">
							</div> -->

							<div class="input_wrap">
								<label for="">Počet sloupečků: (max.5)</label>
								<input type="text" value="<?php echo $pocetSloupcu; ?>" name="pocetSloupcu">

							</div>
							<div class="chyba">
								<?php echo $chyba["pocetSloupcu"]; ?>
							</div>

							<div class="input_wrap">
								<label for="">Počet příkladů ve sloupci: (max.20)</label>
								<input type="text" value="<?php echo $pocetPrikladuSloupec; ?>" name="pocetPrikladuSloupec">
							</div>
							<div class="chyba">
								<?php echo $chyba["pocetPrikladuSloupec"]; ?>
							</div>

							<div class="input_wrap">
								<label for="maxValue">Do kolika chcete procvičovat?</label>
								<br>
								<input type="text" min='10' name="maxValue" id="maxValue" value="<?php echo $maxValue; ?> ">
							</div>
							<!-- Tlačítko pro odeslání formuláře -->
							<!-- <button name="practiceOnline">Procvičit online</button> -->

							<button name="examplesPrint">Připravit k vytisknutí</button>

							<!-- examplesPrint in $_GET -->
							<?php
							if (array_key_exists("examplesPrint", $_GET) && ($scitani == true || $odcitani == true || $nasobeni == true || $deleni == true) && $chyba["pocetSloupcu"] == null && $chyba["pocetPrikladuSloupec"] == null) {
								echo "<button class='btnTisk' onclick='window.print()'>Vytisknout</button>";
								}
							?>
						</form>
					</nav>
				</div>
			</aside>

			<div class="examples">

				<!-- Zde se mohou zobrazit příklady -->
				<?php
				if ($scitani == true || $odcitani == true || $nasobeni == true || $deleni == true) {
					if (array_key_exists('examplesPrint', $_GET) && $chyba["pocetSloupcu"] == null && $chyba["pocetPrikladuSloupec"] == null) {

						if ($chyba["pocetSloupcu"] == null) {
							for ($i = 0; $i < $pocetSloupcu; $i++) {
								echo "<div class='vedle'>";
								echo "<div>";
								$pocet = 0;
								$priklady = []; // Pole pro unikátní příklady

								while ($pocet != $pocetPrikladuSloupec) {
									// Generuj příklad
									$result = rand(0, $maxValue);

									$vybraneZnaminko = !empty($znaminka) ? $znaminka[array_rand($znaminka)] : "+";

									if ($vybraneZnaminko == "+") {
										$firstNumber = rand(0, $result);
										$secondNumber = $result - $firstNumber;
									} else if ($vybraneZnaminko == "-") {
										$firstNumber = rand(0, $result);
										$secondNumber = rand(0, $firstNumber);
									} else if ($vybraneZnaminko == "x") {
										$firstNumber = rand(1, $result);
										// Ošetření, aby nebyl firstNumber nulový
										if ($firstNumber > 0) {
											$secondNumber = rand(1, floor($maxValue / $firstNumber));
										} else {
											$firstNumber = rand(1, $maxValue);
											$secondNumber = rand(1, $maxValue);  // Přidáno zajištění secondNumber
										}
									} else if ($vybraneZnaminko == "÷") {
										$secondNumber = rand(1, $maxValue);
										if ($secondNumber > 0) {
											$firstNumber = $secondNumber * rand(1, floor($maxValue / $secondNumber));
										} else {
											$secondNumber = rand(1, $maxValue);
											$firstNumber = $secondNumber * rand(1, floor($maxValue / $secondNumber));  // Přidáno zajištění 
										}
									}

									// Vytvoříme řetězec pro kontrolu opakování
									$priklad = "{$firstNumber}{$vybraneZnaminko}{$secondNumber}";

									// Zkontrolujeme, jestli už daný příklad existuje v poli
									if (!in_array($priklad, $priklady)) {
										// Pokud neexistuje, přidáme ho do pole a zobrazíme
										$priklady[] = $priklad;

										// Výpis příkladu
										echo "<form>";
										echo "<span class='first-number'>$firstNumber</span> <span class='mark'>$vybraneZnaminko</span> <span class ='second-number'>$secondNumber</span> <span class='mark'> = </span> <span class='result'></span>";
										echo "</form>";
										$pocet++;
									}
								}
								echo "</div>";
								echo "</div>";
							}
						}
					}
				} else if (!isset($_SESSION["scitani"]) && !isset($_SESSION["odcitani"]) && !isset($_SESSION["nasobeni"]) && !isset($_SESSION["deleni"])) {
					echo "<p class='start'>Vyberte alespoň jednu matematickou operaci</p>";
				}

				// tato cast kodu je v reseni. V planu je pocitani online
				// priklady se generujou, jen se musi dodelat js

				/* if (array_key_exists('practiceOnline', $_GET)) {
					if ($chyba["pocetSloupcu"] == null) {
						$sloupId = 1;
						// Odstranit nepotřebný cyklus a indexování
						for ($i = 0; $i < $pocetSloupcu; $i++) {
							echo "<div class='vedle_online' id='$sloupId'>";
							echo "<div>";
							$pocet = 0;
							$formId = 1;
							$priklady = []; // Pole pro unikátní příklady

							while ($pocet != $pocetPrikladuSloupec) {
								// Generuj příklad
								$result = rand(0, $maxValue);
								$vybraneZnaminko = !empty($znaminka) ? $znaminka[array_rand($znaminka)] : "+";

								if ($vybraneZnaminko == "+") {
									$firstNumber = rand(0, $result);
									$secondNumber = $result - $firstNumber;
								} else if ($vybraneZnaminko == "-") {
									$firstNumber = rand(0, $result);
									$secondNumber = rand(0, $firstNumber);
								} else if ($vybraneZnaminko == "x") {
									$firstNumber = rand(1, $result);
									// Ošetření, aby nebyl firstNumber nulový
									if ($firstNumber > 0) {
										$secondNumber = rand(1, floor($maxValue / $firstNumber));
									} else {
										$firstNumber = rand(1, $maxValue);
										$secondNumber = rand(1, $maxValue);  // Přidáno zajištění secondNumber
									}
								} else if ($vybraneZnaminko == "÷") {
									$secondNumber = rand(1, $maxValue);
									if ($secondNumber > 0) {
										$firstNumber = $secondNumber * rand(1, floor($maxValue / $secondNumber));
									} else {
										$secondNumber = rand(1, $maxValue);
										$firstNumber = $secondNumber * rand(1, floor($maxValue / $secondNumber));  // Přidáno zajištění firstNumber
									}
								}

								// Vytvoříme řetězec pro kontrolu opakování
								$priklad = "{$firstNumber}{$vybraneZnaminko}{$secondNumber}";

								// Zkontrolujeme, jestli už daný příklad existuje v poli
								if (!in_array($priklad, $priklady)) {
									// Pokud neexistuje, přidáme ho do pole a zobrazíme
									$priklady[] = $priklad;

									// Výpis příkladu
									if (in_array($vybraneZnaminko == "+"|| $vybraneZnaminko == "-" || $vybraneZnaminko == "x" || $vybraneZnaminko == "÷", $priklady) ) {

										echo "<form id='$formId'>";
										echo "<span class='first-number'>{$firstNumber}</span> <span class='mark'>{$vybraneZnaminko}</span> <span class='second-number'> {$secondNumber}</span> <span class='mark'> = </span> <input type='text' id='result'>";
										echo "</form>";
									} 

									$pocet++; // Zvetseni poctu vygenerovanych prikladu
									$formId++; // Zvyseno id u form
									
								}
							}
							
							$sloupId++; // zvyseni Id u sloupcu

							echo "</div>";
							echo "</div>";
						}
					}
				}
 */
				?>
			</div>
		</div>
	</div>
	<script src="js/script.js"></script>
</body>

</html>