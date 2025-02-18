<!DOCTYPE html>
<html lang="en">
<!-- Include head.html -->
<?php include 'head.html'; ?>
    <meta charset="utf-8">
    <title>Checkout - Bakery Shop</title>

<body>

 <!-- Include the header -->
 <?php include 'header.html'; ?>

<div class="container my-5">
    <h2>Checkout</h2>

    <form action="process_order.php" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" id="address" name="address" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" id="city" name="city" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="tel" id="contact_number" name="contact_number" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Place Order</button>
    </form>
</div>

 <!-- Include the footer -->
<?php include 'footer.html'; ?>
</body>
</html>
