<h2>Add New Order</h2>
<form action="/manga_shop/orders/store" method="POST">
    <div class="form-group">
        <label for="user_id">User ID</label>
        <input type="number" class="form-control" name="user_id" placeholder="Enter User ID" required>
    </div>
    <div class="form-group">
        <label for="customer_name">Customer Name</label>
        <input type="text" class="form-control" name="customer_name" placeholder="Enter Customer Name" required>
    </div>
    <div class="form-group">
        <label for="customer_email">Customer Email</label>
        <input type="email" class="form-control" name="customer_email" placeholder="Enter Customer Email" required>
    </div>
    <div class="form-group">
        <label for="customer_phone">Customer Phone</label>
        <input type="text" class="form-control" name="customer_phone" placeholder="Enter Customer Phone" required>
    </div>
    <div class="form-group">
        <label for="total_amount">Total Amount</label>
        <input type="number" class="form-control" name="total_amount" placeholder="Enter Total Amount" required>
    </div>
    <div class="form-group">
        <label for="payment_method">Payment Method</label>
        <select name="payment_method" class="form-control">
            <option value="credit_card">Credit Card</option>
            <option value="paypal">PayPal</option>
            <option value="bank_transfer">Bank Transfer</option>
            <option value="cash_on_delivery">Cash on Delivery</option>
        </select>
    </div>
    <div class="form-group">
        <label for="shipping_address">Shipping Address</label>
        <textarea class="form-control" name="shipping_address" placeholder="Enter Shipping Address" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add Order</button>
</form>
