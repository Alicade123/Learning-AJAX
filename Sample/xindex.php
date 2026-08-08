<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX in PHP</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <h2>AJAX in PHP</h2>
    <button id="xfetchData">Fetch User Data</button>
    <div id="result"></div>

    <script>
        $(document).ready(function(){
            $("#xfetchData").click(function(){
                $.ajax({
                    url: "xserver.php", // PHP file to handle request
                    type: "GET",
                    success: function(response){
                        $("#result").html(response); // Show response in div
                    },
                    error: function(){
                        alert("Error fetching data");
                    }
                });
            });
        });
    </script>

</body>
</html>

