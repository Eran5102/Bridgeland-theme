<?php
/**
 * Client Dashboard Template
 * Main dashboard interface for clients to access their valuations and documents
 */

$current_user = wp_get_current_user();
$client_valuations = bridgeland_get_client_valuations($current_user->ID);
$client_documents = bridgeland_get_client_documents($current_user->ID);
$client_tickets = bridgeland_get_client_tickets($current_user->ID);

// Calculate statistics
$active_valuations = 0;
$total_value = 0;
foreach ($client_valuations as $valuation) {
    $status = get_post_meta($valuation->ID, '_valuation_status', true);
    if ($status === 'delivered' || $status === 'completed') {
        $active_valuations++;
        $amount = get_post_meta($valuation->ID, '_valuation_amount', true);
        $total_value += floatval($amount);
    }
}
?>

<div class="client-dashboard">
    <!-- Welcome Header -->
    <div class="dashboard-header bg-gradient-primary text-white p-5 rounded-3 mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-5 fw-bold mb-3">Welcome back, <?php echo esc_html($current_user->display_name); ?>!</h1>
                <p class="lead mb-0">Access your valuations, documents, and support resources all in one place.</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="<?php echo home_url('/contact/'); ?>" class="btn btn-light btn-lg">
                    <i class="fas fa-plus-circle me-2"></i>Request New Valuation
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="dashboard-stats row g-4 mb-5">
        <div class="col-md-3">
            <div class="stat-card card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-chart-line fa-3x text-primary"></i>
                    </div>
                    <h3 class="stat-value text-primary"><?php echo count($client_valuations); ?></h3>
                    <p class="stat-label text-muted mb-0">Total Valuations</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-check-circle fa-3x text-success"></i>
                    </div>
                    <h3 class="stat-value text-success"><?php echo $active_valuations; ?></h3>
                    <p class="stat-label text-muted mb-0">Active Reports</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-folder fa-3x text-info"></i>
                    </div>
                    <h3 class="stat-value text-info"><?php echo count($client_documents); ?></h3>
                    <p class="stat-label text-muted mb-0">Documents</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-headset fa-3x text-warning"></i>
                    </div>
                    <h3 class="stat-value text-warning">
                        <?php
                        $open_tickets = array_filter($client_tickets, function($ticket) {
                            return get_post_meta($ticket->ID, '_ticket_status', true) !== 'closed';
                        });
                        echo count($open_tickets);
                        ?>
                    </h3>
                    <p class="stat-label text-muted mb-0">Open Tickets</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Tabs -->
    <div class="dashboard-content">
        <ul class="nav nav-tabs nav-pills mb-4" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#valuations" role="tab">
                    <i class="fas fa-chart-bar me-2"></i>Valuations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#documents" role="tab">
                    <i class="fas fa-file-alt me-2"></i>Documents
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#support" role="tab">
                    <i class="fas fa-life-ring me-2"></i>Support
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab">
                    <i class="fas fa-user me-2"></i>Profile
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <!-- Valuations Tab -->
            <div class="tab-pane fade show active" id="valuations" role="tabpanel">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">
                            <i class="fas fa-chart-bar me-2 text-primary"></i>Your Valuations
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php if ($client_valuations) : ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Company</th>
                                            <th>Type</th>
                                            <th>Valuation Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($client_valuations as $valuation) :
                                            $company = get_post_meta($valuation->ID, '_company_name', true);
                                            $type = get_post_meta($valuation->ID, '_valuation_type', true);
                                            $date = get_post_meta($valuation->ID, '_valuation_date', true);
                                            $amount = get_post_meta($valuation->ID, '_valuation_amount', true);
                                            $status = get_post_meta($valuation->ID, '_valuation_status', true);
                                            $report_url = get_post_meta($valuation->ID, '_report_url', true);
                                        ?>
                                            <tr>
                                                <td><strong><?php echo esc_html($company); ?></strong></td>
                                                <td>
                                                    <span class="badge bg-light text-dark">
                                                        <?php echo ucwords(str_replace('_', ' ', $type)); ?>
                                                    </span>
                                                </td>
                                                <td><?php echo $date ? date('M d, Y', strtotime($date)) : 'N/A'; ?></td>
                                                <td>$<?php echo number_format(floatval($amount), 0); ?></td>
                                                <td>
                                                    <?php
                                                    $status_class = 'secondary';
                                                    if ($status === 'completed' || $status === 'delivered') $status_class = 'success';
                                                    elseif ($status === 'in_progress') $status_class = 'warning';
                                                    ?>
                                                    <span class="badge bg-<?php echo $status_class; ?>">
                                                        <?php echo ucwords(str_replace('_', ' ', $status)); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <button class="btn btn-outline-primary" onclick="viewValuation(<?php echo $valuation->ID; ?>)">
                                                            <i class="fas fa-eye"></i> View
                                                        </button>
                                                        <?php if ($report_url) : ?>
                                                            <a href="<?php echo esc_url($report_url); ?>" class="btn btn-outline-success" download>
                                                                <i class="fas fa-download"></i> Download
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else : ?>
                            <div class="text-center py-5">
                                <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
                                <h5>No valuations yet</h5>
                                <p class="text-muted">Request your first valuation to get started.</p>
                                <a href="<?php echo home_url('/contact/'); ?>" class="btn btn-primary">
                                    Request Valuation
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Documents Tab -->
            <div class="tab-pane fade" id="documents" role="tabpanel">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-file-alt me-2 text-primary"></i>Your Documents
                        </h4>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadDocumentModal">
                            <i class="fas fa-upload me-2"></i>Upload Document
                        </button>
                    </div>
                    <div class="card-body">
                        <?php if ($client_documents) : ?>
                            <div class="row g-3">
                                <?php foreach ($client_documents as $document) :
                                    $doc_type = get_post_meta($document->ID, '_document_type', true);
                                    $file_url = get_post_meta($document->ID, '_file_url', true);
                                    $upload_date = get_post_meta($document->ID, '_upload_date', true);
                                    $expiry_date = get_post_meta($document->ID, '_expiry_date', true);

                                    $icon = 'file-alt';
                                    if ($doc_type === 'report') $icon = 'chart-bar';
                                    elseif ($doc_type === 'financial') $icon = 'dollar-sign';
                                    elseif ($doc_type === 'legal') $icon = 'gavel';
                                    elseif ($doc_type === 'certificate') $icon = 'certificate';
                                ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="document-card card h-100">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start mb-3">
                                                    <div class="document-icon me-3">
                                                        <i class="fas fa-<?php echo $icon; ?> fa-2x text-primary"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1"><?php echo get_the_title($document->ID); ?></h6>
                                                        <small class="text-muted">
                                                            <?php echo ucwords(str_replace('_', ' ', $doc_type)); ?>
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class="document-meta">
                                                    <small class="text-muted d-block mb-1">
                                                        <i class="fas fa-calendar me-1"></i>
                                                        Uploaded: <?php echo $upload_date ? date('M d, Y', strtotime($upload_date)) : 'N/A'; ?>
                                                    </small>
                                                    <?php if ($expiry_date) : ?>
                                                        <small class="text-warning d-block mb-2">
                                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                                            Expires: <?php echo date('M d, Y', strtotime($expiry_date)); ?>
                                                        </small>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="document-actions">
                                                    <?php if ($file_url) : ?>
                                                        <a href="<?php echo esc_url($file_url); ?>" class="btn btn-outline-primary btn-sm" download>
                                                            <i class="fas fa-download me-1"></i>Download
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <div class="text-center py-5">
                                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                <h5>No documents uploaded</h5>
                                <p class="text-muted">Upload your first document to keep everything organized.</p>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadDocumentModal">
                                    <i class="fas fa-upload me-2"></i>Upload Document
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Support Tab -->
            <div class="tab-pane fade" id="support" role="tabpanel">
                <div class="row">
                    <!-- Support Tickets -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">
                                    <i class="fas fa-headset me-2 text-primary"></i>Support Tickets
                                </h4>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#newTicketModal">
                                    <i class="fas fa-plus me-2"></i>New Ticket
                                </button>
                            </div>
                            <div class="card-body">
                                <?php if ($client_tickets) : ?>
                                    <div class="ticket-list">
                                        <?php foreach (array_slice($client_tickets, 0, 5) as $ticket) :
                                            $priority = get_post_meta($ticket->ID, '_ticket_priority', true);
                                            $status = get_post_meta($ticket->ID, '_ticket_status', true);
                                            $category = get_post_meta($ticket->ID, '_ticket_category', true);
                                        ?>
                                            <div class="ticket-item border-bottom pb-3 mb-3">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h6 class="mb-1">
                                                            <a href="#" onclick="viewTicket(<?php echo $ticket->ID; ?>); return false;">
                                                                <?php echo get_the_title($ticket->ID); ?>
                                                            </a>
                                                        </h6>
                                                        <small class="text-muted">
                                                            #<?php echo $ticket->ID; ?> •
                                                            <?php echo ucwords($category); ?> •
                                                            <?php echo human_time_diff(strtotime($ticket->post_date), current_time('timestamp')); ?> ago
                                                        </small>
                                                    </div>
                                                    <div>
                                                        <?php
                                                        $status_class = 'secondary';
                                                        if ($status === 'resolved' || $status === 'closed') $status_class = 'success';
                                                        elseif ($status === 'open') $status_class = 'warning';
                                                        ?>
                                                        <span class="badge bg-<?php echo $status_class; ?>">
                                                            <?php echo ucwords(str_replace('_', ' ', $status)); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else : ?>
                                    <div class="text-center py-4">
                                        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                                        <h5>No support tickets</h5>
                                        <p class="text-muted">Everything looks good! Contact us if you need help.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Help -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-question-circle me-2 text-info"></i>Quick Help
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <a href="<?php echo home_url('/faq/'); ?>" class="list-group-item list-group-item-action">
                                        <i class="fas fa-book me-2"></i>FAQ & Documentation
                                    </a>
                                    <a href="<?php echo home_url('/resources/'); ?>" class="list-group-item list-group-item-action">
                                        <i class="fas fa-graduation-cap me-2"></i>Learning Resources
                                    </a>
                                    <a href="<?php echo home_url('/calculators/'); ?>" class="list-group-item list-group-item-action">
                                        <i class="fas fa-calculator me-2"></i>Valuation Calculators
                                    </a>
                                    <a href="mailto:support@bridgeland-advisors.com" class="list-group-item list-group-item-action">
                                        <i class="fas fa-envelope me-2"></i>Email Support
                                    </a>
                                    <a href="tel:+972506842937" class="list-group-item list-group-item-action">
                                        <i class="fas fa-phone me-2"></i>Call Support
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Tab -->
            <div class="tab-pane fade" id="profile" role="tabpanel">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">
                            <i class="fas fa-user me-2 text-primary"></i>Profile Settings
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="profile-form">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" value="<?php echo esc_attr($current_user->display_name); ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="<?php echo esc_attr($current_user->user_email); ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Company</label>
                                    <input type="text" class="form-control" value="<?php echo esc_attr(get_user_meta($current_user->ID, 'company_name', true)); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="tel" class="form-control" value="<?php echo esc_attr(get_user_meta($current_user->ID, 'phone', true)); ?>">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email Notifications</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="notify_valuations" checked>
                                        <label class="form-check-label" for="notify_valuations">
                                            Valuation updates and completions
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="notify_documents" checked>
                                        <label class="form-check-label" for="notify_documents">
                                            New document uploads
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="notify_newsletter">
                                        <label class="form-check-label" for="notify_newsletter">
                                            Newsletter and insights
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Save Changes
                                    </button>
                                    <a href="<?php echo wp_lostpassword_url(); ?>" class="btn btn-outline-secondary ms-2">
                                        <i class="fas fa-key me-2"></i>Change Password
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Ticket Modal -->
<div class="modal fade" id="newTicketModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Support Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="new-ticket-form">
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select" id="ticket_category" required>
                            <option value="">Select category...</option>
                            <option value="valuation">Valuation Question</option>
                            <option value="technical">Technical Issue</option>
                            <option value="billing">Billing</option>
                            <option value="general">General Inquiry</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" class="form-control" id="ticket_title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" id="ticket_message" rows="5" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitTicket()">
                    <i class="fas fa-paper-plane me-2"></i>Submit Ticket
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Upload Document Modal -->
<div class="modal fade" id="uploadDocumentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="upload-document-form">
                    <div class="mb-3">
                        <label class="form-label">Document Type</label>
                        <select class="form-select" required>
                            <option value="">Select type...</option>
                            <option value="financial">Financial Statement</option>
                            <option value="legal">Legal Document</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Document Title</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select File</label>
                        <input type="file" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-upload me-2"></i>Upload
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, var(--color-maroon) 0%, var(--color-maroon-dark) 100%);
}

.stat-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.nav-tabs .nav-link {
    color: var(--color-gray-600);
    font-weight: 500;
    border: none;
    padding: 0.75rem 1.5rem;
}

.nav-tabs .nav-link.active {
    color: var(--color-maroon);
    background: transparent;
    border-bottom: 3px solid var(--color-maroon);
}

.document-card {
    transition: transform 0.2s ease;
}

.document-card:hover {
    transform: translateY(-3px);
}

.ticket-item h6 a {
    color: inherit;
    text-decoration: none;
}

.ticket-item h6 a:hover {
    color: var(--color-maroon);
}
</style>

<script>
function submitTicket() {
    const category = document.getElementById('ticket_category').value;
    const title = document.getElementById('ticket_title').value;
    const message = document.getElementById('ticket_message').value;

    if (!category || !title || !message) {
        alert('Please fill in all fields');
        return;
    }

    // AJAX submission would go here
    jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'POST',
        data: {
            action: 'submit_ticket',
            nonce: '<?php echo wp_create_nonce('client_portal_nonce'); ?>',
            category: category,
            title: title,
            message: message
        },
        success: function(response) {
            if (response.success) {
                alert('Ticket submitted successfully!');
                location.reload();
            }
        }
    });
}

function viewValuation(id) {
    // Implementation for viewing valuation details
    console.log('Viewing valuation:', id);
}

function viewTicket(id) {
    // Implementation for viewing ticket details
    console.log('Viewing ticket:', id);
}
</script>