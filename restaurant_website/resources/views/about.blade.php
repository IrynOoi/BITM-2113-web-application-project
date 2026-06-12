@extends('layouts.frontend')

@section('title', 'About Us - Restoran SUP TULANG ZZ')

@section('content')
    <!-- ========== HERO SECTION ========== -->
    <section class="hero hero-about">
        <div class="hero-video">
            <img src="{{ asset('assets/images/About.jpeg') }}" alt="Restoran SUP TULANG ZZ Interior">
        </div>
        <div class="hero-overlay">
            <div class="hero-content">
                <h1>About Our Restaurant</h1>
                <p class="hero-subtitle">Discover the story behind our authentic Malaysian cuisine</p>
            </div>
        </div>
    </section>

    <!-- ========== OUR STORY SECTION ========== -->
    <section class="section about-story-section">
        <div class="container">
            <div class="section-header">
                <h2>Our Story</h2>
                <p>How it all began</p>
            </div>
            
            <div class="story-content">
                <p>
                    <strong>Restoran SUP TULANG ZZ</strong> was founded in 2015 with a simple mission: 
                    to serve the most authentic and delicious Sup Tulang (bone marrow soup) in Melaka. 
                    What started as a small family-run stall has grown into one of the most beloved 
                    restaurants in the region.
                </p>
                <p>
                    Our founder, Zulkifli Zainal, learned the art of making Sup Tulang from his grandmother, 
                    who passed down the secret family recipe through generations. Using only the freshest 
                    ingredients and traditional cooking methods, each bowl of soup is slow-cooked for over 
                    8 hours to achieve that rich, flavorful broth our customers love.
                </p>
                <p>
                    Today, we continue to uphold that tradition while expanding our menu to include 
                    a variety of Malaysian favorites — from fragrant Nasi Lemak to spicy Tom Yum Soup. 
                    Every dish is prepared with the same care and passion that started it all.
                </p>
            </div>
        </div>
    </section>

    <!-- ========== VIDEO + FEATURES SECTION ========== -->
    <section class="section about">
        <div class="container">
            <div class="about-grid">
                <div class="about-video">
                    <video poster="{{ asset('assets/images/promo-video-poster.jpeg') }}" controls>
                        <source src="{{ asset('assets/videos/promo.mp4') }}" type="video/mp4">
                        Your browser does not support video.
                    </video>
                </div>
                
                <div class="about-content">
                    <h2>Why Choose Us</h2>
                    <p class="about-story">
                        We take pride in delivering not just meals, but memorable dining experiences. 
                        Every ingredient is handpicked, every recipe is perfected, and every customer 
                        is treated like family.
                    </p>
                    
                    <div class="about-features">
                        <div class="feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Fresh Ingredients Daily</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Halal Certified</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Air-Conditioned Dining</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Family-Friendly Environment</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Online Ordering Available</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Free Wi-Fi</span>
                        </div>
                    </div>
                    
                    <div class="opening-hours">
                        <h3><i class="far fa-clock"></i> Opening Hours</h3>
                        <p>Monday - Sunday: 10:00 AM - 10:00 PM</p>
                        <p class="closed">Closed on Public Holidays</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== OUR VALUES SECTION ========== -->
    <section class="section values-section">
        <div class="container">
            <div class="section-header">
                <h2>Our Values</h2>
                <p>What drives us every day</p>
            </div>
            
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Passion</h3>
                    <p>We pour our heart into every dish we serve, ensuring each bite is filled with love and tradition.</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3>Quality</h3>
                    <p>Only the finest ingredients make it to your plate. We never compromise on quality.</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Community</h3>
                    <p>We believe in bringing people together through food. Our restaurant is a place for everyone.</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3>Tradition</h3>
                    <p>Preserving authentic Malaysian recipes passed down through generations is at our core.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== TEAM SECTION ========== -->
    <section class="section team-section">
        <div class="container">
            <div class="section-header">
                <h2>Meet Our Team</h2>
                <p>The people behind the magic</p>
            </div>
            
            <div class="team-grid">
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('assets/images/Our Team/Chef.jpeg') }}" alt="Chef">
                    </div>
                    <h3>Chef Zulkifli</h3>
                    <span class="team-role">Founder & Head Chef</span>
                </div>
                
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('assets/images/Our Team/Chef.jpeg') }}" alt="Sous Chef">
                    </div>
                    <h3>Chef Khairul</h3>
                    <span class="team-role">Sous Chef</span>
                </div>

                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('assets/images/Our Team/Chef.jpeg') }}" alt="Sous Chef">
                    </div>
                    <h3>Chef Amir</h3>
                    <span class="team-role">Sous Chef</span>
                </div>
                
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('assets/images/Our Team/Manager.jpeg') }}" alt="Manager">
                    </div>
                    <h3>Ms. Aminah</h3>
                    <span class="team-role">Restaurant Manager</span>
                </div>
            </div>
        </div>
    </section>
@endsection
