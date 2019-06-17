# Projeto Bolão - Laravel

Este projeto é um aplicativo de bolão de apostas criado para estudo utilizando como base o curso [Projeto Prático com Laravel](https://www.udemy.com/projeto-pratico-com-laravel) do [Guilherme Ferreira](https://www.udemy.com/user/guilherme-ferreira-4/), criador do [GuiaCódigo](https://www.guiacodigo.com/).

Utiliza [Laravel](https://laravel.com/) como framework.

Versão Laravel utilizada: 5.6.39.

**Coisas interessantes abordadas no curso durante este projeto:**
- OOP.
- MVC.
- Banco de dados Sqlite (trabalhando com Migrate).
- Crud.
- Trabalhando com repositórios.
- Como criar e trabalhar com interfaces.
- Bootstrap 4.
- Templates e componentes com o Blade.
- Injeção de dependência.
- Sistema de idiomas (internacionalização) do Laravel.
- Sistema Acl.
- Modelos de relacionamento.
- Criação e utilização de Seeders.

Para criar as tabelas no bando de dados:
```
php artisan migrate
```

Para utilizar os seeders deste projeto, basta rodar o comando:
```
php artisan db:seed
```
O seed criará dois usuários:

| user | email | password | role |
| ---- | ----- | -------- | ---- |
| Admin | admin@mail.com | 123456 | Admin |
| Manager | manager@mail.com | 123456 | Gerente |

Para criar as tabelas e já utlizar os seeds:
```
php artisan migrate --seed
```

#### Passos para criação de novo CRUD no admin:
- Model e migration.
- Controller.
- Traduções.
- Interface.
- Repository.
- Registrar no AppServiceProvider.
- Views.

> Em progresso...

Este projeto utiliza a [licença MIT](https://opensource.org/licenses/MIT).