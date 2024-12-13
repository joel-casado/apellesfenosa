<?php

class PrestecModel {
    public function crearDocumentoWord() {
        require_once 'vendor/autoload.php';

        $phpWord = new PhpOffice\PhpWord\PhpWord();
        
        
        

        // Fuente por defecto
        $phpWord->setDefaultFontName('Arial');
        $phpWord->setDefaultFontSize(8);
        $underlineStyle = ['underline' => true];
        $blueFontStyle = ['color' => '0000FF', 'underline' => true, 'size' => 13]; // Azul y subrayado
        $largeFontStyle = ['size' => 12, 'bold' => true]; // Texto grande y en negrita
        $boldStyle = array('bold' => true);
        $italicStyle = array('italic' => true);

        // Estilos
        $bold = ['bold' => true];
        // Ajustar márgenes de la sección
        $sectionStyle = [
                    'marginLeft' => 2200,   // Márgenes izquierdo
                'marginTop' => -2000,     // Reducir margen superior
                'marginRight' => 200,   // Reducir margen derecho
                'marginBottom' => 200   // Reducir margen inferior
          ];
        // Celda para la imagen
        $section = $phpWord->addSection($sectionStyle);

        
        // Añadir la primera imagen
                $section->addImage('images/login/logo.png', [
                    'width' => 90,
                    'height' => 60,
                    'positioning' => 'relative',
                    'posHorizontalRel' => 'page', // Relativo a la página
                    'posVerticalRel' => 'page',   // Relativo a la página
                    'posHorizontal' => 'left',   // Posicionado a la izquierda
                    'posVertical' => 'top',      // Desde la parte superior
                ]);
            

                $section->addImage('images/login/texto.png', [
                    'width' => 100,
                    'height' => 400,
                    'positioning' => 'absolute',
                    'posHorizontalRel' => 'page', // Relativo a la página
                    'posVerticalRel' => 'page',   // Relativo a la página
                    'posHorizontal' => 'left',   // Posicionado a la izquierda
                    'posVertical' => 'bottom',   // Relativo al fondo
                ]);
                
        

         // Crear tabla sin rotación
         $table = $section->addTable([
           'positioning' => 'relative',
            'posHorizontalRel' => 'page', // Relativo a la página
            'posVerticalRel' => 'page',   // Relativo a la página
            'posHorizontal' => 'left',   // Posicionado a la izquierda
            'posVertical' => 'top',      // Desde la parte superior
        ]);
        $footer = $section->addFooter();
        
        $footer->addPreserveText('{PAGE} / {NUMPAGES}', null, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        // Ajustar estilo de la tabla principal
        $tableStyle = [
            'borderSize' => 0, // Borde invisible
            'borderColor' => 'FFFFFF', // Blanco (invisible en la mayoría de los casos)
            'cellMargin' => 45,  // Reducir márgenes internos de las celdas
            'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::START
        ];
        $phpWord->addTableStyle('FormularioTable', $tableStyle);

        // Reducir tamaño de fuente en celdas de texto largas
        $textStyle = ['size' => 12, 'bold' => false];
                $tableStyle2 = [
                    'borderSize' => 0,
                    'borderColor' => 'FFFFFF', // Sin bordes
                    'cellMarginTop' => 0,      // Sin margen superior
                    'cellMarginBottom' => 0,   // Sin margen inferior
                    'cellMarginLeft' => 50,    // Margen interno izquierdo
                    'cellMarginRight' => 50,   // Margen interno derecho
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
        
        $table->addRow();
        $cell = $table->addCell(9000, ['borderBottomSize' => 20, 'borderBottomColor' => '000000']);
        $cell->addText('');

        // Fila 1: Institución solicitante
        $table->addRow();
        $cell = $table->addCell(14000, );
        $textRun = $cell->addTextRun();
        $textRun->addText('Institució sol·licitant /', $boldStyle);
        $textRun->addText(' Institución solicitante', $italicStyle);
        $textRun->addText(' / Applicant Institution:');
        $table->addRow();
        $table->addCell(14000)->addText('____________________________________________________________________________', $boldStyle);
        
        // Fila 2: Responsable del préstamo
        $table->addRow();
        $cell = $table->addCell(14000, );
        $textRun = $cell->addTextRun();
        $textRun->addText('Responsable del préstec / ' , $boldStyle);
        $textRun->addText('Responsable del préstamo ' , $italicStyle);
        $textRun->addText('/ Responsible of loan:');
        $table->addRow();
        $table->addCell(14000)->addText('____________________________________________________________________________');
        
        // Fila 3: Cargo
        $table->addRow();
        $cell = $table->addCell(14000, );
        $textRun = $cell->addTextRun();
        $textRun->addText('Càrrec / ' , $boldStyle);
        $textRun->addText('Cargo ' , $italicStyle);
        $textRun->addText('/ Job title:');
        $table->addRow();
        $table->addCell(14000)->addText('____________________________________________________________________________');
        
        // Fila 4: Exposición
        $table->addRow();
        $cell = $table->addCell(14000, );
        $textRun = $cell->addTextRun();
        $textRun->addText('Exposició / ' , $boldStyle);
        $textRun->addText('Exposición ' , $italicStyle);
        $textRun->addText('/ Exhibition:');
        $table->addRow();
        $table->addCell(14000)->addText('____________________________________________________________________________');
        
        // Fila 5: Lugar
        $table->addRow();
        $cell = $table->addCell(14000, );
        $textRun = $cell->addTextRun();
        $textRun->addText('Lloc / ');
        $textRun->addText('Lugar ', $italicStyle);
        $textRun->addText('/ Place:');
        $table->addRow();
        $table->addCell(14000)->addText('____________________________________________________');
        
        // Fila 6: Fechas
        $table->addRow();
        $cell = $table->addCell(14000, );
        $textRun = $cell->addTextRun();
        $textRun->addText('Dates / ');
        $textRun->addText('Fechas ', $italicStyle);
        $textRun->addText('/ Dates:');
        $table->addRow();
        $table->addCell(14000)->addText('___________________ - ___________________');
        
        $table->addRow();
        $cell = $table->addCell(9000, ['borderBottomSize' => 20, 'borderBottomColor' => '000000']);
        $cell->addText('');
        $table->addRow();
       
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
        $cell = $table->addCell(5000);
        $textRun = $cell->addTextRun();
        $textRun->addText('Telèfon: ', $boldStyle);
        $textRun->addText('+34 977 15 41 92', $largeFontStyle);

        // Subtítulo "Teléfono / Telephone" en la misma celda
        $cell->addText('Teléfono / Telephone', $italicStyle);


        // Fila siguiente: "Correu electrònic" en la misma línea con el subtítulo
        $table->addRow();
        $cell = $table->addCell(6000); // Celda para el correo electrónico
        $textRun = $cell->addTextRun();
        $textRun->addText('Correu electrònic: ', $boldStyle);
        $textRun->addText('info@museuapellesfenosa.cat', $blueFontStyle);
        $table->addRow();
        // Subtítulo "Correo electrónico / Electronic mail" en la misma celda
        $cell->addText('Correo electrónico / Electronic mail', $italicStyle);

        $cell = $table->addCell(9000, ['borderBottomSize' => 20, 'borderBottomColor' => '000000']);
        $cell->addText('');

        $table->addRow();
        $table->addRow();
        $cell = $table->addCell(3000, );
        $cell->addText('Número de registre:', $boldStyle);
        $table->addRow();
        $cell->addText('Número de registro',$italicStyle);
        $table->addRow();
        $cell->addText('Inventory number');

   
        $cell = $table->addCell(3000, );
        $cell->addText("Nom de l'objecte i títol:", $boldStyle);
        $table->addRow();
        $cell->addText('Nombre del objeto y título ',$italicStyle);
        $table->addRow();
        $cell->addText('Object name and title');
        
        $cell = $table->addCell(3000, );
        $cell->addText("Autor:", $boldStyle);
        $table->addRow();
        $cell->addText('Autor',$italicStyle);
        $table->addRow();
        $cell->addText('Author');


        $cell = $table->addCell(3000, );
        $cell->addText("Dimensions màx. (Alçada/Amplada/Fondària):", $boldStyle);
        $table->addRow();
        $cell->addText('Dimensiones (Altura / Ancho / Fondo)',$italicStyle);
        $table->addRow();
        $cell->addText('Dimensions (Height / Width / Depth)');

        $cell = $table->addCell(5000); // Celda ancha para "Adreça"
        $textRun = $cell->addTextRun();
        $textRun->addText('Materials: ', $boldStyle);
        $cell->addText('Materiales ', $italicStyle);
        $cell->addText('Materials ');
        // Celda ancha para "Telèfon"
        $cell = $table->addCell(5000);
        $textRun = $cell->addTextRun();
        $textRun->addText('Datació: ', $boldStyle);
        $cell->addText('Datación', $italicStyle);
        $cell->addText('Dating');

        $table->addRow();
        $cell = $table->addCell(5000);
        // Crear un TextRun para controlar el contenido dentro de la celda
        $textRun = $cell->addTextRun(['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);

        // Añadir las líneas de texto
        $textRun->addText('Necessitat d’embalatge especial:    ', $boldStyle);
        // Añadir el checkbox al final, dentro del mismo TextRun
        $textRun->addCheckBox('checkbox_si', '', null, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT]);
        $cell->addText('Necesidad de embalado especial', $italicStyle);
        $cell->addText('Need of packed special');

        $table->addRow();
        $cell = $table->addCell(9000, ['borderBottomSize' => 20, 'borderBottomColor' => '000000']);
        $cell->addText('');

        $section->addImage('images/login/logo2.png', [
            'width' => 90,
            'height' => 170,
            'positioning' => 'absolute',
            'posHorizontalRel' => 'page', // Relativo a la página
            'posVerticalRel' => 'page',   // Relativo a la página
            'posHorizontal' => 'left',   // Posicionado a la izquierda
            'posVertical' => 'top',      // Desde la parte superior
        ]);
    

        $section->addImage('images/login/texto.png', [
            'width' => 100,
            'height' => 400,
            'positioning' => 'absolute',
            'posHorizontalRel' => 'page', // Relativo a la página
            'posVerticalRel' => 'page',   // Relativo a la página
            'posHorizontal' => 'left',   // Posicionado a la izquierda
            'posVertical' => 'bottom',   // Relativo al fondo
        ]);
        

        $table->addRow();
        $cell = $table->addCell(9000, ['borderBottomSize' => 20, 'borderBottomColor' => '000000']);
        $cell->addText('');

        $table->addRow();
        $table->addRow();
        $cell = $table->addCell(3000,);
        $textRun = $cell->addTextRun();
        $textRun->addText('Forma en què el prestador vol figurar en el catàleg: ', $boldStyle);
        $textRun->addText('Museu Apel·les Fenosa', $largeFontStyle); // Información más grande y negrita
        $cell->addText('Forma en que el prestador quiere figurar en el catálogo',$italicStyle);
        $table->addRow();
        $cell->addText('Form in which the lender wishes to feature in the catalogue');

        $table->addRow();
        $cell = $table->addCell(3000,);
        $textRun = $cell->addTextRun();
        $textRun->addText('El prestador admet que es fotografïi per a:', $boldStyle);
        $textRun->addText(' / El prestador admite que se fotografie para: / The lender allows to be photographed for:',$italicStyle);

        $table->addRow();
        $table->addCell(3000, )->addText('        Publicacions de l’exposició');
        $table->addCell(3000)->addCheckBox('checkbox_si', '   Sí');
        $table->addCell(3000)->addCheckBox('checkbox_no', '   No');  

        $table->addRow();
        $table->addCell(3000)->addText('        Mitjans de comunicació');
        $table->addCell(3000)->addCheckBox('checkbox_si', '   Sí');
        $table->addCell(3000)->addCheckBox('checkbox_no', '   No'); 

        $table->addRow();
        $table->addCell(3000)->addText('        Arxius');
        $table->addCell(3000)->addCheckBox('checkbox_si', '   Sí');
        $table->addCell(3000)->addCheckBox('checkbox_no', '   No'); 


        $table->addRow();
        $table->addCell(3000)->addText('        Finalitats privades');
        $table->addCell(3000)->addCheckBox('checkbox_si', '   Sí');
        $table->addCell(3000)->addCheckBox('checkbox_no', '   No'); 

        $table->addRow();
        $cell = $table->addCell(9000, ['borderBottomSize' => 20, 'borderBottomColor' => '000000']);
        $cell->addText('');


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

        $cell = $table->addCell(3000, );
        $cell->addText('Telèfon:', $boldStyle);
        $table->addRow();
        $cell->addText('Teléfono',$italicStyle);
        $table->addRow();
        $cell->addText('Telephone');

        $cell = $table->addCell(3000, );
        $cell->addText("Adreça on s'ha de retornar l'objecte:", $boldStyle);
        $table->addRow();
        $cell->addText('Dirección donde debe devolverse el objeto',$italicStyle);
        $table->addRow();
        $cell->addText('Address from which the object is to be returned');

        $cell = $table->addCell(3000, );
        $cell->addText('Telèfon:', $boldStyle);
        $table->addRow();
        $cell->addText('Teléfono',$italicStyle);
        $table->addRow();
        $cell->addText('Telephone');

        $table->addRow();
        $cell = $table->addCell(9000, ['borderBottomSize' => 20, 'borderBottomColor' => '000000']);



        // Primera fila: líneas de firma
        $table->addRow();
        $cell = $table->addCell(5000, $tableStyle2); // Celda para la firma izquierda
        $cell->addText('');
        $cell->addText('');
        $cell->addText('');
        $cell->addText('');
        $cell->addText('');
        $cell->addText('');
        $cell->addText('');
        $cell->addText('');
        $cell->addText('');
        $cell->addText('');
        $cell->addText('');
        $textRun = $cell->addTextRun();
        $textRun->addText('_____________________________________');
        // Subtítulo "Dirección / Address" en la misma celda
        $cell->addText('Data i firma del prestador del préstec', $boldStyle);
        $cell->addText('Fecha y firma del prestador del préstamo', $italicStyle);
        $cell->addText('Date and signature of lender', $italicStyle);

        $cell = $table->addCell(5000, $tableStyle2); // Celda para la firma derecha
        $cell->addText('');
        $cell->addText('');
        $cell->addText('');
        $cell->addText('');
        $cell->addText('');
        $cell->addText('');
        $cell->addText('');
        $cell->addText('');
        $cell->addText('');
        $cell->addText('');
        $cell->addText('');
        $cell->addText('_____________________________________');

        $cell->addText('Data i firma del prestatari del préstec', $boldStyle);
        $cell->addText('Fecha y firma del prestatario del préstamo', $italicStyle);
        $cell->addText('Date and signature of borrower', $italicStyle);

        

        // Guardar el archivo Word
        $tempFile = tempnam(sys_get_temp_dir(), 'word_') . '.docx';
        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);
        
        return $tempFile;
        
    }
}