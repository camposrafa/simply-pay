## Simply Pay

Plataforma de usuários comuns e lojistas que podem efetuar pagamentos e depósitos Laravel ([Leia Mais](https://laravel.com/))

## Requisitos de uso

- Clone o repositório
- Certifique-se de ter o docker instalado em sua máquina
- Execute o comando **make dev**
    - Esse comando instalará todas as imagens necessárias para que o projeto esteja pronto para utilização, bem como efetuará as migrations, seeders e criação dos clients do passport para o controle de acesso.

## Endpoints

**Criar usuário**
 - Rota: /user
 - Método POST
 - Payload {
    "name": "Rafa",
    "type": "common"
    "document_type": "cpf"
    "document": "132.465.852-72",
    "email": "rafa@email.com",
    "password": "123456789",
}

**Auth**
 Essa rota é utilizada para realizar login na plataforma
 - Rota: /auth
 - Método POST
 - Payload {
    "email": "Rafa",
    "password": "123456789",
}

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
 - Payload {
    "payee_id": 2,
    "amount": 100
}

 Veja o histórico de pagamentos através dessa rota
 - Rota: /payment
 - Método GET
 - Payload {
    "user_id": 2,
    "amount": 100
}

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
´´docker container exec -ti simply-pay-php php artisan queue:work´´
´´docker container exec -ti simply-pay-php php artisan queue:listen´´
