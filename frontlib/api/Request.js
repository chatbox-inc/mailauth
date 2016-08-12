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


class Request{

    constructor(url){
        this.url = url
    }

    request(method,path,query={},header={}){
        var agent = request[method](this.url+path);
        Object.keys(header).forEach((key)=>{
            agent.set(key,header[key])
        })
        agent.send(query)
        return new Promise((resolve)=>{
            agent.end((e,response)=>{
                //console.log(response)
                if(response){
                    resolve(response)
                }else{
                    throw e;
                }
            })
        })
    }

    get(path,query={},header={}){
        return this.request("get",path,query,header)
    }

    post(path,query={},header={}){
        return this.request("post",path,query,header)
    }

    put(path,query={},header={}){
        return this.request("put",path,query,header)
    }

    patch(path,query={},header={}){
        return this.request("patch",path,query,header)
    }

    delete(path,query={},header={}){
        return this.request("delete",path,query,header)
    }
}


module.exports = Request;


