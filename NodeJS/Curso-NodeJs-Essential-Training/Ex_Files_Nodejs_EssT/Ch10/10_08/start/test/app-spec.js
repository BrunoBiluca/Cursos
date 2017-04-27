var expect = require('chai').expect;
var rewire = require('rewire');
var app = rewire('../app');

describe("Dictionary App", function () {

    it("Loads the home page");

    describe("Dictionary API", function () {

        beforeEach(function () {

        	this.defs = [
                {
                    term: "One",
                    defined: "Term One Defined"
                },
                {
                    term: "Two",
                    defined: "Term Two Defined"
                }
            ];

            app.__set__("skierTerms", this.defs);
        });

        it("GETS dictionary-api");

        it("POSTS dictionary-api");

        it("DELETES dictionary-api");

    });

});