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


/**
 *
 *
 * @prop {Request} request
 */
class Profile{
    /** @param {Request} request - hoge*/
    constructor({request}){
        this.request = request.post
    }

    headerKey(token){
        return {
            "X-AUTHTOKEN": token
        }
    }

    get(token){
        var request = this.request.get("profile",{},this.headerKey(token))
        return request.then(response => handleResponse(response));
        //this.request.
        //let agent = request.get(this.domain+"auth/profile");
        //agent.set(this.headerKey,token);
        //return promiseAgent(agent)
    }

    register(user){
        var request = this.request.post("profile",{user},{})
        return request.then(response => handleResponse(response));
    }

    update(token,user){
        var request = this.request.put("profile",{user},this.headerKey(token))
        return request.then(response => handleResponse(response));
    }

    delete(token){
        var request = this.request.delete("profile",{},this.headerKey(token))
        return request.then(response => handleResponse(response));
    }
}

module.exports = Profile;