module.exports = {
  _path: "profile",
  _method: "get",
  comment: "プロフィール登録API",
  _inputs:[ ],
  _outputs: [
    {
      _type: "String",
      _key: "status",
      _value: "OK",
      comment: "応答ステータス"
    },
    {
      _type: "Object",
      _key: "user",
      comment: "ユーザ情報"
    },
  ],
  _tests:[
    {
      _request: {
        _headers:{
          "X-AUTH":"hogehoge"
        },
        _params:{
          name: "hoge",
          email: "t.gotochatbox-inc.com",
          password: "hogehoge"
        }
      },
      _response: {
        _status: 200,
        _body: {
          status: "OK"
        }
      }
    }
  ]
}