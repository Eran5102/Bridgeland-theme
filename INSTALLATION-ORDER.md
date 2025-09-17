# Installation Order - Safe Deployment

## Step 1: Initial Safe Installation

### If you're concerned about site loading issues, follow this order:

1. **First Upload**: Use debug versions
   - Temporarily rename `functions.php` to `functions-full.php`
   - Rename `functions-debug.php` to `functions.php`
   - Rename `index.php` to `index-full.php`
   - Rename `index-debug.php` to `index.php`

2. **Create ZIP and Upload**
   - This gives you a basic working version
   - All CDN fallbacks active
   - Minimal functionality to test

3. **Test Basic Functionality**
   - Site loads properly
   - Basic navigation works
   - Contact forms function

## Step 2: Gradual Feature Activation

Once the debug version works:

1. **Restore Full Functions**:
   - Rename `functions.php` to `functions-debug-backup.php`
   - Rename `functions-full.php` to `functions.php`

2. **Restore Full Index**:
   - Rename `index.php` to `index-debug-backup.php`
   - Rename `index-full.php` to `index.php`

3. **Test Each Include File**:
   If issues arise, comment out include files one by one in functions.php:
   ```php
   $include_files = array(
       'seo.php',              // Test this first
       'performance.php',      // Then this
       // 'client-portal.php', // Comment out if issues
       // 'crm-integration.php', // Comment out if issues
   );
   ```

## Step 3: Full Feature Deployment

Once everything works, you can enable all features gradually.

## Quick Commands for File Renaming

If you need to switch to debug mode quickly:
```bash
# Switch to debug mode
mv functions.php functions-full.php
mv functions-debug.php functions.php
mv index.php index-full.php
mv index-debug.php index.php

# Switch back to full mode
mv functions.php functions-debug.php
mv functions-full.php functions.php
mv index.php index-debug.php
mv index-full.php index.php
```