<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>

<body>
    <p style="  align-items: center;
    font-size: 30px;
    margin-left: 700px;
    margin-top: 50px;">Log in</p>
    <form>
        <input id="mail-name" type="text" name="fullname" placeholder="Full name">
        </br>
        <input id="mail-password" type="password" name="password" placeholder="Password">
        </br>
        <button type="submit" id="mail-submit" name="submit">Enter</button>
        <p class="form-message"></p>
        <a href="../index.php">Go back to website</a>
    </form>
</body>

<script>
    $(document).ready(function() {
        $('form').submit(function(event) {
            event.preventDefault();
            var name = $("#mail-name").val();
            var password = $("#mail-password").val();
            var submit = $("#mail-submit").val();
            $(".form-message").load("mail.php ", {
                name: name,
                password: password,
                submit: submit
            });
        });
    });
</script>

</html>