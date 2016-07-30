"use strict"

const Request = require("./api/Request.js")
const Register = require("./api/Register.js")


class MailAuth{

    constructor(url){
        const request = new Request(url);
        this.register = new Register(request);
    }
}

module.exports = MailAuth;