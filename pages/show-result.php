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
            <h1 id="top-header">Personal Steam Statistics: <br> Database Query Results!</h1>
        </div>
        <!-- Bootstrap Nav -->
        <?php include '../components/nav.php'?>
        <div id="contact-spacing"></div>
        
        <div id="show-result-content-cont">
            <?php
                // Making a database connection
                $DBConnect = mysqli_connect($IP, $username, $password, $SchemaName);
                
                // If there isn't a connection, let the admin know
                if($DBConnect == false){
                    print("Unable to connect to the database" + mysqli_errno($mysqli));
                } else{
                    // get the posted information (Not gonna retrieve user since there's no plans to have multiple users)
                    $recent_or_owned = stripcslashes($_POST['table']);

                    // Name of our table = ^^
                    $TableName = "$recent_or_owned";

                    // Select everything from this table, since we wanna display it all.
                    // want to order alphabetically for owned games since the data is gross to look at
                    if($recent_or_owned == "recentgames"){
                        $SQLSelect = "SELECT * FROM $TableName 
                        ORDER BY intakedate DESC";
                    }
                    else if($recent_or_owned == "ownedgames"){
                        $SQLSelect = "SELECT * FROM $TableName 
                        ORDER BY `name` ASC";
                    }

                    $QueryResult = mysqli_query($DBConnect, $SQLSelect);

                    if($QueryResult == false){
                        print("Sorry, something went wrong. Try again. <br>");
                        print($DBConnect->error);
                    }
                    
                    // check to see if there are records in the table
                    if(mysqli_num_rows($QueryResult) > 0){
                        // output results in dynamic table depending on the SQL table flavor
                        // for our recent games we want to output many nice tables for each "intake_date"
                        if($recent_or_owned == "recentgames"){
                            print("<p style='text-align: center;'>Your Recently Played Games: Neatly Sorted by Date!</p>");
                            // Getting all the data sorted by intake date.
                            $prevDate = "";
                            $tableNum = -1;
                            $cell = 0;
                            $data = array();
                            $data[0] = array();
                            while($Row = mysqli_fetch_assoc($QueryResult)){
                                $currDate = $Row['intakedate'];
                                if($prevDate == $currDate){
                                    // convert the playtime in minutes to playtime in hours, rounded to nearest 2 decimal places
                                    $pt_2_hours = round($Row['playtime_2weeks']/60, 2);
                                    $pt_tot_hours = round($Row['playtime_forever']/60, 2);
                                    $data[$tableNum][$cell] = "<tr><td>{$Row['name']}</td> 
                                    <td>{$pt_2_hours}</td> <td>{$pt_tot_hours}</td></tr>";
                                    $cell += 1;
                                } else{
                                    $tableNum += 1;
                                    $cell = 0;
                                    
                                    $data[$tableNum] = array();
                                    $data[$tableNum][$cell] = $currDate;
                                    $cell += 1;
                                    
                                    // convert the playtime in minutes to playtime in hours, rounded to nearest 2 decimal places
                                    $pt_2_hours = round($Row['playtime_2weeks']/60, 2);
                                    $pt_tot_hours = round($Row['playtime_forever']/60, 2);

                                    $data[$tableNum][$cell] = "<tr><td>{$Row['name']}</td> 
                                    <td>{$pt_2_hours}</td> <td>{$pt_tot_hours}</td></tr>";
                                    $cell += 1;
                                }
                                $prevDate = $currDate;
                            }
                             // Now we need to take this data, iterate through it, and output many nice tables (ideally)
                            // Will use nested for loops to hit each node
                            for($i = 0; $i < count($data); $i++){
                                $currDate = $data[$i][0];
                                print("<div class='table-responsive'>");
                                print("<table class='table table-dark table-striped table-hover table-bordered border-light caption-top'>");
                                print("<caption> Insights from date $currDate </caption>");
                                print("<thead> <tr> <th scope = 'col'>Video Game Name </th> <th scope = 'col'>Playtime in the Past 2 Weeks (HOURS)</th>  <th scope = 'col'>Total Playtime (HOURS)</th> </tr> </thead>");
                                print("<tbody class='table-group-divider'>");
                                for($j = 1; $j < count($data[$i]); $j++){
                                    print($data[$i][$j]);
                                }
                                print("</tbody>");
                                print("</table> </div> <br> <br>");
                            }
                        }
                        else if($recent_or_owned == "ownedgames"){
                            print("<p style='text-align: center;'>All of Your Owned Games and Playtimes!</p>");
                            print("<div class='table-responsive'>");
                            print("<table class='table table-dark table-striped table-hover table-bordered border-light caption-top'>");
                            print("<caption> All owned steam games stored in the database. Results are sorted in alphabetical order.</caption>");
                            print("<thead> <tr> <th scope = 'col'>Video Game Name </th> <th scope = 'col'>Total Playtime (HOURS)</th> </tr> </thead>");
                            print("<tbody class='table-group-divider'>");
                            while($Row = mysqli_fetch_assoc($QueryResult)){
                                // convert the playtime in minutes to playtime in hours, rounded to nearest 2 decimal places
                                $pt_tot_hours = round($Row['playtime_forever']/60, 2);

                                print("<tr><td>{$Row['name']}</td> 
                                <td>{$pt_tot_hours}</td></tr>");
                            }
                            print("</tbody>");
                            print("</table> </div> <br> <br>");
                        }
                    else{
                        print("There are no results to display");
                    }
                    mysqli_free_result($QueryResult);
                    }
                }
                // close connection
                mysqli_close($DBConnect);
            ?>
            
        </div>
    </div>

    <!-- Below are the scripts for bootstrap, includes popper for dropdowns, popovers, and tooltips.-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</body>
</html>