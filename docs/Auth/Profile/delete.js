module.exports = {
  path: "profile",
  method: "PUT",
  _title: "プロフィール削除API",
  _comment: "ユーザ退会処理を行います。",
  _auth: true,
  inputs: {
  },
  outputs: {
    "status": {
      type: "String",
      value: "OK",
      _comment: "応答ステータス"
    }
  },
  tests:[
    {
      _comment: "正常系のテスト",
      request: {
        params:{
          user:{
            name: "hoge",
            email: "t.gotochatbox-inc.com",
            password: "hogehoge"
          }
        }
      },
      response: {
        status: 200,
        body: {
          status: "OK"
        }
      }
    }
  ]
}