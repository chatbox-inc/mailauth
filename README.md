## メール認証APIのパッケージ

apiauthに対しMailtoken 系のパッケージを追加してまとめて利用可能にしたもの。

メールの送信はDI形式で。

API ドキュメントはこちら

http://editor.swagger.io/#/?import=https://raw.githubusercontent.com/chatbox-inc/mailauth/master/lib/swagger.yml



## Usage

sample フォルダを中心に

- 認証トークンと、ユーザのテーブルモデルとを作成
- ServiceProviderを作成


## 設計方針

Controllerは基本いじらない方向でServiceProviderを組む
(そもそもパッケージの処理内容がApiAuthにコントローラを足しているだけなので)



