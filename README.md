Vou escrever aqui a funcionalidade do codigo e seu passo a passo.
O pokedigitação é um jogo simples, em seu resumo vc so tem que digitar o nome do pokemon certo entao ganha 1 ponto, vc precisa logar para acessar o jogo e pode ver sua colocação no ranking.
PASSO A PASSO:
A primeira coisa que fiz foi o front-end a logica do jogo é simples verfica se a frase no input é igual ao pokemon se for computa um ponto e reseta o tempo, a unica coisa mais complicada esta no fetch em um api que contem todos os pokemons da primeira geração, optei por fazer um jogo simples porem dinamico e funcional.
O index e css são bem simples tambem.
Depois de ja ter esse jogo funcional fui fazer o back-end primeiramente, crie um banco de dados com informações comuns de usuario como senha id e nome e coloquei tambem sua pontucao_total que iria usar mais pra frente.
Fiz a connect em um php separa juntamente com a funcao de verificao de login, e fiz um sistema de registro e login simples, onde no registro escreve as credenciais no bd e o login faz uma verificação, estando verdadeiro vc é levado até o index.
A parte mais complicada creio ser o ranking e a atalização do recorde pessoal, acredito que poderia ter essa parte um pouco melhor talvez utilizando mais colunas no bd, mas o que eu fiz deu certo tbm
