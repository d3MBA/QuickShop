<?php

session_start();
require_once '../template/header.php';
require_once '../template/nav.php';

?>

<div class="page-box">
    <h3>Contact Us</h3>
    <p>If you have any questions:</p>

    <form method="post">
        <div class="mb-3">
            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
        </div>
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Your Email" required>
        </div>
        <div class="mb-3">
            <textarea name="message" class="form-control" rows="3" placeholder="Your Message" required></textarea>
        </div>

        <button class="btn btn-primary">Send Message</button>
    </form>
</div>

<?php require_once '../template/footer.php'; ?>
