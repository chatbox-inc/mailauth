module.exports = {
  path: "profile",
  method: "POST",
  _comment: "プロフィール登録API",
  inputs: {
    user: {
      type: "Object",
      required: true,
      _comment: "ユーザ情報"
    },
  },
  outputs: {
    "status": {
      type: "String",
      value: "OK",
      _comment: "応答ステータス"
    },
    "user":{
      type: "User",
      value: {
        name: "Tom",
        email: "t.togo@gmail.com"
      },
      _comment: "登録済みユーザ情報"
    },
  },
  tests:[
    {
      _comment: "正常系のテスト",
      request: {
        params:{
          name: "hoge",
          email: "t.gotochatbox-inc.com",
          password: "hogehoge"
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