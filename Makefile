code:
	swagger-codegen generate -i lib/swagger.yml -l html -o doc
server:
	php -S 0.0.0.0:8000 -t sample/public
test:
	./vendormocha lib/spec/index.js --require lib/spec/enable-power-assert.js
apitest:
	mocha lib/spec/index.js --require lib/spec/enable-power-assert.js
phptest:
	./vendor/bin/peridot specs

