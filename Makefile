code:
	swagger-codegen generate -i lib/swagger.yml -l html -o doc
server:
	php -S 0.0.0.0:8000 -t sample/public
apitest:
	mocha lib/spec/index.js --require lib/spec/enable-power-assert.js
test:
	./vendor/bin/peridot specs/ApiAuth.spec.php
	./vendor/bin/peridot specs/MailAuth.spec.php

