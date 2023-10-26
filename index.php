<?php include("database_connect.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Contact Form</title>
</head>

<body>
    <video width="720" height="405" controls autoplay>
        <source src="Top5Cat.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <form action="database_connect.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="userName" placeholder="Jhon Doe" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="JhonDoe@example.com" required>
        <label for="message">Bericht:</label>
        <textarea id="text" name="message" placeholder="Your message here." required></textarea>
        <button type="submit" name="submit" id="submit">Submit</button>
    </form>
    <?php
    // Make sure to include the autoloader if not using Laravel
    require 'vendor/autoload.php';

    use Carbon\Carbon;
    ?>
    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <?php
        // Assuming $startTime is the time you did something
        $startTime = Carbon::parse($row['date']);  // Replace with your actual start time
        // Calculate the difference and format for humans
        $timeDifference = $startTime->diffForHumans();
        ?>
        <div id="comment">
            <img id="profile-picture" src="barney.jpg" alt="L">
            <div id="username">
                <span style="font-weight: normal !important;">@</span><span><?php echo $row['userName']; ?></span>
                <div id="time-ago">
                    <?php echo "$timeDifference"; ?>
                </div>
            </div>
            <div id="message">
                <span><?php echo $row['message']; ?></span>
            </div>
            <div id="like-dislike">
                <button id="like"><i class='bx bx-like bx-sm bx-tada-hover'></i></button>
                <button id="dislike"><i class='bx bx-dislike bx-sm bx-tada-hover'></i></button>
                <div id="reply">
                    <button id="reply-btn">Reply</button>

                    <a id="delete-btn" href="database_connect.php?delete=<?php echo $row['id']; ?>">Delete</a>
                </div>
            </div>
        </div>
    <?php } ?>
</body>

</html>