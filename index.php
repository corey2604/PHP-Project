<?php
require 'vendor/autoload.php';
?>

<!doctype html>
<html>

<head>
    <title>Search For Movie</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial;
            width: 900px;
            padding: 10px;
        }
        .search-form-container {
            background: #F0F0F0;
            border: #e0dfdf 1px solid;
            padding: 20px;
            border-radius: 2px;
        }
        .input-row {
            margin-bottom: 20px;
        }
        .input-field {
            width: 100%;
            border-radius: 2px;
            padding: 10px;
            border: #e0dfdf 1px solid;
        }
        .btn-submit {
            padding: 10px 20px;
            background: #333;
            border: #1d1d1d 1px solid;
            color: #f0f0f0;
            font-size: 0.9em;
            width: 100px;
            border-radius: 2px;
            cursor:pointer;
        }
        .videos-data-container {
            background: #F0F0F0;
            border: #e0dfdf 1px solid;
            padding: 20px;
            border-radius: 2px;
        }

        .response {
            padding: 10px;
            margin-top: 10px;
            border-radius: 2px;
        }

        .error {
             background: #fdcdcd;
             border: #ecc0c1 1px solid;
        }

       .success {
            background: #c5f3c3;
            border: #bbe6ba 1px solid;
        }
        .result-heading {
            margin: 20px 0px;
            padding: 20px 10px 5px 0px;
            border-bottom: #e0dfdf 1px solid;
        }
        iframe {
            border: 0px;
        }
        .video-tile {
            display: inline-block;
            margin: 10px 10px 20px 10px;
        }

        .videoDiv {
            width: 250px;
            height: 150px;
            display: inline-block;
        }
        .videoTitle {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        .videoDesc {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }
        .videoInfo {
            width: 250px;
        }
    </style>

</head>

<body>
    <h2>Search For Movie</h2>
    <div class="search-form-container">
        <form id="keywordForm" method="post" action="movieResults.php">
            <div class="input-row">
                Search Keyword : <input class="input-field" type="search" id="keyword" name="keyword" placeholder="Enter Search Keyword"> Maximum number of results : <input class="input-field" type="number" id="max_results" name="max_results" placeholder="If left unspecified the maximum number of results will be 15">
            </div>

            <input class="btn-submit" type="submit" name="submit" value="Search">
        </form>
    </div>

    <?php if(!empty($response)) { ?>
    <div class="response <?php echo $response[" type "]; ?>">
        <?php echo $response["message"]; ?> </div>
    <?php }?>
</body>

</html>
