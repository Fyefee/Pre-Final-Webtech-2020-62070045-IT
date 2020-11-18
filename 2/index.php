<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HdQuiz</title>

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
        padding: 0;
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

    form{
        padding: 0;
        width: 100%;
    }

}

    </style>
</head>
<body>
    <div class="content container row" style="margin-auto">
        <form method="post">
            <?php
                $is_click = false;
                $check_all = true;
                $search = "";

                if(isset($_POST['test'])) {
                    $is_click = true;

                    if($is_click){
                        $search = $_POST['text'];
                    }
                }

                echo '<h6>ระบุคำค้นหา :</h6>';
                echo '<div style="width: 100% ;margin-bottom: 20px"><input id="text" name="text" value="' . $search . '" class="form-control align-center" style="width: 80%; display: inline-block;">
                <button type="submit" name="test" class="btn btn-danger" style="margin-left: 15px">ค้นหา</button></div>';
            ?>

            </form>
            <?php
                $url = "https://dd-wtlab2020.netlify.app/pre-final/ezquiz.json";
                $response = file_get_contents($url);
                $result = json_decode($response);
                $count = 0;
                $found_count = 0;

                if ($search == ""){
                    $check_all = false;
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
                }
                else{

                    foreach ($result->tracks->items as $items){
                        $check = false;
                        foreach ($items->album->artists as $artists){
                            if (strpos(strtolower($artists->name), strtolower($search)) !== false){
                                $check = true;
                            }
                        }
                        if (strpos(strtolower($items->album->name), strtolower($search)) !== false || $check){
                            $found_count++;
                        }
                    }
                    if ($found_count > 0){
                        echo "<div style='width:100%; margin-bottom: 10px;'>ค้นหาเจอทั้งหมด " . $found_count . " รายการ<br></div>";
                    }
                    foreach ($result->tracks->items as $items){
                        $check = false;
                        foreach ($items->album->artists as $artists){
                            if (strpos(strtolower($artists->name), strtolower($search)) !== false){
                                $check = true;
                            }
                        }
                        if (strpos(strtolower($items->album->name), strtolower($search)) !== false || $check){
                            $check_all = false;
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
                    }
                }

                if ($check_all){
                    echo 'Not Found';
                }
            ?>
    </div>
</body>
</html>
