# 🚀 Deployment Guide: GitHub → Vercel → Supabase

## ✅ Current Status
- **Code Ready**: All Phase 1 & 2 features implemented
- **Git Commits**: 4 commits ready on `main` branch
- **Remote Configured**: `https://github.com/dsudana/advisorumr.git`

---

## 🔑 Step 1: Push to GitHub (Manual Action Required)

Since the environment requires authentication, you need to push from your local machine:

### Option A: Using GitHub Token (Recommended)

```bash
# On your local machine (C:\laragon\www\travel-umroh)
cd C:\laragon\www\travel-umroh

# Set remote URL with token (replace YOUR_TOKEN with actual token)
git remote set-url origin https://YOUR_GITHUB_TOKEN@github.com/dsudana/advisorumr.git

# Push to GitHub
git push -u origin main --force
```

### Option B: Interactive Push

```bash
# On your local machine
cd C:\laragon\www\travel-umroh
git remote set-url origin https://github.com/dsudana/advisorumr.git
git push -u origin main --force
# Enter username: dsudana
# Enter password/token: [your GitHub personal access token]
```

### Create GitHub Personal Access Token:
1. Go to: https://github.com/settings/tokens
2. Click "Generate new token (classic)"
3. Select scopes: `repo`, `workflow`
4. Generate and copy the token
5. Use it in place of your password when pushing

---

## 🌐 Step 2: Deploy to Vercel

### Automatic Deployment (After GitHub Push)

1. **Go to Vercel**: https://vercel.com/new
2. **Import Project**: 
   - Click "Import Git Repository"
   - Select `dsudana/advisorumr`
3. **Configure Project**:
   - **Framework Preset**: Laravel (or "Other" if not listed)
   - **Root Directory**: `./` (keep default)
   - **Build Command**: Leave empty (Laravel doesn't need build step)
   - **Output Directory**: Leave empty
4. **Environment Variables** (Add these in Vercel dashboard):

```env
APP_NAME="Advisoro Umroh"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-project.vercel.app

# Database (Supabase)
DB_CONNECTION=pgsql
DB_HOST=db.YOUR_PROJECT.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=YOUR_SUPABASE_DB_PASSWORD

# Queue & Cache (Redis via Upstash or similar)
QUEUE_CONNECTION=database
CACHE_DRIVER=database
SESSION_DRIVER=database

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@advisorumroh.com
MAIL_FROM_NAME="${APP_NAME}"

# WhatsApp Business API
WHATSAPP_API_KEY=your_whatsapp_api_key
WHATSAPP_PHONE_NUMBER_ID=your_phone_number_id
WHATSAPP_BUSINESS_ACCOUNT_ID=your_business_account_id

# OpenAI for Chatbot
OPENAI_API_KEY=your_openai_api_key

# Supabase
SUPABASE_URL=https://YOUR_PROJECT.supabase.co
SUPABASE_ANON_KEY=your_anon_key
SUPABASE_SERVICE_ROLE_KEY=your_service_role_key
```

5. **Deploy**: Click "Deploy"
6. **Wait**: Deployment takes ~3-5 minutes

### Post-Deployment Setup

```bash
# After deployment, run migrations via Vercel CLI or SSH
vercel env pull  # Pull environment variables locally
vercel --prod    # Redeploy with new env vars
```

---

## 🗄️ Step 3: Configure Supabase Database

### 1. Create Supabase Project
1. Go to: https://supabase.com/dashboard
2. Click "New Project"
3. Fill in:
   - **Name**: advisorumr
   - **Database Password**: [Save this securely]
   - **Region**: Choose closest to your users
4. Wait for project creation (~2 minutes)

### 2. Get Database Credentials
1. Go to **Settings** → **Database**
2. Copy **Connection String** (Pooler mode)
3. Note these values:
   - Host: `db.XXXXX.supabase.co`
   - Port: `5432` or `6543` (pooler)
   - Database: `postgres`
   - User: `postgres`
   - Password: [Your password from step 1]

### 3. Run Migrations

#### Option A: Via Supabase SQL Editor
Copy and paste each migration file content into Supabase SQL Editor:
- `/database/migrations/2024_01_01_000001_create_leads_table.php` (convert to SQL)
- `/database/migrations/2024_01_01_000002_create_lead_sources_table.php`
- ... (all migration files)

#### Option B: Using pgAdmin or DBeaver
1. Connect to Supabase database using credentials
2. Run migration SQL scripts sequentially

#### Option C: Using Laravel Artisan (If SSH available)
```bash
php artisan migrate --force
php artisan db:seed --force
```

### 4. Enable Row Level Security (Optional but Recommended)
In Supabase Dashboard:
1. Go to **Authentication** → **Policies**
2. Add policies for each table as needed

---

## ⚙️ Step 4: Configure Queue Worker (Critical for Email Automation)

Vercel's serverless functions don't support persistent queue workers. You have 3 options:

### Option A: Use Vercel Cron + Database Queue (Recommended)
1. In Vercel Dashboard → **Settings** → **Cron Jobs**
2. Add cron job:
   ```json
   {
     "path": "/api/queue-worker",
     "schedule": "* * * * *"
   }
   ```
3. Create route `/api/queue-worker` that runs:
   ```php
   Artisan::call('queue:work', ['--once' => true]);
   ```

### Option B: External Queue Service (Best for Production)
Use **Upstash Redis** (free tier available):
1. Create account: https://upstash.com
2. Create Redis database
3. Add to Vercel env vars:
   ```env
   REDIS_HOST=xxxxx.upstash.io
   REDIS_PASSWORD=xxxxx
   REDIS_PORT=6379
   QUEUE_CONNECTION=redis
   ```
4. Update `config/queue.php` to use Redis

### Option C: GitHub Actions Runner
Set up a free GitHub Actions workflow to process queues periodically.

---

## 📧 Step 5: Test Email & WhatsApp Integration

### Test Welcome Email Sequence:
1. Visit your Vercel app URL
2. Submit lead capture form
3. Check logs in Vercel dashboard
4. Verify emails are queued

### Test Abandoned Booking Recovery:
1. Start booking process
2. Abandon before completion
3. Wait 2 hours (or reduce delay in testing)
4. Check if reminder email is sent

### Test WhatsApp Integration:
1. Ensure WhatsApp Business API credentials are set
2. Send test message via admin panel
3. Verify webhook receives responses

---

## 🔍 Step 6: Monitoring & Analytics

### Vercel Analytics
- Enable in Vercel Dashboard → **Analytics**
- Track page views, conversions, performance

### Supabase Logs
- Go to **Logs** section in Supabase dashboard
- Monitor database queries and errors

### Application Logs
- View in Vercel → **Functions** → **Logs**
- Or integrate with external service (Logtail, Sentry)

---

## 🛠️ Troubleshooting

### Issue: Migration Fails
**Solution**: Check database connection string, ensure SSL is enabled in Supabase

### Issue: Emails Not Sending
**Solution**: 
- Verify SMTP credentials
- Check queue worker is running
- Review Vercel function logs

### Issue: WhatsApp Messages Fail
**Solution**:
- Confirm API credentials
- Check webhook URL is publicly accessible
- Verify phone number is registered with WhatsApp Business

### Issue: Build Fails on Vercel
**Solution**:
- Check PHP version compatibility (Laravel 11 needs PHP 8.2+)
- Verify all dependencies in `composer.json`
- Review build logs in Vercel dashboard

---

## 📊 Post-Deployment Checklist

- [ ] Code pushed to GitHub
- [ ] Vercel project created and deployed
- [ ] Supabase database configured
- [ ] Migrations executed successfully
- [ ] Environment variables set in Vercel
- [ ] Queue worker configured (cron or Redis)
- [ ] Email sending tested
- [ ] WhatsApp integration tested
- [ ] Lead capture form working
- [ ] Booking flow tested end-to-end
- [ ] Analytics tracking verified
- [ ] SSL certificate active (automatic on Vercel)

---

## 🎯 Next Steps After Deployment

1. **Monitor First Week**: Watch logs, fix any issues
2. **Gather User Feedback**: Optimize conversion funnel
3. **Implement Phase 3**: Personalization engine
4. **A/B Testing**: Test different lead magnets
5. **Scale**: Add CDN, optimize images, enable caching

---

## 📞 Support Resources

- **Vercel Docs**: https://vercel.com/docs
- **Supabase Docs**: https://supabase.com/docs
- **Laravel on Vercel**: https://vercel.com/guides/deploying-laravel-with-vercel
- **WhatsApp Business API**: https://developers.facebook.com/docs/whatsapp

---

**🎉 Your modern lead generation platform is ready to launch!**
