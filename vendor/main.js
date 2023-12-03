var calc_parcelas = (taxa, maxparcs, parcelas, el)=> {
    //Navega para a tabela principal
    const tabela = el.parentNode.parentNode.parentNode.parentNode
    //Navega para o input com o valor desejado
    const valor = tabela.querySelector('.simulacao_valor').value
    //Retorna o campo com quantidade de parcelas
    const inputParcelas =  tabela.querySelector('.simulacao_parcelas')
    //Retorna a tag span onde o resultado deve ser exibido
    const el_saida = tabela.querySelector('.txt_val_parcelas')
    //Converte o valor da taxa em um valor para cálculo, exemplo(2% = 0.02)
    const taxaPercent = taxa / 100

    var resultado = 'R$ 0,00'
    
    if(parseInt(valor) == 0){
        resultado = 'O campo "Valor desejado" não pode ser zero.'
        inputParcelas.value = 0
    }else if(parcelas > maxparcs){
        resultado = 'Quantidade máxima de parcelas é ' + maxparcs + ', digite outro valor.'
    }else if(inputParcelas.value == 0){
        resultado = 'Digite um total de parcelas.'
    }else{
        resultado = parseInt(valor) * ((Math.pow(1 + taxaPercent, parcelas) * taxa) / (Math.pow(1 + taxaPercent, parcelas) - 1));
    }
    el_saida.innerText = resultado
    console.log(taxaPercent)
}

/*
function calculaParcela(valor, parcelas, juros)
    {
        resultado = valor * ((Math.pow(1 + juros, parcelas) * juros) / (Math.pow(1 + juros, parcelas) - 1));
        return resultado;
    }
//Exemplo uso
//parcela = calculaParcela(valor, f, 0.0120);
            //parcela = String(parcela.toFixed(2).replace(".", ","));
   


    //simulação
    var juros, vlrEmprestimo, numParcelas, escolha;
    $('.inputVlr').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});


    $('#combo-linhas-credito').change(function(e){
        $('#txt-resultado, .txt-auxiliar-resultado').text('');
        $('.parcelas, .inputVlr').val('');
        escolha = $(this).val();  
        texto = '';
        switch(escolha) {


            case 'facil':
                texto = 'Com a Fácil Selic a taxa de juros é de';
                juros = 1.20;
                $('#txt-taxa-juros').html(juros.toFixed(2) + '% a.m.');
                break;
           
            case 'smart':
                texto = 'Com a Smart a taxa de juros é de';
                juros = 1.30;
                $('#txt-taxa-juros').html(juros + '% a.m.');
                break;


            case 'pessoal':
                texto = 'Com a Pessoal a taxa de juros é de';
                juros = 1.49;
                $('#txt-taxa-juros').html(juros + '% a.m.');
                break;


            case 'mao_roda':
                texto = 'Com a Mão na Roda a taxa de juros varia de';
                juros = 1.20;
                $('#txt-taxa-juros').html('1,20% a.m.');
                break;


            case 'refin':  
                texto = 'Com a Refin a taxa de juros é de';
                juros = 1.69;
                $('#txt-taxa-juros').html(juros + '% a.m.');
                break;


            case 'refin_nosso_bem':
                texto = 'Com a Refin Nosso Bem a taxa de juros é de';
                juros = 1.95;
                
                $('#txt-taxa-juros').html(juros + '% a.m.');
                break;


            case 'pessoal_nosso_bem':  
                texto = 'Com a Pessoal Nosso Bem a taxa de juros é de';
                juros = 1.60;
                //juros = 1.50;
                $('#txt-taxa-juros').html(juros + '% a.m.');
                break;


            default:
                texto = '';
                juros = '';
                $('#txt-taxa-juros').html('');
        }


        $('#txt-linha-selecionada').fadeOut(0);
        $('#txt-taxa-juros').fadeOut(0);
        $('#txt-taxa-juros').fadeIn(400);
        $('#txt-linha-selecionada').html(texto).fadeIn(400);
    });


    //Campo num de parcelas somente números


    $('.parcelas').keyup(function(){
        $(this).val(this.value.replace(/\D/g, ''));
    })


    //calcula parcelas empréstimo


    $('.parcelas, .inputVlr').keyup(function() {






        if($('.parcelas').val() > 0 && parseFloat($('.inputVlr').val()) > 0 ){


            switch(escolha) {


            case 'facil':
                simulacaoFacil();
                break;
            case 'smart':
                simulacaoSmart();
                break;
            case 'pessoal':
                simulacaoPessoal();
                break;
            case 'mao_roda':
                simulacaoMaoRoda();
                break;
            case 'refin':  
                simulacaoRefin();
                break;
            case 'refin_nosso_bem':
                simulacaoRefinNossoBem();
                break;
            case 'pessoal_nosso_bem':
                simulacaoPessoalNossoBem();
                break;
            default:                


        }


                       


        $('.txt-auxiliar-resultado').text('Valor da parcela');


        $('#txt-resultado, .txt-auxiliar-resultado').fadeIn(400);


        }          


       


    });






    function simulacaoFacil()


    {            


        if($('.parcelas').val() > 60)
        {
            alert('Máximo de 60 parcelas');
            $('#txt-resultado, .txt-auxiliar-resultado').text('');
            $('.parcelas, .inputVlr').val('');
        }


        else


        {
            var valor = $('.inputVlr').val();
            valor = parseFloat(valor.replace(".", "").replace(",", "."));
            valor = (valor * 1.00033) * 1.0173;
            var f = $('.parcelas').val();
            if (f == '') {
                f = 1;
            }


            parcela = calculaParcela(valor, f, 0.0120);
            parcela = String(parcela.toFixed(2).replace(".", ","));
            $('#txt-resultado').text(parcela);
            $('#txt-resultado').fadeIn(400);                


        }


    }






    function simulacaoSmart()
    {
        if($('.parcelas').val() > 10)
        {
            alert('Máximo de 10 parcelas');
            $('#txt-resultado, .txt-auxiliar-resultado').text('');
            $('.parcelas, .inputVlr').val('');
        }
        else
        {
            $('#txt-resultado').fadeOut(0);
            var valor = $('.inputVlr').val();
            valor = parseFloat(valor.replace(".", "").replace(",", "."));
            valor = (valor * 1.00033) * 1.0173;
            var f = $('.parcelas').val();


            if (f == '') {
                f = 1;
            }


            parcela = calculaParcela(valor, f, 0.0130);
            //parcela = calculaParcela(valor, f, 0.013);
            parcela = String(parcela.toFixed(2).replace(".", ","));
            $('#txt-resultado').text(parcela);
            $('#txt-resultado').fadeIn(400);
        }
    }










    function simulacaoPessoal()


    {


        if($('.parcelas').val() > 36)


        {


            alert('Máximo de 36 parcelas');


            $('#txt-resultado, .txt-auxiliar-resultado').text('');


            $('.parcelas, .inputVlr').val('');


        }


        else


        {


            $('#txt-resultado').fadeOut(0);


            var valor = $('.inputVlr').val();


            valor = parseFloat(valor.replace(".", "").replace(",", "."));


            valor = (valor * 1.00033) * 1.0173;


            var f = $('.parcelas').val();


            if (f == '') {


                f = 1;


            }


            //if(f < 6){


            //    f=6;


            //}


            parcela = calculaParcela(valor, f, 0.0149);


            parcela = String(parcela.toFixed(2).replace(".", ","))


            $('#txt-resultado').text(parcela);


            $('#txt-resultado').fadeIn(400);


        }


    }










    function simulacaoMaoRoda()
    {


        if($('.parcelas').val() > 60)
        {


            alert('Máximo de 60 parcelas');
            $('#txt-resultado, .txt-auxiliar-resultado').text('');
            $('.parcelas, .inputVlr').val('');


        }
        else
        {


            $('#txt-resultado').fadeOut(0);
            var valor = 0.0;
            var valorJuros = 0.0;
            var amortizacao = 0.0;
            var parcela = 0.0;
            var valor = $('.inputVlr').val();
            var f = $('.parcelas').val();


            if (f == '') {
                f = 1;
            }


            valor = parseFloat(valor.replace(".", "").replace(",", "."));
                valor = valor - (valor * 0.00139);
                var taxaQ = 500 / f;
                var taxaIof = (valor * 0.02917) / f;


                //1,20% de 1 a 60 meses
                parcela = calculaParcela(valor, f, 0.0120);
                $('.spanTaxa').text('Taxa 1,20%');
                
                parcela = parcela + taxaIof + taxaQ;
                parcela = String(parcela.toFixed(2).replace(".", ","))
                $('#txt-resultado').text(parcela);
                $('#txt-resultado').fadeIn(400);            


            }
    }










    function simulacaoRefin()
    {
        if($('.parcelas').val() > 36)
        {
            alert('Máximo de 36 parcelas');
            $('#txt-resultado, .txt-auxiliar-resultado').text('');
            $('.parcelas, .inputVlr').val('');
        }
        else
        {
            $('#txt-resultado').fadeOut(0);
            var valor = $('.inputVlr').val();
            valor = parseFloat(valor.replace(".", "").replace(",", "."));
            valor = (valor * 1.00033) * 1.0173;
            var f = $('.parcelas').val();
            if (f == '') {
                f = 1;
            }


            //if(f < 6){
            //    f=6;
            //}


            parcela = calculaParcela(valor, f, 0.0169);
            parcela = String(parcela.toFixed(2).replace(".", ","))
            $('#txt-resultado').text(parcela);
            $('#txt-resultado').fadeIn(400);
        }
    }


   


    function simulacaoRefinNossoBem()
    {
        if($('.parcelas').val() > 60)
        {
            alert('Máximo de 60 parcelas');
            $('#txt-resultado, .txt-auxiliar-resultado').text('');
            $('.parcelas, .inputVlr').val('');
        }
        else
        {
            $('#txt-resultado').fadeOut(0);
            var valor = $('.inputVlr').val();
            valor = parseFloat(valor.replace(".", "").replace(",", "."));
            valor = (valor * 1.00033) * 1.0173;
            var f = $('.parcelas').val();
            if (f == '') {
                f = 1;
            }


            //if(f < 6){
            //    f=6;
            //}


            parcela = calculaParcela(valor, f, 0.0190);
            if (f> 24 && f<=48) {
                parcela = calculaParcela(valor, f, 0.0195);
            } else if (f>=49) {
                parcela = calculaParcela(valor, f, 0.0200);
            }
           
            //parcela = calculaParcela(valor, f, 0.0150);
            parcela = String(parcela.toFixed(2).replace(".", ","))
            $('#txt-resultado').text(parcela);
            $('#txt-resultado').fadeIn(400);
        }


    }


   


    function simulacaoPessoalNossoBem()
    {
        if($('.parcelas').val() > 60){
            alert('Máximo de 60 parcelas');
            $('#txt-resultado, .txt-auxiliar-resultado').text('');
            $('.parcelas, .inputVlr').val('');
        }
        else
        {  
            $('#txt-resultado').fadeOut(0);
            var valor = $('.inputVlr').val();
            valor = parseFloat(valor.replace(".", "").replace(",", "."));
            valor = (valor * 1.00033) * 1.0173;
            var f = $('.parcelas').val();
            if (f == '') {
                f = 1;
            }


            parcela = calculaParcela(valor, f, 0.0160);
            if (f<= 24) {
                parcela = calculaParcela(valor, f, 0.0160);
            } else if (f> 24 && f<=60) {
                parcela = calculaParcela(valor, f, 0.0165);
            }
           
            //parcela = calculaParcela(valor, f, 0.0150);
            parcela = String(parcela.toFixed(2).replace(".", ","))
            $('#txt-resultado').text(parcela);
            $('#txt-resultado').fadeIn(400);
        }


    }


*/