// Usage: node status.js <orderid>
const { a1Get } = require('./a1');
const id = process.argv[2]; if (!id) { console.log('Usage: node status.js <orderid>'); process.exit(1); }
a1Get('/status', { orderid: id, format: 'json' }).then(console.log).catch(console.error);
