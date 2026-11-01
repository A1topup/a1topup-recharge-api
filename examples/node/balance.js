const { a1Get } = require('./a1');
a1Get('/balance', {}).then(console.log).catch(console.error);
