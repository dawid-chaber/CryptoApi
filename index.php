<?php include_once("header.php"); ?>

<?php include_once("functions.php"); ?>

<?php $responseArray = convertIntoArray()  ?>


<div class="container-lg" class="main">
    <div class="row mt-4">
    <?php foreach($responseArray['data'] as $row => $td){ ?>
        <div class="col-lg-3 col-md-12 col-sm-12 text-center mb-3">
            <div class="card single-card"> 
                <img src="<?php echo "$image[$row]"?> " alt="logo" class="sngle-card-image">
                <div class="card-body">
                    <div class="card-title"> <?php echo $td['name'] . '('. $td['symbol'] .')'; ?> </div>
                    <div class="card-text">Aktualna cena: <?php echo round($td['quote']['USD']['price'],2) ?>$ </div><hr>
                    <div class="card-text">Kapitalizacja rynkowa: <br> 
                        <?php 
                            $ftm = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
                            $market_cup = $td['quote']['USD']['market_cap'] ;
                            echo $ftm->formatCurrency($market_cup,'USD');
                        ?>
                    </div><hr>
                    <?php
                        if($td['quote']['USD']['percent_change_24h'] > 0){
                            ?>
                            <div class="card-text" >Zmiana procentowa (24h): <span class="price_up"><?php echo $td['quote']['USD']['percent_change_24h']; ?></span> </div>
                            <?php
                        } else {
                            ?>
                            <div class="card-text" >Zmiana procentowa (24h): <span class="price_down"><?php echo $td['quote']['USD']['percent_change_24h']; ?></span> </div>
                            <?php
                        }
                    ?>
                </div>  
            </div>
        </div>
        <?php } ?>
    </div>
</div>


<?php include_once("footer.php"); ?>
    


    