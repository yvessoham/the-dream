
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <style>
@import url(https://db.onlinewebfonts.com/c/f364d16911e2d2639d5fcb6a913d0dc1?family=Fat+Albert+BT+W01+Outline);
@import url(https://db.onlinewebfonts.com/c/5c1df21a40851df1d21f99888c7541f8?family=Londrina+Solid+Black);

        body {
            background-image: url('togod.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            margin: auto;
            
            text-align: center; 

        }
        
        #principal {
            
            margin: auto;
            
            text-align: center; 
        }
        #principal, #resultat {
            display: inline-block;
            width: 48%; /* Ajustez la largeur en fonction de vos besoins */
            vertical-align: top; /* Alignez le contenu en haut */
        }
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        h1{
            font-family: "Fat Albert BT W01 Outline";
            color:  rgb(240, 147, 6);
            -webkit-text-stroke: 1px rgb(240, 147, 6);
            font-size: 75px;
            }
        form {
            font-family: "Londrina Solid Black";
            color: Black;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 50%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            margin: auto;
            display: block;
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
        #result {
            font-family: "Fat Albert BT W01 Outline";
            color:  rgb(240, 147, 6);
            -webkit-text-stroke: 1px red;
            font-size : 35px;   
        }

        #texte {
            font-family: "Londrina Solid Black";
            color: Black;
            font-size: 40px;
            }

    </style>
    <title>Currency Converter</title>
</head>
<body>
<div class="clearfix">
<h1>Welcome to TOGO currency Converter</h1>
    <p id="texte"> Let me guess. You plan to visit our little country, and you want to know the value of your currency here? You're in the right place. Enjoy!</p>

<div id="principal">
    
    <form action="" method="post">
        <label for="amount">Amount:</label>
        <input type="number" name="amount" required>

        <label for="from_currency">Your Currency:</label>
        <select name="from_currency" required>
            <!-- Add options for different currencies -->
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
            <option value="JPY">Japan (JPY)</option>
            <option value="CNY">China (CNY)</option>
            <option value="MAD">Morocco (MAD)</option>
            <option value="GBP">England (GBP)</option>
            <option value="MXN">Mexico (MXN)</option>
            <option value="ARS">Argentina (ARS)</option>
            <!-- Add more currencies as needed -->
        </select>

        <label for="to_currency">TOGO Local Currency:</label>
        <select name="to_currency" required>
            <option value="XOF">FCFA</option>
        </select>

        <button type="submit">Convert</button>

    </form>

    </div>
    <div id="resultat">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $amount = $_POST["amount"];
            $base_currency = $_POST["from_currency"];
            $to_currency = $_POST["to_currency"];

            // Use an external API to get the exchange rate
            $api_key = 'YOUR_RAPIDAPI_KEY';
            $api_url = "https://open.er-api.com/v6/latest/{$base_currency}?apikey={$api_key}";

            $response = file_get_contents($api_url);

            if ($response !== false) {
                $data = json_decode($response, true);

                if ($data && isset($data['rates'][$to_currency])) {
                    $exchange_rate = $data['rates'][$to_currency];
                    $converted_amount = $amount * $exchange_rate;
                    echo "<p id='result'>$amount $base_currency is equal to $converted_amount $to_currency</p>";
                } else {
                    echo "<p>Unable to fetch exchange rate. Please try again later.</p>";
                }
            } else {
                echo "<p>Error fetching exchange rate. Please try again later.</p>";
            }
        }
        ?>
</div>
</div>
</body>
</html>
