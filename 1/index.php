<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EzQuiz</title>

    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300;500&amp;display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
    * {
        font-family: 'Mitr', sans-serif;
        font-weight: 400;
        font-size: 25px;
    }

    body {
        padding-top: 5vh;
        height: 100%;
        background-color: lightgrey;
    }


    .content{
        border-radius: 5px;
        margin: auto;
    }

    .card{
        margin: 0px 1%;
        margin-bottom: 30px;
    }

    .card-head{
        margin-bottom: 0px;
        font-size: 20px;
    }

    .card-body{
        font-size: 15px;
    }

}

    </style>
</head>
<body>
    <div class="content container row" style="margin-auto">
            <?php
                $url = "https://dd-wtlab2020.netlify.app/pre-final/ezquiz.json";
                $response = file_get_contents($url);
                $result = json_decode($response);
                $count = 0;
                $found_count = 0;

                foreach ($result->tracks->items as $items){
                    echo '<div class="card" style="width: 30%;">';
                    foreach ($items->album->images as $image){
                        if ($image->height == 640){
                            echo '<img class="card-img-top" src="' . $image->url . '" alt="Card image cap">';
                        }
                    }
                    echo '<div class="card-body">';
                    echo "<p class='card-head'>" . $items->album->name . "</p>";
                    foreach ($items->album->artists as $artists){
                        echo "Artist: " . $artists->name . "<br>";
                    }
                    echo "Release date: " . $items->album->release_date . "<br>";
                    foreach ($items->album->available_markets as $available_markets){
                        $count++;
                    }
                    echo "Avaliable : " . $count . " countries<br>";
                    echo '</div>';
                    echo '</div>';
                }
            ?>
    </div>
</body>
</html>
