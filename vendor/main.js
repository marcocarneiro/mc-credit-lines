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
        resultado = parseInt(valor) * ((Math.pow(1 + taxaPercent, parcelas) * taxaPercent) / (Math.pow(1 + taxaPercent, parcelas) - 1));
    }
    el_saida.innerText = String(resultado.toFixed(2).replace(".", ","))
}