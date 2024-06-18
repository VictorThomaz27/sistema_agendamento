function buscarHorarios() {
  var dataElement = document.getElementById("data");
  var data = dataElement.value;

  if (!data) return;

  // Formatar a data no formato 'Y-m-d'
  var dataFormatada = new Date(data).toISOString().slice(0, 10);

  console.log(dataFormatada);

  var xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    "data.php?acao=horarios&data=" + encodeURIComponent(dataFormatada),
    true
  );
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        try {
          //console.log("Resposta bruta recebida:", xhr.responseText); // Adicione esta linha para depuração
          var horarios = JSON.parse(xhr.responseText);
          carregarHorariosNoSelect(horarios);
        } catch (e) {
          console.error("Erro ao parsear JSON: ", e);
          //console.error("Resposta recebida: ", xhr.responseText);
        }
      } else {
        console.error("Erro na requisição AJAX: ", xhr.statusText);
      }
    }
  };
  xhr.send();
}


function carregarHorariosNoSelect(horarios) {
  var select = document.getElementById("selectHorarios");
  select.innerHTML = ""; // Limpar opções anteriores
  horarios.forEach(function (horario) {
    var option = document.createElement("option");
    option.value = horario;
    option.textContent = horario;
    select.appendChild(option);
  });
}

function somaServicos() {
    var total = 0;
    var selectElement = document.querySelector('.js-select2');
    var selectedOptions = selectElement.selectedOptions;

    for (var i = 0; i < selectedOptions.length; i++) {
        var option = selectedOptions[i];
        var valor = parseFloat(option.getAttribute('data-valor'));
        total += valor;
    }

    // Atualizar o elemento HTML com o total calculado
    document.getElementById('totalAgendamento').textContent = 'Total do Agendamento: R$ ' + total.toFixed(2);
}

function cadastrarServico() {
  // Obter os valores dos campos do formulário
  var formData = $('#formularioAgendamento').serializeArray();

  // Criar um formulário dinamicamente
  var form = document.createElement('form');
  form.setAttribute('method', 'post');
  form.setAttribute('action', 'inserirAgendamento.php?');
  form.style.display = 'none';

  // Adicionar os campos do formulário atual ao formulário dinâmico
  formData.forEach(function(field) {
      var input = document.createElement('input');
      input.setAttribute('type', 'hidden');
      input.setAttribute('name', field.name);
      input.setAttribute('value', field.value);
      form.appendChild(input);
  });

  // Adicionar o formulário dinâmico à página e enviá-lo
  document.body.appendChild(form);
  form.submit();
}



window.onload = function () {
  // Inicialmente não carregamos horários até que uma data seja selecionada
};
