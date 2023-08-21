<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SteamStat Home</title>
    <!-- Below are the CDNs for Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../stylesheets/styles.css">

</head>
<body>
    <div class="container-fluid">
        <div id="head-margin">
            <h1 id="top-header">Personal Steam Statistics: <br> Home</h1>
        </div>
        <!-- Bootstrap Nav -->
        <?php include '../components/nav.php'?>
        <div id="home-content-container">
            <div id="home-content1">
                <img src="../images/joystick.png" alt="An image of a generic arcade videogame joystick and button from the 1980s" class="img-fluid rounded" id="joystick-img" style="margin-left: 50px; margin-top: 50px;">
                <p id="home-p" style="padding-right: 350px; margin-top: 50px;"> Welcome! This is a personal website where you can view <br> historical data on your most recently played video games. <br> 
                    This works with any game in your Steam library!</p>
            </div>
            <div id="home-content2">
                <img src="../images/gamer_zone.png" alt="An image of a diamond-shaped street sign. The sign has the text 'Gamer Zone' 
                with a video game controller below it. Below the controller is a loading bar that is 3/4 filled." class="img-fluid rounded" id="gamerzone-img" style="margin-left: 50px; margin-top: 50px;">
                <p id="home-p" style="padding-right: 350px; margin-top: 50px;">How does it work? This website uses the power of Valve's <br> free API for Steam! With a few clicks, you can look at all 
                    of <br> the data that Valve has been collecting on you since 2009!</p>
            </div>
        </div>
    </div>
    <!-- Below are the scripts for bootstrap, includes popper for dropdowns, popovers, and tooltips.-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</body>
</html>