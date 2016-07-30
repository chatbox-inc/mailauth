"use strict"

const handleRequest = (response)=>{

}

class Register{

    constructor(request){
        this.request = request;
    }

    send(email,data={}){
        var request = this.request.post("/mail/register/send",{email,data})
        return request.then(response => {
            if(response.ok){
                return response.token
            }else{
                throw response.error
            }
        });
    }

    check(token){
        var request = this.request.get("/mail/register/check",{},{
            "X-MAILTOKEN":token
        })
        return request.then(response => {
            if(response.ok){
                return response.token
            }else{
                throw response.error
            }
        });
    }

    check(token){
        var request = this.request.post("/mail/register/check",{},{
            "X-MAILTOKEN":token
        })
        return request.then(response => {
            if(response.ok){
                return response.token
            }else{
                throw response.error
            }
        });
    }
}

module.exports = Register;