module.exports = {
  path: "token",
  method: "DELETE",
  _title: "ログアウト処理",
  _comment: "ログアウト処理を行いAPIを削除します。",
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