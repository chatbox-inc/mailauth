module.exports = {
  path: "token",
  method: "GET",
  _title: "トークンチェック",
  _comment: "トークンの有効性判定を行います。",
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