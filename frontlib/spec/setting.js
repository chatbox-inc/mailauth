"use strict"

let options = {
    url: "http://localhost:8000/"
}

const MailAuth = require("../index.js");
const mailauth = new MailAuth(options);

let env = mailauth.parse();

module.exports = env;

