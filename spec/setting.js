"use strict"

global.localStorage = require('localStorage')

let options = {
    url: "http://localhost:8000/",
    store: require("store")
}

const MailAuth = require("../index.js");
const mailauth = new MailAuth(options);

let env = mailauth.parse();



module.exports = env;

