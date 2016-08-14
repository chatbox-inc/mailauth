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

class Login{

    constructor({request,store}){

        this.request = request;
        this.store = store;
    }

    login(credential){
        var request = this.request.post("/login",{credential})
        return request.then((response)=> {
            if(response.ok){
                //console.log(response)
                this.store.set("LOGIN-TOKEN",response.body.token.key)
                return response.body
            }else{
                console.log(response)
                throw response.error
            }
        })
    }




}


module.exports = Login