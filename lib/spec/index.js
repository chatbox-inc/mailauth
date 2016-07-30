var MailAuth = require('../index.js');
var assert = require("power-assert");

const mailauth = new MailAuth("http://localhost:8000/");

const Register = mailauth.register;

describe("SEE API",() => {

    it('send addTask',() => {
        let promise = Register.send("t.goto@chatbox-inc.com");
        return promise.then(token=>{
            assert(token)
        });
    });
})