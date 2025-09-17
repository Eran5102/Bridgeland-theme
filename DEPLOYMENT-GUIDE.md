# Bridgeland Advisors Theme - Production Deployment Guide

## Pre-Deployment Checklist

### 1. System Requirements Verification
- [ ] WordPress 6.0+ installed and updated
- [ ] PHP 8.0+ with required extensions (mysqli, gd, curl, mbstring, xml)
- [ ] MySQL 5.7+ or MariaDB 10.2+
- [ ] SSL certificate installed and configured
- [ ] Minimum 2GB RAM available
- [ ] Backup system in place

### 2. Theme File Preparation
- [ ] All theme files uploaded to `/wp-content/themes/bridgeland-theme/`
- [ ] File permissions set correctly (644 for files, 755 for directories)
- [ ] Bootstrap assets available (local files or CDN fallback)
- [ ] All include files present in `/inc/` directory

### 3. WordPress Configuration
- [ ] Debug mode disabled in production
- [ ] File editing disabled for security
- [ ] Strong salts and security keys configured
- [ ] Database table prefix changed from default 'wp_'

## Deployment Steps

### Step 1: Initial Setup
```bash
# 1. Upload theme files
# Upload entire bridgeland-theme folder to /wp-content/themes/

# 2. Set file permissions
find /wp-content/themes/bridgeland-theme/ -type f -exec chmod 644 {} \;
find /wp-content/themes/bridgeland-theme/ -type d -exec chmod 755 {} \;

# 3. Activate theme in WordPress admin
```

### Step 2: Basic Configuration
1. **Activate Theme**
   - WordPress Admin → Appearance → Themes
   - Click "Activate" on Bridgeland Advisors Theme

2. **Configure Company Information**
   - WordPress Admin → Customize → Company Information
   - Update phone, email, address, LinkedIn URL

3. **Set up Navigation Menus**
   - WordPress Admin → Appearance → Menus
   - Create "Primary Menu" and "Footer Menu"
   - Assign to theme locations

### Step 3: Advanced Configuration

#### Database Configuration
```sql
-- Recommended database optimizations
SET GLOBAL innodb_buffer_pool_size = 1GB;
SET GLOBAL query_cache_size = 64MB;
SET GLOBAL query_cache_type = ON;
```

#### WordPress wp-config.php Settings
```php
// Security settings
define('DISALLOW_FILE_EDIT', true);
define('FORCE_SSL_ADMIN', true);
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);

// Performance settings
define('WP_CACHE', true);
define('COMPRESS_CSS', true);
define('COMPRESS_SCRIPTS', true);
define('ENFORCE_GZIP', true);

// Security keys (generate unique keys)
define('AUTH_KEY',         'your-unique-key');
define('SECURE_AUTH_KEY',  'your-unique-key');
define('LOGGED_IN_KEY',    'your-unique-key');
define('NONCE_KEY',        'your-unique-key');
define('AUTH_SALT',        'your-unique-key');
define('SECURE_AUTH_SALT', 'your-unique-key');
define('LOGGED_IN_SALT',   'your-unique-key');
define('NONCE_SALT',       'your-unique-key');
```

### Step 4: Theme-Specific Configuration

#### Admin Dashboard Setup
1. Navigate to **WordPress Admin → Bridgeland**
2. Complete initial setup wizard
3. Configure business settings:
   - Default service rates
   - Project turnaround times
   - Contact information
   - Tax settings

#### CRM Integration (Optional)
```php
// Configure in WordPress Admin → Bridgeland → Settings
// Or set directly in wp-config.php:
define('HUBSPOT_API_KEY', 'your_hubspot_key');
define('SALESFORCE_INSTANCE_URL', 'https://your-instance.salesforce.com');
define('SALESFORCE_ACCESS_TOKEN', 'your_sf_token');
define('PIPEDRIVE_API_KEY', 'your_pipedrive_key');
```

#### Email Automation Setup
```php
// SMTP Configuration
define('SMTP_HOST', 'smtp.your-provider.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your_smtp_username');
define('SMTP_PASSWORD', 'your_smtp_password');
define('SMTP_ENCRYPTION', 'tls');
```

#### Payment Gateway Configuration
```php
// Stripe Configuration
define('STRIPE_PUBLISHABLE_KEY', 'pk_live_...');
define('STRIPE_SECRET_KEY', 'sk_live_...');

// PayPal Configuration
define('PAYPAL_CLIENT_ID', 'your_paypal_client_id');
define('PAYPAL_CLIENT_SECRET', 'your_paypal_secret');
define('PAYPAL_MODE', 'live'); // 'sandbox' for testing
```

### Step 5: Security Hardening

#### .htaccess Configuration
```apache
# Add to .htaccess file in WordPress root
RewriteEngine On

# Block access to sensitive files
<files wp-config.php>
order allow,deny
deny from all
</files>

<files .htaccess>
order allow,deny
deny from all
</files>

# Prevent directory browsing
Options -Indexes

# Block suspicious requests
RewriteCond %{QUERY_STRING} \.\./\.\. [OR]
RewriteCond %{QUERY_STRING} ^.*\.(bash|git|hg|log|svn|swp|cvs) [OR]
RewriteCond %{QUERY_STRING} etc/passwd [OR]
RewriteCond %{QUERY_STRING} boot\.ini [OR]
RewriteCond %{QUERY_STRING} ftp\: [OR]
RewriteCond %{QUERY_STRING} http\: [OR]
RewriteCond %{QUERY_STRING} https\: [OR]
RewriteCond %{QUERY_STRING} (\<|%3C).*script.*(\>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} mosConfig_[a-zA-Z_]{1,21}(=|%3D) [OR]
RewriteCond %{QUERY_STRING} base64_encode.*\(.*\) [OR]
RewriteCond %{QUERY_STRING} ^.*(\[|\]|\(|\)|<|>|ê|"|;|\?|\*|=$).* [NC]
RewriteRule ^(.*)$ - [F,L]

# Security headers
Header always set X-Content-Type-Options nosniff
Header always set X-Frame-Options SAMEORIGIN
Header always set X-XSS-Protection "1; mode=block"
Header always set Referrer-Policy "strict-origin-when-cross-origin"
```

#### File Permissions
```bash
# Set secure file permissions
chmod 644 wp-config.php
chmod 644 .htaccess
chmod -R 755 wp-content/
chmod -R 644 wp-content/themes/
chmod -R 755 wp-content/uploads/
```

### Step 6: Performance Optimization

#### Caching Setup
1. **Install Caching Plugin** (if not using server-level caching)
   - W3 Total Cache or WP Rocket recommended
   - Configure object caching, page caching, and CDN

2. **Database Optimization**
   - WordPress Admin → Bridgeland → Optimization
   - Run initial database optimization
   - Schedule weekly optimization

3. **Image Optimization**
   - Install WebP conversion plugin
   - Configure lazy loading
   - Set up image compression

#### CDN Configuration
```php
// CloudFlare or AWS CloudFront
define('CDN_URL', 'https://cdn.bridgeland-advisors.com');
```

### Step 7: Monitoring and Backup Setup

#### Backup Configuration
1. **Automated Backups**
   - WordPress Admin → Bridgeland → Settings → Security
   - Enable daily database backups
   - Configure weekly full site backups
   - Set up cloud storage (AWS S3, Google Drive, Dropbox)

2. **Backup Verification**
   - Test backup restoration process
   - Verify backup file integrity
   - Set up backup failure notifications

#### Monitoring Setup
```php
// Google Analytics 4
define('GOOGLE_ANALYTICS_ID', 'G-XXXXXXXXXX');

// Performance monitoring
define('ENABLE_PERFORMANCE_MONITORING', true);
```

### Step 8: Testing and Validation

#### Functionality Testing
- [ ] Homepage loads correctly
- [ ] All calculators function properly
- [ ] Contact forms submit successfully
- [ ] Client portal login/registration works
- [ ] Payment processing functions (test mode first)
- [ ] Email automation triggers correctly
- [ ] Mobile responsiveness verified

#### Performance Testing
- [ ] Page speed test (aim for <3 seconds load time)
- [ ] Database performance test
- [ ] Memory usage within limits
- [ ] Cache effectiveness verified

#### Security Testing
- [ ] Security scan completed
- [ ] SSL certificate verified
- [ ] Failed login protection working
- [ ] File access restrictions in place
- [ ] Backup system functional

## Post-Deployment Tasks

### 1. Content Creation
- [ ] Create essential pages (About, Services, Contact)
- [ ] Add team member profiles
- [ ] Upload case studies and testimonials
- [ ] Create initial blog posts
- [ ] Set up service packages and pricing

### 2. SEO Configuration
- [ ] Install and configure Yoast SEO or RankMath
- [ ] Submit XML sitemap to search engines
- [ ] Set up Google Search Console
- [ ] Configure Google My Business
- [ ] Add schema markup verification

### 3. Legal and Compliance
- [ ] Add privacy policy
- [ ] Add terms of service
- [ ] Cookie consent notice (if required)
- [ ] GDPR compliance measures (if applicable)
- [ ] Professional liability insurance verification

### 4. Marketing Setup
- [ ] Set up email marketing integration
- [ ] Configure social media accounts
- [ ] Set up conversion tracking
- [ ] Create lead magnets and forms
- [ ] Launch initial marketing campaigns

## Maintenance Schedule

### Daily (Automated)
- [ ] Security monitoring
- [ ] Database backup
- [ ] Performance monitoring
- [ ] Email queue processing
- [ ] CRM synchronization

### Weekly (Manual)
- [ ] Content updates
- [ ] Performance review
- [ ] Security log review
- [ ] Backup verification
- [ ] Plugin updates (test first)

### Monthly (Manual)
- [ ] Full security audit
- [ ] Database optimization
- [ ] Performance optimization
- [ ] Content audit
- [ ] Analytics review

## Troubleshooting Common Issues

### Theme Won't Load
1. Check file permissions
2. Verify all include files exist
3. Use debug version (rename functions-debug.php to functions.php)
4. Check WordPress error logs
5. Ensure PHP requirements are met

### Calculators Not Working
1. Check JavaScript console for errors
2. Verify AJAX URLs are correct
3. Clear browser and server cache
4. Check nonce verification
5. Verify jQuery is loaded

### Email Issues
1. Test SMTP configuration
2. Check WordPress cron functionality
3. Verify email queue processing
4. Check spam folder settings
5. Review email logs

### Payment Processing Issues
1. Verify SSL certificate
2. Check payment gateway credentials
3. Test in sandbox mode first
4. Review webhook configuration
5. Check payment logs

## Support Contacts

### Technical Support
- **Email**: technical-support@bridgeland-advisors.com
- **Emergency**: Include "URGENT" in subject line
- **Response Time**: 24 hours for non-urgent, 4 hours for urgent

### Documentation
- **Theme Documentation**: Available in WordPress admin
- **Video Tutorials**: Available online
- **FAQ**: Check documentation first

### Professional Services
- **Custom Development**: Available for additional features
- **Managed Hosting**: WordPress hosting optimization
- **SEO Services**: Professional SEO optimization
- **Marketing Services**: Digital marketing campaigns

---

## Production Checklist Summary

### Critical Items (Must Complete)
- [ ] SSL certificate installed and working
- [ ] File permissions set correctly
- [ ] Security headers configured
- [ ] Backup system operational
- [ ] Basic functionality tested
- [ ] Payment processing tested (sandbox mode)
- [ ] Contact forms working
- [ ] Performance optimized

### Important Items (Should Complete)
- [ ] CRM integration configured
- [ ] Email automation setup
- [ ] Analytics tracking installed
- [ ] SEO optimization completed
- [ ] Content added
- [ ] Mobile testing completed
- [ ] Security scanning setup

### Optional Items (Nice to Have)
- [ ] CDN configured
- [ ] Advanced caching setup
- [ ] Third-party API integrations
- [ ] Custom calculator additions
- [ ] Marketing automation setup
- [ ] Social media integration

---

**Deployment completed successfully when all critical items are checked and the site is fully functional.**

*Last Updated: Current Date*
*Version: 2.0.0*