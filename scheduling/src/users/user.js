
//função responsavel por chamar a tarefa de excluir usuario 
function deleteUser() {

    const radios = document.getElementsByName('selectedRow');
    let selectedValue;
    for (const radio of radios) {
        if (radio.checked) {
            selectedValue = radio.value;
            break;
        }
    }

    if (selectedValue) {

        let confirmacao = "Deseja mesmo excluir este usuario? ";
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

//Função para chamar a tela de cadastro de usuario 
function newUser() {
    window.location.href = 'newUser.php';
}

function editService() {
    window.location.href = 'newUser.php';
}