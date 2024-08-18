<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>SteamGaming</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Page Mini Icon -->
  <link href="assets/favicon.png" rel="icon">
  <link href="assets/logo.png" rel="apple-touch-icon">

  <!-- Import Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  
  <!-- Import CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Import Main CSS Files -->
  <link href="views/membership/membership.css" rel="stylesheet">

</head>

<body class="membership-page" data-bs-spy="scroll" data-bs-target="#navmenu">

  <!-- Navigation Bar -->
<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="container-fluid d-flex align-items-center justify-content-between">
    <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0"><img src="assets/steamgaming.png" alt=""></a>
    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="index.php">Home</a></li>   
        <li><a href="Store.php">Store</a></li>         
        <li class="dropdown has-dropdown"><a href="Membership.php"><span>Membership</span> <i class="bi bi-chevron-down"></i></a>
          <ul class="dd-box-shadow">
            <li><a href="Membership.php#features">Features</a></li>
            <li><a href="Membership.php#glimpse">Glimpse</a></li>
            <li><a href="Membership.php#pricing">Pricing</a></li>
            <li><a href="Membership.php#faq">FAQ</a></li>
          </ul>
        </li>
        <li class="dropdown has-dropdown"><a href="About.php"><span>About</span> <i class="bi bi-chevron-down"></i></a>
          <ul class="dd-box-shadow">
            <li><a href="About.php#team">Team Members</a></li>
            <li><a href="About.php#contact">Contact</a></li>
          </ul>
        </li>
        
        <?php

        session_start();
        if (isset($_SESSION['email']))
        {
          echo '<li><a href="UserProfile.php">My Profile</a></li>';
          echo '<li><a href="UserOrder.php">My Order</a></li>';
        }
        ?>

      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
    <?php
        if (isset($_SESSION['email']))
        {
          echo '<a class="btn-getstarted" href="controllers/LogoutController.php" onclick="return confirm(\'Are you sure you want to logout?\')">Logout</a>';
        }
        
        else
        {
          echo '<a class="btn-getstarted" href="LoginSignup.php">Login</a>';
        }
    ?>
  </div>
</header>

  <main id="main">

    <!-- Banner Section -->
    <section id="banner" class="banner">
      <img src="assets/banner-bg.png" alt="" data-aos="fade-in">
      <div class="container">
        <div class="row">
          <div class="col-lg-10">
            <h2 data-aos="fade-up" data-aos-delay="100">Level Up Your Gaming Experiance</h2>
            <p data-aos="fade-up" data-aos-delay="200">Monthly Game Rotation. Free DLCs. In-game Cosmetics. Early Access. Many More!</p>
          </div>
        </div>
      </div>
    </section>

    <!-- collabs Section -->
    <section id="collabs" class="collabs">
      <div class="container-fluid" data-aos="fade-up">
        <div class="row gy-4">
          <div class="col-xl-2 col-md-3 col-6 collab-logo">
            <img src="assets/collabs/collab-1.png" class="img-fluid" alt="">
          </div>
          <div class="col-xl-2 col-md-3 col-6 collab-logo">
            <img src="assets/collabs/collab-2.png" class="img-fluid" alt="">
          </div>
          <div class="col-xl-2 col-md-3 col-6 collab-logo">
            <img src="assets/collabs/collab-3.png" class="img-fluid" alt="">
          </div>
          <div class="col-xl-2 col-md-3 col-6 collab-logo">
            <img src="assets/collabs/collab-4.png" class="img-fluid" alt="">
          </div>
          <div class="col-xl-2 col-md-3 col-6 collab-logo">
            <img src="assets/collabs/collab-5.png" class="img-fluid" alt="">
          </div>
          <div class="col-xl-2 col-md-3 col-6 collab-logo">
            <img src="assets/collabs/collab-6.png" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
      <div class="container section-title" data-aos="fade-up">
        <h2>Features</h2>
        <p>These are the few key features that will be included in the membership plan. Please note that certain features only available on higher level membership plan.</p>
      </div>
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="100">
            <div class="features-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-controller"></i></div>
              <div>
                <h4 class="title"><a>Monthly Game Pass</a></h4>
                <p class="description">Enjoy monthly free game Rotation. All progress will be saved locally and cloud for supported games. Don't judge a game before you play it yourself.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="300">
            <div class="features-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-puzzle"></i></div>
              <div>
                <h4 class="title"><a>Free DLCs</a></h4>
                <p class="description">For games that are already in your library, you will be granted full access to all the game expension DLCs. Soundtrack, cosmetic and pre-order DLCs are not included.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="200">
            <div class="features-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-receipt"></i></div>
              <div>
                <h4 class="title"><a>Membership Discount</a></h4>
                <p class="description">For games that you already played during playtest, free trial or game pass, but have not bought, you will be given discount up to 50%. Note that discount offers does not stack.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="400">
            <div class="features-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-fire"></i></div>
              <div>
                <h4 class="title"><a>Early Access</a></h4>
                <p class="description">Be one of the firsts to enjoy the game before it even released. Members have access to games 1 week before the global release. Get ahead before everyone else.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="500">
            <div class="features-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-wrench-adjustable-circle"></i></div>
              <div>
                <h4 class="title"><a>Beta Testing</a></h4>
                <p class="description">Help developers in improving their games by joing the beta testing. For public beta testing application, players with membership plan will be prioratized.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="600">
            <div class="features-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-calendar4-week"></i></div>
              <div>
                <h4 class="title"><a>Membership-only Competition</a></h4>
                <p class="description">Become part of the inner circle in our elite members-only showdown. Win big prizes with your team and possible chances to meet famous youtubers, streamers, pro-players and game evelopers.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Glimpse Section -->
    <section id="glimpse" class="glimpse">
      <div class="container section-title" data-aos="fade-up">
        <h2>Glimpse</h2>
        <p>Here some sneak-peak of our membership experiance.</p>
      </div>
      <div class="container">
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
          <ul class="glimpse-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">Special Events</li>
            <li data-filter=".filter-product">Games</li>
            <li data-filter=".filter-branding">Content Creators</li>
          </ul>
          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
            <div class="col-lg-4 col-md-6 glimpse-item isotope-item filter-app">
              <img src="assets/masonry-glimpse/masonry-glimpse-1.jpg" class="img-fluid" alt="">
              <div class="glimpse-info">
                <h4>The International Dota 2 Championships 2023</h4>
                <p> An offline dota 2 tournament organized by Valve and PGL. It was held from October 12 to 29 of 2023.</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 glimpse-item isotope-item filter-product">
              <img src="assets/masonry-glimpse/masonry-glimpse-2.jpg" class="img-fluid" alt="">
              <div class="glimpse-info">
                <h4>Monster Hunter Rise : Sunbreak DLC</h4>
                <p>An expansion DLC to the original Monster Hunter Rise. Featuring new monsters and monsters from the previous Monster Hunter titles. </p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 glimpse-item isotope-item filter-branding">
              <img src="assets/masonry-glimpse/masonry-glimpse-3.jpg" class="img-fluid" alt="">
              <div class="glimpse-info">
                <h4>Meet-and-Greet with Markiplier</h4>
                <p>Markiplier a famous youtuber and streamer annoucing his special Spotify Podcast.</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 glimpse-item isotope-item filter-app">
              <img src="assets/masonry-glimpse/masonry-glimpse-4.jpg" class="img-fluid" alt="">
              <div class="glimpse-info">
                <h4>Tennocon 2023</h4>
                <p>Warframe offline event in celebration of the 10 Year Anniversary. Including closed Beta testing for cross-progression and mobile port.</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 glimpse-item isotope-item filter-product">
              <img src="assets/masonry-glimpse/masonry-glimpse-5.jpg" class="img-fluid" alt="">
              <div class="glimpse-info">
                <h4>Hollow Knight : Silksong</h4>
                <p>The long awaited sequel to Hollow Knight. Launch date is still TBA but selected fans can enjoy the playtest.</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 glimpse-item isotope-item filter-branding">
              <img src="assets/masonry-glimpse/masonry-glimpse-6.jpg" class="img-fluid" alt="">
              <div class="glimpse-info">
                <h4>Monster Hunter Rise Soundtrack Recording</h4>
                <p>Meet the Monster Hunter Rise soundtrack director, performers and experiance the music live.</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 glimpse-item isotope-item filter-app">
              <img src="assets/masonry-glimpse/masonry-glimpse-7.jpg" class="img-fluid" alt="">
              <div class="glimpse-info">
                <h4>Launching of the Steam Deck</h4>
                <p>Steam Gaming has move to portable. Enjoy early playtest at our special booth.</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 glimpse-item isotope-item filter-product">
              <img src="assets/masonry-glimpse/masonry-glimpse-8.jpg" class="img-fluid" alt="">
              <div class="glimpse-info">
                <h4>Total War : Warhammer 3 DLCs</h4>
                <p>Enjoy the many race DLCs offers in the Total War : Warhammer francise before buying one yourself.</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 glimpse-item isotope-item filter-branding">
              <img src="assets/masonry-glimpse/masonry-glimpse-9.jpg" class="img-fluid" alt="">
              <div class="glimpse-info">
                <h4>Team Cherry</h4>
                <p>Meet the creators of Hollow Knight live and playtest the upcoming sequel, Hollow Knight Silksong.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Past-Event Section -->
    <section id="past-events" class="past-events">
      <div class="container section-title" data-aos="fade-up">
        <h2>Past Events</h2>
        <p>Past events that was held where membership owners received special treatments.</p>
      </div>
      <div class="container">
        <div class="row gy-4">
          <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <article>
              <div class="post-img">
                <img src="assets/blog/blog-2.jpg" alt="" class="img-fluid">
              </div>
              <p class="post-category">Beta Testing</p>
              <h2 class="title">
                <a href="blog-details.php">Arknight Endfield Closed Techinical Test</a>
              </h2>
              <div class="d-flex align-items-center">
                <img src="assets/blog/blog-author-2.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                <div class="post-meta">
                  <p class="post-author">Hypergryph | Gryphline</p>
                  <p class="post-date">
                    <time datetime="2022-01-01">January 3, 2024</time>
                  </p>
                </div>
              </div>
            </article>
          </div>
          <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <article>
              <div class="post-img">
                <img src="assets/blog/blog-3.jpg" alt="" class="img-fluid">
              </div>
              <p class="post-category">Offline Event</p>
              <h2 class="title">
                <a href="blog-details.php">Dota 2 Tournament : Membership Only</a>
              </h2>
              <div class="d-flex align-items-center">
                <img src="assets/blog/blog-author-3.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                <div class="post-meta">
                  <p class="post-author">Valve</p>
                  <p class="post-date">
                    <time datetime="2022-01-01">October 12-29, 2023</time>
                  </p>
                </div>
              </div>
            </article>
          </div>
          <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <article>
              <div class="post-img">
                <img src="assets/blog/blog-1.jpg" alt="" class="img-fluid">
              </div>
              <p class="post-category">Offline Event</p>
              <h2 class="title">
                <a href="blog-details.php">Tennocon 2023 : 10 Years of Warframe</a>
              </h2>
              <div class="d-flex align-items-center">
                <img src="assets/blog/blog-author.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                <div class="post-meta">
                  <p class="post-author">Digital Extremes</p>
                  <p class="post-date">
                    <time datetime="2022-01-01">August 26, 2023</time>
                  </p>
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="pricing">
      <div class="container section-title" data-aos="fade-up">
        <h2>Pricing</h2>
        <p>Different membership plan offers different features. Choose the best plan that suits your gaming experiance.</p>
      </div>
      <div class="container" data-aos="zoom-in" data-aos-delay="100">
        <div class="row g-4">
          <div class="col-lg-4">
            <div class="pricing-item">
              <h3>Bronze</h3>
              <div class="icon">
                <i class="bi bi-diamond"></i>
              </div>
              <h4><sup>RM</sup>19<span> / year</span></h4>
              <ul>
                <li><i class="bi bi-check"></i> <span>Exclusive Profile Customization</span></li>
                <li><i class="bi bi-check"></i> <span>Monthly Game Pass</span></li>
                <li><i class="bi bi-check"></i> <span>Membership Discount</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Free Downloadable Contents</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Early Access</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Beta Testing</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Membership-only Competition</span></li>
              </ul>
              <div class="text-center">
                <form action="UserPayment.php" method="post">
                    <input type="hidden" name="membership_id" value="1">
                    <button type="submit" class="buy-btn">Buy Now</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="pricing-item featured">
              <h3>Silver</h3>
              <div class="icon">
                <i class="bi bi-diamond-half"></i>
              </div>
              <h4><sup>RM</sup>39<span> / year</span></h4>
              <ul>
                <li><i class="bi bi-check"></i> <span>Exclusive Profile Customization</span></li>
                <li><i class="bi bi-check"></i> <span>Monthly Game Pass</span></li>
                <li><i class="bi bi-check"></i> <span>Membership Discount</span></li>
                <li><i class="bi bi-check"></i> <span>Free Downloadable Contents</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Early Access</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Beta Testing</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Membership-only Competition</span></li>
              </ul>
              <div class="text-center">
                <form action="UserPayment.php" method="post">
                    <input type="hidden" name="membership_id" value="2">
                    <button type="submit" class="buy-btn">Buy Now</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="pricing-item">
              <h3>Gold</h3>
              <div class="icon">
                <i class="bi bi-diamond-fill"></i>
              </div>
              <h4><sup>RM</sup>59<span> / year</span></h4>
              <ul>
                <li><i class="bi bi-check"></i> <span>Exclusive Profile Customization</span></li>
                <li><i class="bi bi-check"></i> <span>Monthly Game Pass</span></li>
                <li><i class="bi bi-check"></i> <span>Membership Discount</span></li>
                <li><i class="bi bi-check"></i> <span>Free Downloadable Contents</span></li>
                <li><i class="bi bi-check"></i> <span>Early Access</span></li>
                <li><i class="bi bi-check"></i> <span>Beta Testing</span></li>
                <li><i class="bi bi-check"></i> <span>Membership-only Competition</span></li>
              </ul>
              <div class="text-center">
                <form action="UserPayment.php" method="post">
                    <input type="hidden" name="membership_id" value="3">
                    <button type="submit" class="buy-btn">Buy Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Faq Section -->
    <section id="faq" class="faq">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="content px-xl-5">
              <h3><span>Frequently Asked </span><strong>Questions</strong></h3>
              <p> We know you have a lot to ask before you make the decision. To save you and us some time, here are some of the frequently asked questions with answers about the Steam Gaming Membership.</p>
            </div>
          </div>
          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
            <div class="faq-container">
              <div class="faq-item faq-active">
                <h3><span class="num">1.</span> <span>Do I get to keep the DLC after the membership plan ends?</span></h3>
                <div class="faq-content">
                  <p>Sadly no. Renewing the membership plan is required. However all progresses, items, achivements and cosmetics gained during the DLC expension gameplay will be kept to your account as you already owned them.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>
              <div class="faq-item">
                <h3><span class="num">2.</span> <span>If I am not satisfied with the membership plan, can I refund?</span></h3>
                <div class="faq-content">
                  <p>Unlike the game purchase refund policy, you cannot refund nor downgrade a membership plan. You can however upgrade your membership plan if you feel like the current plan is lacking.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>
              <div class="faq-item">
                <h3><span class="num">3.</span> <span>Is it a guarantee that I can meet popular youtubers, streamers, pro players and game developers during offline events?</span></h3>
                <div class="faq-content">
                  <p>There is no guarantees that you will meet popular youtubers, streamers, pro players and game developers during offline events. As much as we are giving special care to our membership owners, we still respect the privacy of our fellow content creators. However, if such opportunity occur, membership owners will be notify and prioratized.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>
              <div class="faq-item">
                <h3><span class="num">4.</span> <span>What if I already ownd games inside the game pass monthly rotation?</span></h3>
                <div class="faq-content">
                  <p>Seems like you already owned one or more games of this month game pass rotation. A special reware will be give to you as you hop into the game. This reward can vary from special quests, special rewards, cosmetics and even boosted rare drops.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>
              <div class="faq-item">
                <h3><span class="num">5.</span> <span>Does the Steam Gaming membership auto-renew before the plan expired?</span></h3>
                <div class="faq-content">
                  <p>To protect our fellow gamers from over-spending, we do not provide auto-renew feature. Owners will be notify when the membership plan is almost expired within 3 days and another push notification when it expired immediately.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Call-to-action Section -->
    <section id="call-to-action" class="call-to-action">
      <img src="assets/cta-bg.jpg" alt="">
      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <h3>Join The Membership</h3>
              <p>Will you answer the call ?</p>
              <a class="cta-btn" href="#pricing">Let's Go</a>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>

  <!-- Footer -->
  <footer id="footer" class="footer">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="Membership.php" class="logo d-flex align-items-center"><span>Steam Gaming</span></a>
          <p>Your all-in-one gaming platform.</p>
          <div class="social-links d-flex mt-4">
            <a href="https://store.steampowered.com/"><i class="bi bi-steam"></i></a>
            <a href="https://twitter.com/Steam"><i class="bi bi-twitter"></i></a>
            <a href="https://www.instagram.com/steamgamingofficial/"><i class="bi bi-instagram"></i></a>
            <a href="https://www.facebook.com/Steam/"><i class="bi bi-facebook"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="Store.php">Store</a></li>
            <li><a href="Membership.php">Membership</a></li>
            <li><a href="About.php">About</a></li>
        </ul>
        </div>
        <div class="col-lg-2 col-6 footer-links">
          <h4>Our features</h4>
          <ul>
            <li><a></a></li>
            <li><a>Game List</a></li>
            <li><a>Game Pass</a></li>
            <li><a>Game News</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>Technology Mara University,</p>
          <p>02600, Arau, Perlis, </p>
          <p>Malaysia.</p>
          <p class="mt-4"><strong>Phone:</strong> <span>+60 12 345 6789</span></p>
          <p><strong>Email:</strong> <span>steamgaming@email.com</span></p>
        </div>
      </div>
    </div>
    
    <!-- We keep this section for copyright purpose-->
    <!--<div class="container copyright text-center mt-4">-->
      <!--<p>&copy; <span>Copyright</span> <strong class="px-1">Append</strong> <span>All Rights Reserved</span></p>-->
      <!--<div class="credits">-->
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        <!--Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>-->
      <!--</div>-->
    <!--</div>-->
    
  </footer>

  <!-- Scroll Top Button -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>

  <!-- Import JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Import Main JS Files -->
  <script src="views/membership/main.js"></script>

</body>
</html> 