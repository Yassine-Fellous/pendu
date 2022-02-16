<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <header>
        <li><a href="../index.php">Accueuil</a></li>
    </header>
    <main>
        <br>
        <form method="post">
            <input name="mot" type="text" placeholder="Mots à ajouter" />
            <input type="submit" name="ajouter" value="Ajouter"><br>
        </form>
            <?php
            
            $lines = file("mots.txt");

            foreach($lines as $word){
                echo "$word <a href='admin.php?suppr=".$word."'>Supprimer</a></br>";
            }

            if(isset($_GET['suppr'])){
                $chercher = $_GET['suppr'];
                foreach($lines as $word){
                    if(strstr($word,$chercher)){
                        $a = 'mots.txt';
                        $replacement = '';
                        file_put_contents($a, str_replace($word, $replacement, file_get_contents($a)));
                        header("location:admin.php");
                    }
                    else{echo 'LE MOT EXISTE PAS'.'</br>';}
                }
            }
            
            if(isset($_POST['mot']))
            {
                if(ctype_alpha($_POST['mot']))
                {
                    $txt = $_POST['mot'];
                    $myfile = file_put_contents('mots.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
                    header("location:admin.php");
                }
                else
                {
                    echo "Le mot ne doit contenir que des lettres (A-Z)";
                }
            }
            ?>
    </main>
    <footer>
        <br><li><a href="https://github.com/Yassine-Fellous/pendu">github</a></li>
    </footer>
</body>