"use strict"

const env = require("./setting.js");

describe("[login]",require("./login/login.spec.js")(env))
describe("[login]",require("./login/register.spec.js")(env))