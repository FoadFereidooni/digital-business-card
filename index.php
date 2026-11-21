<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Creat Business Card</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="form-container">
            <h1>Create Your Digital Business Card</h1>
            <form id="infoForm" method="post" action="process.php" enctype="multipart/form-data">
                <div class="form-field">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" placeholder="Please Enter Your Name" required>
                </div>

                <div class="form-field">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Please Enter Your Email" required>
                </div>

                <div class="form-field">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" placeholder="Please Enter Your Number" required>
                </div>

                <div class="form-field">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" placeholder="Please Enter Your Address" required>
                </div>

                <div class="form-field">
                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image" required>
                </div>

                <input type="submit" value="Create Card">
            </form>
        </div>
    </body>

</html>
