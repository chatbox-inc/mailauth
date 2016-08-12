"use strict"

const Request = require("./src/request.js")
const Register = require("./src/register.js")


class MailAuth{

    constructor({url}){
        const request = new Request(url);
        this.register = new Register({request});
    }

    parse(){
        return {
            register: this.register
        }
    }
}

module.exports = MailAuth;