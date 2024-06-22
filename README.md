## Simply Pay

Plataforma de usuários comuns e lojistas que podem efetuar pagamentos e depósitos Laravel ([Leia Mais](https://laravel.com/))

## Técnicas e recursos e utilizados
 - Laravel 10
 - Docker
 - Design Patterns;
 - SOLID;
 - Testes unitários e de feature;

## Requisitos de uso

- Clone o repositório
- Certifique-se de ter o docker instalado em sua máquina
- Execute o comando **make dev**
    - Esse comando instalará todas as imagens necessárias para que o projeto esteja pronto para utilização, bem como efetuará as migrations, seeders e criação dos clients do passport para o controle de acesso.

## Endpoints
Dispoível também para utilização via [POSTMAN](https://www.postman.com/warped-eclipse-904999/workspace/sp/collection/13893383-c6e50ccc-6ff7-409c-bbe2-2d1e02eed392?action=share&creator=13893383
)

**Criar usuário**
 - Rota: /user
 - Método POST
 - Payload ``{
    "name": "Rafa",
    "type": "common"
    "document_type": "cpf"
    "document": "132.465.852-72",
    "email": "rafa@email.com",
    "password": "123456789",
}``

**Auth**
 Essa rota é utilizada para realizar login na plataforma
 - Rota: /auth
 - Método POST
 - Payload ``{
    "email": "Rafa",
    "password": "123456789",
}``

**Logged**
 Essa rota é utilizada para verificar informações do usuário logado
 - Rota: /logged
 - Método GET

**Logout**
 Essa rota é utilizada para deslogar
 - Rota: /logout
 - Método DELETE

 **Payment**
Realize pagamentos através dessa rota
 - Rota: /payment
 - Método POST
 - Payload ``{
    "payee_id": 2,
    "amount": 100
}``

 Veja o histórico de pagamentos através dessa rota
 - Rota: /payment
 - Método GET
 - Payload ``{
    "user_id": 2,
    "amount": 100
}``

**Wallet**
 Veja informações da carteira através dessa rota
 - Rota: user/{id}/wallet
 - Método GET

 Efetue um depósito através dessa rota ()
 - Rota: user/{id}/wallet
 - Método POST
 - Payload {
    "balance": 100
}

## Processamento Assincrono

A transação consulta um processo de autorização e posteriormente o envio de uma notificação por email. Esse processo é consultado em segundo plano.
Para que os processos sejam executados, é necessário executar os seguintes comandos em seu terminal:
´´make queue-work´´
´´make queue-listen´´

*Detalhe importante:* para que o projeto funcione de maneira mais leve em seu ambiente local, recomendamos que siga os passos anteriores, mas em ambientes de stage ou produção,
é necessário a configuração de um supervisor ([Leia mais aqui](https://laravel.com/docs/10.x/queues#supervisor-configuration))

## Monitoramento de qualidade

**PHP-STAN**
 - Para analizar o código, basta digitar o comando ``make php-stan`` em seu terminal

**Testes**
 - As funcionalidades desse repositório contam com testes unitários e de feature. Para executá-los, basta digitar o comando ``make tests`` em seu terminal
