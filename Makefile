code:
	swagger-codegen generate -i lib/swagger.yml -l html -o doc
server:
	php -S localhost:8000 -t sample/public