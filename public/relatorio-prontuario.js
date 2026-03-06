function gerarRelatorioProntuarioPaciente(paciente, filtros) {

    const dataGeracao = new Date().toLocaleString();

    let consultasContent = [];

    paciente.consultas.forEach((c, index) => {

        let diagnosticos = (c.diagnosticos || []).map(d => `• ${d.descricao}`).join('\n');

        let exames = (c.exames || []).map(e =>
            `• Serviço: ${e.servico_clinico}\n  Resultado: ${e.resultado}\n  Observação: ${e.observacao}\n  Estado: ${e.status}`
        ).join('\n\n');

        let receitas = [];

        (c.receitas || []).forEach(r => {

            let itens = (r.itens || []).map(i =>
                `   - ${i.medicamento} | Dosagem: ${i.dosagem} | Frequência: ${i.frequencia} | Duração: ${i.duracao}`
            ).join('\n');

            receitas.push(
                `Observações: ${r.observacoes || ''}\nMedicamentos:\n${itens}`
            );
        });

        consultasContent.push(

            { text: `CONSULTA ${index + 1}`, style: 'sectionHeader' },

            {
                columns: [
                    { text: `Data: ${c.data}` },
                    { text: `Hora: ${c.hora}` },
                    { text: `Estado: ${c.estado}` }
                ]
            },

            { text: `Tipo de Consulta: ${c.tipo_consulta}` },
            { text: `Serviço Clínico: ${c.servico_clinico}` },
            { text: `Observação: ${c.observacao || '-'}`, margin: [0,0,0,5] },

            { text: 'Diagnósticos:', bold: true },
            { text: diagnosticos || 'Nenhum diagnóstico registrado', margin: [0,0,0,5] },

            { text: 'Exames:', bold: true },
            { text: exames || 'Nenhum exame registrado', margin: [0,0,0,5] },

            { text: 'Receitas Médicas:', bold: true },
            { text: receitas.join('\n\n') || 'Nenhuma receita registrada', margin: [0,0,0,10] },

            { canvas: [{ type: 'line', x1:0, y1:5, x2:515, y2:5, lineWidth:0.5 }] }

        );

    });

    var docDefinition = {

        pageSize: 'A4',

        header: function(currentPage, pageCount) {
            return {
                columns: [
                    { text: 'CLINICA ESTORIL', bold: true, margin: [40, 10, 0, 0] },
                    {
                        text: `Página ${currentPage} de ${pageCount}`,
                        alignment: 'right',
                        margin: [0, 10, 40, 0]
                    }
                ]
            };
        },

        footer: function() {
            return {
                columns: [
                    {
                        text: `Gerado em: ${dataGeracao}`,
                        margin: [40, 0, 0, 10],
                        fontSize: 8
                    },
                    {
                        text: 'Sistema Clínico - Clinica Estoril',
                        alignment: 'center',
                        fontSize: 8
                    }
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

            { text: '\nPRONTUÁRIO DO PACIENTE\n', style: 'subheader' },

            {
                style: 'patientBox',
                table: {
                    widths: ['*','*'],
                    body: [
                        [
                            { text: `Nome: ${paciente.nome}`, border: [false,false,false,false] },
                            { text: `Telefone: ${paciente.num_telefone}`, border: [false,false,false,false] }
                        ],
                        [
                            { text: `Email: ${paciente.email || '-'}`, border: [false,false,false,false] },
                            { text: `Gênero: ${paciente.genero}`, border: [false,false,false,false] }
                        ],
                        [
                            { text: `Idade: ${paciente.idade}`, border: [false,false,false,false] },
                            { text: `Total de Consultas: ${paciente.consultas.length}`, border: [false,false,false,false] }
                        ]
                    ]
                },
                margin: [0,10,0,15]
            },

            { text: 'Histórico de Consultas', style: 'sectionHeader' },

            ...consultasContent

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
            },

            sectionHeader: {
                fontSize: 12,
                bold: true,
                margin: [0,10,0,5]
            },

            patientBox: {
                fontSize: 10
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
        };

    });

}