// Usage: node recharge.js <number> <amount> <operatorcode> <circlecode>
const { a1Get } = require('./a1');
const [number, amount, operatorcode, circlecode] = process.argv.slice(2);
if (!circlecode) { console.log('Usage: node recharge.js <number> <amount> <operatorcode> <circlecode>'); process.exit(1); }
const orderid = 'ORD' + Date.now();   // unique for every request
a1Get('/api', { circlecode, operatorcode, number, amount, orderid, format: 'json' })
  .then(r => console.log('Order:', orderid, '\n' + r)).catch(console.error);
// Pending: wait for the callback, never retry with the same order.
