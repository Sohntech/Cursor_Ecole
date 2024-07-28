<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: #000;
            color: #fff;
            font-family: 'Roboto', sans-serif;
            overflow: hidden;
        }

        .stars, .twinkling, .clouds {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: block;
            overflow: hidden;
            z-index: -1;
        }

        .stars {
            background: url('https://www.script-tutorials.com/demos/360/images/stars.png') repeat top center;
            z-index: 0;
            animation: stars 100s linear infinite;
        }

        .clouds {
            background: url('https://www.script-tutorials.com/demos/360/images/clouds3.png') repeat top center;
            z-index: 2;
            animation: clouds 300s linear infinite;
        }

        @keyframes stars {
            0% { background-position: 0 0; }
            100% { background-position: -10000px 5000px; }
        }

        @keyframes twinkling {
            0% { background-position: -1000px 0; }
            100% { background-position: 10000px 5000px; }
        }

        @keyframes clouds {
            0% { background-position: 0 0; }
            100% { background-position: 10000px 0; }
        }

        .comet {
            position: absolute;
            top: -50px;
            left: -50px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(45deg, #fff, transparent);
            box-shadow: 0 0 50px #fff;
            animation: comet 5s linear infinite;
        }

        @keyframes comet {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(800px, 800px) rotate(360deg); }
        }

        .rocket {
            position: absolute;
            bottom: 50px;
            right: 50px;
            width: 50px;
            height: 100px;
            background: url('https://image.flaticon.com/icons/svg/2720/2720541.svg') no-repeat center center;
            background-size: contain;
            animation: rocket 3s infinite ease-in-out;
        }

        @keyframes rocket {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .planet {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgba(255,255,255,0) 70%);
            box-shadow: 0 0 100px rgba(255, 255, 255, 0.3);
            animation: planet 10s infinite linear;
        }

        @keyframes planet {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .text-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 3;
        }

        .text-container h1 {
            font-size: 5rem;
            margin-bottom: 1rem;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .text-container p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        .text-container a {
            display: inline-block;
            padding: 1rem 2rem;
            border: 2px solid #fff;
            border-radius: 9999px;
            font-size: 1rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #fff;
            text-decoration: none;
            background: linear-gradient(90deg, #ff8a00, #e52e71);
            background-size: 200% auto;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease-in-out;
        }

        .text-container a:hover {
            background-position: right center;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="stars"></div>
    <div class="twinkling"></div>
    <div class="clouds"></div>
    <div class="comet"></div>
    <div class="rocket"></div>
    <div class="planet"></div>
    <div class="text-container">
        <h1>404</h1>
        <p>Oops! Page not found.</p>
        <a href="/">Back to Home</a>
    </div>
</body>
</html>
