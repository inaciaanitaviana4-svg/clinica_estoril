function gerarRelatorioPagamentosTabela(pagamentos, filtros) {

    let body = [
        [
            { text: 'Paciente', bold: true },
            { text: 'Recepcionista', bold: true },
            { text: 'Tipo Consulta', bold: true },
            { text: 'Serviço', bold: true },
            { text: 'Data', bold: true },
            { text: 'Método', bold: true },
            { text: 'Estado', bold: true },
            { text: 'Total Pago', bold: true },
            { text: 'Itens', bold: true }
        ]
    ];

    pagamentos.forEach(p => {

        let itensTexto = '';

        if (p.itens && p.itens.length) {
            itensTexto = p.itens.map(i =>
                `${i.servico_clinico} | Qtd:${i.quantidade} | ${i.valor} kz`
            ).join('\n');
        }

        body.push([
            p.paciente || '',
            p.recepcionista || '',
            p.tipo_consulta || '',
            p.servico_clinico || '',
            p.data || '',
            p.metodo_pagamento || '',
            p.estado || '',
            `${p.total_pago || 0} kz`,
            itensTexto
        ]);

    });

    const dataGeracao = new Date().toLocaleString();

    var docDefinition = {

        pageOrientation: 'landscape',
        pageSize: 'A4',

        header: function (currentPage, pageCount) {
            return {
                columns: [
                    { text: 'CLINICA ESTORIL', bold: true, margin: [40, 10, 0, 0] },
                    { text: `Página ${currentPage} de ${pageCount}`, alignment: 'right', margin: [0, 10, 40, 0] }
                ]
            };
        },

        footer: function (currentPage, pageCount) {
            return {
                columns: [
                    { text: `Gerado em: ${dataGeracao}`, margin: [40, 0, 0, 10], fontSize: 8 },
                    { text: 'Sistema Clínico - Clinica Estoril', alignment: 'center', fontSize: 8 },
                    { text: `Total de Registros: ${pagamentos.length}`, alignment: 'right', margin: [0, 0, 40, 10], fontSize: 8 }
                ]
            };
        },

        content: [

            {
                columns: [
                    { image: filtros.logotipo, width: 70 },
                    [
                        { text: 'CLINICA ESTORIL', style: 'header' },
                        { text: 'NIF: 500 000 000' },
                        { text: 'Localização: Luanda - Angola' }
                    ]
                ]
            },

            { text: '\nRELATÓRIO DE PAGAMENTOS DE SERVIÇOS CLÍNICOS\n', style: 'subheader' },

            {
                text: `Filtros aplicados: ${filtros.descricao || 'Nenhum filtro específico'}`,
                margin: [0, 0, 0, 10]
            },

            {
                table: {
                    headerRows: 1,
                    widths: ['*', '*', '*', '*', 70, 70, 70, 70, '*'],
                    body: body
                },
                layout: {
                    fillColor: function (rowIndex) {
                        return (rowIndex % 2 === 0) ? '#F3F3F3' : null;
                    }
                }
            }

        ],

        styles: {
            header: {
                fontSize: 16,
                bold: true
            },
            subheader: {
                fontSize: 14,
                bold: true,
                alignment: 'center'
            }
        },

        defaultStyle: {
            fontSize: 9
        },

        pageMargins: [40, 60, 40, 60]

    };

    const pdfDocGenerator = pdfMake.createPdf(docDefinition);

    pdfDocGenerator.getBuffer((buffer) => {

        const blob = new Blob([buffer], { type: "application/pdf" });
        const dataUrl = URL.createObjectURL(blob);

        const iframe = document.createElement("iframe");
        iframe.style.display = "none";
        iframe.src = dataUrl;

        document.body.appendChild(iframe);

        iframe.onload = () => {

            iframe.contentWindow.focus();
            iframe.contentWindow.print();

            // limpeza opcional
            // setTimeout(() => {
            // URL.revokeObjectURL(dataUrl);
            // document.body.removeChild(iframe);
            // }, 1000);

        };

    });

}