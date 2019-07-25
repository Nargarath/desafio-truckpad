# DESAFIO TRUCKPAD


## Tecnologias usadas no projeto

- [Laravel](https://laravel.com/)
- [VueJS](https://github.com/vuejs)
- [Vuex](https://github.com/vuejs/vuex)
- [JWTAuth](https://jwt.io/)
- [Ziggy](https://github.com/tightenco/ziggy)


## Padrões do projeto

- [Installation](https://laravel.com/docs/5.8/installation)
- [Config](https://laravel.com/docs/5.8/configuration)
- [Routes](https://laravel.com/docs/5.8/routing)
- [Controllers](https://laravel.com/docs/5.8/controllers)
- [Database](https://laravel.com/docs/5.8/database)
    - [Models](https://laravel.com/docs/5.8/eloquent)
    - [Migrations](https://laravel.com/docs/5.8/migrations)
    - [Seeds](https://laravel.com/docs/5.8/seeding)
- [Views](https://laravel.com/docs/5.8/views)
- [REST](https://pt.wikipedia.org/wiki/REST)


## Instalando e rodando o projeto

### 1 - Faça o clone projeto

```bash
# https
git clone https://github.com/Nargarath/desafio-truckpad.git

# ssh
git@github.com:Nargarath/desafio-truckpad.git

```

### 2 - Instale todos as dependencias do composer, npm e compile os arquivos do npm

```bash

composer install

```

### 3 - Copie o `.env`

Há um exemplo do arquivo de configuração que deve ser tomado como exemplo. Para isso utilize os comandos:

```bash

cp .env.example .env

```

### 4 - Configurar o `.env`

Aqui é onde vai ser definido as configurações básicas para funcionamento dos softwares ligados ao projeto. No caso, só estamos utilizando o banco de dados sql e o proprio laravel, por tanto, configurar todas as variáveis que iniciarem com 'DB_'.

#### Recomendação:

Pra database usar, de preferencia, o postgres que tem suporte fácil à JSON. Se for usar MySQL, usar o mariadb a partir da versão: 10.4.6


### 5 - Gerar chave de encriptação do laravel e do JWT 

Nessa etapa , você vai iniciar o comando abaixo no bash ou cmd, estando dentro da pasta do projeto, para que o laravel gere uma chave que ele usa para encriptação de dados.

```bash

php artisan key:generate
php artisan jwt:secret

```


### 6 - Criar toda estrutura do banco de dados

Nessa etapa, com o comando abaixo, o laravel vai usar as configurações do .env para conectar-se no banco de dados e criar as tabelas configuradas como migrations. 

Obs: Essa etapa pode dar erro caso o banco de dados configurado não tenha sido criado. As migrations não criam o banco de dado, apenas as tabelas dentro dele.

```bash

php artisan migrate

```

### 7 - Popular as tabelas com dados teste

Aqui, o laravel irá popular os banco de dados com dados pré-estabelecidos nas seed que , como o proprio nome diz, são "sementes" que fazem o banco de dados "crescer". Os dados irão ajudar nos testes.


```bash

php artisan db:seed

```

### 8 - Rode o projeto

Nessa etapa você pode fazer como quiser, existem vária formas de você hospedar o projeto para acessa-lo. Aqui , explicarei o jeito mais rápido que é usando o server do próprio laravel. Para inicializa-lo, você precisa digitar o comando abaixo no console ou base , em seguida, o script retornará o link que estará rodando para você acessa-lo.

```bash

php artisan serve

```

## User Padrão

O sistema tem um usuário padrão no admin que é inserido pela seed, para usa-lo é só acessar o login do admin com as credenciais:

```
Login: admin@email.com
Password: secret
```

## Em produção:

A aplicação está rodando em produção para agilizar o processo de validação.

```
http://truckpad-challange.herokuapp.com/
```


