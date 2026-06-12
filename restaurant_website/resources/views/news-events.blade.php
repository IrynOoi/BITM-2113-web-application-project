@extends('layouts.frontend')

@section('title', 'News & Events - Restoran SUP TULANG ZZ')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/news-events.css') }}">
@endsection

@section('content')
    <!-- ========== NEWS & EVENTS CONTENT ========== -->
    <main class="news-page">
        <div class="container">
            <!-- Page Header -->
            <div class="news-page-header">
                <h1>News & Events</h1>
                <p>Stay updated with our latest promotions, events, and announcements</p>
            </div>
            
            <!-- Filter Tabs -->
            <div class="news-filter">
                <button class="news-filter-btn active" data-filter="all">All</button>
                <button class="news-filter-btn" data-filter="promotion">
                    <i class="fas fa-tag"></i> Promotions
                </button>
                <button class="news-filter-btn" data-filter="event">
                    <i class="fas fa-calendar-alt"></i> Events
                </button>
                <button class="news-filter-btn" data-filter="announcement">
                    <i class="fas fa-bullhorn"></i> Announcements
                </button>
            </div>
            
            <!-- Featured Banner -->
            <div class="featured-event">
                <div class="featured-event-image">
                    <img src="{{ asset('assets/images/Slider/Slide1.jpeg') }}" alt="Featured Event">
                </div>
                <div class="featured-event-content">
                    <span class="event-badge event-badge-featured">⭐ Featured</span>
                    <span class="event-category">Promotion</span>
                    <h2>🎉 Grand Opening Special - 20% OFF!</h2>
                    <p class="event-date"><i class="far fa-calendar-alt"></i> May 20 - June 30, 2026</p>
                    <p class="event-excerpt">
                        Join us in celebrating our grand opening! Enjoy 20% off on all menu items. 
                        Bring your family and friends for an unforgettable dining experience.
                    </p>
                    <a href="#" class="btn-read-more">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            
            <!-- News Cards Grid -->
            <div class="news-grid" id="newsGrid">
                <!-- Card 1: Promotion -->
                <div class="news-card" data-category="promotion">
                    <div class="news-card-image">
                        <img src="{{ asset('assets/images/Slider/Slide2.jpeg') }}" alt="Lunch Promotion">
                        <span class="event-category">Promotion</span>
                    </div>
                    <div class="news-card-body">
                        <p class="news-card-date"><i class="far fa-clock"></i> June 1 - July 15, 2026</p>
                        <h3>🍜 Lunch Set from RM 9.90</h3>
                        <p class="news-card-text">
                            Enjoy our special lunch sets every weekday from 11AM to 2PM. 
                            Choose from 5 delicious combinations!
                        </p>
                        <a href="#" class="news-card-link">View Details <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                
                <!-- Card 2: Event -->
                <div class="news-card" data-category="event">
                    <div class="news-card-image">
                        <img src="{{ asset('assets/images/Slider/Slide3.jpeg') }}" alt="Cooking Workshop">
                        <span class="event-category">Event</span>
                    </div>
                    <div class="news-card-body">
                        <p class="news-card-date"><i class="far fa-clock"></i> June 25, 2026</p>
                        <h3>👨‍🍳 Live Cooking Workshop</h3>
                        <p class="news-card-text">
                            Learn to cook our signature Sup Tulang! Limited to 20 participants. 
                            Includes free lunch and recipe book.
                        </p>
                        <a href="#" class="news-card-link">Register Now <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                
                <!-- Card 3: Announcement -->
                <div class="news-card" data-category="announcement">
                    <div class="news-card-image">
                        <img src="{{ asset('assets/images/Slider/Slide4.jpeg') }}" alt="Online Ordering">
                        <span class="event-category">Announcement</span>
                    </div>
                    <div class="news-card-body">
                        <p class="news-card-date"><i class="far fa-clock"></i> June 10, 2026</p>
                        <h3>📱 Online Ordering Now Available!</h3>
                        <p class="news-card-text">
                            You can now order your favorite dishes online for pickup or delivery. 
                            Scan the QR code at your table too!
                        </p>
                        <a href="{{ url('menu') }}" class="news-card-link">Order Now <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                
                <!-- Card 4: Promotion -->
                <div class="news-card" data-category="promotion">
                    <div class="news-card-image">
                        <img src="{{ asset('assets/images/Slider/Slide5.jpeg') }}" alt="Family Deal">
                        <span class="event-category">Promotion</span>
                    </div>
                    <div class="news-card-body">
                        <p class="news-card-date"><i class="far fa-clock"></i> Weekends Only</p>
                        <h3>👨‍👩‍👧‍👦 Family Platter - RM 49.90</h3>
                        <p class="news-card-text">
                            Perfect for 4 persons! Includes 2 main courses, 2 drinks, and 1 dessert. 
                            Available every weekend.
                        </p>
                        <a href="#" class="news-card-link">View Details <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                
                <!-- Card 5: Event -->
                <div class="news-card" data-category="event">
                    <div class="news-card-image">
                        <img src="{{ asset('assets/images/Slider/Slide6.jpeg') }}" alt="Hari Raya Special">
                        <span class="event-category">Event</span>
                    </div>
                    <div class="news-card-body">
                        <p class="news-card-date"><i class="far fa-clock"></i> June 17, 2026</p>
                        <h3>🌙 Hari Raya Buffet Dinner</h3>
                        <p class="news-card-text">
                            Celebrate Hari Raya with our special buffet dinner. Over 30 dishes, 
                            live music, and door gifts for early birds!
                        </p>
                        <a href="#" class="news-card-link">Book Now <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                
                <!-- Card 6: Announcement -->
                <div class="news-card" data-category="announcement">
                    <div class="news-card-image">
                        <img src="{{ asset('assets/images/Slider/Slide7.jpeg') }}" alt="New Branch">
                        <span class="event-category">Announcement</span>
                    </div>
                    <div class="news-card-body">
                        <p class="news-card-date"><i class="far fa-clock"></i> Coming Soon</p>
                        <h3>📍 New Branch Opening in Melaka Raya!</h3>
                        <p class="news-card-text">
                            We're expanding! Our new branch will open next month. 
                            Stay tuned for the exact opening date and special offers.
                        </p>
                        <a href="#" class="news-card-link">Learn More <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- No Results -->
            <div class="news-no-results" id="newsNoResults" style="display: none;">
                <i class="fas fa-newspaper"></i>
                <h3>No news found</h3>
                <p>Check back soon for updates!</p>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/news-events.js') }}"></script>
@endsection
