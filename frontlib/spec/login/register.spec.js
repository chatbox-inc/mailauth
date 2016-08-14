"use strict"

var assert = require("power-assert");

var createSampleUser = ()=>{
    return {

    }
}


module.exports = ({store,register,login,profile})=>{

    let userData = {
        email: "t.goto+"+Math.random().toString(36).slice(-8)+"@chatbox-inc.com",
        password: "chatbox5678",
        name: "後藤"
    }
    let {email,password,name} = userData;

    describe("REGISTER", ()=>{

        var mailToken = null

        it('CAN REGISTER',() => {
            return register.send(email,{}).then(({token})=>{
                assert(token.key)
                mailToken = token.key
            })
        });
        it('CAN CHECK TOKEN',() => {
            return register.check(mailToken)
        });
        it('CAN REGISTER',() => {
            return register.handle(mailToken,{name,password})
        });
    })

    describe("LOGIN", ()=>{

        it('CAN LOGIN',() => {
            return login.login({email,password}).then(({token})=>{
                assert(token.key)
                assert(store.get("LOGIN-TOKEN"))
            })
        });
    })

    describe("PROFILE", ()=>{

        it('CAN GET',() => {
            return login.login({email,password}).then(({token})=>{
                assert(token.key)
                assert(store.get("LOGIN-TOKEN"))
            })
        });
    })
}