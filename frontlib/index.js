"use strict"

const Request = require("./src/request.js")
const Register = require("./src/register.js")
const Login = require("./src/login.js")


class MailAuth{

    constructor({url,store}){

        const request = new Request(url);

        this.store = store;
        this.register = new Register({request});
        this.login = new Login({request,store});
    }

    parse(){
        return {
            register: this.register,
            login:    this.login,
            store:    this.store
        }
    }
}

module.exports = MailAuth;