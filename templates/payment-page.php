<?php
/**
 * Template Name: Payment Page
 * Secure payment processing interface
 */

get_header();

$payment_token = $_GET['token'] ?? '';
$order = null;

if ($payment_token) {
    $orders = get_posts(array(
        'post_type' => 'payment_order',
        'meta_query' => array(
            array(
                'key' => '_payment_token',
                'value' => $payment_token,
                'compare' => '='
            )
        ),
        'post_status' => 'pending'
    ));

    if (!empty($orders)) {
        $order = $orders[0];
    }
}

if (!$order) {
    wp_redirect(home_url());
    exit;
}

$amount = get_post_meta($order->ID, '_amount', true);
$service_type = get_post_meta($order->ID, '_service_type', true);
$client_name = get_post_meta($order->ID, '_client_name', true);
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Payment Header -->
            <div class="payment-header text-center mb-5">
                <div class="payment-logo mb-3">
                    <i class="fas fa-shield-alt fa-3x text-primary"></i>
                </div>
                <h1 class="h2 text-primary">Secure Payment</h1>
                <p class="text-muted">Complete your payment securely with SSL encryption</p>
            </div>

            <div class="row">
                <!-- Order Summary -->
                <div class="col-md-5 mb-4">
                    <div class="card order-summary">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-receipt me-2"></i>Order Summary
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="order-item d-flex justify-content-between mb-3">
                                <div>
                                    <h6 class="mb-1"><?php echo esc_html($service_type); ?></h6>
                                    <small class="text-muted">For: <?php echo esc_html($client_name); ?></small>
                                </div>
                            </div>

                            <hr>

                            <div class="total-amount d-flex justify-content-between">
                                <strong>Total Amount:</strong>
                                <strong class="text-primary h4">$<?php echo number_format($amount, 2); ?></strong>
                            </div>

                            <div class="security-badges mt-4">
                                <div class="text-center">
                                    <small class="text-muted d-block mb-2">Secured by:</small>
                                    <div class="d-flex justify-content-center gap-3">
                                        <i class="fab fa-cc-visa fa-2x text-primary"></i>
                                        <i class="fab fa-cc-mastercard fa-2x text-warning"></i>
                                        <i class="fab fa-cc-amex fa-2x text-info"></i>
                                        <i class="fas fa-lock fa-2x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="trust-indicators mt-4">
                        <div class="row text-center">
                            <div class="col-4">
                                <i class="fas fa-shield-alt fa-2x text-success mb-2"></i>
                                <small class="d-block">SSL Secured</small>
                            </div>
                            <div class="col-4">
                                <i class="fas fa-user-shield fa-2x text-primary mb-2"></i>
                                <small class="d-block">Privacy Protected</small>
                            </div>
                            <div class="col-4">
                                <i class="fas fa-certificate fa-2x text-warning mb-2"></i>
                                <small class="d-block">PCI Compliant</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Form -->
                <div class="col-md-7">
                    <div class="card payment-form">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-credit-card me-2"></i>Payment Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="payment-form">
                                <!-- Payment Method Selection -->
                                <div class="mb-4">
                                    <label class="form-label">Payment Method</label>
                                    <div class="payment-methods">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method" id="credit_card" value="credit_card" checked>
                                            <label class="form-check-label d-flex align-items-center" for="credit_card">
                                                <i class="fas fa-credit-card me-2"></i>
                                                Credit/Debit Card
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer">
                                            <label class="form-check-label d-flex align-items-center" for="bank_transfer">
                                                <i class="fas fa-university me-2"></i>
                                                Bank Transfer
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Credit Card Details -->
                                <div id="credit-card-fields">
                                    <div class="mb-3">
                                        <label for="card_name" class="form-label">Cardholder Name</label>
                                        <input type="text" class="form-control" id="card_name" name="card_name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="card_number" class="form-label">Card Number</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" maxlength="19" required>
                                            <span class="input-group-text">
                                                <i class="fas fa-credit-card"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="card_expiry" class="form-label">Expiry Date</label>
                                                <input type="text" class="form-control" id="card_expiry" name="card_expiry" placeholder="MM/YY" maxlength="5" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="card_cvc" class="form-label">CVC</label>
                                                <input type="text" class="form-control" id="card_cvc" name="card_cvc" placeholder="123" maxlength="4" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bank Transfer Details -->
                                <div id="bank-transfer-fields" style="display: none;">
                                    <div class="alert alert-info">
                                        <h6><i class="fas fa-info-circle me-2"></i>Bank Transfer Instructions</h6>
                                        <p class="mb-2">Please transfer the payment to our account:</p>
                                        <strong>Bank:</strong> Bank Hapoalim<br>
                                        <strong>Account:</strong> 123-456-789<br>
                                        <strong>SWIFT:</strong> POALILIT<br>
                                        <strong>Reference:</strong> <?php echo $order->ID; ?>
                                    </div>
                                </div>

                                <!-- Billing Address -->
                                <div class="billing-address mb-4">
                                    <h6 class="mb-3">Billing Address</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="billing_country" class="form-label">Country</label>
                                                <select class="form-select" id="billing_country" name="billing_country" required>
                                                    <option value="">Select Country</option>
                                                    <option value="US">United States</option>
                                                    <option value="CA">Canada</option>
                                                    <option value="IL" selected>Israel</option>
                                                    <option value="GB">United Kingdom</option>
                                                    <option value="DE">Germany</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="billing_zip" class="form-label">ZIP/Postal Code</label>
                                                <input type="text" class="form-control" id="billing_zip" name="billing_zip" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Terms and Conditions -->
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms_agreed" name="terms_agreed" required>
                                        <label class="form-check-label" for="terms_agreed">
                                            I agree to the <a href="<?php echo home_url('/terms/'); ?>" target="_blank">Terms of Service</a> and <a href="<?php echo home_url('/privacy/'); ?>" target="_blank">Privacy Policy</a>
                                        </label>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary btn-lg w-100" id="submit-payment">
                                    <i class="fas fa-lock me-2"></i>
                                    Complete Secure Payment - $<?php echo number_format($amount, 2); ?>
                                </button>

                                <input type="hidden" name="payment_token" value="<?php echo esc_attr($payment_token); ?>">
                                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('bridgeland_nonce'); ?>">
                            </form>
                        </div>
                    </div>

                    <!-- Security Notice -->
                    <div class="security-notice mt-3">
                        <small class="text-muted">
                            <i class="fas fa-shield-alt me-1"></i>
                            Your payment information is encrypted and secure. We never store your credit card details.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.payment-header .payment-logo i {
    color: var(--color-maroon);
}

.order-summary {
    border: 2px solid #e9ecef;
}

.card-header {
    background-color: #f8f9fa !important;
    border-bottom: 1px solid #dee2e6;
}

.payment-methods .form-check {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 10px;
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.payment-methods .form-check:hover {
    border-color: var(--color-maroon);
}

.payment-methods .form-check-input:checked + .form-check-label {
    color: var(--color-maroon);
    font-weight: 500;
}

.form-control:focus {
    border-color: var(--color-maroon);
    box-shadow: 0 0 0 0.2rem rgba(139, 0, 0, 0.25);
}

.btn-primary {
    background-color: var(--color-maroon);
    border-color: var(--color-maroon);
    padding: 15px;
    font-weight: 500;
}

.btn-primary:hover {
    background-color: var(--color-maroon-dark);
    border-color: var(--color-maroon-dark);
}

.trust-indicators i {
    opacity: 0.7;
}

.security-badges i {
    opacity: 0.6;
    margin: 0 5px;
}

#card_number {
    font-family: monospace;
    letter-spacing: 1px;
}

.loading {
    opacity: 0.6;
    pointer-events: none;
}

@media (max-width: 768px) {
    .container {
        padding: 0 15px;
    }

    .payment-header h1 {
        font-size: 1.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const paymentForm = document.getElementById('payment-form');
    const submitButton = document.getElementById('submit-payment');
    const cardFields = document.getElementById('credit-card-fields');
    const bankFields = document.getElementById('bank-transfer-fields');
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');

    // Payment method switching
    paymentMethods.forEach(method => {
        method.addEventListener('change', function() {
            if (this.value === 'credit_card') {
                cardFields.style.display = 'block';
                bankFields.style.display = 'none';
            } else {
                cardFields.style.display = 'none';
                bankFields.style.display = 'block';
            }
        });
    });

    // Card number formatting
    document.getElementById('card_number').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\s/g, '').replace(/[^0-9]/gi, '');
        let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
        e.target.value = formattedValue;
    });

    // Expiry date formatting
    document.getElementById('card_expiry').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 2) {
            value = value.substring(0, 2) + '/' + value.substring(2, 4);
        }
        e.target.value = value;
    });

    // CVC validation
    document.getElementById('card_cvc').addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
    });

    // Form submission
    paymentForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const selectedMethod = document.querySelector('input[name="payment_method"]:checked').value;

        if (selectedMethod === 'bank_transfer') {
            // Handle bank transfer
            alert('Bank transfer instructions have been provided. Please complete the transfer and contact us for confirmation.');
            return;
        }

        // Validate credit card
        if (!validateCreditCard()) {
            return;
        }

        // Show loading state
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
        submitButton.disabled = true;
        paymentForm.classList.add('loading');

        // Process payment
        const formData = new FormData(paymentForm);
        formData.append('action', 'process_payment');

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.data.redirect_url;
            } else {
                alert('Payment failed: ' + data.data);
                resetForm();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
            resetForm();
        });
    });

    function validateCreditCard() {
        const cardNumber = document.getElementById('card_number').value.replace(/\s/g, '');
        const cardExpiry = document.getElementById('card_expiry').value;
        const cardCvc = document.getElementById('card_cvc').value;
        const cardName = document.getElementById('card_name').value;

        if (cardNumber.length < 13 || cardNumber.length > 19) {
            alert('Please enter a valid card number');
            return false;
        }

        if (!/^\d{2}\/\d{2}$/.test(cardExpiry)) {
            alert('Please enter a valid expiry date (MM/YY)');
            return false;
        }

        if (cardCvc.length < 3 || cardCvc.length > 4) {
            alert('Please enter a valid CVC');
            return false;
        }

        if (cardName.trim().length < 2) {
            alert('Please enter the cardholder name');
            return false;
        }

        return true;
    }

    function resetForm() {
        submitButton.innerHTML = '<i class="fas fa-lock me-2"></i>Complete Secure Payment - $<?php echo number_format($amount, 2); ?>';
        submitButton.disabled = false;
        paymentForm.classList.remove('loading');
    }
});
</script>

<?php get_footer(); ?>