# MC Credit Lines
 Adiciona um simulador de de linhas de crédito - financiamentos - em qualquer página do seu site WP.<br>
 Informe o nome da linha, a taxa de juros e limite de parcelas no admin.<br>
 O frontend vai exibir um campo para o valor desejado e número de parcelas, o componente
 vai exibir o valor das parcelas.<br>
 Perfeito para sites de entidades financeiras.<br>

## Características:
Esse plugin utiliza a estratégia de CUSTOM POST TYPE e gera um SHORTCODE para exibição dentro de blocos Elementor ou Gutemberg para cada linha adiconada.
 
 ## Estrutura:
 - /mc-credit_lines.php - Classe principal. Carregamento dos principais arquivos do plugin, registro dos recursos CSS e JS do plugin e métodos de ativação, desativação, desinstalação e construção do menu do admin.
 - /class.mc-credit_lines-settings.php - Classe para definição das telas do admin chamadas pelos itens do menu (carregado pela classe principal)
 - post-types/class.mc-credit_lines-cpt.php - Nonono  (carregado pela classe principal)
 - functions/functions.php - Nononon (carregado pela classe principal)