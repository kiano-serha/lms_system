<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="container" style="height:100%; background:#ED1C24">
        <div style="height:5%"></div>
        <div class="row" style="background: #fff; height:90%; width:92%; margin-left: 4%">
            <div style="width:50%; margin-left:auto; margin-right:auto; text-align: center">
                <img src="images/bow.png" alt="" style="width:40%; padding-top:40px">
            </div>
            <div style="margin:auto; width:50%; text-align:center">
                <h2 style="margin-bottom:0px; padding-bottom:0px; font-size:2.5rem; font-family: sans-serif">CERTIFICATE
                </h2>
                <h3 style="margin-top:0; padding-top:0; font-family:sans-serif">OF COMPLETION</h3>
            </div>
            <div style="width:50%; margin:auto; text-align:center">
                <div class="text-align:center">This certificate is proudly presented to</div>
                <div>
                    <h1 style="font-family:cursive">{{ $name}}</h1>
                    <hr>
                </div>
                For completing the course "{{ $course }}"<br /> intended to increase health literacy of
                hypertension
            </div>
            <div style="text-align:center; margin-top:30px; width:10%; margin-left:auto; margin-right:auto">
                <span>{{ $date }}</span>
                <hr>
                <span>Date</span>
            </div>
        </div>
    </div>
</body>

</html>
