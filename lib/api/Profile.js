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

class Auth{
    constructor({domain}){
        this.domain = domain;
        this.headerKey = "X-AUTHTOKEN";
    }

    get(token){
        let agent = request.get(this.domain+"auth/profile");
        agent.set(this.headerKey,token);
        return promiseAgent(agent)
    }

    register(user){
        let agent = request.post(this.domain+"auth/profile");
        agent.send({user})
        return promiseAgent(agent)
    }

    update(token,user){
        let agent = request.put(this.domain+"auth/profile");
        agent.set(this.headerKey,token);
        agent.send({user})
        return promiseAgent(agent)
    }

    delete(token){
        let agent = request.delete(this.domain+"auth/profile");
        agent.set(this.headerKey,token);
        return promiseAgent(agent)
    }
}

module.exports = Auth;