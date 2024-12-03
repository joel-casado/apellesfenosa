<?php

class PrestecModel {
    public function crearDocumentoWord() {
        require_once 'vendor/autoload.php';

        $phpWord = new PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        
        // Fuente por defecto
        $phpWord->setDefaultFontName('Arial');
        $phpWord->setDefaultFontSize(9);
        $underlineStyle = ['underline' => true];
        $blueFontStyle = ['color' => '0000FF', 'underline' => true, 'size' => 14]; // Azul y subrayado
        $largeFontStyle = ['size' => 11, 'bold' => true]; // Texto grande y en negrita
        $boldStyle = array('bold' => true);
        $italicStyle = array('italic' => true);
        // Estilo de la línea separadora
        $separatorStyle = ['borderBottom' => '2px solid #000000', 'spaceAfter' => 100];

        // Estilos
        $bold = ['bold' => true];
        $tableStyle = [
            'borderSize' => 0, // Borde invisible
            'borderColor' => 'FFFFFF', // Blanco (invisible en la mayoría de los casos)
            'cellMargin' => 80,
            'spaceLeft' => 1000,
        ];

        $tableStyle2 = [
            'borderSize' => 0,
            'borderColor' => 'FFFFFF', // Sin bordes
            'cellMarginTop' => 0,      // Sin margen superior
            'cellMarginBottom' => 0,   // Sin margen inferior
            'cellMarginLeft' => 50,    // Margen interno izquierdo
            'cellMarginRight' => 50,   // Margen interno derecho
        ];
        $phpWord->addTableStyle('FormularioTable', $tableStyle);
        
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
        $cell = $table->addCell(14000, );
        $textRun = $cell->addTextRun();
        $textRun->addText('Institució sol·licitant /', $boldStyle);
        $textRun->addText(' Institución solicitante / Applicant Institution', $italicStyle);
        
        $table->addRow();
        $table->addCell(14000)->addText('____________________________________________________________________________', $boldStyle);
        
        // Fila 2: Responsable del préstamo
        $table->addRow();
        $cell = $table->addCell(14000, );
        $textRun = $cell->addTextRun();
        $textRun->addText('Responsable del préstec / ' , $boldStyle);
        $textRun->addText('Responsable del préstamo / Responsible of loan:' , $italicStyle);
        $table->addRow();
        $table->addCell(14000)->addText('____________________________________________________________________________');
        
        // Fila 3: Cargo
        $table->addRow();
        $cell = $table->addCell(14000, );
        $textRun = $cell->addTextRun();
        $textRun->addText('Càrrec / ' , $boldStyle);
        $textRun->addText('Cargo / Job title:' , $italicStyle);
        $table->addRow();
        $table->addCell(14000)->addText('____________________________________________________________________________');
        
        // Fila 4: Exposición
        $table->addRow();
        $cell = $table->addCell(14000, );
        $textRun = $cell->addTextRun();
        $textRun->addText('Exposició / ' , $boldStyle);
        $textRun->addText('Exposición / Exhibition:' , $italicStyle);
        $table->addRow();
        $table->addCell(14000)->addText('____________________________________________________________________________');
        
        // Fila 5: Lugar
        $table->addRow();
        $table->addCell(3000, )->addText('Lloc / Lugar / Place:');
        $table->addRow();
        $table->addCell(14000)->addText('____________________________________________________');
        
        // Fila 6: Fechas
        $table->addRow();
        $table->addCell(3000, )->addText('Dates / Fechas / Dates:');
        $table->addRow();
        $table->addCell(14000)->addText('___________________ - ___________________');
        
        // Fila 7: Nombre del prestador
        $table->addRow();
        $table->addCell(3000, $separatorStyle); // Línea separadora arriba
        $table->addCell(14000, $separatorStyle); // Línea separadora arriba
       
        $table->addRow();
        $cell = $table->addCell(4000); // Celda ancha para "Telèfon"
        $textRun = $cell->addTextRun();
        $textRun->addText('Nom del prestador:', $boldStyle);
        $textRun->addText('Museu Apel·les Fenosa.Fundació Privada Apel·les Fenosa', $largeFontStyle); // Azul y subrayado

        // Fila secundaria con "Dirección / Address" y "Teléfono / Telephone" debajo
        $table->addRow();
        $cell->addText('Nombre del prestador / Name of lender', $italicStyle);  

        // Fila principal: "Adreça" y "Telèfon" en la misma línea
        $table->addRow();
        $cell = $table->addCell(6000); // Celda ancha para "Adreça"
        $textRun = $cell->addTextRun();
        $textRun->addText('Adreça: ', $boldStyle);
        $textRun->addText('Carrer Major, 25, 43700 El Vendrell, Tarragona', $largeFontStyle);

        // Subtítulo "Dirección / Address" en la misma celda
        $cell->addText('Dirección / Address', $italicStyle);

        // Celda ancha para "Telèfon"
        $cell = $table->addCell(4000);
        $textRun = $cell->addTextRun();
        $textRun->addText('Telèfon: ', $boldStyle);
        $textRun->addText('+34 977 15 41 92', $largeFontStyle);

        // Subtítulo "Teléfono / Telephone" en la misma celda
        $cell->addText('Teléfono / Telephone', $italicStyle);

        // Línea separadora
        $table->addRow();
        $cell = $table->addCell(17000, $separatorStyle);
        $cell->addText('');

        // Fila siguiente: "Correu electrònic" en la misma línea con el subtítulo
        $table->addRow();
        $cell = $table->addCell(6000); // Celda para el correo electrónico
        $textRun = $cell->addTextRun();
        $textRun->addText('Correu electrònic: ', $boldStyle);
        $textRun->addText('info@museuapellesfenosa.cat', $blueFontStyle);

        // Subtítulo "Correo electrónico / Electronic mail" en la misma celda
        $cell->addText('Correo electrónico / Electronic mail', $italicStyle);

        // Línea separadora
        $table->addRow();
        $cell = $table->addCell(17000, $separatorStyle);
        // Agregar datos de la tabla
        $table->addRow();
        $cell = $table->addCell(3000, );
        $cell->addText('Número de registre:', $boldStyle);
        $table->addRow();
        $cell->addText('Número de registro / Inventory number', $italicStyle);
        
        $table->addRow();
        $cell = $table->addCell(3000, );
        $cell->addText("Nom de l'objecte i títol:", $boldStyle);
        $table->addRow();
        $cell->addText('Nombre del objeto y título / Object name and title', $italicStyle);

        $table->addRow();
        $cell = $table->addCell(3000, );
        $cell->addText('Autor:', $boldStyle);
        $table->addRow();
        $cell->addText('Autor / Author', $italicStyle);

        $table->addRow();
        $cell = $table->addCell(3000, );
        $cell->addText('Dimensions màx. (Alçada/Amplada/Fondària):', $boldStyle);
        $table->addRow();
        $cell->addText('Dimensiones (Altura / Ancho / Fondo) / Dimensions (Height / Width / Depth)', $italicStyle);

        $table->addRow();
        $cell = $table->addCell(3000, );
        $cell->addText('Materials: Datació:', $boldStyle);
        $table->addRow();
        $cell->addText('Materials / Dating', $italicStyle);

        $table->addRow();
        $cell = $table->addCell(3000, );
        $cell->addText('Necessitat d’embalatge especial:', $boldStyle);
        $table->addRow();
        $cell->addText('Necesidad de embalado especial / Need of packed special', $italicStyle);



        $table->addRow();
        $cell = $table->addCell(3000,);
        $textRun = $cell->addTextRun();
        $textRun->addText('Forma en què el prestador vol figurar en el catàleg: ', $boldStyle);
        $textRun->addText('Museu Apel·les Fenosa', $largeFontStyle); // Información más grande y negrita
        $cell->addText('Forma en que el prestador quiere figurar en el catálogo',$italicStyle);
        $table->addRow();
        $cell->addText('Form in which the lender wishes to feature in the catalogue');

        $table->addRow();
        $cell = $table->addCell(3000, );
        $cell->addText('Número de registre:', $boldStyle);
        $table->addRow();
        $cell->addText('Número de registro / Inventory number', $italicStyle);


        $table->addRow();
        $cell = $table->addCell(3000,);
        $textRun = $cell->addTextRun();
        $textRun->addText('El prestador admet que es fotografïi per a:', $boldStyle);
        $textRun->addText(' / El prestador admite que se fotografie para: / The lender allows to be photographed for:',$italicStyle);

        $table->addRow();
        $table->addCell(3000, )->addText('Publicacions de l’exposició');
        $table->addCell(3000)->addText('☐ Sí'); 
        $table->addCell(3000)->addText('☐ No');  

        $table->addRow();
        $table->addCell(3000)->addText('Mitjans de comunicació');
        $table->addCell(3000)->addText('☐ Sí');
        $table->addCell(3000)->addText('☐ No');

        $table->addRow();
        $table->addCell(3000)->addText('Arxius');
        $table->addCell(3000)->addText('☐ Sí');
        $table->addCell(3000)->addText('☐ No');


        $table->addRow();
        $table->addCell(3000)->addText('Finalitats privades Sí No');
        $table->addCell(3000)->addText('☐ Sí');
        $table->addCell(3000)->addText('☐ No');


        $table->addRow();$table->addRow();
        $cell = $table->addCell(3000, );
        $cell->addText("Valoració per a l'assegurança:", $boldStyle);
        $table->addRow();
        $cell->addText('Valoración para el seguro',$italicStyle);
        $table->addRow();
        $cell->addText('Insurance value');


        $cell = $table->addCell(3000,);
        $cell->addText("Adreça on s'ha de recollir l'objecte:", $boldStyle);
        $table->addRow();
        $cell->addText('Dirección donde debe recogerse el objeto',$italicStyle);
        $table->addRow();
        $cell->addText('Address from which the object is to be picked up');
        $table->addRow();

        $cell = $table->addCell(3000, );
        $cell->addText('Telèfon:', $boldStyle);
        $table->addRow();
        $cell->addText('Teléfono',$italicStyle);
        $table->addRow();
        $cell->addText('Telephone');
        $table->addRow();

        $cell = $table->addCell(3000, );
        $cell->addText("Adreça on s'ha de retornar l'objecte:", $boldStyle);
        $table->addRow();
        $cell->addText('Dirección donde debe devolverse el objeto',$italicStyle);
        $table->addRow();
        $cell->addText('Address from which the object is to be returned');
        $table->addRow();

        $cell = $table->addCell(3000, );
        $cell->addText('Telèfon:', $boldStyle);
        $table->addRow();
        $cell->addText('Teléfono',$italicStyle);
        $table->addRow();
        $cell->addText('Telephone');

        
        // Primera fila: líneas de firma
        $table->addRow();
        $cell = $table->addCell(5000, $tableStyle2); // Celda para la firma izquierda
        $textRun = $cell->addTextRun();
        $textRun->addText('_____________________________________');
        // Subtítulo "Dirección / Address" en la misma celda
        $cell->addText('Data i firma del prestador del préstec', $boldStyle);
        $cell->addText('Fecha y firma del prestador del préstamo', $italicStyle);
        $cell->addText('Date and signature of lender', $italicStyle);

        $cell = $table->addCell(5000, $tableStyle2); // Celda para la firma derecha
        $cell->addText('_____________________________________');

        $cell->addText('Data i firma del prestatari del préstec', $boldStyle);
        $cell->addText('Fecha y firma del prestatario del préstamo', $italicStyle);
        $cell->addText('Date and signature of borrower', $italicStyle);

        

    /*
        $cell = $table->addCell(5000); // Celda derecha
        $cell->addText('Data i firma del prestatari del préstec', $boldStyle);
        $table->addRow();
        $cell->addText('Date and signature of lender');
        $table->addRow();
        $cell->addText('Date and signature of borrower');
        
        
        
        
        $table->addRow();
        $cell = $table->addCell(5000); // Celda izquierda
        $cell->addText('Data i firma del prestador del préstec', $boldStyle);
        $table->addRow();
        $cell->addText('Fecha y firma del prestador del préstamo',$italicStyle);
        $table->addRow();
        $cell->addText('Fecha y firma del prestatario del préstamo');
        
        
        
        */




        // Guardar el archivo Word
        $tempFile = tempnam(sys_get_temp_dir(), 'word_') . '.docx';
        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);
        
        return $tempFile;
        
    }
}

