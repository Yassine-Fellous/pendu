<?php

class Pendu
{
    public $played;

    public function removeAccents($mot)
	{
        $search  = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
        $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');
        $newmot = str_replace($search, $replace, $mot);
        return strtoupper($newmot); 
    }

    public function homepage()
    {
        if(!empty($_SESSION['victoires']))
        {
            echo "<p class='bienvenue'> Bienvenue sur le jeu du Pendu !</p>";
            echo "<div class='zone-welcome'>
            <img src='image/pendue.png'>
            </div>";
            echo "<a class='continuer' href='index.php?etat=jouer'>Continuer</a>"."<br>";
            echo "<div class='button_container'>
            <a href='../jeudupendue/traitement/newparty.php'><button class='btn'><span>Nouvelle partie</span></button></a>";  
        }
        else
        {
            echo "<div class='bienvenue-zone'>
            <p class='bienvenue'> Bienvenue sur le jeu du Pendu !</p>
            </div>";
            echo "<div class='zone-welcome'>
            <img src='image/pendue.png'>
            </div>";
            echo "<div class='button_container'>
            <a href='../jeudupendue/traitement/newparty.php'><button class='btn'><span>Nouvelle partie</span></button></a>";
        }
    }

    public function lostparty($mot)
    {
        echo "<div class='msg'> Vous avez perdu ... Le mot était <br><span class='mot'> $mot </span> </div><a class='recommencer' href='../jeudupendue/traitement/restart.php'>Recommencer</a>";
        echo "<img src='image/9.png'>"; 
        exit();
    }

    public function Winparty($mot)
    {
        echo "<img class='confetti' src='image/Confetti.gif'></img>";
        echo "<div class='msg-zone'>
        <div class='msg'> Vous avez gagné ! 🥳<br /></div>
        </div>";
        echo "<div class='msg2-zone'>
        <div class='msg2'> Le mot était bien : $mot !<br /></div>
        </div>";
        echo "<div class='zone-victoire'>
        <img class='victoire' src='image/victoire.jpg'>
        </div>";
        echo "<div class='button_container'>
        <a href='../jeudupendue/traitement/newparty.php'><button class='btn'><span>Nouvelle partie</span></button></a></div>";  
        $_SESSION['victoires']++;
        exit();
    }

    public function choixMot($fichier)
    {
        if(!isset($_SESSION['mot']))
        {
            $_SESSION['mot'] = rtrim($fichier[array_rand($fichier)]);
        }
    }

    public function stockagedesLettres()
    {
        $pletter = $_POST["lettre"];
        $_SESSION['played'][]=$pletter;
    }

    public function mauvaisesLettres($mot)
    {
        $played = $_SESSION['played'];
        $this->played = $played;        
            for($k=0; isset($played[$k]); $k++)
            {
                if(!in_array($played[$k], str_split($mot)))
                {
                    $_SESSION['false']++;
                }
            }
    }

    public function affichageInput($alphabet)
    {
        for($i=0; isset($alphabet[$i]); $i++ )
            {
                if(!empty($this->played) && in_array($alphabet[$i], $this->played ))
                {
                    echo "";
                }
                else
                {
                    echo '<input type="submit" name="'."lettre".'" value="'.$alphabet[$i].'">';
                }
            }
    }

    public function affichageLettres($mot)
    {
        for ($j=0; isset($mot[$j]); $j++)
        {
            if(!empty($this->played) && in_array($mot[$j], $this->played))
            {
                $_SESSION['true']++;
                echo "$mot[$j]";
            }
            else
            {
                echo "<span class='tirets'>_ </span>";
            }      
        }
    }
}

?>

