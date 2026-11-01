// Node.js 18+ (built-in fetch). Docs: https://a1topup.com/api/recharge-api-integration
const fs = require('fs'); const path = require('path');
const envFile = path.join(__dirname, '../../.env');
if (fs.existsSync(envFile)) for (const line of fs.readFileSync(envFile, 'utf8').split('\n')) { const m = line.match(/^([A-Z_]+)=(.*)$/); if (m && !process.env[m[1]]) process.env[m[1]] = m[2].trim(); }
const BASE = process.env.A1_BASE_URL || 'https://business.a1topup.com/recharge';
async function a1Get(p, params) {
  const qs = new URLSearchParams({ username: process.env.A1_USERNAME || '', pwd: process.env.A1_PASSWORD || '', ...params });
  const res = await fetch(`${BASE}${p}?${qs}`);
  return res.text();
}
module.exports = { a1Get };
