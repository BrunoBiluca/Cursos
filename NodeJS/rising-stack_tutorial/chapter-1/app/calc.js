function sum(arr){
    return arr.reduce(function(prev, val){
        return prev + val;
    }, 0);
}

module.exports.sum = sum;