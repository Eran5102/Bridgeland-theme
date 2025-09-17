/**
 * Bridgeland Admin JavaScript
 */

jQuery(document).ready(function($) {

    // Initialize Charts
    initializeCharts();

    // Client Status Updates
    $('.client-status').on('change', function() {
        const clientId = $(this).data('client-id');
        const status = $(this).val();
        updateClientStatus(clientId, status);
    });

    // Project Status Updates
    $('.project-status').on('change', function() {
        const projectId = $(this).data('project-id');
        const status = $(this).val();
        updateProjectStatus(projectId, status);
    });

    // Search Functionality
    $('#client-search').on('input', function() {
        const searchTerm = $(this).val().toLowerCase();
        filterClientTable(searchTerm);
    });

    // Export Clients
    $('#export-clients').on('click', function() {
        exportClients();
    });

    // Send Newsletter
    $('#send-newsletter').on('click', function() {
        sendNewsletter();
    });

    // Project Filters
    $('#filter-status, #filter-service, #filter-date-from, #filter-date-to').on('change', function() {
        filterProjects();
    });

    // Auto-refresh stats every 30 seconds
    setInterval(refreshStats, 30000);
});

/**
 * Initialize Dashboard Charts
 */
function initializeCharts() {
    // Revenue Chart
    const revenueCtx = document.getElementById('revenue-chart');
    if (revenueCtx) {
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Revenue',
                    data: [15000, 22000, 18000, 28000, 35000, 42000],
                    borderColor: '#8B0000',
                    backgroundColor: 'rgba(139, 0, 0, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    }

    // Project Status Chart
    const projectCtx = document.getElementById('project-status-chart');
    if (projectCtx) {
        new Chart(projectCtx, {
            type: 'doughnut',
            data: {
                labels: ['Initiated', 'In Progress', 'Under Review', 'Completed'],
                datasets: [{
                    data: [5, 12, 3, 18],
                    backgroundColor: [
                        '#ffc107',
                        '#17a2b8',
                        '#fd7e14',
                        '#28a745'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }
}

/**
 * Update Client Status
 */
function updateClientStatus(clientId, status) {
    jQuery.ajax({
        url: bridgeland_admin.ajax_url,
        type: 'POST',
        data: {
            action: 'update_client_status',
            client_id: clientId,
            status: status,
            nonce: bridgeland_admin.nonce
        },
        success: function(response) {
            if (response.success) {
                showNotification('Client status updated successfully', 'success');
            } else {
                showNotification('Failed to update client status', 'error');
            }
        },
        error: function() {
            showNotification('An error occurred', 'error');
        }
    });
}

/**
 * Update Project Status
 */
function updateProjectStatus(projectId, status) {
    jQuery.ajax({
        url: bridgeland_admin.ajax_url,
        type: 'POST',
        data: {
            action: 'update_project_status',
            project_id: projectId,
            status: status,
            nonce: bridgeland_admin.nonce
        },
        success: function(response) {
            if (response.success) {
                showNotification('Project status updated successfully', 'success');
                // Update progress bar if needed
                updateProgressBar(projectId, status);
            } else {
                showNotification('Failed to update project status', 'error');
            }
        },
        error: function() {
            showNotification('An error occurred', 'error');
        }
    });
}

/**
 * Filter Client Table
 */
function filterClientTable(searchTerm) {
    jQuery('tbody tr').each(function() {
        const clientName = jQuery(this).find('td:first-child strong').text().toLowerCase();
        const clientEmail = jQuery(this).find('td:nth-child(2)').text().toLowerCase();
        const companyName = jQuery(this).find('.client-meta').text().toLowerCase();

        if (clientName.includes(searchTerm) ||
            clientEmail.includes(searchTerm) ||
            companyName.includes(searchTerm)) {
            jQuery(this).show();
        } else {
            jQuery(this).hide();
        }
    });
}

/**
 * Filter Projects
 */
function filterProjects() {
    const status = jQuery('#filter-status').val();
    const service = jQuery('#filter-service').val();
    const dateFrom = jQuery('#filter-date-from').val();
    const dateTo = jQuery('#filter-date-to').val();

    jQuery('tbody tr').each(function() {
        let show = true;

        // Status filter
        if (status && jQuery(this).find('.project-status').val() !== status) {
            show = false;
        }

        // Service filter
        if (service && !jQuery(this).find('td:nth-child(3)').text().toLowerCase().includes(service)) {
            show = false;
        }

        // Date filters
        const projectDate = jQuery(this).find('.project-meta').text().match(/\d{4}-\d{2}-\d{2}/);
        if (projectDate) {
            const date = new Date(projectDate[0]);
            if (dateFrom && date < new Date(dateFrom)) show = false;
            if (dateTo && date > new Date(dateTo)) show = false;
        }

        jQuery(this).toggle(show);
    });
}

/**
 * Export Clients
 */
function exportClients() {
    const button = jQuery('#export-clients');
    button.prop('disabled', true).text('Exporting...');

    // Create CSV data
    let csvContent = "data:text/csv;charset=utf-8,";
    csvContent += "Name,Email,Company,Registration Date,Projects,Status,Total Paid\n";

    jQuery('tbody tr:visible').each(function() {
        const row = [];
        jQuery(this).find('td').each(function(index) {
            if (index < 6) { // Skip actions column
                let text = jQuery(this).text().trim().replace(/\n/g, ' ');
                row.push('"' + text + '"');
            }
        });
        csvContent += row.join(',') + '\n';
    });

    // Download
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "bridgeland_clients_" + new Date().toISOString().split('T')[0] + ".csv");
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);

    button.prop('disabled', false).text('Export Clients');
}

/**
 * Send Newsletter
 */
function sendNewsletter() {
    const emails = [];
    jQuery('tbody tr:visible').each(function() {
        emails.push(jQuery(this).find('td:nth-child(2)').text().trim());
    });

    if (emails.length === 0) {
        showNotification('No clients found to send newsletter to', 'warning');
        return;
    }

    const subject = prompt('Newsletter subject:');
    if (!subject) return;

    const message = prompt('Newsletter message:');
    if (!message) return;

    const button = jQuery('#send-newsletter');
    button.prop('disabled', true).text('Sending...');

    jQuery.ajax({
        url: bridgeland_admin.ajax_url,
        type: 'POST',
        data: {
            action: 'send_newsletter',
            emails: emails,
            subject: subject,
            message: message,
            nonce: bridgeland_admin.nonce
        },
        success: function(response) {
            if (response.success) {
                showNotification('Newsletter sent successfully to ' + emails.length + ' clients', 'success');
            } else {
                showNotification('Failed to send newsletter', 'error');
            }
        },
        error: function() {
            showNotification('An error occurred while sending newsletter', 'error');
        },
        complete: function() {
            button.prop('disabled', false).text('Send Newsletter');
        }
    });
}

/**
 * Refresh Dashboard Stats
 */
function refreshStats() {
    jQuery.ajax({
        url: bridgeland_admin.ajax_url,
        type: 'POST',
        data: {
            action: 'admin_stats',
            nonce: bridgeland_admin.nonce
        },
        success: function(response) {
            if (response.success) {
                const stats = response.data;
                jQuery('#total-clients').text(stats.total_clients);
                jQuery('#active-projects').text(stats.active_projects);
                jQuery('#monthly-revenue').text('$' + parseInt(stats.monthly_revenue).toLocaleString());
                jQuery('#pending-tickets').text(stats.pending_tickets);
            }
        }
    });
}

/**
 * Update Progress Bar
 */
function updateProgressBar(projectId, status) {
    const progressMap = {
        'initiated': 10,
        'in_progress': 50,
        'review': 80,
        'completed': 100
    };

    const progress = progressMap[status] || 0;
    const row = jQuery('.project-status[data-project-id="' + projectId + '"]').closest('tr');
    const progressBar = row.find('.progress-fill');
    const progressText = row.find('.progress-text');

    progressBar.css('width', progress + '%');
    progressText.text(progress + '%');
}

/**
 * Show Notification
 */
function showNotification(message, type = 'info') {
    const notification = jQuery('<div class="notice notice-' + type + ' is-dismissible"><p>' + message + '</p></div>');
    jQuery('.bridgeland-admin h1').after(notification);

    setTimeout(function() {
        notification.fadeOut(function() {
            jQuery(this).remove();
        });
    }, 5000);
}

/**
 * Global Action Functions
 */
window.viewClient = function(clientId) {
    window.open('/wp-admin/user-edit.php?user_id=' + clientId, '_blank');
};

window.emailClient = function(clientId) {
    const email = prompt('Email message to client:');
    if (email) {
        jQuery.ajax({
            url: bridgeland_admin.ajax_url,
            type: 'POST',
            data: {
                action: 'send_client_notification',
                client_id: clientId,
                message: email,
                nonce: bridgeland_admin.nonce
            },
            success: function(response) {
                if (response.success) {
                    showNotification('Email sent successfully', 'success');
                } else {
                    showNotification('Failed to send email', 'error');
                }
            }
        });
    }
};

window.loginAsClient = function(clientId) {
    if (confirm('Login as this client? This will log you out of admin.')) {
        window.location.href = '/wp-admin/admin-ajax.php?action=login_as_client&client_id=' + clientId + '&nonce=' + bridgeland_admin.nonce;
    }
};

window.editProject = function(projectId) {
    window.open('/wp-admin/post.php?post=' + projectId + '&action=edit', '_blank');
};

window.generateReport = function(projectId) {
    const button = jQuery('button[onclick="generateReport(' + projectId + ')"]');
    button.prop('disabled', true).text('Generating...');

    jQuery.ajax({
        url: bridgeland_admin.ajax_url,
        type: 'POST',
        data: {
            action: 'generate_valuation_report',
            valuation_id: projectId,
            nonce: bridgeland_admin.nonce
        },
        success: function(response) {
            if (response.success) {
                window.open(response.data.download_url, '_blank');
                showNotification('Report generated successfully', 'success');
            } else {
                showNotification('Failed to generate report', 'error');
            }
        },
        error: function() {
            showNotification('An error occurred', 'error');
        },
        complete: function() {
            button.prop('disabled', false).text('Report');
        }
    });
};

window.notifyClient = function(projectId) {
    const message = prompt('Notification message to client:');
    if (message) {
        jQuery.ajax({
            url: bridgeland_admin.ajax_url,
            type: 'POST',
            data: {
                action: 'notify_project_client',
                project_id: projectId,
                message: message,
                nonce: bridgeland_admin.nonce
            },
            success: function(response) {
                if (response.success) {
                    showNotification('Client notified successfully', 'success');
                } else {
                    showNotification('Failed to notify client', 'error');
                }
            }
        });
    }
};

window.viewPayment = function(paymentId) {
    window.open('/wp-admin/post.php?post=' + paymentId + '&action=edit', '_blank');
};

window.refundPayment = function(paymentId) {
    if (confirm('Are you sure you want to refund this payment? This action cannot be undone.')) {
        jQuery.ajax({
            url: bridgeland_admin.ajax_url,
            type: 'POST',
            data: {
                action: 'process_refund',
                payment_id: paymentId,
                nonce: bridgeland_admin.nonce
            },
            success: function(response) {
                if (response.success) {
                    showNotification('Refund processed successfully', 'success');
                    location.reload();
                } else {
                    showNotification('Failed to process refund: ' + response.data, 'error');
                }
            }
        });
    }
};