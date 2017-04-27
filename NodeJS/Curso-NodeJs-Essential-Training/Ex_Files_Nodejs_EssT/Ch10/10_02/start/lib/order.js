var inventoryData = require('../data-sample/inventory');
var warehouse = require('./warehouse');

function findItem(sku) {
    var i = inventoryData.map(item => item.sku).indexOf(sku);
    if (i === -1) {
        console.log(`Item - ${sku} not found`);
        return null;
    } else {
        return inventoryData[i];
    }
}

function isInStock(sku, qty) {
    var item = findItem(sku);
    return item && item.qty >= qty;
}

function order(sku, quantity, complete) {
    complete = complete || function () {};
    if (isInStock(sku, quantity)) {
        console.log(`ordering ${quantity} of item # ${sku}`);
        warehouse.packageAndShip(sku, quantity, function (tracking) {
            console.log(`order shipped, tracking - ${tracking}`);
            complete(tracking);
        });
        return true;
    } else {
        console.log(`there are not ${quantity} of item '${sku}' in stock`);
        return false;
    }
}

module.exports.orderItem = order;