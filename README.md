Teste Kzas:

Seguir passo à passo para testar o projeto:

1 - Ter o composer e PHP^7 instalado<br>
2 - rodar o comando no terminal <b>git clone https://github.com/ltvilla/TesteKzas.git</b><br>
3 - rodar o comando no terminal <b>composer install</b><br>
4 - rodar o comando no terminal <b>php artisan db:seed</b> (será gerado um usuário teste email: <b>tiago@testekzas.com</b> senha: <b>teste</b>)<br>
5 - rodar o comando no terminal <b>php artisan storage:link</b> para que o upload seja realizado no public via storage link<br>
5 - Para gerar informações aleatórias, você pode rodar o comando <b>php artisan db:seed --class=AddresseSeeder</b> (serão gerados alguns dados aleatórios)<br>

