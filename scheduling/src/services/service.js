
function editService() {

    const radios = document.getElementsByName('selectedRow');
    //console.log(radios); // Verifica no console se os rádios estão sendo corretamente selecionados

    let selectedValue;
    for (const radio of radios) {
        if (radio.checked) {
            selectedValue = parseInt(radio.value); // Converte o valor do rádio para inteiro
            break;
        }
    }

    if (selectedValue || selectedValue === 0) { // Verifica se selectedValue está definido ou é zero

        const code = selectedValue; // Captura o código do serviço, removendo espaços em branco extras

        // Construindo a URL com os parâmetros
        const url = `editService.php?acao=update&id_servico=${encodeURIComponent(code)}`;

        // Redirecionando para a próxima página com os parâmetros
        window.location.href = url;
    } else {
        alert('Nenhuma linha selecionada.');
    }
}

function deleteService() {

    const radios = document.getElementsByName('selectedRow');
    let selectedValue;
    for (const radio of radios) {
        if (radio.checked) {
            selectedValue = radio.value;
            break;
        }
    }

    if (selectedValue) {

        let confirmacao = "Deseja mesmo excluir este serviço? ";
        if (confirm(confirmacao) == true) {

            const code = selectedValue;
            //alert(`Título: ${title}\nValor: ${value}\nTempo: ${time}`);
            // Construindo a URL com os parâmetros
            const url = `data.php?acao=deletar&codigo=${encodeURIComponent(code)}`;

            // Redirecionando para a próxima página com os parâmetros
            window.location.href = url;
        } else {
            alert("Operação cancelada!");
        }


    } else {
        alert('Nenhuma linha selecionada.');
    }
}

function newService() {

    window.location.href = 'newService.php';

}