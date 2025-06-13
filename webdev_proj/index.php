<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KangarooCare Confinement Centre</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #0a0f44, #5a9bd6);
            color: #333;
        }

        header {
            background-color: #00274d;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header img {
            width: 150px;
            margin-right: 15px;
        }

        header .header-title {
            display: flex;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        .nav-links {
            display: flex;
            gap: 15px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav-links a:hover {
            background-color: #f4a261;
        }

        .banner {
            text-align: center;
            margin: 20px auto;
            max-width: 100%;
        }

        .banner img {
            width: 100%;
            height: auto;
        }

        .hero {
            text-align: center;
            padding: 40px 20px;
            color: white;
            background: linear-gradient(to bottom, #0a0f44, #1e3c72);
        }

        .hero h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 20px;
            color: #dfe9f3;
            line-height: 1.8;
            margin: 0 auto;
            max-width: 800px;
            text-align: justify;
        }

        .section {
            padding: 60px 20px;
            text-align: center;
            background: linear-gradient(to bottom, #1e3c72, #5a9bd6);
            color: white;
        }

        .section h2 {
            font-size: 32px;
            margin-bottom: 30px;
        }

        .section p {
            font-size: 20px;
            color: #e6e9f0;
            line-height: 1.8;
            margin: 0 auto 30px auto;
            max-width: 800px;
            text-align: justify;
        }

        .image-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .image-grid img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .map-section {
            padding: 60px 20px;
            text-align: center;
            background-color: #1e3c72;
            color: white;
        }

        .map-section h2 {
            font-size: 32px;
            margin-bottom: 30px;
        }

        .map-section iframe {
            width: 100%;
            max-width: 800px;
            height: 400px;
            border: 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #00274d;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }

        footer .social-links {
            margin-top: 10px;
        }

        footer .social-links a {
            color: #f4a261;
            text-decoration: none;
            margin: 0 10px;
            font-size: 16px;
        }

        footer .social-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
    <div class="header-title">
        <img src="images/kangaroo-logo.png" alt="Logo">
        <h1>KangarooCare Confinement Centre</h1>
    </div>
    <nav class="nav-links">
        <a href="booking.php">Booking</a>
        <a href="guide.php">Guide</a>
        <a href="service_distinct">Services</a>
        <a href="feedback.php">Feedback</a>
    </nav>
</header>

<div class="banner">
    <img src="images/mother-and-baby.png" alt="Mother and Baby Banner">
</div>

<div class="hero">
    <h2 style="text-align: center;">Welcome to KangarooCare</h2>
    <p style="text-align: center; margin: 0 auto; max-width: 800px;">At KangarooCare Confinement Centre, we offer more than just services – we provide a sanctuary for new mothers. Nestled in a serene setting, our centre is designed to empower you as you embrace motherhood. With a personalized approach to care, we ensure every moment you spend here fosters recovery, joy, and confidence. Let us be part of your postpartum journey and make it unforgettable.</p>
</div>
</div>

<section class="section">
    <h2 style="text-align: center;">What is a Confinement Lady?</h2>
    <p style="text-align: center; margin: 0 auto; max-width: 800px;">A confinement lady is a dedicated professional caregiver, blending traditional wisdom with modern expertise to support new mothers. From preparing nutrient-rich meals and ensuring the mother’s physical recovery to nurturing newborns with expert care, these professionals are a cornerstone of postpartum recovery. With their guidance, mothers can focus on bonding with their babies, confident that their needs are met with skill and compassion.</p>
    <div style="margin-top: 30px;"></div>
    <div class="image-grid">
        <img src="images/confinement-lady1.png" alt="Confinement Lady 1">
        <img src="images/confinement-lady2.png" alt="Confinement Lady 2">
        <img src="images/confinement-lady3.png" alt="Confinement Lady 3">
    </div>
</section>

<section class="section">
    <h2 style="text-align: center;">About Us</h2>
    <p style="text-align: center; margin: 0 auto; max-width: 800px;">At KangarooCare Confinement Centre, we redefine postpartum care by combining traditional practices with modern comforts. Our team of skilled caregivers creates a nurturing environment tailored to the unique needs of every mother and baby. From restorative meals and relaxation therapies to hands-on newborn care, we aim to make your recovery smooth and joyful.</p>
    <p style="text-align: center; margin: 20px auto 0 auto; max-width: 800px;">Every aspect of our center is crafted to ensure you feel supported, cared for, and empowered. We’re not just about care – we’re about celebrating the incredible journey of motherhood.</p>
</section>
</section>

<section class="map-section">
    <h2>Our Location</h2>
    <iframe src="https://www.google.com/maps?q=948,+Lorong+Merpati,+Alor+Malai,+05200+Alor+Setar,+Kedah&output=embed" allowfullscreen></iframe>
    <p style="font-size: 18px; color: #e6e9f0; margin-top: 20px; max-width: 800px; margin: 0 auto; text-align: center;">
        KangarooCare Confinement Centre is conveniently located in Alor Setar, Kedah, providing dedicated postpartum care for mothers in the surrounding areas. Our services cover the Alor Setar region and nearby towns, ensuring mothers have access to the highest quality of care and support during their postpartum journey.
    </p>
</section>

<footer>
    &copy; 2025 KangarooCare | <a href="#" style="color: #f4a261;">Privacy Policy</a>
    <div class="social-links">
        <a href="https://facebook.com">Facebook</a>
        <a href="https://instagram.com">Instagram</a>
        <a href="https://wa.link/2zestt">Contact Us</a>
    </div>
</footer>

</body>
</html>
