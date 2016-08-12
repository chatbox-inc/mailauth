"use strict"

class Login{

    constructor({request,store}){

        this.request = request;
        this.store = store;
    }

    login(credential){
        return this.request.post("/login").then((response)=>{

        })

    }




}


module.exports = Login