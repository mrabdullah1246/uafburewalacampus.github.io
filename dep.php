<?php
$insert = false;
$error_message = '';

if(isset($_POST['name'])){   
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "ug_form";

    $con = mysqli_connect($server,$username,$password,$database);

    if(!$con){
        die("connection failed: " . mysqli_connect_error());
    }

    // Form values
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
    $CourseCode1 = isset($_POST['ccode1']) ? $_POST['ccode1'] : '';
    $CourseName1 = isset($_POST['cname1']) ? $_POST['cname1'] : '';
    $CreditHours1 = isset($_POST['chours1']) ? $_POST['chours1'] : '';
    $CourseCode2 = isset($_POST['ccode2']) ? $_POST['ccode2'] : '';
    $CourseName2 = isset($_POST['cname2']) ? $_POST['cname2'] : '';
    $CreditHours2 = isset($_POST['chours2']) ? $_POST['chours2'] : '';

    // File upload handling for fee voucher
    $FeeVoucher = '';
    if(isset($_FILES['feeVoucher']) && $_FILES['feeVoucher']['error'] == 0){
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        $max_size = 5 * 1024 * 1024; // 5MB
        
        $file_name = $_FILES['feeVoucher']['name'];
        $file_tmp = $_FILES['feeVoucher']['tmp_name'];
        $file_size = $_FILES['feeVoucher']['size'];
        $file_type = $_FILES['feeVoucher']['type'];
        
        // Check file type
        if(in_array($file_type, $allowed_types)){
            // Check file size
            if($file_size <= $max_size){
                // Create uploads directory if not exists
                if(!is_dir('uploads')){
                    mkdir('uploads', 0755, true);
                }
                
                // Generate unique filename
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $new_filename = time() . '_' . uniqid() . '.' . $file_ext;
                $upload_path = 'uploads/' . $new_filename;
                
                // Move uploaded file
                if(move_uploaded_file($file_tmp, $upload_path)){
                    $FeeVoucher = $upload_path;
                } else {
                    $error_message = 'File upload failed. Please try again.';
                }
            } else {
                $error_message = 'File size too large. Maximum 5MB allowed.';
            }
        } else {
            $error_message = 'Invalid file type. Only JPG, PNG, GIF images are allowed.';
        }
    } else {
        $error_message = 'Please upload a fee voucher.';
    }
    
    // Insert into database only if file was uploaded successfully
    if(empty($error_message) && !empty($FeeVoucher)){
        $sql = "INSERT INTO `student_data` (`DOE`, `name`, `email`, `ag`, `FName`, `CNIC`, `phone`, `DOB`, `Address`, `degree`, `Semester`, `Shift`, `Fee Voucher`,`CourseCode1`,`CourseName1`,`CreditHours1`,`CourseCode2`,`CourseName2`,`CreditHours2`) 
                VALUES ('$DOE','$name','$email','$ag','$FName','$CNIC','$phone','$DOB','$Address','$degree','$Semester','$Shift','$FeeVoucher','$CourseCode1','$CourseName1','$CreditHours1','$CourseCode2','$CourseName2','$CreditHours2')";

        
$result = mysqli_query($con, $sql);

        if($result){
            $insert = true;
        } else {
            $error_message = 'Database error: ' . mysqli_error($con);
        }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Your CSS styles remain the same, just adding error message style */
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            border: 2px solid #f5c6cb;
        }
        .error-message i {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #dc3545;
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

    <!-- Main Content -->
    <main>
        <section class="page-title">
            <h1>Undergraduate Form Submission</h1>
            <p>Submit your undergraduate application form for the University of Agriculture Faisalabad</p>
        </section>

        <div class="container">
            <?php
            if ($insert) {
                echo '<div class="success-message">
                    <i class="fas fa-check-circle"></i> 
                    <h3>Form Submitted Successfully!</h3>
                    <p>Your UG Form has been submitted successfully.</p>';
                
                // Show uploaded image if available
                if(!empty($FeeVoucher)){
                    echo '<div class="download-section">
                        <p><strong>Uploaded Fee Voucher:</strong> ' . basename($FeeVoucher) . '</p>
                        <a href="' . $FeeVoucher . '" target="_blank" class="download-btn">
                            <i class="fas fa-eye"></i> View Uploaded Voucher
                        </a>
                    </div>';
                }
                echo '</div>';
            }
            
            if(!empty($error_message) && !$insert){
                echo '<div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> 
                    <h3>Error!</h3>
                    <p>' . $error_message . '</p>
                </div>';
            }
            ?>

            <div class="instructions">
                <h3><i class="fas fa-info-circle"></i> Important Instructions</h3>
                <ul>
                    <li>All fields marked with <span class="required">*</span> are required</li>
                    <li>You can enroll in up to 2 extra courses</li>
                    <li>After submission, you will receive a confirmation and can download your form</li>
                    <li>Ensure all information is accurate before submission</li>
                    <li>Upload a clear scan of your fee voucher (Max: 5MB, Formats: JPG, PNG, GIF)</li>
                </ul>
            </div>

            <div class="form-container">
                <div class="form-header">
                    <h2>Undergraduate Application Form</h2>
                    <p>Please provide your details accurately for the enrollment process</p>
                </div>

                <!-- IMPORTANT: Add enctype="multipart/form-data" for file upload -->
                <form method="POST" action="" enctype="multipart/form-data">
                    <h3 class="section-title">Personal Information</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="dateOfEnrollment">Date of Enrollment <span class="required">*</span></label>
                            <input type="date" id="dateOfEnrollment" class="form-control" name="doe" required>
                        </div>
                        <div class="form-group">
                            <label for="regNumber">Registration Number <span class="required">*</span></label>
                            <input type="text" id="regNumber" class="form-control" placeholder="e.g., 2023-ag-12345" name="ag" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="fullName">Full Name <span class="required">*</span></label>
                            <input type="text" id="fullName" class="form-control" placeholder="Enter your full name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="fatherName">Father's Name <span class="required">*</span></label>
                            <input type="text" id="fatherName" class="form-control" placeholder="Enter father's name" name="fname" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email Address <span class="required">*</span></label>
                            <input type="email" id="email" class="form-control" placeholder="Enter your email address" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="cnic">CNIC/B-Form Number <span class="required">*</span></label>
                            <input type="text" id="cnic" class="form-control" placeholder="XXXXX-XXXXXXX-X" name="cnic" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="contactNumber">Contact Number <span class="required">*</span></label>
                            <input type="tel" id="contactNumber" class="form-control" placeholder="03XX-XXXXXXX" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="dateOfBirth">Date of Birth <span class="required">*</span></label>
                            <input type="date" id="dateOfBirth" class="form-control" name="dob" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Address <span class="required">*</span></label>
                        <textarea id="address" class="form-control" rows="3" placeholder="Enter your complete address" name="Address" required></textarea>
                    </div>

                    <h3 class="section-title">Academic Information</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="degreeName">Degree Name <span class="required">*</span></label>
                            <select id="degreeName" class="form-control" name="degree" required>
                                <option value="">Select Degree</option>
                                <option value="bs-agriculture">BS Agriculture</option>
                                <option value="bs-computer-science">BS Computer Science</option>
                                <option value="bs-information-technology">BS Information Technology</option>
                                <option value="bs-software-engineering">BS Software Engineering</option>
                                <option value="bs-business-administration">BS Business Administration</option>
                                <option value="bs-biotechnology">BS Biotechnology</option>
                                <option value="bs-food-science">BS Food Science & Technology</option>
                                <option value="bs-environmental-sciences">BS Environmental Sciences</option>
                                <option value="bs-animal-sciences">BS Animal Sciences</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="currentSemester">Current Semester <span class="required">*</span></label>
                            <select id="currentSemester" class="form-control" name="semester" required>
                                <option value="">Select Semester</option>
                                <option value="1">1st Semester</option>
                                <option value="2">2nd Semester</option>
                                <option value="3">3rd Semester</option>
                                <option value="4">4th Semester</option>
                                <option value="5">5th Semester</option>
                                <option value="6">6th Semester</option>
                                <option value="7">7th Semester</option>
                                <option value="8">8th Semester</option>
                                <option value="extra">Extra Semester</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="shift">Shift <span class="required">*</span></label>
                        <select id="shift" class="form-control" name="shift" required>
                            <option value="">Select Shift</option>
                            <option value="morning">Morning</option>
                            <option value="evening">Evening</option>
                        </select>
                    </div>

                    <h3 class="section-title">Fee Voucher</h3>

                    <div class="file-upload">
                        <i class="fas fa-file-upload"></i>
                        <h4>Upload Fee Voucher <span class="required">*</span></h4>
                        <p>Supported formats: JPG, PNG, GIF (Max: 5MB)</p>
                        <input type="file" id="feeVoucher" class="file-input" name="feeVoucher" accept=".jpg,.jpeg,.png,.gif" required>
                        <label for="feeVoucher" class="file-label">Choose File</label>
                        <div class="file-name">No file chosen</div>
                    </div>

                    <h3 class="section-title">Extra Enroll Subjects</h3>
                    <p>You can enroll in up to 2 extra courses (optional)</p>

                    <div id="extraCoursesContainer">
                        <!-- Extra Course 1 -->
                        <div class="extra-course">
                            <div class="course-header">
                                <h4>Extra Course 1 (Optional)</h4>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="courseCode1">Course Code</label>
                                    <input type="text" id="courseCode1" name="ccode1" class="form-control" placeholder="e.g., CS-101">
                                </div>
                                <div class="form-group">
                                    <label for="courseName1">Course Name</label>
                                    <input type="text" id="courseName1" name="cname1" class="form-control" placeholder="e.g., Introduction to Programming">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="creditHours1">Credit Hours</label>
                                <input type="number" id="creditHours1" name="chours1" class="form-control" placeholder="e.g., 3" min="1" max="4">
                            </div>
                        </div>
                        
                        <!-- Extra Course 2 -->
                        <div class="extra-course">
                            <div class="course-header">
                                <h4>Extra Course 2 (Optional)</h4>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="courseCode2">Course Code</label>
                                    <input type="text" id="courseCode2" name="ccode2" class="form-control" placeholder="e.g., MATH-101">
                                </div>
                                <div class="form-group">
                                    <label for="courseName2">Course Name</label>
                                    <input type="text" id="courseName2" name="cname2" class="form-control" placeholder="e.g., Calculus I">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="creditHours2">Credit Hours</label>
                                <input type="number" id="creditHours2" name="chours2" class="form-control" placeholder="e.g., 3" min="1" max="4">
                            </div>
                        </div>
                    </div>

                    <div class="form-note">
                        <i class="fas fa-exclamation-circle"></i> By submitting this form, you agree that all information provided is accurate and complete.
                    </div>

                    <button type="submit" class="btn btn-block">Submit Application</button>
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
                    <a href="mailto:info@uaf.edu.pk" title="Send Email to UAF" target="_blank"><i class="fas fa-envelope"></i></a>
                    <a href="https://www.instagram.com/uaf_pakistan" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.youtube.com/@universityofagriculturefai7274" target="_blank"><i class="fab fa-youtube"></i></a>
                    <a href="https://www.linkedin.com/school/university-of-agriculture-faisalabad/posts/?feedView=all" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 University of Agriculture Faisalabad. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        // Simple JavaScript to show selected file name
        document.getElementById('feeVoucher').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
            document.querySelector('.file-name').textContent = fileName;
        });
        
        // Mobile menu toggle
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            document.querySelector('.nav-menu').classList.toggle('active');
        });
    </script>
</body>
</html>