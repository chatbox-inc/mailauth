"use strict"

var request = require("superagent")

const promiseAgent = (agent)=>{
    return new Promise((resolve) => {
        agent.end((e,response) => {
            if(response){
                resolve(response) // reject only when internet not connected
            }else{
                throw e;
            }
        })
    });
}

class Token{
    constructor({domain}){
        this.domain = domain;
        this.headerKey = "X-AUTHTOKEN";
    }

    login(credential){
        let agent = request.post(this.domain+"auth/login");
        agent.send({credential});
        return promiseAgent(agent)
    }

    logout(token){
        let agent = request.post(this.domain+"auth/logout");
        agent.set(this.headerKey,token);
        return promiseAgent(agent)
    }
}

module.exports = Token;