<?php require "utils.php"; ?>

<?php if (permissions(1) == 1): ?>
    <html>
    <head>
        <title>
            Create a post
        </title>
    </head>
    <body>

    <form id="frm" action="postHandler.php" method="post">
        <input type="text" name="title" placeholder="Title"><br>
        <textarea name="txt" placeholder="Text" form="frm"></textarea><br>
        <input type="submit" name="submit" value="Submit">
    </form>
    </body>
    </html>
<?php elseif (permissions(1) == -1): ?>
    <html>
    <head>
        <title>
            Create a post
        </title>
    </head>
    <body>
        You are not logged in
    </body>
    </html>
<?php elseif (permissions(1) == 0): ?>
    <html>
    <head>
        <title>
            Create a post
        </title>
    </head>
    <body>

        You do not have permissions to do this.
    </body>
    </html>
<?php endif; ?>

