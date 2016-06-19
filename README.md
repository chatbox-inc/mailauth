## 必要API

## 旅行企画

GET /api/trip/

旅行企画の一覧を取得

### INPUT


### OUTPUT

````
{
    pager : {
        count: 10,
        page: 1,
        hasMore: true
    },
    trip:[
        {
            title: "夏の旅企画！",
        }
    ]
}
````
GET /api/trip/{itemId}

送信パラメータ


旅行企画の一覧を取得

POST /api/trip/apply

旅行企画への申込
