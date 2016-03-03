<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }

            .subtitle {
                font-size: 24px;
            }

            .authenticate {
                font-size: 24px;
                display: block;
                padding: 15px;
                color: white;
                font-weight: bold;
                text-decoration: none;
                background: #87e0fd; /* Old browsers */
                background: -moz-linear-gradient(left,  #87e0fd 0%, #53cbf1 44%, #0689db 100%); /* FF3.6-15 */
                background: -webkit-linear-gradient(left,  #87e0fd 0%,#53cbf1 44%,#0689db 100%); /* Chrome10-25,Safari5.1-6 */
                background: linear-gradient(to right,  #87e0fd 0%,#53cbf1 44%,#0689db 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#87e0fd', endColorstr='#0689db',GradientType=1 ); /* IE6-9 */

            }

            .authenticate:hover {
                color: white;
                background: black;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Icebreaker</div>
                <p class="subtitle">Learn more about your leads</p>
                <a class="authenticate" href="/authenticate">Start</i></a>
            </div>
        </div>
    </body>
</html>
