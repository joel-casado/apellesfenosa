<?php

class PrestecModel {
    public function crearDocumentoWord() {
        require_once 'vendor/autoload.php';

        $phpWord = new PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection([
            'marginLeft' => 1000,  // Márgenes para ajustar el contenido
            'marginRight' => 1000,
            'marginTop' => 1000,
            'marginBottom' => 1000,
            'spaceLeft' => 1000,
        ]);
        
        // Fuente por defecto
        $phpWord->setDefaultFontName('Arial');
        $phpWord->setDefaultFontSize(9);
        $underlineStyle = ['underline' => true];
        $blueFontStyle = ['color' => '0000FF', 'underline' => true, 'size' => 14]; // Azul y subrayado
        $largeFontStyle = ['size' => 13, 'bold' => true]; // Texto grande y en negrita
        $boldStyle = array('bold' => true);
        $italicStyle = array('italic' => true);
        // Estilo de la línea separadora
        $separatorStyle = ['borderBottom' => '2px solid #000000', 'spaceAfter' => 100];

        // Estilos
        $bold = ['bold' => true];
        $tableStyle = [
            'cellMargin' => 80,
            'spaceLeft' => 1000,
        ];
        $phpWord->addTableStyle('FormularioTable', $tableStyle);
        $cellStyle = [
            'valign' => 'center',
        ];
        
        // Título principal con fuente más grande
        $section->addText('FORMULARI DE PRÉSTEC PER RETORNAR AL CENTRE', [
            'bold' => true,
            'size' => 14,
        ]);
        $section->addText('FORMULARIO DE PRÉSTAMO PARA DEVOLVER AL CENTRO', ['bold' => true]);
        $section->addText('FORMULARY OF LOAN TO RETURN TO CENTRE', ['bold' => true]);
        $section->addTextBreak(1);
        
        // Crear la tabla principal
        $table = $section->addTable('FormularioTable');
        
        // Fila 1: Institución solicitante
        $table->addRow();
        $cell = $table->addCell(14000, $cellStyle);
        $textRun = $cell->addTextRun();
        $textRun->addText('Institució sol·licitant /', $boldStyle);
        $textRun->addText(' Institución solicitante / Applicant Institution', $italicStyle);
        
        $table->addRow();
        $table->addCell(14000)->addText('________________________________________________________________________');
        
        // Fila 2: Responsable del préstamo
        $table->addRow();
        $cell = $table->addCell(14000, $cellStyle);
        $textRun = $cell->addTextRun();
        $textRun->addText('Responsable del préstec / ' , $boldStyle);
        $textRun->addText('Responsable del préstamo / Responsible of loan:' , $italicStyle);
        $table->addRow();
        $table->addCell(14000)->addText('________________________________________________________________________');
        
        // Fila 3: Cargo
        $table->addRow();
        $cell = $table->addCell(14000, $cellStyle);
        $textRun = $cell->addTextRun();
        $textRun->addText('Càrrec / ' , $boldStyle);
        $textRun->addText('Cargo / Job title:' , $italicStyle);
        $table->addRow();
        $table->addCell(14000)->addText('________________________________________________________________________');
        
        // Fila 4: Exposición
        $table->addRow();
        $cell = $table->addCell(14000, $cellStyle);
        $textRun = $cell->addTextRun();
        $textRun->addText('Exposició / ' , $boldStyle);
        $textRun->addText('Exposición / Exhibition:' , $italicStyle);
        $table->addRow();
        $table->addCell(14000)->addText('________________________________________________________________________');
        
        // Fila 5: Lugar
        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Lloc / Lugar / Place:');
        $table->addRow();
        $table->addCell(14000)->addText('________________________________________________________________________');
        
        // Fila 6: Fechas
        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Dates / Fechas / Dates:');
        $table->addRow();
        $table->addCell(14000)->addText('_____________ - _____________');
        
        // Fila 7: Nombre del prestador
        $table->addRow();
        $table->addCell(3000, $separatorStyle); // Línea separadora arriba
        $table->addCell(14000, $separatorStyle); // Línea separadora arriba

        // Nombre en negrita y traducciones en cursiva
        $table->addRow();
        $cell = $table->addCell(3000, $cellStyle);
        $textRun = $cell->addTextRun();
        $textRun->addText('Nom del prestador: ', $boldStyle);
        $textRun->addText('Museu Apel·les Fenosa.Fundació Privada Apel·les Fenosa', $largeFontStyle); // Información más grande y negrita
        $cell->addText(''); // Salto de línea
        $table->addRow();
        $cell = $table->addCell(14000);
        $textRun = $cell->addTextRun();
        $textRun->addText('Nombre del prestador / ', $italicStyle);
        $textRun->addText('Name of lender', $italicStyle);

        // Fila 8: Dirección
        $table->addRow();
        $table->addCell(3000, $separatorStyle); // Línea separadora arriba
        $table->addCell(14000, $separatorStyle); // Línea separadora arriba

        // Dirección
        $table->addRow();
        $cell = $table->addCell(3000, $cellStyle);
        $cell->addText('Adreça:', $boldStyle); // En negrita
        $cell->addText('Carrer Major, 25, 43700 El Vendrell, Tarragona Telèfon: +34 977 15 41 92', $largeFontStyle); // Información más grande y negrita

        $cell = $table->addCell(14000);
        $textRun = $cell->addTextRun();
        $textRun->addText('Dirección / ', $italicStyle);
        $textRun->addText('Address', $italicStyle);

        // Fila 9: Correo electrónico
        $table->addRow();
        $table->addCell(3000, $separatorStyle); // Línea separadora arriba
        $table->addCell(14000, $separatorStyle); // Línea separadora arriba

        // Correo electrónico
        $table->addRow();
        $cell = $table->addCell(3000, $cellStyle);
        $cell->addText('Correu electrònic:', $boldStyle); // En negrita
        $cell->addText(' info@museuapellesfenosa.cat', $blueFontStyle); // Texto en azul, subrayado y más grande

        $cell = $table->addCell(14000);
        $textRun = $cell->addTextRun();
        $textRun->addText('Correo electrónico / ', $italicStyle);
        $textRun->addText('Electronic mail', $italicStyle);

        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Número de registre:');
        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Número de registro');
        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Inventory number');

        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText("Nom de l'objecte i titol");
        $table->addCell(3000, $cellStyle)->addText('Nombre del objeto y título');
        $table->addCell(3000, $cellStyle)->addText('Object name and title');

        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Autor:');
        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Autor');
        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Author');

        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Dimensions màx. (Alçada/Amplada/Fondària):');
        $table->addCell(3000, $cellStyle)->addText('Dimensiones (Altura / Ancho / Fondo)');
        $table->addCell(3000, $cellStyle)->addText('Dimensions (Height / Width / Depth)');

        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Materials: Datació:');
        $table->addCell(3000, $cellStyle)->addText('Materials Datación');
        $table->addCell(3000, $cellStyle)->addText('Materials Dating');

        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Necessitat d’embalatge especial:');
        $table->addCell(3000, $cellStyle)->addText('Necesidad de embalado especial');
        $table->addCell(3000, $cellStyle)->addText('Need of packed special');

        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Forma en què el prestador vol figurar en el catàleg:');
        $table->addCell(3000)->addText('Forma en que el prestador quiere figurar en el catálogo');
        $table->addCell(3000)->addText('Form in which the lender wishes to feature in the catalogue');

        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('El prestador admet que es fotografïi per a:');
        $table->addCell(3000)->addText('El prestador admite que se fotografie para:');
        $table->addCell(3000)->addText('The lender allows to be photographed for:');

        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Publicacions de l’exposició');
        $table->addCell(3000)->addText('☐ Sí');  // Casilla vacía para "Sí"
        $table->addCell(3000)->addText('☐ No');  // Casilla vacía para "No"

        $table->addRow();
        $table->addCell(3000)->addText('Mitjans de comunicació');
        $table->addCell(3000)->addText('☐ Sí');
        $table->addCell(3000)->addText('☐ No');

        $table->addRow();
        $table->addCell(3000)->addText('Arxius');
        $table->addCell(3000)->addText('☐ Sí');
        $table->addCell(3000)->addText('☐ No');


        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Finalitats privades Sí No');
        $table->addCell(3000)->addText('');
        $table->addCell(3000)->addText('');

        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Valoració per a l\'assegurança:');
        $table->addCell(3000)->addText('Valoración para el seguro');
        $table->addCell(3000)->addText('Insurance value');

        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Adreça on s\'ha de recollir l\'objecte:');
        $table->addCell(3000)->addText('Dirección donde debe recogerse el objeto');
        $table->addCell(3000)->addText('Address from which the object is to be picked up');

        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Telèfon:');
        $table->addCell(3000)->addText('Teléfono');
        $table->addCell(3000)->addText('Telephone');

        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Adreça on s\'ha de retornar l\'objecte:');
        $table->addCell(3000)->addText('Dirección donde debe devolverse el objeto');
        $table->addCell(3000)->addText('Address from which the object is to be returned');

        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Telèfon:');
        $table->addCell(3000)->addText('Teléfono');
        $table->addCell(3000)->addText('Telephone');

        
        // Firma
        $section->addTextBreak(2);
        $section->addText('_____________________ _____________________', $bold, ['alignment' => 'center']);
        $section->addText(
            'Data i firma del prestador del préstec    Data i firma del prestatari del préstec',
            [],
            ['alignment' => 'center']
        );
        $section->addText(
            'Fecha y firma del prestador del préstamo Fecha y firma del prestatario del préstamo',
            [],
            ['alignment' => 'center']
        );
        $section->addText(
            'Date and signature of lender             Date and signature of borrower',
            [],
            ['alignment' => 'center']
        );
        
        // Guardar el archivo Word
        $tempFile = tempnam(sys_get_temp_dir(), 'word_') . '.docx';
        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);
        
        return $tempFile;
        
    }
}

