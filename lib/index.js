"use strict"

const Request = require("./api/Request.js")
const Register = require("./api/Register.js")


class MailAuth{

    constructor(url){
        const request = new Request(url);
        const register = new Register(request);

        this.register = register;
    }
}

module.exports = MailAuth;