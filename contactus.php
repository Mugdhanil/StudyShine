<?php
include('./dbConnection.php');
include('./mainInclude/header.php');

$message = ""; // Initialize message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender = $_POST['sender'];
    $mail = $_POST['mail'];
    $messageContent = $_POST['message'];

    // Insert into the database
    $sql = "INSERT INTO contact (name, mail, message) VALUES ('$sender', '$mail', '$messageContent')";
    $result = $conn->query($sql);

    if ($result) {
        $message = "Message sent successfully! Redirecting to the Home Page...";
        echo "<script>
        setTimeout(function(){
            window.location.href = 'index.php';
        }, 3000);
        </script>";
    } else {
        $message = "Message not sent successfully!";
    }
}
?>

<head>
    <style>
        /* Add your CSS styles here */
        /* Keep existing styles that do not interfere with the header */

        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #B9D9EB;
            color: #333;
        }

        #contact {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .contact-box {
            background: #ffffff8f;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 800px;
            width: 100%;
        }

        .contact-box h2 {
            font-family: 'Arimo', sans-serif;
            color: #1f2e43;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }

        .contact-form {
            margin-bottom: 20px;
        }

        .form-item {
            margin-bottom: 20px;
        }

        .form-item label {
            display: block;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .form-item input,
        .form-item textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border-color 0.3s ease;
        }

        .form-item input:focus,
        .form-item textarea:focus {
            border-color: #1f2e43;
            outline: none;
        }

        .submit-btn {
            background-color: #fd917e;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 12px 20px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #ff7050;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
        }

        @media only screen and (max-width: 600px) {
            .contact-box {
                padding: 20px;
            }

            .contact-box h2 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
<br><br><br>
    <section id="contact">
        <div class="contact-box">
            <h2>CONTACT US</h2>
            <form class="contact-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-item">
                    <label for="sender">Name:</label>
                    <input type="text" id="sender" name="sender" required>
                </div>
                <div class="form-item">
                    <label for="mail">Email:</label>
                    <input type="email" id="mail" name="mail" required>
                </div>
                <div class="form-item">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="4" required></textarea>
                </div>
                <button class="submit-btn" type="submit">Send</button>
            </form>
            <div class="message"><?php echo $message; ?></div>
        </div>
    </section>

</body>

<?php
include('./mainInclude/footer.php');
?>