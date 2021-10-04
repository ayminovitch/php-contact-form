<?php
require_once 'core/init.php';
if(Input::exists()){
    if(true){ //csrf protection
        $validate = new Validation();
        $validate->check($_POST, array(
            'salutation' => array(
                'required' => array(true, 'You Must Enter Your Salutation'),
                'max' => array(20, 'Your Name Must Be At Most 20 Characters'),
            ),
            'name' => array(
                'required' => array(true, 'You Must Enter Your Name'),
                'max' => array(20, 'Your Name Must Be At Most 20 Characters'),
                'regexp' => array('/^[a-zA-Z\s]*$/', "Please Enter A Valid Name | Note That You can only use English letters, and spaces.")
            ),
            'email' => array(
                'required' => array(true, 'You Must Enter Your Email'),
                'min' => array(4, 'Your Email Must Be At Least 4 Characters'),
                'max' => array(40, 'Your Name Must Be At Most 40 Characters'),
                'regexp' => array('/^[A-Za-z_\.0-9]+@+[A-Za-z_\.0-9]+$/i', "Please Enter A Valid Email.")
            ),
            'inquiry' => array(
            ),
            'description' => array(
                'max' => array(700, 'Your Description Must Be At Most 700 Characters')
            ),
            'tos' => array(
                'required' => array('true', 'You Did Not Accept Our Term Of Service')
            )
        ));
        if($validate->passed()){
            //Save to the database
            $db = new Db();
            $db->executeQuery($_POST);

            //Send the message
            $send = new Sender();
            $send->send($_POST, $_POST['salutation'], $_POST['email'], $_POST['name']);

            Session::put('status', '<div class="alert alert-success text-center" style="position: fixed; z-index:9999; width: 100%;"> Your message has been sent </div>');
            Redirect::re();
        }else{
            Session::put('status', '<div class="alert alert-danger text-center" style="position: fixed; z-index:9999; width: 100%;"> Message could not be sent. </div>');
            $errors = $validate->errors();
        }
    }else{
        Redirect::re();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VALID Digitalagentur GmbH</title>

    <!-- including style files -->
    <link href="https://fonts.googleapis.com/css?family=Chicle|Cairo" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/font-awesome.min.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet"/>

    <!-- including Script files -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<?php echo Session::flash('status'); ?>
<!-- Starting Headers -->
<header>
    <div class="container">
        <div class="intro">
            <p>Don't Wait To Contact Us</p>
            <h1>We Are VALID</h1>
            <p></p>
        </div>
        <a href="#info">
            <i class="fa fa-arrow-down"></i>
        </a>
    </div>
</header>
<!-- Ending Headers -->

<!-- Starting Info -->
<section class="info" id="info">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-6">
                <h3>Address</h3>
                <p>
                    Cuvrystraße 3-4, 10997 Berlin, Germany
                </p>
            </div>
            <div class="col-md-3 col-xs-6">
                <h3>Phone</h3>
                <p>
                    +49 30 220022900
                </p>
            </div>
            <div class="col-md-3 col-xs-6">
                <h3>Open Time</h3>
                <p>
                    Everyday except for holiday
                    <br />
                    From 9 AM – 5 PM
                </p>
            </div>
            <div class="col-md-3 col-xs-6">
                <h3>Email</h3>
                <p>
                    <a href="mailto:info@valid-digital.com">info@valid-digital.com</a>
                </p>
            </div>
        </div>
    </div>
</section>
<!-- Ending Info -->

<!-- Starting Contact Form -->
<section class="contact">
    <div class="container">
        <h1 class="page-header text-center">Message Us</h1>
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                    <input type="text" name="salutation" id="name" placeholder="Salutaion" value="<?php echo @Input::get('salutation'); ?>" maxlength="20" required />
                    <label class='text text-danger' for="salutation"><?php echo @$errors['salutation']; ?></label>

                    <input type="text" name="name" id="name" placeholder="Your Name" value="<?php echo @Input::get('name'); ?>" maxlength="20" required />
                    <label class='text text-danger' for="name"><?php echo @$errors['name']; ?></label>

                    <input type="email" name="email" id="email" placeholder="Your Email" value="<?php echo @Input::get('email'); ?>" minlength="4" maxlength="40" required />
                    <label class='text text-danger' for="email"><?php echo @$errors['email']; ?></label>

                    <div class="form-group" style="margin: 1% 0;">
                        <label for="inquiry" style="margin-right: 2%;">Inquiry</label>
                        <select id="inquiry" name="inquiry">
                            <option value="option1">Option-1</option>
                            <option value="option2">Option-2</option>
                            <option value="option3">Option-3</option>
                        </select>
                    </div>
                    <div class="form-group description hidden">
                        <textarea name="description" id="description" placeholder="Your Description" maxlength="700"><?php echo @Input::get('description'); ?></textarea>
                        <label class='text text-danger' for="description"><?php echo @$errors['description']; ?></label>
                    </div>
                    <div class="form-check">
                        <input type="hidden" name="tos" value="0" />
                        <input class="form-check-input" id="tos" type="checkbox" name="tos" value="1" required/>
                        <label class="form-check-label" for="tos">Read and accept <a href="#">term of service</a></label>
                    </div>
                    <label class='text text-danger' for="description"><?php echo @$errors['tos']; ?></label>
                    <input type="submit" value="Send Message" />
                </form>
            </div>
            <div class="col-md-6 col-xs-12">
                <iframe frameborder="0" scrolling="no" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d23720.316834740304!2d13.433310772614524!3d52.49799968614001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47a851c537e17919%3A0x2d7160464c92f0dc!2sVALID%20Digitalagentur%20GmbH!5e0!3m2!1sen!2stn!4v1633388094591!5m2!1sen!2stn" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>
<!-- Ending Contact Form -->

<!-- Starting Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-6">
                <span>Made With Love By <a href="https://www.linkedin.com/in/hammamiaymen/">Aymen Hammami</a> to Valid Digital</span>
            </div>
            <div class="col-xs-6 social">
                <a href="mailto:vor@live.com"><i class="fa fa-telegram"></i></a>
                <a href="https://www.linkedin.com/in/hammamiaymen/"><i class="fa fa-linkedin"></i></a>
            </div>
        </div>
    </div>
</footer>
<!-- Ending Footer -->
<script src="js/script.js"></script>
</body>
</html>
