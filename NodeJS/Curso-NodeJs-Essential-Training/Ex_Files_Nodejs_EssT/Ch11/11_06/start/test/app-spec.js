var request = require('supertest');
var expect = require('chai').expect;
var rewire = require('rewire');
var app = rewire('../app');

describe("Dictionary App", function () {

    it("Loads the home page", function (done) {
       request(app).get("/").expect(200).end(done);
    });

    it("Logs requests to console", function (done) {
        request(app).get("/").expect(200).end(done);
    });

    describe("dictionary-api", function () {

        beforeEach(function () {
            app.__set__("skierTerms", [
                {
                    term: "One",
                    defined: "Term One Defined"
                },
                {
                    term: "Two",
                    defined: "Term Two Defined"
                }
            ]);
        });

        it("GETS dictionary-api", function (done) {
            request(app).get("/dictionary-api").expect(200).end(done);
        });

        it("POSTS dictionary-api", function (done) {
            request(app).post("/dictionary-api")
                .send({"term": "Three", "defined": "Term Three Defined"})
                .expect(200)
                .end(done);
        });

        it("DELETES dictionary-api", function (done) {
            request(app).delete("/dictionary-api/One")
                .expect(200)
                .end(done);
        });

    });

});