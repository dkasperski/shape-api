**RESTful API for shapes**

Installation
------------

* clone project to empty directory
* execute command: "composer install" in project directory
* execute command: "bin/console doctrine:schema:create" in project directory
* execute command: "bin/console doctrine:fixtures:load --append" in project directory

Api testing
------------

* send POST request under url:

/createClient

with body:

{
   "redirect-uri": "shape-api.pl",
   "grant-type": "password"
}

you will receive a similar response to:

{
  "client_id": "1_3h7ohwsn1uyo0og040oc8s8c8csc4wcocws40c8cg4c8so8g8k",
  "client_secret": "1io41krmqdtwcco0ok4c84sgcok480000so4888sscksc4s4go"
}


* send POST request under url:

/oauth/v2/token

with body:

{
   "redirect-uri": "shape-api.pl",
   "grant_type": "password",
   "client_id": "1_3h7ohwsn1uyo0og040oc8s8c8csc4wcocws40c8cg4c8so8g8k",
   "client_secret": "1io41krmqdtwcco0ok4c84sgcok480000so4888sscksc4s4go",
   "username": "test",
   "password": "test"
}

and header:

Content-type: application/json

you will receive a similar response to:

{
  "access_token": "MDE1NjI2OGNkMTgzYzlmOTkxZmZlMmVlZjcxM2U2YTA3MDI1NDQxMTk0ODU3ZWQzZGE0ODI5MjA5YmEyYmI0Nw",
  "expires_in": 86400,
  "token_type": "bearer",
  "scope": null,
  "refresh_token": "NGE4ZWIwNGFkODk5ZTI3OTM3YjZiMmY5MmMwMzM4ODM3MDE3NzEyMThlNzlhOWYwYjlmYTc0NzQyYmQ1NjA4Mg"
}

we should receive the access token that we should send to the API request in headers, as follows

Authorization: Bearer MDE1NjI2OGNkMTgzYzlmOTkxZmZlMmVlZjcxM2U2YTA3MDI1NDQxMTk0ODU3ZWQzZGE0ODI5MjA5YmEyYmI0Nw