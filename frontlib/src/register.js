"use strict"

const handleResponse = (response)=>{
    if(response.ok){
        //console.log(response)
        return response.body
    }else{
        console.log(response)
        throw response.error
    }
}

class Register{

    constructor({request}){
        this.request = request;
    }

    send(email,data={}){
        var request = this.request.post("mail/register/send",{email,data})
        return request.then(response => handleResponse(response));
    }

    check(token){
        var request = this.request.get("mail/register/check",{},{
            "X-MAILTOKEN":token
        })
        return request.then(response => handleResponse(response));
    }

    handle(token,data={}){
        var request = this.request.post("mail/register/handle",{
            user:data
        },{
            "X-MAILTOKEN":token
        })
        return request.then(response => handleResponse(response));
    }
}

module.exports = Register;