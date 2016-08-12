"use strict"

var register = null;// injected by export function

var mixin = {
    data: {
        user: {}
    },
    method : {
        sendmail(){
            console.log(this.user)
        }

    }
}

module.exports = (_register)=>{
    register = _register
    return mixin;
}
