<?php //arrayobject.spec.php

describe('ArrayObject', function() {
    beforeEach(function() {
        $this->arrayObject = new ArrayObject(['one', 'two', 'three']);
    });

    describe('  ', function() {
        it("should return the number of items", function() {
            $client = $this->client;
            $this->client->get("/hoge");
            $response = $this->client->response;

            assert($this->client->response);

            $count = $this->arrayObject->count();
            assert($count === 3, "expected 3");
        });
    });
});