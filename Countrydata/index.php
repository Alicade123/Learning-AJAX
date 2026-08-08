<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>abiturije1alicade@gmail.com</title>
    
    <!-- Include jQuery from CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <link href="styles.css" rel="stylesheet">
    <style>
       body {
    font-family: Arial, sans-serif;
    background-color:rgb(61, 55, 55);
    margin: 0;
    padding: 20px;
    font-size: 12px;
    font-family: arial, sans-serif;
}
.top-header{
    height: 50px;
    /* background-color:rgba(178, 175, 176, 0.47); */
    width:40%;
    color: grey;
    margin-bottom: 20px;
    border-radius: 7px;
    margin: 0 auto;
    font-weight: 700;
    font-size : 20px;
    text-align: center;
    font-family: arial, sans-serif;
}
span{
    font-weight: 700;
    text-align:center;
    text-decoration:underline;
}
h2 {
    margin-top: 5px;
    text-align: center;
    color:grey;
}

form {
    max-width: 600px;
    margin: 5px auto 5px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    /* background-color: rgb(228, 224, 224) */
}

label {
    display: block;
    margin-bottom: 8px;
    font-size: 16px;
}

select {
    width: 100%;
    padding: 8px;
    margin-bottom: 8px;
    font-size: 16px;
    border-radius: 4px;
    border: 1px solid #ddd;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

.hierarchy-item {
    margin-bottom: 10px;
}

#yourAddress {
    margin-top: 10px;
    padding: 6px 10px;
    background-color:rgb(205, 90, 33);
    color: black;
    border: none;
    cursor: pointer;
    font-size: 16px;
    border-radius: 7px;
}

#addressDisplay {
    width: 95%;
    padding: 10px;
    margin-top: 10px;
    background:rgba(128, 134, 140, 0.28);
    border: 1px solid #ddd;
    font-size: 16px;
    font-family : "Times New Roman", Sans-serif;
    /* width: fit-content; */
    border-radius: 7px;
}

button {
    border-radius: 7px;
    margin-left: 40%;
}
    </style>
</head>
<body>
    <?php 
    // include('db.php');
    ?>
    <div class= "top-header"> 
    <h1>
        The AJAX Implementation
</h1>
</div>
    <h2>Choose your Address</h2>

    <form id="registrationForm">
        <div id="hierarchyWrapper">
            <!-- Dropdowns will be dynamically added here -->
        </div>

        <!-- Your Address Button -->
        <button type="button" id="yourAddress">Your Address</button>

        <!-- Display Address Here -->
        <div id="addressDisplay" style="display: none;">
            <span>Your Address:</span>
            <p id="selectedAddress"></p>
        </div>
    </form>

    <script>
    $(document).ready(function () {
        loadHierarchy('province', 0); // Load Provinces (top level)

        // Handle the "Your Address" button click
        $('#yourAddress').click(function () {
            let levels = ['province', 'district', 'sector', 'cell', 'village'];
            let selectedAddress = [];

            // Loop through each dropdown and get selected text
            levels.forEach(level => {
                let selectedText = $('#' + level + ' option:selected').text();
                if (selectedText && selectedText !== `Select ${level.charAt(0).toUpperCase() + level.slice(1)}`) {
                    selectedAddress.push(selectedText);
                }
            });

            if (selectedAddress.length ===5) {
                $('#selectedAddress').html(selectedAddress.join(' >> ')); // Format output
                $('#addressDisplay').show(); // Show address display div
            } else {
                alert('Please select all required fields before proceeding.');
            }
        });
    });

    // Load hierarchy levels
    function loadHierarchy(level, parentId) {
        $.ajax({
            url: 'fetch_hierarchy.php',
            type: 'POST',
            data: { parentId: parentId },
            success: function(data) {
                const items = JSON.parse(data);
                if (items.length > 0) {
                    let label = '';
                    switch (level) {
                        case 'province': label = 'Province'; break;
                        case 'district': label = 'District'; break;
                        case 'sector': label = 'Sector'; break;
                        case 'cell': label = 'Cell'; break;
                        case 'village': label = 'Village'; break;
                    }

                    let dropdownHtml = `<div class="hierarchy-item">
                        <label for="${level}">${label}:</label>
                        <select name="${level}" id="${level}" onchange="loadNextLevel('${level}', this.value)">
                            <option value="">Select ${label}</option>`;

                    items.forEach(item => {
                        dropdownHtml += `<option value="${item.countryHierachyId}">${item.hierachyName}</option>`;
                    });

                    dropdownHtml += '</select></div>';

                    $('#hierarchyWrapper').append(dropdownHtml);
                }
            }
        });
    }

    // Load the next hierarchy level
    function loadNextLevel(currentLevel, selectedId) {
        // Remove all lower levels before adding new ones
        const levels = ['province', 'district', 'sector', 'cell', 'village'];
        let index = levels.indexOf(currentLevel);
        if (index !== -1) {
            for (let i = index + 1; i < levels.length; i++) {
                $('#' + levels[i]).parent().remove();
            }
        }

        // Determine the next level to load
        let nextLevel = levels[index + 1];
        if (nextLevel) {
            loadHierarchy(nextLevel, selectedId);
        }
    }
    </script>
<footer>
    <article style="text-align:center; position : overflow; color: grey; font-family:sans-serif, arial; font-size: 14px">
    abiturije1alicade@gmail.com
</article>
</footer>
</body>
</html>
