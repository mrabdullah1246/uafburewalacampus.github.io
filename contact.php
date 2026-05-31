<?php
$insert = false;

if(isset($_POST['name'])){   

$server = "localhost";
$username = "root";
$password = "";
$database = "ug_form";

$con = mysqli_connect($server,$username,$password,$database);

if(!$con){
    die("connection failed: " . mysqli_connect_error());
}

$FristName = isset($_POST['fname']) ? $_POST['fname'] : '';
$LastName = isset($_POST['lname']) ? $_POST['lname'] : '';
$Email = isset($_POST['email']) ? $_POST['email'] : '';
$Phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$Department = isset($_POST['dep']) ? $_POST['dep'] : '';
$Subject = isset($_POST['subject']) ? $_POST['subject'] : '';
$Message = isset($_POST['message']) ? $_POST['message'] : '';



$sql = "INSERT INTO `student_data` (`DOE`, `name`, `email`, `ag`, `FName`, `CNIC`, `Address`, `degree`, `Semester`, `Shift`, `Fee Voucher`,`CourseCode1`,`CourseName1`,`CreditHours1`,`CourseCode2`,`CourseName2`,`CreditHours2`) 
VALUES ('$DOE','$name','$email','$ag','$FName','$CNIC','$Address','$degree','$Semester','$Shift','$FeeVoucher','$CourseCode1','$CourseName1','$CreditHours1','$CourseCode2','$CourseName2','$CreditHours2')";

$result = mysqli_query($con, $sql);

if($result){
    $insert = true;
} else {
    echo "ERROR: " . mysqli_error($con);
}

$con->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - University of Agriculture Faisalabad</title>
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        /* Header Styles */
        .top-header {
            background-color: #2c5f2d;
            color: white;
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo {
            height: 70px;
            margin-right: 15px;
        }

        .university-name {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .university-slogan {
            font-size: 1rem;
            font-style: italic;
            opacity: 0.9;
        }

        .header-tools {
            display: flex;
            gap: 20px;
        }

        .header-tools a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 8px 15px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .header-tools a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        nav {
            background-color: #204021;
            padding: 0 5%;
        }

        .nav-menu {
            display: flex;
            list-style: none;
        }

        .nav-menu li a {
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            display: block;
            transition: background-color 0.3s;
        }

        .nav-menu li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            padding: 10px;
            cursor: pointer;
        }

        /* Main Content Styles */
        .page-title {
            background: linear-gradient(rgba(44, 95, 45, 0.8), rgba(44, 95, 45, 0.9)), url('https://images.unsplash.com/photo-1562813733-b31f71025d54?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 60px 20px;
            margin-bottom: 40px;
        }

        .page-title h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .page-title p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .contact-info {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .contact-info h2 {
            color: #2c5f2d;
            margin-bottom: 20px;
            font-size: 1.8rem;
            padding-bottom: 10px;
            border-bottom: 2px solid #eaeaea;
        }

        .contact-detail {
            display: flex;
            margin-bottom: 25px;
            align-items: flex-start;
        }

        .contact-detail i {
            background-color: #2c5f2d;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .contact-text h3 {
            color: #2c5f2d;
            margin-bottom: 5px;
            font-size: 1.2rem;
        }

        .contact-text p {
            color: #555;
            line-height: 1.5;
        }

        .map-container {
            margin-top: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .map-container iframe {
            width: 100%;
            height: 250px;
            border: none;
        }

        .contact-form {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .contact-form h2 {
            color: #2c5f2d;
            margin-bottom: 20px;
            font-size: 1.8rem;
            padding-bottom: 10px;
            border-bottom: 2px solid #eaeaea;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #444;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #2c5f2d;
            outline: none;
            box-shadow: 0 0 0 2px rgba(44, 95, 45, 0.2);
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .btn {
            background-color: #2c5f2d;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            display: inline-block;
            text-align: center;
        }

        .btn:hover {
            background-color: #204021;
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 12px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            display: none;
        }

        /* Footer Styles */
        footer {
            background-color: #2c5f2d;
            color: white;
            padding: 40px 5% 20px;
        }

        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-section {
            flex: 1;
            min-width: 250px;
            margin-bottom: 30px;
            padding-right: 20px;
        }

        .footer-section h3 {
            font-size: 1.3rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-section h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background-color: #ffc107;
        }

        .footer-section p {
            margin-bottom: 15px;
            font-size: 0.95rem;
        }

        .footer-section a {
            color: #ddd;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: color 0.3s;
        }

        .footer-section a:hover {
            color: #ffc107;
        }

        .social-links a {
            display: inline-block;
            margin-right: 15px;
            font-size: 1.2rem;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 20px;
            font-size: 0.9rem;
            color: #ccc;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .nav-menu {
                display: none;
                flex-direction: column;
                width: 100%;
            }

            .nav-menu.active {
                display: flex;
            }

            .mobile-menu-btn {
                display: block;
            }

            .top-header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .header-tools {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .page-title h1 {
                font-size: 2rem;
            }

            .container {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <header>
        <div class="top-header">
            <div class="logo-container">
                <img src="logo.png" alt="UAF Logo" class="logo">
                <div>
                    <div class="university-name">University of Agriculture Faisalabad</div>
                    <div class="university-slogan">Where Agriculture Meets Innovation</div>
                </div>
            </div>
            <div class="header-tools">
                <a href="https://lms.uaf.edu.pk/" target="_blank"><i class="fas fa-sign-in-alt"></i> Student LMS
                    Login</a>
                <a href="https://muazshaban.vercel.app/cgpa-calculator/auto" target="_blank"><i
                        class="fa-solid fa-calculator"></i> CGPA Calculator</a>
            </div>
        </div>
        <nav>
            <button class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="nav-menu">
                <li><a href="uaf.html">Home</a></li>
                <li><a href="https://web.uaf.edu.pk/Contents/downloads/organization_chart.pdf" target="_blank">About
                    </a></li>
                <li><a href="https://lms.uaf.edu.pk/" target="_blank">Academics </a> </li>
                <li><a href="https://uaf.edu.pk/uaf_research/prj_overview.html" target="_blank">Research</a></li>
                <li><a href="Faculty.html">Faculty & Staff</a></li>
                <li><a href="UGFORM.html">UG-Form Submission</a></li>
                <li><a href="contactfom.html">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <section class="page-title">
            <h1>Contact Us</h1>
            <p>Get in touch with the University of Agriculture Faisalabad. We're here to answer your questions and
                assist you.</p>
        </section>

        <div class="container">
            <div class="contact-info">
                <h2>Get In Touch</h2>

                <div class="contact-detail">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="contact-text">
                        <h3>Our Location</h3>
                        <p>University of Agriculture Faisalabad<br> Punjab, Pakistan</p>
                    </div>
                </div>

                <div class="contact-detail">
                    <i class="fas fa-phone"></i>
                    <div class="contact-text">
                        <h3>Phone Number</h3>
                        <p>(041) 9200161</p>
                    </div>
                </div>

                <div class="contact-detail">
                    <i class="fas fa-envelope"></i>
                    <div class="contact-text">
                        <h3>Email Address</h3>
                        <p>info@uaf.edu.pk<br>admissions@uaf.edu.pk</p>
                    </div>
                </div>

                <div class="contact-detail">
                    <i class="fas fa-clock"></i>
                    <div class="contact-text">
                        <h3>Office Hours</h3>
                        <p>Monday - Saturday: 8:00 AM - 6:00 PM</p>
                    </div>
                </div>

                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3402.212840033907!2d73.06985731514238!3d31.48117598137773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3922427d9e87ea7b%3A0x8e7e3f1b33d9a8b5!2sUniversity%20of%20Agriculture%2C%20Faisalabad!5e0!3m2!1sen!2s!4v1647364567890!5m2!1sen!2s"
                        allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <div class="contact-form">
                <h2>Send Us a Message</h2>
                <div class="success-message" id="successMessage">
                    <i class="fas fa-check-circle"></i> Thank you for your message! We'll get back to you soon.
                </div>
                <form id="contactForm" action="contact.php" method="post">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" name="fname" id="firstName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" name="lname" id="lastName" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="department">Department/Inquiry Type</label>
                        <select id="department" name="dep" class="form-control" required>
                            <option value="">Select an option</option>
                            <option value="admissions">Admissions</option>
                            <option value="academics">Academics</option>
                            <option value="research">Research</option>
                            <option value="faculty">Faculty & Staff</option>
                            <option value="student-affairs">Student Affairs</option>
                            <option value="general">General Inquiry</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="subject" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" name="message" class="form-control" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-block">Send Message</button>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer Section -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p><i class="fas fa-map-marker-alt"></i> University of Agriculture Faisalabad, Pakistan</p>
                <p><i class="fas fa-phone"></i> (041) 9200161</p>
                <p><i class="fas fa-envelope"></i> info@uaf.edu.pk</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <a href="https://pms.uaf.edu.pk/" target="_blank">Admissions</a>
                <a href="https://pms.uaf.edu.pk/" target="_blank">Academic Calendar</a>
                <a href="https://web.uaf.edu.pk/Library" target="_blank">Library</a>
                <a href="https://uaf.edu.pk/uaf_research/prj_overview.html" target="_blank">Research Centers</a>
                <a href="uaf.html">Alumni</a>
            </div>
            <div class="footer-section">
                <h3>Follow Us</h3>
                <div class="social-links">
                    <a href="https://www.facebook.com/edu.uaf.pk" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="contactfom.html" target="_blank"><i class="fas fa-envelope"></i></a>
                    <a href="https://www.instagram.com/uaf_pakistan" target="_blank"><i
                            class="fab fa-instagram"></i></a>
                    <a href="https://www.youtube.com/@universityofagriculturefai7274" target="_blank"><i
                            class="fab fa-youtube"></i></a>
                    <a href="https://www.linkedin.com/school/university-of-agriculture-faisalabad/posts/?feedView=all"
                        target="_blank"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 University of Agriculture Faisalabad. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu-btn').addEventListener('click', function () {
            document.querySelector('.nav-menu').classList.toggle('active');
        });

        // Contact form submission
        document.getElementById('contactForm').addEventListener('submit', function (e) {
            e.preventDefault();

            // In a real application, you would send the form data to a server here
            // For this example, we'll just show a success message

            document.getElementById('successMessage').style.display = 'block';

            // Reset the form
            this.reset();

            // Hide the success message after 5 seconds
            setTimeout(function () {
                document.getElementById('successMessage').style.display = 'none';
            }, 5000);
        });
    </script>
</body>

</html>