<?php
include ('pokemon_class.php');
include ('pokedex.php');
//init sesstion
session_start();


function pre($arr){
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}
function newGame() {
    global $pokedex;
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['player'] = new Pokemon ($pokedex[mt_rand(0,count($pokedex)-1)]);
    $_SESSION['cpu'] = new Pokemon ($pokedex[mt_rand(0,count($pokedex)-1)]);

}

//reset the game
if(isset($_GET['reset']) || !isset($_SESSION['player'])	) {
    newGame();
}



$player = &$_SESSION['player'];
$cpu = &$_SESSION['cpu'];
$battellog=[];

if(isset($_GET['attack'])){
    $id = $_GET['attack'];
    $player->attack($cpu,$player->attacks[$id]); //player attacks cpu
    $battellog[]= $player->name . 'attacks using ' . $player->attacks[$id]['name'] . 'for' . $player->attacks[$id]['damage'] . 'damage';


    $id = mt_rand(0,count($cpu->attacks)-1); // cpu attacks player
    $cpu->attack($player,$cpu->attacks[$id]);
    $battellog[]= $cpu->name . 'attacks using ' . $cpu->attacks[$id]['name'] . 'for' . $cpu->attacks[$id]['damage'] . 'damage';
    //pre($battellog);


}



 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title></title>
    </head>
    <body>
        <div class="container">
            <a href="index.php?reset=1"  class = "btn btn-danger">RESet</a>
            <div class="row">
                <div class="col">
                    <div>
                        <?php echo $player->getHP() . '/' . $player->health; ?>
                    </div>
                    <div>
                        <h5><?php echo $player->name ; ?></h5>
                        <div class="count">
                            <div>
                        ajkshdajsl
                        </div>
                        </div>
                        <img src="<?php echo strtolower($player->name) . '.png';?>" alt="<?php echo $player->name; ?>"class="pokemon1"/>
                    </div>
                    <div>
                        <?php foreach($player->attacks as $key=>$attack)
                        {
                            echo '<a href= "index.php?attack=' . $key .'" class="btn btn-primary">' . $attack['name'] . '</a>';

                        }?>
                    </div>

                </div>
                <div class="col">
                    <div>
                        <?php echo $cpu->getHP() . '/' . $cpu->health ; ?>
                    </div>
                    <div>
                        <h5><?php echo $cpu->name ; ?></h5>
                        <div >


                        <div class="count">
                            <div>
                        ajkshdajsl
                        </div>
                        </div>
                        <img src="<?php echo strtolower($cpu->name) . '.png';?>" alt="<?php echo $cpu->name; ?>" class="pokemon" />


                    </div>
                    <div>
                        <?php foreach($cpu->attacks as $key=>$attack)
                        {
                            echo '<a href= "index.php?attack=' . $key .'"class="btn btn-primary disabled">' . $attack['name'] . '</a>';

                        }
                        ?>
                    </div>

                </div>

            </div>
            <hr />
            <pre class="battlelog">
                <?php  foreach($battellog as $item){
                    echo '<p class="out">' . $item . '</p>';

                }
                ?>

            </pre>

        </div>

    </body>
</html>
