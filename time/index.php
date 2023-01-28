<!DOCTYPE html>
<html lang="en">

<head>
    <script src="../js/jquery.js"></script>
    <title>Clock</title>
    <style>
    @font-face {
        font-family: clock;
        src: url(digital-7/digital-7.ttf);
    }

    #time {
        width: 25%;
        float: right;
        margin: 0 auto;
        font-family: clock;
        font-size: 3rem;
    }
    </style>
</head>

<body>
    <div id="time">
        00 : 00 : 00 PM
    </div>
    <script>
    $(document).ready(function() {
        setInterval(function() {
            $('#time').load('time.php');
        }, 1000);
    });
    </script>
</body>

</html>