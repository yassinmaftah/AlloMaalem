const { chromium } = require('playwright');
const path = require('path');
const fs = require('fs');

const BASE_URL = process.env.BASE_URL || 'http://allomaalem_app:8000';
const OUT_DIR = process.env.OUT_DIR || path.resolve(__dirname, '../docs/screenshots');

if (!fs.existsSync(OUT_DIR)) {
  fs.mkdirSync(OUT_DIR, { recursive: true });
}

console.log(`[Screenshots] Targeting ${BASE_URL}`);
console.log(`[Screenshots] Output directory: ${OUT_DIR}`);

async function capture() {
  const browser = await chromium.launch({
    headless: true,
    args: ['--no-sandbox', '--disable-setuid-sandbox']
  });

  const context = await browser.newContext({
    viewport: { width: 1440, height: 900 },
    deviceScaleFactor: 1
  });

  const page = await context.newPage();

  async function snap(relPath, filename) {
    const url = `${BASE_URL}${relPath}`;
    console.log(`[Capturing] ${filename} from ${url}`);
    try {
      await page.goto(url, { waitUntil: 'networkidle', timeout: 30000 });
      await page.waitForTimeout(1000);
      await page.screenshot({ path: path.join(OUT_DIR, filename), fullPage: false });
      console.log(`[Saved] ${filename}`);
    } catch (err) {
      console.error(`[Error snapping ${filename}]:`, err.message);
    }
  }

  async function login(email, password) {
    console.log(`[Auth] Logging in as ${email}...`);
    await page.goto(`${BASE_URL}/login`, { waitUntil: 'networkidle' });
    await page.fill('input[name="email"]', email);
    await page.fill('input[name="password"]', password);
    await Promise.all([
      page.waitForNavigation({ waitUntil: 'networkidle' }).catch(() => {}),
      page.click('button[type="submit"]')
    ]);
    await page.waitForTimeout(1000);
  }

  async function logout() {
    console.log(`[Auth] Logging out...`);
    try {
      const logoutForm = page.locator('form[action$="/logout"]');
      if (await logoutForm.count() > 0) {
        await Promise.all([
          page.waitForNavigation({ waitUntil: 'networkidle' }).catch(() => {}),
          logoutForm.locator('button').first().click()
        ]);
      } else {
        await page.goto(`${BASE_URL}/login`);
      }
    } catch (e) {
      await page.goto(`${BASE_URL}/login`);
    }
    await page.context().clearCookies();
  }

  try {
    // 1. Public Pages
    await snap('/', '01-landing-page.png');
    await snap('/login', '02-login.png');
    await snap('/register', '03-register.png');

    // 2. Client Flow (ahmed@example.com)
    await login('ahmed@example.com', 'password123');
    await snap('/client/dashboard', '04-client-dashboard.png');
    await snap('/client/jobs', '05-client-jobs.png');
    await snap('/client/jobs/1', '06-client-job-offers.png');
    await snap('/client/jobs/create', '07-client-create-job.png');
    await snap('/profile', '08-client-profile.png');
    await logout();

    // 3. Maalem Flow (hassan@example.com)
    await login('hassan@example.com', 'password123');
    await snap('/maalem/dashboard', '09-maalem-dashboard.png');
    await snap('/maalem/find-work', '10-maalem-find-work.png');
    await snap('/maalem/jobs/2', '11-maalem-job-details.png');
    await snap('/maalem/my-apps', '12-maalem-applications.png');
    await snap('/maalem/reviews', '13-maalem-reviews.png');
    await logout();

    // 4. Admin Flow (admin1@allomaalem.com)
    await login('admin1@allomaalem.com', 'password123');
    await snap('/admin/dashboard', '14-admin-dashboard.png');
    await snap('/admin/users', '15-admin-users.png');
    await snap('/admin/premium-users', '16-admin-premium-users.png');
    await snap('/admin/settings', '17-admin-settings.png');
    await snap('/admin/payment-history', '18-admin-payments.png');
    await logout();

    console.log('[Screenshots] All screenshots captured successfully!');
  } catch (err) {
    console.error('[Error during screenshot process]', err);
  } finally {
    await browser.close();
  }
}

capture();
