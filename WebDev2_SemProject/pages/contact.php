<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me</title>
    <!-- Below are the CDNs for Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../stylesheets/styles.css">

</head>
<body>
    <div class="container-fluid">
        <div id="head-margin">
            <h1 id="top-header">Personal Steam Statistics: <br> Contact Information</h1>
        </div>
        <!-- Bootstrap Nav -->
        <?php include '../components/nav.php'?>
        <div id="contact-spacing"></div>
        <div id="contact-content-container">
            <!-- NOTE: ALL ICONS ARE SOURCED DIRECTLY FROM BOOTSTRAP (FREE TO USE FOR ALL) -->
            <p style="text-align: center; font-size: 26pt;"> Need to Reach Out? </p>
            <svg alt="A basic icon of a person in a bubble." xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16" style="float: left; margin-left: 4px; margin-top: 4px; max-width: 100%;">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
            </svg>
            <h2 style="text-align: left; padding-left: 40px;"> Name: Ben Platt </h2>
            <svg alt="A basic icon of an envelope with an exclamation point on its button right." xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-envelope-exclamation-fill" viewBox="0 0 16 16" style="float: left; margin-left: 4px; margin-top: 4px; max-width: 100%;"> 
                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.026A2 2 0 0 0 2 14h6.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586l-1.239-.757ZM16 4.697v4.974A4.491 4.491 0 0 0 12.5 8a4.49 4.49 0 0 0-1.965.45l-.338-.207L16 4.697Z"/>
                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1.5a.5.5 0 0 1-1 0V11a.5.5 0 0 1 1 0Zm0 3a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z"/>
            </svg>
            <h2 style="text-align: left; padding-left: 40px;"> Email: plattbenjamint@gmail.com </h2>
            <svg alt="A basic icon of a page with left and right pointing single angle quotation marks." xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-code-fill" viewBox="0 0 16 16" style="float: left; margin-left: 4px; margin-top: 4px; max-width: 100%;">
                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.646 7.646a.5.5 0 1 1 .708.708L5.707 10l1.647 1.646a.5.5 0 0 1-.708.708l-2-2a.5.5 0 0 1 0-.708l2-2zm2.708 0 2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L10.293 10 8.646 8.354a.5.5 0 1 1 .708-.708z"/>
            </svg>
            <h2 style="text-align: left; padding-left: 40px;"> <a href="https://github.com/ben-platt23/SteamStat" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Source Code (GitHub)</a> </h2>
        </div>
    </div>

    <!-- Below are the scripts for bootstrap, includes popper for dropdowns, popovers, and tooltips.-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</body>
</html>