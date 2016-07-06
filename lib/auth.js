"use strict"

const Token = require("./api/Token.js");
const Profile = require("./api/profile.js");

/**
 * Auth Token を内部に持った認証用のライブラリ
 */
class Auth {

    constructor(options){
        this.profile = new Profile(options);;
        this.token = new Token(options);

        this._token = null;
    }

    register(userdata){
        return this.profile.post(userdata).then((e,res)=>{
            if(e) throw e;
            return res.body.user;
        });
    }

    login(credential){
        return this.token.login(credential).then((e,res)=>{
            if(e) throw e;
            this._token = res.body.token;
            return res.body.token;
        })
    }

    //refresh(credential){
    //
    //}

    logout(){
        return this.token.logout(this._token).then((e,res)=>{
            if(e) throw e;
            return true;
        })
    }

    get(){
        return this.profile.get(this._token).then((e,res)=>{
            if(e) throw e;
            return res.body.user;
        })
    }

    update(user){
        return this.profile.update(this._token,user).then((e,res)=>{
            if(e) throw e;
            return res.body.user;
        })
    }

    delete(user){
        return this.profile.delete(this._token).then((e,res)=>{
            if(e) throw e;
            return res.body.user;
        })
    }
}

module.exports = Auth;