"use strict"

var assert = require("power-assert");

module.exports = ({register})=>{
    return ()=>{
        describe("SEE API",() => {
            register
            it('handle',() => {
                assert(2===2)
            });
        })
    }
}