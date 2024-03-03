
<?php session_start();
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Souravs Portfolio Website</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <!-- Typing Script CDN Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.0/typed.min.js"></script>

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <!-- Nav Section Start Here -->
    <nav>
        <div class="container nav_container">
            <a href="index.html">

                <h4><span>S</span>D</h4>
            </a>
            <ul class="nav_menu">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#service">Service</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#portfolio">photo</a></li>

                <li><a href="#courses">Courses</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="#get_in_touch">In Touch</a></li>
                <li><a href="#my_timeline">Timeline</a></li>

            </ul>
            <button id="open-menu-btn"><i class="fa-solid fa-bars"></i></button>
            <button id="close-menu-btn"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </nav>
    <!-- Nav Section End Here -->

    <!-- Header Section Start Here -->
    <header>
        <div class="container header_container" id="home">
            <div class="header_left">
                <div class="header_left_img">
                    <img src="image/mdll.png" alt="Model Image">

                </div>
            </div>
            <div class="header_right">
                <!-- <img src="image/laptop.jpg" alt="laptop image"> -->
                <div class="text-1">Hello, this is</div>
                <div class="text-2"><span class="sd_text">Sourav Debnath</span></div>
                <div class="text-3">And I'm a <span class="typing"></span></div>
                <a href="https://www.facebook.com/" class="btn">Hire Me</a>  
                 <a href="login.php" class="btn">Login</a>
            </div>
        </div>
    </header>
    <!-- Header Section End Here -->

    <!-- About Me Section Start Here -->
    
    <section class="about" id="about">
        <h2 class="border_bottom">About Me</h2>
        <div class="container about_container">
            <div class="about-img">
                <img src="image/about.jpeg" alt="about model">
            </div>
            <div class="about-text">
                <div class="text">
                    I am Sourav Debnath and I'm a <span class="typing-2"></span>
                </div>
                <p>I am studying in CSE from KUET. Rather than study i love to play , explore and to visit. Technology
                    is my passion. I always try to share my knowledge and
                    experience and help others
                    because I believe that "It keeps me smiling".</p>
                <a href="https://drive.google.com/drive/u/0/folders/1YXHl5F_TavXNy4a0dBZMy8O6Ghviuih4" class="btn">Download CV</a>
            </div>
        </div>
    </section>
    <!-- About Me Section End Here -->




 
   <!-- My Services Section Start Here -->
<div class="services" id="service">
    <h2 class="border_bottom">My Services</h2>
    <div class="container services_container">
        <div class="cards">
            <?php
            // Your database connection code here
            $servername = "localhost";
            $db_username = "root";
            $db_password = "";
            $dbname = "web";

            $connection = new mysqli($servername, $db_username, $db_password, $dbname);

            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            // Fetch services data from the database
            $query = "SELECT * FROM services";
            $result = $connection->query($query);

            // Loop through the services data and generate HTML dynamically
            while ($service = $result->fetch_assoc()) {
                echo '<div class="card" style="background-color: ' . $service["background_color"] . '">';
                echo '<div class="sbox">';
                echo '<i class="fas ' . $service["icon"] . '"></i>';
                echo '<h3>' . $service["title"] . '</h3>';
                echo '<p>' . $service["description"] . '</p>';
                echo '<a href="' . $service["link"] . '">Learn More</a>';
                echo '</div>';
                echo '</div>';
            }

            // Close the database connection
            $connection->close();
            ?>
        </div>
    </div>
</div>
<!-- My Services Section End Here -->







    <!-- My Skills Section Start Here -->
    <div class="skills" id="skills">
        <div class="new">
            <h2 class="border_bottom">My Skills</h2>
        </div>
        <!-- container aita  device er response hisabe  kaj kore -->
        <div class="container skills_container">
            <div class="bar">
                <div class="info">
                    <span>HTML</span>
                </div>
                <div class="progress-line html">
                    <span></span>
                </div>
            </div>
            <div class="bar">
                <div class="info">
                    <span>CSS</span>
                </div>
                <div class="progress-line css">
                    <span></span>
                </div>
            </div>
            <div class="bar">
                <div class="info">
                    <span>Java</span>
                </div>
                <div class="progress-line java">
                    <span></span>
                </div>
            </div>
            <div class="bar">
                <div class="info">
                    <span>cpp</span>
                </div>
                <div class="progress-line cpp">
                    <span></span>
                </div>
            </div>
            <div class="bar">
                <div class="info">
                    <span>MySQL</span>
                </div>
                <div class="progress-line mysql">
                    <span></span>
                </div>
            </div>

        </div>
    </div>
    <!-- My Skills Section End Here -->




    <!-- My project Section Start Here -->
    <?php


$db = new mysqli('localhost', 'root', '', 'web');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


// Fetch projects data from the database
$query = "SELECT * FROM projects";
$result = $db->query($query);
?>

<!-- My Project Section Start Here -->
<div class="projects" id="projects">
    <h2 class="border_bottom">My Completed projects</h2>
    <div class="container projects_container">
        <?php
        // Loop through the fetched projects and generate HTML

        while ($row = $result->fetch_assoc()) {
            echo '<article class="project">'; // Changed from "projects" to "project"
            echo '<div class="project_image">'; // Changed from "course_image" to "project_image"
            echo '<img src="' . $row['image_path'] . '" alt="' . $row['title'] . '">';
            echo '</div>';
            echo '<div class="project_info">';
            echo '<h4>' . $row['title'] . '</h4>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<a href="' . $row['github_link'] . '" class="btn">Learn More</a>';
            echo '</div>';
            echo '</article>';
        }
        ?>
        
    </div>
</div>


<?php
$db->close();
?>

    <!-- My Project Section End Here -->


<!-- inline er priority beshi -->
<div class="container portfolio_container" id="portfolio">
    <h2 class="border_bottom " id="photo" style="color: rgb(39, 238, 221);">My Photographs</h2>
    <div class="gallery">
        <?php
        // Step 1: Connect to the "web" database
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "web";

        $connection = new mysqli($servername, $db_username, $db_password, $dbname);

        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Fetch data from the "photograph" table and display it in the gallery
        $query = "SELECT * FROM photograph";
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<a href='" . $row["image_path"] . "'><img src='" . $row["image_path"] . "' alt='" . $row["alt_text"] . "'></a>";
            }
        }

        // Close the database connection
        $connection->close();
        ?>
    </div>
</div>
<!-- My photograph Section End Here    -->

    <!-- My course Section Start Here -->
    <?php


$db = new mysqli('localhost', 'root', '', 'web');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


// Fetch projects data from the database
$query = "SELECT * FROM courses";
$result = $db->query($query);
?>

<!-- My course Section Start Here -->
<div class="courses" id="courses">
    <h2 class="border_bottom">My Completed courses</h2>
    <div class="container coursess_container">
        <?php
        // Loop through the fetched projects and generate HTML

        while ($row = $result->fetch_assoc()) {
            echo '<article class="course">'; // Changed from "projects" to "project"
            echo '<div class="course_image">'; // Changed from "course_image" to "project_image"
            echo '<img src="' . $row['image_path'] . '" alt="' . $row['title'] . '">';
            echo '</div>';
            echo '<div class="project_info">';
            echo '<h4>' . $row['title'] . '</h4>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<a href="' . $row['internet_link'] . '" class="btn">Learn More</a>';
            echo '</div>';
            echo '</article>';
        }
        ?>
        
    </div>
</div>


<?php
$db->close();
?>

    <!-- My course Section End Here -->










<!-- contact me form  start here-->

<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Insert data into the database
    $sql = "INSERT INTO  in_touch (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
     //   echo "Data inserted successfully!";
    } else {
      //  echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>






<!-- contact me form start here -->



<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Insert data into the database
    $sql = "INSERT INTO in_touch (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
     
    } else {
       
    }
}

// Close the database connection
$conn->close();
?>



<div class="containerrrr" id="get_in_touch">
        <h2>Get in Touch</h2>
        <form class="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Your Name" style="width: 40%;" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Your Email" style="width: 40%;" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" placeholder="Your Message" rows="4" style="width: 40%;" required></textarea>

            <button type="submit"name="submit" class="btn">Submit</button>
        </form>
    </div>








<!-- contact me form end here -->

<!-- my timeline start here -->
<div class="contaaainer" id="my_timeline">
    <h2 class="border_bottom">
        My timeline
    </h2>
    <div class="timeline">
        <ul>
            <?php
            // Step 1: Connect to the "web" database
            $servername = "localhost";
            $db_username = "root";
            $db_password = "";
            $dbname = "web";

            $connection = new mysqli($servername, $db_username, $db_password, $dbname);

            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            // Fetch data from the "timeline" table and display it in the timeline
            $query = "SELECT * FROM timeline";
            $result = $connection->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li>";
                    echo "<div class='timeline-content'>";
                    echo "<h3 class='date'>" . $row["date"] . "</h3>";
                    echo "<h1>" . $row["event_title"] . "</h1>";
                    echo "<p>" . $row["event_description"] . "</p>";
                    echo "</div>";
                    echo "</li>";
                }
            }

            // Close the database connection
            $connection->close();
            ?>
        </ul>
    </div>
</div>
<!-- my timeline end here -->








<!-- my timeline end here -->








    <!-- FAQs Section Start Here -->
    <section class="faqs">
        <h2 class="border_bottom">
            Frequently Asked Question
        </h2>
        <div class="container faqs_container">
            <article class="faq">
                <div class="faq_icon">
                    <!-- for + -->
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div class="question_ans">
                    <h4>What should be included in ones portfolio?</h4>
                    <p>Include a mix of your best work, projects, educational background, skills, and any relevant
                        experience that aligns with your career goals.</p>
                </div>
            </article>
            <article class="faq">
                <div class="faq_icon">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div class="question_ans">
                    <h4>Should anyone include personal projects ?</h4>
                    <p>Including personal projects can demonstrate creativity and passion, but prioritize showcasing
                        work relevant to your career goals.</p>
                </div>
            </article>
            <article class="faq">
                <div class="faq_icon">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div class="question_ans">
                    <h4>Should anyone include his resume in my portfolio?</h4>
                    <p>Yes, including a downloadable or accessible resume is advisable for a more comprehensive overview
                        of your qualifications..</p>
                </div>
            </article>
            <article class="faq">
                <div class="faq_icon">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div class="question_ans">
                    <h4>Is it necessary to have a personal website for my portfolio?</h4>
                    <p>While a personal website is common, you can also use platforms like LinkedIn, Behance, or GitHub
                        to showcase your work. Having a website, however, provides more control over the presentation.
                    </p>
                </div>
            </article>


        </div>
    </section>
    <!-- FAQs Section End Here -->

    <!-- Footer Section Start Here -->
    <footer>
        <div class="container footer_container">
            <div class="footer_1">
                <!-- sourav e  click korle  cole  jabe index.html  e  -->
                <a href="index.html" class="footer_logo">
                    <h4>SOURAV</h4>
                </a>
                <p>Designer of this website.</p>
            </div>

            <div class="footer_2">
                <h4>Permalinks</h4>
                <ul class="permalinks">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#courses">Courses</a></li>

                    <!-- edit   baki ase  aikhane contact er>>>>>>>>>>> -->
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <div class="footer_3">
                <h4>Privacy</h4>
                <ul class="privacy">
                    <li><a href="https://www.privacypolicies.com/blog/privacy-policy-template/">Privacy & Policy</a>
                    </li>
                    <li><a href="https://www.termsfeed.com/blog/sample-terms-and-conditions-template/">Terms &
                            Conditions</a></li>
                    <li><a href="https://www.termsfeed.com/blog/sample-return-policy-ecommerce-stores/">Refund
                            Ploicy</a></li>
                </ul>
            </div>

            <div class="footer_4">
                <h4 id="contact">Contact Me</h4>

                <div>
                    <p>+880 1614981899</p>
                    <p class="mail">souravdebnath54474@gmail.com</p>
                </div>


                <ul class="footer_social">
                    <li><a href="https://www.facebook.com/"> <i class="fa-brands fa-facebook-f"></i> </a>
                    </li>
                    <li><a href="https://www.instagram.com/sou_rav_109?igsh=bXJlN200cm01MXdx"> <i
                                class="fa-brands fa-instagram"></i> </a></li>

                    <li><a href="https://github.com/"> <i class="fa-brands fa-github"></i> </a></li>
                </ul>
            </div>
        </div>

        <!-- copyright -->
        <div class="footer_copyright">
            <small>Copyright &copy;Sourav Debnath</small>
        </div>
    </footer>
    <!-- Footer Section End Here -->


    <!-- Custom Javascript File Link -->
    <script src="js/script.js"></script>
</body>

</html>