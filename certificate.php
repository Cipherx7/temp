<?php

$name = "INVALID DETAILS";
// Database connection details
$host = "localhost";
$username = "root";
$password = "";
$dbname = "participate";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
// $conn = new mysqli('localhost', 'root', '', "ecell");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user input
function sanitizeInput($input)
{
    return htmlspecialchars(stripslashes(trim($input)));
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Sanitize user inputs
    $email = sanitizeInput($_GET["email"]);
    $phone = 99;

    // SQL query to check if the provided email and phone exist in the database
    $sql = "SELECT * FROM participants WHERE  email = '$email'";
    // echo $sql;  
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Data found in the database, show the pass
        $row = $result->fetch_assoc();
        $name = $row["name"]; // Assuming there is a 'name' column in the table
        $cid = $row["id"]; //

    } else {
        // Data not found in the database
        echo "No matching data found in the database.";
        echo '<script>alert("Please contact the Organizer - ");
        
       
        </script>';
        // header("location: ");

    }

    // Close the database connection
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberX Certificate Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --cyber-yellow: #FFD700; /* Yellow */
            --dark-bg: #121212; /* Dark background */
            --card-bg: #1E1E1E; /* Card background */
            --border-color: #FFD700; /* Yellow for borders */
            --shadow-color: rgba(0, 0, 0, 0.2); /* Shadow color */
        }

        body {
            font-family: 'JetBrains Mono', monospace;
            background: var(--dark-bg);
            color: var(--cyber-yellow);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1; /* This allows the container to grow and fill the available space */
            padding: 2rem;
        }

        .cyber-border {
            border: 1px solid var(--border-color);
            position: relative;
            box-shadow: 0 4px 20px var(--shadow-color);
            background: var(--card-bg);
            border-radius: 8px;
            padding: 2rem;
        }

        .btn-cyber {
            background: transparent;
            border: 2px solid var(--cyber-yellow);
            color: var(--cyber-yellow);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 0.5rem 1rem;
            border-radius: 4px;
        }

        .btn-cyber:hover {
            background: var(--cyber-yellow);
            color: var(--dark-bg);
            box-shadow: 0 0 20px var(--cyber-yellow);
        }

        .glow-text {
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.7); /* Yellow glow */
        }

        .certificate-container {
            background: rgba(30, 30, 30, 0.9);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 8px;
        }

        .hacker-font {
            font-family: 'JetBrains Mono', monospace;
            letter-spacing: 2px;
        }

        footer {
            background: var(--dark-bg);
            color: var(--cyber-yellow);
            padding: 1rem 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="certificate-container cyber-border">
            <img src="https://erp.metbhujbalknowledgecity.ac.in/oams/Images/MyErp.png" 
                 class="img-fluid mb-4" 
                 style="filter: invert(1) hue-rotate(180deg);"
                 alt="CyberX Logo">

            <h1 class="text-center mb-4 glow-text hacker-font">>> CYBERX CTF 2024 CERTIFICATE <<</h1>

            <div id="chipa" class="mb-5">
                <div class="alert alert-dark hacker-font">
                    PARTICIPANT ID: <span id="cid">METWEB1200<?php echo $cid; ?></span>
                </div>
                <h3 class="glow-text mb-4">CURRENT USER:</h3>
                <div class="cyber-border p-3 mb-4">
                    <p class="h2 hacker-font" id="nameInput"><?php echo $name; ?></p>
                </div>
                <button class="btn btn-cyber btn-lg w-100" onclick="generateCertificate()">
                    [ GENERATE CERTIFICATE ]
                </button>
            </div>

            <div id="certificateContainer" class="text-center"></div>
            
            <div class="mt-4" id="downloadSection" style="display: none;">
                <a id="downloadButton" class="btn btn-cyber me-2" download="certificate.png">
                    [ DOWNLOAD ]
                </a>
                <a id="shareOnLinkedIn" class="btn btn-cyber" target="_blank">
                    [ SHARE ON LINKEDIN ]
                </a>
            </div>
        </div>
    </div>

    <footer class="text-center">
        <div class="cyber-border p-3">
            <p class="mb-1 hacker-font">TECH SUPPORT: <a href="https://wa.me/918380066588" class="text-decoration-none text-warning">+91 83800 66588</a></p>
            <p class="mb-0 hacker-font">© 2024 CYBERX CTF | ALL RIGHTS RESERVED</p>
        </div>
    </footer>

    <script>
        // Updated generateCertificate function with yellow and black theme
        function generateCertificate() {
    const name = document.getElementById('nameInput').innerText;
    if (!name.trim()) {
        alert('[ERROR] INVALID USER IDENTITY');
        return;
    }

    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    const templateImage = new Image();
    
    templateImage.onload = function() {
        canvas.width = templateImage.width;
        canvas.height = templateImage.height;
        ctx.drawImage(templateImage, 0, 0);
        
        // Set font properties
        ctx.fillStyle = '#f6b612'; // Yellow color
        ctx.font = '62px "JetBrains Mono"'; // Font size and family
        ctx.textAlign = 'center'; // Center the text horizontally
        
        // Change these values to adjust the position
        const x = canvas.width / 2; // Center horizontally
        const y = canvas.height / 2.04; // Adjust this value to move vertically
        
        ctx.fillText(name.toUpperCase(), x, y); // Draw the text
        
        const certificateDataURL = canvas.toDataURL('image/png');
        document.getElementById('downloadSection').style.display = 'block';
        document.getElementById('downloadButton').href = certificateDataURL;
        
        // LinkedIn share URL
        const linkedInUrl = `https://www.linkedin.com/profile/add?startTask=CYBERX_CTF_24&name=${encodeURIComponent(name)}&certId=${document.getElementById('cid').innerText}`;
        document.getElementById('shareOnLinkedIn').href = linkedInUrl;
    };

    templateImage.src = 'certificate_t.png';
}
    </script>
</body>
</html>