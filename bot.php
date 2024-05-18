
<?php


include('./mainInclude/header.php');?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Rubik&display=swap');

/* Center body contents, both horizontally and vertically */
body{
  margin: 0;
  padding: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: "Rubik", sans-serif;
  overflow: hidden;
}

/* Style the outer container. Centralize contents, both horizontally and vertically */
#bot {
  margin-top:100px;
  height: 500px;
  width: 400px;
  background: white;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 3px 3px 15px rgba(0, 0, 0, 0.2) ;
  border-radius: 20px;
}

/* Make container slightly rounded. Set height and width to 90 percent of .bots' */
#container {
  height: 90%;
  border-radius: 6px;
  width: 90%;
  background: #F3F4F6;
}

/* Style header section */
#header {
  width: 100%;
  height: auto;
  border-radius: 6px;
  background: #3B82F6;
  color: white;
  text-align: center;
  font-size: 2rem;
  padding-top: 12px;
  box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
}

/* Style body */
#body {
  width: 100%;
  height: 75%;
  background-color: #F3F4F6;
  overflow-y: auto;
}

/* Style container for user messages */
.userSection {
  width: 100%;
}

/* Seperates user message from bot reply */
.seperator {
  width: 100%;
  height: 50px;
}

/* General styling for all messages */
.messages {
  max-width: 60%;
  margin: .5rem;
  font-size: 1.2rem;
  padding: .5rem;
  border-radius: 7px;
}

/* Targeted styling for just user messages */
.user-message {
  margin-top: 1rem;
  text-align: left;
  background: #3B82F6;
  color: white;
  float: left;
}

/* Targeted styling for just bot messages */
.bot-reply {
  text-align: right;
  background: #E5E7EB;
  margin-top: 1rem;
  float: right;
  color: black;
  box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
}

/* Style the input area */
#inputArea {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 10%;
  padding: 1rem;
  background: transparent;
}

/* Style the text input */
#userInput {
  height: 20px;
  width: 80%;
  background-color: white;
  border-radius: 6px;
  padding: 1rem;
  font-size: 1rem;
  border: none;
  outline: none;
  box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
}

/* Style send button */
#send {
  height: 50px;
  padding: .5rem;
  font-size: 1rem;
  text-align: center;
  width: 20%;
  color: white;
  background: #3B82F6;
  cursor: pointer;
  border: none;
  border-radius: 6px;
  box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
}
#closeButton {
      position: absolute;
      top: 120px;
      right: 550px;
      cursor: pointer;
      color: red; /* Changed color to white */
      font-size: 20px;
    }
</style>


<div id="bot">
  <div id="container">
    <div id="header">
       StudyShine Bot
       <span id="closeButton" onclick="closeChatbot()">Close</span> 
    </div>

    <div id="body">
        <!-- This section will be dynamically inserted from JavaScript -->
        <div class="userSection">
          <div class="messages user-message">

          </div>
          <div class="seperator"></div>
        </div>
        <div class="botSection">
          <div class="messages bot-reply">

          </div>
          <div class="seperator"></div>
        </div>                
    </div>

    <div id="inputArea">
      <input type="text" name="messages" id="userInput" placeholder="Please enter your message " required>
      <input type="submit" id="send" value="Send">
    </div>
  </div>
  </div>

  <script type="text/javascript">

document.querySelector("#send").addEventListener("click", async () => {
    let xhr = new XMLHttpRequest();
    var userMessage = document.querySelector("#userInput").value;

    // Debugging: Check if userMessage is captured correctly
    console.log("User Message:", userMessage);

    let userHtml = '<div class="userSection">'+'<div class="messages user-message">'+userMessage+'</div>'+
    '<div class="seperator"></div>'+'</div>';

    document.querySelector('#body').innerHTML+= userHtml;

    xhr.open("POST", "query.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Send the data in the correct format
    xhr.send('messageValue=' + encodeURIComponent(userMessage));

    xhr.onload = function () {
        let botHtml = '<div class="botSection">'+'<div class="messages bot-reply">'+this.responseText+'</div>'+
        '<div class="seperator"></div>'+'</div>';

        document.querySelector('#body').innerHTML+= botHtml;
    }
});


  </script>
  
  <script>
    // Function to close the chatbot
    function closeChatbot() {
      // Hide the bot container
      document.getElementById('bot').style.display = 'none';
      // Redirect to the previous page
      window.history.back();
    }
  </script>
  