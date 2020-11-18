<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HdQuiz</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body>

    <div class="container">
        <br>
        <font size="4">ระบุคำค้นหา</font>
        <form method="post">
            <?php
            $submit = false;
            $search = null;
            $notfound = true;
            if(isset($_POST['smusic'])) {
                $submit = true;
                if($submit){
                    $search = $_POST['text'];
                }
            }
            echo '<div class="row"><input id="text" name="text" value="' . $search . '" class="form-control align-center" style="width: 80%; display: inline-block;">&nbsp;&nbsp;&nbsp;<button type="submit" name="smusic" class="btn btn-primary" style="width: 15%;">ค้นหา</button></div>';
            ?>
        </form>
    </div>

    <div class="container row" style="margin: auto;">
            <?php
                $url = "https://dd-wtlab2020.netlify.app/pre-final/ezquiz.json";
                $response = file_get_contents($url);
                $result = json_decode($response);
                
                $count = 0;
                $scount = 0;
                if ($search == ""){
                    $notfound = false;
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
                }
                else{
                    foreach ($result->tracks->items as $items){
                        $check = false;
                        foreach ($items->album->artists as $artists){
                            if (strpos($artists->name, $search) !== false){
                                $check = true;
                            }
                        }
                        if (strpos($items->album->name, $search) !== false || $check){
                            $scount++;
                        }
                    }
                    if ($scount > 0){
                        echo "<div style='width:100%; margin-bottom: 10px;'>ค้นหาเจอทั้งหมด " . $scount . " รายการ</div>";
                    }
                    foreach ($result->tracks->items as $items){
                        $check = false;
                        foreach ($items->album->artists as $artists){
                            if (strpos($artists->name, $search) !== false){
                                $check = true;
                            }
                        }
                        if (strpos($items->album->name, $search) !== false || $check){
                            $notfound = false;
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
                    }
                }
                if ($notfound){
                    echo 'Not Found';
                }
            ?>
    </div>
</body>
</html>
