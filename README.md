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
 - /post-types/class.mc-credit_lines-cpt.php - Configuração do CUSTOM POST TYPE 'mc-credit_lines'  (carregado pela classe principal)
 - functions/functions.php - Este é o functions.php do plugin, define a  conexão com o arquivo JS utilizado nesse projeto (carregado pela classe principal)
 - /assets/ - Pasta com os assets CSS e imagens utilizados pelo plugin
 - shortcodes/class.mc-credit_lines-shortcode.php - Configura como o shortcode vai ser processado. O shortcode vai exibir o conteúdo de um post do tipo 'mc-credit_lines'. A parte visual é definida no arquivo '/views/mc-credit_lines-shortcode.php
 - /vendor/main.js - Arquivo JS utilizado no plugin (registrado na classe principal - esse arquivo poderia ser salvo na pasta assets, fica a critério do desenvolvedor)
 - /views/ - Toda parte visual do plugin, tanto no frontend como no admin (esses arquivos são carregados por várias classes, ao invés de inserir HTML nas classes, faz em arquivos separados)
 - /views/mc-credit_lines_metabox.php - HTML para o admin, campos do formulário de configuração do plugin.
 - /views/settings-page.php - Configuração dos campos de formulário no ADMIN para configuração do plugin.
- /views/mc-credit_lines-shortcode.php - Parte visual (HTML, CSS e JS) que seá renderizado pelo shortcode.
