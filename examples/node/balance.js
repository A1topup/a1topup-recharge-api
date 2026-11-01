const { a1Get } = require('./a1');
a1Get('/balance', { format: 'json' }).then(console.log).catch(console.error);
