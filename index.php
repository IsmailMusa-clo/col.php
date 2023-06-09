<?php

include_once('admin/connection.inc.php');

if (isset($_POST['submit'])) {
    $name =  $_POST['name'];
    $email =  $_POST['email'];
    $mobile =  $_POST['mobile'];
    $comm =  $_POST['comment'];
    if (empty($name) || empty($email) || empty($mobile) || empty($comm)) {
        echo "<script>
            alert('   يجب تعبئة باقي الحقول  ');
        </script>";
    } else {
        mysqli_query($con, "insert into contact_us(`name`,`email`,`mobile`,`comment`) values('$name','$email','$mobile','$comm')");
        echo "<script>
		alert(' تم إرسال الطلب بنجاح ');
	</script>";
    }
}

?>
<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الكلية التقنية</title>
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .c_title {
            text-align: center;
            color: blue;
            font-size: 29px;
            font-weight: 400;
        }
        form{
            width: 80%;
            margin: auto;
        }
        .inputs{
            display: flex;
            align-items: center;
            margin: 10px 0;
            gap: 30px;
        }
        .inputs label{
            width:10%
        }
        .inputs input,textarea{
            width:80%;
            padding:8px 15px;
            border-radius: 8px;
            border:none;
        }
    </style>
</head>

<body>
    <!-- start header -->
    <header>
        <!-- start navbar section -->
        <nav>
            <div class="container">
                <div class="content">
                    <!-- start brand sec  -->
                    <div class="brand">
                        <a href="index.html">
                            <img src="carousel/logo.svg" style="width:140px">
                        </a>
                    </div>
                    <!-- end brand sec -->
                    <ul>
                        <li><a href="#">الرئيسية</a></li>
                        <li><a href="#about">من نحن</a></li>
                        <li><a href="#contact">تواصل معنا</a></li>
                        <li><a href="admin/index.php">صفحة الأدمن</a></li>
                        <li><a href="teacher_dash.php">صفحة المهندس</a></li>
                    </ul>
                    <a href="#"><i class="fa fa-bars"></i></a>
                </div>
            </div>
        </nav>
        <!-- end navbar section -->
        <!-- start about us -->
        <section class="about-us" style="background-image:url('carousel/close-up-woman-holding-pen.jpg');">
            <div class="container">
                <div class="content pad-sec">
                    <h3>كلية جازان التقنية</h3>
                    <p> كلية رائدة في مجال التعليم التقني والمهني تقدم لكم الكثير من التميز والابداع
                    </p>
                    <a href="https://twitter.com/tvtc_g_jazan?lang=ar" class="btn">تعرف أكثر</a>
                </div>
            </div>
        </section>
        <!-- end about us -->
    </header>
    <!-- end header -->
    <!-- start main -->
    <main>
        <!-- start services section -->
        <section id="services" class="services pad-sec" id="about">
            <div class="container">
                <div class="boxes">
                    <!-- start box -->
                    <div class="box">
                        <img src="assets/images//content/1.png" alt="">
                        <h3>أكفأ المدرسين</h3>
                        <p> يتمتعون بمهارات وخبرات استثنائية في التدريس، ويتميزون بقدراتهم الفريدة في توصيل المعلومات وإلهام الطلاب. يتميزون بالعديد من الصفات التي يجعلهم متميزين في مجالهم
                        </p>
                    </div>
                    <!-- end box -->
                    <!-- start box -->
                    <div class="box">
                        <img src="assets/images//content/2.png" alt="">
                        <h3>أفضل مسار مهني</h3>
                        <p>يساعد الفرد في تحقيق رغباته وتطلعاته المهنية. يشمل هذا المسار اختيار المجال الذي يثير اهتمام الشخص وتحفيزه، ومتابعة دراسة وتدريب مستمر لتطوير المهارات والمعرفة المطلوبة في ذلك المجال.
                        </p>
                    </div>
                    <!-- end box -->
                    <!-- start box -->
                    <div class="box">
                        <img src="assets/images//content/3.png" alt="">
                        <h3>تطوير مستمر</h3>
                        <p>يساعد الفرد في تحقيق رغباته وتطلعاته المهنية. يشمل هذا المسار اختيار المجال الذي يثير اهتمام الشخص وتحفيزه، ومتابعة دراسة وتدريب مستمر لتطوير المهارات والمعرفة المطلوبة في ذلك المجال.
                        </p>
                    </div>
                    <!-- end box -->
                    <!-- start box -->
                    <div class="box">
                        <img src="assets/images//content/4.png" alt="">
                        <h3> أدوات إبداعية</h3>
                        <p>يساعد الفرد في تحقيق رغباته وتطلعاته المهنية. يشمل هذا المسار اختيار المجال الذي يثير اهتمام الشخص وتحفيزه، ومتابعة دراسة وتدريب مستمر لتطوير المهارات والمعرفة المطلوبة في ذلك المجال.
                        </p>
                    </div>
                    <!-- end box -->
                </div>
            </div>
        </section>
        <!-- end sevices section -->

        <!-- start contact us section -->
        <section class="contact-us pad-sec" id="contact">
            <div class="container">
                <h3 class="c_title">تواصل معنا</h3>
                <div class="content">
                    <form method="post" action="">
                        <div class="inputs">
                            <label for="name" class="form-label">الإسم</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="أدخل الإسم">
                        </div>
                        <div class="inputs">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="أدخل البريد الإلكتروني">
                        </div>
                        <div class="inputs">
                            <label for="mobile" class="form-label">رقم الجوال</label>
                            <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="أدخل رقم الجوال">
                        </div>
                        <div class="inputs">
                            <label for="comment" class="form-label">التعليق</label>
                            <textarea class="form-control" id="comment" name="comment" placeholder="أدخل تعليقك"></textarea>
                        </div>
                        <button type="submit" name="submit" style="float:left;cursor:pointer">إرسال</button>
                    </form>
                </div>
            </div>
        </section>
        <!-- start contact us section -->

        <!-- end section map -->
    </main>
    <!-- end main -->

    <!-- start footer -->
    <footer class="pad-sec">
        <h3> الكلية التقنية بجازان </h3>

        <ul>
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
        </ul>
    </footer>
    <!-- end footer -->
</body>

</html>