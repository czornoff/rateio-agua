# RATEIO DE ÁGUA
Sistema para acompanhamento de rateio de água de condomínio
O sistema permite após a importação dos dados, acompanhar o consumo anual do local e obter informações analíticas através do Gemini.

## Configuração
Edite o arquivo ``` ./util/config.php ``` e altere as variáveis conforme solicitado

Crie um Banco de Dados MySQL ou MariaDB e execute o arquivo ``` ./util/script.sql ```


## Instalação extra
### PhpMailer
Após o upload dos arquivos para o servidor acesse a página inicial do projeto e digite o seguinte comando
``` composer require phpmailer/phpmailer ```

# TO DO
- Sistema de lembrete de senha
- Cadastro de Proprietários e Moradores
- Geração de Relatórios e Extrato em PDF
- Importação Mensal dos Dados
- Ajuste dos valores com observações