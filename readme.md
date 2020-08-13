# Exemplo "REST" API simples em PHP

A API é um simples exemplo de  uma API "REST" com PHP sem o auxílio de frameworks.

## Métodos

#### Para executar o seguinte comando no banco de dados :
```sql
SELECT * FROM users;
```

Basta enviar uma requisição da seguinte maneira.

http://localhost/api-rest-php/src/Controller/Read.php?User

Com o corpo da requisição vazio.

`{}`

#### Para executar o seguinte comando no banco de dados :
```sql
SELECT * FROM users WHERE id = 1;
```

Basta enviar uma requisição da seguinte maneira.

http://localhost/api-rest-php/src/Controller/Read.php?User

Com o corpo da requisição com os seguintes valores `selectorType e selectorValue.`

`{
 	"selectorType": "id",
 	"selectorValue": 1
 }`
 
Seletores válidos de acordo com o banco de exemplo são `(id, name, email).`

#### Para executar um create 

Basta enviar uma requisição da seguinte maneira.

http://localhost/api-rest-php/src/Controller/Create.php?User

Com o corpo da requisição com os seguintes valores `name, email e password.`

`{
 	"name": "Andre",
 	"email": "andrefmandrade@outlook.com",
 	"password": "123456"
 }`
 
#### Para executar um update 

Basta enviar uma requisição da seguinte maneira.

http://localhost/api-rest-php/src/Controller/Update.php?User

Com o corpo da requisição com os seguintes valores `id, name, email e password.`

`{
    "id": 1,
    "name": "Andre Felipe",
    "email": "andrefmandrade@outlook.com",
    "password": "12345678"
}`
