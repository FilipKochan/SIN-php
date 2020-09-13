<?php 
if (isset($_REQUEST["sekce"])){
    $sekce = $_REQUEST["sekce"];
if ($sekce != 10 && $sekce != 20 && $sekce != 30){
    $sekce = 10;
}
}
else{
    $sekce = 10;
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <title><?php echo $sekce?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
</head>

<body>
<nav>
    <ul>
        <li><a href="index.php?sekce=10">Úvodní strana</a><?php if($sekce == 10) echo " <i class=\"far fa-hand-point-left\"></i>";?></li>
        <li><a href="index.php?sekce=20">Formulář</a><?php if($sekce == 20) echo " <i class=\"far fa-hand-point-left\"></i>";?></li>
        <li><a href="index.php?sekce=30">Kontakt</a><?php if($sekce == 30) echo " <i class=\"far fa-hand-point-left\"></i>";?></li>
    </ul>
</nav>

<?php

if ($sekce == 10){
print("<h1>Úvodní stránka</h1>");
$dny = ["neděle", "pondělí", "úterý", "středa", "čtvrtek", "pátek", "sobota"];
$datum = date("j. n. o", Time());
echo("Dnes je ".$dny[date("w", time())].", ".$datum);

}
else if ($sekce == 20){
?>
<h1>Formulář</h1>
<form>
<div class="input">
<input type="text" name="cislo1" placeholder="číslo 1" value="<?php if (isset($_REQUEST["cislo1"]) && is_numeric($_REQUEST["cislo1"])) echo $_REQUEST["cislo1"]?>">
<?php if(isset($_REQUEST["spocitat"]) && !is_numeric($_REQUEST["cislo1"])) echo "<p>Toto neni cislo!</p>" ?>
</div>

<div class="input">
<select name="operace" id="operace">
    <option value="+" <?php if(isset($_REQUEST["operace"]) && $_REQUEST["operace"] == "+") echo "selected=\"true\""; ?>>+</option>
    <option value="-" <?php if(isset($_REQUEST["operace"]) && $_REQUEST["operace"] == "-") echo "selected=\"true\""; ?>>-</option>
    <option value="*" <?php if(isset($_REQUEST["operace"]) && $_REQUEST["operace"] == "*") echo "selected=\"true\""; ?>>*</option>
    <option value="÷" <?php if(isset($_REQUEST["operace"]) && $_REQUEST["operace"] == "÷") echo "selected=\"true\""; ?>>÷</option>
</select>
</div>

<div class="input">
<input type="text" name="cislo2" placeholder="číslo 2" value="
<?php
    if ($_REQUEST["operace"] != "÷") {
        if (isset($_REQUEST["cislo2"]) && is_numeric($_REQUEST["cislo2"])){ 
            echo $_REQUEST["cislo2"];
        }
    }
    else{
        if ($_REQUEST["cislo2"] != 0) {
            echo $_REQUEST["cislo2"];
        }
    }
 ?>">


<?php
    if(isset($_REQUEST["spocitat"]) && !is_numeric($_REQUEST["cislo2"])) 
        echo "<p>Toto neni cislo!</p>";
    else if (isset($_REQUEST["spocitat"]) && $_REQUEST["operace"] == "÷" && $_REQUEST["cislo2"] == 0)
        echo "<p>Nulou nelze delit!</p>";
?>
</div>
<input type="hidden" name="sekce" value="<?php echo $sekce?>">
<div class="input">
<input type="submit" name="spocitat" value="Spočítej!">
</div>
</form>
<?php
if(isset($_REQUEST["spocitat"])){
    if (isset($_REQUEST["cislo1"]) && is_numeric($_REQUEST["cislo1"])) 
        if (isset($_REQUEST["cislo2"]) && is_numeric($_REQUEST["cislo2"]))
            if (!($_REQUEST["cislo2"] == 0 && $_REQUEST["operace"] == "÷"))
                $spravneZadani = true;
    
}
else
    $spravneZadani = false;

if ($spravneZadani) {
    $vysledek;
    switch ($_REQUEST["operace"]) {
        case '+':
            $vysledek = $_REQUEST["cislo1"] + $_REQUEST["cislo2"];
            break;
        case '-':
            $vysledek = $_REQUEST["cislo1"] - $_REQUEST["cislo2"];
            break;
        case '*':
                $vysledek = $_REQUEST["cislo1"] * $_REQUEST["cislo2"];
            break;
        case '÷':
                $vysledek = $_REQUEST["cislo1"] / $_REQUEST["cislo2"];
            break;
    }
    echo "Vysledek: ".$_REQUEST["cislo1"]." ".$_REQUEST["operace"]." ".$_REQUEST["cislo2"]." = ".$vysledek;
}
}
else if ($sekce == 30){
    print("<h1>Kontakt</h1>");
}
?>

<style>
    .input {
        display: inline-block;
        vertical-align: top;        
    }
    .input input {
        display: block;
    }
    .input p {
        margin: 0;
        font-size: 80%;
        text-align: center;
        color: red;
    }
</style>
</body>
</html>
