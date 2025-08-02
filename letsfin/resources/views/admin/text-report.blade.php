<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <!--<link href="https://fonts.googleapis.com/css2?family=Noto%20Sans" />-->
    <style>
        @font-face {
            font-family: 'Noto Sans Devanagari';
            src: url("{!! public_path('front/Noto_Sans_Devanagari/static/NotoSansDevanagari-Regular.ttf') !!}") format('truetype');
        }
        @font-face {
            font-family: 'Noto Sans Devanagari';
            src: url("{!! public_path('front/Noto_Sans_Devanagari/static/NotoSansDevanagari-Bold.ttf') !!}") format('truetype');
            font-weight: bold;
        }
        @font-face {
            font-family: 'Noto Serif Devanagari';
            src: url("{!! public_path('front/Noto_Serif_Devanagari/static/NotoSerifDevanagari-Regular.ttf') !!}") format('truetype');
        }
        @font-face {
            font-family: 'Noto Serif Devanagari';
            src: url("{!! public_path('front/Noto_Serif_Devanagari/static/NotoSerifDevanagari-Bold.ttf') !!}") format('truetype');
            font-weight: bold;
        }


        @page {
            margin-top: 45px;
            /*create space for header */
            margin-bottom: 70px;
            /* create space for footer */
        }

        header,
        footer {
            position: fixed;
            left: 0px;
            right: 0px;
        }

        header {
            height: 100px;
            margin-top: -25px;
        }

        footer {
            height: 50px;
            margin-bottom: -50px;
            bottom: 0px;
        }

        main {
            font-family: 'Noto Serif Devanagari', sans-serif;
        }

    </style>
</head>

<body>
    <main>
        {!! $report_content !!}
    </main>
</body>

</html>