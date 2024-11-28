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
        ]);
        
        // Fuente por defecto
        $phpWord->setDefaultFontName('Arial');
        $phpWord->setDefaultFontSize(11);
        
        // Estilos
        $bold = ['bold' => true];
        $tableStyle = [
            'cellMargin' => 80,
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
        $table->addCell(3000, $cellStyle)->addText('Institució sol·licitant / Institución solicitante / Applicant Institution:');
        $table->addCell(7000)->addText('___________________________');
        
        // Fila 2: Responsable del préstamo
        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Responsable del préstec / Responsable del préstamo / Responsible of loan:');
        $table->addCell(7000)->addText('___________________________');
        
        // Fila 3: Cargo
        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Càrrec / Cargo / Job title:');
        $table->addCell(7000)->addText('___________________________');
        
        // Fila 4: Exposición
        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Exposició / Exposición / Exhibition:');
        $table->addCell(7000)->addText('___________________________');
        
        // Fila 5: Lugar
        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Lloc / Lugar / Place:');
        $table->addCell(7000)->addText('___________________________');
        
        // Fila 6: Fechas
        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Dates / Fechas / Dates:');
        $table->addCell(7000)->addText('_____________ - _____________');
        
        // Fila 7: Nombre del prestador
        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Nom del prestador: Museu Apel·les Fenosa.');
        $table->addCell(7000)->addText('Fundació Privada Apel·les Fenosa');
        
        // Fila 8: Dirección
        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Adreça:');
        $table->addCell(7000)->addText('Carrer Major, 25, 43700 El Vendrell, Tarragona Telèfon: +34 977 15 41 92');
        
        // Fila 9: Correo electrónico
        $table->addRow();
        $table->addCell(3000, $cellStyle)->addText('Correu electrònic:');
        $table->addCell(7000)->addText('info@museuapellesfenosa.cat');
        
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

