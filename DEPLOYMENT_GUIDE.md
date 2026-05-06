# 🚀 Deployment Guide: GitHub → Vercel → Supabase

## ✅ Current Status
- **Code Ready**: All Phase 1 & 2 features implemented
- **Git Remote**: Configured for `git@github.com:dsudana/advisorumr.git`
- **Branch**: `main` (ready to push)

---

## 📤 Step 1: Push to GitHub

### Option A: SSH Method (Recommended)
```bash
# 1. Generate SSH key (if you don't have one)
ssh-keygen -t ed25519 -C "your_email@example.com"
# Press Enter to accept default location

# 2. Copy the public key
cat ~/.ssh/id_ed25519.pub
# Copy the entire output (starts with ssh-ed25519...)

# 3. Add to GitHub
# Go to: https://github.com/settings/keys
# Click "New SSH key", paste your key, save

# 4. Test connection
ssh -T git@github.com
# Should say: "Hi dsudana! You've successfully authenticated..."

# 5. Push code
cd /workspace
git push -u origin main --force
```

### Option B: HTTPS with Personal Access Token
```bash
# 1. Create token at: https://github.com/settings/tokens
# Select scopes: repo, workflow

# 2. Push using token
git remote set-url origin https://dsudana:YOUR_TOKEN@github.com/dsudana/advisorumr.git
git push -u origin main --force
```

---

## 🌐 Step 2: Deploy to Vercel

### Automatic Deployment (After GitHub Push)
1. Go to [vercel.com](https://vercel.com)
2. Click **"Add New Project"**
3. Import `dsudana/advisorumr` repository
4. Configure:
   - **Framework Preset**: Laravel
   - **Root Directory**: `./`
   - **Build Command**: `composer install && php artisan optimize`
   - **Output Directory**: `public`

### Environment Variables Required in Vercel
```env
APP_NAME=AdvisorUmroh
APP_ENV=production
APP_KEY=your_app_key
APP_DEBUG=false
APP_URL=https://your-project.vercel.app

DB_CONNECTION=pgsql
DB_HOST=db.xxxxx.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USER=postgres
DB_PASSWORD=your_supabase_password

QUEUE_CONNECTION=redis
REDIS_HOST=your_redis_host
REDIS_PASSWORD=your_redis_password
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@advisorumroh.com
MAIL_FROM_NAME="Advisor Umroh"

WHATSAPP_API_KEY=your_whatsapp_api_key
WHATSAPP_PHONE_NUMBER_ID=your_phone_number_id
OPENAI_API_KEY=your_openai_api_key
```

### Vercel CLI Deployment (Alternative)
```bash
# Install Vercel CLI
npm i -g vercel

# Login
vercel login

# Deploy
cd /workspace
vercel --prod
```

---

## 🗄️ Step 3: Setup Supabase Database

### 1. Create New Project
1. Go to [supabase.com](https://supabase.com)
2. Click **"New Project"**
3. Fill in:
   - **Organization**: Your org
   - **Project Name**: `advisorumroh-db`
   - **Database Password**: Save this securely!
   - **Region**: Choose closest to your users

### 2. Get Connection Details
After project creation:
1. Go to **Settings** → **Database**
2. Copy **Connection String** (URI mode)
3. Or get individual values:
   - Host: `db.xxxxx.supabase.co`
   - Port: `5432`
   - Database: `postgres`
   - User: `postgres`
   - Password: (your password from step 1)

### 3. Run Migrations
```bash
# Connect to Supabase SQL Editor
# Go to: https://app.supabase.com/project/YOUR_PROJECT/sql

# OR use psql locally:
psql postgresql://postgres:[PASSWORD]@db.[PROJECT_REF].supabase.co:5432/postgres

# Run all migrations from /database/migrations/
# Key migrations included:
- create_leads_table
- create_lead_sources_table
- create_newsletter_subscribers_table
- create_conversion_events_table
- create_whatsapp_messages_table
- create_email_campaigns_table
- add_contact_fields_to_bookings
```

### 4. Enable Row Level Security (Optional but Recommended)
```sql
-- Example for leads table
ALTER TABLE leads ENABLE ROW LEVEL SECURITY;

CREATE POLICY "Allow authenticated users" ON leads
  FOR ALL USING (auth.role() = 'authenticated');
```

---

## 🔧 Post-Deployment Configuration

### 1. Generate App Key
```bash
php artisan key:generate --show
# Copy the key to Vercel environment variables as APP_KEY
```

### 2. Run Database Migrations
```bash
# In Vercel deployment settings or via SSH
php artisan migrate --force
```

### 3. Seed Initial Data (Optional)
```bash
php artisan db:seed --force
```

### 4. Storage Link
```bash
php artisan storage:link
```

### 5. Queue Worker Setup
For Vercel, use queue drivers compatible with serverless:
- **Database driver**: `QUEUE_CONNECTION=database`
- **Redis**: Requires Vercel Redis integration or external Redis

---

## 🧪 Testing Checklist

### Before Going Live:
- [ ] GitHub repo updated with latest code
- [ ] Vercel deployment successful (green checkmark)
- [ ] Database connected and migrated
- [ ] Environment variables configured
- [ ] Lead capture form working
- [ ] Email sending functional
- [ ] WhatsApp integration tested
- [ ] Booking flow complete end-to-end
- [ ] Mobile responsive check
- [ ] SSL certificate active (automatic on Vercel)

### Test URLs:
- **Production**: `https://your-project.vercel.app`
- **Preview**: `https://your-branch-git-main-your-org.vercel.app`

---

## 📊 Monitoring & Analytics

### Vercel Dashboard
- Deployment logs: [vercel.com/dashboard](https://vercel.com/dashboard)
- Function logs: Check Serverless Function execution
- Performance metrics: Core Web Vitals

### Supabase Dashboard
- Database usage: [supabase.com/dashboard](https://supabase.com/dashboard)
- Query performance: SQL query stats
- Real-time subscriptions: Active connections

### Application Logs
```bash
# View Laravel logs in Vercel
vercel logs [deployment-url]

# Or check storage/logs/laravel.log
```

---

## 🆘 Troubleshooting

### Common Issues:

**1. Database Connection Failed**
```
Solution: Verify Supabase credentials in Vercel env vars
Check: DB_HOST, DB_PASSWORD, DB_DATABASE
```

**2. Migration Errors**
```
Solution: Run php artisan migrate:status to check
Rollback if needed: php artisan migrate:rollback --force
```

**3. Email Not Sending**
```
Solution: Verify SMTP credentials
Check mail logs: storage/logs/laravel.log
Test: php artisan tinker then Mail::raw('test', fn($m) => $m->to('test@example.com')->send())
```

**4. Queue Jobs Not Processing**
```
Solution: Ensure QUEUE_CONNECTION is set correctly
For Vercel, consider using database driver or external queue service
```

**5. Build Failed on Vercel**
```
Solution: Check build logs in Vercel dashboard
Common fix: Add composer.json scripts or adjust build command
```

---

## 🎯 Next Steps After Deployment

1. **Setup Custom Domain** in Vercel
2. **Configure SSL** (automatic on Vercel)
3. **Enable Analytics** (Vercel Analytics or Google Analytics)
4. **Setup Error Tracking** (Sentry, Bugsnag)
5. **Configure CDN** for assets (automatic on Vercel)
6. **Monitor Performance** with Lighthouse
7. **Setup Automated Backups** for Supabase

---

## 📞 Support Resources

- **Vercel Docs**: [vercel.com/docs](https://vercel.com/docs)
- **Supabase Docs**: [supabase.com/docs](https://supabase.com/docs)
- **Laravel on Vercel**: [vercel.com/guides/deploying-laravel-with-vercel](https://vercel.com/guides/deploying-laravel-with-vercel)
- **GitHub Actions**: Automate deployments with CI/CD

---

**Ready to deploy? Start with Step 1 above!** 🚀
