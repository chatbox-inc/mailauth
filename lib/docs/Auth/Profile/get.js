module.exports = {
  path: "profile",
  method: "get",
  _title: "ユーザプロフィール参照",
  _comment: "プロフィール登録API",
  inputs:[],
  outputs: {
    status: {
      type: "String",
      value: "OK",
      _comment: "応答ステータス"
    },
    user:{
      type: "Object",
      _comment: "ユーザ情報"
    },
  },
  tests:[
    {
      request: {
        headers:{
          "X-AUTH":"hogehoge"
        },
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