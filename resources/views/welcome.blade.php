<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel-8 | PFR</title>

        <!--Icon -->
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <!-- Styles -->
        <!-- lokasi di public-->
        <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
    </head>
    <body>
<!-- Main Section -->
<main class="l-main">
<!--section home-->
<section class="home">
    <div class="home__container bd-container bd-grid"> 
        <div class="home__data">
            <h1 class="home__title">Personal Financial Record</h1>
            <h2 class="home__subtitle">Helpful <br> your finance</h2>
            @if (Route::has('login'))
            @auth
                    <a href="{{url('/home')}}" class="button">Home</a>
                @else
                    <a href="{{url('/login')}}" class="button">Login</a>
                @if (Route::has('register'))
                    <a href="{{route('register')}}" class="button">Register</a>
                @endif
            @endauth
         @endif
        </div>

        <img src="assets/img/pfr.jpg" alt="" class="home__img">
    </div>
</section>
<!-- section About -->
<section class="about section bd-container" id="about">
    <div class="about__container bd-grid">
        <div class="about__data">
            <span class="section-subtitle about__initial">About Us</span>
            <h2 class="section-title about__initial">We help your finance <br>Record</h2>
            <p class="about__description">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                Nostrum repellat atque magni iste, accusantium sed in laboriosam nihil maiores 
                voluptatibus natus harum unde libero doloremque veritatis maxime eaque labore suscipit?
            </p>
            
        </div>
     <img src="assets/img/pfr-about.jpg" alt="" class="about__img">
    </div>
</section>

<!-- Section Contact Us-->
    <section class="contact section bd-container" id="contact">
        <div class="contact__container bd-grid">
            <div class="contact__data">
                <span class="section-subtitle contact__initial">Let's Talk</span>
                <h2 class="section-title contact__initial">Contact Us</h2>
                <p class="contact__description">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Iste dolores optio ut, sint quisquam quas, illo est, 
                    magnam sapiente fugiat laboriosam non modi exercitationem. 
                    Explicabo perspiciatis ad error dolore dolorum.
                </p>
            </div>

            <div class="contact__button">
                <a href="#" class="button">Contact Us Now</a>
            </div>
        </div>
    </section>
    </main>
        <!-- === Footer Section === -->
        <footer class="footer section bd-container">
            <div class="footer__container bd-grid">
                <div class="footer__content">
                    <a href="#" class="footer__logo">Personal Financial</a>
                    <span class="footer__description">Record</span>

                    <div>
                        <a href="#" class="footer__social"><i class='bx bxl-instagram'></i></a>
                        <a href="#" class="footer__social"><i class='bx bxl-facebook'></i></a>
                    </div>
                </div>
                <div class="footer__content">
                    <h3 class="footer__title">Services</h3>
                    <ul>
                        <li><a href="#" class="footer__link">Income</a></li>
                        <li><a href="#" class="footer__link">Expenses</a></li>
                    </ul>
                </div>
                <div class="footer__content">
                    <h3 class="footer__title">Information</h3>
                    <ul>
                        <li><a href="#" class="footer__link">Event</a></li>
                        <li><a href="#" class="footer__link">Contact</a></li>
                        <li><a href="#" class="footer__link">Terms of services</a></li>
                    </ul>
                </div>
                <div class="footer__content">
                    <h3 class="footer__title">Adress</h3>
                    <ul>
                        <li>Jakarta Barat</li>
                        <li>Jl.Tawakal</li>
                        <li>Tomang</li>
                        <li>prf@email.co.id</li>
                    </ul>
                </div>
            </div>
            <p class="footer__copyright">&#169; Copyright</p>
        </footer>
    </body>
</html>
