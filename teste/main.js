$(function () {
    var divContent = $('#formulario');
    var botaoAdicionar = $('a[data-id="1"]');
    var i = 1;

    //Ao clicar em adicionar ele cria uma linha com novos campos
    $(botaoAdicionar).click(function () {
        $('<div class="conteudoIndividual"><input type="text" placeholder="Nº do Documento" maxlength="6" name="numeroDocumento' + i + '" required/><select name="tipoDocumento' + i + '" required><option value="" disabled selected>Tipo do Documento</option><option value="01">Volvo</option><option value="02">Saab</option></select><select name="subTipoDocumento' + i + '" required><option value="" disabled selected>Subtipo do Documento</option><option value="01">Volvo</option><option value="02">Saab</option></select><a href="#" class="linkRemover">- Remover Campos</a></div>').appendTo(divContent);
        $('#removehidden').remove();
        i++;
        $('<input type="hidden" name="quantidadeCampos" value="' + i + '" id="removehidden">').appendTo(divContent);
    });

    //Cliquando em remover a linha é eliminada
    $('#formulario').on('click', '.linkRemover', function () {
        $(this).parents('.conteudoIndividual').remove();
        i--;
    });
});