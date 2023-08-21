<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Data</title>
    <!-- Below are the CDNs for Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../stylesheets/styles.css">

</head>
<body>
<div class="container-fluid">
        <div id="head-margin">
            <h1 id="top-header">Personal Steam Statistics: <br> Get New Steam Data</h1>
        </div>
        <!-- Bootstrap Nav -->
        <?php include '../components/nav.php'?>
        <div id="get-content-container">
            <div id="show-spacing"></div>
            <p style="text-align: center;">Hello! Before you continue, we need some basic information on the data that you want. <br> <br> <br></p>

            <form action="get-result.php" method="POST">
                <div class="mb-3" style="margin: auto; text-align: center;">
                    <div style="display: inline-flex; width: auto;">
                        <label for="userSelect" class="form-label" style="text-align: center;">Which User Would You Like? </label>
                        <select name="user" class="form-select form-select-lg" aria-label="Default select example" style="width: auto; float: right; margin-left: 10px;">
                            <option selected value="Dev">Website Developer</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3" style="margin: auto; text-align: center;">
                    <div style="display: inline-flex; width: auto;">
                            <label for="tableSelect" class="form-label" style="text-align: center;">Would you like previously played games or all owned games? </label>
                            <select name="table" class="form-select form-select-lg" aria-label="Default select example" style="width: auto; float: right; margin-left: 10px;">
                                <option value="recentgames">Recently Played Games</option>
                                <option value="ownedgames">All Owned Games</option>
                            </select>
                    </div>
                </div>
                <div style="width: 100%; text-align: center; left: 50%;">
                    <button type="submit" class="btn btn-primary btn-lg" style="left: 50%;">Submit</button>
                </div>
                <br>
                <div style="width: 100%; text-align: center; left: 50%;">
                    <p style="text-align: center;">Note: This will call the Steam API and request personal user data. <br> This requires an internet connection! <br> This will also post the requested data into the database IF AND ONLY IF there is no data for today's date! <br> See "Help" page for more info.</p>
                </div>
            </form>
        </div>
    </div>
    

    <!-- Below are the scripts for bootstrap, includes popper for dropdowns, popovers, and tooltips.-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</body>
</html>