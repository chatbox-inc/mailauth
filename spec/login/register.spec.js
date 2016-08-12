"use strict"

var assert = require("power-assert");

module.exports = ({register})=>{
    return ()=>{

        var email = "t.goto+hogehoge@chatbox-inc.com";
        var data = {}
        var addData = {
            password: "chatbox5678",
            name: "後藤"
        }

        var mailToken = null

        describe("SEE API",() => {
            it('CAN REGISTER',() => {
                return register.send(email,data).then(({token})=>{
                    assert(token.key)
                    mailToken = token.key
                })
            });
            it('CAN CHECK TOKEN',() => {
                return register.check(mailToken)
            });
            it('CAN REGISTER',() => {
                return register.handle(mailToken,addData)
            });
        })
    }
}