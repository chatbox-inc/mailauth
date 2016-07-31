"use strict"

var MailAuth = require('../index.js');
var assert = require("power-assert");

const mailauth = new MailAuth("http://localhost:8000/");

const Register = mailauth.register;

describe("SEE API",() => {

    let mailKey = null;

    it('send addTask',() => {
        let promise = Register.send("t.goto@chatbox-inc.com");
        return promise.then(({token})=>{
            assert(token.key)
            mailKey = token.key
        });
    });

    it('send addTask',() => {
        let promise = Register.check(mailKey);
        return promise.then(({token})=>{
            assert(token.key)
        });
    });

    it('handle',() => {
        let promise = Register.handle(mailKey);
        return promise.then(({token})=>{
            assert(token.key)
        });
    });
})