<?php
$submitteremail = $_POST['personemail'];
$submittername = $_POST['personname'];
$submitteridea = $_POST['ideabox'];
$submitterabout = $_POST['aboutcontact'];

$mail_sent = false;

/* Required fields */
if (!isset($_POST['personemail']) || !filter_var($_POST['personemail'], FILTER_VALIDATE_EMAIL)) {
    $errEmail = "Please enter a valid email address.";
}
if (!isset($_POST['personname']) || $submittername == '') {
    $errName = "Name is a required field.";
}
if (!isset($_POST['ideabox']) || $submitteridea == '' || strlen($submitteridea) < 10) {
    $errIdea = "Oops, you didn't include your big idea.";
}
if (isset($_POST['foo'])) {
    // Exist form, this is not a good submit
    exit;
} else {
    // If there are no errors, send the email
    if (!$errEmail && !$errName && !$errIdea) {
        // send email
        $from = 'no-reply@hackmgm.org';
        $to = 'jacquelinehfl@gmail.com, elijahlofgren@gmail.com, bstephens@netelysis.com';
        $subject = '[hackmgm.org] Submit Idea - ' . $submittername;

        $body = "From: $submittername\n E-Mail: $submitteremail\n Project Idea:\n $submitteridea";
        $body .= "\nAbout submitter: $submitterabout";
        $mail_sent = mail($to, $subject, $body, $from);
        if ($mail_sent) {
            //$result='<div class="alert alert-success">Thank You! I will be in touch</div>';
            //header( 'Location: /hackmgm.org/index.html?mail=sent' );
            header('Location: /index.html?mail=sent');
        } else {
            //$result='<div class="alert alert-danger">Sorry, there was an error sending your message. Please try again.</div>';
        }
    }
}

if ($errEmail || $errName || $errIdea || !$mail_sent) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>hackMGM</title>

        <!-- Bootstrap -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="./css/bootstrap.flatly.min.css">
        <link rel="stylesheet" href="./css/site.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
                        aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">hackMGM</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.html">Home</a></li>
                    <li class=""><a href="about.html">About</a></li>
                    <li><a href="getinvolved.html">Get Involved</a></li>
                    <li><a href="https://github.com/codeforamerica/codeofconduct" target="_blank">Code of Conduct</a></li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="https://github.com/hackmgm" target="_blank"><i class="fa fa-github fa-2x"></i></a></li>
                    <li><a href="https://www.meetup.com/hackMGM/" target="_blank"><i class="fa fa-meetup fa-2x"></i></a></li>
                    <li><a href="https://twitter.com/hackmgm" target="_blank"><i class="fa fa-twitter fa-2x"></i></a></li>
                    <li><a href="https://www.facebook.com/groups/hackMGM/" target="_blank"><i class="fa fa-facebook fa-2x"></i></a></li>
                    <li><a href="https://hackmgm.signup.team/" target="_blank"><i class="fa fa-slack fa-2x"></i></a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>


    <div class="container">
        <?php
        if (!$mail_sent) {
            ?>
            <div class="alert alert-danger">Sorry, there was an error sending your message. Please try again.</div>
        <?php } ?>
        <form action="submit_idea.php" method="POST">
            <div class="form-group">
                <label for="personname">Name</label>
                <input type="text" class="form-control" name="personname" id="personNameId" placeholder="First and Last name"
                       value="<?php echo htmlspecialchars($_POST['personname']); ?>">
                <p class="text-danger"><?php echo $errName ?></p>
            </div>
            <div class="form-group">
                <label for="personemail">Email address</label>
                <input type="email" class="form-control" id="personEmailId" name="personemail" placeholder="Email"
                       value="<?php echo htmlspecialchars($_POST['personemail']); ?>">
                <p class="text-danger"><?php echo $errEmail ?></p>
            </div>
            <div class="form-group">
                <label for="ideabox">What's the Big Idea? (Please include as much information as possible.)</label>
                <textarea type="text" class="form-control" id="ideaBoxId" name="ideabox" rows="4" placeholder="Tell us about your wonderful idea.">
                <?php echo htmlspecialchars($_POST['ideabox']); ?></textarea>
                <p class="help-block">Please include relevant URLs and information.</p>
                <p class="text-danger"><?php echo $errIdea ?></p>
            </div>
            <div class="form-group">
                <label for="aboutcontact">Tell us about yourself (optional)</label>
                <textarea type="textarea" class="form-control" id="aboutContactId" name="aboutcontact" placeholder="Let us know more about you.">
                <?php echo htmlspecialchars($_POST['aboutcontact']); ?></textarea>
                <p class="help-block">About yourself, what kind of work do you do, additional contact information, etc. are welcomed.</p>
            </div>
            <div id="fooDiv">
                <label for="foo">Leave this field blank</label>
                <input type="text" name="foo" id="foo">
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>

    <hr>

    <footer>
        <p>&copy; 2017 hackMGM</p>
    </footer>
    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


    <script>

        (function () {
            var e = document.getElementById("fooDiv");
            e.parentNode.removeChild(e);
        })();

    </script>
    </body>
    </html>
    <?php
}
