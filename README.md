# Teste [Escape](http://www.escape.ppg.br)

Teste de conhecimentos para a vaga de Desenvolvedor Backend Pleno na Escape.

## Requisitos da vaga

- Experiência com PHP; 
- Conhecimento em orientação a objetos; 
- Conhecimentos em bancos de dados MySQL; 
- Experiência com integrações entre sistemas através de API’s.

Diferenciais:
- Experiência com algum framework (Pontos a mais para Laravel);
- Conhecimento em ferramentas de versionamento (Git);
- Conhecimento de Design Patterns;
- Conhecimento em HTML/CSS;
- Conhecimento em pré-processadores CSS (SASS, LESS, etc);
- Conhecimento em javascript.

## Informações do teste
Você deve criar um sistema de cadastro de notícias. Cada notícia vai possuir uma categoria, um título, texto e uma foto.

Deve ser possível listar, criar, editar, visualizar e excluir as notícias. Também deve ser possível adicionar novas categorias. 
A visualização da notícia deve ser em um modal (pop-up) que abra via javascript.


## Regras do teste

- No back-end, você deve utilizar o framework Laravel;
- No front-end é livre. Pode usar bootstrap ou qualquer framework de preferência;
- Você deve fazer o primeiro commit depois de instalar o seu ambiente base;
- Tempo para a realização: 2 Horas (realizar último commit).

## Testar o projeto

Se tem interesse em testar o projeto basta cloná-lo, configurar o banco no .env e executar os comandos a seguir:

Instalar as dependências:
```
composer install
npm install
```
Criar e popular o banco (não esqueça de criar e apontar o banco no .env):
```
php artisan migrate
php artisan db:seed
```

### Outros comandos úteis:

Gerar chave:
```
php artisan key:generate
```
Compilar assets:
```
npm run dev
```
Criar link do storage:
```
php artisan storage:link
```

## Criado com

* [Laravel](https://laravel.com) - The PHP Framework For Web Artisans
* [VUE](https://vuejs.org) - The Progressive JavaScript Framework


## Autor

* **Róger Ninow** - [Github](https://github.com/rogerninow) | [Linkedin](https://www.linkedin.com/in/rogerninow) | [Site](https://www.rogerninow.com)


## Licença

Este projeto está licenciado sob a licença MIT - veja o arquivo LICENSE.md para obter detalhes

