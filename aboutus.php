<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> About Us Page Design </title>
    <link rel="stylesheet" href="css/aboutus.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        

        #chat-container {
            width: 400px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        #chat-box {
            height: 300px;
            overflow-y: scroll;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        #user-input {
            width: calc(100% - 70px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 5px;
        }

        button {
            padding: 8px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <!--================== Header Section Starts from Here ==================-->
    
    
    <!--================== Header Section Ends Here -->


    <!--================== Home Section Starts from Here ==================-->
    <section id="home">
        <div class="home-left">
            <img src="images/abouthead.jpg" alt="">
        </div>
        <div class="home-right">
            <h2 class="home-heading"> Who We Are ?</h2>
            <p class="home-para">Simplilearn is the world’s leading digital skills provider, enabling learners across the globe.
                Our programs and certifications empower learners to achieve their career goals faster.
                Founded in 2010 and based in San Francisco, California, and Bangalore, India, Simplilearn, a Blackstone company is the world’s #1 online Bootcamp for digital economy skills training. Our programs are designed and delivered with world-renowned universities, top corporations, and leading industry bodies via live online classes featuring top industry practitioners,
                sought-after trainers, and global leaders.</p>

        </div>
    </section>
    <!--================== Home Section Ends Here -->

    <!--================== Workflow Section Starts from Here ==================-->
    <section id="workFlow">
        <h2 class="heading"> Grow Up Your Workflow Speed. </h2>
        <p class="para">Lorem ipsum dolor sit amet consectetur adipisicing elit. A, commodi sint. <br>Ipsam molestias
            nemovel laboriosam consequatur, perferendis<br> minima soluta? Natus necessitatibus autem suscipit!</p>
        <div class="num-container">
            <div class="num-item"><span>5,000,000+<br>Careers Advanced</span></div>
            <div class="num-item"><span>400+<br>Courses</span></div>
            <div class="num-item"><span>40+ <br>Global Accreditations</span></div>
        </div>
    </section>
    <!--================== Workflow Section Ends Here -->


    <!--================== Goal Section Starts from Here ==================-->
    <section id="goal">
        <div class="goal-left">
            <h2>Our Goal</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore omnis obcaecati incidunt asperiores,
                mollitia quibusdam velit at itaque sunt, culpa in pariatur quas, temporibus repellendus vitae! Vitae,
                illum asperiores.</p>
            <ul>
                <li> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nulla, atque!</li>
                <li> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nulla, atque!</li>
                <li> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nulla, atque!</li>
            </ul>
            <a href="" class="btn"> Contact Us</a>
        </div>
        <div class="goal-right">
            <img src="./our goal.jpg" alt="">
        </div>
    </section>
    <!--================== Goal Section Ends Here -->

    <!--================== Our Team Section Starts from Here ==================-->
    <section id="our-Team">
        <h2>Our Member</h2>
        <div class="teamContainer">
            <div class="team-item">
                <img src="./teamMember.png" alt="">
                <h5 class="member-name">John Smith</h5>
                <span class="role">seo expert</span>
            </div>
            <div class="team-item">
                <img src="./teamMember.png" alt="">
                <h5 class="member-name">John Smith</h5>
                <span class="role">seo expert</span>
            </div>
            <div class="team-item">
                <img src="./teamMember.png" alt="">
                <h5 class="member-name">John Smith</h5>
                <span class="role">seo expert</span>
            </div>
            <div class="team-item">
                <img src="./teamMember.png" alt="">
                <h5 class="member-name">John Smith</h5>
                <span class="role">seo expert</span>
            </div>
        </div>
    </section>
    <!--================== Our Team Section Ends Here -->

    <!--================== Footer Starts from Here ==================-->
    <footer>
        <p> &copy; 2022 - All rights reserved - geekshelp.in</p>
    </footer>
    <!--================== Footer Ends Here -->
    <div id="chat-container">
        <div id="chat-box"></div>
        <input type="text" id="user-input" placeholder="Type your message...">
        <button onclick="sendMessage()">Send</button>
    </div>

    <script>
        const chatBox = document.getElementById('chat-box');
        const userInput = document.getElementById('user-input');

        function sendMessage() {
            const userMessage = userInput.value.trim();
            if (userMessage === '') return;

            appendMessage('You: ' + userMessage);
            handleResponse(userMessage);
            userInput.value = '';
        }

        function handleResponse(userMessage) {
            // Simple logic to generate a response based on user input
            let response;
            if (userMessage.toLowerCase().includes('hello')) {
                response = 'Hello there!';
            } else if (userMessage.toLowerCase().includes('how are you')) {
                response = 'I\'m just a bot, but thanks for asking!';
            } else {
                response = 'I\'m sorry, I don\'t understand that.';
            }
            setTimeout(() => appendMessage('Bot: ' + response), 500);
        }

        function appendMessage(message) {
            const messageElement = document.createElement('div');
            messageElement.textContent = message;
            chatBox.appendChild(messageElement);
        }
    </script>

</body>
<script src="script.js"></script>

</html>