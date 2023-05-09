<?php

include_once('admin/connection.inc.php');

if (isset($_POST['submit'])) {
    $name =  $_POST['name'];
    $email =  $_POST['email'];
    $mobile =  $_POST['mobile'];
    $comm =  $_POST['comment'];
    if (empty($name)||empty($email)||empty($mobile)||empty($comm)) {
        echo "<script>
            alert('   يجب تعبئة باقي الحقول  ');
        </script>";        
    }else{
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
    <title>صفحة الكلية</title>
    <meta charset="utf-8">
    <!-- الإستايلات الأساسية -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>

<body>
    <!-- النافبار -->
    <nav class="navbar navbar-expand-lg py-3 bg-light">
        <div class="container">
            <a class="navbar-brand"><img width="160" src="carousel/logo.svg" alt=""></a>
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="#">الرئيسية</a>
                <a class="nav-link" href="#about">من نحن </a>
                <a class="nav-link" href="#contact">تواصل معنا</a>
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    تسجيل الدخول
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="login_std.php">طالب</a></li>
                    <li><a class="dropdown-item" href="login_emp.php">موظف</a></li>
                </ul>
            </div>

        </div>
    </nav>
    <!-- السلايدر -->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="carousel/FqlVOkHXgAIq00P.jfif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="carousel/FuLjuvdWcBgaHgX.jfif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="carousel/FvEaiDzWIAotb_Z.jfif" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <section class="about-us my-5 " id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="bg-info-subtle text-primary px-3 py-2 fs-3" style="border-top-left-radius: 10px;border-top-right-radius: 10px;">من نحن</h2>
                    <p class="bg-primary text-light px-3 fw-medium py-5" style=" border-radius:10px;line-height: 181%;">
                        تقع الكلية التقنية بجازان في مدينة جازان بالمملكة العربية السعودية، وهي جزء من الهيئة الملكية
                        للجبيل وينبع. تأسست الكلية
                        عام 1404هـ (1984م)، وتم تحويلها إلى كلية تقنية عام 1427هـ (2006م).


                        تعتبر الكلية التقنية بجازان إحدى الكليات التقنية الرائدة في المملكة العربية السعودية، حيث توفر
                        برامج تعليمية متنوعة في
                        مختلف التخصصات التقنية والهندسية. تضم الكلية أيضًا مركزًا لتقنية المعلومات يقدم خدمات متنوعة في
                        هذا المجال.


                        تشمل برامج الكلية التقنية بجازان تخصصات مثل الهندسة المدنية والهندسة الميكانيكية والهندسة
                        الكهربائية وتقنية المعلومات
                        والإلكترونيات والتحكم الآلي والتبريد والتكييف، بالإضافة إلى برامج التدريب المهني والتقني.


                        تهدف الكلية التقنية بجازان إلى توفير تعليم تقني متميز وعالي الجودة يستجيب لاحتياجات سوق العمل
                        ويؤهل الطلاب للعمل في
                        مختلف المجالات التقنية والصناعية والخدمية. كما تسعى الكلية إلى تطوير قدرات الطلاب والمهارات
                        اللازمة للنجاح في حياتهم
                        المهنية والعملية.
                    </p>
                </div>
                <div class="col-md-6">
                    <img src="carousel/images.jfif" class="img-responsive w-100 h-100" style="border-radius:10px">
                </div>
            </div>
        </div>
    </section>
    <section class=" row contact bg-light py-4 text-light" id="contact">
        <div class="col-md-2"></div>
        <div class="col-md-8 border-primary p-3" style="border: 1px solid;border-radius: 8px;">
            <form method="post" action="">
                <div class="mb-3">
                    <label for="name" class="form-label">الإسم</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="أدخل الإسم">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="أدخل البريد الإلكتروني">
                </div>
                <div class="mb-3">
                    <label for="mobile" class="form-label">رقم الجوال</label>
                    <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="أدخل رقم الجوال">
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">التعليق</label>
                    <textarea class="form-control" id="comment" name="comment" placeholder="أدخل تعليقك"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submit" style="float:left">إرسال</button>
            </form>
        </div>
    </section>
    <footer class="bg-dark text-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">جميع الحقوق محفوظة &copy; 2023 FED</p>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline mb-0 gap-3 d-flex">
                        <li class="list-inline-item"><a class="text-white" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                </svg></a></li>
                        <li class="list-inline-item"><a href="#" class="text-white"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                </svg></a></li>
                        <li class="list-inline-item"><a href="#" class="text-white"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                </svg></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>