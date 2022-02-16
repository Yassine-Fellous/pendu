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
            echo "<p> Bienvenue sur le jeu du Pendu !</p>
            <img src='image/pendue.png'><br>
            <a href='index.php?etat=jouer'><button>Continuer</button></a> <br>
            <a href='../jeudupendue/traitement/newparty.php'><button>Nouvelle partie</button></a>";  
        }
        else
        {
            echo "<p> Bienvenue sur le jeu du Pendu !</p>
            <img src='image/pendue.png'><br>
            <a href='../jeudupendue/traitement/newparty.php'><button>Nouvelle partie</button></a>";
        }
    }

    public function lostparty($mot)
    {
        echo "Vous avez perdu ... Le mot était<span> $mot </span><br>
        <a href='../jeudupendue/traitement/restart.php'><button>Recommencer</button></a><br>"; 
        exit();
    }

    public function Winparty($mot)
    {
        echo "<p>Vous avez gagné ! 🥳</p><br />
        <p> Le mot était bien : $mot !</p><br />
        <a href='../jeudupendue/traitement/restart.php'><button>Recommencer</button></a><br>";  
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
                echo "<span>_ </span>";
            }      
        }
    }
}
