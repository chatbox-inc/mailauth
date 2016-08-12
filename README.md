## MailAuth API

````
$ npm i  https://github.com/chatbox-inc/mailauth.git
````


````
var mailauth = require("mailauth")
````

## Usage

### Register

register.send(email,data)

register.check(token)

register.handle(token,data)

### Login

login.login(credential)

login.logout

### Profile

new profile(token)

profile.get()

profile.update()

profile.delete()
