<!-- contact.blade.php -->
@extends('layouts.frontend')

@section('title', 'Contact Us - Restoran SUP TULANG ZZ')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">
@endsection

@section('content')
    <!-- ========== HERO SECTION ========== -->
    <section class="hero hero-contact">
        <div class="hero-video">
            <img src="{{ asset('assets/images/Contact.jpeg') }}" alt="Contact Restoran SUP TULANG ZZ">
        </div>
        <div class="hero-overlay">
            <div class="hero-content">
                <h1>Contact Us</h1>
                <p class="hero-subtitle">We'd love to hear from you — let's connect!</p>
            </div>
        </div>
    </section>

    <!-- ========== CONTACT SECTION ========== -->
    <section class="section contact-section">
        <div class="container">
            <div class="contact-layout">
                <!-- Left: Contact Info -->
                <div class="contact-info">
                    <div class="contact-info-header">
                        <h2>Get In Touch</h2>
                        <p>
                            Have a question, feedback, or want to make a reservation?
                            Drop us a message and we'll get back to you within 24 hours.
                            We're always happy to help!
                        </p>
                    </div>

                    <div class="contact-details">
                        <div class="contact-detail-item">
                            <div class="contact-detail-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-detail-text">
                                <h4>Our Location</h4>
                                <p>Jalan Example, Taman Melaka Raya,<br>75000 Melaka, Malaysia</p>
                            </div>
                        </div>

                        <div class="contact-detail-item">
                            <div class="contact-detail-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-detail-text">
                                <h4>Call Us</h4>
                                <p>012-3456789<br>06-123 4567</p>
                            </div>
                        </div>

                        <div class="contact-detail-item">
                            <div class="contact-detail-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-detail-text">
                                <h4>Email Us</h4>
                                <p>info@suptulangzz.com<br>reservations@suptulangzz.com</p>
                            </div>
                        </div>

                        <div class="contact-detail-item">
                            <div class="contact-detail-icon">
                                <i class="far fa-clock"></i>
                            </div>
                            <div class="contact-detail-text">
                                <h4>Opening Hours</h4>
                                <p>Monday - Sunday<br>10:00 AM - 10:00 PM</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="contact-social">
                        <h4>Follow Us</h4>
                        <div class="social-links">
                            <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
                            <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.tiktok.com/en/"><i class="fab fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Right: Contact Form -->
                <div class="contact-form-wrapper">
                    <div class="contact-form-card">
                        <h3>Send Us a Message</h3>
                        <p class="form-subtitle">Fill in the form below and we'll get right back to you ✨</p>

                        <form class="contact-form" id="contactForm">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="fullName">Full Name <span class="required">*</span></label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-user"></i>
                                        <input type="text" id="fullName" name="fullName" placeholder="Your full name"
                                            required>
                                    </div>
                                    <span class="error-message" id="nameError"></span>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email Address <span class="required">*</span></label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-envelope"></i>
                                        <input type="email" id="email" name="email" placeholder="your@email.com" required>
                                    </div>
                                    <span class="error-message" id="emailError"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-phone"></i>
                                    <input type="tel" id="phone" name="phone" placeholder="012-3456789">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <i class="fas fa-tag"></i>
                                    <select id="subject" name="subject" required>
                                        <option value="">Select a topic</option>
                                        <option value="general">General Inquiry</option>
                                        <option value="reservation">Table Reservation</option>
                                        <option value="catering">Catering & Events</option>
                                        <option value="feedback">Feedback & Suggestions</option>
                                        <option value="complaint">Complaint</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <span class="error-message" id="subjectError"></span>
                            </div>

                            <div class="form-group">
                                <label for="message">Your Message <span class="required">*</span></label>
                                <div class="input-wrapper textarea-wrapper">
                                    <i class="fas fa-comment"></i>
                                    <textarea id="message" name="message" rows="5"
                                        placeholder="Tell us how we can help you..." required></textarea>
                                </div>
                                <span class="error-message" id="messageError"></span>
                            </div>

                            <button type="submit" class="btn-submit">
                                <i class="fas fa-paper-plane"></i> Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== SUCCESS MODAL ========== -->
    <div class="modal-overlay" id="successModal" style="display: none;">
        <div class="modal-card success-modal">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2>Message Sent Successfully!</h2>
            <p>Thank you for reaching out! We've received your message and our team will get back to you within <strong>24
                    hours</strong>.</p>
            <p class="success-subtitle">In the meantime, feel free to browse our menu or check out our latest promotions!
            </p>
            <div class="modal-actions">
                <a href="{{ url('menu') }}" class="btn-primary">
                    <i class="fas fa-utensils"></i> Browse Menu
                </a>
                <button class="btn-secondary-modal" id="btnCloseModal">
                    <i class="fas fa-times"></i> Close
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/contact.js') }}"></script>
@endsection