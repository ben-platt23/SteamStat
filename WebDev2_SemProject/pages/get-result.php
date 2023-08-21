<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Data Results</title>
    <!-- Below are the CDNs for Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../stylesheets/styles.css">
</head>
<body>
    <?php
        include '../PRIVATE/DBInfo.php';
    ?>
    <div class="container-fluid">
        <div id="head-margin">
            <h1 id="top-header">Personal Steam Statistics: <br> API Request Results!</h1>
        </div>
        <!-- Bootstrap Nav and Private Keys-->
        <?php 
        include '../components/nav.php';
        include '../PRIVATE/keys.php';
        ?>
        <div id="contact-spacing"></div>
        
        <div id="get-result-content-cont">
            <?php
                // it defaulted to the wrong time zone
                // im VERY upset that I had to diagnose this error.
                date_default_timezone_set('America/New_York');
                // Step 1: Get the posted information so we know what endpoint to call and table to commit to.
                // (Not gonna retrieve user since there's no plans to have multiple users)
                $recent_or_owned = stripcslashes($_POST['table']);

                // Step 2: Call the appropriate API endpoint. Structure the URL according to the documentation.
                $table = "$recent_or_owned";
                if($recent_or_owned == "recentgames"){
                    $data = json_decode(file_get_contents('http://api.steampowered.com/IPlayerService/GetRecentlyPlayedGames/v0001/?key='.$MyKey.'&steamid='.$SteamID.'&format=json'), true);
                
                }
                else if($recent_or_owned == "ownedgames"){
                    $data = json_decode(file_get_contents('http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key='.$MyKey.'&steamid='.$SteamID.'&include_appinfo=true&format=json'), true);
                }

                // Step 3: Take the JSON data and put the useful data into it's own 2D array. Array 1 = game1 info, array 2 = game2 info, etc.
                if($recent_or_owned == "recentgames"){
                    // this is how big the new data array will be, also how many inserts we'll need
                    $total_games = $data['response']['total_count'];
                    $new_data = array();
                    
                    for($i = 0; $i < $total_games; $i++){
                        // want name, playtime_2weeks, playtime_forever, img_icon_url
                        $name = $data['response']['games'][$i]['name'];
                        $playtime_2weeks = $data['response']['games'][$i]['playtime_2weeks'];
                        $playtime_forever = $data['response']['games'][$i]['playtime_forever'];
                        $img_icon_url = $data['response']['games'][$i]['img_icon_url'];
                        
                        // put these into their own array and add it to the new data array
                        $data_cell = array($name, $playtime_2weeks, $playtime_forever, $img_icon_url);
                        $new_data[$i] = $data_cell;
                    }

                    // test print this new data array
                    // var_dump($new_data);

                    // Step 4 Embedded: Query the database to see if there is data for today's date. 
                    // If yes, print that data in a dynamic table and RETURN. 
                    // If no, continue to step 5
                    // make a DB connection
                    $DBConnect = mysqli_connect($IP, $username, $password, $SchemaName);
                            
                    // If there isn't a connection, let the admin know
                    if($DBConnect == false){
                        print("Unable to connect to the database" + mysqli_errno($mysqli));
                    } else{
                        // table name = $table
                        $todays_date = stripcslashes(date("Y-m-d"));

                        $DateQuery = "SELECT * 
                        FROM $table 
                        WHERE intakedate = '$todays_date'";
                        $QueryResult = mysqli_query($DBConnect, $DateQuery);

                        if($QueryResult == false){
                            print("Sorry, something went wrong. Try again. <br>");
                            print($DBConnect->error);
                        }
                        else{
                            if(mysqli_num_rows($QueryResult) > 0){
                                // case 1: already data for today, just print today's data
                                print("<p style='text-align: center;'>Sorry, there's already data for today. Here it is!</p>");
                                $returned_data = array();
                                $cell = 0;
                                while($Row = mysqli_fetch_assoc($QueryResult)){
                                    // convert the playtime in minutes to playtime in hours, rounded to nearest 2 decimal places
                                    $pt_2_hours = round($Row['playtime_2weeks']/60, 2);
                                    $pt_tot_hours = round($Row['playtime_forever']/60, 2);

                                    $returned_data[$cell] = "<tr><td>{$Row['name']}</td> 
                                    <td>{$pt_2_hours}</td> <td>{$pt_tot_hours}</td></tr>";
                                    $cell += 1;
                                }
                                print("<div class='table-responsive'>");
                                print("<table class='table table-dark table-striped table-hover table-bordered border-light caption-top'>");
                                print("<caption> Insights from date '$todays_date' </caption>");
                                print("<thead> <tr> <th scope = 'col'>Video Game Name </th> <th scope = 'col'>Playtime in the Past 2 Weeks (HOURS)</th>  <th scope = 'col'>Total Playtime (HOURS)</th> </tr> </thead>");
                                print("<tbody class='table-group-divider'>");
                                for($i = 0; $i < count($returned_data); $i++){
                                    print($returned_data[$i]);
                                }
                                print("</tbody>");
                                print("</table> </div> <br> <br>");
                            }
                            else{
                                // case 2: no data for today. 
                                // Step 5: FINAL STEP Insert today's data. Then print out today's data.
                                // free the result so we can do another query
                                mysqli_free_result($QueryResult);

                                print("<p style='text-align: center;'>Data added! Here's what we got from Steam today!</p>");

                                // perform as many insert queries as we have $data
                                for($i = 0; $i < count($new_data); $i++){
                                    $to_add = $new_data[$i];

                                    $InsertQuery = "INSERT INTO $table
                                    (`id`, `intakedate`, `name`, `playtime_2weeks`, `playtime_forever`, `img_logo_url`)
                                    VALUES
                                    (NULL, DEFAULT, '$to_add[0]', $to_add[1], $to_add[2], '$to_add[3]');";

                                    $QueryResult = mysqli_query($DBConnect, $InsertQuery);
                                    if($QueryResult == false){
                                        print("Sorry, something went wrong. Try again. <br>");
                                        print($DBConnect->error);
                                        break;
                                    }
                                    // successful insert, free the query result
                                    // mysqli_free_result($QueryResult);
                                }

                                // insert is complete. Now to simply print out today's data (what we just added)
                                $DateQuery = "SELECT * 
                                FROM $table 
                                WHERE intakedate = '$todays_date'";
                                $QueryResult = mysqli_query($DBConnect, $DateQuery);

                                if($QueryResult == false){
                                    print("Sorry, something went wrong. Try again. <br>");
                                    print($DBConnect->error);
                                }
                                else{
                                    $returned_data = array();
                                    $cell = 0;
                                    while($Row = mysqli_fetch_assoc($QueryResult)){
                                        // convert the playtime in minutes to playtime in hours, rounded to nearest 2 decimal places
                                        $pt_2_hours = round($Row['playtime_2weeks']/60, 2);
                                        $pt_tot_hours = round($Row['playtime_forever']/60, 2);

                                        $returned_data[$cell] = "<tr><td>{$Row['name']}</td> 
                                        <td>{$pt_2_hours}</td> <td>{$pt_tot_hours}</td></tr>";
                                        $cell += 1;
                                    }
                                    print("<div class='table-responsive'>");
                                    print("<table class='table table-dark table-striped table-hover table-bordered border-light caption-top'>");
                                    print("<caption> Insights from date '$todays_date' </caption>");
                                    print("<thead> <tr> <th scope = 'col'>Video Game Name </th> <th scope = 'col'>Playtime in the Past 2 Weeks (HOURS)</th>  <th scope = 'col'>Total Playtime (HOURS)</th> </tr> </thead>");
                                    print("<tbody class='table-group-divider'>");
                                    for($i = 0; $i < count($returned_data); $i++){
                                        print($returned_data[$i]);
                                    }
                                    print("</tbody>");
                                    print("</table> </div> <br> <br>");
                                }
                                // free the final result
                                mysqli_free_result($QueryResult);
                            }
                            // close connection
                            mysqli_close($DBConnect);
                        }

                    }
                }
                else if($recent_or_owned == "ownedgames"){
                    // Step 3 for owned games: Take the JSON data and put the useful data into it's own 2D array. Array 1 = game1 info, array 2 = game2 info, etc.
                    // this is how big the new data array will be, also how many inserts we'll need
                    $total_games = $data['response']['game_count'];
                    $new_data = array();
                    
                    for($i = 0; $i < $total_games; $i++){
                        // want name, playtime_2weeks, playtime_forever, img_icon_url
                        $name = $data['response']['games'][$i]['name'];
                        $name = str_replace("'", '', $name);
                        $playtime_forever = $data['response']['games'][$i]['playtime_forever'];
                        $img_icon_url = $data['response']['games'][$i]['img_icon_url'];
                        
                        // put these into their own array and add it to the new data array
                        $data_cell = array($name, $playtime_forever, $img_icon_url);
                        $new_data[$i] = $data_cell;
                    }


                    // Step 4: assign current date ato a variable, used in drop and insert queries.
                    $todays_date = stripcslashes(date("Y-m-d"));

                    // step 5: run a select query to see if there is already data for current date. If yes, continue. Otherwise, STOP HERE.
                    // make a DB connection
                    $DBConnect = mysqli_connect($IP, $username, $password, $SchemaName);
                            
                    // If there isn't a connection, let the admin know
                    if($DBConnect == false){
                        print("Unable to connect to the database" + mysqli_errno($mysqli));
                    } else{
                        $DateQuery = "SELECT * 
                        FROM $table 
                        WHERE intakedate = '$todays_date'
                        ORDER BY `name` ASC";
                        $QueryResult = mysqli_query($DBConnect, $DateQuery);

                        if($QueryResult == false){
                            print("Sorry, something went wrong with selecting rows with todays date. Try again. <br>");
                            print($DBConnect->error);
                        }
                        else{
                            if(mysqli_num_rows($QueryResult) > 0){
                                // case 1: already data for today, just print today's data
                                print("<p style='text-align: center;'>Sorry, there's already data for today. Here it is!</p>");
                                $returned_data = array();
                                $cell = 0;
                                while($Row = mysqli_fetch_assoc($QueryResult)){
                                    // convert the playtime in minutes to playtime in hours, rounded to nearest 2 decimal places
                                    $pt_tot_hours = round($Row['playtime_forever']/60, 2);

                                    $returned_data[$cell] = "<tr><td>{$Row['name']}</td> 
                                    <td>{$pt_tot_hours}</td></tr>";
                                    $cell += 1;
                                }
                                print("<div class='table-responsive'>");
                                print("<table class='table table-dark table-striped table-hover table-bordered border-light caption-top'>");
                                print("<caption> Insights from date '$todays_date' </caption>");
                                print("<thead> <tr> <th scope = 'col'>Video Game Name </th> <th scope = 'col'>Total Playtime (HOURS)</th> </tr> </thead>");
                                print("<tbody class='table-group-divider'>");
                                for($i = 0; $i < count($returned_data); $i++){
                                    print($returned_data[$i]);
                                }
                                print("</tbody>");
                                print("</table> </div> <br> <br>");
                            }
                            else{
                                // case 2: no data for today. 
                                // step 6 INSERT FIRST: run insert queries for every game in the 2D array. X queries for an array of size X.
                                mysqli_free_result($QueryResult);

                                print("<p style='text-align: center;'>Data added! Here's what we got from Steam today!</p>");

                                // perform as many insert queries as we have $data
                                for($i = 0; $i < count($new_data); $i++){
                                    $to_add = $new_data[$i];

                                    $InsertQuery = "INSERT INTO $table
                                    (`id`, `intakedate`, `name`, `playtime_forever`, `img_logo_url`)
                                    VALUES
                                    (NULL, DEFAULT, '$to_add[0]', $to_add[1], '$to_add[2]');";

                                    $QueryResult = mysqli_query($DBConnect, $InsertQuery);
                                    if($QueryResult == false){
                                        print("Sorry, something went wrong with inserting. Try again. <br>");
                                        print($InsertQuery);
                                        print($DBConnect->error);
                                        break;
                                    }
                                }
                                // step 7 DELETE SECOND: run a delete query for every entry whose intakedate is NOT currdate.
                                $SQLDelete = "DELETE FROM $table
                                WHERE intakedate != '$todays_date'";

                                $QueryResult = mysqli_query($DBConnect, $SQLDelete);

                                if($QueryResult == false){
                                    print("Sorry, something went wrong with deleting. Try again. <br>");
                                    print($DBConnect->error);
                                }
                                else{
                                    // step 8 FINAL STEP - FRONTEND DISPLAY: run a select all query and display all of our data neatly, as we have for recentgames and show-records.
                                    // insert is complete. Now to simply print out today's data (what we just added)
                                $DateQuery = "SELECT * FROM $table
                                WHERE intakedate = '$todays_date'
                                ORDER BY `name` ASC";

                                $QueryResult = mysqli_query($DBConnect, $DateQuery);

                                if($QueryResult == false){
                                    print("Sorry, something went wrong. Try again. <br>");
                                    print($DBConnect->error);
                                }
                                else{
                                    $returned_data = array();
                                    $cell = 0;
                                    while($Row = mysqli_fetch_assoc($QueryResult)){
                                        // convert the playtime in minutes to playtime in hours, rounded to nearest 2 decimal places
                                        $pt_tot_hours = round($Row['playtime_forever']/60, 2);

                                        $returned_data[$cell] = "<tr><td>{$Row['name']}</td> 
                                        <td>{$pt_tot_hours}</td></tr>";
                                        $cell += 1;
                                    }
                                    print("<div class='table-responsive'>");
                                    print("<table class='table table-dark table-striped table-hover table-bordered border-light caption-top'>");
                                    print("<caption> Insights from date '$todays_date' </caption>");
                                    print("<thead> <tr> <th scope = 'col'>Video Game Name </th> <th scope = 'col'>Total Playtime (HOURS)</th> </tr> </thead>");
                                    print("<tbody class='table-group-divider'>");
                                    for($i = 0; $i < count($returned_data); $i++){
                                        print($returned_data[$i]);
                                    }
                                    print("</tbody>");
                                    print("</table> </div> <br> <br>");
                                }
                                // free the final result
                                mysqli_free_result($QueryResult);
                                }
                            }
                        }
                    // close connection
                    mysqli_close($DBConnect);
                    }
                    
                }
                // test prints to see what the associatives look like, how to traverse
                // var_dump($data);
                // print("Total count: ".$data['response']['game_count'].'<br>');
                // print("Particular game name: ".$new_data[0][0].'<br>');
                // print("Particular game pt forever: ".$new_data[0][1]);
            ?>
            
        </div>
    </div>

    <!-- Below are the scripts for bootstrap, includes popper for dropdowns, popovers, and tooltips.-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</body>
</html>