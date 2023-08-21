<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help</title>
    <!-- Below are the CDNs for Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../stylesheets/styles.css">

</head>
<body>
    <div class="container-fluid">
        <div id="head-margin">
            <h1 id="top-header">Personal Steam Statistics: <br> Help Page</h1>
        </div>
        <!-- Bootstrap Nav -->
        <?php include '../components/nav.php'?>
        <div id="show-spacing"></div>
        <div id="help-content-container">
        <p style="text-align: center; font-size: 26pt;">Need help? Click on one of our dropdowns! <br></p>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        1. About
                    </button>
                    </h2>
                    <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <span style="color: #5A18C9; font-size: 14pt;">Hello!</span> Thank you for visiting our website! This website was built as a semester project for my Computer Science course "Web Development and Programming 2."
                        It is designed to be a personal, informational website about my personal video gaming habits. It gathers <span style="color: red;">data</span> from <span style="color: red;">Steam's API</span> about the games that I've played recently, and other games that I own in my <span style="color: red;">library!</span> 
                        Please feel free to play around with it, as this was such a fun project for me to develop! If you have any thoughts or comments, I'd love to receive your feedback at my email (See the "Contact" page or the "Find an error? Something not working as expected?" section on this help page).
                    </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        2. "Create Data" Page 
                    </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        This page is the "meat and potatoes" of the website. It gathers <span style="color: red;">data</span> from <span style="color: red;">Steam's API</span> about the games that I've played recently, and other games that I own in my <span style="color: red;">library.</span>
                        To use this feature, you'll need to fill out a form to give me some basic information on the <span style="color: red;">data</span> that you'd like. Complete the form by selecting from the options in the "drop-down" menu. Make sure to click <span style="color: blue;">"SUBMIT"</span> when you're finished filling out the form! Note that there is only one "user"
                        available at this time. Perhaps, in the future, the website will be expanded to allow for multiple users. The <span style="color: red;">data</span> for <span style="color: red;">"Recently Played Games"</span>that is requested will be stored in a <span style="color: red;">database</span> if there hasn't been any data stored yet today. 
                        If there is already data for today's date, the website will tell you that and display today's data. For <span style="color: red;">"Owned Games,"</span> the data will be stored in the database regardless of today's date.  
                    </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        3. "Show Data" Page
                    </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        This page contains the second major feature for this website. It gathers stored <span style="color: red;">data</span> from the <span style="color: red;">database.</span>  To use this feature, you'll need to fill out a form to give me some basic information on the <span style="color: red;">data</span> that you'd like. Complete the form by selecting from the options in the "drop-down" menu. Make sure to click <span style="color: blue;">"SUBMIT"</span> when you're finished filling out the form! Note that there is only one "user"
                        available at this time. Perhaps, in the future, the website will be expanded to allow for multiple users. After submitting, you will be able to view some neatly formatted data on my video gaming habits.
                    </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        4. Terminology
                    </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong style="color: red;">API - </strong>Stands for an "Application Programming Interface." For the purposes of this website, the <span style="color: red;">API</span> is how we can get <span style="color: red;">data</span> from <span style="color: red;">Valve</span> about our video game habits.   <br>
                        <strong style="color: red;">Steam - </strong> A video game distribution service by <span style="color: red;">Valve</span>. It has notable community features, mod support tools, and a complete store with the latest video games.   <br>
                        <strong style="color: red;">Valve - </strong> An American software company. Valve is most known for their Steam service, as well as developing video games like Counter Strike and Dota.   <br>
                        <strong style="color: red;">Data - </strong> For the purpose of this website: data is the information that is given about the user's video game habits (such as video game name, playtime, etc).  <br>
                        <strong style="color: red;">Database - </strong> An organized collection of data that is stored and read by this website. All of the data that is stored has been sent by <span style="color: red;">Steam's API.</span>    <br>
                        <strong style="color: red;">Game "Library" - </strong> A convenvient location for players to find all of their video games on the Steam application. Think of "bookcases" in real-life.   <br>
                        <strong style="color: red;">"Owned Games" - </strong> Video games that are in your library. They have either been purchased in the store, gifted by a friend, or acquired for free.    <br>
                        <strong style="color: red;">"Recently Played Games" - </strong> Video games in your library that have been played (or opened) within the past two weeks.  <br>
                    </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        5. Find an error? Something not working as expected?
                    </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        We want to hear from you! If you believe that you have found an error with our website, please reach out via email! Our email is on the "Contact" page and we'll leave it here for your convenience: <br> <br> plattbenjamint@gmail.com. <br> <br> For advanced users, the source code for this project is on GitHub (see "Contact" page). We would be happy to review a pull request with appropriate changes!
                    </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        6. For Advanced Users - Technology Stack Used
                    </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        WAMP Stack: Windows, Apache Server, MySQL, PHP <br> <br>
                        Bootstrap Framework was used for many UI components (including this accordion!). <br> <br>
                        A bit of JavaScript was also used for the Navbar.
                    </div>
                    </div>
                </div>
            </div>
        </div>            
    </div>

    <!-- Below are the scripts for bootstrap, includes popper for dropdowns, popovers, and tooltips.-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</body>
</html>