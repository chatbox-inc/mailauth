module.exports = {
  path: "token",
  method: "POST",
  _comment: "ログイントークン発行API",
  inputs: {
    credential: {
      type: "Credential",
      required: true,
      _comment: "認証情報"
    },
  },
  outputs: {
    "status": {
      type: "String",
      value: "OK",
      _comment: "応答ステータス"
    },
    "token":{
      type: "String",
      value: "xxxxos-hoggehoge",
      _comment: "認証用トークン"
    },
  },
  tests:[
    {
      _comment: "正常系のテスト",
      request: {
        params:{
          credential:{
            email: "t.gotochatbox-inc.com",
            password: "hogehoge"
          }
        }
      },
      response: {
        status: 200,
        body: {
          status: "OK",
          token: "xxxxos-hogehogehoge"
        }
      }
    }
  ]
}