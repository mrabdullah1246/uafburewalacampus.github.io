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

$DOE = isset($_POST['doe']) ? $_POST['doe'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$ag = isset($_POST['ag']) ? $_POST['ag'] : '';
$FName = isset($_POST['fname']) ? $_POST['fname'] : '';
$CNIC = isset($_POST['cnic']) ? $_POST['cnic'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$DOB = isset($_POST['dob']) ? $_POST['dob'] : '';
$Address = isset($_POST['Address']) ? $_POST['Address'] : '';
$degree = isset($_POST['degree']) ? $_POST['degree'] : '';
$Semester = isset($_POST['semester']) ? $_POST['semester'] : '';
$Shift = isset($_POST['shift']) ? $_POST['shift'] : '';
$FeeVoucher = isset($_POST['feeVoucher']) ? $_POST['feeVoucher'] : '';
$CourseCode1 = isset($_POST['ccode1']) ? $_POST['ccode1'] : '';
$CourseName1 = isset($_POST['cname1']) ? $_POST['cname1'] : '';
$CreditHours1 = isset($_POST['chours1']) ? $_POST['chours1'] : '';
$CourseCode2 = isset($_POST['ccode2']) ? $_POST['ccode2'] : '';
$CourseName2 = isset($_POST['cname2']) ? $_POST['cname2'] : '';
$CreditHours2 = isset($_POST['chours2']) ? $_POST['chours2'] : '';


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
    <title>UG Form Submission - University of Agriculture Faisalabad</title>
    <style>
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
            background: linear-gradient(rgba(44, 95, 45, 0.8), rgba(44, 95, 45, 0.9)), url('https://images.unsplash.com/photo-1582573618381-c6713f7fcee2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
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
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px 40px;
        }

        .form-container {
            background-color: white;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h2 {
            color: #2c5f2d;
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #666;
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

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
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
            padding: 14px;
            font-size: 1.1rem;
            margin-top: 20px;
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid #2c5f2d;
            color: #2c5f2d;
        }

        .btn-outline:hover {
            background-color: #2c5f2d;
            color: white;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 30px;
            text-align: center;
            border: 2px solid #c3e6cb;
        }

        .success-message i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #28a745;
        }

        .download-section {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #c3e6cb;
        }

        .download-btn {
            background-color: #28a745;
            color: white;
            padding: 12px 25px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .download-btn:hover {
            background-color: #218838;
        }

        .instructions {
            background-color: #e7f3ff;
            border-left: 4px solid #2c5f2d;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 4px;
        }

        .instructions h3 {
            color: #2c5f2d;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .instructions ul {
            padding-left: 20px;
        }

        .instructions li {
            margin-bottom: 8px;
        }

        .required {
            color: #e74c3c;
        }

        .section-title {
            color: #2c5f2d;
            border-bottom: 2px solid #eaeaea;
            padding-bottom: 10px;
            margin: 30px 0 20px;
            font-size: 1.4rem;
        }

        .extra-course {
            background-color: #f9f9f9;
            border: 1px solid #eaeaea;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .course-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .course-header h4 {
            color: #2c5f2d;
            margin: 0;
        }

        .remove-course {
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 6px 12px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .file-upload {
            border: 2px dashed #ddd;
            border-radius: 6px;
            padding: 30px;
            text-align: center;
            margin-bottom: 20px;
            transition: border-color 0.3s;
        }

        .file-upload:hover {
            border-color: #2c5f2d;
        }

        .file-upload i {
            font-size: 2.5rem;
            color: #2c5f2d;
            margin-bottom: 15px;
        }

        .file-input {
            display: none;
        }

        .file-label {
            background-color: #2c5f2d;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            display: inline-block;
            margin-top: 10px;
        }

        .file-name {
            margin-top: 10px;
            font-size: 0.9rem;
            color: #666;
        }

        .form-note {
            background-color: #fff8e1;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            font-size: 0.95rem;
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

            .form-row {
                grid-template-columns: 1fr;
            }

            .form-container {
                padding: 25px;
            }

            .course-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
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
            <a href="https://lms.uaf.edu.pk/" target="_blank"><i class="fas fa-sign-in-alt"></i> Student LMS Login</a>
            <a href="https://lms.uaf.edu.pk/" target="_blank"><i class="fa-solid fa-calendar-days"></i> Academic Calendar</a>
          </div>
        </div>
        <nav>
          <button class="mobile-menu-btn">
            <i class="fas fa-bars"></i>
          </button>
          <ul class="nav-menu">
            <li><a href="uaf.html">Home</a></li>
            <li><a href="https://web.uaf.edu.pk/Contents/downloads/organization_chart.pdf" target="_blank">About </a></li>
            <li><a href="https://lms.uaf.edu.pk/" target="_blank">Academics </a> </li>
            <li><a href="https://uaf.edu.pk/uaf_research/prj_overview.html" target="_blank">Research</a></li>
            <li><a href="Faculty.html">Faculty & Staff</a></li>
            <li><a href="UGFORM.html" style="background-color: rgba(255, 255, 255, 0.2);">UG-Form Submission</a></li>
            <li><a href="contactfom.html">Contact</a></li>
          </ul>
        </nav>
    </header>

        <div class="container">
            <?php
            if ($insert) {
                echo '<div class="success-message">
                    <i class="fas fa-check-circle"></i> 
                    <h3>Form Submitted Successfully!</h3>
                    <p>Your UG Form has been submitted successfully. Please check your email for confirmation.</p>
                </div>';
            }
            ?>


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
                    <a href="mailto:info@uaf.edu.pk" title="Send Email to UAF" target="_blank"><i
                            class="fas fa-envelope"></i></a>
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
</body>
</html>