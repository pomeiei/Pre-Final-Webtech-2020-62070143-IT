<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EzQuiz</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container row" style="margin: auto;">
            <?php
                $url = "https://dd-wtlab2020.netlify.app/pre-final/ezquiz.json";
                $response = file_get_contents($url);
                $result = json_decode($response);
                
                $count = 0;
                foreach ($result->tracks->items as $items){
                    echo '<div class="card" style="width: 30%; margin: 10px;">';
                    foreach ($items->album->images as $images){
                        if ($images->height == 640){
                            echo '<img class="card-img-top" src="' . $images->url . '">';
                        }
                    }
                    echo "<div class='card-body'><p class='card-head'><b>" . $items->album->name . "</b></p>";
                    foreach ($items->album->artists as $artists){
                        echo "<p>Artist: " . $artists->name . "</p>";
                    }
                    echo "<p>Release date: " . $items->album->release_date . "</p>";
                    foreach ($items->album->available_markets as $available_markets){
                        $count++;
                    }
                    echo "<p>Avaliable : " . $count . " countries</p></div></div>";
                }
            ?>
    </div>
</body>
</html>
