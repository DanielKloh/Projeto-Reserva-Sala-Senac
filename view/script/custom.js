// Executar quando o documento HTML for completamente carregado
document.addEventListener("DOMContentLoaded", function () {
  // Receber o SELETOR calendar do atributo id
  var calendarEl = document.getElementById("calendar");

  // Receber o SELETOR da janela modal cadastrar
  const cadastrarModal = new bootstrap.Modal(
    document.getElementById("cadastrarModal")
  );

  // Instanciar FullCalendar.Calendar e atribuir a variável calendar
  var calendar = new FullCalendar.Calendar(calendarEl, {
    // Incluir o bootstrap 5
    themeSystem: "bootstrap5",

    // Criar o cabeçalho do calendário
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay",
    },

    // Definir o idioma usado no calendário
    locale: "pt-br",

    // Permitir clicar nos nomes dos dias da semana
    navLinks: true,

    // Permitir clicar e arrastar o mouse sobre um ou vários dias no calendário
    selectable: true,

    // Indicar visualmente a área que será selecionada antes que o usuário solte o botão do mouse para confirmar a seleção
    selectMirror: true,

    // Permitir arrastar e redimensionar os eventos diretamente no calendário.
    editable: true,

    // Número máximo de eventos em um determinado dia, se for true, o número de eventos será limitado à altura da célula do dia
    dayMaxEvents: true,

    // Chamar o arquivo PHP para recuperar os eventos
    events: "listarEvento.php",

    // Identificar o clique do usuário sobre o evento
    eventClick: function (info) {
      // Receber o SELETOR da janela modal visualizar
      const visualizarModal = new bootstrap.Modal(
        document.getElementById("visualizarModal")
      );

      // document.getElementById("editar_start").value =
      // info.event.start.toLocaleString();

      // document.getElementById("editar_end").setAttribute(
      // "value",
      // info.event.end !== null
      //   ? info.event.end.toLocaleString()
      //   : info.event.start.toLocaleString()

      // );

      // Enviar para a janela modal os dados do evento
      let disciplina_desc = document.getElementById("disciplina_desc");
      let professor_desc = document.getElementById("professor_desc");
      let observacao = document.getElementById("observacao");
      let status = document.getElementById("status");
      let turno = document.getElementById("turno");
      let editar_start = document.getElementById("editar_start");
      let editar_end = document.getElementById("editar_end");
      let editarPeriodo = document.getElementById("editarPeriodo");
      let editar_professor_desc = document.getElementById(
        "editar_professor_desc"
      );
      let editar_disciplina_desc = document.getElementById(
        "editar_disciplina_desc"
      );
      let editarStatus = document.getElementById("editarStatus");
      let editar_observacao = document.getElementById("editar_observacao");

      edit_id.setAttribute("value", info.event.id);

      disciplina_desc.innerText = info.event.extendedProps.disciplina_desc;
      editar_disciplina_desc.setAttribute(
        "value",
        info.event.extendedProps.disciplina_desc
      );

      professor_desc.innerText = info.event.extendedProps.professor_desc;
      editar_professor_desc.setAttribute(
        "value",
        info.event.extendedProps.professor_desc
      );

      observacao.innerText = info.event.extendedProps.observacao;
      editar_observacao.setAttribute(
        "value",
        info.event.extendedProps.observacao
      );

      status.innerText = info.event.extendedProps.status;
      editarStatus.setAttribute("value", info.event.extendedProps.status);

      if (info.event.extendedProps.turno === 1) {
        turno.innerText = "Manhã";
        // editarPeriodo.setAttribute("value", 1);
        // document.getElementById("manha").setAttribute("selected");
      } else if (info.event.extendedProps.turno === 2) {
        turno.innerText = "Tarde";
        // editarPeriodo.setAttribute("value", 2);
        // document.getElementById("tarde").setAttribute("selected");
      } else {
        turno.innerText = "Noite";
        // editarPeriodo.setAttribute("value", 3);
        // document.getElementById("noite").setAttribute("selected");
      }

      document.getElementById("visualizar_start").innerText =
        info.event.start.toLocaleString();
      document.getElementById("visualizar_end").innerText =
        info.event.end !== null
          ? info.event.end.toLocaleString()
          : info.event.start.toLocaleString();

      // Abrir a janela modal visualizar
      visualizarModal.show();
    },
    // Abrir a janela modal cadastrar quando clicar sobre o dia no calendário
    select: function (info) {
      // Chamar a função para converter a data selecionada para ISO8601 e enviar para o formulário
      document.getElementById("cad_start").value = converterData(info.start);
      document.getElementById("cad_end").value = converterData(info.start);

      // Abrir a janela modal cadastrar
      cadastrarModal.show();
    },
  });

  // Renderizar o calendário
  calendar.render();

  // Converter a data
  function converterData(data) {
    // Converter a string em um objeto Date
    const dataObj = new Date(data);

    // Extrair o ano da data
    const ano = dataObj.getFullYear();

    // Obter o mês, mês começa de 0, padStart adiciona zeros à esquerda para garantir que o mês tenha dígitos
    const mes = String(dataObj.getMonth() + 1).padStart(2, "0");

    // Obter o dia do mês, padStart adiciona zeros à esquerda para garantir que o dia tenha dois dígitos
    const dia = String(dataObj.getDate()).padStart(2, "0");

    // Obter a hora, padStart adiciona zeros à esquerda para garantir que a hora tenha dois dígitos
    const hora = String(dataObj.getHours()).padStart(2, "0");

    // Obter minuto, padStart adiciona zeros à esquerda para garantir que o minuto tenha dois dígitos
    const minuto = String(dataObj.getMinutes()).padStart(2, "0");

    // Retornar a data
    return `${ano}-${mes}-${dia} ${hora}:${minuto}`;
  }

  // Receber o SELETOR do formulário cadastrar evento
  const formCadEvento = document.getElementById("formCadEvento");

  // Receber o SELETOR da mensagem genérica
  const msg = document.getElementById("msg");

  // Receber o SELETOR da mensagem cadastrar evento
  const msgCadEvento = document.getElementById("msgCadEvento");

  // Receber o SELETOR do botão da janela modal cadastrar evento
  const btnCadEvento = document.getElementById("btnCadEvento");

  // Somente acessa o IF quando existir o SELETOR "formCadEvento"
  if (formCadEvento) {
    // Aguardar o usuario clicar no botao cadastrar
    formCadEvento.addEventListener("submit", async (e) => {
      // Não permitir a atualização da pagina
      e.preventDefault();

      // Apresentar no botão o texto salvando
      btnCadEvento.value = "Salvando...";

      // Receber os dados do formulário
      const dadosForm = new FormData(formCadEvento);

      // Chamar o arquivo PHP responsável em salvar o evento
      const dados = await fetch("cadastrarEvento.php", {
        method: "POST",
        body: dadosForm,
      });

      // Realizar a leitura dos dados retornados pelo PHP
      const resposta = await dados.json();

      // Acessa o IF quando não cadastrar com sucesso
      if (!resposta["status"]) {
        // Enviar a mensagem para o HTML
        msgCadEvento.innerHTML = `<div class="alert alert-danger" role="alert">${resposta["msg"]}</div>`;
      } else {
        // Enviar a mensagem para o HTML
        msg.innerHTML = `<div class="alert alert-success" role="alert">${resposta["msg"]}</div>`;

        // Enviar a mensagem para o HTML
        msgCadEvento.innerHTML = "";

        // Limpar o formulário
        formCadEvento.reset();

        // Criar o objeto com os dados do evento
        const novoEvento = {
          id: resposta["id"],
          title: resposta["disciplina_desc"],
          color: resposta["color"],
          start: resposta["start"],
          end: resposta["end"],
        };

        // Adicionar o evento ao calendário
        calendar.addEvent(novoEvento);

        // Chamar a função para remover a mensagem após 3 segundo
        removerMsg();

        // Fechar a janela modal
        cadastrarModal.hide();
      }

      // Apresentar no botão o texto Cadastrar
      btnCadEvento.value = "Cadastrar";
    });
  }

  // Função para remover a mensagem após 3 segundo
  function removerMsg() {
    setTimeout(() => {
      document.getElementById("msg").innerHTML = "";
    }, 3000);
  }

  // Receber o SELETOR ocultar detalhes do evento e apresentar o formulário editar evento
  const btnViewEditEvento = document.getElementById("btnViewEditEvento");

  // Somente acessa o IF quando existir o SELETOR "btnViewEditEvento"
  if (btnViewEditEvento) {
    // Aguardar o usuario clicar no botao editar
    btnViewEditEvento.addEventListener("click", () => {
      // Ocultar os detalhes do evento
      document.getElementById("visualizarReserva").style.display = "none";
      document.getElementById("labelEditar").style.display = "none";

      // Apresentar o formulário editar do evento
      document.getElementById("editarReserva").style.display = "block";
      document.getElementById("labelVisualizar").style.display = "block";
    });
  }

  // Receber o SELETOR ocultar formulário editar evento e apresentar o detalhes do evento
  const btnViewEvento = document.getElementById("btnViewEvento");

  // Somente acessa o IF quando existir o SELETOR "btnViewEvento"
  if (btnViewEvento) {
    // Aguardar o usuario clicar no botao editar
    btnViewEvento.addEventListener("click", () => {
      // Apresentar os detalhes do evento
      document.getElementById("visualizarReserva").style.display = "block";
      document.getElementById("labelEditar").style.display = "block";

      // Ocultar o formulário editar do evento
      document.getElementById("editarReserva").style.display = "none";
      document.getElementById("labelVisualizar").style.display = "none";
    });
  }

  // Receber o SELETOR do formulário editar evento
  const formEditReserva = document.getElementById("formEditReserva");

  // Receber o SELETOR da mensagem editar evento
  const msgEditReserva = document.getElementById("msgEditReserva");

  // Receber o SELETOR do botão editar evento
  const btnEditReserva = document.getElementById("btnEditReserva");

  // Somente acessa o IF quando existir o SELETOR "formEditReserva"
  if (formEditReserva) {
    // Aguardar o usuario clicar no botao editar
    formEditReserva.addEventListener("submit", async (e) => {
      // Não permitir a atualização da pagina
      e.preventDefault();

      // Apresentar no botão o texto salvando
      btnEditReserva.value = "Salvando...";

      // Receber os dados do formulário
      const dadosForm = new FormData(formEditReserva);

      // Chamar o arquivo PHP responsável em editar o evento
      const dados = await fetch("editarEvento.php", {
        method: "POST",
        body: dadosForm,
      });

      // Realizar a leitura dos dados retornados pelo PHP
      const resposta = await dados.json();

      // Acessa o IF quando não editar com sucesso
      if (!resposta["status"]) {
        // Enviar a mensagem para o HTML
        msgEditReserva.innerHTML = `<div class="alert alert-danger" role="alert">${resposta["msg"]}</div>`;
      } else {
        // Enviar a mensagem para o HTML
        msg.innerHTML = `<div class="alert alert-success" role="alert">${resposta["msg"]}</div>`;

        // Enviar a mensagem para o HTML
        msgEditReserva.innerHTML = "";

        // Limpar o formulário
        formEditReserva.reset();

        // Recuperar o evento no FullCalendar pelo id
        const eventoExiste = calendar.getEventById(resposta["id"]);

        // Verificar se encontrou o evento no FullCalendar pelo id
        if (eventoExiste) {
          // Atualizar os atributos do evento com os novos valores do banco de dados
          eventoExiste.setProp("title", resposta["title"]);
          // eventoExiste.setProp("color", resposta["color"]);
          eventoExiste.setStart(resposta["start"]);
          eventoExiste.setEnd(resposta["end"]);
        }

        // Chamar a função para remover a mensagem após 3 segundo
        removerMsg();

        // Fechar a janela modal
        visualizarModal.hide();
      }

      // Apresentar no botão o texto salvar
      btnEditReserva.value = "Salvar";
    });
  }
});
