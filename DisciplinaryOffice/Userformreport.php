<?php
session_start();

// Check if the session variables are set
if (isset($_SESSION['user_name'], $_SESSION['course_name'], $_SESSION['user_id'])) {
    // Retrieve the session variables
    $user_name = $_SESSION['user_name'];
    $course_name = $_SESSION['course_name'];
    $user_id = $_SESSION['user_id'];
} else {
    // Session variables not set, handle the situation accordingly
    // For example, redirect back to the login page
    header("Location:/DisciplinaryOffice/Login.php");
    exit();
}
if (isset($_GET['logout'])) {
    // Destroy the session
    session_destroy();

    // Redirect back to the login page
    header("Location: /DisciplinaryOffice/Login.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylesheet/styles.css">
    <title>Dashboard</title>

<style>
.notif-bell {
  position: relative;
  display: inline-block;
  margin-left: 10px;
  cursor: pointer;
}

.badge {
  position: absolute;
  top: -8px;
  right: -8px;
  background-color: red;
  color: white;
  border-radius: 50%;
  padding: 4px 8px;
  font-size: 8px;
  cursor: pointer;
}

.dropdown {
    display: none;
    position: absolute;
    background: white;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    z-index: 1000;
    cursor: pointer;
}

.dropdown.show {
    display: block;
    cursor: pointer;
}

   /* Modal Styles */
    /* Styles for the pop-up modal */
    .notification-panel {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fefefe;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
    }

    .message-container {
        text-align: center;
    }

    .text-profile {
        text-align: left;
        margin: 0;
        margin-right: 14px;
    }

</style>
</head>
<body>

<!--- Side Bar Upper Part-->
<div class="sidenav">
<div class="notif-bell">
        <i style="font-size: 18px; color: yellow;" class="fa">&#xf0f3;</i>
        <span class="badge">0</span>
    </div>
    <div id="notifpanel" class="notification-panel">
        <div class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modal-body">
                    <!-- Display messages here -->
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="outside-container">
    <div class="profile-container">
    </div>
            <div class="text-profile">
                <p>
                    <span>Name: &nbsp; <?php echo $user_name; ?></span><br>
                    <span>Course: &nbsp; <?php echo $course_name; ?></span><br>
                    <span>Student ID: &nbsp; <?php echo $user_id; ?></span>
                </p>
            </div>
        </div>
        <hr>
        <div id="" class="status-container"><a href="/DisciplinaryOffice/Userdashboard.php"><i style="font-size:24px; color:white;" class="fa">&#xf0e4;</i>&nbsp;Dashboard</a></div>
        <div id="" class="status-container"><a href="/DisciplinaryOffice/Userstatus.php"><i style="font-size:24px" class="fa">&#xf2bb;</i>&nbsp;Status</a></div>
        <div id="" class="make-report-container"><a href="/DisciplinaryOffice/Userformreport.php"><i style="font-size:24px" class="fa">&#xf044;</i>&nbsp;Make Report</a></div>
        <div id="" class="report-status-conatiner"><a href="/DisciplinaryOffice/Userreportstatus.php"><i style="font-size:24px" class="fa">&#xf24a;</i>&nbsp;History Report</a></div>
        <div class="logout"><a href="?logout=true"><i style="font-size:24px" class="fa">&#xf011;</i>&nbsp;Log out</a></div>

        <div class="logo-container">
            <div><img class="logo-size" src="/DisciplinaryOffice/logo/STI_LOGO.ico"></div>
        </div>
        <div class="STI-text">
            <div>
                <p style="color: white; opacity: 0.5;">STI Global City Taguig<br> Disciplinary Office</p>
                <div style="background-color: black; height: 200px;">
                    <div class="privacy-link"><a style="font-size: 11px; display: inline-block;" href="/DO/stylesheet/Privacy-Policy.php">Privacy Policy | </a></div>
                    <div class="report-link"><a style="font-size: 11px; display: inline-block;" href="/DO/stylesheet/Report-Abuse.php">Report Abuse |</a></div>
                    <div class="terms-link"><a style="font-size: 11px; display: inline-block;" href="/DO/stylesheet/Terms-of-Service.php">Terms of Service</a></div>
                    <div>
                        <address class="address-school">
                            STI Academic Center,<br> University Parkway Drive,<br>
                            Taguig, Metro Manila
                        </address>
                        <p class="phone-number">
                            &#x2706; Phone: (02) 8551 4984
                        </p>
                        <p>

                            <a style="color: white; font-size: 11px;" href="https://www.facebook.com/globalcity.sti.edu/">Official Facebook Page</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div style="margin-left: 600px; margin-top: 50px; width: 500px;">
        <h4>Please fill out the form below
        </h4>
        <div>
            <p></p>
        </div>
        <div>
            <p></p>
        </div>
        <div>
            <p></p>
        </div>
        <div>
            <p></p>
        </div>
        <div class="text-area-container">
<form action="inserting.php" method="post" enctype="multipart/form-data">
  <fieldset>
    <legend>Disciplinary Office Form</legend>
    <a style="color: black;" href="#" id="linkToIndex">Facial Recognition</a>
    <br>
    <p>Name of the person being complained about</p>
    <label>Full name</label>
    <input class="full-name" type="text" name="name" id="name" placeholder="Full name (Optional)">

    <br>
    <label>Choose Offense *</label>
    <div style="display: block">
      <select class="offense" id="offense_type" name="offense_type" required>
        <option value="Minor Offense">Minor Offense</option>
        <option value="Major Offense - Category A">Major Offense - Category A</option>
        <option value="Major Offense - Category B">Major Offense - Category B</option>
        <option value="Major Offense - Category C">Major Offense - Category C</option>
        <option value="Major Offense - Category D">Major Offense - Category D</option>
      </select>
    </div>

    <br>
    <select class="violations" id="violation_type" name="violation_type" disabled>
      <option value="">Violations</option>
    </select>

    <textarea class="text-area" id="report_details" name="report_details" placeholder="Enter your message..."></textarea>
    <input class="Choose-file" type="file" id="file_type" name="file_type" multiple>
    <button class="btn" type="submit">Submit</button>
  </fieldset>
</form>
</div>

<script>
    document.getElementById('linkToIndex').addEventListener('click', function(event) {
      event.preventDefault(); // Prevent the default behavior of the link

      // Open the local file (index.html)
      window.open('http://localhost:8080/DisciplinaryOffice/Face-Recognition-JavaScript-master/', '_blank');

      // Open the live server (127.0.0.1:5500)
      window.open('http://127.0.0.1:5500/index.html', '_blank');
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
        $(document).ready(function () {
            $('#uploadButton').on('click', function () {
                var form_data = new FormData($('#uploadForm')[0]);
                $.ajax({
                    type: 'POST',
                    url: '/',
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        $('#resultImage').attr('src', 'data:image/jpeg;base64,' + response);
                    }
                });
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
        function updateNotification() {
            fetch('fetchReply.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Received data:', data); // Check if data is received properly

                    const badge = document.querySelector('.badge');
                    const messageContainer = document.querySelector('.modal-body');

                    badge.textContent = data.messageCount;

                    messageContainer.innerHTML = ''; // Clear previous messages

                    data.messages.forEach(message => {
                        // Create a container for each message
                        const messageDiv = document.createElement('div');
                        messageDiv.style.display = 'flex'; // Use flexbox for layout
                        messageDiv.style.flexDirection = 'column'; // Arrange items vertically

                        // Create paragraph for schedule details and date
                        const messageParagraph = document.createElement('p');
                        messageParagraph.innerHTML = `Schedule Details: ${message.sched_details}<br>Date: ${message.date_sched}`;

                        // Create a container for buttons
                        const buttonsContainer = document.createElement('div');
                        buttonsContainer.style.display = 'flex'; // Use flexbox for layout
                        buttonsContainer.style.justifyContent = 'space-between'; // Space buttons evenly

                        // Create a "View" button
                        const viewButton = document.createElement('button');
                        viewButton.textContent = 'View';
                        viewButton.className = 'view-btn';
                        viewButton.style.backgroundColor = '#01579B';
                        viewButton.style.color = 'white';
                        viewButton.style.borderRadius = '4px';
                        viewButton.style.border = 'none';
                        viewButton.style.padding = '5px 10px';
                        viewButton.style.cursor = 'pointer';

                        viewButton.addEventListener('click', function() {
                            console.log('View button clicked for message:', message);
                            // Your functionality for the "View" button goes here
                        });

                        // Append buttons to the buttons container
                        buttonsContainer.appendChild(viewButton);

                        // Append elements to the message container
                        messageDiv.appendChild(messageParagraph);
                        messageDiv.appendChild(buttonsContainer);

                        // Append the container to the message container
                        messageContainer.appendChild(messageDiv);
                    });
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        const notifBell = document.querySelector('.notif-bell');
        const notif = document.getElementById('notifpanel');
        const closeButton = document.querySelector('.close');
        notifBell.addEventListener('click', function() {
            const notificationPanel = document.querySelector('.notification-panel');
            if (notificationPanel.style.display === 'none') {
                notificationPanel.style.display = 'block';
                updateNotification();
            } else {
                notificationPanel.style.display = 'none';
            }
        });
        closeButton.addEventListener('click', function() {
            notif.style.display = 'none';
        });

        // Initially update notification when the page loads
        updateNotification();
    });
</script>


<script>
  var offenseSelect = document.getElementById('offense_type');
  var violationsSelect = document.getElementById('violation_type');
  var violationsOptions = violationsSelect.options;

  // Function to update the violations based on the selected offense
  offenseSelect.addEventListener('change', function() {
    var selectedOption = this.value;

    if (selectedOption === 'Minor Offense') {
      violationsOptions.length = 0; // Clear existing options
      violationsOptions.add(new Option('Non-adherence to the "STI Student Decorum"'));
      violationsOptions.add(new Option('Discourtesy towards any member of the STI community including campus visitors'));
      violationsOptions.add(new Option('Lending/borrowing school ID, wearing, or using tampered ID'));
      violationsOptions.add(new Option('Non-wearing of school uniform, improper use of school uniform, and/or ID inside school premises'));
      violationsOptions.add(new Option('Wearing of inappropriate campus attire'));
      violationsOptions.add(new Option("Losing or forgetting one's ID three (3) times"));
      violationsOptions.add(new Option('Disrespect to national symbols or any other similar infraction'));
      violationsOptions.add(new Option('Irresponsible use of school property'));
      violationsOptions.add(new Option('Gambling in any form within the school premises or during official functions'));
      violationsOptions.add(new Option('Disruption of classes, school-sanctioned activities, and peace and order.'));
      violationsOptions.add(new Option('Exhibiting displays of affection that negatively affect the reputation of the individuals'));
      violationsOptions.add(new Option('Violation of classroom, laboratory, library, and other school offices procedure'));
      violationsOptions.add(new Option('Smoking inside the campus'));
      violationsOptions.add(new Option('Allowing a non-STI student to enter the campus unauthorized'));
      violationsOptions.add(new Option('Bringing of pets in the school premises'));

    } else if (selectedOption === 'Major Offense - Category A') {
        violationsOptions.length = 0; // Clear existing options
        violationsOptions.add(new Option('Entering the campus in a state of intoxication, bringing, and/or drinking liquor inside the campus'));
        violationsOptions.add(new Option('Cheating'));
        violationsOptions.add(new Option('Plagiarism'));
        violationsOptions.add(new Option('Communicating with another student or person in any form during an examination'));
        violationsOptions.add(new Option('Having somebody else take an examination or test for oneself or prepare a required report or assignment.'));
        violationsOptions.add(new Option('Leaking of examination questions or answer keys to another student/s in any form'));

    } else if (selectedOption === 'Major Offense - Category B') {
        violationsOptions.length = 0; //Clear existing options
        violationsOptions.add(new Option('Vandalism/Destruction of property belonging to any member of the STI community.'));
        violationsOptions.add(new Option('Posting and/or uploading of statements, photos, other graphical images and/or videos disrespectful to the STI Brand.'));
        violationsOptions.add(new Option('Frequent places of ill repute wearing the school uniform.'));
        violationsOptions.add(new Option('Issuing a false testimony during official investigations.'));
        violationsOptions.add(new Option('Use of profane language that expresses grave insult toward any member of the STI community.'));

    } else if (selectedOption === 'Major Offense - Category C') {
        violationsOptions.length = 0; //Clear existing options
        violationsOptions.add(new Option('significant injury to the individual and/or other persons'));
        violationsOptions.add(new Option('endangering the safety and welfare of the individual and other persons.'));
        violationsOptions.add(new Option('degrading of the integrity of the person, school, and/or the institution.'));
        violationsOptions.add(new Option('"Hacking" attacks on the computer system of the school and/or other institutions.'));
        violationsOptions.add(new Option('Theft or robbery of school property or those belonging to school officials.'));
        violationsOptions.add(new Option('Unauthorized, copying, distribution, modification, and/or exhibition - in whole or in part - of eLMS materials.'));
        violationsOptions.add(new Option('use of the materials for any commercial purpose, or for any public display.'));
        violationsOptions.add(new Option('attempt to decompile or reverse engineer any software contained on the eLMS.'));
        violationsOptions.add(new Option('remove any copyright or other proprietary notations from the materials.'));
        violationsOptions.add(new Option('transfer the materials to another person or "mirror" the materials on any other server or sites.'));
        violationsOptions.add(new Option('Embezzlement and malversation of school or organization funds or property.'));
        violationsOptions.add(new Option('Disruption of academic functions or school activities through illegal assemblies.'));
        violationsOptions.add(new Option('Any act of Immorality.'));
        violationsOptions.add(new Option('Participation in brawls or infliction of physical injuries within and/or outside school premises.'));
        violationsOptions.add(new Option('Physical assault upon another within and/or outside the school premises whether in school uniform or not.'));
        violationsOptions.add(new Option('Use of prohibited drugs or chemicals in any form within and outside the school premises whether in uniform or not.'));
        violationsOptions.add(new Option('Giving false or malicious fire alarms and bomb threats.'));
        violationsOptions.add(new Option('Use of fire protective or fire fighting equipment of the school other than for fire fighting.'));


    } else if (selectedOption === 'Major Offense - Category D') {
        violationsOptions.length = 0; //Clear existing options
        violationsOptions.add(new Option('Possession or sale of prohibited drugs or chemicals.'));
        violationsOptions.add(new Option('Continued use and being found to be "confirmed positive" of using prohibited drugs or chemicals.'));
        violationsOptions.add(new Option('Carrying or possession of firearms, deadly weapons, and explosives within and outside the school premises.'));
        violationsOptions.add(new Option('Membership and/or affiliations in organizations, such as but not limited to fraternities and sororities.'));
        violationsOptions.add(new Option('Participation in illegal rites, ceremonies, and ordeals which includes hazing and initiation.'));
        violationsOptions.add(new Option('Commission of crime involving moral turpitude.'));
        violationsOptions.add(new Option('Commission of acts constituting sexual harassment as defined in the Student Manual and Republic Act 7877.'));
        violationsOptions.add(new Option('Acts of subversion, sedition, or insurgency.'));



    } else {
        violationsOptions.length = 0; // Clear existing options
        violationsOptions.add(new Option('No violations'));
    }

    violationsSelect.disabled = (selectedOption === '');
    });
</script>
</body>

</html>