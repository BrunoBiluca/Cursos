module.exports = {

    packageAndShip(sku, qty, done) {

        var trackingNumber = 123456789;

        //
        // TODO: Command Robots to unshelf
        //

        //
        //  TODO: Print Labels
        //

        //
        //  TODO: Command Robots to package
        //

        //
        //  TODO: Command Robots to leave items at dock
        //

        // Create a 1.5 second delay to simulate shipping request
        setTimeout(done.bind(null, trackingNumber), 1500);

    }

};