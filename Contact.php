<html>

<head>
    <meta name="viewport" content="500px">
    <style type="text/css">
    body {
        background-color: #4c09ab;
        font-size: 20px;
        color: white;
    }

    .container {
        margin: 0 auto;
        width: 800px;
        height: 1100px;
        background-color: gray;
        padding: 10px;
        border-radius: 50px 50px 50px 50px;

    }

    h1 {
        border-width: 2px;
        border-color: #e1341e;
        text-align: center;
        font-family: Apple chancery;
        background: blue;
        color: white;
    }

    h5 {
        font-size: 20px;
    }

    input[type=text],
    select,
    textarea {
        width: 60%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
        resize: vertical;
    }

    input[type=submit] {
        background-color: #404caf;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    label {
        width: 100px;
        display: inline-block;
    }

    #sub:hover {
        background-color: #E723B3;
        color: white;
    }
    </style>


</head>


<body>
    <center>
        <div class="container">
            <h1>Contact Form</h1>
            <form method="POST" action="/action_page.php">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="firstname" required placeholder="Your name..">
                <br>


                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lastname" required placeholder="Your last name..">
                <br>
                <label for="Contact">Contact</label>
                <input type="text" id="lname" name="Contact" required placeholder="Your contact..">

                <br>
                <label for="email">Email Address</label>
                <input type="text" id="lname" name="Email Address" required placeholder="Your email address..">
                <br>

                <label for="parish">Parish</label>
                <select id="Parish" name="Parish">
                    <option value="kingston">Kingston</option>
                    <option value="St.Andrew">St.Andrew</option>
                    <option value="St.catherine">St.Catherine</option>
                    <option value="St.Thomas">St.Thomas</option>
                    <option value="St.Mary">St.Mary</option>
                    <option value="Portland">Portland</option>
                    <option value="St.Ann">St.Ann</option>
                    <option value="Clarendon">Clarenddon</option>
                    <option value="Manchester">Manchester</option>
                    <option value="St.Elizabeth">St.Elizabeth</option>
                    <option value="Westmoreland">Westmoreland</option>
                    <option value="Hanover">Hanover</option>
                    <option value="St.James">St.James</option>
                    <option value="Savalamar">Savlamar</option>
                </select>

                <br>

                <label for="promos"> Send weekly promotions</label><br>
                <input type="checkbox" id="promos" name="promos_box" value="promos">


                <p> <label for="comment">Comment</label></p>
                <textarea id="subject" name="subject" required placeholder="Write something.."
                    style="height:100px"></textarea>
                <br>

                <input type="submit" value="Submit" id="sub">
            </form>
        </div>
    </center>


</body>

</html>